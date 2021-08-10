<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Addressbook extends CI_Controller {

    private $controller;
    private $controller_fake;
    private $controller_ajax;

    public function __construct() {
        parent::__construct(); // Your own constructor code
        include('__construct.php');
		$this->load->model("Clienti_model", "_ClientiModel");

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
	
	public function get_all_users_and_permissions($airdrop_id)
	{
		$res = array('status' => 0, 'data' => null);
		$users = $this->_ClientiModel->get_all_users_and_permissions((int)$airdrop_id);
		if($users) {
			$res["data"] = $users;
		}
		
		$res["status"] = 1;
		header('Content-Type: application/json');
		exit(json_encode($res));	
	}
	
	public function chosen_request_user_permission()
	{
		$res = array("status" => 0, "id" => null);
		
		$airdrop_id = (!empty($this->input->post("airdrop_id")))
			? $this->input->post("airdrop_id") : null;		
		
		$params = (!empty($this->input->post("params")))
			? $this->input->post("params") : null;
			
		if(!is_null($airdrop_id) && !is_null($params))
		{
			foreach($params as $action => $id_user)
			{
				switch($action)
				{
					case 'selected':
						$id = $this->_ClientiModel->insert_user_permission($airdrop_id, $id_user);
						break;
					case 'deselected':
						$this->_ClientiModel->remove_user_permission($airdrop_id, $id_user);
						break;
				}
			}
		}
	}
	
    public function index()
    {
        $breadcrumb = array("bb_titlu" => "Address Book", "bb_button" => null, "breadcrumb" => array());
        $breadcrumb["breadcrumb"][0] = array("text" => "Dashboard", "url" => '');
        $breadcrumb["breadcrumb"][1] = array("text" => "Address Book", "url" => '');
        $breadcrumb["bb_button"] = array("text" => '<i class="fa fa-plus-square"></i> Adaugă user', "linkhref" => $this->controller_fake . "/item/i" );

        $data['utilizatori'] = $this->_Platforma->getUsersAddressBook();
        // $data['utilizatori_permisii'] = $this->_Platforma->getUsersPermissions();
        $data['controller_edit'] = $this->controller_fake."/item/u/id/";
        $data['controller_fake'] = $this->controller_fake;

        $view = (object) [ 'html' => array(
                0 => (object) ["viewhtml" => "layout/breadcrumb", "viewdata" => $breadcrumb],
                1 => (object) ["viewhtml" => "addressbook/users", "viewdata" => $data]
            ), 'javascript' => array(
                1 => (object) ["viewhtml" => "addressbook/js_utilizator", "viewdata" => null],
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
            "imgpathlogo"     => SITE_URL.PATH_IMG_ADDRESSBOOK,
            "judete"          => $this->_Item->msqlGetAll('localizare_judete'),
            "localitati"      => $this->_Item->msqlGetAll('localizare_localitati'),
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
                if($this->user->id != 1) redirect('/'); // protectie
                $eroare = 0;
                $user_email = $this->librarie->clear_variable($this->input->post($viewdata["form"]->meta->prefix."email"));
                $user_nume  = $this->librarie->clear_variable($this->input->post($viewdata["form"]->meta->prefix."nume"));
                $user_prenume = $this->librarie->clear_variable($this->input->post($viewdata["form"]->meta->prefix."prenume"));

                if(isset($this->uriseg->id) && !is_null($this->uriseg->id))
                {
                    $user_details = $this->_Platforma->getUserAddressBook(trim(intval($this->uriseg->id)));

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

                        $getitem    = $this->_Item->checkIfUserExist(TBL_ADDRESSBOOK, array("email" => $user_email));

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
                                "table" => TBL_ADDRESSBOOK,
                                "database" => UPDATE,
                                "type" => PUT,
                                "design" => array(
                                    "nume" => true,
                                    "prenume" => true,
                                    "email" => true,
                                    "telefon" => true,
                                    "judet" => true,
                                    "localitate" => true,
                                    "tip_persoana" => true,
                                    "companie" => true,
                                    "cui" => true,
                                    "nr_orc" => true,
                                    "banca" => true,
                                    "iban" => true,
                                    "adresa_punct_lucru" => true,
                                    "adresa" => true
                                )
                            ];

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
                    $user_adresa = $this->librarie->clear_variable($this->input->post($viewdata["form"]->item->prefix."adresa"));
                    $user_tip_persoana = $this->librarie->clear_variable($this->input->post($viewdata["form"]->item->prefix."tip_persoana"));
                    $user_companie = $this->librarie->clear_variable($this->input->post($viewdata["form"]->item->prefix."companie"));
                    $user_cui = $this->librarie->clear_variable($this->input->post($viewdata["form"]->item->prefix."cui"));
                    $user_nr_orc = $this->librarie->clear_variable($this->input->post($viewdata["form"]->item->prefix."nr_orc"));
                    $user_banca = $this->librarie->clear_variable($this->input->post($viewdata["form"]->item->prefix."banca"));
                    $user_iban = $this->librarie->clear_variable($this->input->post($viewdata["form"]->item->prefix."iban"));
                    $user_adresa_punct_lucru = $this->librarie->clear_variable($this->input->post($viewdata["form"]->item->prefix."adresa_punct_lucru"));

                    // $user_send_email = $this->librarie->clear_variable($this->input->post("sendemail__to_user"));

                    if(isset($_REQUEST["{$form_submititem}"]))
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

                        $data       = array("email" => $user_email);
                        $getitem    = $this->_Item->checkIfUserExist(TBL_ADDRESSBOOK, $data);

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
                                $this->session->set_flashdata('email_title_error', ' User-ul cu acest email: <strong>' .$user_email. '</strong> există.');
                                $eroare = 1;
                            }
                        }

                        if($eroare == 1)
                        {
                            $this->session->set_flashdata('user_email', $user_email);
                            $this->session->set_flashdata('user_nume', $user_nume);
                            $this->session->set_flashdata('user_prenume', $user_prenume);
                            $this->session->set_flashdata('user_telefon', $user_telefon);
                            $this->session->set_flashdata('user_adresa', $user_adresa);
                            $this->session->set_flashdata('user_tip_persoana', $user_tip_persoana);
                            $this->session->set_flashdata('user_companie', $user_companie);
                            $this->session->set_flashdata('user_cui', $user_cui);
                            $this->session->set_flashdata('user_nr_orc', $user_nr_orc);
                            $this->session->set_flashdata('user_banca', $user_banca);
                            $this->session->set_flashdata('user_iban', $user_iban);
                            $this->session->set_flashdata('user_adresa_punct_lucru', $user_adresa_punct_lucru);

                            redirect(current_url());
                        }
                        elseif(isset($_REQUEST["{$form_submititem}"]) && $eroare == 0)
                        {
                            $newDBPattern = (object) [
                                "table" => TBL_ADDRESSBOOK,
                                "database" => INSERT,
                                "type" => PUT,
                                "design" => array(
                                    "nume" => true,
                                    "prenume" => true,
                                    "email" => true,
                                    "telefon" => true,
                                    "judet" => true,
                                    "localitate" => true,
                                    "adresa" => true,
                                    "tip_persoana" => true,
                                    "companie" => true,
                                    "cui" => true,
                                    "nr_orc" => true,
                                    "banca" => true,
                                    "iban" => true,
                                    "adresa_punct_lucru" => true,
                                    "date_insert" => date('Y-m-d H:i:s'),
                                )
                            ];

                            $insert = $this->_Item->INSItem($newDBPattern->table, $viewdata["form"]->item->prefix, $newDBPattern); // insert@Item

                            if($insert)
                            {
                                // if($user_send_email == 1)
                                // {
                                    // $date_cont = array(
                                        // "user_name" => $user_name,
                                        // "nume" => $user_nume,
                                        // "prenume" => $user_prenume,
                                        // "telefon" => $user_telefon,
                                        // "email" => $user_email,
                                        // "parola" => $this->input->post($viewdata["form"]->item->prefix."user_password")
                                    // );
                                    // $this->_Clienti->contNou($date_cont);
                                // }
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
                    $locations = (object) ["table" => TBL_ADDRESSBOOK, "path" => "../" . PATH_IMG_PROFILE_PICTURE];

                    $getitem    = $this->_Item->msqlGet($locations->table, array("id" => intval(trim($this->uriseg->id)))); // retrive user first 
                    $deleteitem = $this->_Item->msqlDelete(TBL_ADDRESSBOOK, array("id" => trim(intval($this->uriseg->id))));

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
            $breadcrumb["breadcrumb"][1] = array("text" => "Address Book", "url" => $this->controller);
            $breadcrumb["breadcrumb"][2] = array("text" => "Adaugă utilizator", "url" => null);

            $view = (object) [ 'html' => array(
                    0 => (object) ["viewhtml" => "layout/breadcrumb", "viewdata" => $breadcrumb],
                    1 => (object) ["viewhtml" => "addressbook/add_user", "viewdata" => $viewdata]
                ), 'javascript' => array(
                    1 => (object) ["viewhtml" => "addressbook/js_utilizator", "viewdata" => null],
                )
            ];
        }
        else
        {
            $breadcrumb = array("bb_titlu" => "Editează utilizator", "bb_button" => null, "breadcrumb" => array());

            $breadcrumb["breadcrumb"][0] = array("text" => "Dashboard", "url" => null );
            $breadcrumb["breadcrumb"][1] = array("text" => "Address Book", "url" => $this->controller);
            $breadcrumb["breadcrumb"][2] = array("text" => "Editează utilizator", "url" => null);

            $view = (object) [ 'html' => array(
                    0 => (object) ["viewhtml" => "layout/breadcrumb", "viewdata" => $breadcrumb],
                    1 => (object) ["viewhtml" => "addressbook/edit_user", "viewdata" => $viewdata]
                ), 'javascript' => array(
                    1 => (object) ["viewhtml" => "addressbook/js_utilizator", "viewdata" => null],
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
                    $locations->table = TBL_ADDRESSBOOK;

                    if($filetarget == 'logo' && $fileref == 'logo')
                    {
                        $locations->path  = "../web/" . PATH_IMG_ADDRESSBOOK;
                        $upfile = $this->_Upload->uploadImage($locations->path);
                    }
                    else if($filetarget == 'fisier' && $fileref == 'fisier_gdpr')
                    {
                        $locations->path  = "../web/" . PATH_FILES_ADDRESSBOOK . '/gdpr';
                        $upfile = $this->_Upload->process_upload_file($inputfile, $locations->path);
                    }
                    else if($filetarget == 'fisier' && $fileref == 'fisier_contract')
                    {
                        $locations->path  = "../web/" . PATH_FILES_ADDRESSBOOK . '/contract';
                        $upfile = $this->_Upload->process_upload_file($inputfile, $locations->path);
                    }

                    if($upfile)
                    {
                        $res["status"] = 1;
                        $res["img"] = ($filetarget == 'logo' && $fileref == 'logo' ? $upfile['img'] : $upfile);
                        $res["id"] = intval(trim($this->uriseg->id));
                        $res["file_type"] = $fileref;

                        $check_file = $this->_Item->msqlGet($locations->table, array("id" => intval(trim($this->uriseg->id))));

                        if($check_file && isset($check_file->image_logo) && $filetarget == 'logo' && $fileref == 'logo')
                        {
                            deletefile($locations->path, $check_file->image_logo);
                        }
                        else if($check_file && isset($check_file->file_gdpr) &&  $filetarget == 'fisier' && $fileref == 'fisier_gdpr')
                        {
                            deletefile($locations->path, $check_file->file_gdpr);
                        }
                        else if($check_file && isset($check_file->file_contract) &&  $filetarget == 'fisier' && $fileref == 'fisier_contract')
                        {
                            deletefile($locations->path, $check_file->file_contract);
                        }
                        
                        $data_to_update = array();
                        
                        if($filetarget == 'logo' && $fileref == 'logo')
                        {
                            $data_to_update['image_logo'] = $upfile['img'];
                        }
                        else if($filetarget == 'fisier' && $fileref == 'fisier_gdpr')
                        {
                            $data_to_update['file_gdpr'] = $upfile;
                            $data_to_update['data_insert_gdpr'] = date('Y-m-d H:i:s');
                        }
                        else if($filetarget == 'fisier' && $fileref == 'fisier_contract')
                        {
                            $data_to_update['file_contract'] = $upfile;
                            $data_to_update['data_insert_contract'] = date('Y-m-d H:i:s');
                        }

                        $this->_Item->msqlUpdate(TBL_ADDRESSBOOK, $data_to_update, array("c" => "id", "v" => intval(trim($this->uriseg->id))));
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
                        $locations->path  = "../web/" . PATH_IMG_ADDRESSBOOK;
                        $locations->table = TBL_ADDRESSBOOK;

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

                    if(strstr($fileref, "fisier_gdpr"))
                    {
                        $locations->path  = "../web/" . PATH_IMG_ADDRESSBOOK . '/gdpr';
                        $locations->table = TBL_ADDRESSBOOK;

                        $item = $this->_Item->msqlGet($locations->table, array("id" => intval(trim($this->uriseg->id))));

                        if($item)
                        {
                            $updateitem = $this->_Item->msqlUpdate($locations->table, array("file_gdpr" => null), array("c" => "id", "v" => $item->id));
                            if($updateitem)
                            {
                                $res["status"] = 1;
                                deletefile($locations->path, $item->file_gdpr);
                            }
                        }
                    }

                    if(strstr($fileref, "fisier_contract"))
                    {
                        $locations->path  = "../web/" . PATH_IMG_ADDRESSBOOK . '/contract';
                        $locations->table = TBL_ADDRESSBOOK;

                        $item = $this->_Item->msqlGet($locations->table, array("id" => intval(trim($this->uriseg->id))));

                        if($item)
                        {
                            $updateitem = $this->_Item->msqlUpdate($locations->table, array("file_contract" => null), array("c" => "id", "v" => $item->id));
                            if($updateitem)
                            {
                                $res["status"] = 1;
                                deletefile($locations->path, $item->file_contract);
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
    
    public function getUserInfo()
    {
        $data = array(
            'user_details' => null,
            'adresa_judet' => null,
            'adresa_localitate' => null
        );
        $fileid  = trim($this->input->post("fileid"));
        $data['user_details'] = $this->_Platforma->getUserAddressBook(trim(intval($fileid)));
        $data['adresa_judet'] = $this->_Item->msqlGetAll('localizare_judete', array('id' => $data['user_details']->judet));
        $data['adresa_localitate'] = $this->_Item->msqlGetAll('localizare_localitati', array('id' => $data['user_details']->localitate));
        echo json_encode($data);
    }

    public function getLocalitati()
    {
        $fileid  = trim($this->input->post("fileid"));
        $results = $this->_Item->msqlGetAll('localizare_localitati', array('parinte' => $fileid));

        foreach($results as $row)
        {
            $id = $row->id;
            $data = $row->nume;

            echo '<option value="'.$id.'">'.$data.'</option>';
        }
    }
	
  public function ajxfindclients()
  {
    
    $res = array("status" => 0, "items" => 0, "result" => null);
    
    $postdata = $this->input->post("postdata");
    
    // number
    if(is_numeric($postdata)) {

      $clienti = $this->_ClientiModel->searchtelefon($postdata);
    
    // chars
    } else {
      
      $clienti = $this->_ClientiModel->searchitemname($postdata);
    }
    
    if(!$clienti) {
      $res["status"] = 1;
      
      header('Content-Type: application/json');
      exit(json_encode($res));
    }
    
    $res["status"] = 1;
    $res["items"] = count($clienti);
    foreach($clienti as $kclient => $client) {
      
      $res["result"][$kclient]["html"] = '
      <div>
        <span class="nim">' .$client->nume. '</span>
        <div class="nite">
        ' .(!empty($client->telefon) ? '<br/><span><i class="fa fa-phone"></i> ' .$client->telefon. '</span>' : ''). '
        ' .(!empty($client->email) ? '<span><i class="fa fa-envelope"></i> ' .$client->email. '</span>' : ''). '
        </div>
      </div>
      ';
      
      $res["result"][$kclient]["id"] = $client->id;
      $res["result"][$kclient]["nume"] = $client->nume;
      $res["result"][$kclient]["telefon"] = $client->telefon;
      $res["result"][$kclient]["email"] = $client->email;
    }
    header('Content-Type: application/json');
    echo json_encode( $res );
  }
    
}