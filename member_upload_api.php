<?php

require './connect_team3_db.php';

$output = [
    'filename' => '',
    'files' => $_FILES,
];

if (!empty($_FILES['file'])) {
    $filename = sha1($_FILES['file']['name'] . uniqid()) . 'jpg';

    if (move_uploaded_file($_FILES['photo']['tmp_name'], "./images/{$filename}")) {
        $output['filename'] = $filename;
    } else {
        $output['error'] = 'cannot move files';
    }

    echo json_encode($output);
}
