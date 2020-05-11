<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Intrebari_frecvente extends CI_Controller {

	private $ControllerObject;
	
	public function __construct() {
		parent::__construct();
		// Your own constructor code

		$this->load->model('Pagini_model', '_Pagini');
		$this->load->model("Item_model", "_Item");
		$this->load->model("Object_model", "_Object");
		
		$this->ControllerObject = $this->_Object->getObjectStructure("proiecte");
	}

	/**
	 * [Index]
	 * @return [type] [description]
	 */
	public function index()
	{
		$viewdata = array(
			"page" => null,
			"pathimgpage" => BASE_URL.PATH_IMG_PAGINA,
			"breadcrumb" => array(),
			"pagini_site" => null,
			"texte_diverse_texte_site" => null,
			"intrebari_frecvente" => null,
			"texte_diverse_texte_site" => null,
			"pagini_site" => null
		);		
		
		// if($pagini_site = $this->_Pagini->get_pagini_site())
		// {
			// $viewdata["pagini_site"] = $pagini_site;
		// }

		if($texte_diverse_texte_site = $this->_Airdrop->get_airdrops_and_images_by_air_controller_and_node_slug('texte_diverse', 'texte-site'))
		{
			$viewdata["texte_diverse_texte_site"] = $texte_diverse_texte_site;
		}

		if($intrebari_frecvente = $this->_Airdrop->get_airdrops_and_images_by_air_controller_and_node_slug('intrebari_frecvente', 'intrebari-frecvente'))
		{
			$viewdata["intrebari_frecvente"] = $intrebari_frecvente;
		}		
		
		$page = $this->_Pagini->GetPage("intrebari_frecvente");//getpage
		if($page) $viewdata["page"] = $page;

		if($texte_diverse_texte_site = $this->_Airdrop->get_airdrops_and_images_by_air_controller_and_node_slug('texte_diverse', 'texte-site'))
		{
			$viewdata["texte_diverse_texte_site"] = $texte_diverse_texte_site;
		}
		
		if($pagini_site = $this->_Pagini->get_pagini_site_assoc_three($page->p->atom_id))
		{
			// var_dump($pagini_site);
			
			// echo '<pre>';
			// print_r($pagini_site);
			// echo '</pre>';
			// die();
			$viewdata["pagini_site"] = $pagini_site;
		}		
		
		$viewdata["breadcrumb"][] = array('text' => 'Acasa', 'href' => '/');
		$viewdata["breadcrumb"][] = array('text' => $page->p->title_ro, 'href' => '/' . $page->p->slug);	
			
		$view = (object) [ 'html' => array(
			
			0 => (object) ["viewhtml" => "blocuri_html/page_banner", "viewdata" => $viewdata],
			1 => (object) ["viewhtml" => "blocuri_html/page_breadcrumb", "viewdata" => null],
			2 => (object) ["viewhtml" => "pagini/page_start", "viewdata" => null],
			3 => null,
			4 => (object) ["viewhtml" => "pagini/pagina", "viewdata" => null],
			5 => (object) ["viewhtml" => "pagini/intrebari_frecvente", "viewdata" => null],
			6 => (object) ["viewhtml" => "pagini/pagina_content_end", "viewdata" => null],
			7 => (object) ["viewhtml" => "pagini/page_end", "viewdata" => null],
			
		  ), 'javascript' => null
		];
		
		if($page->s->left_sidebar)
		{
			$view->html[3] = (object) ["viewhtml" => "pagini/sidebar_left", "viewdata" => null];
			$view->javascript = array((object) ["viewhtml" => "pagini/js_pagina", "viewdata" => null]);
		}
		
		$this->frontend->page_id = $page->p->id_page;
		$this->frontend->slider = false;
		$this->frontend->render($view,
			array(
				"title_browser_ro" => $page->p->title_browser_ro,
				"meta_description" => $page->p->meta_description,
				"keywords" => $page->p->keywords
			)
		);
	}
}
