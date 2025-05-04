<?php

require_once 'projects.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars($_POST['name'] ?? '');
    $creation_date = htmlspecialchars($_POST['creation_date'] ?? '');
    $description = htmlspecialchars($_POST['description'] ?? '');
    
    $photo = 'default.jpg'; 

    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];
        $filename = $_FILES['photo']['name'];
        $file_ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        
        if (in_array($file_ext, $allowed)) {
            $new_filename = uniqid('project_') . '.' . $file_ext;
            $upload_dir = '../../../css/img/projects/';

            if (!file_exists($upload_dir)) {
                mkdir($upload_dir, 0755, true);
            }
        
            $upload_path = $upload_dir . $new_filename;
            
            if (move_uploaded_file($_FILES['photo']['tmp_name'], $upload_path)) {
                $photo = $new_filename;
                echo "File uploaded successfully to: " . $upload_path;
            } else {
                echo "Failed to move uploaded file. Error: " . error_get_last()['message'];
            }
        } else {
            echo "Invalid file extension. Allowed: " . implode(', ', $allowed);
        }
    } else if (isset($_FILES['photo'])) {
        echo "Upload error code: " . $_FILES['photo']['error'];
    }
    
    $errors = [];
    
    if (empty($name) || strlen($name) > 100) {
        $errors[] = 'Project name is required and must be less than 100 characters';
    }
    
    if (empty($creation_date)) {
        $errors[] = 'Creation date is required';
    }
    
    if (empty($description)) {
        $errors[] = 'Description is required';
    }

    if (empty($errors)) {
        $project = new Project();
        $project->save($name, $creation_date, $description, $photo);

        header('Location: add_proj_form.php?success=1');
        exit();
    }
}


include 'add_proj_form.php';