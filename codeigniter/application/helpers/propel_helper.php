<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('propel_init_ci')) {
    function propel_init_ci()
    {
        try{
            Propel::init(APPPATH . 'models/propel/build/conf/sitedefault-conf.php');
        } catch (Exception $e){

        }

        set_include_path(APPPATH . 'models/propel/build/classes' . PATH_SEPARATOR . get_include_path());
    }
}
propel_init_ci();