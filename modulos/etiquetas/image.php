<?php

/*
 * by Alex Dahlem
 * http://twitter.com/alexdahlem
 *
 * Dynamically creates a nice picture with a QR-Code on it
 *
 * Use this png as background: http://twitpic.com/5ds1iz
 * Copy the background.png in the same folder as your script
 *
 * You can use this code in any project you want. Mention me if you like it :)
 *
 * Love to qrserver.com for their API! Take a look at their services!
 *
 * ** Death to false markup! *** Cheers!
 */

// Tell the browser this script is an image
header("Content-Type: image/png");

// Our imagecontainer
$imagecontainer = imagecreatetruecolor(600, 550);
// We want to use transparency, so let's tell the image
imagesavealpha($imagecontainer, true);
// Now we fill the imagecontainer with a transparent color
$alphacolor = imagecolorallocatealpha($imagecontainer, 0, 0, 0, 127);
imagefill($imagecontainer, 0, 0, $alphacolor);


// Our background graphic
//$background = imagecreatefrompng('background.png');
$background = imagecreatefrompng('TemplateEtiqueta.png');
// Copy the background into the container
//imagecopyresampled($imagecontainer, $background, 0, 0, 0, 0, 1670, 750, 1700, 740);
imagecopyresampled($imagecontainer, $background, 0, 0, 0, 0, 500, 555, 605, 550);


// Our QR-Code
// http://api.qrserver.com/v1/create-qr-code/?size=165x165&data=olaaa

$qrimage = imagecreatefrompng('qrcode.png');
imagecopyresampled($imagecontainer, $qrimage, 20, 210, 0, 0, 140, 200, 180, 190);

imagecopyresampled($imagecontainer, $qrimage, 185, 210, 0, 0, 140, 200, 180, 190);

imagecopyresampled($imagecontainer, $qrimage, 345, 210, 0, 0, 140, 200, 180, 190);


// We need a photoshop-style layer effect
//imagelayereffect($imagecontainer, IMG_EFFECT_OVERLAY);
//for ($i = 0; $i < 3; $i++) {
//	// Copy the QR image three time for besser contrast
//	imagecopyresampled($imagecontainer, $qrimage, 115, 150, 0, 0, 265, 265, 265, 265);
//}
// Finally render the container
imagepng($imagecontainer);
