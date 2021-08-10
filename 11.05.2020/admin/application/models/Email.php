<?php

class Email extends CI_Model {

    function __construct()
    {
        parent::__construct();
                
            $this->from_address = "office@primariaploscuteni.ro";
            $this->from_name = "PRIMARIA PLOSCUTENI - CONT NOU";
    }

    private function config()
    {
        # - setari smtp
        $smtp = $this->setari();

        $config['protocol']  = 'smtp';
        $config['mailpath']  = '/usr/sbin/sendmail';
        $config['charset']   = 'utf-8';
        $config['mailtype']  = 'html';
        $config['wordwrap']  = TRUE;

        $config['smtp_host'] = $smtp[4];
        $config['smtp_user'] = $smtp[5];
        $config['smtp_pass'] = $smtp[6];
        $config['smtp_port'] = $smtp[7];

        return $config;
    }

    public function setari($id = NULL)
    {
        $setari_email  = array();
        $qsetari_email = $this->db->query("SELECT id, valoare FROM setari_email WHERE status='1' ".((!empty($id)? "AND id='".$id."'":'')));

        foreach($qsetari_email->result() as $setare)
        {
            $setari_email[$setare->id] = $setare->valoare;
        }
        return (!empty($id))? $setari_email[$id]:$setari_email;
    }   

    public function multiple_emails($id = NULL, $tip = NULL)
    {
        $setari_email  = array();
        $qsetari_email = $this->db->query("SELECT id, nume, valoare FROM setari_email WHERE status='1' ".((!empty($id)? "AND id='".$id."'":'')) . ((!empty($tip)? "AND tip='".$tip."'":'')));

        foreach($qsetari_email->result() as $setare)
        {
            $setari_email[$setare->id]['nume'] = $setare->nume;
            $setari_email[$setare->id]['id'] = $setare->valoare;
        }
        return (!empty($id))? $setari_email[$id]:$setari_email;
    }

    function fn_trimite($to_email, $subject, $message)
    {
        $this->load->library('email', NULL, 'ci_email');

        $this->ci_email->initialize($this->config());
        $this->ci_email->from($this->from_address, $this->from_name);
        $this->ci_email->to($to_email);
        $this->ci_email->subject($subject);
        $this->ci_email->message($message);
        #$this->ci_email->attach(realpath('.').'/continut/kaboo.jpg');
        $send = $this->ci_email->send();

        if($send)
        {
            // echo 'ok'; die();
            return 1;
        }
        else
        {
            // echo 'notok'; die();
            return false;
            // echo $this->ci_email->print_debugger();
        }
        

        # - salvare mail in log imap
        #$this->log_imap_email($from_email, $to_email, $subject, $message);
    }

    function trimite($email, $subiect, $continut)
    {
        // $continut      = $this->parsare->text($continut);

        $continut_mail = "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\n"
                        ."<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"en\">\n"
                        ."<head>\n"
                        ."<title></title>\n"
                        ."<style type=\"text/css\">\n"
                        ."<!--\n"
                        ."#newsletter { width: 618px; padding: 10px 15px; border: 1px solid #CCC; background: #FFF; font-family: Tahoma; font-size: 11px; color: #2B3539; line-height: 20px; }\n"
                        ."#headerNewsletter { width: 618px; text-align: left; padding: 0 0 10px 0; border-bottom: 1px solid #CCC; margin-bottom: 10px; color: #6C828C; }\n"
                        ."#headerNewsletter img { width:200px; display:block; margin: 0 auto; }\n"
                        ."#newsletter a:link { color: #0A9A00; text-decoration: none; }\n"
                        ."#newsletter a:visited { color: #0A9A00; text-decoration: none; }\n"
                        ."#newsletter a:hover { color: #FF9900; text-decoration: none; }\n"
                        ."#newsletter a:active { color: #FF9900; text-decoration: none; }\n"
                        ."#newsletter p { margin: 0; padding: 5px 0 5px 0; }\n"
                        .".titlu  { font-size: 14px; font-family: Arial; padding: 5px 0; font-weight: bold; color: #283135; }\n"
                        ."#newsletter #tabelGeneral { width: 618px; text-align: left; }\n"
                        ."#newsletter #tabelGeneral table { border-collapse: collapse; border-spacing: 0; margin-top: 10px; border: 1px solid #CCC; }\n"
                        ."#newsletter #tabelGeneral table td { padding: 5px 10px; border: none; border-bottom: 1px solid #CCC; }\n"
                        ."#newsletter #titluTabelGeneral { font-weight: bold; color: #75838A; background: #F9F9F9; }\n"
                        ."#footerNewsletter { width: 618px; text-align: left; padding: 5px 0 0 0; border-top: 1px solid #CCC; margin-top: 10px; color: #6C828C; }\n"
                        ."-->\n"
                        ."</style>\n"
                        ."</head>\n"
                        ."<body>\n"
                        ."<div id=\"newsletter\">\n"
                        ."<div id=\"headerNewsletter\"><img width='150' src=\"".base_url('logo.png')."\" alt=\"\" /></div>\n"
                        .$continut
                        ."<div id=\"footerNewsletter\">&copy; ".date('Y')."  Abydra Curier Toate drepturile rezervate.</div>\n"
                        ."</div>\n"
                        ."</body>\n"
                        ."</html>\n";
        // print_r($continut_mail); die();
        # - trimite email
        $send_email = $this->fn_trimite($email, $subiect, $continut_mail);
        return $send_email;
    }
}

?>