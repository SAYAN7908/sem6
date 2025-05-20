<?php
require_once '../includes/config.php';
require_once '../includes/functions.php';

if (!isLoggedIn()) {
    redirect('auth/login.php');
}

// Handle message deletion
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $result = deleteMessage($id);
    
    if (isset($result['success'])) {
        $_SESSION['success'] = $result['success'];
    } else {
        $_SESSION['error'] = $result['error'];
    }
    
    redirect('messages.php');
}

// Handle mark as read
if (isset($_GET['view'])) {
    $id = intval($_GET['view']);
    $result = markMessageAsRead($id);
    $message = $db->fetchOne("SELECT * FROM messages WHERE id = ?", [$id]);
}

$pageTitle = "Manage Messages";
$messages = getMessages();

require_once '../includes/admin-header.php';
?>

<div class="admin-container">
    <?php include '../includes/admin-sidebar.php'; ?>
    
    <div class="admin-content">
        <div class="admin-header">
            <h1>Manage Messages</h1>
        </div>
        
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></div>
        <?php endif; ?>
        
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-error"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
        <?php endif; ?>
        
        <div class="messages-container">
            <?php if (isset($message)): ?>
                <!-- Message Detail View -->
                <div class="message-detail" data-aos="fade-up">
                    <div class="message-header">
                        <h2><?php echo htmlspecialchars($message['name']); ?></h2>
                        <div class="message-meta">
                            <span><i class="fas fa-envelope"></i> <?php echo htmlspecialchars($message['email']); ?></span>
                            <span><i class="fas fa-clock"></i> <?php echo date('F j, Y, g:i a', strtotime($message['created_at'])); ?></span>
                        </div>
                    </div>
                    <div class="message-content">
                        <p><?php echo nl2br(htmlspecialchars($message['message'])); ?></p>
                    </div>
                    <div class="message-actions">
                        <a href="messages.php" class="btn btn-small">Back to Messages</a>
                        <a href="messages.php?delete=<?php echo $message['id']; ?>" class="btn btn-small btn-danger" onclick="return confirm('Are you sure you want to delete this message?')">Delete</a>
                    </div>
                </div>
            <?php else: ?>
                <!-- Messages List -->
                <div class="table-responsive" data-aos="fade-up">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Message Preview</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($messages)): ?>
                                <tr>
                                    <td colspan="7">No messages found</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($messages as $message): ?>
                                    <tr class="<?php echo !$message['is_read'] ? 'unread' : ''; ?>">
                                        <td><?php echo $message['id']; ?></td>
                                        <td><?php echo htmlspecialchars($message['name']); ?></td>
                                        <td><?php echo htmlspecialchars($message['email']); ?></td>
                                        <td><?php echo htmlspecialchars(substr($message['message'], 0, 50) . '...'); ?></td>
                                        <td><?php echo date('M j, Y', strtotime($message['created_at'])); ?></td>
                                        <td>
                                            <?php if ($message['is_read']): ?>
                                                <span class="badge badge-success">Read</span>
                                            <?php else: ?>
                                                <span class="badge badge-warning">Unread</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <a href="messages.php?view=<?php echo $message['id']; ?>" class="btn btn-small">View</a>
                                            <a href="messages.php?delete=<?php echo $message['id']; ?>" class="btn btn-small btn-danger" onclick="return confirm('Are you sure you want to delete this message?')">Delete</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php require_once '../includes/admin-footer.php'; ?>