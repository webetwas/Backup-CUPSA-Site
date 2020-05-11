<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setari_pdf extends CI_Controller {

    private $ControllerObject;

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

        // $this->ControllerObject = $this->_Object->getObjectStructure(strtolower($this->controller));
        // if(!$this->ControllerObject) exit("Couldn't find Controller's Object");
        // var_dump($this->ControllerObject);die();
    }

    /**
     * [proiecte description]
     * @return [type] [description]
     */
  public function index()
  {
        $viewdata = array("items" => null, "controller_fake" => $this->controller_fake, "uri" => null, "imgpathitem" => null);
        $viewdata["uri"] = $this->uriseg;
        $viewdata["imgpathitem"] = SITE_URL.PATH_IMG_GALERIEFOTO."m/";

        $items = $this->_Item->msqlGetAll(DB_DECLARATII_AVERE);

        if($items)
        {
            // foreach($items as $keyitem => $item)
            // {
                // $item->i = $this->_Item->msqlGetAll($this->ControllerObject->obj_table_img, array("id_item" => $item->id_item));
            // }
            $viewdata["items"] = $items;
        }

        //breacrumb
        $breadcrumb = array("bb_titlu" => "Declaratii avere PDF", "bb_button" => null, "breadcrumb" => array());
        $breadcrumb["bb_button"] = array("text" => '<i class="fa fa-plus-square"></i> Adauga pdf', "linkhref" => $this->controller_fake ."/item/i");
        
        $breadcrumb["breadcrumb"][0] = array("text" => "Administrare", "url" => '/');
        $breadcrumb["breadcrumb"][1] = array("text" => "Declaratii Avere (PDF)", "url" => null);
        $view = (object) [ 'html' => array(
                0 => (object) ["viewhtml" => "layout/breadcrumb", "viewdata" => $breadcrumb],
                1 => (object) ["viewhtml" => "declaratii_avere/index", "viewdata" => $viewdata]
            )
        ];
        $this->frontend->render($view);
    }
    /**
     * Item
     */
    public function item()
    {
        $viewdata = array("controller" => $this->controller, "controller_fake" => $this->controller_fake, "controller_ajax" => $this->controller_fake. "/ajax/", "item" => null, "last_id" => 1, "item_links" => null, "links" => null, "uri" => null, "form" => (object) [], "imgpathitem" => null);
        $viewdata["uri"] = $this->uriseg;
        $viewdata["imgpathitem"] = SITE_URL.PATH_IMG_GALERIEFOTO."m/";
        // var_dump($this->uriseg);
    
        // FORM - Item
        $viewdata["form"]->item = (object) ["name" => "item", "prefix" => "it", "segments" => $this->controller_fake. "/item/" .$this->uriseg->item. ($this->uriseg->item == "u" && isset($this->uriseg->id) && !is_null($this->uriseg->id) ? "/id/" .trim(intval($this->uriseg->id)) : "")];
        $form_submititem = $viewdata["form"]->item->prefix. "submit";//submit<button>
    
        // FORM - Meta
        $viewdata["form"]->meta = (object) ["name" => "meta", "prefix" => "mt", "segments" => $this->controller_fake. "/item/" .$this->uriseg->item. ($this->uriseg->item == "u" && isset($this->uriseg->id) && !is_null($this->uriseg->id) ? "/id/" .trim(intval($this->uriseg->id)) : "")];
        $form_submitmeta = $viewdata["form"]->meta->prefix. "submit";//submit<button>

        $structura_info = $this->_Item->msqlGetAll(DB_STRUCTURA_MANAGERIALE . "_info");

        if($structura_info)
        {
            $viewdata["structura_info"] = $structura_info;
        }
        
        switch($this->uriseg->item)
        {
            case UPDATE:
                if(isset($this->uriseg->id) && !is_null($this->uriseg->id)):

                    $item = $this->_Item->msqlGet(DB_DECLARATII_AVERE, array("id_item" => trim(intval($this->uriseg->id))));

                    if($item)
                    {
                        $viewdata["item"] = $item;
                    }

                    /* form @item */
                    if(isset($_REQUEST["{$form_submititem}"]))
                    {
                        !empty($this->input->post("{$viewdata["form"]->item->prefix}nume")) ? $http_id = str_replace(" ", "_", trim(strtolower($this->input->post("{$viewdata["form"]->item->prefix}nume")))) : $http_id = false;

                        $newDBPattern = (object) [ // Design Database Pattern
                            "table" => DB_DECLARATII_AVERE,
                            "database" => UPDATE,
                            "type" => PUT,
                            "design" => array(
                                // "item_key" => false,
                                "nume" => true,
                                "prenume" => true,
                                "functie" => true,
                                "id_info" => true
                            )
                        ]; 
                        $update = $this->_Item->UPItem($newDBPattern->table, $viewdata["form"]->item->prefix, $newDBPattern, array("c" => "id_item", "v" => trim(intval($this->uriseg->id))));// update@Item
                        if($update) $this->_Session->setFB_Pozitive(array("ref" => "Declaratii Avere", "text" => "Modificarile tale au fost salvate!"));
                        redirect($viewdata["form"]->item->segments);
                        // print($viewdata);die();
                    }
                    
                endif;
            break;

            case INSERT:
               
                $last_id = $this->_Item->getLastIdIncremented(DB_DECLARATII_AVERE);

                if($last_id)
                {
                    if(!is_null($last_id->id_item))
                        $viewdata["last_id"] = $last_id->id_item +1;
                }

                /* form @item */
                $redirect = $this->controller_fake;

                if(isset($_REQUEST["{$form_submititem}"]))
                {
                    $newDBPattern = (object) [ // Design Database Pattern
                        "table" => DB_DECLARATII_AVERE,
                        "database" => INSERT,
                        "type" => PUT,
                        "design" => array(
                            "item_key" => true,
                        )
                    ];
                    $insert = $this->_Item->INSItem($newDBPattern->table, $viewdata["form"]->item->prefix, $newDBPattern);// insert@Item

                    if($insert)
                    {
                        $this->_Session->setFB_Pozitive(array("ref" => "Declaratii Avere", "text" => "Ai adaugat o inregistrare noua!"));
                        $redirect = $this->controller_fake. "/item/u/id/". $insert; 
                    }
                    redirect($redirect);
                }
            break;

            case DELETE:
                if(isset($this->uriseg->id) && !is_null($this->uriseg->id)):
                    $location_path= '../web/' .PATH_DECLARATII_AVERE;
                    $deleteitem = $this->_Item->RetrieveAndRemove(DB_DECLARATII_AVERE, array("id_item" => trim(intval($this->uriseg->id))));

                    if($deleteitem)
                    {
                        deletefile('../web/' .$location_path, $deleteitem->pdf_decl_avere);
                        deletefile('../web/' .$location_path, $deleteitem->pdf_decl_interes);
                        $this->_Session->setFB_Pozitive(array("ref" => "Declaratii Avere", "text" => "Ai sters o inregistrare!"));
                        redirect($this->controller_fake);
                    }

                endif;
            break;
        }

        //breacrumb
        $breadcrumb = array("bb_titlu" => "Declaratii Avere", "bb_button" => null, "breadcrumb" => array());
        
        $breadcrumb["breadcrumb"][0] = array("text" => "Declaratii Avere", "url" => $this->controller_fake);
        $breadcrumb["breadcrumb"][1] = array("text" => "Adauga", "url" => null);
        $view = (object) [ 'html' => array(
                0 => (object) ["viewhtml" => "layout/breadcrumb", "viewdata" => $breadcrumb],
                1 => (object) ["viewhtml" => "declaratii_avere/item", "viewdata" => $viewdata]
            ), 'javascript' => array(
                1 => (object) ["viewhtml" => "declaratii_avere/js_item", "viewdata" => null],
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
                
                $path = '../web/' . PATH_DECLARATII_AVERE . 'cv_folder';
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
                    DB_DECLARATII_AVERE,
                    array(
                        'cv_pdf' => $file["base"]
                    ),
                    array(
                        'c' => 'id_item',
                        'v' => $this->uriseg->id
                    )
                );
                
                $res["status"] = 1;
                $res["file"] = $file["base"];
                
                echo json_encode($res);
                break;
            case "delpdf":
                $res = array('status' => 0, 'error' => null);
                
                $path = '../web/' . PATH_DECLARATII_AVERE . 'cv_folder';
                $item = $this->_Item->msqlGet(DB_DECLARATII_AVERE, array('id_item' => $this->uriseg->id));
                
                if($item === false)
                {
                    // item not found
                    $res["error"] = 'A aparut o eroare.. te rugam sa incerci din nou.';
                    echo json_encode($res);
                    exit();
                }
                
                $this->_Upload->delete_file($path, $item->pdf_file);
                $this->_Item->msqlUpdate(
                    DB_DECLARATII_AVERE,
                    array(
                        'cv_pdf' => null
                    ),
                    array(
                        'c' => 'id_item',
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
                        $actdb = $this->_Object->InsertContent($this->ControllerObject->id_object, $this->uriseg->id, $pparam);
                    elseif($paction == "deselected")
                        $actdb = $this->_Object->DeleteContent($this->ControllerObject->id_object, $this->uriseg->id, $pparam);

                    if($actdb) $res["status"] = 1;
                    
                    header("Content-Type: application/json");
                    echo json_encode($res);
                break;

                case UPLOADIMG:
                    $res = array("status" => 0, "id" => null);
                    $inputfile_avere = "inpfile_avere";
                    $inputfile_interes = "inpfile_interes";
                    $filetarget = trim($this->input->post("filetarget"));//@banner@poza
                    $fileref = trim($this->input->post("fileref"));//@banner1@banner2
                    $an = trim($this->input->post("an"));//@banner1@banner2

                    $locations = (object) ["table" => null, "path" => null];

                    $filesdata = 1;
                    $insertdata = null;

                    switch($this->input->post("filetarget"))
                    {
                        case UPIMGPOZA:
                            $locations->table = DB_DECLARATII_AVERE;
                            $locations->path = '../web/' .PATH_DECLARATII_AVERE;

                            $file_upload_avere = process_upload_file($inputfile_avere, $locations->path);
                            $file_upload_interes = process_upload_file($inputfile_interes, $locations->path);

                            if($file_upload_avere)
                            {
                                $res["status"] = 1;
                                $res["an"] = $an;
                                $res["pdf_avere"] = $file_upload_avere;
                                
                                $id_item_x = array("id_item" => trim(intval($this->uriseg->id)));
                                $insertdata = array("pdf_decl_avere_" . $an => $file_upload_avere);

                                $insertitem = $this->_Item->updateItem($locations->table, $insertdata, $id_item_x);
                                if($insertitem) $res["id"] = $insertitem->id_item;
                            }
                            
                            if($file_upload_interes)
                            {
                                $res["status"] = 1;
                                $res["an"] = $an;
                                $res["pdf_interes"] = $file_upload_interes;
                                
                                $id_item_x = array("id_item" => trim(intval($this->uriseg->id)));
                                $insertdata = array("pdf_decl_interes_" . $an => $file_upload_interes);

                                $insertitem = $this->_Item->updateItem($locations->table, $insertdata, $id_item_x);
                                if($insertitem) $res["id"] =  $insertitem->id_item;
                            }

                        break;
                    }
                    echo json_encode($res);
                break;

                case DELETE:
                    $res = array("status" => 0);

                    $fileid = trim($this->input->post("fileid"));
                    $fileref = trim($this->input->post("fileref"));// reference could be "banner1" for "banner"
                    $an = trim($this->input->post("an"));// reference could be "banner1" for "banner"
                    
                    $locations = (object) ["table" => null, "path" => null];
                    $imaginaryfolder = null;//usetrueformultiplefiles[s,m,l]
                    
                    //remove Poza
                    if(strstr($fileref, "avere") || strstr($fileref, "interes"))
                    {
                        $locations->path = '../web/' .PATH_DECLARATII_AVERE;
                        $locations->table = DB_DECLARATII_AVERE;
                    }
                    
                    if($fileref == "avere")
                    {
                        $id_item_x = array("id_item" => trim(intval($this->uriseg->id)));
                        $insertdata = array("pdf_decl_avere_" .$an => null);
                    }

                    if($fileref == "interes")
                    {
                        $id_item_x = array("id_item" => trim(intval($this->uriseg->id)));
                        $insertdata = array("pdf_decl_interes_" .$an => null);
                    }

                    $insertitem = $this->_Item->updateItem($locations->table, $insertdata, $id_item_x);
                    // print_r($insertitem); die();
                    // $deleteitem = $this->_Item->RetrieveAndRemove($locations->table, array("id" => intval(trim($fileid)), "id_item" => intval(trim($this->uriseg->id))));
                    if($insertitem && $fileref == "avere")
                    {
                        deletefile('../web/' .$locations->path, $insertitem->pdf_decl_avere);
                        $res["status"] = 1;
                    }

                    if($insertitem && $fileref == "interes")
                    {
                        deletefile('../web/' .$locations->path, $insertitem->pdf_decl_interes);
                        $res["status"] = 1;
                    }
                    echo json_encode($res);
                break;
            }
        else show_404();
    }
}