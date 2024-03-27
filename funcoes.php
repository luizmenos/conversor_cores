<?php

function rgbToHsv($r, $g, $b)
{


    $r = $r / 255;
    $g = $g / 255;
    $b = $b / 255;

    $cormax = max($r, $g, $b);
    $cormin = min($r, $g, $b);

    $c = $cormax - $cormin;
    if ($r == $g and $r == $b) {

        $h = 0;
    } else if ($cormax == $r) {

        if ($g < $b) $soma = 360;
        else if ($g >= $b) $soma = 0;
        $h = 60 * (($g - $b) / ($c)) + $soma;
    } else if ($cormax == $g) {

        $h = 60 * ((($b - $r) / ($c))) + 120;
    } else if ($cormax == $b) {

        $h = 60 * ((($r - $g) / ($c)))  + 240;
    }

    if ($cormax == 0) {
        $s = 0;
    } else {
        $s = $c / $cormax;
    }

    $v = $cormax;

    $hexadecimal = sprintf("#%02x%02x%02x", $r * 255, $g * 255, $b * 255);

    return array(round($h), round($s * 100), round($v * 100), $hexadecimal);
}
function hsvToRgb($h, $s, $v)
{
    $s /= 100;
    $v /= 100;
    if (0 <= $h and $h < 360 and 0 <= $s and $s <= 1 and 0 <= $v and $v <= 1) {
        $c = $v * $s;
        $x = $c * (1 - abs((fmod($h / 60, 2)) - 1));
        $m = $v - $c;

        if ($h >= 0 and $h < 60) {
            $r = $c;
            $g = $x;
            $b = 0;
        } elseif ($h >= 60 and $h < 120) {
            $r = $x;
            $g = $c;
            $b = 0;
        } else if ($h >= 120 and $h < 180) {
            $r = 0;
            $g = $c;
            $b = $x;
        } else if ($h >= 180 and $h < 240) {
            $r = 0;
            $g = $x;
            $b = $c;
        } elseif ($h >= 240 and $h < 300) {
            $r = $x;
            $g = 0;
            $b = $c;
        } else {
            $r = $c;
            $g = 0;
            $b = $x;
        }

        $r = ($r + $m) * 255;
        $g = ($g + $m) * 255;
        $b = ($b + $m) * 255;

        $hexadecimal = sprintf("#%02x%02x%02x", $r, $g, $b);

        return array(round($r), round($g), round($b), $hexadecimal);
    } else {
        return array();
    }
}
function rgbToCmyk($r, $g, $b)
{
    $r_norm = $r / 255;
    $g_norm = $g / 255;
    $b_norm = $b / 255;

    $k = 1 - max($r_norm, $g_norm, $b_norm);
    if ($k == 1) {
        $c = $m = $y = 0;
    } else {
        $c = (1 - $r_norm - $k) / (1 - $k);
        $m = (1 - $g_norm - $k) / (1 - $k);
        $y = (1 - $b_norm - $k) / (1 - $k);
    }

    $hexadecimal = sprintf("#%02x%02x%02x", $r, $g, $b);

    return array(round($c * 100), round($m * 100), round($y * 100), round($k * 100), $hexadecimal);
}

function cmykToRgb($c, $m, $y, $k)
{
    if ($c <= 0 and $m <= 0 and $y <= 0 and $k <= 0) {
        $r = $g = $b = 0;
    } else {
        $c = $c / 100;
        $m = $m / 100;
        $y = $y / 100;
        $k = $k / 100;

        $r = 255 * (1 - $c) * (1 - $k);
        $g = 255 * (1 - $m) * (1 - $k);
        $b = 255 * (1 - $y) * (1 - $k);
    }

    $hexadecimal = sprintf("#%02x%02x%02x", $r, $g, $b);

    return array(round($r), round($g), round($b), $hexadecimal);
}

function grayScale($r, $g, $b)
{
    $hexadecimal = sprintf("#%02x%02x%02x", $r, $g, $b);
    return array(round(($r + $g + $b) / 3), $hexadecimal);
}

function normalize($r, $g, $b)
{
    $r = $r / 255;
    $g = $g / 255;
    $b = $b / 255;

    $hexadecimal = sprintf("#%02x%02x%02x", $r * 255, $g * 255, $b * 255);

    return array(round($r), round($g), round($b), $hexadecimal);
}
