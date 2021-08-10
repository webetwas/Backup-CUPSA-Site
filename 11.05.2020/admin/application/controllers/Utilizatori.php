<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Utilizatori extends CI_Controller {

    private $controller;
    private $controller_fake;
    private $controller_ajax;

    public function __construct() {
        parent::__construct(); // Your own constructor code
        include('__construct.php');

        $this->controller       = $this->router->fetch_class();
        $this->controller_fake  = "ae/" .$this->controller;
        $this->controller_ajax  = $this->controller;
        $this->uriseg = json_decode(json_encode($this->uri->uri_to_assoc(3)));

        $this->user_logat = $this->_User->getUser($this->user->id, null);
		
		if((int)$this->UserModel->user->privilege > 2)
		{
			redirect('/');
		}
    }

    public function index()
    {
        $breadcrumb = array("bb_titlu" => "Utilizatori", "bb_button" => null, "breadcrumb" => array());
        $breadcrumb["breadcrumb"][0] = array("text" => "Dashboard", "url" => '');
        $breadcrumb["breadcrumb"][1] = array("text" => "Utilizatori", "url" => '');
        $breadcrumb["bb_button"] = array("text" => '<i class="fa fa-plus-square"></i> Adaugă utilizator', "linkhref" => $this->controller_fake . "/item/i" );

        $data['utilizatori'] = $this->_Platforma->getUsers();
        $data['utilizatori_permisii'] = $this->_Platforma->getUsersPermissions();
        $data['controller_edit'] = $this->controller_fake."/item/u/id/";
        $data['controller_fake'] = $this->controller_fake;

        $view = (object) [ 'html' => array(
                0 => (object) ["viewhtml" => "layout/breadcrumb", "viewdata" => $breadcrumb],
                1 => (object) ["viewhtml" => "platforma/utilizatori/users", "viewdata" => $data]
            ), 'javascript' => array(
                1 => (object) ["viewhtml" => "platforma/utilizatori/js_utilizator", "viewdata" => null],
            )
        ];
        $this->frontend->render($view);
    }

    /**
     * User function Add or Edit
     */
    public function item()
    {
        if(empty($this->uriseg)) redirect($this->controller);
        $viewdata = array(
            "controller"      => $this->controller,
            "controller_fake" => $this->controller_fake,
            "controller_ajax" => $this->controller_fake. "/ajax/",
            "controller_pass" => $this->controller . "/generatepassword",
            "item"            => null,
            "uri"             => $this->uriseg,
            "form"            => (object) [],
            "imgpathlogo"     => SITE_URL.PATH_IMG_PROFILE_PICTURE,
            "utilizatori_permisii" => $this->_Platforma->getUsersPermissions(),
        );

        // FORM - ADD
        $viewdata["form"]->item = (object) ["name" => "item", "prefix" => "it", "segments" => $this->controller_fake. "/item/" .$this->uriseg->item. ($this->uriseg->item == "u" && isset($this->uriseg->id) && !is_null($this->uriseg->id) ? "/id/" .trim(intval($this->uriseg->id)) : "")];
        $form_submititem = $viewdata["form"]->item->prefix. "submit";

        // FORM - EDIT
        $viewdata["form"]->meta = (object) ["name" => "meta", "prefix" => "mt", "segments" => $this->controller_fake. "/item/" .$this->uriseg->item. ($this->uriseg->item == "u" && isset($this->uriseg->id) && !is_null($this->uriseg->id) ? "/id/" .trim(intval($this->uriseg->id)) : "")];
        $form_submitmeta = $viewdata["form"]->meta->prefix. "submit";

        switch($this->uriseg->item)
        {
            case UPDATE:
                if($this->user->id != 1 && $this->uriseg->id == 1 && $this->user_logat->privilege != 2) redirect('/'); // protectie
                $eroare = 0;
                $user_name  = $this->librarie->clear_variable($this->input->post($viewdata["form"]->meta->prefix."user_name"));
                $user_email = $this->librarie->clear_variable($this->input->post($viewdata["form"]->meta->prefix."email"));
                $user_nume  = $this->librarie->clear_variable($this->input->post($viewdata["form"]->meta->prefix."nume"));
                $user_prenume = $this->librarie->clear_variable($this->input->post($viewdata["form"]->meta->prefix."prenume"));

                if(isset($this->uriseg->id) && !is_null($this->uriseg->id))
                {
                    $user_details = $this->_Platforma->getUser(trim(intval($this->uriseg->id)));

                    if($user_details)
                    {
                        $viewdata["user_details"] = $user_details;
                    }
                    else
                    {
                        redirect($this->controller);
                    }

                    if(isset($_REQUEST["{$form_submitmeta}"]))
                    {
                        if(empty($user_email))
                        {
                            $this->session->set_flashdata('email_class_error', ' has-error');
                            $this->session->set_flashdata('email_title_error', ' Acest câmp este obligatoriu.');
                            $eroare = 1;
                        }
                        elseif(!valid_email($user_email))
                        {
                            $this->session->set_flashdata('email_class_error', ' has-error');
                            $this->session->set_flashdata('email_title_error', ' Introduceti un email valid.');
                            $eroare = 1;
                        }

                        $getitem    = $this->_Item->checkIfUserExist(DB_TBL_UTILIZATORI, array("email" => $user_email));

                        if(!empty($getitem))
                        {
                            if(!empty($getitem['email']) && $getitem['email']->email == $user_email && $getitem['email']->email != $user_details->email)
                            {
                                $this->session->set_flashdata('email_class_error', ' has-error');
                                $this->session->set_flashdata('email_title_error', ' Contul cu acest email: <strong>' .$user_email. '</strong> există.');
                                $eroare = 1;
                            }
                        }

                        if($eroare == 1)
                        {
                            $this->session->set_flashdata('user_email', $user_email);

                            redirect($viewdata["form"]->meta->segments);
                        }
                        elseif(isset($_REQUEST["{$form_submitmeta}"]) && $eroare == 0)
                        {
                            $newDBPattern = (object) [ // Design Database Pattern
                                "table" => DB_TBL_UTILIZATORI,
                                "database" => UPDATE,
                                "type" => PUT,
                                "design" => array(
                                    // "privilege" => ($this->user->id != 1 && $this->user_logat->privilege != 2 ? false : true ),
                                    "privilege" => ((int)$this->UserModel->user->privilege == 1 ? true : false ),
                                    "user_name" => false,
                                    "nume" => true,
                                    "prenume" => true,
                                    "email" => true,
                                    "info_bio" => true,
                                    "user_password" => (!empty($this->input->post($viewdata["form"]->meta->prefix."user_password")) ? md5($this->input->post($viewdata["form"]->meta->prefix."user_password")) : false ),
                                )
                            ];
							// var_dump($newDBPattern);die();

                            $update = $this->_Item->UPItem($newDBPattern->table, $viewdata["form"]->meta->prefix, $newDBPattern, array("c" => "id", "v" => trim(intval($this->uriseg->id))));// update@Item

                            if($update) $this->_Session->setFB_Pozitive(array("ref" => $user_details->nume . " " .$user_details->prenume, "text" => "Modificarile tale au fost salvate!"));
                            redirect($viewdata["form"]->meta->segments);
                        }
                    }
                }
            break;

            case INSERT:
                    /* form @item */
                    if($this->user->id != 1 && $this->user_logat->privilege != 2) redirect('/'); // protectie
                    $redirect   = $this->controller;
                    $eroare = 0;
                    $user_name  = $this->librarie->clear_variable($this->input->post($viewdata["form"]->item->prefix."user_name"));
                    $user_email = $this->librarie->clear_variable($this->input->post($viewdata["form"]->item->prefix."email"));
                    $user_nume  = $this->librarie->clear_variable($this->input->post($viewdata["form"]->item->prefix."nume"));
                    $user_prenume = $this->librarie->clear_variable($this->input->post($viewdata["form"]->item->prefix."prenume"));
                    $user_telefon = $this->librarie->clear_variable($this->input->post($viewdata["form"]->item->prefix."telefon"));
                    $user_send_email = $this->librarie->clear_variable($this->input->post("sendemail__to_user"));

                    if(isset($_REQUEST["{$form_submititem}"]))
                    {
                        if(empty($user_name))
                        {
                            $this->session->set_flashdata('username_class_error', ' has-error');
                            $this->session->set_flashdata('username_title_error', ' Acest câmp este obligatoriu.');
                            $eroare = 1;
                        }
                        elseif(strlen($user_name) <= 2)
                        {
                            $this->session->set_flashdata('username_class_error', ' has-error');
                            $this->session->set_flashdata('username_title_error', ' Numele de utilizator trebuie sa conţină minim 3 caractere.');
                            $eroare = 1;
                        }

                        if(empty($user_email))
                        {
                            $this->session->set_flashdata('email_class_error', ' has-error');
                            $this->session->set_flashdata('email_title_error', ' Acest câmp este obligatoriu.');
                            $eroare = 1;
                        }
                        elseif(!valid_email($user_email))
                        {
                            $this->session->set_flashdata('email_class_error', ' has-error');
                            $this->session->set_flashdata('email_title_error', ' Introduceti un email valid.');
                            $eroare = 1;
                        }

                        $data       = array("user_name" => $user_name, "email" => $user_email);
                        $getitem    = $this->_Item->checkIfUserExist(DB_TBL_UTILIZATORI, $data);

                        if(!empty($getitem))
                        {
                            if(!empty($getitem['user_name']) && $getitem['user_name']->user_name == $user_name)
                            {
                                $this->session->set_flashdata('username_class_error', ' has-error');
                                $this->session->set_flashdata('username_title_error', ' Contul cu numele de utilizator <strong>' .$user_name. '</strong> există.');
                                $eroare = 1;
                            }
                            if(!empty($getitem['email']) && $getitem['email']->email == $user_email)
                            {
                                $this->session->set_flashdata('email_class_error', ' has-error');
                                $this->session->set_flashdata('email_title_error', ' Contul cu acest email: <strong>' .$user_email. '</strong> există.');
                                $eroare = 1;
                            }
                        }

                        if($eroare == 1)
                        {
                            $this->session->set_flashdata('user_name', $user_name);
                            $this->session->set_flashdata('user_email', $user_email);
                            $this->session->set_flashdata('user_nume', $user_nume);
                            $this->session->set_flashdata('user_prenume', $user_prenume);
                            $this->session->set_flashdata('user_telefon', $user_telefon);
                            $this->session->set_flashdata('user_send_email', $user_send_email);

                            redirect(current_url());
                        }
                        elseif(isset($_REQUEST["{$form_submititem}"]) && $eroare == 0)
                        {
                            $newDBPattern = (object) [
                                "table" => DB_TBL_UTILIZATORI,
                                "database" => INSERT,
                                "type" => PUT,
                                "design" => array(
                                    "privilege" => ($this->user->id != 1 && $this->user_logat->privilege != 2 ? false : true ),
                                    "user_name" => true,
                                    "nume" => true,
                                    "prenume" => true,
                                    "email" => true,
                                    "user_password" => md5($this->input->post($viewdata["form"]->item->prefix."user_password")),
                                    "date_insert" => date('Y-m-d H:i:s'),
                                )
                            ];

                            $insert = $this->_Item->INSItem($newDBPattern->table, $viewdata["form"]->item->prefix, $newDBPattern); // insert@Item

                            if($insert)
                            {
                                if($user_send_email == 1)
                                {
                                    $date_cont = array(
                                        "user_name" => $user_name,
                                        "nume" => $user_nume,
                                        "prenume" => $user_prenume,
                                        "telefon" => $user_telefon,
                                        "email" => $user_email,
                                        "parola" => $this->input->post($viewdata["form"]->item->prefix."user_password")
                                    );
                                    $this->_Clienti->contNou($date_cont);
                                }
                                $this->_Session->setFB_Pozitive(array("ref" => "", "text" => "Ai adaugăt un utilizator nou!"));
                                $redirect = $this->controller;
                            }
                            redirect($redirect);
                        }
                        else
                        {
                            redirect($redirect);
                        }
                    }
            break;

            case DELETE:
                if(isset($this->uriseg->id) && !is_null($this->uriseg->id) && $this->uriseg->id != 1 && $this->uriseg->id != $this->user->id)
                {
                    $locations = (object) ["table" => DB_TBL_UTILIZATORI, "path" => "../" . PATH_IMG_PROFILE_PICTURE];

                    $getitem    = $this->_Item->msqlGet($locations->table, array("id" => intval(trim($this->uriseg->id)))); // retrive user first 
                    $deleteitem = $this->_Item->msqlDelete(DB_TBL_UTILIZATORI, array("id" => trim(intval($this->uriseg->id))));

                    $utilizator_name = (!empty($getitem->nume) && !empty($getitem->prenume) ? $getitem->nume . ' ' . $getitem->prenume : $getitem->user_name);

                    if($deleteitem)
                    {
                        $this->_Session->setFB_Pozitive(array("ref" => "", "text" => "Utilizatorul " . $utilizator_name . " a fost şters!"));
                        deletefile($locations->path, $getitem->image_logo);
                        redirect($this->controller);
                    }
                }
                else
                {
                    redirect($this->controller);
                }
            break;
        }

        if($this->uriseg->item == "i" )
        {
            $breadcrumb = array("bb_titlu" => "Adaugă utilizator", "bb_button" => null, "breadcrumb" => array());

            $breadcrumb["breadcrumb"][0] = array("text" => "Dashboard", "url" => null );
            $breadcrumb["breadcrumb"][1] = array("text" => "Utilizatori", "url" => $this->controller);
            $breadcrumb["breadcrumb"][2] = array("text" => "Adaugă utilizator", "url" => null);

            $view = (object) [ 'html' => array(
                    0 => (object) ["viewhtml" => "layout/breadcrumb", "viewdata" => $breadcrumb],
                    1 => (object) ["viewhtml" => "platforma/utilizatori/add_user", "viewdata" => $viewdata]
                ), 'javascript' => array(
                    1 => (object) ["viewhtml" => "platforma/utilizatori/js_utilizator", "viewdata" => null],
                )
            ];
        }
        else
        {
            $breadcrumb = array("bb_titlu" => "Editează utilizator", "bb_button" => null, "breadcrumb" => array());

            $breadcrumb["breadcrumb"][0] = array("text" => "Dashboard", "url" => null );
            $breadcrumb["breadcrumb"][1] = array("text" => "Utilizatori", "url" => $this->controller);
            $breadcrumb["breadcrumb"][2] = array("text" => "Editează utilizator", "url" => null);

            $view = (object) [ 'html' => array(
                    0 => (object) ["viewhtml" => "layout/breadcrumb", "viewdata" => $breadcrumb],
                    1 => (object) ["viewhtml" => "platforma/utilizatori/edit_user", "viewdata" => $viewdata]
                ), 'javascript' => array(
                    1 => (object) ["viewhtml" => "platforma/utilizatori/js_utilizator", "viewdata" => null],
                )
            ];
        }
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
                case UPLOADIMG:
                    $res = array("status" => 0, "id" => null);
                    $inputfile  = "inpfile";
                    $filetarget = trim($this->input->post("filetarget"));
                    $fileref    = trim($this->input->post("fileref"));

                    $locations = (object) ["table" => null, "path" => null];

                    $locations->table = DB_TBL_UTILIZATORI;
                    $locations->path  = "../web/" . PATH_IMG_PROFILE_PICTURE;
                    $uplogo = $this->_Upload->uploadImage($locations->path);

                    if($uplogo)
                    {
                        $res["status"] = 1;
                        $res["img"] = $uplogo["img"];
                        $res["id"] = intval(trim($this->uriseg->id));

                        $last_logo = $this->_Item->msqlGet($locations->table, array("id" => intval(trim($this->uriseg->id))));

                        if($last_logo && isset($last_logo->image_logo))
                        {
                            deletefile($locations->path, $last_logo->image_logo);
                        }
                        $this->_Item->msqlUpdate(DB_TBL_UTILIZATORI, array("image_logo" => $uplogo["img"]), array("c" => "id", "v" => intval(trim($this->uriseg->id))));
                    }
                    echo json_encode($res);
                break;

                case DELETE:
                    $res = array("status" => 0);

                    $fileid  = trim($this->input->post("fileid"));
                    $fileref = trim($this->input->post("fileref"));

                    $locations = (object) ["table" => null, "path" => null];

                    //remove Profile Picture
                    if(strstr($fileref, "logo"))
                    {
                        $locations->path  = "../web/" . PATH_IMG_PROFILE_PICTURE;
                        $locations->table = DB_TBL_UTILIZATORI;

                        $item = $this->_Item->msqlGet($locations->table, array("id" => intval(trim($this->uriseg->id))));

                        if($item)
                        {
                            $updateitem = $this->_Item->msqlUpdate($locations->table, array("image_logo" => null), array("c" => "id", "v" => $item->id));
                            if($updateitem)
                            {
                                $res["status"] = 1;
                                deletefile($locations->path, $item->image_logo);
                            }
                        }
                    }
                    echo json_encode($res);
                break;
            }
        else show_404();
    }

    /* Generate Password */
    public function GeneratePassword()
    {
        $data = array(
                "status" => 1 ,
                "new_password" => "",
        );

        $alphabet = '!@?$%^&*abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $password = array();
        $alpha_length = strlen($alphabet) - 1;
        for($i = 0; $i < 12; $i++) 
        {
            $n = rand(0, $alpha_length);
            $password[] = $alphabet[$n];
        }

        $data['new_password'] = implode($password);
        echo json_encode($data);
    }
}