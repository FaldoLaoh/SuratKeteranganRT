<?php
// Start the session
session_start();
// Include the header
require 'index.php';

// Check if the user is logged in
$isLoggedIn = isset($_SESSION['id_user']); 

if ($isLoggedIn): ?>
    <div class="login-btn">
        <a href="?logout">Logout</a>
    </div>
    <?php else: ?>
    <div class="login-btn">
        <a href="halamanLogin.html">Login</a>
    </div>
    <?php endif;
?>