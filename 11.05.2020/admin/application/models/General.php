<?php

class General extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function time($gmt = FALSE)
    {
        return time() + ((!empty($gmt)? $gmt:$this->setari_generale(3)) * 60 * 60);
    }

    function check_value($camp, $text, $textarea = FALSE, $onfocus = TRUE)
    {
        $txt_onfocus = ($onfocus)? ' onfocus="if(this.value==\''.$text.'\') this.value=\'\'" onblur="if(this.value==\'\') this.value=\''.$text.'\';"' : '';
        $value       = empty($camp)? ' value="'.$text.'"' : ' value="'.$camp.'"';
        return ($textarea)? $txt_onfocus : $value.$txt_onfocus;
    }
}

?>