<?php
session_start();
function secureRandom($length = 5) {
    $str = bin2hex(openssl_random_pseudo_bytes($length));
    return strtoupper(substr(base_convert($str, 16, 35), 0, $length));
}

header('Content-Type: image/png');
$captcha = imagecreatefromjpeg('images/captcha2.jpg');
$captchaValue = secureRandom();
$_SESSION['captchaVal'] = $captchaValue;

$captchaArray = str_split($captchaValue);
$font = 'fonts/angelina.ttf';
$posX = 26;
$posY = 50;
$size = 44;

foreach ($captchaArray as $chara) {
    $colorTxt = imagecolorallocate($captcha, rand(0, 255), rand(0, 255), rand(0, 255));


    imagettftext($captcha, $size, rand(-50, 50), $posX, $posY, $colorTxt, $font, $chara);
    $posX += $size;
}

imagepng($captcha);
imagedestroy($captcha);
