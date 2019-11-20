<?php
	$this->load->view('header'); 
	$this->load->helper('url');
	$base = base_url() . index_page();
	$img_base = base_url()."assets/images/";
?>
<br>
<h1 class="main"> Update Title </h1>
<?php 
	foreach ($edit_data as $row) { 
		echo form_open_multipart('TitleController/updateTitle/'.$row->ISBN);
		echo '</br></br>';
		
		echo 'Title :';
		echo form_textarea('title', $row->Title);
	
		echo '</br></br>Edition Number :';
		echo form_input('editionNumber', $row->EditionNumber);

		echo '</br></br>Year Published :';
		echo form_input('yearPublished', $row->YearPublished);

		echo '</br></br>Publisher ID :';
		echo form_input('publisherID', $row->PublisherID);
	
		echo '</br></br>';
		echo '<img src='. $img_base.'full/'.$row->Image.'>';

		echo '</br></br>Select File for Upload :';
		echo form_upload('userfile');

		echo '</br></br>';
		echo form_submit('submitUpdate', "Submit!");
		echo form_close();
		echo validation_errors();
	}
?>

<?php
	$this->load->view('footer'); 
?>