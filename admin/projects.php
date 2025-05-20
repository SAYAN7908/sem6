<?php
require_once '../includes/config.php';
require_once '../includes/functions.php';

if (!isLoggedIn()) {
    redirect('auth/login.php');
}

// Handle project deletion
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $result = deleteProject($id);
    
    if (isset($result['success'])) {
        $_SESSION['success'] = $result['success'];
    } else {
        $_SESSION['error'] = $result['error'];
    }
    
    redirect('projects.php');
}

// Handle project form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'title' => sanitizeInput($_POST['title']),
        'description' => sanitizeInput($_POST['description']),
        'link' => sanitizeInput($_POST['link']),
        'github' => sanitizeInput($_POST['github'])
    ];
    
    if (isset($_POST['id']) && !empty($_POST['id'])) {
        // Update existing project
        $id = intval($_POST['id']);
        $image = isset($_FILES['image']) ? $_FILES['image'] : null;
        $result = updateProject($id, $data, $image);
    } else {
        // Add new project
        $image = $_FILES['image'];
        $result = addProject($data, $image);
    }
    
    if (isset($result['success'])) {
        $_SESSION['success'] = $result['success'];
    } else {
        $_SESSION['error'] = $result['error'];
    }
    
    redirect('projects.php');
}

$pageTitle = "Manage Projects";
$projects = getAllProjects();
$editProject = null;

if (isset($_GET['edit']) && !empty($_GET['edit'])) {
    $id = intval($_GET['edit']);
    $editProject = getProjectById($id);
}

require_once '../includes/admin-header.php';
?>

<div class="admin-container">
    <?php include '../includes/admin-sidebar.php'; ?>
    
    <div class="admin-content">
        <div class="admin-header">
            <h1>Manage Projects</h1>
            <button class="btn btn-primary" id="addProjectBtn">Add New Project</button>
        </div>
        
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></div>
        <?php endif; ?>
        
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-error"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
        <?php endif; ?>
        
        <div class="table-responsive" data-aos="fade-up">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($projects)): ?>
                        <tr>
                            <td colspan="5">No projects found</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($projects as $project): ?>
                            <tr>
                                <td><?php echo $project['id']; ?></td>
                                <td>
                                    <img src="<?php echo BASE_URL . UPLOAD_DIR . htmlspecialchars($project['image']); ?>" alt="<?php echo htmlspecialchars($project['title']); ?>" class="table-image">
                                </td>
                                <td><?php echo htmlspecialchars($project['title']); ?></td>
                                <td><?php echo htmlspecialchars(substr($project['description'], 0, 50) . '...'); ?></td>
                                <td>
                                    <a href="projects.php?edit=<?php echo $project['id']; ?>" class="btn btn-small">Edit</a>
                                    <a href="projects.php?delete=<?php echo $project['id']; ?>" class="btn btn-small btn-danger" onclick="return confirm('Are you sure you want to delete this project?')">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Project Modal -->
<div class="modal" id="projectModal">
    <div class="modal-content">
        <span class="close-modal">&times;</span>
        <h2><?php echo $editProject ? 'Edit Project' : 'Add New Project'; ?></h2>
        
        <form action="projects.php" method="POST" enctype="multipart/form-data">
            <?php if ($editProject): ?>
                <input type="hidden" name="id" value="<?php echo $editProject['id']; ?>">
            <?php endif; ?>
            
            <div class="form-group">
                <label for="title">Project Title</label>
                <input type="text" name="title" id="title" value="<?php echo $editProject ? htmlspecialchars($editProject['title']) : ''; ?>" required>
            </div>
            
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" rows="4" required><?php echo $editProject ? htmlspecialchars($editProject['description']) : ''; ?></textarea>
            </div>
            
            <div class="form-group">
                <label for="image">Project Image</label>
                <input type="file" name="image" id="image" <?php echo !$editProject ? 'required' : ''; ?>>
                <?php if ($editProject): ?>
                    <div class="current-image">
                        <p>Current Image:</p>
                        <img src="<?php echo BASE_URL . UPLOAD_DIR . htmlspecialchars($editProject['image']); ?>" alt="Current Project Image" style="max-width: 200px;">
                    </div>
                <?php endif; ?>
            </div>
            
            <div class="form-group">
                <label for="link">Project Link (URL)</label>
                <input type="url" name="link" id="link" value="<?php echo $editProject ? htmlspecialchars($editProject['link']) : ''; ?>">
            </div>
            
            <div class="form-group">
                <label for="github">GitHub Repository (URL)</label>
                <input type="url" name="github" id="github" value="<?php echo $editProject ? htmlspecialchars($editProject['github']) : ''; ?>">
            </div>
            
            <button type="submit" class="btn btn-primary"><?php echo $editProject ? 'Update Project' : 'Add Project'; ?></button>
        </form>
    </div>
</div>

<script>
// Modal functionality
const modal = document.getElementById('projectModal');
const addBtn = document.getElementById('addProjectBtn');
const closeBtn = document.querySelector('.close-modal');

// Open modal when Add Project button is clicked or when editing
<?php if ($editProject || isset($_GET['add'])): ?>
    window.onload = function() {
        modal.style.display = 'block';
    };
<?php endif; ?>

addBtn.onclick = function() {
    modal.style.display = 'block';
}

closeBtn.onclick = function() {
    modal.style.display = 'none';
    window.location.href = 'projects.php';
}

window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = 'none';
        window.location.href = 'projects.php';
    }
}
</script>

<?php require_once '../includes/admin-footer.php'; ?>
