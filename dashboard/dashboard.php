<?php
// var_dump("ICH BIN DIE ADMIN.php");

require_once __DIR__ . '/../inc/all.php';

$galleryImageRepository = new GalleryImageRepository($pdo);
$images = $galleryImageRepository->fetchAll();

renderAdmin(__DIR__ . '/views/dashboard.view.php', [
    'images' => $images
]);