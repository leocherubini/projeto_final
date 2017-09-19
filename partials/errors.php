<?php

if(session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(isset($_SESSION['errors'])) {
    
    echo '<div class="alert alert-danger">';
    echo '<ul>';
    
    foreach($_SESSION['errors'] as $error) {
        echo "<li>$error</li>";
    }
    
    echo '</ul>';
    echo '</div>';
                    
    unset($_SESSION['errors']);
}
