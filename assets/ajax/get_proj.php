<?php
require_once '../../assets/php/database/projects/projects.php';

$offset = isset($_GET['offset']) ? (int)$_GET['offset'] : 0;
$limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 3;
$lang = isset($_GET['lang']) ? $_GET['lang'] : 'fr';

if ($lang === 'en') {
    require_once '../../assets/php/eng.php';
} else {
    require_once '../../assets/php/fr.php';
}

$project = new Project();
$projects = $project->getPaginated($offset, $limit);

$html = '';

foreach ($projects as $item) {
    $html .= '<article class="project-article">';
    $html .= '<img src="../../assets/css/img/projects/' . htmlspecialchars($item['photo']) . '" alt="' . htmlspecialchars($item['name']) . ' Image">';
    $html .= '<h2>' . htmlspecialchars($item['name']) . '</h2>';
    $html .= '</article>';
}

echo $html;