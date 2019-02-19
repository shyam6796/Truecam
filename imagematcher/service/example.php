<?php

/**
 * @author ThaoNv
 * compareImages example
 */
include('compareImages.php');
 
/* Get hash string from image*/
$image3 = 'b.jpg';
$compareMachine = new compareImages($image3);
$image3Hash = $compareMachine->getHasString(); 
echo "Image 3: <img src='$image3'/><br/>";
echo 'Image 3 Hash :'.$image3Hash.'<br/>';

/* Compare this image with an other image*/
$image4 = 'a.jpg';
$image4Hash = $compareMachine->hasStringImage($image4); 
$diff = $compareMachine->compareHash($image4Hash); 
echo "Image 4: <img src='$image4'/><br/>";
echo 'Image 4 Hash :'.$image4Hash.'<br/>';
echo 'Different rates (image3 Vs image4): '.$diff;
if($diff>11){
    echo ' => 2 different image';
}
else{
    echo ' => duplicate image';
}?>