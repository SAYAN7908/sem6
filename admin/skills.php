<?php
require_once '../includes/config.php';
require_once '../includes/functions.php';

if (!isLoggedIn()) {
    redirect('auth/login.php');
}

// Handle skill deletion
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $result = deleteSkill($id);
    
    if (isset($result['success'])) {
        $_SESSION['success'] = $result['success'];
    } else {
        $_SESSION['error'] = $result['error'];
    }
    
    redirect('skills.php');
}

// Handle skill form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'name' => sanitizeInput($_POST['name']),
        'percentage' => intval($_POST['percentage']),
        'category' => sanitizeInput($_POST['category'])
    ];
    
    if (isset($_POST['id']) && !empty($_POST['id'])) {
        // Update existing skill
        $id = intval($_POST['id']);
        $result = updateSkill($id, $data);
    } else {
        // Add new skill
        $result = addSkill($data);
    }
    
    if (isset($result['success'])) {
        $_SESSION['success'] = $result['success'];
    } else {
        $_SESSION['error'] = $result['error'];
    }
    
    redirect('skills.php');
}

$pageTitle = "Manage Skills";
$skills = getAllSkills();
$editSkill = null;

if (isset($_GET['edit']) && !empty($_GET['edit'])) {
    $id = intval($_GET['edit']);
    $editSkill = $db->fetchOne("SELECT * FROM skills WHERE id = ?", [$id]);
}

require_once '../includes/admin-header.php';
?>

<div class="admin-container">
    <?php include '../includes/admin-sidebar.php'; ?>
    
    <div class="admin-content">
        <div class="admin-header">
            <h1>Manage Skills</h1>
            <button class="btn btn-primary" id="addSkillBtn">Add New Skill</button>
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
                        <th>Name</th>
                        <th>Percentage</th>
                        <th>Category</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($skills)): ?>
                        <tr>
                            <td colspan="5">No skills found</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($skills as $skill): ?>
                            <tr>
                                <td><?php echo $skill['id']; ?></td>
                                <td><?php echo htmlspecialchars($skill['name']); ?></td>
                                <td><?php echo $skill['percentage']; ?>%</td>
                                <td><?php echo htmlspecialchars($skill['category']); ?></td>
                                <td>
                                    <a href="skills.php?edit=<?php echo $skill['id']; ?>" class="btn btn-small">Edit</a>
                                    <a href="skills.php?delete=<?php echo $skill['id']; ?>" class="btn btn-small btn-danger" onclick="return confirm('Are you sure you want to delete this skill?')">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Skill Modal -->
<div class="modal" id="skillModal">
    <div class="modal-content">
        <span class="close-modal">&times;</span>
        <h2><?php echo $editSkill ? 'Edit Skill' : 'Add New Skill'; ?></h2>
        
        <form action="skills.php" method="POST">
            <?php if ($editSkill): ?>
                <input type="hidden" name="id" value="<?php echo $editSkill['id']; ?>">
            <?php endif; ?>
            
            <div class="form-group">
                <label for="name">Skill Name</label>
                <input type="text" name="name" id="name" value="<?php echo $editSkill ? htmlspecialchars($editSkill['name']) : ''; ?>" required>
            </div>
            
            <div class="form-group">
                <label for="percentage">Percentage (1-100)</label>
                <input type="number" name="percentage" id="percentage" min="1" max="100" value="<?php echo $editSkill ? $editSkill['percentage'] : ''; ?>" required>
            </div>
            
            <div class="form-group">
                <label for="category">Category</label>
                <select name="category" id="category" required>
                    <option value="">Select Category</option>
                    <option value="Frontend" <?php echo ($editSkill && $editSkill['category'] == 'Frontend') ? 'selected' : ''; ?>>Frontend</option>
                    <option value="Backend" <?php echo ($editSkill && $editSkill['category'] == 'Backend') ? 'selected' : ''; ?>>Backend</option>
                    <option value="Database" <?php echo ($editSkill && $editSkill['category'] == 'Database') ? 'selected' : ''; ?>>Database</option>
                    <option value="Tools" <?php echo ($editSkill && $editSkill['category'] == 'Tools') ? 'selected' : ''; ?>>Tools</option>
                    <option value="Other" <?php echo ($editSkill && $editSkill['category'] == 'Other') ? 'selected' : ''; ?>>Other</option>
                </select>
            </div>
            
            <button type="submit" class="btn btn-primary"><?php echo $editSkill ? 'Update Skill' : 'Add Skill'; ?></button>
        </form>
    </div>
</div>

<script>
// Modal functionality
const modal = document.getElementById('skillModal');
const addBtn = document.getElementById('addSkillBtn');
const closeBtn = document.querySelector('.close-modal');

// Open modal when Add Skill button is clicked or when editing
<?php if ($editSkill || isset($_GET['add'])): ?>
    window.onload = function() {
        modal.style.display = 'block';
    };
<?php endif; ?>

addBtn.onclick = function() {
    modal.style.display = 'block';
}

closeBtn.onclick = function() {
    modal.style.display = 'none';
    window.location.href = 'skills.php';
}

window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = 'none';
        window.location.href = 'skills.php';
    }
}
</script>

<?php require_once '../includes/admin-footer.php'; ?>