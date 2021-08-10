<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// ini_set('xdebug.var_display_max_depth', -1);
// ini_set('xdebug.var_display_max_children', -1);
// ini_set('xdebug.var_display_max_data', -1);

class Galerie_foto extends CI_Controller {
  
  private $ControllerObject;
  
  /**
     * [private Controller]
     * @var [type]
     */
    private $controller;
    private $controller_fake;
    private $controller_ajax;
  
    // @id_link - Of this object
    private $id_link = 112;
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
        $this->load->model("Object_model", "_Object");// model/_Chain
        $this->load->model('Pagini_model', '_Pagini');// model/_Pagini
        $this->load->model("Upload_model", "_Upload");// model/_Upload
        
        $this->load->model("Nodes_model", "_Nodes");
    
        $this->Air = $this->_Nodes->get_air_data_by_air_controller(strtolower($this->controller));
        // print_r($this->Air); die;
        if(!$this->Air) exit("Couldn't find The Air..");
    }

    /**
     * [index description]
     * @return [type] [description]
     */
    public function index()
    {
        $viewdata = array("links" => null, "controller" => $this->controller, "controller_fake" => $this->controller_fake, "controller_ajax" => $this->controller_ajax, "uri" => null, "id_link" => null, "chain_links" => null, "items" => null, "unchainedobjs" => null);
        $viewdata["uri"] = $this->uriseg;
        $viewdata["imgpathitem"] = SITE_URL.PATH_IMG_GALERIEFOTO."m/";

        $childrens = $this->_Nodes->get_all_nodes_by_parent_id($this->id_link);

        if($childrens)
        {
            $viewdata["chain_links"] = $childrens;
        }

        //breacrumb
        $breadcrumb = array("bb_titlu" => "Galerie foto", "bb_button" => null, "breadcrumb" => array());
        $breadcrumb["bb_button"] = array("text" => '<i class="fa fa-plus-square"></i> Creaza sectiune noua', "linkhref" => "legaturi/item/i/parent_id/112");
        
        $breadcrumb["breadcrumb"][0] = array("text" => "Administrare", "url" => '/');
        $breadcrumb["breadcrumb"][1] = array("text" => "Galerie foto", "url" => null);
        
        $view = (object) [ 'html' => array(
                0 => (object) ["viewhtml" => "layout/breadcrumb", "viewdata" => $breadcrumb],
                1 => (object) ["viewhtml" => "galerie_foto/index", "viewdata" => $viewdata]
            ), 'javascript' => array(
                1 => (object) ["viewhtml" => "galerie_foto/js_index", "viewdata" => null],
            )
        ];
        $this->frontend->render($view);
    }
  
    public function sectiune($id_link)
    {
        // var_dump($id_link);
        $viewdata = array("links" => null, "controller" => $this->controller, "controller_fake" => $this->controller_fake, "controller_ajax" => $this->controller_ajax, "uri" => null, "id_link" => null, "chain_links" => null, "items" => null, "unchainedobjs" => null);
        $viewdata["uri"] = $this->uriseg;
        $viewdata["imgpathitem"] = SITE_URL.PATH_IMG_GALERIEFOTO."m/";

        $childrens = $this->_Nodes->get_all_nodes_by_parent_id($this->id_link);

        if($childrens)
        {
            $viewdata["chain_links"] = $childrens;
        }
        
        $items = $this->_Item->msqlGetAll($this->Air->air_table, array("air_id" => $id_link));

        // print_r($items); die;
        if($items)
        {
            foreach($items as $keyitem => $item)
            {
                $item->i = $this->_Item->msqlGetAll($this->Air->air_table_img, array("id_item" => $item->id_item));
            }
            $viewdata["items"] = $items;
        }
        
        $chain = false;

        if($id_link)
        {
            $viewdata["id_link"] = (int)trim($id_link);
          
            $chain = $this->_Chain->getChain($viewdata["id_link"]);
        } 
        else
        {
            redirect("galerie_foto");
        }

        //breacrumb
        $breadcrumb = array("bb_titlu" => "Galerie foto", "bb_button" => null, "breadcrumb" => array());
        $breadcrumb["bb_button"] = array("text" => '<i class="fa fa-plus-square"></i> Creaza sectiune noua', "linkhref" => "legaturi/item/i/parent_id/112/");
        
        $breadcrumb["breadcrumb"][0] = array("text" => "Administrare", "url" => '/');
        $breadcrumb["breadcrumb"][1] = array("text" => "Galerie foto", "url" => null);
        $view = (object) [ 'html' => array(
                0 => (object) ["viewhtml" => "layout/breadcrumb", "viewdata" => $breadcrumb],
                1 => (object) ["viewhtml" => "galerie_foto/index", "viewdata" => $viewdata]
                ), 'javascript' => array(
                1 => (object) ["viewhtml" => "galerie_foto/js_index", "viewdata" => null],
                )
            ];
        $this->frontend->render($view);
    }
  
    /**
     * Item
     */
    public function item()
    {
        $viewdata = array("id_link" => null, "auto_increment" => null, "controller" => $this->controller, "controller_fake" => $this->controller_fake, "controller_ajax" => $this->controller_fake. "/ajax/", "item" => null, "item_links" => null, "links" => null, "uri" => null, "form" => (object) [], "imgpathitem" => null);
        $viewdata["uri"] = $this->uriseg;
        $viewdata["imgpathitem"] = SITE_URL.PATH_IMG_GALERIEFOTO."m/";

        if(isset($this->uriseg->sectiune) && !is_null($this->uriseg->sectiune)) {
            $viewdata["id_link"] = (int)trim($this->uriseg->sectiune);
        }

        // FORM - Item
        $viewdata["form"]->item = (object) ["name" => "item", "prefix" => "it", "segments" => $this->controller_fake. "/item/" .$this->uriseg->item. ($this->uriseg->item == "u" && isset($this->uriseg->id) && !is_null($this->uriseg->id) ? "/id/" .trim(intval($this->uriseg->id)) : "")];
        $viewdata["form"]->item->segments .= '/sectiune/' .$viewdata["id_link"];
    
        $form_submititem = $viewdata["form"]->item->prefix. "submit";//submit<button>
        
        switch($this->uriseg->item)
        {
            case UPDATE:
                if(isset($this->uriseg->id) && !is_null($this->uriseg->id)):

                    $childrens = $this->_Nodes->get_all_nodes_by_parent_id($this->id_link);

                    if($childrens)
                    {
                         $viewdata["links"] = $childrens;
                    }

                    $item = $this->_Item->msqlGet($this->Air->air_table, array("id_item" => trim(intval($this->uriseg->id))));

                    if($item) {
                        $item->i = $this->_Item->msqlGetAll($this->Air->air_table_img, array("id_item" => $item->id_item));
                        $viewdata["item"] = $item;
                    }

                    // $item_links = $this->_Chain->getIIDS_LinksByAnObjectItem($this->ControllerObject->id_object, trim(intval($this->uriseg->id)));
                    // if($item_links) $viewdata["item_links"] = $item_links;

                    /* form @item */
                    if(isset($_REQUEST["{$form_submititem}"])) {
                        $newDBPattern = (object) [ // Design Database Pattern
                            "table" => $this->Air->air_table,
                            "database" => UPDATE,
                            "type" => GET,
                            "design" => array(
                                "item_isactive" => false,
                                "item_parent_fake" => false,
                                "item_name" => false,
                            )
                        ];
                        
                        $update = $this->_Item->UPItem($newDBPattern->table, $viewdata["form"]->item->prefix, $newDBPattern, array("c" => "id_item", "v" => trim(intval($this->uriseg->id))));// update@Item
                        if($update) $this->_Session->setFB_Pozitive(array("ref" => $item->item_name, "text" => "Modificarile tale au fost salvate!"));
                        redirect($viewdata["form"]->item->segments);

                    }
                endif;
            break;

            case INSERT:
                if(is_null($viewdata["id_link"])) {
                    redirect($this->Air->air_controller);
                }

                $auto_increment = $this->_Object->getAUTO_INCREMENT($this->Air->air_table);
                if($auto_increment) {
                  $viewdata["auto_increment"] = 'NR_ORD_' .$auto_increment->AUTO_INCREMENT;
                } else {
                    redirect($this->Air->air_controller);
                }

                /* form @item */
                $redirect = $this->controller_fake;
                if(isset($_REQUEST["{$form_submititem}"]))
                {
                    $newDBPattern = (object) [ // Design Database Pattern
                        "table" => $this->Air->air_table,
                        "database" => INSERT,
                        "type" => PUT,
                        "design" => array(
                            "item_name" => true,
                            "air_id" => $viewdata["id_link"]
                        )
                    ];

                    $insert = $this->_Item->INSItem($newDBPattern->table, $viewdata["form"]->item->prefix, $newDBPattern);// insert@Item

                    if($insert) {
                        // insert obj_content.chain
                        $this->_Object->InsertContent( (int)$this->Air->air_id, (int)$insert, (int)$viewdata["id_link"]);
            
                        $this->_Session->setFB_Pozitive(array("ref" => "Galerie foto", "text" => "Incarca imagine!"));
                        $redirect = $this->controller_fake. "/item/u/id/". $insert; 
                    }
                    redirect($redirect);
                }
            break;
            
            case DELETE:
                if(isset($this->uriseg->id) && !is_null($this->uriseg->id)):
                    $deletecontentitems = $this->_Object->DeleteContentByItem($this->Air->air_id, trim(intval($this->uriseg->id)));
                    
                    $deleteitem = $this->_Item->msqlDelete( $this->Air->air_table, array("id_item" => trim(intval($this->uriseg->id))));
                    
                    $id_item = (int) trim($this->uriseg->id);
                  
                    $images = $this->_Item->msqlGetAll( $this->Air->air_table_img, array("id_item" => $id_item));
                    if($images) {
                        $locations = (object) ["table" => null, "path" => null];
                        $imaginaryfolder = null;//usetrueformultiplefiles[s,m,l]

                        $locations->path = '../web/' .PATH_IMG_GALERIEFOTO;
                        $locations->table = $this->Air->air_table_img;
                        $imaginaryfolder = array("s" => true, "m" => true, "l" => true);
                        
                        foreach($images as $img) {
                            $deleteimg = $this->_Item->RetrieveAndRemove($locations->table, array("id" => intval($img->id), "id_item" => $id_item));
                            if($deleteimg) {
                                deletefile('../web/' .$locations->path, $deleteimg->img, $imaginaryfolder);

                            }
                        }
                    }
          
                    if($deleteitem) {
                        $this->_Session->setFB_Pozitive(array("ref" => "Galerie foto", "text" => "Ai sters o imagine!"));
                        redirect($this->controller_fake);
                    }

                endif;
            break;
       }

        //breacrumb
        $breadcrumb = array("bb_titlu" => "Galerie foto", "bb_button" => null, "breadcrumb" => array());
        $breadcrumb["breadcrumb"][0] = array("text" => "Galerie foto", "url" => $this->controller_fake);
        $breadcrumb["breadcrumb"][1] = array("text" => "Adauga imagine in galerie", "url" => null);

        $view = (object) [ 'html' => array(
                0 => (object) ["viewhtml" => "layout/breadcrumb", "viewdata" => $breadcrumb],
                1 => (object) ["viewhtml" => "galerie_foto/item", "viewdata" => $viewdata]
            ), 'javascript' => array(
                1 => (object) ["viewhtml" => "galerie_foto/js_item", "viewdata" => null],
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
                    $inputfile = "inpfile";
                    $filetarget = trim($this->input->post("filetarget"));//@banner@poza
                    $fileref = trim($this->input->post("fileref"));//@banner1@banner2
                    
                    $pagestruct = $this->_Pagini->getStructure("array", 35);//getpagestructure
                    $locations = (object) ["table" => null, "path" => null];
                    $imaginaryfolder = null;//usetrueformultiplefiles[s,m,l]
                    $filesdata = null;
                    $insertdata = null;
                    switch($this->input->post("filetarget"))
                    {
                        case UPIMGPOZA:
                            $locations->table = $this->Air->air_table_img;
                            $locations->path = '../web/' .PATH_IMG_GALERIEFOTO;
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

                case DELETE:
                    $res = array("status" => 0);

                    $fileid = trim($this->input->post("fileid"));
                    $fileref = trim($this->input->post("fileref"));// reference could be "banner1" for "banner"
                    
                    $locations = (object) ["table" => null, "path" => null];
                    $imaginaryfolder = null;//usetrueformultiplefiles[s,m,l]
                    
                    //remove Poza
                    if(strstr($fileref, "poza")) {
                        $locations->path = '../web/' .PATH_IMG_GALERIEFOTO;
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
