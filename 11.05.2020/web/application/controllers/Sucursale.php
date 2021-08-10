<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sucursale extends CI_Controller {

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
			"sucursale" => null
		);
		
		$page = $this->_Pagini->GetPage("sucursale");//getpage
		if($page) $viewdata["page"] = $page;
		
		if($pagini_site = $this->_Pagini->get_pagini_site_assoc_three($page->p->atom_id))
		{
			$viewdata["pagini_site"] = $pagini_site;
		}
		
		if($sucursale = $this->_Airdrop->get_airdrops_by_air_controller_and_node_slug('sucursale', 'sucursale'))
		{
			foreach($sucursale as $key_sucursala => $sucursala)
			{
				$sucursale[$key_sucursala]->investitii = null;
				// public function msqlGetAll($table, $data = null)
				$sucursale[$key_sucursala]->investitii = $this->_Item->msqlGetAllByJoin('sucursale_investitii_assoc', 'proiecte', $sucursala->atom_id);
			}
			$viewdata["sucursale"] = $sucursale;
		}

		$viewdata["breadcrumb"][] = array('text' => 'Acasa', 'href' => '/');
		$viewdata["breadcrumb"][] = array('text' => $page->p->title_ro, 'href' => '/' . $page->p->slug);
		
		$view = (object) [ 'html' => array(
			
			0 => (object) ["viewhtml" => "blocuri_html/page_banner", "viewdata" => $viewdata],
			1 => (object) ["viewhtml" => "blocuri_html/page_breadcrumb", "viewdata" => null],
			2 => (object) ["viewhtml" => "pagini/page_start", "viewdata" => null],
			3 => null,
			// 4 => (object) ["viewhtml" => "pagini/pagina", "viewdata" => null],
			4 => (object) ["viewhtml" => "pagini/sucursale", "viewdata" => null],
			5 => (object) ["viewhtml" => "pagini/pagina_content_end", "viewdata" => null],
			6 => (object) ["viewhtml" => "pagini/page_end", "viewdata" => null],
			
			
		  ), 'javascript' => null
		];
		
		if($page->s->left_sidebar)
		{
			//$view->html[3] = (object) ["viewhtml" => "pagini/sidebar_left", "viewdata" => null];
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
    
    public function p($id)
	{
		$viewdata = array(
			"page" => null,
			"pathimgpage" => BASE_URL.PATH_IMG_PAGINA,
			"breadcrumb" => array(),
			"texte_diverse_texte_site" => null,
			"pagini_site" => null
		);
  
		$page = $this->_Pagini->GetPage("sucursale");//getpage
		if($page) $viewdata["page"] = $page;
		
		if($pagini_site = $this->_Pagini->get_pagini_site_assoc_three($page->p->atom_id))
		{
			$viewdata["pagini_site"] = $pagini_site;
		}
		
		if($sucursale = $this->_Item->msqlGetAll('sucursale', array("atom_id" => $id)))
		{
			foreach($sucursale as $key_sucursala => $sucursala)
			{
				$sucursale[$key_sucursala]->investitii = null;
				// public function msqlGetAll($table, $data = null)
				$sucursale[$key_sucursala]->investitii = $this->_Item->msqlGetAllByJoin('sucursale_investitii_assoc', 'proiecte', $sucursala->atom_id);
			}
			$viewdata["sucursale"] = $sucursale;
		}
		/*Toate sucursalele*/
		$toate_sucursalele = $this->_Item->msqlGetAll('sucursale');
	
		$viewdata["toate_sucursalele"] = $toate_sucursalele;
		/*Toate sucursalele END*/
		/*Get breadcrumbs*/
		$dynamic_breadcrumbs = $this->_Item->msqlGetAll('breadcrumbs_sucursale', array("idpage" => $id));
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

        $this->frontend->slider = false;
     
		$viewdata["breadcrumb"][] = array('text' => 'Acasa', 'href' => '/');
		$viewdata["breadcrumb"][] = array('text' => $sucursale[0]->atom_name_ro, 'href' => '/' );

		$view = (object) [ 'html' => array(
                0 => (object) ["viewhtml" => "blocuri_html/page_banner", "viewdata" => $viewdata],
                1 => (object) ["viewhtml" => "blocuri_html/page_breadcrumb", "viewdata" => null],
                2 => (object) ["viewhtml" => "pagini/page_start", "viewdata" => null],
                3 => null,
                4 => (object) ["viewhtml" => "pagini/sucursala_single", "viewdata" => null],
                5 => (object) ["viewhtml" => "pagini/page_end", "viewdata" => null],
              ), 'javascript' => array(
                0 => (object) ["viewhtml" => "pagini/js_pagina", "viewdata" => null],
              )
        ];

		if($page->s->left_sidebar)
		{
			// $view->html[3] = (object) ["viewhtml" => "pagini/sidebar_left", "viewdata" => null];
		}

		$this->frontend->slider = false;
		$this->frontend->render($view,
			array(
				"breacrumbs" => $breacrumbs,
				"title_browser_ro" => $sucursale[0]->atom_name_ro,
				"meta_description" => $sucursale[0]->atom_name_ro,
				"keywords" => $sucursale[0]->atom_name_ro
			)
		);
	}
    
}
