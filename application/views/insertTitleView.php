<?php
	$this->load->view('header'); 
	$this->load->helper('url');
	$base = base_url() . index_page();
	$img_base = base_url()."assets/images/";
?>
<br>
<h1 class="main"> Insert Title </h1>
<?php echo form_open_multipart('TitleController/handleInsert');
	echo '<br><br>';
	echo 'Enter ISBN :';
	echo form_input('ISBN', $ISBN);

	echo '</br></br>Title :';
	echo form_input('title', $title);

	echo '</br></br>Enter Edition Number :';
	echo form_input('editionNumber', $editionNumber);

	echo '</br></br>Enter Year Published :';
	echo form_input('yearPublished', $yearPublished);

	echo '</br></br>Enter Publisher ID :';
	echo form_input('publisherID', $publisherID);

	echo '</br></br>Enter Price :';
	echo form_input('price', $price);

	echo '</br></br>Select File for Upload :';
	echo form_upload('userfile');
	
	echo '</br></br>';
	
	echo form_submit('submitInsert', "Submit!");

	echo form_close();
	echo validation_errors();
?>

<?php
	$this->load->view('footer'); 
?>