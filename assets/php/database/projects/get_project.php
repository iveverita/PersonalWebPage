<?php
header('Content-Type: application/json');
require_once 'projects.php';

if (isset($_GET['id'])) {
    $project = new Project();
    $data = $project->get($_GET['id']);
    
    if ($data) {
        echo json_encode([
            'id' => $data['id'],
            'name' => $data['name'],
            'creation_date' => $data['creation_date'],
            'description' => str_replace('"', "'", $data['description']),
            'photo' => $data['photo']
        ]);
    } else {
        echo json_encode(['error' => 'Project not found']);
    }
} else {
    echo json_encode(['error' => 'No project ID provided']);
}
exit;