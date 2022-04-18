<?php
/*
 * Controlador da area de administração do site
 */
class Sitemapgen extends CI_Controller {
	public function __construct(){
		parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');


	}
	public function index() {

	}

	public function sitemapgenerator(){
        // create new instance
        $sitemap = new Sitemap();
        $date = Datetime::createFromFormat('Y-m-d', date('Y-m').'-01');
        $dateHome = Datetime::createFromFormat('Y-m-d', date('Y-m-d'));
        if ($dateHome->format('N') != 1) {
            $dateHome->modify('last monday');
        }
        // add items to your sitemap (url, date, priority, freq)
        $sitemap->add(base_url(), $dateHome->format('c'), '1.0', 'weekly');
        $sitemap->add(base_url('sobre-nos'), $date->format('c'), '0.8', 'monthly');
        $sitemap->add(base_url('nossa-aplicacao'), $date->format('c'), '0.8', 'monthly');
        $sitemap->add(base_url('contato'), $date->format('c'), '0.8', 'monthly');
        $sitemap->add(base_url('artigos'), $date->format('c'), '0.8', 'monthly');

        $arrArtigos = ArtigoQuery::create()->filterByAtivo(1)->filterByDataPublicacao(date('Y-m-d'), Criteria::LESS_EQUAL)->find();

//        // add multiple items with a loop
        foreach ($arrArtigos as $objArtigo)
        { /** @var $objArtigo  Artigo */
            $sitemap->add(base_url('artigo/'.$objArtigo->getSlug()), $objArtigo->getDataPublicacao(null)->format('c'), '0.6', 'weekly');
        }

        // show your sitemap (options: 'xml', 'google-news', 'sitemapindex' 'html', 'txt', 'ror-rss', 'ror-rdf')
        $sitemap->render('xml');
    }


}