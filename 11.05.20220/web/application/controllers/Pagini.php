<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pagini extends CI_Controller {

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
		show_404();
	}
	
	public function site_lang($site_lang = 'ro')
	{
		if(trim($site_lang) == "ro" || trim($site_lang) == "en")
		{
			$this->session->set_userdata('site_lang', trim($site_lang));
		}
		
		redirect(base_url());
	}
	
	public function p($slug)
	{
		$viewdata = array(
			"page" => null,
			"pathimgpage" => BASE_URL.PATH_IMG_PAGINA,
			"breadcrumb" => array(),
			"texte_diverse_texte_site" => null,
			"pagini_site" => null
		);
		
        $lista_declaratii = $this->_Object->msqlGetAll(TBL_DECLARATII_AVERE,null,true);
        if($lista_declaratii) $viewdata["lista_declaratii"] = $lista_declaratii;

        if(false && $slug == 'actionariat')
        {
            $categorii_structura = $this->_Object->msqlGetAll('structura_manageriala_info');
            if($categorii_structura) $viewdata["categorii_structura"] = $categorii_structura;
        }

        if($slug == 'guvernanta-corporativa')
        {
            $childrens = $this->_Object->msqlGetAll('nodes', array('parent_id' => 118));

            if($childrens)
            {
                $viewdata["actionariat"] = $childrens;
            }

            foreach($viewdata["actionariat"] as $key => $row)
            {
                $items = $this->_Item->msqlGetAll('actionariat', array("air_id" => $row->node_id));
                // print_r($items); die;
                if($items)
                {
                    foreach($items as $keyitem => $item)
                    {
                        $item->pdf = $this->_Item->msqlGetAll('actionariat_pdf', array("node_id" => $item->atom_id));
                    }
                    $viewdata["actionariat"][$key]->items = $items;
                }
            }
            // print_r($viewdata["chain_links"]); die;
            $this->frontend->slider = false;
        }
		
		if($slug == 'situatii-financiare')
        {
            $childrens = $this->_Object->msqlGetAll('nodes', array('parent_id' => 164));

            if($childrens)
            {
                $viewdata["sitfinanciare"] = $childrens;
            }

            foreach($viewdata["sitfinanciare"] as $key => $row)
            {
                $items = $this->_Item->msqlGetAll('sitfinanciare', array("air_id" => $row->node_id));
                // print_r($items); die;
                if($items)
                {
                    foreach($items as $keyitem => $item)
                    {
                        $item->pdf = $this->_Item->msqlGetAll('actionariat_pdf', array("node_id" => $item->atom_id));
                    }
                    $viewdata["sitfinanciare"][$key]->items = $items;
                }
            }
            // print_r($viewdata["chain_links"]); die;
            $this->frontend->slider = false;
        }
		
		if($slug== "calitatea-apei"){
			$filters = array();
			if (isset($_GET['s']) && !empty($_GET['s'])) {
				$sucursala =  $_GET['s'];
				$filters["sucursala"] = $sucursala;
			}
			if (isset($_GET['an']) && !empty($_GET['an'])) {
				$an =  $_GET['an'];
				$filters["an"] = $an;
			}
			if (isset($_GET['luna']) && !empty($_GET['luna'])) {
				$luna =  $_GET['luna'];
				$filters["luna"] = $luna;
			}
			$buletine = $this->_Item->msqlGetAll('buletine_meteo',$filters);
			$sucursale = $this->_Item->msqlGetAll('sucursale');
			$viewdata["buletine"] = $buletine;
			$viewdata["sucursale"] = $sucursale;
		}
		
		$page = $this->_Pagini->GetPageBySlug($slug);//getpage
		if($page) $viewdata["page"] = $page;
		else
			show_404();

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
                5 => (object) ["viewhtml" => "pagini/page_end", "viewdata" => null],
              ), 'javascript' => array(
                0 => (object) ["viewhtml" => "pagini/js_pagina", "viewdata" => null],
              )
        ];
		$dynamic_breadcrumbs = $this->_Item->msqlGetAll('breadcrumbs', array("idpage" => $page->p->atom_id));
		$breacrumbs=array();
		$i=0;
		if (!empty($dynamic_breadcrumbs)) {
			foreach($dynamic_breadcrumbs as $key=>$row){
				$breacrumb_pages = $this->_Item->msqlGetAll('fe_pages', array("atom_id" => $row->idpageassoc));			
				foreach($breacrumb_pages as $key=>$row){				
					$breacrumbs[$i][slug] = $row->slug;
					$breacrumbs[$i][atom_name_ro] = $row->atom_name_ro;
					$i++;
				}
			}
		}

		//var_dump($breacrumbs);		
		//die();
		/*
		$dynamic_breadcrumbs = explode(",",$dynamic_breadcrumbs[0]->segments);
		$breacrumbs=array();
		$i=0;
		foreach($dynamic_breadcrumbs as $key=>$row){
			$breacrumb_pages = $this->_Item->msqlGetAll('fe_pages', array("atom_id" => $row));
			foreach($breacrumb_pages as $key=>$row){
				$breacrumbs[$i][slug] = $row->slug;
				$breacrumbs[$i][atom_name_ro] = $row->atom_name_ro;
				$i++;
			}
		}	
		*/		
		//print_r (explode(",",$dynamic_breadcrumbs[0]->segments));
		
		//$dynamic_breadcrumbs = json_decode($dynamic_breadcrumbs[0]->segments, TRUE);
		if($page->s->left_sidebar)
		{
			$view->html[3] = (object) ["viewhtml" => "pagini/sidebar_left", "viewdata" => null];
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
    
    public function single_post($id)
	{
		$viewdata = array(
			"page" => null,
			"pathimgpage" => BASE_URL.PATH_IMG_PAGINA,
			"breadcrumb" => array(),
			"texte_diverse_texte_site" => null,
			"pagini_site" => null
		);

        $items = $this->_Item->msqlGetAll('actionariat', array("atom_id" => $id));

        if($items)
        {
            foreach($items as $keyitem => $item)
            {
                $item->pdf = $this->_Item->msqlGetAll('actionariat_pdf', array("node_id" => $item->atom_id));
            }
            $viewdata["actionariat"] = $items;
        }

        $this->frontend->slider = false;
        
		$viewdata["breadcrumb"][] = array('text' => 'Acasa', 'href' => '/');
		$viewdata["breadcrumb"][] = array('text' => $items[0]->atom_name_ro, 'href' => '/' );

		$view = (object) [ 'html' => array(
                0 => (object) ["viewhtml" => "blocuri_html/page_banner", "viewdata" => $viewdata],
                1 => (object) ["viewhtml" => "blocuri_html/page_breadcrumb", "viewdata" => null],
                2 => (object) ["viewhtml" => "pagini/page_start", "viewdata" => null],
                3 => null,
                4 => (object) ["viewhtml" => "pagini/single_post", "viewdata" => null],
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
				"title_browser_ro" => $items[0]->atom_name_ro,
				"meta_description" => $items[0]->atom_name_ro,
				"keywords" => $items[0]->atom_name_ro
			)
		);
	}
}
