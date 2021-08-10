<?php

    /* functii codeigniter */
    // $this->load->helper('cookie');
    $this->load->helper('date');
    // $this->load->helper('string');
    $this->load->helper('email');

    // $this->load->library('encrypt');
    $this->load->library('librarie');
    // $this->load->library('pagination');

    // $this->load->library('google_analytics');
    // $this->load->library('user_agent');

    /* load moldes */
    $this->load->model("Ajax_model", "_Ajax");
    $this->load->model("Banner_model", "_Banner");
    $this->load->model("Chain_model", "_Chain");
    $this->load->model("Item_model", "_Item");
    $this->load->model("Object_model", "_Object");
    $this->load->model('Pagini_model', '_Pagini');
    $this->load->model("Platforma_model", "_Platforma");
    $this->load->model("Upload_model", "_Upload");
    $this->load->model("User_model", "_User");
    $this->load->model("Clienti", "_Clienti");
    $this->load->model("email");
    $this->load->model("general");



    /* redirect daca nu exista access la pagini */
    // $this->template->access();

?>