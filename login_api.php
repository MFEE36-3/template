<?php

require './connect_team3_db.php';

$output = [

    'success' => false,
    'data' => $_POST,  //除錯用~~
    'code' => 0,
];

// $output['success'] = true;
//測試用

header('Content-Type: application/json');
echo json_encode($output, JSON_UNESCAPED_UNICODE);
