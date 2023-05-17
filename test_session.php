<?php
// require 'backend_header.php';

session_start();

$_SESSION['dai'] = 'daidai';


header('Content-Type: application/json');
echo json_encode($_SESSION);
