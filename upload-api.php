<?php

require './connect_team3_db.php';

$output = [
    'filename' => '',
    'files' => $_FILES,
];

if (!empty($_FILES['photo'])) {
    $filename = sha1($_FILES['photo']['name'] . uniqid()) . 'jpg';

    if (move_uploaded_file($_FILES['photo']['tmp_name'], "./Norm/imgs/{$filename}")) {
        $output['filename'] = $filename;
    } else {
        $output['error'] = 'cannot move files';
    }

    echo json_encode($output);
}
