<?php

function displayTextCentered($imagePath, $text, $fontPath, $fontSize, $textColor)
{
    // Load the image
    $image = imagecreatefromstring(file_get_contents($imagePath));

    // Get the image dimensions
    $imageWidth = imagesx($image);
    $imageHeight = imagesy($image);

    // Calculate the position to center the text
    $textBoundingBox = imagettfbbox($fontSize, 0, $fontPath, $text);
    $textWidth = $textBoundingBox[2] - $textBoundingBox[0];
    $textHeight = $textBoundingBox[3] - $textBoundingBox[1];
    $textX = ($imageWidth - $textWidth) / 2;
    $textY = ($imageHeight - $textHeight) / 2 + $textHeight;

    // Allocate the text color
    $colorComponents = sscanf($textColor, '#%2x%2x%2x');
    $textColorAllocated = imagecolorallocate($image, $colorComponents[0], $colorComponents[1], $colorComponents[2]);

    // Write the text onto the image
    imagettftext($image, $fontSize, 0, $textX, $textY, $textColorAllocated, $fontPath, $text);

    // Display the image
    header('Content-Type: image/jpeg');
    imagejpeg($image);

    // Free up memory
    imagedestroy($image);
}

// Example usage:
$imagePath = 'path/to/image.jpg';
$text = 'Centered Text';
$fontPath = 'path/to/font.ttf';
$fontSize = 24;
$textColor = '#FFFFFF';

displayTextCentered($imagePath, $text, $fontPath, $fontSize, $textColor);

?>
