<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Media extends CI_Controller {

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
			"media" => null
		);
		
		$page = $this->_Pagini->GetPage("media");//getpage
		if($page) $viewdata["page"] = $page;
		
		if($pagini_site = $this->_Pagini->get_pagini_site_assoc_three($page->p->atom_id))
		{
			$viewdata["pagini_site"] = $pagini_site;
		}
		
		$media = $this->_Airdrop->get_all_nodes_by_parent_id(98);
		if($media)
		{
			foreach($media as $key_media => $medi)
			{
				$media[$key_media]->iteme = $this->_Airdrop->get_airdrops_and_images_by_air_controller_and_node_slug('media', $medi->slug);
			}
			
			$viewdata["media"] = $media;
		}		
		
		$viewdata["breadcrumb"][] = array('text' => 'Acasa', 'href' => '/');
		$viewdata["breadcrumb"][] = array('text' => $page->p->title_ro, 'href' => '/' . $page->p->slug);
		
		$view = (object) [ 'html' => array(
			
			0 => (object) ["viewhtml" => "blocuri_html/page_banner", "viewdata" => $viewdata],
			1 => (object) ["viewhtml" => "blocuri_html/page_breadcrumb", "viewdata" => null],
			2 => (object) ["viewhtml" => "pagini/page_start", "viewdata" => null],
			3 => null,
			4 => (object) ["viewhtml" => "pagini/pagina", "viewdata" => null],
			5 => (object) ["viewhtml" => "pagini/media", "viewdata" => null],
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
	
	public function comunicate(){
		$viewdata = array(
			"page" => null,
			"pathimgpage" => BASE_URL.PATH_IMG_PAGINA,
			"breadcrumb" => array(),
			"texte_diverse_texte_site" => null,
			"pagini_site" => null,
			"media" => null
		);
		
		$page = $this->_Pagini->GetPage("media");//getpage
		if($page) $viewdata["page"] = $page;
		
		if($pagini_site = $this->_Pagini->get_pagini_site_assoc_three($page->p->atom_id))
		{
			$viewdata["pagini_site"] = $pagini_site;
		}
		
		$media = $this->_Airdrop->get_all_nodes_by_parent_id(98);
		if($media)
		{
			foreach($media as $key_media => $medi)
			{
				$media[$key_media]->iteme = $this->_Airdrop->get_airdrops_and_images_by_air_controller_and_node_slug('media', $medi->slug);
			}
			$viewdata["media"] = $media;
		}		
		//echo "<pre>";
		//print_r($media["comunicate-de-presa"]);
		//echo "</pre>";
		$viewdata["breadcrumb"][] = array('text' => 'Acasa', 'href' => '/');
		$viewdata["breadcrumb"][] = array('text' => $page->p->title_ro, 'href' => '/' . $page->p->slug);
		
		$view = (object) [ 'html' => array(
			
			0 => (object) ["viewhtml" => "blocuri_html/page_banner", "viewdata" => $viewdata],
			1 => (object) ["viewhtml" => "blocuri_html/page_breadcrumb", "viewdata" => null],
			2 => (object) ["viewhtml" => "pagini/page_start", "viewdata" => null],
			3 => null,
			4 => (object) ["viewhtml" => "pagini/pagina", "viewdata" => null],
			5 => (object) ["viewhtml" => "pagini/media_comunicate", "viewdata" => null],
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
		
	
    public function p($id)
	{
		$viewdata = array(
			"page" => null,
			"pathimgpage" => BASE_URL.PATH_IMG_PAGINA,
			"breadcrumb" => array(),
			"texte_diverse_texte_site" => null,
			"pagini_site" => null
		);
  
		$page = $this->_Pagini->GetPage("media");//getpage
		if($page) $viewdata["page"] = $page;
		if($pagini_site = $this->_Pagini->get_pagini_site_assoc_three($page->p->atom_id))
		{
			$viewdata["pagini_site"] = $pagini_site;
		}

		if($media_item = $this->_Item->msqlGetAll('media', array("atom_id" => $id)))
		{
			$viewdata["media_item"] = $media_item;
		}		
		/*Toate elementele media*/
		$toate_elementele_media = $this->_Item->msqlGetAll('media');
		$viewdata["toate_elementele_media"] = $toate_elementele_media;
		/*Toate elementele media*/

        $this->frontend->slider = false;
     
		$viewdata["breadcrumb"][] = array('text' => 'Acasa', 'href' => '/');
		$viewdata["breadcrumb"][] = array('text' => $media_item[0]->atom_name_ro, 'href' => '/' );

		$view = (object) [ 'html' => array(
                0 => (object) ["viewhtml" => "blocuri_html/page_banner", "viewdata" => $viewdata],
                1 => (object) ["viewhtml" => "blocuri_html/page_breadcrumb", "viewdata" => null],
                2 => (object) ["viewhtml" => "pagini/page_start", "viewdata" => null],
                3 => null,
                4 => (object) ["viewhtml" => "pagini/media_single", "viewdata" => null],
                5 => (object) ["viewhtml" => "pagini/page_end", "viewdata" => null],
              ), 'javascript' => array(
                0 => (object) ["viewhtml" => "pagini/js_pagina", "viewdata" => null],
              )
        ];

		if($page->s->left_sidebar)
		{
			$view->html[3] = (object) ["viewhtml" => "pagini/sidebar_left", "viewdata" => null];
		}

		$this->frontend->slider = false;
		$this->frontend->render($view,
			array(
				"breacrumbs" => $breacrumbs,
				"title_browser_ro" => $media_item[0]->atom_name_ro,
				"meta_description" => $media_item[0]->atom_name_ro,
				"keywords" => $media_item[0]->atom_name_ro
			)
		);
	}
}
