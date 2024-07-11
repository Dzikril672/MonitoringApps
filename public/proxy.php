<?php
// Mengambil parameter 'path' dari URL
$path = isset($_GET['path']) ? $_GET['path'] : '';
$url = 'http://10.14.152.204' . $path;

// Memastikan URL bukan kosong dan memulai download file
if (!empty($path)) {
    // Mengambil informasi file
    $file_headers = @get_headers($url, 1);
    if (strpos($file_headers[0], '200') === false) {
        echo "File not found or server error.";
    } else {
        // Mengatur header untuk memulai download file
        $fileType = isset($file_headers['Content-Type']) ? $file_headers['Content-Type'] : 'application/octet-stream';
        header('Content-Type: ' . $fileType);
        header('Content-Disposition: attachment; filename="' . basename($path) . '"');
        header('Content-Transfer-Encoding: binary');
        header('Accept-Ranges: bytes');
        
        // Membaca file dan mengirimkan isinya ke browser
        $file = fopen($url, 'rb');
        if ($file) {
            while (!feof($file)) {
                echo fread($file, 8192);
                ob_flush();
                flush();
            }
            fclose($file);
        } else {
            echo "Failed to open the file.";
        }
        exit;
    }
} else {
    echo "Invalid path.";
}
