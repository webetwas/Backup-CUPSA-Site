<?php
class Frontend {
	protected $CI;
	protected $_Frontend;

	/**
	 * [ Frontend - Layout ]
	 *
	 * @var [String] @header
	 * @var [String] @head - Including frontenddata
	 * @var [String] @footer
	 * @var [String] @footer_end
	 *
	 * @var [String] @body
	 * @var [String] @body_end
	 */
	 private $header = true, $head = true, $ue = true, $top_header = true, $menu_main = true, $footer = true, $footer_end = true;
	 private $body = true, $body_end = true;
	 
	 public $page_id = null;
	 
	 public $slider = true;
	 
	 public $site_lang;

	 /**
	  * [ Frontend - Data ]
	  *
	  * @var [Object] @owner
	  * @var [Object] @company
	  * @var [Object] @pageslist
	  */
  public $user_name = null;
	public $owner = null, $company = null, $pageslist = null;
	
	public $footer_site = true, $footer_line = true;
	
	public $menus = null;
	public $menu_footer = null;
	
	public $body_class = 'background-white';
	public $menu_class = null;
	
	public $popup_cookies = false;

	/**
	 * [__construct]
	 *
	 * We'll use a constructor, as you can't directly call a function
	 * from a property definition.
	 */
	public function __construct()
	{
		// Assign the CodeIgniter super-object
		$this->CI =& get_instance();
		
		$this->site_lang = 'ro';

		if($this->CI->session->has_userdata('site_lang'))
		{
			$this->site_lang = $this->CI->session->userdata('site_lang');
		}

		$this->CI->load->model("Frontend_model", "_Frontend");
		$this->CI->load->model("Pagini_model", "_Pagini");
		$this->CI->load->model("Airdrop_model", "_Airdrop");
		$this->CI->load->model("Object_model", "_Object");
		$this->CI->load->model("Airdrop_model", "_Airdrop");
		
		$this->CI->load->helper('application');
		
		// if(!$cookie = $this->CI->session->userdata('popup_cookies'))
		// {
			// $this->CI->session->set_userdata('popup_cookies', array('active' => true, 'disabled' => false));
		// } else {
			// if($cookie['disabled']) {
				// $this->popup_cookies = true;
			// }
		// }
		
		$this->user_name = $this->CI->_Frontend->getUserEmail();
    
		$this->owner = $this->CI->_Frontend->getOwner();
		$this->company = $this->CI->_Frontend->getCompany();
		$this->pageslist = $this->CI->_Frontend->listPages(1);
		
		$this->CI->load->helper('matrix');
		
		$this->menus = $this->CI->_Airdrop->get_airdrops_by_air_controller_and_node_slug('meniuri', 'meniu-principal');
		$this->menu_footer = $this->CI->_Airdrop->get_airdrops_by_air_controller_and_node_slug('meniuri', 'meniu-footer');
		$this->menu_footer2 = $this->CI->_Airdrop->get_airdrops_by_air_controller_and_node_slug('meniuri', 'meniu-footer-2');
		
		if($stiri_articole = $this->CI->_Airdrop->get_airdrops_and_images_by_air_controller_and_node_slug('stiri', 'articole',true))
		{
			$this->stiri_articole = $stiri_articole;
		} else {
			$this->stiri_articole = null;
		}
	}
	
	public function GetApp()
	{
		$data = array("owner" => null, "company" => null);
		$data["owner"] = $this->owner;
		$data["company"] = $this->company;
		
		return $data;
	}

	/**
	 * [render description]
	 * @param  [type] $data      [description]
	 * @param  [type] $headparam [description]
	 * @return [type]            [description]
	 */
	public function render($data, $data_header = null, $home = false) {
		if(!is_null($this->page_id))
		{
			$this->CI->_Frontend->increasePageVizite($this->page_id);
		}
		$fDATA = array("owner" => null, "company" => null, "pageslist" => null, "home" => $home, "stiri_articole" => null);
		$fDATA["pageslist"] = $this->pageslist;
		$fDATA["owner"] = $this->owner;
		$fDATA["company"] = $this->company;
		$fDATA["body_class"] = $this->body_class;
		$fDATA["menu_class"] = $this->menu_class;
		$fDATA["site_lang"] = $this->site_lang;
		
		$fDATA["stiri_articole"] = $this->stiri_articole;
		
		$menusDATA = array("menus" => null);
		$sliderDATA = array("homesliders" => null, "pathimgbanners" => BASE_URL.PATH_IMG_BANNERS, "categorii_speciale" => null, "categories" => null);
		if($this->menus) $menusDATA["menus"] = $this->menus;
		
		$footerDATA = array(
			"menu_footer" => $this->menu_footer,
			"menu_footer2" => $this->menu_footer2,
			"program" => $this->CI->_Object->msqlGet('programul_nostru', array('id_item' => 1))
		);
		
		if($categories = buildMatrix($this->CI->_Airdrop->get_all_nodes_by_node(1), 'parent_id', 'node_id', 1))
		{
			$sliderDATA["categories"] = $categories;
		}
    
    

		if(empty($data)) { echo "empty data on render";die(); }
		
		$getpageacasa = $this->CI->_Pagini->GetPage("acasa");
		if($getpageacasa && !is_null($getpageacasa->b)) $sliderDATA["homesliders"] = $getpageacasa->b;
		
		if($get_categorii_speciale = $this->CI->_Airdrop->get_all_nodes_and_images_by_node(68))
		{
			$sliderDATA["categorii_speciale"] = buildMatrix($get_categorii_speciale, 'parent_id', 'node_id', 68);
		}		
		
		if($this->header) $this->CI->load->view('_layout/header', (!is_null($data_header) ? $data_header : null));	
		
		if($this->head) $this->CI->load->view('layout/head', (!empty($fDATA) ? $fDATA : null));
        if($this->body) $this->CI->load->view('layout/body');
		if($this->ue) $this->CI->load->view('layout/ue');
        if($this->top_header) $this->CI->load->view('layout/top-nav');
		if($this->menu_main) $this->CI->load->view('layout/menu_main', $menusDATA);
		if($this->slider) $this->CI->load->view('layout/slider', $sliderDATA);
		
		foreach($data->html as $keyh => $h)//content
		if(!is_null($h))
			if(!is_null($h->viewdata)) {
				$this->CI->load->view($h->viewhtml, $h->viewdata);
			}
			else
				$this->CI->load->view($h->viewhtml);
		$this->CI->load->view('layout/footerjustdata', (!empty($footerDATA) ? $footerDATA : null));
		if($this->footer_site) $this->CI->load->view('layout/footer', null);
		if($this->footer_line) $this->CI->load->view('layout/footer_line', null);
		if($this->footer) $this->CI->load->view('_layout/footer');
		
		if(!empty($data->javascript))
			foreach($data->javascript as $keyj => $j)
				if(!is_null($j->viewdata))
					$this->CI->load->view($j->viewhtml, $j->viewdata);
				else
					$this->CI->load->view($j->viewhtml);
		$this->CI->load->view('layout/main_js');
		// if(!$this->popup_cookies)
			// $this->CI->load->view('layout/cookies');
		if($this->body_end) $this->CI->load->view('layout/body_end');
		if($this->footer) $this->CI->load->view('_layout/footer_end');
	}
}
