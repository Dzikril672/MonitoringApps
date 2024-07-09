<?php
// Mengambil parameter 'path' dari URL
$path = isset($_GET['path']) ? $_GET['path'] : '';
$url = 'http://10.14.152.204' . $path;

// Memastikan URL bukan kosong dan memulai download file
if (!empty($path)) {
    // Mengambil informasi file
    $file_headers = @get_headers($url);
    if(strpos($file_headers[0], '200') === false) {
        echo "File not found or server error.";
    } else {
        // Mengambil konten file
        $file_content = file_get_contents($url);
        if ($file_content === false) {
            echo "Failed to read file.";
        } else {
            // Menentukan MIME type yang tepat untuk PDF
            header('Content-Type: application/pdf');
            header('Content-Disposition: inline; filename="' . basename($path) . '"');
            header('Content-Transfer-Encoding: binary');
            header('Accept-Ranges: bytes');
            header('Content-Length: ' . strlen($file_content));

            // Mengirimkan isi file ke browser
            echo $file_content;
        }
    }
} else {
    echo "Invalid path.";
}
?>
