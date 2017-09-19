<?php

if(session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(isset($_SESSION['success'])) {
    
    echo '<div class="alert alert-success">';
    echo $_SESSION['success'];
    echo '</div>';
                    
    unset($_SESSION['success']);
}