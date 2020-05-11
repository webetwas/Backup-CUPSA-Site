<?php

class Clienti extends CI_Model {

    function __construct()
    {
            parent::__construct();
    }

    function rpHash($value)
    {
        $hash = 5381;
        $value = strtoupper($value);
        for($i = 0; $i < strlen($value); $i++)
        {
            $hash = (($hash << 5) + $hash) + ord(substr($value, $i,1));
        }

        return $hash;
    }

    function contact()
    {
        $camp_subiect = $camp_nume = $camp_prenume = $camp_prenume = $camp_email = $camp_telefon  = $camp_subiect  = $camp_mesaj  = $camp_multiple_email = "";
        $class_subiect = $class_nume = $class_prenume = $class_email = $class_telefon = $class_subiect = $class_mesaj = $class_captcha = $class_multiple_email = "";
        $title_subiect = $title_nume = $title_prenume = $title_email = $title_telefon = $title_subiect = $title_mesaj = $title_captcha = $title_multiple_email = "";
        $eroare     = 0; $modal_feedback = ''; $modal_class = '';
        $captcha = "";

        if($_POST && isset($_POST['trimite']) && $_POST['trimite'] == 'formular_contact')
        {
            if(!empty($this->input->post("captcha"))) $captcha = $this->input->post("captcha");
            if(!empty($this->input->post("captchaHash"))) $captchahash = $this->input->post("captchaHash");

            if(empty($this->input->post("captcha")))
            {
                $class_captcha = " eroare pop-up";
                $title_captcha = ' title="Va rugam completati codul captcha!"';
                $eroare = 1;
            }
            elseif($captchahash != rpHash($captcha))
            {
                $class_captcha = " eroare pop-up";
                $title_captcha = ' title="Codul introdus este gresit !"';
                $eroare = 1;
            }
            else
            {
                $captcha = "";
            }

            $eroare       = 0;
            $camp_nume    = $this->librarie->clear_variable($this->input->post('camp_nume'));
            $camp_prenume = $this->librarie->clear_variable($this->input->post('camp_prenume'));
            $camp_email   = $this->librarie->clear_variable($this->input->post('camp_email'));
            $camp_telefon = $this->librarie->clear_variable($this->input->post('camp_telefon'));
            $camp_subiect = $this->librarie->clear_variable($this->input->post('camp_subiect'));
            $camp_mesaj   = $this->librarie->clear_variable($this->input->post('camp_mesaj'));
            
            /* Multiple Email */
            // $camp_multiple_email = $this->librarie->clear_variable($this->input->post('email_select'));

            if($camp_nume == "" || $camp_nume == "Nume")
            {
                $class_nume = ' eroare pop-up';
                $title_nume = ' title="Va rugam completati acest camp !"';
                $eroare = 1;
            }
            
            if($camp_prenume == "" || $camp_prenume == "Prenume")
            {
                $class_prenume = ' eroare pop-up';
                $title_prenume = ' title="Va rugam completati acest camp !"';
                $eroare = 1;
            }

            if($camp_email == "" || $camp_email == "Adresa de e-mail")
            {
                $class_email = ' eroare pop-up';
                $title_email = ' title="Va rugam completati acest camp !"';
                $eroare = 1;
            }
            else if(!$this->librarie->email_valid($camp_email))
            {
                $class_email = ' eroare pop-up';
                $title_email = ' title="Va rugam completati acest camp !"';
                $eroare = 1;
            }

            if($camp_telefon == "" || $camp_telefon == "Telefon")
            {
                $class_telefon = ' eroare pop-up';
                $title_telefon = ' title="Va rugam completati acest camp !"';
                $eroare = 1;
            }

            if($camp_subiect == "" || $camp_subiect == "Subiect")
            {
                $class_subiect = ' eroare pop-up';
                $title_subiect = ' title="Va rugam completati acest camp !"';
                $eroare = 1;
            }

            if($camp_mesaj == "" || $camp_mesaj == "Mesaj")
            {
                $class_mesaj = ' eroare pop-up';
                $title_mesaj = ' title="Va rugam completati acest camp !"';
                $eroare = 1;
            }

            // if($camp_multiple_email == "" || $camp_mesaj == "Mesaj")
            // {
                // $class_multiple_email = ' eroare pop-up';
                // $title_multiple_email = ' title="Va rugam selectati un email !"';
                // $eroare = 1;
            // }

            if($eroare == 0)
            {
                $data_curenta = $this->general->time('1');
                $mesaj_trimis = nl2br($camp_mesaj)."<br /><br />"
                                ."--------------------------------------<br />"
                                ."<b>Nume</b>: ".$camp_nume."<br />"
                                ."<b>E-mail</b>: ".$camp_email."<br />"
                                ."<b>Telefon</b>: ".$camp_telefon."<br /><br />"

                                ."<b>Ora:</b> ".mdate("%h:%i %a", $data_curenta)."<br />"
                                ."<b>Data:</b> ".mdate("%d-%m-%Y", $data_curenta)."";

                $email_success = $this->email->trimite($camp_email, $camp_subiect, $mesaj_trimis);
                
                if($email_success)
                {
                    $modal_feedback = "Mesajul dumneavoastra a fost trimis!";
                    $modal_class    = " success";
                }
                else
                {
                    $modal_feedback = "Ne pare rau dar mesajul nu a putut fi trimis. Reveniti mai tarziu. Multumim!";
                    $modal_class    = " eroare";
                }

                $camp_nume = $camp_prenume = $camp_email = $camp_telefon = $camp_subiect = $camp_mesaj = '';
            }
            else
            {
                // $modal_feedback = "<script type=\"text/javascript\">$(document).ready(function(){ open_modal('msg-general', 'Va rugam sa verificati campurile evidentiate cu rosu pentru a remedia eroarea.', 1); });</script>";
                $modal_feedback = "Va rugam completati toate campurile!";
            }
        }

        $data['camp_nume']    = !empty($camp_nume)?    $camp_nume    : '';
        $data['camp_prenume'] = !empty($camp_prenume)?    $camp_prenume    : '';
        $data['camp_email']   = !empty($camp_email)?   $camp_email   : '';
        $data['camp_telefon'] = !empty($camp_telefon)? $camp_telefon : '';
        $data['camp_subiect'] = !empty($camp_subiect)? $camp_subiect : '';
        $data['camp_mesaj']   = !empty($camp_mesaj)?   $camp_mesaj   : 'Mesaj';

        $data['modal_feedback'] = !empty($modal_feedback)? $modal_feedback : '';
        $data['modal_class']    = !empty($modal_class)? $modal_class : '';

        $data['eroare'] = array(
            'class_subiect' => $class_nume,
            'title_subiect' => $title_nume,
            'class_nume'    => $class_nume,
            'title_nume'    => $title_nume,
            'class_prenume'    => $class_prenume,
            'title_prenume'    => $title_prenume,
            'class_email'   => $class_email,
            'title_email'   => $title_email,
            'class_telefon' => $class_telefon,
            'title_telefon' => $title_telefon,
            'class_subiect' => $class_subiect,
            'title_subiect' => $title_subiect,
            'class_mesaj'   => $class_mesaj,
            'title_mesaj'   => $title_mesaj,
            'class_captcha' => $class_captcha,
            'title_captcha' => $title_captcha,
            'class_multiple_email' => $class_multiple_email,
            'title_multiple_email' => $title_multiple_email
        );
        return $data;
    }
    
    function contNou($date_cont = null)
    {
        $camp_subiect = "Informatii Cont";
        $data_curenta = $this->general->time('1');
        $mesaj_trimis = "<h1>Informatii Cont - Date conectare</h1 <br >"
                        ."<b>Nume</b>: ".$date_cont['nume'] . $date_cont['prenume']."<br />"
                        ."<b>E-mail</b>: ".$date_cont['email']."<br />"
                        ."<b>Username</b>: ".$date_cont['user_name']."<br />"
                        ."<b>Parola</b>: ".$date_cont['parola']."<br />"
                        ."<b>Telefon</b>: ".$date_cont['telefon']."<br /><br />"

                        ."<b>Ora:</b> ".mdate("%h:%i %a", $data_curenta)."<br />"
                        ."<b>Data:</b> ".mdate("%d-%m-%Y", $data_curenta)."<br />"
                        ."<p>Autentificarea in <a href='".base_url()."' target='_blank'><strong>CPANEL</strong></a> se face pe baza de <strong>username si parola</strong>.</p><br />";

        $this->email->trimite($date_cont['email'], $camp_subiect, $mesaj_trimis);
    }
}