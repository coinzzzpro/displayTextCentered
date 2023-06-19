<?php

/*
In this example, the displayTextCentered function takes five parameters: $imagePath (path to the image file), $text (the text to be displayed), $fontPath (path to the TrueType font file), $fontSize (size of the font), and $textColor (hex color code of the text).

The function uses the GD library functions to load the image, calculate the position to center the text, allocate the text color, and write the text onto the image. Finally, it outputs the resulting image with the centered text.

To use the function, provide the appropriate values for the example usage section. Set the $imagePath variable to the path of your image file, $text to the desired text, $fontPath to the path of the TrueType font file you want to use, $fontSize to the desired font size, and $textColor to the hex color code of the text color.

The function assumes the image is in JPEG format, but you can modify the header function and imagejpeg function accordingly if your image is in a different format.

Remember to ensure that you have the necessary GD library installed and enabled in your PHP configuration for this code to work properly.
*/

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
