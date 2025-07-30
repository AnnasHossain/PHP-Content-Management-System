<?php

function render($path, array $data = []) {
   ob_start();
   extract($data);
   require $path;
   $content = ob_get_contents();
   ob_end_clean();
   
   require __DIR__ . '/../views/layouts/main.view.php';
}

function renderAdmin($path, array $data = []) {
   ob_start();
   extract($data);
   require $path;
   $content = ob_get_contents();
   ob_end_clean();
   
   require __DIR__ . '/../dashboard/views/layouts/main.view.php';
}

function e($html) {
    return htmlspecialchars($html, ENT_QUOTES, 'UTF-8', true);
}


function resizeImage($fromFile, $toFile = null, $maxDimension = 300) {
    // Set a maximum height and width
    $width = $maxDimension;
    $height = $maxDimension;
 
    // Get new dimensions
    list($widthOrig, $heightOrig) = getimagesize($fromFile);
    // Valid image so far?
    if ($widthOrig === NULL || $heightOrig === NULL) {
       return false;
    }
    // Image too big?
    if ($widthOrig >= 20000 || $heightOrig >= 20000) {
       return false;
    }
 
    $ratioOrig = $widthOrig/$heightOrig;
 
    if ($width/$height > $ratioOrig) {
       $width = (int) round($height*$ratioOrig);
    } else {
       $height = (int) round($width/$ratioOrig);
    }
 
    // Resample
    $imageP = imagecreatetruecolor($width, $height);
    $image = @imagecreatefromjpeg($fromFile);
    if ($image === false) {
       return false;
    }
    imagecopyresampled($imageP, $image, 0, 0, 0, 0, $width, $height, $widthOrig, $heightOrig);
 
    // Output
    $imageWritten = imagejpeg($imageP, $toFile, 80);
    if (!$imageWritten) {
       return false;
    }
    imagedestroy($imageP);
    imagedestroy($image);
 
    return true;
 }