<?php

function webpImage($source, $quality = 100, $removeOld = false)
{
    $name = sha1(microtime(true) . sha1_file($source)) . '.webp';
    $destination = __DIR__ . "\\..\\uploads\\" . $name;
    $info = getimagesize($source);
    $isAlpha = false;

    if ($info['mime'] == 'image/jpeg')
        $image = imagecreatefromjpeg($source);
    elseif ($isAlpha = $info['mime'] == 'image/gif') {
        $image = imagecreatefromgif($source);
    } elseif ($isAlpha = $info['mime'] == 'image/png') {
        $image = imagecreatefrompng($source);
    } else {
        return $source;
    }

    if ($isAlpha) {
        imagepalettetotruecolor($image);
        imagealphablending($image, true);
        imagesavealpha($image, true);
    }
    imagewebp($image, $destination, $quality);

    if ($removeOld)
        unlink($source);

    return $name;
}