<?php
header('Content-Type: application/json');

$folder = basename($_GET['folder']);

if (!preg_match('/^[a-zA-Z0-9_-]+$/', $folder)) {
    echo json_encode(['exists' => false]);
    exit;
}

if (is_dir($folder)) {
    echo json_encode(['exists' => true]);
} else {
    echo json_encode(['exists' => false]);
}
