<?php
if (!isset($_SESSION)) {
    session_start();
}
header('Content-Type: application/json');
echo json_encode($_SESSION);
