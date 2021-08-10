<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pagini extends CI_Controller {
         private $Air;
  /**
	 * [private Controller]
	 * @var [type]
	 */
	private $controller;
  private $controller_ajax;

	/**
	 * [private URI - Segment]
	 * @var [type]
	 */
	private $uriseg;

  public function __construct() {
    parent::__construct();
    // Your own constructor code

    $this->controller = $this->router->fetch_class();//Controller
    $this->controller_ajax = $this->controller;
		$this->uriseg = json_decode(json_encode($this->uri->uri_to_assoc(2)));

    if(!$this->user->id) redirect("login");

    $this->load->model('Pagini_model', '_Pagini');// model/_Pagini
    $this->load->model("Item_model", "_Item");// model/_Item
	$this->load->model("Upload_model", "_Upload");// model/_Upload
	$this->load->model("Banner_model", "_Banner"); // model/_Banner
	$this->load->model("Slug_model", "_Slug");
	$this->load->model("Nodes_model", "_Nodes");
	//$this->load->model("Imager_model", "_Imager");
		
		// $this->load->helper("urlu_helper");
		$this->Air = $this->_Nodes->get_air_data_by_air_controller(strtolower("pagini_site"));
		
		if(!$this->Air) exit("Couldn't find The Air..");

  }

	/**
	 * [index description]
	 * @return [type] [description]
	 */
  public function index()
  {
    echo "pagini";die();
  }
	
	public function chosen_request_page_assoc()
	{
		$res = array("status" => 0, "id" => null);
		
		$id_page = (!empty($this->input->post("id_page")))
			? $this->input->post("id_page") : null;		
		
		$params = (!empty($this->input->post("params")))
			? $this->input->post("params") : null;
			
		if(!is_null($id_page) && !is_null($params))
		{
			foreach($params as $action => $id_page_assoc)
			{
				switch($action)
				{
					case 'selected':
						$id = $this->_Pagini->insert_page_assoc($id_page, $id_page_assoc);
						break;
					case 'deselected':
						$this->_Pagini->remove_page_assoc($id_page, $id_page_assoc);
						break;
				}
			}
		}
		$res["status"] = 1;
		header('Content-Type: application/json');
		exit(json_encode($res));		
	}
	public function insert_breadcrumbs_assoc(){
		//$insert = $this->_Item->msqlUpdate("breadcrumbs", array("segments" => $page_id_breadcrumb), array("c" => "id_page", "v" => $id_page));
		$res = array("status" => 0, "id" => null);
		
		$id_page = (!empty($this->input->post("id_page")))
			? $this->input->post("id_page") : null;		
		
		$params = (!empty($this->input->post("params")))
			? $this->input->post("params") : null;
			
		if(!is_null($id_page) && !is_null($params))
		{
			foreach($params as $action => $id_page_assoc)
			{
				switch($action)
				{
					case 'selected':
						$id = $this->_Pagini->insert_breadcrumbs_assoc($id_page, $id_page_assoc);
						break;
					case 'deselected':
						$this->_Pagini->remove_breadcrumbs_assoc($id_page, $id_page_assoc);
						break;
				}
			}
		}
		$res["status"] = 1;
		header('Content-Type: application/json');
		exit(json_encode($res));
		//echo "aaaa";die();
		
	}
  public function Item()
  {
		if((int)$this->UserModel->user->privilege > 2)
		{
			if(!$this->_Nodes->airdrop_check_if_user_has_access((int)trim($this->uriseg->id), (int)$this->UserModel->user->id))
			{
				$this->_Session->setFB_Negative(array("ref" => 'Contacteaza administratorul', "text" => "Nu ai acces la acest item."));
				redirect($this->controller_fake);
			}
		}	  
	  
    $this->controller = $this->controller. "/" .$this->router->fetch_method();
		/**
		  * [$viewdata CORE]
		  * @var array
		  */ $viewdata = array("controller" => $this->controller, "controller_ajax" => $this->controller_ajax. "/ajax", "page" => null, "uri" => null, "form" => (object) [], "page_pages" => null, "pages" => null ,"imager" => null);
		$viewdata["uri"] = $this->uriseg;
		
		$viewdata["imgpathbanner"] = SITE_URL.PATH_IMG_BANNERS;
		$viewdata["imgpathpage"] = SITE_URL.PATH_IMG_PAGINA."m/";
    // var_dump($this->uriseg);

    switch($this->uriseg->item)
    {
			case DELETE:
				if(isset($this->uriseg->id) && !is_null($this->uriseg->id)) {
					$delete = $this->_Pagini->RemovePage(intval($this->uriseg->id));
					if($delete) {
						$data = new stdClass();
						$data->atom_id     = $this->uriseg->id;
						$data->air_id      = 16;
						$data->airdrop_act = 'deselected';
						$data->node_id     = 102;
						$this->_Nodes->airdrop_rem_airdrop($data);						
						$this->_Session->setFB_Pozitive(array("ref" => "Pagini", "text" => "Pagina a fost stearsa!"));
					}
				}
				redirect('/');
					
			break;
			
			case INSERT:
        // FORM - NEW Item - Page
        $viewdata["form"]->item = (object) ["name" => "item", "prefix" => "it", "segments" => $this->controller. "/" .$this->uriseg->item];
        $form_submititem = $viewdata["form"]->item->prefix. "submit";//submit<button>
				
				/* form @item */
        if(isset($_REQUEST["{$form_submititem}"])) {
				
					$slug = $this->_Slug->slug_it('fe_pages', $this->input->post("{$viewdata["form"]->item->prefix}title"));
					
					// var_dump($idhttp_url);die();
					
					$newDBPattern = (object) [ // Design Database Pattern
						"table" => "fe_pages",
						"database" => INSERT,
						"type" => PUT,
						"design" => array(
							"id_page" => $slug,
							"slug" => $slug,
							"title" => true,
							"title_ro" => trim($this->input->post("{$viewdata["form"]->item->prefix}title")),
							"title_browser_ro" => trim($this->input->post("{$viewdata["form"]->item->prefix}title")),
							"atom_name_ro" => trim($this->input->post("{$viewdata["form"]->item->prefix}title"))
						)
					]; $insert = $this->_Item->INSItem($newDBPattern->table, $viewdata["form"]->item->prefix, $newDBPattern);// insert@Page
					if($insert) $this->_Session->setFB_Pozitive(array("ref" => "Pagini", "text" => "Ai creat pagina noua!"));
					if($insert) {
						
						//create structure
						$this->_Pagini->insertStructure($insert);
	
						$data = new stdClass();
						$data->atom_id     = $insert;
						$data->air_id      = 16;
						$data->airdrop_act = 'selected';
						$data->node_id     = 102;
						$this->_Nodes->airdrop_add_airdrop($data);
					}
					redirect($this->controller. "/u/id/" .$insert. '/' .$slug);
				/* form @meta */
        }				
				
			break;
			
      case UPDATE:
				/*Imgager*/
				/*
				$imager_page =85;
				
				$imager_return = false;
				$imager_sizes = $this->_Imager->get_images_sizes($imager_page, $imager_return);
				if($imager_return)
				{
					$viewdata["imager"] = $imager_sizes;
				}
				*/
				/*Imgager*/				
				$page = $this->_Pagini->GetPagina(trim($this->uriseg->id));
				if($page["p"]->id_page != "acasa" && $page["p"]->id_page != "contact")
				{
					if($pages = $this->_Pagini->get_all_pages())
					{
						$viewdata["pages"] = $pages;
						if($pages_assoc = $this->_Pagini->get_all_assoc_pages_and_customone($page["p"]->atom_id))
						{
							$viewdata["page_pages"] = $pages_assoc;
							// echo '<pre>';
							// print_r($viewdata["page_pages"]);
							// echo '</pre>';
							// die();
						}
						if($breadcrumb_assoc = $this->_Pagini->get_all_assoc_breadcrumbs($page["p"]->atom_id))
						{
							$viewdata["breadcrumb_assoc"] = $breadcrumb_assoc;
						}
					}					
				}
				
				// echo "<pre>";
				// var_dump($page);
				// echo "</pre>";
				// die();
				
        // FORM - NEW Item - Page
        $viewdata["form"]->item = (object) ["name" => "item", "prefix" => "it", "segments" => $this->controller. "/" .$this->uriseg->item. "/id/" .$this->uriseg->id];
        $form_submititem = $viewdata["form"]->item->prefix. "submit";//submit<button>
				
        // FORM - NEW Item - Page Meta
        $viewdata["form"]->meta = (object) ["name" => "meta", "prefix" => "mt", "segments" => $this->controller. "/" .$this->uriseg->item. "/id/" .$this->uriseg->id];
        $form_submitmeta = $viewdata["form"]->meta->prefix. "submit";//submit<button>
				
        // FORM - NEW Structura - Page Structure
        $viewdata["form"]->structura = (object) ["name" => "structura", "prefix" => "st", "segments" => $this->controller. "/" .$this->uriseg->item. "/id/" .$this->uriseg->id];
        $form_submitstructura = $viewdata["form"]->structura->prefix. "submit";//submit<button>
				
				/* form @item */
        if(isset($_REQUEST["{$form_submititem}"])) {

					$newDBPattern = (object) [ // Design Database Pattern
						"table" => "fe_pages",
						"database" => UPDATE,
						"type" => PUT,
						"design" => array(
							"content_ro" => true,
							"content_en" => true,
							"title_content_ro" => true,
							"title_content_en" => true,
							"subtitle_content_ro" => true,
							"subtitle_content_en" => true,
							"yt_link" => true,
							"yt_link_desc" => true,
						)
					]; $update = $this->_Item->UPItem($newDBPattern->table, $viewdata["form"]->item->prefix, $newDBPattern, array('c' => "atom_id", 'v' => $this->uriseg->id));// update@Page
					if($update) $this->_Session->setFB_Pozitive(array("ref" => "Continutul Paginii", "text" => "Modificarile tale au fost salvate!"));
					redirect($viewdata["form"]->item->segments);
				/* form @meta */
        } elseif(isset($_REQUEST["{$form_submitmeta}"])) {
					
					$newDBPattern = (object) [ // Design Database Pattern
						"table" => "fe_pages",
						"database" => UPDATE,
						"type" => PUT,
						"design" => array(
							"admin_message" => true,
							"title" => true,
							"title_ro" => true,
							"title_en" => true,
							"title_browser_ro" => true,
							"meta_description" => true,
							"keywords" => true
						)
					]; $update = $this->_Item->UPItem($newDBPattern->table, $viewdata["form"]->meta->prefix, $newDBPattern, array('c' => "atom_id", 'v' => $this->uriseg->id));// update@PageStructure
					if($update) $this->_Session->setFB_Pozitive(array("ref" => "Metadata Pagina", "text" => "Modificarile tale au fost salvate!"));
					redirect($viewdata["form"]->meta->segments);
				/* form @structura */
				} elseif(isset($_REQUEST["{$form_submitstructura}"])) {
					
					$newDBPattern = (object) [ // Design Database Pattern
						"table" => "fe_pages_structure",
						"database" => UPDATE,
						"type" => GET,
						"design" => array()
					]; $update = $this->_Item->UPItem($newDBPattern->table, $viewdata["form"]->structura->prefix, $newDBPattern, array('c' => "idpage", 'v' => $this->uriseg->id));// update@PageStructure
					if($update) $this->_Session->setFB_Pozitive(array("ref" => "Structura Pagina", "text" => "Modificarile tale au fost salvate!"));
					redirect($viewdata["form"]->structura->segments);
				}

        if($page) {
					$banners = $this->_Banner->fetchAssocByRef(TBL_PAGES_BANNERS, array("idpage" => $page["p"]->atom_id));
					if($banners) $page["b"] = $banners;//assign@b
					
					$viewdata["page"] = json_decode(json_encode($page));//load page to Viewdata
                                         $viewdata["air"] = $this->Air;
                                   
        } else show_404();
      break;
   }
		//breacrumb
		$breadcrumb = array("bb_titlu" => "Pagini site", "bb_button" => null, "bb_buttondel" => null, "breadcrumb" => array());
		if(isset($page) && $page && $page["s"]->filehtml == "pagina") {
			

			$breadcrumb["bb_buttondel"] = array("text" => '<i class="fa fa-trash"></i> Sterge pagina', "linkhref" => $this->controller ."/d/id/" .$page["p"]->atom_id);
		}
		
		$breadcrumb["breadcrumb"][0] = array("text" => "Pagini", "url" => '');
		$breadcrumb["breadcrumb"][1] = array("text" => $this->uriseg->item == "i" ? 'Pagina noua' : $page["p"]->title, "url" => null);
    $view = (object) [ 'html' => array(
			0 => (object) ["viewhtml" => "layout/breadcrumb", "viewdata" => $breadcrumb],
      1 => (object) ["viewhtml" => $this->uriseg->item == "i" ? 'pagini/creazapagina' : "pagini/pagina", "viewdata" => $viewdata]
      ), 'javascript' => array(
      1 => (object) ["viewhtml" => "pagini/js_pagina", "viewdata" => null],
      )
    ];
    $this->frontend->render($view);
  }


	/**
	 * [Ajax description]
	 */
  public function Ajax() {
		if(!empty($this->uriseg->ajax) && isset($this->uriseg->id) && !is_null($this->uriseg->id))
	    switch($this->uriseg->ajax)
			{
                               //upload and delete pdf
				case "uppdf":
					$res = array('status' => 0, 'file' => null, 'error' => null);
					
					$path = '../web/public/upload/' . $this->Air->air_documents_path;
					$inputfile = 'inpfilepdf';
					$file = $this->_Upload->process_upload_file($inputfile, $path, 'pdf', 'application/pdf');
					
					if($file === false)
					{
						// upload failed.
						$res["error"] = 'A aparut o eroare.. te rugam sa incerci din nou.';
						echo json_encode($res);
						exit();
					}
					
/*
					$this->_Item->msqlUpdate(
						$this->Air->air_table,
						array(
							'pdf_file' => $file["base"],
							'pdf_name' => $file["name"]
						),
						array(
							'c' => 'atom_id',
							'v' => $this->uriseg->id
						)
					);
*/
							$insertdata = array("fe_pages_atom_id" => trim(intval($this->uriseg->id)), "pdf_file" => $file["base"], "pdf_name" => $file["name"]);
							
							
							$insertitem = $this->_Item->msqlInsert("fe_pages_pdf", $insertdata);					
					$res["status"] = 1;
					$res["file"] = $file["base"];
					
					echo json_encode($res);
					break;
				case "delpdf":
					$res = array('status' => 0, 'error' => null);
					
					$path = '../web/public/upload/' . $this->Air->air_documents_path . '/';
					$item = $this->_Item->msqlGet($this->Air->air_table, array('atom_id' => $this->uriseg->id));
					
					if($item === false)
					{
						// item not found
						$res["error"] = 'A aparut o eroare.. te rugam sa incerci din nou.';
						echo json_encode($res);
						exit();
					}
					
					$this->_Upload->delete_file($path, $item->pdf_file);
					$this->_Item->msqlUpdate(
						$this->Air->air_table,
						array(
							'pdf_file' => null,
							'pdf_name' => null
						),
						array(
							'c' => 'atom_id',
							'v' => $this->uriseg->id
						)
					);
					
					$res["status"] = 1;
					echo json_encode($res);
					break;
	                         //upload and delete pdf			
				case UPLOADIMG:
					$res = array("status" => 0, "id" => null);
					$inputfile = "inpfile";
					$filetarget = trim($this->input->post("filetarget"));//@banner@poza
					$fileref = trim($this->input->post("fileref"));//@banner1@banner2
					
					$pagestruct = $this->_Pagini->getStructure("array", trim(intval($this->uriseg->id)));//getpagestructure
					$locations = (object) ["table" => null, "path" => null];
					$imaginaryfolder = null;//usetrueformultiplefiles[s,m,l]
					$filesdata = null;
					$insertdata = null;
					switch($this->input->post("filetarget"))
					{
						case UPIMGBANNER:
							$locations->table = TBL_PAGES_BANNERS;
							$locations->path = '../web/' .PATH_IMG_BANNERS;
							
							$width = !is_null($pagestruct[$fileref. '_w']) ? $pagestruct[$fileref. '_w'] : json_decode(constant("IMG_SIZE_" .strtoupper($fileref)))->width;
							$height = !is_null($pagestruct[$fileref. '_h']) ? $pagestruct[$fileref. '_h'] : json_decode(constant("IMG_SIZE_" .strtoupper($fileref)))->height;
							$proportion = $pagestruct[$fileref. '_p'] == "1" ? true : json_decode(constant("IMG_SIZE_" .strtoupper($fileref)))->proportion;
							
							$filesdata = array($fileref => array("w" => $width, "h" => $height, "p" => $proportion));
						break;
						case UPIMGPOZA:
							$locations->table = TBL_PAGES_IMAGES;
							$locations->path = '../web/' .PATH_IMG_PAGINA;
							$imaginaryfolder = array("s" => true, "m" => true, "l" => true);
							
							$filesdata = array(
								"s" => array("w" => null, "h" => null, "p" => null),
								"m" => array("w" => null, "h" => null, "p" => null),
								"l" => array("w" => null, "h" => null, "p" => null)
							);
							foreach($filesdata as $kd => $d) {
								foreach($d as $kdd => $dd) {
									$db_format = "image_" .$kd.$kdd;//databasecolumn
									$filesdata[$kd][$kdd] = !is_null($pagestruct[$db_format]) ? $pagestruct[$db_format] : json_decode(constant("IMG_SIZE_" .strtoupper($kd)), true)[$kdd];
									
									if($kdd == "p")
										$filesdata[$kd][$kdd] = $pagestruct[$db_format] == "1" ? true : json_decode(constant("IMG_SIZE_" .strtoupper($kd)), true)[$kdd];
								}
							}
						break;
					}
					if(!is_null($filesdata)) {
						$upimgs = $this->_Upload->uploadImage($locations->path, $filesdata, $imaginaryfolder);//uploadimages
						if($upimgs["img"]) {
							$res["status"] = 1;
							$res["img"] = $upimgs["img"];
							
							$insertdata = array("idpage" => trim(intval($this->uriseg->id)), "img" => $upimgs["img"], "img_ref" => $fileref);
							if(!is_null($imaginaryfolder))
								foreach($imaginaryfolder as $kifolder => $ifolder) $insertdata[$kifolder] = $ifolder;//pushimaginaryfoldertoinsertdata
							
							$insertitem = $this->_Item->msqlInsert($locations->table, $insertdata);
							if($insertitem) $res["id"] = $insertitem;
						}
					}
					echo json_encode($res);
				break;
				case DELETE:
					$res = array("status" => 0);

					$fileid = trim($this->input->post("fileid"));
					$fileref = trim($this->input->post("fileref"));// reference could be "banner1" for "banner"
					
					$locations = (object) ["table" => null, "path" => null];
					$imaginaryfolder = null;//usetrueformultiplefiles[s,m,l]

					//remove Banner
					if(strstr($fileref, "banner")) {
						$locations->path = '../web/' .PATH_IMG_BANNERS;
						$locations->table = TBL_PAGES_BANNERS;
					}
					//remove Poza
					if(strstr($fileref, "poza")) {
						$locations->path = '../web/' .PATH_IMG_PAGINA;
						$locations->table = TBL_PAGES_IMAGES;
						$imaginaryfolder = array("s" => true, "m" => true, "l" => true);
					}
					
					$deleteitem = $this->_Item->RetrieveAndRemove($locations->table, array("id" => intval(trim($fileid)), "idpage" => intval(trim($this->uriseg->id))));
					if($deleteitem) {
						deletefile('../web/' .$locations->path, $deleteitem->img, $imaginaryfolder);

						$res["status"] = 1;
					}					
					echo json_encode($res);
				break;
				
				case BANNERFDATA:
					$res = array("status" => 0);
					
					if(isset($this->uriseg->ajax) && !is_null($this->uriseg->ajax)) {
						
						$ref = !empty($this->input->post("ref")) ? trim($this->input->post("ref")) : null;
						
						$ti = !empty($this->input->post("ti")) ? trim($this->input->post("ti")) : null;
						$sti = !empty($this->input->post("sti")) ? trim($this->input->post("sti")) : null;
						$href1 = !empty($this->input->post("href1")) ? trim($this->input->post("href1")) : null;
						$thref1 = !empty($this->input->post("thref1")) ? trim($this->input->post("thref1")) : null;
						
						if(!is_null($ref)) {
							$data = array("titlu" => $ti, "subtitlu" => $sti, "href1" => $href1, "thref1" => $thref1);
							$conditions = array("idpage" => intval(trim($this->uriseg->id)), "img_ref" => $ref);
							
							
							$updateBanner = $this->_Banner->updateBannerFDATA($data, $conditions);
							if($updateBanner) $res["status"] = 1;
						}
					}
					echo json_encode($res);
				break;
			}
		else show_404();
  }
}
		