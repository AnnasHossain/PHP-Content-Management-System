<?php

require_once __DIR__ . '/../inc/all.php';

$galleryImageRepository = new GalleryImageRepository($pdo);

$errorMessage = '';
$title = $_POST['title'];

if (empty($title)) {
    $errorMessage = 'Bitte geben Sie einen Titel ein...';
}
else if (!empty($_FILES['image']) && 
    $_FILES['image']['error'] === UPLOAD_ERR_OK &&
    $_FILES['image']['type'] === 'image/jpeg' &&
    is_uploaded_file($_FILES['image']['tmp_name'])) {
    
    $uploadOk = $galleryImageRepository->handleNewUpload($title, $_FILES['image']['tmp_name']);
    if (!$uploadOk) {
        $errorMessage = 'Das Bild konnte vom Server nicht verarbeitet werden.';
    }
}
else {
    $errorMessage = 'Es wurde keine gültige Datei hochgeladen.';
}


renderAdmin(__DIR__ . '/views/upload.view.php', [
    'message' => $errorMessage
]);