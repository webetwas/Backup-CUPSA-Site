<?php

class Sucursale_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	
	public function get_all_assoc_proiecte($atom_id)
	{
		$sql = 
		'
			SELECT
				*
			FROM
				sucursale_investitii_assoc
			WHERE
				atom_id = "' .$atom_id. '"
				
		';		
		
		$query = $this->db->query($sql);
		if($query->num_rows() > 0) {
			$result = array();
		  foreach($query->result() as $res)
		  {
			  $result[$res->proiect_id] = $res;
		  }
		  return $result;
		}
		else return false;		
	
	}
	
	public function check_if_page_assoc_exist($table, $data)
	{
		$sql = 
		'
			SELECT
				*
			FROM
				sucursale_investitii_assoc
			WHERE
				atom_id = ' .$data["atom_id"]. ' AND
				proiect_id = ' .$data["proiect_id"]. '
				
		';		
		
		$query = $this->db->query($sql);
		if($query->num_rows() > 0) {
		  return $query->row()->id;
		}
		else return false;		
	}	
	
	public function insert_proiect_assoc($atom_id, $proiect_id)
	{
		$data = array('atom_id' => (int)$atom_id, 'proiect_id' => (int)$proiect_id);

		$table = 'sucursale_investitii_assoc';
		
		if(!($id = $this->check_if_page_assoc_exist($table, $data)))
		{
			$insert = $this->db->insert($table, $data);
			if($insert) return $this->db->insert_id();
			else return false;
		} else {
			return $id;
		}
	}
	
	public function remove_proiect_assoc($atom_id, $proiect_id)
	{
		$data = array('atom_id' => (int)$atom_id, 'proiect_id' => (int)$proiect_id);
		$table = 'sucursale_investitii_assoc';
		
		$insert = $this->db->delete($table, $data);
		if($insert) return $this->db->insert_id();
		else return false;		
	}
	/*Sucursale breadcrumbs*/
	public function check_if_sucursale_assoc_exist($table, $data)
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
	
	
	public function get_all_assoc_breadcrumbs_sucursale($id)
	{
		$sql = 
		'
			SELECT
				*
			FROM
				breadcrumbs_sucursale
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
		$table = 'breadcrumbs_sucursale';
		
		if(!($id = $this->check_if_sucursale_assoc_exist($table, $data)))
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
		$table = 'breadcrumbs_sucursale';
		
		$insert = $this->db->delete($table, $data);
		if($insert) return $this->db->insert_id();
		else return false;		
	}
	/*Sucursale breadcrumbs*/
}

?>