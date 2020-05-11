<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Legislatie extends CI_Controller {

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
			"texte_diverse_texte_site" => null,
			"pagini_site" => null,
			"articole" => null
		);
		
		$page = $this->_Pagini->GetPage("legislatie");//getpage
		if($page) $viewdata["page"] = $page;
		
		if($pagini_site = $this->_Pagini->get_pagini_site_assoc_three($page->p->atom_id))
		{
			$viewdata["pagini_site"] = $pagini_site;
		}	
		
		if($articole = $this->_Airdrop->get_airdrops_by_air_controller_and_node_slug('legislatie', 'legislatie'))
		{
			$viewdata["articole"] = $articole;
		}		
		/*Get breadcrumbs*/
		$dynamic_breadcrumbs = $this->_Item->msqlGetAll('breadcrumbs_legislatie', array("idpage" => $page->p->atom_id));
		$breacrumbs=array();
		$i=0;
		if(!empty($dynamic_breadcrumbs) ) {
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
		
		$view = (object) [ 'html' => array(
			
			0 => (object) ["viewhtml" => "blocuri_html/page_banner", "viewdata" => $viewdata],
			1 => (object) ["viewhtml" => "blocuri_html/page_breadcrumb", "viewdata" => null],
			2 => (object) ["viewhtml" => "pagini/page_start", "viewdata" => null],
			3 => null,
			4 => (object) ["viewhtml" => "pagini/pagina", "viewdata" => null],
			5 => (object) ["viewhtml" => "pagini/legislatie", "viewdata" => null],
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
				"breacrumbs" => $breacrumbs,
				"title_browser_ro" => $page->p->title_browser_ro,
				"meta_description" => $page->p->meta_description,
				"keywords" => $page->p->keywords
			)
		);
	}
}
