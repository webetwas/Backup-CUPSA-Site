<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Structura_manageriala extends CI_Controller {

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
        $viewdata = array( 
            "items" => null, 
            "controller_fake" => $this->controller_fake, 
            "uri" => null, 
            "imgpathitem" => null,
            "structura_info" => null,
        );
        $viewdata["uri"] = $this->uriseg;
        $viewdata["imgpathitem"] = SITE_URL.PATH_IMG_GALERIE_FOTO."m/";

        $items = $this->_Item->msqlGetAll(DB_STRUCTURA_MANAGERIALE);

        if($items)
        {
            // foreach($items as $keyitem => $item)
            // {
                // $item->i = $this->_Item->msqlGetAll($this->ControllerObject->obj_table_img, array("id_item" => $item->id_item));
            // }
            $viewdata["items"] = $items;
        }

        $structura_info = $this->_Item->msqlGetAll(DB_STRUCTURA_MANAGERIALE . "_info");
        
        if($structura_info)
        {
            $viewdata["structura_info"] = $structura_info;
        }
        
        //breacrumb
        $breadcrumb = array("bb_titlu" => "Structura Manageriala", "bb_button" => null, "breadcrumb" => array());
        $breadcrumb["bb_button"] = array("text" => '<i class="fa fa-plus-square"></i> Adauga persoana', "linkhref" => $this->controller_fake ."/item/i");
        
        $breadcrumb["breadcrumb"][0] = array("text" => "Administrare", "url" => '/');
        $breadcrumb["breadcrumb"][1] = array("text" => "Structura Manageriala (PDF)", "url" => null);
        $view = (object) [ 'html' => array(
            0 => (object) ["viewhtml" => "layout/breadcrumb", "viewdata" => $breadcrumb],
            1 => (object) ["viewhtml" => "structura_manageriala/index", "viewdata" => $viewdata]
            )
        ];
    $this->frontend->render($view);
    }
    /**
     * Item
     */
    public function item()
    {
        $viewdata = array("controller" => $this->controller, "controller_fake" => $this->controller_fake, "controller_ajax" => $this->controller_fake. "/ajax/", "item" => null, "last_id" => 1, "item_links" => null, "links" => null, "uri" => null, "form" => (object) [], "imgpathitem" => null, "structura_info" => null);
        $viewdata["uri"] = $this->uriseg;
        $viewdata["imgpathitem"] = SITE_URL.PATH_IMG_GALERIE_FOTO."m/";
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

                    $item = $this->_Item->msqlGet(DB_STRUCTURA_MANAGERIALE, array("id_item" => trim(intval($this->uriseg->id))));

                    if($item)
                    {
                        $viewdata["item"] = $item;
                    }

                    /* form @item */
                    if(isset($_REQUEST["{$form_submititem}"]))
                    {
                        !empty($this->input->post("{$viewdata["form"]->item->prefix}nume")) ? $http_id = str_replace(" ", "_", trim(strtolower($this->input->post("{$viewdata["form"]->item->prefix}nume")))) : $http_id = false;

                        $newDBPattern = (object) [ // Design Database Pattern
                            "table" => DB_STRUCTURA_MANAGERIALE,
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
                        if($update) $this->_Session->setFB_Pozitive(array("ref" => "Structura Manageriala", "text" => "Modificarile tale au fost salvate!"));
                        redirect($viewdata["form"]->item->segments);
                        // print($viewdata);die();
                    }
                    
                endif;
            break;

            case INSERT:
               
                $last_id = $this->_Item->getLastIdIncremented(DB_STRUCTURA_MANAGERIALE);

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
                        "table" => DB_STRUCTURA_MANAGERIALE,
                        "database" => INSERT,
                        "type" => PUT,
                        "design" => array(
                            "item_key" => true,
                        )
                    ];
                    $insert = $this->_Item->INSItem($newDBPattern->table, $viewdata["form"]->item->prefix, $newDBPattern);// insert@Item

                    if($insert)
                    {
                        $this->_Session->setFB_Pozitive(array("ref" => "Structura Manageriala", "text" => "Ai adaugat o inregistrare noua!"));
                        $redirect = $this->controller_fake. "/item/u/id/". $insert; 
                    }
                    redirect($redirect);
                }
            break;

            case DELETE:
                if(isset($this->uriseg->id) && !is_null($this->uriseg->id)):
                    $location_path= '../web/' .PATH_STRUCTURA_MANAGERIALA;
                    $deleteitem = $this->_Item->RetrieveAndRemove(DB_STRUCTURA_MANAGERIALE, array("id_item" => trim(intval($this->uriseg->id))));

                    if($deleteitem)
                    {
                        deletefile('../web/' .$location_path, $deleteitem->pdf);
                        $this->_Session->setFB_Pozitive(array("ref" => "Structura Manageriala", "text" => "Ai sters o inregistrare!"));
                        redirect($this->controller_fake);
                    }

                endif;
            break;
        }

        //breacrumb
        $breadcrumb = array("bb_titlu" => "Structura Manageriala", "bb_button" => null, "breadcrumb" => array());
        
        $breadcrumb["breadcrumb"][0] = array("text" => "Structura Manageriala", "url" => $this->controller_fake);
        $breadcrumb["breadcrumb"][1] = array("text" => "Adauga persoana", "url" => null);
        $view = (object) [ 'html' => array(
                0 => (object) ["viewhtml" => "layout/breadcrumb", "viewdata" => $breadcrumb],
                1 => (object) ["viewhtml" => "structura_manageriala/item", "viewdata" => $viewdata]
            ), 'javascript' => array(
                1 => (object) ["viewhtml" => "structura_manageriala/js_item", "viewdata" => null],
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
                    $inpfile_file = "inpfile_file";
                    
                    $filetarget = trim($this->input->post("filetarget"));//@banner@poza
                    $fileref = trim($this->input->post("fileref"));//@banner1@banner2
                    $an = trim($this->input->post("an"));//@banner1@banner2

                    $locations = (object) ["table" => null, "path" => null];

                    $filesdata = 1;
                    $insertdata = null;

                    switch($this->input->post("filetarget"))
                    {
                        case UPIMGPOZA:
                            $locations->table = DB_STRUCTURA_MANAGERIALE;
                            $locations->path = '../web/' .PATH_STRUCTURA_MANAGERIALA;

                            $file_upload = process_upload_file($inpfile_file, $locations->path);

                            if($file_upload)
                            {
                                $res["status"] = 1;
                                $res["pdf"] = $file_upload;
                                
                                $id_item_x = array("id_item" => trim(intval($this->uriseg->id)));
                                $insertdata = array("pdf" => $file_upload);

                                $insertitem = $this->_Item->updateItem($locations->table, $insertdata, $id_item_x);
                                if($insertitem) $res["id"] = $insertitem->id_item;
                            }

                        break;
                    }
                    echo json_encode($res);
                break;

                case DELETE:
                    $res = array("status" => 0);

                    $fileid = trim($this->input->post("fileid"));
                    $fileref = trim($this->input->post("fileref"));// reference could be "banner1" for "banner"

                    $locations = (object) ["table" => null, "path" => null];
                    $imaginaryfolder = null;//usetrueformultiplefiles[s,m,l]
                    
                    //remove Poza
                    if(strstr($fileref, "pdf"))
                    {
                        $locations->path = '../web/' .PATH_STRUCTURA_MANAGERIALA;
                        $locations->table = DB_STRUCTURA_MANAGERIALE;
                    }
                    
                    if($fileref == "pdf")
                    {
                        $id_item_x = array("id_item" => trim(intval($this->uriseg->id)));
                        $insertdata = array("pdf" => null);
                    }

                    $insertitem = $this->_Item->updateItem($locations->table, $insertdata, $id_item_x);
                    // print_r($insertitem); die();
                    // $deleteitem = $this->_Item->RetrieveAndRemove($locations->table, array("id" => intval(trim($fileid)), "id_item" => intval(trim($this->uriseg->id))));
                    if($insertitem && $fileref == "pdf")
                    {
                        deletefile('../web/' .$locations->path, $insertitem->pdf);
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