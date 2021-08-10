<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Investitii extends CI_Controller {

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
			"breadcrumb" => array(),
			"proiecte" => null,
			"texte_diverse_texte_site" => null,
			"pagini_site" => null
		);
		
		$page = $this->_Pagini->GetPage("investitii");//getpage
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
		
		$proiecte = $this->_Airdrop->get_all_nodes_by_parent_id(88);
		if($proiecte)
		{
			foreach($proiecte as $key_serviciu => $proiect)
			{
				$proiecte[$key_serviciu]->proiecte = $this->_Airdrop->get_airdrops_and_images_by_air_controller_and_node_slug('proiecte', $proiect->slug);
			}
			
			$viewdata["proiecte"] = $proiecte;
		}

		$viewdata["breadcrumb"][] = array('text' => 'Acasa', 'href' => '/');
		$viewdata["breadcrumb"][] = array('text' => $page->p->title_ro, 'href' => '/' . $page->p->slug);
		
		$view = (object) [ 'html' => array(
			
			0 => (object) ["viewhtml" => "blocuri_html/page_banner", "viewdata" => $viewdata],
			1 => (object) ["viewhtml" => "blocuri_html/page_breadcrumb", "viewdata" => null],
			2 => (object) ["viewhtml" => "pagini/page_start", "viewdata" => null],
			3 => null,
			4 => (object) ["viewhtml" => "pagini/pagina", "viewdata" => null],
			5 => (object) ["viewhtml" => "pagini/proiecte", "viewdata" => null],
			6 => (object) ["viewhtml" => "blocuri_html/proiecte", "viewdata" => null],
			7 => (object) ["viewhtml" => "pagini/pagina_content_end", "viewdata" => null],
			8 => (object) ["viewhtml" => "pagini/page_end", "viewdata" => null],
			
			
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
	
	public function proiect($slug)
	{
		$viewdata = array(
			"page" => null,
			"pathimgpage" => BASE_URL.PATH_IMG_PAGINA,
			"breadcrumb" => array(),
			"texte_diverse_texte_site" => null,
			"pagini_site" => null,
			"proiect" => null
		);
		$page = $this->_Pagini->GetPage("investitii");//getpage
		if($page) $viewdata["page"] = $page;
		
		if($proiect = $this->_Item->msqlGetAndImages('proiecte', array('c' => 'slug', 'v' => trim($slug))))
		{
			$viewdata["proiect"] = $proiect;
		}
		else {
			show_404();
			exit();
		}
	
		if($pagini_site = $this->_Pagini->get_pagini_site_assoc_three_by_proiect($proiect->atom_id))
		{
			// var_dump($pagini_site);
			
			// echo '<pre>';
			// print_r($pagini_site);
			// echo '</pre>';
			// die();
			$viewdata["pagini_site"] = $pagini_site;
		}	
		/*Get breadcrumbs*/
		$dynamic_breadcrumbs = $this->_Item->msqlGetAll('breadcrumbs_proiecte', array("idpage" => $proiect->atom_id));
		$breacrumbs=array();
		$i=0;
		if(!empty($dynamic_breadcrumbs)) {
			foreach($dynamic_breadcrumbs as $key=>$row){
				$breacrumb_pages = $this->_Item->msqlGetAll('fe_pages', array("atom_id" => $row->idpageassoc));			
				foreach($breacrumb_pages as $key=>$row){				
					$breacrumbs[$i][slug] = $row->slug;
					$breacrumbs[$i][atom_name_ro] = $row->atom_name_ro;
					$i++;
				}
			}
		}

		/*Get breadcrumbs END*/	
		$viewdata["breadcrumb"][] = array('text' => 'Acasa', 'href' => '/');
		$viewdata["breadcrumb"][] = array('text' => $page->p->title_ro, 'href' => '/' . $page->p->slug);
		// $viewdata["breadcrumb"][] = array('text' => 'Proiecte', 'href' => '/' . $page->p->slug);
		
		$view = (object) [ 'html' => array(
			
			0 => (object) ["viewhtml" => "blocuri_html/page_banner", "viewdata" => $viewdata],
			1 => (object) ["viewhtml" => "blocuri_html/page_breadcrumb", "viewdata" => null],
			2 => (object) ["viewhtml" => "pagini/page_start", "viewdata" => null],
			3 => null,
			5 => (object) ["viewhtml" => "pagini/proiect", "viewdata" => null],
			8 => (object) ["viewhtml" => "pagini/page_end", "viewdata" => null],
			
			
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
				"breacrumbs" => $breacrumbs,
				"title_browser_ro" => (!empty($proiect->atom_name_ro) ? $proiect->atom_name_ro : $page->p->title_browser_ro),
				"meta_description" => $page->p->meta_description,
				"keywords" => $page->p->keywords
			)
		);	
	}
}
