<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('asset_url()'))
{
    function asset_url($baseUrl = true)
    {
        if($baseUrl)
            return base_url().'assets/';
        else
            return 'assets/';

    }
}

if ( ! function_exists('asset_url_css()'))
{
    function asset_url_css($archive = '', $baseUrl = true)
    {

        if($baseUrl)
            $link = base_url().'assets/css/';
        else
            $link = 'assets/css/';
        if(!empty($archive)){
            $link .=  $archive;
        }
        return $link;
    }
}

if ( ! function_exists('asset_url_js()'))
{
    function asset_url_js($archive = '', $baseUrl = true)
    {

        if($baseUrl)
            $link = base_url().'assets/js/';
        else
            $link = 'assets/js/';
        if(!empty($archive)){
            $link .=  $archive;
        }
        return $link;
    }
}

if ( ! function_exists('asset_url_images()'))
{
    function asset_url_images($archive = '', $baseUrl = true)
    {

        if($baseUrl)
            $link = base_url().'assets/img/';
        else
            $link = 'assets/img/';
        if(!empty($archive)){
            $link .=  $archive;
        }
        $linkConverterWebp = webpValidation('assets/img/'.$archive);
        if (!isNaN($linkConverterWebp)) {
            $link = $linkConverterWebp;
        }

        return $link;
    }
}


if ( ! function_exists('asset_url_images_without_webp'))
{
    function asset_url_images_without_webp($archive = '', $baseUrl = true)
    {

        if($baseUrl)
            $link = base_url().'assets/img/';
        else
            $link = 'assets/img/';
        if(!empty($archive)){
            $link .=  $archive;
        }

        return $link;
    }
}

if ( ! function_exists('asset_url_fonts()'))
{
    function asset_url_fonts($archive = '', $baseUrl = true)
    {

        if($baseUrl)
            $link = base_url().'assets/fonts/';
        else
            $link = 'assets/fonts/';
        if(!empty($archive)){
            $link .=  $archive;
        }
        return $link;
    }
}

if ( ! function_exists('asset_url_videos()'))
{
    function asset_url_videos($archive = '', $baseUrl = true)
    {

        if($baseUrl)
            $link = base_url().'assets/video/';
        else {
            $link = 'assets/video/';
        }
        if(!empty($archive)){
            $link .=  $archive;
        }
        return $link;
    }
}
if ( ! function_exists('asset_url_vendor()'))
{
    function asset_url_vendor($archive = '', $baseUrl = true)
    {

        if($baseUrl)
            $link = base_url().'assets/vendor/';
        else {
            $link = 'assets/vendor/';
        }
        if(!empty($archive)){
            $link .=  $archive;
        }
        return $link;
    }
}

if ( ! function_exists('uploads_url()'))
{
    function uploads_url($archive = '', $baseUrl = true)
    {
        if($baseUrl)
            $link = base_url().'uploads/';
        else {
            $link = 'uploads/';
        }
        if(!empty($archive)){
            $link .=  $archive;
        }
        return $link;
    }
}

if ( ! function_exists('webpValidation')) {
    function webpValidation($file, $compression_quality = 95)
    {

        $link = null;
        $file = str_replace(base_url(),'',$file);
        if (!isNaN($file) && file_exists($file) && exif_imagetype($file) != IMAGETYPE_WEBP) {
            if(file_exists($file.'.webp')) {
                $link = base_url().$file.'.webp';
            } else {
                $link = base_url().webpConvert2($file, $compression_quality);
            }
        } else {
            if(file_exists($file.'.webp')) {
                $link = base_url().$file.'.webp';
            }
        }
        return $link;
    }
}

if ( ! function_exists('webpConvert2()')) {
    function webpConvert2($file, $compression_quality = 95)
    {
        // check if file exists
        if (!file_exists($file)) {
            return false;
        }
        $file_type = exif_imagetype($file);
        //https://www.php.net/manual/en/function.exif-imagetype.php
        //exif_imagetype($file);
        // 1    IMAGETYPE_GIF
        // 2    IMAGETYPE_JPEG
        // 3    IMAGETYPE_PNG
        // 6    IMAGETYPE_BMP
        // 15   IMAGETYPE_WBMP
        // 16   IMAGETYPE_XBM
        $output_file = $file . '.webp';
        if (file_exists($output_file)) {
            return $output_file;
        }
        if (function_exists('imagewebp')) {
            switch ($file_type) {
                case '1': //IMAGETYPE_GIF
                    $image = imagecreatefromgif($file);
                    break;
                case '2': //IMAGETYPE_JPEG
                    $image = imagecreatefromjpeg($file);
                    break;
                case '3': //IMAGETYPE_PNG
                    $image = imagecreatefrompng($file);
                    imagepalettetotruecolor($image);
                    imagealphablending($image, true);
                    imagesavealpha($image, true);
                    break;
                case '6': // IMAGETYPE_BMP
                    $image = imagecreatefrombmp($file);
                    break;
                case '15': //IMAGETYPE_Webp
                    return false;
                    break;
                case '16': //IMAGETYPE_XBM
                    $image = imagecreatefromxbm($file);
                    break;
                default:
                    return false;
            }
            // Save the image
            $result = imagewebp($image, $output_file, $compression_quality);
            if (false === $result) {
                return false;
            }
            // Free up memory
//            imagedestroy($image);
            return $output_file;
        } elseif (class_exists('Imagick')) {
            $image = new Imagick();
            $image->readImage($file);
            if ($file_type === "3") {
                $image->setImageFormat('webp');
                $image->setImageCompressionQuality($compression_quality);
                $image->setOption('webp:lossless', 'true');
            }
            $image->writeImage($output_file);
            return $output_file;
        }
        return false;
    }
}
if ( ! function_exists('isBoolean')) {
    function isBoolean($v)
    {

        if (!is_string($v)) return (bool) $v;

        switch (strtolower($v)) {
            case '1':
            case 'true':
            case 'on':
            case 'yes':
            case 'y':
            case '0':
            case 'false':
            case 'off':
            case 'no':
            case 'n':
                return true;
            default:
                return false;
        }
    }
}
if ( ! function_exists('toBoolean')) {
    function toBoolean($v)
    {
//        if (!isset($v)) return null;
//        return filter_var($v, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);

        if (!is_string($v)) return (bool) $v;

        switch (strtolower($v)) {
            case '1':
            case 'true':
            case 'on':
            case 'yes':
            case 'y':
                return true;
            case '0':
            case 'false':
            case 'off':
            case 'no':
            case 'n':
                return false;
        }
    }
}
//function toBool($var) {

//}