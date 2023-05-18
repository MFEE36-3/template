<?php

session_start();

unset($_SESSION['admin_member']);

header('Location: test_page-Norm.php');
