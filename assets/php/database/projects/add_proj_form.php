<?php
    $lang = 'fr';
    if (isset($_COOKIE['lang']) && ($_COOKIE['lang'] === 'en' || $_COOKIE['lang'] === 'fr')) {
        $lang = $_COOKIE['lang'];
    }

    if ($lang === 'en') {
        require_once '../../eng.php';
    } else {
        require_once '../../fr.php';
    }

?>
<!DOCTYPE html>
<html lang="<?= $lang ?>">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Add Project</title>
    <link rel="stylesheet" href="../../../css/style.css">
</head>
<body>
    <header>
        <nav id="navbar">
            <a href="/" title="Retour à la page d'accueil">
                <p>Back to the main page</p>
            </a>
        </nav>
    </header>

    <main>
        <h1>Add New Project</h1>
        
        <?php if (isset($errors) && !empty($errors)): ?>
            <div class="error-messages">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?= $error ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        
        <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
            <div class="success-message">
                <p>Project added successfully!</p>
            </div>
        <?php endif; ?>
        
        <form action="new_proj.php" method="POST" enctype="multipart/form-data" id="projectForm">
            <div class="form-group">
                <label for="name">Project Name:</label>
                <input type="text" id="name" name="name" required maxlength="100">
            </div>
            
            <div class="form-group">
                <label for="creation_date">Creation Date:</label>
                <input type="date" id="creation_date" name="creation_date" required>
            </div>
            
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea id="description" name="description" required rows="5"></textarea>
            </div>
            
            <div class="form-group">
                <label for="photo">Project Photo:</label>
                <input type="file" id="photo" name="photo" accept="image/*">
            </div>
            
            <div class="form-group">
                <button type="submit" id="submitBtn">Add Project</button>
            </div>
        </form>
    </main>
    
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('projectForm');
        const submitBtn = document.getElementById('submitBtn');
        
        form.addEventListener('submit', function(event) {
            event.preventDefault();
            
            let isValid = true;
            const name = document.getElementById('name').value.trim();
            const date = document.getElementById('creation_date').value.trim();
            const description = document.getElementById('description').value.trim();
            
            if (name === '' || name.length > 100) {
                isValid = false;
                alert('Project name is required and must be less than 100 characters');
            }
            
            if (date === '') {
                isValid = false;
                alert('Creation date is required');
            }
            
            if (description === '') {
                isValid = false;
                alert('Description is required');
            }
            
            if (isValid) {
                form.submit();
            }
        });
    });
    </script>
</body>
</html>