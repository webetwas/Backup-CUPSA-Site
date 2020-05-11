<?php
class Upload_model extends CI_Model {

  private $inpfile = "inpfile";//POST/name

  public function __construct()
  {
  	parent::__construct();
  	// Your own constructor code
  	//
    $this->load->helper('upload');
	$this->load->helper('string');
  }

  /**
   * [uploadImage description]
   * @param  [String] $this->inpfile [description]
   * @param  [String] $folder    [description]
   * @param  [Array]  $data      [description]
   * @return [Array]             [Images namepath]
   */
  public function uploadImage($folder, $data = array(), $imaginaryfolder = null) {
    // $images = $this->_Upload->uploadImage($inputfile, '../web/' .PATH_IMG_PAGINA, array("s" => true, "m" => true, "l" => true));
		$img_name = $this->createImageName($this->inpfile);

    $temp_upload = false;
		if($img_name) {
      if(!empty($data)) {
        // var_dump($data);die();
  			foreach($data as $keyd => $d) {
          $newfolder = (!empty($imaginaryfolder) ? $folder.$keyd : $folder);
          
          if($keyd == "image_logo") {
            $d = array("w" => IMG_LOGO_W, "h" => IMG_LOGO_H, "p" => IMG_LOGO_P);
          }
  		    $temp_upload = process_upload_photo($this->inpfile, $img_name, $newfolder, $d["w"], $d["h"], $d["p"] == "1" ? true : false);
  			  if($temp_upload) $data[$keyd] = true;
  			  else $data[$keyd] = false;
  			}
      } else $temp_upload = process_upload_photo($this->inpfile, $img_name, $folder, null, null, true);
  	}
    if($temp_upload) $data["img"] = $temp_upload;
    else $data["img"] = false;

    return $data;
  }

	private function createImageName() {
		$type = $_FILES[$this->inpfile]['type'];

    if ($type == "image/jpeg" || $type == "image/png" || $type == "image/pjpeg") {
			$original_name = $_FILES[$this->inpfile]['name'];

			$path_info = pathinfo($original_name);
			$extension = $path_info['extension'];

			// file name handling
			$rnd = strtolower(random_string('alnum', 8));
			$base = "photo-$rnd.{$extension}";
			$base = strtolower($base);

			return $base;
		} else return false;
	}
	
    function process_upload_file($input_name, $upload_folder, $file_prefix = 'file', $type = null)
    {
        // process image
        if(isset($_FILES[$input_name]['name']) && $_FILES[$input_name]['name']!='')
        {
			$res = array("base" => null, "name" => null, "type" => null);
			
			if(!is_null($type))
			{
				if($_FILES[$input_name]['type'] !== $type)
				{
					return false;
				}
			}
			
            // $original_name = $_FILES[$input_name]['name'];
            $tmp_name = $_FILES[$input_name]['tmp_name'];

            $original_name = $_FILES[$input_name]['name'];

            $path_info = pathinfo($original_name);
            $extension = $path_info['extension'];

            // file name handling
            $rnd = strtolower(random_string('alnum', 8));
            $base = "{$file_prefix}-$rnd.{$extension}";
            $base = strtolower($base);
        
            // cod de creare a numelui de fisier, ca sa nu suprascrie ceva existent
            // $new_name = $original_name;
            if(is_file("$upload_folder/$original_name")) $base = substr(md5(time()),0,8)."_".$base;

            if(! is_writable("$upload_folder/")) show_error('read only folder! - '."$upload_folder/");

            copy($tmp_name,"$upload_folder/$base");
			
			$res["base"] = $base;
			$res["name"] = $original_name;
			$res["type"] = $_FILES[$input_name]['type'];
			
			return $res;
        }
        return false;
    }
	
	function delete_file($path, $file)
	{
		deletefile($path, $file);
	}
}
