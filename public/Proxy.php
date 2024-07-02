<?php
// Mengambil parameter 'path' dari URL
$path = isset($_GET['path']) ? $_GET['path'] : '';
$url = 'http://10.14.152.204' . $path;

// Memastikan URL bukan kosong dan memulai download file
if (!empty($path)) {
    // Mengatur header untuk memulai download file
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . basename($url) . '"');
    
    // Membaca file dan mengirimkan isinya ke browser
    readfile($url);
} else {
    echo "Invalid path.";
}