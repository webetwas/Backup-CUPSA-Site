<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Factura_electronica extends CI_Controller {

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
        $items = $this->_Item->msqlGetAll("factura_electronica");
        $viewdata["items"] = $items;
        if(isset($items))
        {
            // foreach($items as $keyitem => $item)
            // {
                // $item->i = $this->_Item->msqlGetAll($this->ControllerObject->obj_table_img, array("id_item" => $item->id_item));
            // }
           
        }

       
        
        //breacrumb
        $breadcrumb = array("bb_titlu" => "Factura Electronica", "breadcrumb" => array());
        
        $breadcrumb["breadcrumb"][0] = array("text" => "Administrare", "url" => '/');
        $breadcrumb["breadcrumb"][1] = array("text" => "factura Electronica", "url" => null);
        $view = (object) [ 'html' => array(
            0 => (object) ["viewhtml" => "layout/breadcrumb", "viewdata" => $breadcrumb],
            1 => (object) ["viewhtml" => "factura_electronica/index", "viewdata" => $viewdata]
            )
        ];
    $this->frontend->render($view);
    }
    /**
     * Item
     */
   
    
}		