<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Drepturile_persoanelor_vizate extends CI_Controller {

	private $ControllerObject;
	
  private $toemail;
  
	public function __construct() {
		parent::__construct();
		// Your own constructor code
		
		$this->controller = $this->router->fetch_class();//Controller

		$this->load->model('Pagini_model', '_Pagini');
		$this->load->model("Item_model", "_Item");
		$this->load->model("Sendemail_model", "_Sendemail");
		
		$this->load->helper('application');
    
    // $this->toemail =
	}

	/**
	 * [Index]
	 * @return [type] [description]
	 */
	public function index($err = null)
	{
		// var_dump($this->frontend->user_name->email);
		
		$viewdata = array(
			"page" => null,
			"form" => (object) [],
			"program" => $this->_Object->msqlGet('programul_nostru', array('id_item' => 1))
		);
		
		if(!is_null($err)) $viewdata["form"]->error = "Codul captcha a fost introdus gresit";
		
    // FORM - NEW
		$viewdata["form"]->item = (object) [];
		$viewdata["form"]->item->name = "item";
		$viewdata["form"]->item->id = "item_mesajnou";
		$viewdata["form"]->item->prefix = "it";
		$viewdata["form"]->item->segments = $this->controller;
		$viewdata["form"]->item->error = null;
		$viewdata["form"]->item->success = null;
		
		
		$page = $this->_Pagini->GetPage("drepturile-persoanelor-vizate");//getpage
		// var_dump('drepturile-persoanelor-vizate');
		if($page) $viewdata["page"] = $page;
		
		$gdpr = array();
		if(isset($_REQUEST["cf-submit"])) {
      // var_dump($this->input->post("captchaHash"));die();
			// Captcha
			if(!empty($this->input->post("captcha"))) $captcha = $this->input->post("captcha");
			if(!empty($this->input->post("captchaHash"))) $captchahash = $this->input->post("captchaHash");
			if(!isset($captcha) || !isset($captchahash) || $captchahash != rpHash($captcha)) 
			{
				
				$viewdata["form"]->item->error = "Codul captcha a fost introdus gresit";
			}
			else 
			{
				if(!empty($this->input->post("cf-name"))) $gdpr["nume"] = trim($this->input->post("cf-name"));
				if(!empty($this->input->post("cf-address"))) $gdpr["adresa"] = trim($this->input->post("cf-address"));
				if(!empty($this->input->post("cf-localitate"))) $gdpr["localitate"] = trim($this->input->post("cf-localitate"));
				if(!empty($this->input->post("cf-phone"))) $gdpr["telefon"] = trim($this->input->post("cf-phone"));
				if(!empty($this->input->post("cf-email"))) $gdpr["email"] = trim($this->input->post("cf-email"));
				
				if(!empty($this->input->post("cf-codclient"))) $gdpr["codclient"] = trim($this->input->post("cf-codclient"));
				if(!empty($this->input->post("cf-cnp"))) $gdpr["cnp"] = trim($this->input->post("cf-cnp"));

				if(!empty($this->input->post("cf-message"))) $gdpr["mesaj"] = trim($this->input->post("cf-message"));
				
				var_dump($gdpr);die();
        
				if(!empty($this->frontend->user_name->email))
				{
				  $this->_Sendemail->trimitemesajgdpr($gdpr, $this->frontend->user_name->email);
				} else {
				  
				  // Email wasn't found, ERR, mail won't Send
				}
				
				$viewdata["form"]->item->success = "Am primit: Cerere pentru exercitarea dreptului de acces.<br /> Iti multumim!";
			}
		}

		$view = (object) [ 'html' => array(
     		0 => (object) ["viewhtml" => "blocuri_html/page_breadcrumb", "viewdata" => $viewdata],
      		1 => (object) ["viewhtml" => "pagini/" .$page->s->filehtml, "viewdata" => null],
      ), 'javascript' => array(0 => (object) ["viewhtml" => "pagini/js_contact", "viewdata" => null])
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
	
	// public function register_newletter()
	// {
	// 	$res = array("status" => 0, "success" => null, "error" => null);
		
	// 	$data = (!empty($this->input->post("data")) ? $this->input->post("data") : null);
		
	// 	// if(!isset($data["captcha"]) || !isset($data["captchaHash"]) || ($data["captchaHash"] != rpHash($data["captcha"])))
	// 	// {
			
	// 		// $res["status"] = 0;
	// 		// $res["error"] = "Codul captcha a fost introdus gresit";
	// 	// }
	// 	if(!empty($data["email"]))
	// 	{
			
	// 		$check = $this->_Item->msqlGet('newsletter', array('email' => $data["email"]));
	// 		if($check)
	// 		{
	// 			$res["status"] = 0;
	// 			$res["error"] = "E-mailul introdus este deja inregistrat pentru newsletter..";
	// 			exit(json_encode($res));
	// 		}			
			
	// 		if((bool)$this->_Item->msqlInsert('newsletter', array('email' => $data["email"], 'date_insert' => date("Y-m-d H:i:s"))))
	// 		{
	// 			$res["status"] = 1;
	// 			$res["success"] = "Felicitari! Te-ai inregistrat cu succes.";
	// 		}
	// 	}
		
	// 	exit(json_encode($res));
	// }
	
	public function close_cookies_popup()
	{
		$this->session->set_userdata('popup_cookies', array('active' => true, 'disabled' => true));
	}
}
