<?php
class Pagini_model extends CI_Model {

  private $tbl_pages;
	private $tbl_structura;
  private $tbl_pages_images;
	private $tbl_banners_page;


  public function __construct()
  {
    $this->tbl_pages = TBL_PAGES;
		$this->tbl_structura = TBL_PAGES_STRUCTURE;
    $this->tbl_pages_images = TBL_PAGES_IMAGES;
		$this->tbl_banners_page = TBL_PAGES_BANNERS;

    parent::__construct();
    // Your own constructor code
  }

  /**
   * [GetPage description]
   * @param [type] $id_page [description]
   */
  public function GetPage($id_page)
  {
    $res = (object) ["p" => null, "i" => null, "s" => null, "b" => null];

    $page = $this->getPageById_Page($id_page);
    if($page) {
			$res->p = $page;
			
			$structura = $this->getPageStructura($page->atom_id);
			if($structura) $res->s = $structura;
			
			$images = $this->getImagesByIdPage($page->atom_id);
			if($images) $res->i = $images;
			
			$banners = $this->fetchBannersAssocByRef(array("idpage" => $page->atom_id));
			if($banners) $res->b = $banners;
		} else return false;

    return $res;
  }
 
  /**
   * [GetPage description]
   * @param [type] $id_page [description]
   */
  public function GetPageBySlug($slug)
  {
    $res = (object) ["p" => null, "i" => null, "s" => null, "b" => null];

    $page = $this->getPageBySlug_Page($slug);
    if($page) {
			$res->p = $page;
			
			$structura = $this->getPageStructura($page->atom_id);
			if($structura) $res->s = $structura;
			
			$images = $this->getImagesByIdPage($page->atom_id);
			if($images) $res->i = $images;
			
			$banners = $this->fetchBannersAssocByRef(array("idpage" => $page->atom_id));
			if($banners) $res->b = $banners;
		} else return false;

    return $res;
  }
	
	
  /**
   * [fetchWithRefIndex description]
   * @param  [type] $table     [description]
   * @param  [type] $querydata [description]
   * @return [Array]           [Associative array by @ref]
   */
  public function fetchBannersAssocByRef($querydata) {
    $res = array();

    $this->db->select('*');
	$this->db->order_by("img_ref", "asc");
    $query = $this->db->get_where($this->tbl_banners_page, $querydata);

    if($query->num_rows() > 0) {
      foreach($query->result() as $result)
        $res[$result->img_ref] = $result;
      return $res;
    } else return false;
  }	

  /**
   * [getPageById_Page description]
   * @param  [type] $id_page [description]
   * @return [type]          [description]
   */
  private function getPageById_Page($id_page)
  {
    $query = $this->db->query("SELECT * FROM `" .$this->tbl_pages. "` WHERE `id_page` = '" .$id_page. "';");

    if($query->num_rows() > 0) {
      return $query->row();
    }
    else return false;
  }
  
  /**
   * [getPageById_Page description]
   * @param  [type] $id_page [description]
   * @return [type]          [description]
   */
  private function getPageBySlug_Page($slug)
  {
    $query = $this->db->query("SELECT * FROM `" .$this->tbl_pages. "` WHERE `slug` = '" .$slug. "';");

    if($query->num_rows() > 0) {
      return $query->row();
    }
    else return false;
  }

	public function getPageStructura($idpage)
	{
    $query = $this->db->query("SELECT * FROM `" .$this->tbl_structura. "` WHERE `idpage` = '" .$idpage. "';");

    if($query->num_rows() > 0) {
      return $query->row();
    }
    else return false;		
	}
	
  /**
   * [getImagesByIdPage description]
   * @param  [type] $idpage [description]
   * @return [type]         [description]
   */
  private function getImagesByIdPage($idpage)
  {
    $query = $this->db->query("SELECT * FROM `" .$this->tbl_pages_images. "` WHERE `idpage` = '" .$idpage. "' ORDER BY `id` ASC;");

    if($query->num_rows() > 0) {
      return $query->result();
    }
    else return false;
  }
  
 	public function get_pagini_site()
	{
		$sql = 
		'
			SELECT
				p.title_ro,
				p.title_en,
				p.slug
			FROM
				fe_pages_structure as ps
				INNER JOIN fe_pages AS p ON p.atom_id = ps.idpage
			WHERE ps.filehtml = "pagina"
			GROUP BY
				p.atom_id
		;';
		// var_dump($sql);die();
		$query = $this->db->query($sql);
		
		if($query->num_rows() > 0) {
		  return $query->result();
		}
		else return false;		
	}
	
 	public function get_pagini_site_assoc($id)
	{
		$sql = 
		'
			SELECT
				p.atom_id,
				p.title_ro,
				p.title_en,
				p.slug,
				ps.filehtml
			FROM
				fe_pages_assoc AS pa
				INNER JOIN fe_pages AS p ON pa.idpageassoc = p.atom_id OR pa.idpageassoc = CONCAT("19881990", p.atom_id)
				INNER JOIN fe_pages_structure AS ps ON ps.idpage = p.atom_id
			WHERE
				pa.idpage = "' .$id. '"
		;';
		// var_dump($sql);die();
		$query = $this->db->query($sql);
		
		if($query->num_rows() > 0) {
		  return $query->result();
		}
		else return false;		
	}	
	
 	public function get_pagini_site_assoc_three($id)
	{
		$sql = 
		'
			SELECT
				p.atom_id,
				p.title_ro,
				p.title_en,
				p.slug,
				ps.filehtml,
				pa.idpageassoc
			FROM
				fe_pages_assoc AS pa
				INNER JOIN fe_pages AS p ON pa.idpageassoc = p.atom_id OR pa.idpageassoc = CONCAT("19881990", p.atom_id)
				INNER JOIN fe_pages_structure AS ps ON ps.idpage = p.atom_id
			WHERE
				pa.idpage = "' .$id. '"
		;';
		// var_dump($sql);die();
		$query = $this->db->query($sql);
		
		if($query->num_rows() > 0) {
		  $results = $query->result();
		  foreach($results as $res_key => $result)
		  {
			  if(strstr($result->idpageassoc, '19881990'))
			  {
				  $results[$res_key]->pages = $this->get_pagini_site_assoc($result->atom_id);
				  if($results[$res_key]->pages)
				  {
					foreach($results[$res_key]->pages as $last_key => $last)
					{
						if(strstr($last->idpageassoc, '19881990'))
						{
							$results[$res_key]->pages[$last_key]->pages = $this->get_pagini_site_assoc($last->atom_id);
						}
						
					}
				  }
			  }

		  }
		  
		  return $results;
		}
		else return false;		
	}	
	
 	public function get_pagini_site_assoc_three_by_proiect($id)
	{
		$sql = 
		'
			SELECT
				p.atom_id,
				p.title_ro,
				p.title_en,
				p.slug,
				ps.filehtml
			FROM
				proiecte_pages_assoc AS pa
				INNER JOIN fe_pages AS p ON pa.idpage = p.atom_id
				INNER JOIN fe_pages_structure AS ps ON ps.idpage = p.atom_id
			WHERE
				pa.atom_id = "' .$id. '"
		;';
		// var_dump($sql);die();
		$query = $this->db->query($sql);
		
		if($query->num_rows() > 0) {
		  $results = $query->result();
		  foreach($results as $res_key => $result)
		  {
			  $results[$res_key]->pages = $this->get_pagini_site_assoc($result->atom_id);
			  if($results[$res_key]->pages)
			  {
				foreach($results[$res_key]->pages as $last_key => $last)
				{
					$results[$res_key]->pages[$last_key]->pages = $this->get_pagini_site_assoc($last->atom_id);
				}
			  }
		  }
		  
		  return $results;
		}
		else return false;		
	}	
	
	public function search_site($search_site_query)
	{
		$results = array();
		
		$objects = array('fe_pages','stiri', 'texte_diverse', 'servicii', 'proiecte', 'media', 'avizier', 'sucursale','intrebari_frecvente','declaratii_avere');
		
		foreach($objects as $obj)
		{
			$sql =
			'
			SELECT
				*
			FROM
				' .$obj. '
			WHERE
				' .($this->frontend->site_lang == "en" ? 'atom_name_en LIKE "%' .$search_site_query. '%"' : 'atom_name_ro LIKE "%' .$search_site_query. '%"'). '
			OR ' .($this->frontend->site_lang == "en" ? 'i_content_en LIKE "%' .$search_site_query. '%"' : 'i_content_ro LIKE "%' .$search_site_query. '%"'). '
			';
			// var_dump($sql);die();
			if($obj == "fe_pages"){
				$sql =
				'
				SELECT
					*
				FROM
					' .$obj. '
				WHERE
					' .($this->frontend->site_lang == "en" ? 'atom_name_en LIKE "%' .$search_site_query. '%"' : 'atom_name_ro LIKE "%' .$search_site_query. '%"'). '
				OR ' .($this->frontend->site_lang == "en" ? 'content_en LIKE "%' .$search_site_query. '%"' : 'content_ro LIKE "%' .$search_site_query. '%"'). '
				';
			}
			if($obj == "sucursale"){
				$sql =
				'
				SELECT
					*
				FROM
					' .$obj. '
				WHERE
					' .($this->frontend->site_lang == "en" ? 'atom_name_en LIKE "%' .$search_site_query. '%"' : 'atom_name_ro LIKE "%' .$search_site_query. '%"'). '
				OR ' .($this->frontend->site_lang == "en" ? 'i_content_en LIKE "%' .$search_site_query. '%"' : 'i_content_ro LIKE "%' .$search_site_query. '%"'). '
				OR pers_contact_suc LIKE "%'.$search_site_query. '%"
				OR email_suc LIKE "%'.$search_site_query. '%"
				';
			}
			if($obj == "declaratii_avere"){
				$sql =
				'
				SELECT
					*
				FROM
					' .$obj. '
				WHERE
				nume LIKE "%'.$search_site_query. '%"
				OR prenume LIKE "%'.$search_site_query. '%"
				OR functie LIKE "%'.$search_site_query. '%"
				';
				if(strpos($search_site_query, 'avere') !== false || strpos($search_site_query, 'declaratie') !== false ){
					$sql =
					'
					SELECT
						*
					FROM
						declaratii_avere
					';
				}				
			}

			$query = $this->db->query($sql);
			if($query->num_rows() > 0) {
				$query_result = array();
				$query_result= $query->result();
				if(!is_null($query_result)){
					$query_result[$obj] = $query->result();
				}
				$results += $query_result;
			}
		}
		
		return $results;
	}
}
