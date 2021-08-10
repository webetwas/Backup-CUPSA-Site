<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search_site extends CI_Controller {

	private $ControllerObject;
	
	public function __construct() {
		parent::__construct();
		// Your own constructor code

		$this->load->model('Pagini_model', '_Pagini');
		$this->load->model("Item_model", "_Item");
		$this->load->model("Object_model", "_Object");
		$this->load->model("Airdrop_model", "_Airdrop");
		
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
			"results" => array()
		);		
		
		/*
		if($pagini_site = $this->_Pagini->get_pagini_site())
		{
			$viewdata["pagini_site"] = $pagini_site;
		}

		if($texte_diverse_texte_site = $this->_Airdrop->get_airdrops_and_images_by_air_controller_and_node_slug('texte_diverse', 'texte-site'))
		{
			$viewdata["texte_diverse_texte_site"] = $texte_diverse_texte_site;
		}		
		*/
		$search_site = $this->input->post('search_site');
		if($_GET['q']){
			$search_site_query = $_GET['q'];
			
		} else{
			$search_site_query = $this->input->post('search_site_query');
		}
		// var_dump($search_site);
		// var_dump($search_site_query);
		/*
		if(!is_null($search_site) && !is_null($search_site_query) && strlen($search_site_query) > 2)
		{
			if($results = $this->_Pagini->search_site($search_site_query))
			{
				$viewdata["results"] = $results;
			}
		}
		*/
		if(!is_null($search_site_query) && strlen($search_site_query) > 2)
		{
			if($results = $this->_Pagini->search_site($search_site_query))
			{
				//var_dump($results);die();
				if($results["fe_pages"]){
					$viewdata["fe_pages"] = $results["fe_pages"];
				}
				if($results["stiri"]){					
					$stiri = $this->_Airdrop->get_airdrops_and_images_by_air_controller_and_node_slug('stiri', 'articole');
					$viewdata["stiri"] = $stiri;
				}
				if($results["servicii"]){
					$viewdata["servicii"] = $results["servicii"];
				}
				if($results["proiecte"]){
					$viewdata["proiecte"] = $results["proiecte"];
				}
				if($results["media"]){
					$viewdata["media"] = $results["media"];
				}
				if($results["avizier"]){
					$viewdata["avizier"] = $results["avizier"];
				}
				if($results["sucursale"]){
					$viewdata["sucursale"] = $results["sucursale"];
				}
				if($results["intrebari_frecvente"]){
					$viewdata["intrebari_frecvente"] = $results["intrebari_frecvente"];
				}
				if($results["declaratii_avere"]){
					$viewdata["declaratii_avere"] = $results["declaratii_avere"];
					
					//var_dump(  $results["declaratii_avere"]);die();
				}
				$viewdata["results"] = $results;
			}
		}
		$page = $this->_Pagini->GetPage("search_site");//getpage
		if($page) $viewdata["page"] = $page;		
		
		$viewdata["breadcrumb"][] = array('text' => 'Acasa', 'href' => '/');
		$viewdata["breadcrumb"][] = array('text' => $page->p->title_ro, 'href' => '/' . $page->p->slug);	
			
		$view = (object) [ 'html' => array(
			0 => (object) ["viewhtml" => "blocuri_html/page_breadcrumb", "viewdata" => $viewdata],
		  1 => (object) ["viewhtml" => "pagini/search_site", "viewdata" => null],
		  ), 'javascript' => null
		];
		
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
