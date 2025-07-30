<?php

require_once __DIR__ . '/../inc/all.php';

$galleryImageRepository = new GalleryImageRepository($pdo);

if (!empty($_POST['id'])) {
    $id = (int) $_POST['id'];
    $galleryImageRepository->delete($id);
}

header('Location: dashboard.php');
