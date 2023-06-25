
    <?php
    session_start();



    $text = rand(1111111, 9999999);

    $_SESSION['captcha'] = $text;

    $height = 25;
    $width = 85;

    $image_p = imagecreate($width, $height);

    $black = imagecolorallocate($image_p, 0, 0, 0);

    $white = imagecolorallocate($image_p, 255, 255, 255);

    //Lines
    $line_color = imagecolorallocate($image_p, 64, 64, 64);
    for ($i = 0; $i < 10; $i++) {
        imageline($image_p, 0, rand() % 50, 200, rand() % 50, $line_color);
    }


    //Dots
    $pixel_color = imagecolorallocate($image_p, 0, 0, 255);
    for ($i = 0; $i < 1000; $i++) {
        imagesetpixel($image_p, rand() % 200, rand() % 50, $pixel_color);
    }

    $font_size = 14;

    imagestring($image_p, $font_size, 5, 5, $text, $white);

    imagejpeg($image_p, 'new.jpg');

    //phpinfo();

    ?>
