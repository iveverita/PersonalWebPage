<?php
require_once 'creation.php';
require_once 'message.php';

try {
    $creation = new Creation();
    $db = $creation->getConnection();
    error_log("Database connection successful");
} catch (Exception $e) {
    error_log("Database error: " . $e->getMessage());
    header('Location: ../../../../index.php?error=' . urlencode($e->getMessage()) . '#contactForm');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = isset($_POST['name']) ? htmlspecialchars(trim($_POST['name'])) : '';
    $email = isset($_POST['email']) ? filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL) : '';
    $phone = isset($_POST['phone']) ? htmlspecialchars(trim($_POST['phone'])) : '';
    $message = isset($_POST['message']) ? htmlspecialchars(trim($_POST['message'])) : '';
    
    $errors = [];
    
    if (strlen($name) < 2) {
        $errors[] = 'Name must be at least 2 characters';
    }
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Invalid email format';
    }
    
    if (!empty($phone) && !preg_match('/^[+]?[(]?[0-9]{3}[)]?[-\s.]?[0-9]{3}[-\s.]?[0-9]{4,6}$/', $phone)) {
        $errors[] = 'Invalid phone number format';
    }
    
    if (strlen($message) < 10) {
        $errors[] = 'Message must be at least 10 characters';
    }

    if (empty($errors)) {
        try {
            $messageObj = new Message();
            
            $result = $messageObj->create([
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'message' => $message,
                'created_at' => date('Y-m-d H:i:s')
            ]);
            
            if ($result) {
                header('Location: ../../../../index.php?success=1#contactForm');
                exit;
            } else {
                header('Location: ../../../../index.php?error=Failed to save message#contactForm');
                exit;
            }
        } catch (Exception $e) {
            error_log('Database error: ' . $e->getMessage());
            header('Location: ../../../../index.php?error=' . urlencode($e->getMessage()) . '#contactForm');
            exit;
        }
    } else {
        header('Location: ../../../../index.php?error=' . urlencode(implode(', ', $errors)) . '#contactForm');
        exit;
    }
} else {
    header('Location: ../../../../index.php');
    exit;
}
?>