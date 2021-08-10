<?php

class Stiri_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

	/*Servicii breadcrumbs*/
	public function check_if_assoc_exist($table, $data)
	{
		$sql = 
		'
			SELECT
				*
			FROM
				' .$table. '
			WHERE
				idpage = ' .$data["idpage"]. ' AND
				idpageassoc = ' .$data["idpageassoc"]. '
				
		';		
		
		$query = $this->db->query($sql);
		if($query->num_rows() > 0) {
		  return $query->row()->id;
		}
		else return false;		
	}	
	
	
	public function get_all_assoc_breadcrumbs($id)
	{
		$sql = 
		'
			SELECT
				*
			FROM
				breadcrumbs_stiri
			WHERE
				idpage = "' .$id. '";
				
		';		
		
		$query = $this->db->query($sql);
		if($query->num_rows() > 0) {
			$result = array();
		  foreach($query->result() as $res)
		  {
			  $result[$res->idpageassoc] = $res;
		  }
		  return $result;
		}
		else return false;		
	}		
	public function insert_breadcrumbs_assoc($id_page, $id_page_assoc)
	{
		$data = array('idpage' => (int)$id_page, 'idpageassoc' => (int)$id_page_assoc);
		$table = 'breadcrumbs_stiri';
		
		if(!($id = $this->check_if_assoc_exist($table, $data)))
		{
			$insert = $this->db->insert($table, $data);
			if($insert) return $this->db->insert_id();
			else return false;
		} else {
			return $id;
		}
	}
	
	public function remove_breadcrumbs_assoc($id_page, $id_page_assoc)
	{
		$data = array('idpage' => (int)$id_page, 'idpageassoc' => (int)$id_page_assoc);
		$table = 'breadcrumbs_stiri';
		
		$insert = $this->db->delete($table, $data);
		if($insert) return $this->db->insert_id();
		else return false;		
	}
	/*Servicii breadcrumbs*/
}

?>