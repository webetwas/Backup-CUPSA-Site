<?php
require_once("PHPMailer_5.2.0/class.phpmailer.php");

defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {

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
		
		
		$page = $this->_Pagini->GetPage("contact");//getpage
		if($page) $viewdata["page"] = $page;
		
		$contact = array();
		if(isset($_REQUEST["cf-submitform"])) {
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
				if(!empty($this->input->post("cf-subject"))) $contact["subiect"] = trim($this->input->post("cf-subject"));
				if(!empty($this->input->post("cf-name"))) $contact["nume"] = trim($this->input->post("cf-name"));
				if(!empty($this->input->post("cf-address"))) $contact["adresa"] = trim($this->input->post("cf-address"));
				if(!empty($this->input->post("cf-phone"))) $contact["telefon"] = trim($this->input->post("cf-phone"));
				if(!empty($this->input->post("cf-email"))) $contact["email"] = trim($this->input->post("cf-email"));
				if(!empty($this->input->post("cf-message"))) $contact["mesaj"] = trim($this->input->post("cf-message"));
				
				
				//var_dump($contact);die();
				//PHPMailer Object
				$mail = new PHPMailer;

				//From email address and name
				$mail->From = $contact["email"];
				$mail->FromName = $contact["nume"];

				//To address and name
				$mail->addAddress("secretariat@cupfocsani.ro");

				//Address to which recipient will reply
				$mail->addReplyTo($contact["email"] , "Reply");

				//Send HTML or Plain Text email
				$mail->isHTML(true);
				$mail->Subject = $contact["subiect"];
				$body = "<b>Subiect: ".$contact["subiect"]."</b><br>";
				$body .= "Nume: ".$contact["nume"]."<br>";
				$body .= "Adresa: ".$contact["adresa"]."<br>";
				$body .= "Telefon: ".$contact["telefon"]."<br>";
				$body .= "Mesaj: ".$contact["mesaj"];
				$mail->Body = $body;
				//$mail->AltBody = "This is the plain text version of the email content";

				if(!$mail->send()) 
				{
					echo "Mailer Error: " . $mail->ErrorInfo;
				} 
				else 
				{
					$viewdata["form"]->item->success = "Am primit Mesajul tau.<br /> Iti multumim!";
				}				
				
			}
		}
		/*Get sucursale*/
		$sucursale = $this->_Airdrop->get_airdrops_by_air_controller_and_node_slug('sucursale', 'sucursale');
		$viewdata["sucursale"] = $sucursale;
		/*Get sucursale*/
		
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
	
	
	public function close_cookies_popup()
	{
		$this->session->set_userdata('popup_cookies', array('active' => true, 'disabled' => true));
	}
}






