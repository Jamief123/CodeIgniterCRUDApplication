<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class TitleModel extends CI_Model
{
    function __construct()
    {	parent::__construct();
		$this->load->database();
    }
	
	// function insertAuthorModel($author)
	// {	$this->db->insert('authors',$author);
	// 	if ($this->db->affected_rows() ==1) {
	// 		return true;
	// 	}
	// 	else {
	// 		return false;
	// 	}
	// }

	function get_all_titles() 
	{	$this->db->select("*"); 
		$this->db->from('titles');
		$query = $this->db->get();
		return $query->result();
	}
	
	// public function deleteAuthorModel($id)
	// {	$this->db->where('AuthorID', $id);
	// 	return $this->db->delete('authors');
 //    }

	// function updateAuthorModel($author,$id)
	// {	$this->db->where('AuthorID', $id);
	// 	return $this->db->update('authors', $author);
	// }

	// public function drilldown($author)
	// {	$this->db->select("AuthorID,FirstName,LastName,YearBorn,Image"); 
	// 	$this->db->from('authors');
	// 	$this->db->where('AuthorID',$author);
	// 	$query = $this->db->get();
	// 	return $query->result();
 //    }

}
?>