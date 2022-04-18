<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('delTree'))
{
	function delTree($dir) { 
      $files = array_diff(scandir($dir), array('.','..')); 
      foreach ($files as $file) { 
        (is_dir("$dir/$file")) ? delTree("$dir/$file") : unlink("$dir/$file"); 
      } 
      return rmdir($dir); 
    }
}

if ( ! function_exists('days_week'))
{
		function days_week($date = NULL,$datafinal = NULL){

		    $date = ($date == NULL) ? date('d/m/Y') : $date;

		    $date = explode("/", $date);
		    $dia = $date[0];
		    $mes = $date[1];
		    $ano = $date[2];
		    $data = $dia."-".$mes."-".$ano;


		    $dia_da_semana_array = array('Domingo', 'Segunda', 'Terca', 'Quarta', 'Quinta', 'Sexta', 'Sabado'); // lista
		    $meses_array = array('', 'Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'); // lista
		    $dia_da_semana_inicial = date('w', strtotime($data)); // pega o dia da semana em inteiro
		    $dia_da_semana_inicial_string = $dia_da_semana_array[$dia_da_semana_inicial];  // pega o dia da semana  em string

		    $arraySemanas = array(); // lista das semanas

		    $x = $dia_da_semana_inicial;
		    $y = 0;

		    $semana = 1;
		    while(true){

		        // insere no array
		        if(ConverteData(str_replace("-","/",$data))<=$datafinal){
			        $indexMes = (int)$mes;
			        $arraySemanas[$semana][$y]['day_week'] = str_replace("-","/",$data); 
			        $arraySemanas[$semana][$y]['day_name'] = $dia_da_semana_array[$x];
			        $arraySemanas[$semana][$y]['month_name'] = $meses_array[$indexMes];
			    }
		        // verifica se mudou o mês
		        $data = date('d-m-Y', strtotime("+1 day", strtotime($data)));
		        $dataVerifi = explode("-", $data);
		        if($dataVerifi[1] != $mes){
		            // se mudou o mes para o loop
		            break;
		        }

		        if($x == 6){
		            $x = 0;
		            $y = 0;
		            $semana++;
		        } else {
		            $x++;
		            $y++;
		        }

		    }
		    return $arraySemanas;
		}
}

if ( ! function_exists('converteData'))
{
	function converteData($data, $sep="/"){

		//Trada a data se for timestamp
		$data = explode(" ", $data);

		if(strpos($data[0], '-')){
			$d = explode("-", $data[0]);
			return $d[2].$sep.$d[1].$sep.$d[0];
		} else if(strpos($data[0], '/')) {
			$d = explode("/", $data[0]);
			return $d[2].'-'.$d[1].'-'.$d[0];
		}
	}
}

if ( ! function_exists('converteDataHora'))
{
	function converteDataHora($data, $hora=true){
		// Aqui pegamos a data, e dividimos ela em duas, usando a métodoExplode()
		$data = explode(" ", $data);
		 
		// AQUI TEMOS AS DUAS PARTES
		$data1 = $data[0]; // DATA (xxxx-xx-xx)
		$data2 = $data[1]; // HORA (xx:xx:xx)
		 
		// Agora dividimos a data em três partes, também usando o método Explode()
		$data1 = explode("-", $data1);
		 
		$dia = $data1[2]; // Retorna o dia
		$mes = $data1[1]; // Retorna o mês
		$ano = $data1[0]; // Retorna o ano
		 
		/* Como deve ter notado, dentro das variáveis existem o número de array, o 0(zero) trás o ano, 1 o mês e o 2 o dia para saber mais recomendo pesquisar sobre a função
		 
		Agora vamos formatar a data, trazemos as strings, e a hora
		Aonde dia traz a string $data1[2]
		Aonde mês traz a string $data1[1]
		Aonde ano traz a string $data1[0]
		 
		Como não precisamos "explodir" a hora trazemos ela normalmente através da string $data2
		 
		*/
		
		$data = $dia . "/" . $mes . "/" . $ano;
		
		if($hora==true)
			$data .=  " &agrave;s " . $data2;
		 
		// Retornamos o valor
		return $data;
	}
}

if ( ! function_exists('getMes'))
{
	function getMes($mes){
		$mes_extenso = array(
	        1 => 'Janeiro',
	        2 => 'Feveiro',
	        3 => 'Março',
	        4 => 'Abril',
	        5 => 'Maio',
	        6 => 'Junho',
	        7 => 'Julho',
	        8 => 'Agosto',
	        9 => 'Setembro',
	        10 => 'Outubro',
	        11 => 'Novembro',
	        12 => 'Dezembro'
	    );
		return $mes_extenso[intval($mes)];
	}
}

if (!function_exists('ConverteRealCad')) 
{
        
        /**
         * Converte a string para o formato do banco. (0,00 => 0.00)
         * @param string $valor
         */
        function ConverteRealCad($valor){
            $number = str_replace('.', '', $valor);
            $number = str_replace(',', '.', $number);
            $number = (double) $number;
            return number_format($number, 2, '.', '');
        }

}



if (!function_exists('ConverteReal')) 
{
        
        /**
         * Converte o formato do banco para string . (0.00 => 0,00)
         * @param float $valor
         */
        function ConverteReal($valor) {
        $preco = number_format($valor, 2, ',', '.');
        return $preco;
        }
        
}

if (!function_exists('ConverteRealNoDecimal'))
{

    /**
     * Converte o formato do banco para string . (0.00 => 0,00)
     * @param float $valor
     */
    function ConverteRealNoDecimal($valor) {
        $preco = number_format($valor, 0, '', '.');
        return $preco;
    }

}

if (!function_exists('onlyNumbers')) 
{
    function onlyNumbers($string) 
    {
    return intval(preg_replace ('/\D+/', '', $string));
    }
}

if (!function_exists('removerParametro')) 
{
    function removerParametro($get, $arrParam=array()) 
    {

    	foreach ($arrParam as $param) {
    		unset($get[$param]);
    	}
    	
    	return $get;
    }
}

if (!function_exists('tempoExtenso')) 
{
    function tempoExtenso($tempo) 
    {
    	$diaHora = explode('.', $tempo);
		$dias  = $diaHora[0];
		$horas = $diaHora[1];

    	
    	$arr = explode(':', $horas);

    	if ($dias <= 0) {
    		return $arr[0] > 0 ? $arr[0].' hora(s) '.$arr[1].' minuto(s)' : $arr[1].' minuto(s)';
    	}else {
    		return $dias.' dia(s)';
    	}
    }
}

if (!function_exists('unsetArrayByKey')) 
{
    function unsetArrayByKey($array, $key) 
    {
   		unset($array[$key]);

    	return $array;
    }
}

if (!function_exists('calculaBv')) 
{
    function calculaBv($valor_anuncio, $porcento_entrada, $num_parcelas, $valor_taxa) 
    {
    	if ($porcento_entrada > 0) {
   			$vlr_entrada = $valor_anuncio - ($valor_anuncio * ($porcento_entrada / 100));
    	}else{
    		$vlr_entrada = 0;
    	}
    	
   		$parcelamento = ($vlr_entrada + 2000) * $valor_taxa;

   		return array(
   			'entrada' => $vlr_entrada,
   			'parcelamento' => $parcelamento,
   			'num_parcelas' => $num_parcelas
   		);
    }
}

if (!function_exists('getConfigEmail'))
{
    function getConfigEmail()
    {

        return array(
            'telefone' => '',
            'email' => ''
        );
    }
}

if (!function_exists('baseUrlSite')) {
    function baseUrlSite($atRoot = FALSE, $atCore = FALSE, $parse = FALSE)
    {
        if (isset($_SERVER['HTTP_HOST'])) {
            $http = isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off' ? 'https' : 'http';
            $hostname = $_SERVER['HTTP_HOST'];
            $dir = str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);

            $core = preg_split('@/@', str_replace($_SERVER['DOCUMENT_ROOT'], '', realpath(dirname(__FILE__))), NULL, PREG_SPLIT_NO_EMPTY);
            $core = $core[0];

            $tmplt = $atRoot ? ($atCore ? "%s://%s/%s/" : "%s://%s/") : ($atCore ? "%s://%s/%s/" : "%s://%s%s");
            $end = $atRoot ? ($atCore ? $core : $hostname) : ($atCore ? $core : $dir);
            $base_url = sprintf($tmplt, $http, $hostname, $end);
        } else $base_url = 'http://localhost/';

        if ($parse) {
            $base_url = parse_url($base_url);
            if (isset($base_url['path'])) if ($base_url['path'] == '/') $base_url['path'] = '';
        }

        return $base_url;
    }
}

if(!function_exists('resumo')) {
    function resumo($texto, $qtdChars, $sufix = '...')
    {
        $texto = strip_tags($texto);

        if (strlen($texto) > $qtdChars) {
            $texto = substr($texto, 0, $qtdChars);

            $lastSpace = strripos($texto, ' ');

            return substr($texto, 0, $lastSpace) . $sufix;
        } else {
            return $texto;
        }
    }
}

if(!function_exists('get_dia_semana')){
    function get_dia_semana($day)
    {
        $days = array(
            'Domingo',
            'Segunda-feira',
            'Terça-feira',
            'Quarta-feira',
            'Quinta-feira',
            'Sexta-feira',
            'Sábado',
        );

        if (isset($days[$day])) {
            return $days[$day];
        }

        return '';

    }
}

if(!function_exists('get_mes_extenso')){
    function get_mes_extenso($mes)
    {
        switch ($mes)
        {
            case 1: $mes = 'Janeiro';
                break;
            case 2: $mes = 'Fevereiro';
                break;
            case 3: $mes = 'Março';
                break;
            case 4: $mes = 'Abril';
                break;
            case 5: $mes = 'Maio';
                break;
            case 6: $mes = 'Junho';
                break;
            case 7: $mes = 'Julho';
                break;
            case 8: $mes = 'Agosto';
                break;
            case 9: $mes = 'Setembro';
                break;
            case 10: $mes = 'Outubro';
                break;
            case 11: $mes = 'Novembro';
                break;
            case 12: $mes = 'Dezembro';
                break;
            default : $mes = '';
                break;
        }

        return $mes;
    }
}

if(!function_exists('getClienteLogged')) {
    /**
     * @param $session
     * @return SistemaCliente
     */
    function getClienteLogged($session)
    {
        $logged = $session->userdata('clienteLogado');

        return unserialize($logged);
    }
}

if(!function_exists('sessionTimeUpdate')) {
    function sessionTimeUpdate($session, $destroy = false)
    {
        $session->set_userdata('__ci_last_regenerate', time());
    }
}

if(!function_exists('hasClienteLogged')) {
    function hasClienteLogged($session, $redirect = false)
    {
        $logged = $session->userdata('clienteLogado');

        if (!isset($logged) || is_null($logged)) {
            if($redirect){
                redirect(base_url()."clientes/login");
                die();
            }
            return false;

        } else {
            sessionTimeUpdate($session);
        }

        return true;
    }
}

if(!function_exists('doLogout')) {
    function doLogout($session)
    {
        $session->unset_userdata('clienteLogado');
    }
}

if(!function_exists('validarCPF')) {
    function validarCPF($cpf)
    {
        // Extrair somente os números
        $cpf = preg_replace('/[^0-9]/is', '', $cpf);

        // Verifica se foi informado todos os digitos corretamente
        if (strlen($cpf) != 11) {
            return false;
        }
        // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }
        // Faz o calculo para validar o CPF
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c]  * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }
        return true;
    }
}

if(!function_exists('validarCNPJ')) {
    function validarCNPJ($cnpj)
    {
        $cnpj = preg_replace('/[^0-9]/', '', (string) $cnpj);

        // Valida tamanho
        if (strlen($cnpj) != 14)
            return false;
        // Verifica se todos os digitos são iguais
        if (preg_match('/(\d)\1{13}/', $cnpj))
            return false;
        // Valida primeiro dígito verificador
        for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++)
        {
            $soma += $cnpj[$i] * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }
        $resto = $soma % 11;
        if ($cnpj[12] != ($resto < 2 ? 0 : 11 - $resto))
            return false;
        // Valida segundo dígito verificador
        for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++)
        {
            $soma += $cnpj[$i] * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }
        $resto = $soma % 11;

        return $cnpj[13] == ($resto < 2 ? 0 : 11 - $resto);
    }
}

if(!function_exists('stripslashes_gpc')){
    function stripslashes_gpc(&$value)
    {
        $value = stripslashes($value);
    }
}

if(!function_exists('get_telefone_ddd')){
    function get_telefone_ddd($tel, $formatar = false){

        if ($tel) {
            $arr = explode(' ', $tel);
            if (count($arr) > 0) {
                if($formatar) {
                    return preg_replace('/[^\d]/', '', $arr[0]);
                } else {
                    return $arr[0];
                }
            }
        }
        return '';

    }
}

if(!function_exists('get_telefone_sem_ddd')){
    function get_telefone_sem_ddd($tel, $formatar = false){

        if ($tel) {
            $arr = explode(' ', $tel);
            if (count($arr) > 1) {
                if($formatar) {
                    return preg_replace('/[^\d]/', '', $arr[1]);
                } else {
                    return $arr[1];
                }
            }
        }
        return '';

    }
}

if(!function_exists('format_data')){
    function format_data($data, $type)
    {
        switch ($type)
        {
            case 'ING' :
                {
                    $partes = explode('/', $data);
                    $retorno = $partes[2] . '-' . $partes[1] . '-' . $partes[0];
                } break;

            case 'POR' :
                {
                    $partes = explode('-', $data);
                    $retorno = $partes[0] . '-' . $partes[1] . '-' . $partes[2];
                } break;
        }

        return $retorno;
    }
}

if(!function_exists('data_mysql')){
    function data_mysql($strData, $boolValidar = true)
    {
        $strRet = '';
        $arrPartes = preg_split('![/-]!', $strData);
        if (count($arrPartes) == 3)
        {
            if (!$boolValidar || checkdate($arrPartes[1], $arrPartes[0], $arrPartes[2]))
            {
                $strRet = sprintf('%s-%s-%s', $arrPartes[2], $arrPartes[1], $arrPartes[0]);
            }
        }
        return $strRet;
    }
}

if(!function_exists('get_hours_range')) {
    function get_hours_range($start = 0, $end = 86400, $step = 3600, $format = 'g:i a')
    {
        $times = array();
        foreach (range($start, $end, $step) as $timestamp) {
            $hour_mins = gmdate('H:i', $timestamp);
            if (!empty($format))
                $times[] = gmdate($format, $timestamp);
            else $times[] = $hour_mins;
        }
        return $times;
    }
}

if(!function_exists('timeToSeconds')) {
    function timeToSeconds($dateTime) {

        $seconds = 0;
        $seconds += $dateTime->format('H') * 3600;
        $seconds += $dateTime->format('i') * 60;
        $seconds += $dateTime->format('s');

        return $seconds;

    }
}

if(!function_exists('isLocalhostManual')) {
    function isLocalhostManual($whitelist = ['127.0.0.1', '::1']) {
        return in_array($_SERVER['REMOTE_ADDR'], $whitelist);
    }
}

if(!function_exists('resizeImage')) {
    function resizeImage($image, $imageWidth = 0, $imageHeight = 0, $imageCropratio = 0, $imageQuality = 90, $force = false)
    {
        $imagePath = $image;

        if (!file_exists($imagePath)) {
            return false;
        }


        $imageCache = $imageWidth . 'x' . $imageHeight . 'x' . $imageQuality;
        if ($imageCropratio !== 0) {
            $imageCache .= 'x' . (string)$imageCropratio;
        }

        $imageCache .= '-' . $imagePath;

        $imageMD5 = md5($imageCache);

        $pathImageMD5 = CACHE_DIR . $imageMD5;


        // Verifico se jÃ¡ foi gerado cache para a imagem, caso sim, apenas retorno o caminho deste cache
        if (file_exists($pathImageMD5)) {

            if ($force == false) {
                return base_url() . $pathImageMD5;
            } else {
                unlink($pathImageMD5);
            }
        }

        // Recupero o MIME Type da imagem
//    $size = getimagesize($imagePath);

        $data = file_get_contents($imagePath);
        $size = getimagesizefromstring($data);


        $mime = $size['mime'];

        // Verifico se $image Ã© realmente uma imagem
        if (substr($mime, 0, 6) != 'image/') {
            return false;
        }

        $width = $size[0];
        $height = $size[1];

        $maxWidth = $imageWidth;
        if ($maxWidth == 0) {
            $maxWidth = ($width * $imageHeight) / $height;
        }

        $maxHeight = $imageHeight;
        if ($maxHeight == 0) {
            $maxHeight = ($height * $imageWidth) / $width;
        }

        if ($maxWidth == 0) {
            $maxWidth = $width;
        }
        if ($maxHeight == 0) {
            $maxHeight = $height;
        }

        $poswidth = 50;
        $posheight = 50;

        /*
         * Se os redimensionamentos da imagem forem menores que as dimensões
         * de redimensionamento, apenas retornamos o caminho da imagem$posheight
         */
        if ($maxWidth >= $width && $maxHeight >= $height) {
            return base_url() . $imagePath;
        }

        // Crop Ratio
        $offsetX = 0;
        $offsetY = 0;

        if ($imageCropratio !== 0) {
            $cropRatio = explode(':', (string)$imageCropratio);
            if (count($cropRatio) == 2) {
                $ratioComputed = $width / $height;
                $cropRatioComputed = (float)$cropRatio[0] / (float)$cropRatio[1];

                if ($ratioComputed < $cropRatioComputed) { // Imagem Ã© muito alta, cortamos em cima e em baixo
                    $origHeight = $height;
                    $height = $width / $cropRatioComputed;
                    $offsetY = ($posheight > 0) ? ($origHeight - $height) / (100 / $posheight) : 0;
                } else if ($ratioComputed > $cropRatioComputed) { // Imagem Ã© muito larga, cortamos as laterais
                    $origWidth = $width;
                    $width = $height * $cropRatioComputed;
                    $offsetX = ($poswidth > 0) ? ($origWidth - $width) / (100 / $poswidth) : 0;
                }
            }
        }

        $xRatio = $maxWidth / $width;
        $yRatio = $maxHeight / $height;

        if ($xRatio * $height < $maxHeight) {
            $tnHeight = ceil($xRatio * $height);
            $tnWidth = $maxWidth;
        } else {
            $tnWidth = ceil($yRatio * $width);
            $tnHeight = $maxHeight;
        }

        // Qualidade da imagem
        $quality = $imageQuality;

        // Nome da imagem
//    $resizedImageSource = $tnWidth . 'x' . $tnHeight . 'x' . $ecommerce;
//
//    if ($imageCropratio !== 0) {
//        $resizedImageSource .= 'x' . (string) $imageCropratio;
//    }
//
//    $resizedImageSource .= '-' . $imagePath;
//    $resizedImage = md5($resizedImageSource);
//    $resized = CACHE_DIR . $resizedImage;

        $resizedImage = $imageMD5;
        $resized = $pathImageMD5;


        // Crio uma imagem padrÃ£o com o novo tamanho
        $dst = imagecreatetruecolor($tnWidth, $tnHeight);

        // Seto as caracterÃ­sticas da imagem de acordo com o MIME Type
        switch ($size['mime']) {
            case 'image/gif':
                $creationFunction = 'ImageCreateFromGif';
                $outputFunction = 'ImagePng';
                $mime = 'image/png';
                $doSharpen = FALSE;
                $quality = round(10 - ($quality / 10));
                break;
            case 'image/x-png':
            case 'image/png':
                $creationFunction = 'ImageCreateFromPng';
                $outputFunction = 'ImagePng';
                $doSharpen = FALSE;
                $quality = round(10 - ($quality / 10));
                break;
            default:
                $creationFunction = 'ImageCreateFromJpeg';
                $outputFunction = 'ImageJpeg';
                $doSharpen = TRUE;
                break;
        }

        // Lemos a imagem original
        $src = $creationFunction($image);

        // Seto a transparÃªncia de fundo para arquivos gif e png
        if (in_array($size['mime'], array('image/gif', 'image/png'))) {
            imagealphablending($dst, false);
            imagesavealpha($dst, true);
        }

        // Copio a imagem com as novas dimensÃµes
        ImageCopyResampled($dst, $src, 0, 0, $offsetX, $offsetY, $tnWidth, $tnHeight, $width, $height);

        if ($doSharpen) {
            $sharpness = findSharp($width, $tnWidth);

            $sharpenMatrix = array(
                array(-1, -2, -1),
                array(-2, $sharpness + 12, -2),
                array(-1, -2, -1)
            );
            $divisor = $sharpness;
            $offset = 0;
            imageconvolution($dst, $sharpenMatrix, $divisor, $offset);
        }

        // Verifico se a pasta de cache existe, se nÃ£o existir, crio esta pasta
        if (!file_exists(CACHE_DIR))
            mkdir(CACHE_DIR, 0755);

        // Verifico se tenho permissÃ£o para gravar na pasta
        if (!is_writable(CACHE_DIR)) {
            return false;
        }

        // Salvo a imagem redimensionada na pasta de cache
        $outputFunction($dst, $resized, $quality);

        // Limpo a memÃ³ria
        ImageDestroy($src);
        ImageDestroy($dst);



        // Retorno o caminho da imagem
        return base_url() . CACHE_DIR . $resizedImage;
    }
}

if(!function_exists('findSharp')) {
    function findSharp($orig, $final)
    { // function from Ryan Rud (http://adryrun.com)
        $final = $final * (750.0 / $orig);
        $a = 52;
        $b = -0.27810650887573124;
        $c = .00047337278106508946;

        $result = $a + $b * $final + $c * $final * $final;

        return max(round($result), 0);
    }
}

if(!function_exists('plurals')){
    function plurals($num, $singular, $plural)
    {
        if ($num > 1)
        {
            return sprintf($plural, $num);
        }
        return sprintf($singular, $num);
    }
}


if(!function_exists('isNaN')){
    function isNaN($value)
    {
        if (is_null($value) || empty(trim($value)))
        {
            return true;
        }
        return false;
    }
}

if(!function_exists('parametersFiltersRequest')){
    function parametersFiltersRequest()
    {
        if (@get_magic_quotes_gpc())
        {
            function stripslashes_gpc(&$value)
            {
                $value = stripslashes($value);
            }
            array_walk_recursive($_GET, 'stripslashes_gpc');
            array_walk_recursive($_POST, 'stripslashes_gpc');
            array_walk_recursive($_COOKIE, 'stripslashes_gpc');
            array_walk_recursive($_REQUEST, 'stripslashes_gpc');
        }
    }
}
if(!function_exists('hyphenize')){
    function hyphenize($string) {
        return
            ## strtolower(
            preg_replace(
                array('#[\\s-]+#', '#[^A-Za-z0-9. -]+#'),
                array('-', ''),
                ##     cleanString(
                urldecode($string)
            ##     )
            )
            ## )
            ;
    }
}

if(!function_exists('stripAccents')){
    function stripAccents($stripAccents){
        return iconv('UTF-8', 'ASCII//TRANSLIT', $stripAccents);;
    }
}