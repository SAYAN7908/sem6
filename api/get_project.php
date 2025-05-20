<?php
require_once '../includes/config.php';
require_once '../includes/functions.php';

header('Content-Type: application/json');

if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo json_encode(['error' => 'Project ID is required']);
    exit;
}

$id = intval($_GET['id']);
$project = getProjectById($id);

if (!$project) {
    echo json_encode(['error' => 'Project not found']);
    exit;
}

echo json_encode(['success' => true, 'project' => $project]);
?>