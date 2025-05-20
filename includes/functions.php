<?php
require_once 'db.php';

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function redirect($url) {
    header("Location: $url");
    exit();
}

function sanitizeInput($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

function uploadFile($file) {
    $targetDir = UPLOAD_DIR;
    $fileName = uniqid() . '-' . basename($file['name']);
    $targetPath = $targetDir . $fileName;
    
    // Check file size
    if ($file['size'] > MAX_UPLOAD_SIZE) {
        return ['error' => 'File size exceeds maximum allowed size'];
    }
    
    // Check file type
    $fileType = mime_content_type($file['tmp_name']);
    if (!in_array($fileType, ALLOWED_TYPES)) {
        return ['error' => 'Only JPG, PNG, and GIF files are allowed'];
    }
    
    // Create upload directory if it doesn't exist
    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0777, true);
    }
    
    // Move the file
    if (move_uploaded_file($file['tmp_name'], $targetPath)) {
        return ['success' => $fileName];
    } else {
        return ['error' => 'There was an error uploading your file'];
    }
}

function getAllSkills() {
    global $db;
    return $db->fetchAll("SELECT * FROM skills ORDER BY category, name");
}

function getRecentProjects($limit = 6) {
    global $db;
    return $db->fetchAll("SELECT * FROM projects ORDER BY created_at DESC LIMIT ?", [$limit]);
}

function getAllProjects() {
    global $db;
    return $db->fetchAll("SELECT * FROM projects ORDER BY created_at DESC");
}

function getProjectById($id) {
    global $db;
    return $db->fetchOne("SELECT * FROM projects WHERE id = ?", [$id]);
}

function addProject($data, $image) {
    global $db;
    
    $uploadResult = uploadFile($image);
    if (isset($uploadResult['error'])) {
        return $uploadResult;
    }
    
    $imagePath = $uploadResult['success'];
    $stmt = $db->query(
        "INSERT INTO projects (title, description, image, link, github) VALUES (?, ?, ?, ?, ?)",
        [$data['title'], $data['description'], $imagePath, $data['link'], $data['github']]
    );
    
    return ['success' => 'Project added successfully'];
}

function updateProject($id, $data, $image = null) {
    global $db;
    
    $project = getProjectById($id);
    if (!$project) {
        return ['error' => 'Project not found'];
    }
    
    $updateData = [
        'title' => $data['title'] ?? $project['title'],
        'description' => $data['description'] ?? $project['description'],
        'link' => $data['link'] ?? $project['link'],
        'github' => $data['github'] ?? $project['github'],
        'image' => $project['image']
    ];
    
    if ($image && $image['error'] == UPLOAD_ERR_OK) {
        $uploadResult = uploadFile($image);
        if (isset($uploadResult['error'])) {
            return $uploadResult;
        }
        $updateData['image'] = $uploadResult['success'];
        
        // Delete old image
        if ($project['image'] && file_exists(UPLOAD_DIR . $project['image'])) {
            unlink(UPLOAD_DIR . $project['image']);
        }
    }
    
    $stmt = $db->query(
        "UPDATE projects SET title = ?, description = ?, image = ?, link = ?, github = ? WHERE id = ?",
        [$updateData['title'], $updateData['description'], $updateData['image'], 
         $updateData['link'], $updateData['github'], $id]
    );
    
    return ['success' => 'Project updated successfully'];
}

function deleteProject($id) {
    global $db;
    
    $project = getProjectById($id);
    if (!$project) {
        return ['error' => 'Project not found'];
    }
    
    // Delete image
    if ($project['image'] && file_exists(UPLOAD_DIR . $project['image'])) {
        unlink(UPLOAD_DIR . $project['image']);
    }
    
    $stmt = $db->query("DELETE FROM projects WHERE id = ?", [$id]);
    return ['success' => 'Project deleted successfully'];
}

function addSkill($data) {
    global $db;
    
    $stmt = $db->query(
        "INSERT INTO skills (name, percentage, category) VALUES (?, ?, ?)",
        [$data['name'], $data['percentage'], $data['category']]
    );
    
    return ['success' => 'Skill added successfully'];
}

function updateSkill($id, $data) {
    global $db;
    
    $stmt = $db->query(
        "UPDATE skills SET name = ?, percentage = ?, category = ? WHERE id = ?",
        [$data['name'], $data['percentage'], $data['category'], $id]
    );
    
    return ['success' => 'Skill updated successfully'];
}

function deleteSkill($id) {
    global $db;
    
    $stmt = $db->query("DELETE FROM skills WHERE id = ?", [$id]);
    return ['success' => 'Skill deleted successfully'];
}

function saveMessage($data) {
    global $db;
    
    $stmt = $db->query(
        "INSERT INTO messages (name, email, message) VALUES (?, ?, ?)",
        [$data['name'], $data['email'], $data['message']]
    );
    
    return ['success' => 'Message sent successfully'];
}

function getMessages($limit = null) {
    global $db;
    
    $sql = "SELECT * FROM messages ORDER BY created_at DESC";
    if ($limit) {
        $sql .= " LIMIT ?";
        return $db->fetchAll($sql, [$limit]);
    }
    
    return $db->fetchAll($sql);
}

function getUnreadMessagesCount() {
    global $db;
    $result = $db->fetchOne("SELECT COUNT(*) as count FROM messages WHERE is_read = FALSE");
    return $result['count'];
}

function markMessageAsRead($id) {
    global $db;
    $stmt = $db->query("UPDATE messages SET is_read = TRUE WHERE id = ?", [$id]);
    return ['success' => 'Message marked as read'];
}

function deleteMessage($id) {
    global $db;
    $stmt = $db->query("DELETE FROM messages WHERE id = ?", [$id]);
    return ['success' => 'Message deleted successfully'];
}

// Admin authentication functions
function loginUser($username, $password) {
    global $db;
    
    $user = $db->fetchOne("SELECT * FROM users WHERE username = ?", [$username]);
    
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        return true;
    }
    
    return false;
}

function registerAdmin() {
    global $db;
    
    // Check if admin already exists
    $adminExists = $db->fetchOne("SELECT * FROM users WHERE username = ?", [ADMIN_USERNAME]);
    if ($adminExists) {
        return false;
    }
    
    // Create admin user
    $hashedPassword = password_hash(ADMIN_PASSWORD, PASSWORD_DEFAULT);
    $stmt = $db->query(
        "INSERT INTO users (username, password) VALUES (?, ?)",
        [ADMIN_USERNAME, $hashedPassword]
    );
    
    return $stmt;
}

// Call this function once to create the admin user
registerAdmin();
?>