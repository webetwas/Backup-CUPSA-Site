<?php
require_once("PHPMailer_5.2.0/class.phpmailer.php");
/*
$conf['smtp']['smtp_server'] = "mail.cupfocsani.ro";
$conf['smtp']['smtp_port'] = 25;
$conf['smtp']['smtp_helo'] = exec("hostname");
$conf['smtp']['smtp_auth'] = 1;
$conf['smtp']['smtp_user'] = "contact@cupfocsani.ro";
$conf['smtp']['smtp_pass'] = "&&*jha&HJYdhias";




$dela = "aaa";
$html_message =  "De la: $dela<br /><br />\n\n$subiect<br /><br />\n\n$mesaj<br /><br />\n\n$email";
$plain_message = strip_tags($html_message);

$mail = new htmlMimeMail();
$mail->setFrom("$nume <$email>");
$mail->setReturnPath($to);
$mail->setSMTPParams($conf['smtp']['smtp_server'], $conf['smtp']['smtp_port'], $conf['smtp']['smtp_helo'], $conf['smtp']['smtp_auth'], $conf['smtp']['smtp_user'], $conf['smtp']['smtp_pass']);

$mail->setSubject($subject);
$mail->setHtml($html_message, $plain_message);



	$result = $mail->send(array('catalin.cristea13@gmail.com'), 'smtp');
	// These errors are only set if you're using SMTP to send the message
	if (!$result) {
		print_r($mail->errors);
	} else {
		echo 'Mail sent!';
	}
*/
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
				/*
				if(!empty($this->frontend->user_name->email))
				{
				  $this->_Sendemail->trimitemesajcontact($contact, $this->frontend->user_name->email);
				} else {
				  
				  // Email wasn't found, ERR, mail won't Send
				}
				*/
				
				
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
	
	// public function register_newletter()
	// {
	// 	$res = array("status" => 0, "success" => null, "error" => null);
		
	// 	$data = (!empty($this->input->post("data")) ? $this->input->post("data") : null);
		
		// if(!isset($data["captcha"]) || !isset($data["captchaHash"]) || ($data["captchaHash"] != rpHash($data["captcha"])))
		// {
			
			// $res["status"] = 0;
			// $res["error"] = "Codul captcha a fost introdus gresit";
		// }
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
