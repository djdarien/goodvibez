<?php
include 'header.php';

$page = isset($_GET['page']) ? $_GET['page'] : 'questions';

switch ($page) {
    case 'bio':
        include 'bio.php';
        break;
    case 'community':
        include 'community.php';
        break;
    case 'rules':
        include 'rules.php';
        break;
    case 'research':
        include 'research.php';
        break;
    default:
        include 'questionnaire.php'; // Changed from 'questions.php' to 'questionnaire.php'
        break;
}

include 'footer.php';
?>
