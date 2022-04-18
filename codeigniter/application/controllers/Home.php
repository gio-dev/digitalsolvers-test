<?php
/*
 * Controlador da area de administração do site
 */
class Home extends CI_Controller {
	public function __construct(){
		parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');

	}
	public function index() {
        $data['titulo'] = 'Home';
        $data['breadcrumbs'] = [
            'Home' => base_url()
        ];
        $data['botao'] = 'add';
        $data['arrPerguntas'] = PerguntasQuery::create()->limit(6)->find();
        $this->template->load('template', 'home', $data);
	}

}