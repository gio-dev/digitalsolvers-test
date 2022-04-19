<?php
/*
 * Controlador da area de administração do site
 */
class Sistema extends CI_Controller {
	public function __construct(){
		parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');

	}
	public function index() {

	}

	public function perguntas(){
	    $posts = $_POST;
	    if(is_array($posts) && count($posts) > 0){
	        $arrValues = [];
            foreach ($posts as $post){
                if(is_array($post) || !isBoolean($post)){
                    $this->session->set_flashdata('error', 'Valor da resposta não é valido, valor diferente de sim/não');
                    break;
                }
                $arrValues[] = $post;
            }

            if(count($posts) == count($arrValues) && count($arrValues) == 6){
                $objResposta = new Respostas();
                $objResposta->setIp($this->input->ip_address());
                $objResposta->setSessionId(session_id());
                $objResposta->setRespostas(join(',', $arrValues));
                $objResposta->save();
                session_regenerate_id();
                $results = [];
                $resultsSimple = [];
                if(!toBoolean($arrValues[0]) && !toBoolean($arrValues[3]) && !toBoolean($arrValues[4])){
                    $results[] = 'Resultado A alcançado!';
                    $resultsSimple[] = 'A';
                }
                if(
                    toBoolean($arrValues[0]) && toBoolean($arrValues[1]) && toBoolean($arrValues[2])
                    && toBoolean($arrValues[3]) && toBoolean($arrValues[4]) && toBoolean($arrValues[5])
                ){
                    $results[] = 'Resultado C Alcançado!';
                    $resultsSimple[] = 'C';
                }
                if(
                    !toBoolean($arrValues[0]) && !toBoolean($arrValues[1]) && !toBoolean($arrValues[2])
                    && !toBoolean($arrValues[3]) && !toBoolean($arrValues[4]) && !toBoolean($arrValues[5])
                ){
                    $results[] = 'Resultado B Alcançado!';
                    $resultsSimple[] = 'B';
                }
                if(count($results) > 0){
                    $objResposta->setResultados(join(',',$resultsSimple));
                    $objResposta->save();
                    $this->session->set_flashdata('success', $results);

                } else {
                    $this->session->set_flashdata('info', 'Informações enviadas com sucesso mas nenhum resultado foi alcançado, tente novamente.');
                }
            } else {
                $this->session->set_flashdata('error', 'Quantidade de valores não bate com a quantidade de dados enviados ou com a quantidade exigida pelo sistema.');
            }
        } else {
            $this->session->set_flashdata('error', 'Informações enviadas não estão no padrão solicitado, tente novamente ou contacte o administrador do sistema');
        }
        redirect('/');
    }

}