<?php
	$this->load->view('header'); 
	$this->load->helper('url');
	$base = base_url() . index_page();
	$img_base = base_url()."assets/images/";
?>

<?php 
	foreach ($view_data as $row) { 
		echo form_open();
		echo '</br></br>';
		
		echo 'Title :';
		echo form_textarea('title', $row->Title, 'readonly');
	
		echo '</br></br>Edition Number :';
		echo form_input('editionNumber', $row->EditionNumber, 'readonly');

		echo '</br></br>Year Published :';
		echo form_input('yearPublished', $row->YearPublished, 'readonly');

		echo '</br></br>Publisher ID :';
		echo form_input('publisherID', $row->PublisherID, 'readonly');
	
		echo '</br></br>';
		echo '<img src='. $img_base.'full/'.$row->Image.'>';

		echo '</br></br>';
		echo form_close();
	}
?>

<?php
	//$this->load->view('footer'); 
?>