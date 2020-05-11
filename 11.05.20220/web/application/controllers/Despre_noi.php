<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Despre_noi extends CI_Controller {

	private $ControllerObject;

	public function __construct() {
		parent::__construct();
		// Your own constructor code

		$this->load->model('Pagini_model', '_Pagini');
		$this->load->model("Item_model", "_Item");
		$this->load->model("Object_model", "_Object");

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
			"pathimgechipa" => BASE_URL.PATH_IMG_ECHIPA,
			"breadcrumb" => array(),
			"echipa" => null,
			"texte_diverse_informativ" => null,
			"texte_diverse" => null,
			"proiecte" => null,
			"texte_diverse_texte_site" => null,
			"pagini_site" => null
		);

		$page = $this->_Pagini->GetPage("despre_noi");//getpage
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

		if($echipa = $this->_Airdrop->get_airdrops_and_images_by_air_controller_and_node_slug('echipa', 'echipa'))
		{
			$viewdata["echipa"] = $echipa;
		}

		if($texte_diverse = $this->_Airdrop->get_airdrops_and_images_by_air_controller_and_node_slug('texte_diverse', 'texte-diverse-pagina-despre-noi'))
		{
			$viewdata["texte_diverse"] = $texte_diverse;
		}

		$proiecte = $this->_Airdrop->get_all_nodes_by_parent_id(88);
		if($proiecte)
		{
			foreach($proiecte as $key_serviciu => $proiect)
			{
				$proiecte[$key_serviciu]->proiecte = $this->_Airdrop->get_airdrops_and_images_by_air_controller_and_node_slug('proiecte', $proiect->slug);
			}

			$viewdata["proiecte"] = $proiecte;
		}

		$view = (object) [ 'html' => array(
			0 => (object) ["viewhtml" => "blocuri_html/page_banner", "viewdata" => $viewdata],
			1 => (object) ["viewhtml" => "blocuri_html/page_breadcrumb", "viewdata" => null],
			2 => (object) ["viewhtml" => "pagini/page_start", "viewdata" => null],
			3 => null,
			4 => (object) ["viewhtml" => "pagini/pagina", "viewdata" => null],
			5 => (object) ["viewhtml" => "pagini/pagina_content_end", "viewdata" => null],
			6 => (object) ["viewhtml" => "pagini/page_end", "viewdata" => null],
			7 => (object) ["viewhtml" => "blocuri_html/water", "viewdata" => null],
			8 => (object) ["viewhtml" => "blocuri_html/proiecte", "viewdata" => null],
			9 => (object) ["viewhtml" => "pagini/despre_noi", "viewdata" => null],
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
