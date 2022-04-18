<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Thumbs
{
	protected $ci;

	public function __construct()
	{
		$this->indisponivel = "imagens/imagem_indisponivel.png";
		$this->_CI =& get_instance();
    	$this->_CI->load->library("Image_moo");
	}


	public function criarThumb($path, $img, $w=305, $h=268, $crop=true){

		if (!file_exists($path)) {
		    mkdir($path, 0777);
		}

		$origFile = $path.$img;
		$filePath = $path.'thumbs/'.$w.'x'.$h.'-'.$img;

		if (!$crop) {
    		$this->_CI->image_moo->load($origFile)->set_jpeg_quality(100)->set_background_colour("#FFF")->resize($w,$h, true)->save($filePath);
		}else{
    		$this->_CI->image_moo->load($origFile)->set_background_colour("#fff")->set_jpeg_quality(100)->resize_crop($w,$h)->save($filePath);
		}

    	if ($this->_CI->image_moo->errors){
    		print $this->_CI->image_moo->display_errors();
    	}else{
    		return true;
    	}
	}

	public function getThumb($path, $img, $tamanho){
		$arquivo = $path.'thumbs/'.$tamanho."-".$img;

		if(file_exists($arquivo)){
			$img = $arquivo;
		}else{
			$img = "media/img/".$tamanho."-img-indisponivel.jpg";
		}

		return $img;
	}
}