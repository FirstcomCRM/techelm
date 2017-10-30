<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

class base30 extends \yii\base\Model
{
  // private $acceptedformat = 'image/jsignature;base30';

    private $chunkSeparator = '';
    private $charmap = array(); // {'1':'g','2':'h','3':'i','4':'j','5':'k','6':'l','7':'m','8':'n','9':'o','a':'p','b':'q','c':'r','d':'s','e':'t','f':'u','0':'v'}
    private $charmap_reverse = array(); // will be filled by 'uncompress*" function
    private $allchars = array();
    private $bitness = 0;
    private $minus = '';
    private $plus = '';

    function __construct() {
        global $bitness, $allchars, $charmap, $charmap_reverse, $minus, $plus, $chunkSeparator;

        $allchars = str_split('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWX');
        $bitness = sizeof($allchars) / 2;
        $minus = 'Z';
        $plus = 'Y';
        $chunkSeparator = '_';

        for($i = $bitness-1; $i > -1; $i--){
            $charmap[$allchars[$i]] = $allchars[$i+$bitness];
            $charmap_reverse[$allchars[$i+$bitness]] = $allchars[$i];
        }

    }


    private function uncompress_stroke_leg($datastring){
        global $charmap, $charmap_reverse, $bitness, $minus, $plus;


        $answer = array();
        $chars = str_split( $datastring );
        $l = sizeof( $chars );
        $ch = '';
        $polarity = 1;
        $partial = array();
        $preprewhole = 0;
        $prewhole = 0;

        for($i = 0; $i < $l; $i++){

            $ch = $chars[$i];
            if (array_key_exists($ch, $charmap) || $ch == $minus || $ch == $plus){



                if (sizeof($partial) != 0) {
                    // yep, we have some number parts in there.
                    $prewhole = intval( implode('', $partial), $bitness) * $polarity + $preprewhole;
                    array_push( $answer, $prewhole );
                    $preprewhole = $prewhole;
                }

                if ($ch == $minus){
                    $polarity = -1;
                    $partial = array();
                } else if ($ch == $plus){
                    $polarity = 1;
                    $partial = array();
                } else {
                    // now, let's start collecting parts for the new number:
                    $partial = array($ch);
                }
            } else  {

                array_push( $partial, $charmap_reverse[$ch]);
            }
        }
        // we always will have something stuck in partial
        // because we don't have closing delimiter
        array_push( $answer, intval( implode('',$partial), $bitness ) * $polarity + $preprewhole );

        return $answer;
    }



    
    public function Base64ToNative($datastring){
        global $chunkSeparator;

        $data = array();
        $chunks = explode( $chunkSeparator, $datastring );
        $l = sizeof($chunks) / 2;
        for ($i = 0; $i < $l; $i++){
            array_push( $data, array(
                'x' => $this->uncompress_stroke_leg($chunks[$i*2])
                , 'y' => $this->uncompress_stroke_leg($chunks[$i*2+1])
            ));
        }
        return $data;
    }

}
