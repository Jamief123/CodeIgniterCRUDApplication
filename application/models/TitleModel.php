<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class TitleModel extends CI_Model
{
    function __construct()
    {	parent::__construct();
		$this->load->database();
    }
	
	function insertTitleModel($title)
	{	$this->db->insert('titles',$title);
		if ($this->db->affected_rows() ==1) {
			return true;
		}
		else {
			return false;
		}
	}

	function get_all_titles() 
	{	$this->db->select("*"); 
		$this->db->from('titles');
		$query = $this->db->get();
		return $query->result();
	}
	
	public function deleteTitleModel($ISBN)
	{	$this->db->where('ISBN', $ISBN);
		return $this->db->delete('titles');
    }

	function updateTitleModel($author,$ISBN)
	{	$this->db->where('ISBN', $ISBN);
		return $this->db->update('titles', $author);
	}

	public function drilldown($ISBN)
	{	$this->db->select("ISBN,Title,EditionNumber,YearPublished,PublisherID,Image"); 
		$this->db->from('titles');
		$this->db->where('ISBN',$ISBN);
		$query = $this->db->get();
		return $query->result();
    }

}
?>