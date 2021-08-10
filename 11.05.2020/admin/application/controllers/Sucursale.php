<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sucursale extends CI_Controller {

	private $Air;

  /**
	 * [private Controller]
	 * @var [type]
	 */
	private $controller;
	private $controller_fake;
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
		
		$this->controller_fake = $this->controller;
    $this->controller_ajax = $this->controller;
		$this->uriseg = json_decode(json_encode($this->uri->uri_to_assoc(2)));

    if(!$this->user->id) redirect("login");
		
    $this->load->model("Item_model", "_Item");// model/_Item
		$this->load->model("Chain_model", "_Chain");// model/_Chain
		$this->load->model("Object_model", "_Object");// model/_Categories
		$this->load->model('Pagini_model', '_Pagini');// model/_Pagini
		$this->load->model("Upload_model", "_Upload");// model/_Upload
		$this->load->model("Nodes_model", "_Nodes");
		$this->load->model("Sucursale_model", "_Sucursale");
		
		$this->Air = $this->_Nodes->get_air_data_by_air_controller(strtolower($this->controller));
		
		if(!$this->Air) exit("Couldn't find The Air..");
		
		// var_dump($this->Air);die();
  }
	
	/**
	 * [proiecte description]
	 * @return [type] [description]
	 */
  public function index()
  {
		
		$viewdata = array("items" => null, "controller_fake" => $this->controller_fake, "uri" => null, "imgpathitem" => null);
		$viewdata["uri"] = $this->uriseg;
		$viewdata["imgpathitem"] = SITE_URL.PATH_IMG_STIRI."m/";
		
		$items = $this->_Item->msqlGetAll($this->Air->air_table);
		if($items) {
			foreach($items as $keyitem => $item) {
				$item->i = $this->_Item->msqlGetAll($this->Air->air_table_img, array("id_item" => $item->atom_id));
			}
			$viewdata["items"] = $items;
		}
		
		//breacrumb
		$breadcrumb = array("bb_titlu" => $this->Air->air_identplural, "bb_button" => null, "breadcrumb" => array());
		$breadcrumb["bb_button"] = array("text" => '<i class="fa fa-plus-square"></i> Adauga ' . strtolower($this->Air->air_identnewitem), "linkhref" => $this->controller_fake ."/item/i");
		
		$breadcrumb["breadcrumb"][0] = array("text" => "Administrare", "url" => '/');
		$breadcrumb["breadcrumb"][1] = array("text" => $this->Air->air_identplural, "url" => null);
    $view = (object) [ 'html' => array(
			0 => (object) ["viewhtml" => "layout/breadcrumb", "viewdata" => $breadcrumb],
      1 => (object) ["viewhtml" => $this->Air->air_controller . "/index", "viewdata" => $viewdata]
      ), 'javascript' => array(
      1 => (object) ["viewhtml" => $this->Air->air_controller . "/js_index", "viewdata" => null],
      )
    ];
    $this->frontend->render($view);
  }	
	
	public function chosen_request_page_assoc()
	{
		$res = array("status" => 0, "id" => null);
		
		$atom_id = (!empty($this->input->post("atom_id")))
			? $this->input->post("atom_id") : null;		
		
		$params = (!empty($this->input->post("params")))
			? $this->input->post("params") : null;
			
		if(!is_null($atom_id) && !is_null($params))
		{
			foreach($params as $action => $proiect_id_assoc)
			{
				switch($action)
				{
					case 'selected':
						$id = $this->_Sucursale->insert_proiect_assoc($atom_id, $proiect_id_assoc);
						break;
					case 'deselected':
						$this->_Sucursale->remove_proiect_assoc($atom_id, $proiect_id_assoc);
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
						$id = $this->_Sucursale->insert_breadcrumbs_assoc($id_page, $id_page_assoc);
						break;
					case 'deselected':
						$this->_Sucursale->remove_breadcrumbs_assoc($id_page, $id_page_assoc);
						break;
				}
			}
		}
		$res["status"] = 1;
		header('Content-Type: application/json');
		exit(json_encode($res));
		//echo "aaaa";die();
		
	}	
	/**
	 * Item
	 */
	public function item()
	{
		
		if((int)$this->UserModel->user->privilege > 2)
		{
			if(!$this->_Nodes->airdrop_check_if_user_has_access((int)trim($this->uriseg->id), (int)$this->UserModel->user->id))
			{
				$this->_Session->setFB_Negative(array("ref" => 'Contacteaza administratorul', "text" => "Nu ai acces la acest item."));
				redirect($this->controller_fake);
			}
		}		
		
		$viewdata = array("controller" => $this->controller, "nodes" => null, "controller_fake" => $this->controller_fake, "controller_ajax" => $this->controller_fake. "/ajax/", "item" => null, "item_links" => null, "air" => $this->Air, "uri" => null, "form" => (object) [], "imgpathitem" => null, "airdrop" => null);
		$viewdata["uri"] = $this->uriseg;
		$viewdata["imgpathitem"] = SITE_URL.PATH_IMG_STIRI."m/";
		// var_dump($this->uriseg);
		$viewdata["investitii"] = null;
		$viewdata["investitii_assoc"] = null;
		
	
		// FORM - Item
		$viewdata["form"]->item = (object) ["name" => "item", "prefix" => "it", "segments" => $this->controller_fake. "/item/" .$this->uriseg->item. ($this->uriseg->item == "u" && isset($this->uriseg->id) && !is_null($this->uriseg->id) ? "/id/" .trim(intval($this->uriseg->id)) : "")];
		$form_submititem = $viewdata["form"]->item->prefix. "submit";//submit<button>	
		
		// FORM - date contact
        $viewdata["form"]->date_contact = (object) ["name" => "date_contact", "prefix" => "dt", "segments" => $this->controller_fake. "/item/" .$this->uriseg->item. ($this->uriseg->item == "u" && isset($this->uriseg->id) && !is_null($this->uriseg->id) ? "/id/" .trim(intval($this->uriseg->id)) : "")];
        $form_submit_date_contact = $viewdata["form"]->date_contact->prefix. "submit";//submit<button>
		
		switch($this->uriseg->item)
    {
      case UPDATE:
		if(isset($this->uriseg->id) && !is_null($this->uriseg->id)):
			
			$viewdata["investitii"] = $this->_Item->msqlGetAll('proiecte');
			
			if(!empty($viewdata["investitii"]))
			{
				if($investitii_assoc = $this->_Sucursale->get_all_assoc_proiecte($this->uriseg->id))
				{
					$viewdata["investitii_assoc"] = $investitii_assoc;
				}
			}
			
			$temp_nodes = array();
			// Nodes
			if(!is_null($this->Air->targeted_nodes))
			{
				// fetching all Nodes by conditions - each id each node
				if($get_all_nodes_by_conditions = $this->_Nodes->get_all_nodes_by_conditions(json_decode($this->Air->targeted_nodes)))
				{
					// $temp_nodes += $get_all_nodes_by_conditions;
					$temp_nodes = array_merge($temp_nodes, $get_all_nodes_by_conditions);
				}
				
			}
			if(!is_null($this->Air->targeted_node_id))
			{
				// fetching all Nodes by the Root specified(taken all his childrens)
				if($get_all_nodes_by_node = $this->_Nodes->get_all_nodes_by_node($this->Air->targeted_node_id))
				{
					// $temp_nodes += $get_all_nodes_by_node;
					$temp_nodes = array_merge($temp_nodes, $get_all_nodes_by_node);
				}
			}
			if(!empty($temp_nodes))
			{
				foreach($temp_nodes as $tnk => $tn)
				{
					
					$first_node = $this->_Nodes->getFatherNode($tn["node_id"]);
					if($first_node)
						$temp_nodes[$tnk]["denumire_ro"] = $first_node->denumire_ro . ' > ' . $temp_nodes[$tnk]["denumire_ro"];
				}
				
				$viewdata["nodes"] = $temp_nodes;
			}

				
			if($pages = $this->_Pagini->get_all_pages())
			{
				$viewdata["pages"] = $pages;
				if($pages_assoc = $this->_Sucursale->get_all_assoc_breadcrumbs_sucursale($this->uriseg->id))
				{
					$viewdata["page_pages"] = $pages_assoc;
					// echo '<pre>';
					// print_r($viewdata["page_pages"]);
					// echo '</pre>';
					// die();
				}
				if($breadcrumb_assoc = $this->_Sucursale->get_all_assoc_breadcrumbs_sucursale($this->uriseg->id))
				{
					$viewdata["breadcrumb_assoc"] = $breadcrumb_assoc;
				}
			}					
						
		
			$item = $this->_Item->msqlGet($this->Air->air_table, array("atom_id" => trim(intval($this->uriseg->id))));
			if($item) {
				$item->i = $this->_Item->msqlGetAll($this->Air->air_table_img, array("id_item" => $item->atom_id));
				$viewdata["item"] = $item;
				
				if($airdrop = $this->_Nodes->airdrop_get_all_nodes_ids_assoc_by_atom($this->Air->air_id, $viewdata["item"]->atom_id))
				{
					$viewdata["airdrop"] = $airdrop;
				}
			}
			
			/* form @item */
			if(isset($_REQUEST["{$form_submititem}"])) {
			
				$newDBPattern = (object) [ // Design Database Pattern
					"table" => $this->Air->air_table,
					"database" => UPDATE,
					"type" => GET,
					"design" => array(
						"item_isactive" => false,
						"item_parent_fake" => false,
						"insert_date" => false,
						"pdf_name" => false,
						"pdf_file" => false
					)
				]; 
				$update = $this->_Item->UPItem($newDBPattern->table, $viewdata["form"]->item->prefix, $newDBPattern, array("c" => "atom_id", "v" => trim(intval($this->uriseg->id))));// update@Item
				if($update) $this->_Session->setFB_Pozitive(array("ref" => $item->item_name, "text" => "Modificarile tale au fost salvate!"));
				redirect($viewdata["form"]->item->segments);

			} elseif(isset($_REQUEST["{$form_submit_date_contact}"])) {
				//var_dump($viewdata["form"]->date_contact->prefix);die();
				$newDBPattern = (object) [ // Design Database Pattern
					"table" => 'sucursale',
					"database" => UPDATE,
					"type" => GET,
					"design" => array()
				]; 
				$update = $this->_Item->UPItem($newDBPattern->table, $viewdata["form"]->date_contact->prefix, $newDBPattern, array("c" => "atom_id", "v" => trim(intval($this->uriseg->id))));// update@Item
				if($update) $this->_Session->setFB_Pozitive(array("ref" => $item->item_name, "text" => "Modificarile tale au fost salvate!"));
				redirect($viewdata["form"]->date_contact->segments);
				}
		endif;
      break;

      case INSERT:
				/* form @item */
				$redirect = $this->controller_fake;
        if(isset($_REQUEST["{$form_submititem}"])) {
				
					$newDBPattern = (object) [ // Design Database Pattern
						"table" => $this->Air->air_table,
						"database" => INSERT,
						"type" => PUT,
						"design" => array(
							"atom_name_ro" => true,
							"air_id" => $this->Air->air_id,
							"insert_date" => date("Y-m-d H:i:s")
						)
					]; 
					$insert = $this->_Item->INSItem($newDBPattern->table, $viewdata["form"]->item->prefix, $newDBPattern);// insert@Item
					
					if($insert) {
						$this->_Session->setFB_Pozitive(array("ref" => "Servicii", "text" => "Ai adaugat un Text diverse!"));
						$redirect = $this->controller_fake. "/item/u/id/". $insert; 
					}
					redirect($redirect);
        }
      break;
			
			case DELETE:
				if(isset($this->uriseg->id) && !is_null($this->uriseg->id))
				{
					$data = new stdClass();
					
					$data->air_id = (int)$this->Air->air_id;
					$data->atom_id = (int)trim($this->uriseg->id);
		
					$this->_Nodes->airdrop_rem_airdrops($data);
					$this->_Item->msqlDelete($this->Air->air_table, array("atom_id" => $data->atom_id));
					$this->_Session->setFB_Pozitive(array("ref" => $this->Air->air_identplural, "text" => 'Ai sters un Text divers!'));
					redirect($this->Air->air_controller);
				}
				break;
			break;
   }	
	
		
		//breacrumb
		$breadcrumb = array("bb_titlu" => $this->Air->air_identplural, "bb_button" => null, "breadcrumb" => array());
		
		$breadcrumb["breadcrumb"][0] = array("text" => $this->Air->air_identplural, "url" => $this->controller_fake);
		$breadcrumb["breadcrumb"][1] = array("text" => $this->Air->air_identnewitem, "url" => null);
    $view = (object) [ 'html' => array(
			0 => (object) ["viewhtml" => "layout/breadcrumb", "viewdata" => $breadcrumb],
      1 => (object) ["viewhtml" => $this->Air->air_controller .  "/item", "viewdata" => $viewdata]
      ), 'javascript' => array(
      1 => (object) ["viewhtml" => $this->Air->air_controller .  "/js_item", "viewdata" => null],
      )
    ];
    $this->frontend->render($view);	
	}
	
	/**
	 * [Ajax description]
	 */
  public function Ajax()
	{
		
		if(!empty($this->uriseg->ajax) && isset($this->uriseg->id) && !is_null($this->uriseg->id))
	    switch($this->uriseg->ajax)
			{
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
				
				case LINKREQUEST:
					$res = array("status" => 0);
					
					$params = !empty($this->input->post("params")) ? $this->input->post("params") : null;
					foreach($params as $paramaction => $param) {
						$paction = $paramaction;
						$pparam = $param;
					}
					
					if($paction == "selected")
						$actdb = $this->_Object->InsertContent('atom_id', $this->uriseg->id, $pparam);
					elseif($paction == "deselected")
						$actdb = $this->_Object->DeleteContent('atom_id', $this->uriseg->id, $pparam);

					if($actdb) $res["status"] = 1;
					
					header("Content-Type: application/json");
					echo json_encode($res);
				break;
				
				case UPLOADIMG:
					$res = array("status" => 0, "id" => null);
					$inputfile = "inpfile";
					$filetarget = trim($this->input->post("filetarget"));//@banner@poza
					$fileref = trim($this->input->post("fileref"));//@banner1@banner2
					
					$pagestruct = $this->_Pagini->getStructure("array", 81);//getpagestructure
					$locations = (object) ["table" => null, "path" => null];
					$imaginaryfolder = null;//usetrueformultiplefiles[s,m,l]
					$filesdata = null;
					$insertdata = null;
					switch($this->input->post("filetarget"))
					{
						case UPIMGPOZA:
							$locations->table = $this->Air->air_table_img;
							$locations->path = '../web/' .PATH_IMG_STIRI;
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
							
							$insertdata = array("id_item" => trim(intval($this->uriseg->id)), "img" => $upimgs["img"], "img_ref" => $fileref);
							if(!is_null($imaginaryfolder))
								foreach($imaginaryfolder as $kifolder => $ifolder) $insertdata[$kifolder] = $ifolder;//pushimaginaryfoldertoinsertdata
							
							$insertitem = $this->_Item->msqlInsert($locations->table, $insertdata);
							if($insertitem) $res["id"] = $insertitem;
						}
					}
					echo json_encode($res);
				break;
				case "pdf":
					// echo 'x';die();
				break;

				case DELETE:
					$res = array("status" => 0);

					$fileid = trim($this->input->post("fileid"));
					$fileref = trim($this->input->post("fileref"));// reference could be "banner1" for "banner"
					
					$locations = (object) ["table" => null, "path" => null];
					$imaginaryfolder = null;//usetrueformultiplefiles[s,m,l]
					
					//remove Poza
					if(strstr($fileref, "poza")) {
						$locations->path = '../web/' .PATH_IMG_STIRI;
						$locations->table = $this->Air->air_table_img;
						$imaginaryfolder = array("s" => true, "m" => true, "l" => true);
					}
					
					$deleteitem = $this->_Item->RetrieveAndRemove($locations->table, array("id" => intval(trim($fileid)), "id_item" => intval(trim($this->uriseg->id))));
					if($deleteitem) {
						deletefile('../web/' .$locations->path, $deleteitem->img, $imaginaryfolder);

						$res["status"] = 1;
					}					
					echo json_encode($res);
				break;
			}
		else show_404();
  }
}
