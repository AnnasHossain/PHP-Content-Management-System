<?php
require_once __DIR__ .'/../inc/all.php';

$galleryImageRepository = new GalleryImageRepository($pdo);

// Soll der Entry nur angezeigt werden oder soll er bearbeitet werden ?
if(!empty ($_POST) && !empty($_POST['id']) && !empty($_POST['title'])){
    $id = @(int) $_POST['id'];
    $title = @(string) $_POST['title'];
    $galleryImageRepository->update($id, $title);
    header('Location: dashboard.php');
}
// formular nicht abgeschickt
else{
    $entry = $galleryImageRepository->findById(@(int) $_GET['id']);
    if(empty($entry)){
        header('Location: dashboard.php');
    }
    else{
        renderAdmin(__DIR__ . '/views/update.view.php', [
            'galleryImage' => $entry
        ]);
    }
}