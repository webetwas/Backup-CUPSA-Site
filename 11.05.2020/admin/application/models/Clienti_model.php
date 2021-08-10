<?php
class Clienti_model extends CI_Model {

  private $tbl_clienti;
	


  public function __construct()
  {
		
    parent::__construct();// Your own constructor code
		
		$this->tbl_clienti = 'addressbook';
		
  }
	
	public function get_next_ai_id($table)
	{
		
		$query = $this->db->query("SHOW TABLE STATUS LIKE '" .$table. "';");
		
		if($query->num_rows() > 0) {
			// var_dump($query->row());
		  return $query->row()->Auto_increment;
		}
		else return false;	
	}
	
	public function getclientbyid($id)
	{
		$query = $this->db->query("SELECT * FROM `" .$this->tbl_clienti. "` WHERE id = '" . $id . "';");
		
		if($query->num_rows() > 0) {
		  return $query->row();
		}
		else return false;			
	}
	
	/**
	 * searchitemname()
	 */	
	public function searchitemname($query)
	{
		
    $limit = '';
    if(strlen(trim($query)) < 4) {
      
      // $limit = 'LIMIT 1';
    }
    
    $query = $this->db->query("SELECT id, CONCAT(prenume,' ', nume) AS nume, telefon, email, UNIX_TIMESTAMP(date_update) AS date_update FROM `" .$this->tbl_clienti. "` WHERE nume LIKE '%{$query}%' OR prenume LIKE '%{$query}%' ORDER BY date_update DESC {$limit};");
    
    if($query->num_rows() > 0) {
      return $query->result();
    }
    else return false;		
	}	
  
  /**
	 * searchitemname()
	 */	
	public function searchtelefon($query)
	{
    
    $limit = '';
    if(strlen(trim($query)) < 4) {
      
      // $limit = 'LIMIT 1';
    }
		$query = str_replace(' ', '', trim($query));
    
    $query = $this->db->query("SELECT id_item, item_name, telefon, email, UNIX_TIMESTAMP(updated_at) AS updated_at FROM `" .$this->tbl_clienti. "` WHERE telefon LIKE '%{$query}%' ORDER BY updated_at DESC {$limit};");
    
		// var_dump($query->result());die();
		
    if($query->num_rows() > 0) {
      return $query->result();
    }
    else return false;		
	}

  /**
	 * countclienti()
	 */	
	public function countclienti()
	{
    
    $query = $this->db->query("SELECT id_item FROM `" .$this->tbl_clienti. "`;");
    
    return $query->num_rows();	
	} 
	
	public function get_all_users_and_permissions($airdrop_id)
	{	
		$sql = 
		'
			SELECT
				u.*,
				adpm.airdrop_id
			FROM
				be_users as u LEFT JOIN
				airs_airdrop_permissions AS adpm ON u.id = adpm.id_user AND (adpm.airdrop_id IS NULL OR adpm.airdrop_id = "' .$airdrop_id. '")
			WHERE
				u.privilege > 2
			GROUP BY
				adpm.airdrop_id, u.id
				
		';
		$query = $this->db->query($sql);
		// var_dump($sql);
		// die();
		
		if($query->num_rows() > 0) {
		  return $query->result();
		}
		else return false;
	}
	
	
	public function check_if_user_permission_exist($table, $data)
	{
		$sql = 
		'
			SELECT
				*
			FROM
				' .$table. '
			WHERE
				airdrop_id = ' .$data["airdrop_id"]. ' AND
				id_user = ' .$data["id_user"]. '
				
		';		
		
		$query = $this->db->query($sql);
		if($query->num_rows() > 0) {
		  return $query->row()->id;
		}
		else return false;		
	}
	
	public function insert_user_permission($airdrop_id, $id_user)
	{
		$data = array('airdrop_id' => (int)$airdrop_id, 'id_user' => (int)$id_user);
		$table = 'airs_airdrop_permissions';
		
		if(!($id = $this->check_if_user_permission_exist($table, $data)))
		{
			$insert = $this->db->insert($table, $data);
			if($insert) return $this->db->insert_id();
			else return false;
		} else {
			return $id;
		}
	}
	
	public function remove_user_permission($airdrop_id, $id_user)
	{
		$data = array('airdrop_id' => (int)$airdrop_id, 'id_user' => (int)$id_user);
		$table = 'airs_airdrop_permissions';
		
		$insert = $this->db->delete($table, $data);
		if($insert) return $this->db->insert_id();
		else return false;		
	}
  
}
