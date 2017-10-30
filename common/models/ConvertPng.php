<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;
use common\models\base30;

class ConvertPng extends \yii\base\Model
{
  public function base30_to_jpeg($base30_string, $output_file) {

    $data = str_replace('image/jsignature;base30,', '', $base30_string);
    $converter = new base30();
    $raw = $converter->Base64ToNative($data);
//Calculate dimensions
$width = 0;
$height = 0;
foreach($raw as $line)
{
    if (max($line['x'])>$width)$width=max($line['x']);
    if (max($line['y'])>$height)$height=max($line['y']);
}

// Create an image
    $im = imagecreatetruecolor($width+20,$height+20);


// Save transparency for PNG
    imagesavealpha($im, true);
// Fill background with transparency
    $trans_colour = imagecolorallocatealpha($im, 255, 255, 255, 127);
    imagefill($im, 0, 0, $trans_colour);
// Set pen thickness
    imagesetthickness($im, 3);
// Set pen color to black
    $black = imagecolorallocate($im, 0, 0, 0);
// Loop through array pairs from each signature word
    for ($i = 0; $i < count($raw); $i++)
    {
        // Loop through each pair in a word
        for ($j = 0; $j < count($raw[$i]['x']); $j++)
        {
            // Make sure we are not on the last coordinate in the array
            if ( ! isset($raw[$i]['x'][$j]))
                break;
            if ( ! isset($raw[$i]['x'][$j+1]))
            // Draw the dot for the coordinate
                imagesetpixel ( $im, $raw[$i]['x'][$j], $raw[$i]['y'][$j], $black);
            else
            // Draw the line for the coordinate pair
            imageline($im, $raw[$i]['x'][$j], $raw[$i]['y'][$j], $raw[$i]['x'][$j+1], $raw[$i]['y'][$j+1], $black);
        }
    }

//Create Image
    $ifp = fopen($output_file, "wb");
    imagepng($im, $output_file);
    fclose($ifp);
    imagedestroy($im);

    return $output_file;

  }

}
