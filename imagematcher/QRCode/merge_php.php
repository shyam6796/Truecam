
<?php
// Create image instances
$dest = imagecreatefrompng('qrcode.png');
$src = imagecreatefrompng('notifilick_logo.png');

// Copy and merge
imagecopymerge($dest, $src, 10, 10, 0, 0, 100, 47, 75);

// Output and free from memory
//header('Content-Type: image/png');
$final_image=imagepng($dest,"final_image.png");

imagedestroy($dest);
imagedestroy($src);
?>
