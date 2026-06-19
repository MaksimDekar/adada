<?php
require_once __DIR__ . '/../includes/helpers.php';
unset($_SESSION['admin_logged']);
redirect('login.php');
