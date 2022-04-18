<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * SEO Helper
 *
 * Generates Meta tags for search engines optimizations, open graph, twitter, robots
 *
 * @author		Elson Tan (elsodev.com, Twitter: @elsodev)
 * @version     1.0
 */

/**
 * SEO General Meta Tags
 *
 * Generates general meta tags for description, open graph, twitter, robots
 * Using title, description and image link from config file as default
 *
 * @access  public

 * @param   string  Title
 * @param   string  Description (155 characters)
 * @param   string  Image URL
 * @param   string  Page URL
 * @param   string  Keywords of Page
 * @param   array   enable/disable different meta by setting true/false
 *
 */

if(! function_exists('meta_tags')){
    function
    meta_tags($title = '', $desc = '',  $imgurl ='', $url = '', $keywords = '', $enable = array('og'=> true, 'twitter'=> true, 'gplus'=> true,'robot'=> true)){

        $output = '';

        //uses default set in seo_config.php
        if($title == ''){
            $title = TITLE;
        }
        if($desc == ''){
            $desc = DESCRIPTION;
        }
        if($imgurl == ''){
            $imgurl = LOGO_META;
        }
        if($keywords == ''){
            $keywords = KEYWORDS;
        } else {
            $keywords .= ', '.KEYWORDS;
        }
        if($url == ''){
            $url = BASE_URL_META;
        }

        $output .= '<meta charset="utf-8">';
        $output .= '<meta http-equiv="X-UA-Compatible" content="IE=edge">';
        $output .= '<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0">';


        $output .= '<title>'.$title.'</title>';
        $output .= '<meta name="description" content="'.$desc.'" />';
        $output .= '<meta name="keywords" content="'.$keywords.'" />';
        $output .= '<meta name="author" content="'.AUTHOR.'" />';
        $output .= '<meta name="theme-color" content="'.THEME_COLOR.'" />';
        $output .= '<meta name="apple-mobile-web-app-status-bar-style" content="'.THEME_COLOR.'" />';
        $output .= '<meta name="msapplication-navbutton-color" content="'.THEME_COLOR.'" />';
        $output .= '<link rel="shortcut icon" type="image/jpg" href="'.FAVICON.'" />';
        $output .= '<link rel="apple-touch-icon" href="'.FAVICON.'" />';
        $output .= '<link rel="canonical" href="'.$url.'" />';
        $output .= '<meta name="msapplication-TileImage" content="'.$imgurl.'">';


        if($enable['robot']){
            $output .= '<meta name="robots" content="index,follow"/>';

        } else {
            $output .= '<meta name="robots" content="noindex,nofollow"/>';
        }


        //open graph
        if($enable['og']){
            $output .= '<meta property="og:type" content="'.MODEL.'"/>'
                .'<meta property="og:site_name" content="'.$title.'"/>'
                .'<meta property="og:title" content="'.$title.'"/>'
                .'<meta property="og:description" content="'.$desc.'"/>'
                .'<meta property="og:image" content="'.$imgurl.'"/>'
                .'<meta property="og:image:url" content="'.$imgurl.'"/>'
                .'<meta property="og:image:secure" content="'.$imgurl.'"/>'
                .'<meta property="og:image:alt" content="'.$title.'"/>'
                .'<meta property="og:url" content="'.$url.'"/>'
                .'<meta property="og:locale" content="pt_BR">'
                .'<meta property="og:image:width" content="600">'
                .'<meta property="og:image:height" content="600">'
                .'<meta property="og:image:type" content="image/jpeg">'
            ;

        }

        //twitter card
        if($enable['twitter']){
            $output .=
                 '<meta name="twitter:card" content="summary"/>'
                .'<meta name="twitter:site" content="'.$title.'"/>'
                .'<meta name="twitter:creator" content="'.AUTHOR.'"/>'
                .'<meta name="twitter:title" content="'.$title.'"/>'
                .'<meta name="twitter:url" content="'.$url.'"/>'
                .'<meta name="twitter:description" content="'.$desc.'"/>'
                .'<meta name="twitter:image" content="'.$imgurl.'"/>';
        }

        if($enable['gplus']){
            $output .=
                ' <meta itemprop="name" content="'.$title.'"/>'
                .'<meta itemprop="description" content="'.$desc.'"/>'
                .'<meta itemprop="image" content="'.$imgurl.'"/>'
                .'<meta itemprop="url" content="'.$url.'"/>';
        }

        return $output;


    }
}