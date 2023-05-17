<?php

session_start();

unset($_SESSION['admin']);

header('Location: test_page-Norm.php');
