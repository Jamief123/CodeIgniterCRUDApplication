<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	$this->load->view('header'); 
	$this->load->helper('url');
	$base = base_url() . index_page();
	$img_base = base_url()."assets/images/";
?>
<div class="list">
	<br><br>
	<h1 class="main">List of Titles</h1>
	<br><br>
	<table>
		<tr>
			<th align="left" width="100">Title</th>
			<th align="left" width="100">Edition Number</th>
			<th align="left" width="100">Year Published</th>
			<th align="left" width="100">Publisher ID</th>
		</tr>

		<?php foreach($title_info as $row){?>
		<tr>
			<td><?php echo $row->Title;?></td>
			<td><?php echo $row->EditionNumber;?></td>
			<td><?php echo $row->YearPublished;?></td>
			<td><?php echo $row->PublisherID;?></td>
			<td><img src="<?php echo $img_base.'thumbs/'.$row->Image;?>"></td>
			<td><?php echo anchor('TitleController/viewTitle/'.$row->ISBN, 'View'); ?> </td>


			<!-- <td><?php echo anchor('TitleController/viewTitle/'.$row->AuthorID, 'View'); ?> </td>
			<td><?php echo anchor('TitleController/editTitle/'.$row->AuthorID, 'Update'); ?> </td>			
			<td><?php echo anchor('TitleController/deleteTitle/'.$row->AuthorID, 'Delete', 'onclick = "return checkDelete()"'); ?> </td> -->
		</tr>     
		<?php }//end foreach?> 
   </table>
   <br><br>
</div>
<?php
	$this->load->view('footer'); 
?> 