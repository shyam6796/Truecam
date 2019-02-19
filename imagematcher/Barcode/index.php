<?php 
include('vendor/autoload.php');
$generator = new Picqer\Barcode\BarcodeGeneratorHTML();
echo $generator->getBarcode('081231723897', $generator::TYPE_CODE_39_CHECKSUM);
?>