<?php 
include('vendor/autoload.php');
use Endroid\QrCode\QrCode;

$qrCode = new QrCode();
$qrCode
    ->setText('Life is too short to be generating QR codes')
    ->setSize(300)
    ->setPadding(10)
    ->setErrorCorrection('high')
    ->setForegroundColor(['r' => 0, 'g' => 0, 'b' => 0, 'a' => 0])
    ->setBackgroundColor(['r' => 255, 'g' => 255, 'b' => 255, 'a' => 0])   
    ->setLabelFontSize(16)
    ->setImageType(QrCode::IMAGE_TYPE_PNG)
;


// now we can directly output the qrcode
header('Content-Type: '.$qrCode->getContentType());
$qrCode->render();

// save it to a file
$qrCode->save('flick/qrcode.png');

$dest = imagecreatefrompng('flick/qrcode.png');
$src = imagecreatefrompng('notifilick_logo.png');

// Copy and merge
imagecopymerge($dest, $src, 110, 110, 0, 0, 100, 100, 100);

// Output and free from memory
header('Content-Type: image/png');
echo imagepng($dest,"final_image.png");


?>