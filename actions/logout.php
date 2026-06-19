<?php
require_once __DIR__ . '/../includes/helpers.php';
unset($_SESSION['user_id']);
redirect('../lk/login.php');
