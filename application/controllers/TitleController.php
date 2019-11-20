<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class TitleController extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->model('TitleModel');
		$this->load->helper('form');
		$this->load->helper('html');
		$this->load->helper('url');
		$this->load->library('form_validation');
	}

	public function index()
	{	$this->load->view('index');
	}

	public function viewTitle($ISBN)
    {	$data['view_data']= $this->TitleModel->drilldown($ISBN);
		$this->load->view('TitleView', $data);
    }

	public function listTitles() 
	{	$data['title_info']=$this->TitleModel->get_all_titles();
		$this->load->view('titleListView',$data);
	}

	public function editTitle($ISBN)
    {	$data['edit_data']= $this->TitleModel->drilldown($ISBN);
		$this->load->view('updateTitleView', $data);
    }

	public function deleteTitle($ISBN)
    {	$deletedRows = $this->TitleModel->deleteTitleModel($ISBN);
		if ($deletedRows > 0)
			$data['message'] = "$deletedRows title has been deleted";
		else
			$data['message'] = "There was an error deleting the title with an ISBN of $ISBN";
		$this->load->view('displayMessageView',$data);
    }

    public function updateTitle($ISBN)
    {	$pathToFile = $this->uploadAndResizeFile();
		$this->createThumbnail($pathToFile);

		//set validation rules
		$this->form_validation->set_rules('ISBN', 'ISBN', 'required');
		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('editionNumber', 'Edition Number', 'required');	
		$this->form_validation->set_rules('yearPublished', 'Year Published', 'required');
		$this->form_validation->set_rules('publisherID', 'Publisher ID', 'required');
		$this->form_validation->set_rules('price', 'Price', 'required');
	
		//get values from post
		$aTitle['ISBN'] = $this->input->post('ISBN');
		$aTitle['title'] = $this->input->post('title');
		$aTitle['editionNumber'] = $this->input->post('editionNumber');
		$aTitle['yearPublished'] = $this->input->post('yearPublished');
		$aTitle['publisherID'] = $this->input->post('publisherID');
		$aTitle['price'] = $this->input->post('price');
		$aTitle['image'] = $_FILES['userfile']['name'];

		//check if the form has passed validation
		if (!$this->form_validation->run()){
			//validation has failed, load the form again
			$this->load->view('updateTitleView', $aTitle);
			return;
		}

		
		//check if update is successful
		if ($this->TitleModel->updateTitleModel($aTitle, $ISBN)) {
			redirect('TitleController/listTitles');
		}
		else {
			$data['message']="Uh oh ... problem on update";
		}
    }

	public function handleInsert(){
		if ($this->input->post('submitInsert')){

			$pathToFile = $this->uploadAndResizeFile();
			$this->createThumbnail($pathToFile);
		
			//set validation rules
			$this->form_validation->set_rules('ISBN', 'ISBN', 'required');
			$this->form_validation->set_rules('title', 'Title', 'required');
			$this->form_validation->set_rules('editionNumber', 'Edition Number', 'required');	
			$this->form_validation->set_rules('yearPublished', 'Year Published', 'required');
			$this->form_validation->set_rules('publisherID', 'Publisher ID', 'required');
			$this->form_validation->set_rules('price', 'Price', 'required');
			//$this->form_validation->set_rules('userfile', 'userfile', 'required');

			//get values from post
			$aTitle['ISBN'] = $this->input->post('ISBN');
			$aTitle['title'] = $this->input->post('title');
			$aTitle['editionNumber'] = $this->input->post('editionNumber');
			$aTitle['yearPublished'] = $this->input->post('yearPublished');
			$aTitle['publisherID'] = $this->input->post('publisherID');
			$aTitle['price'] = $this->input->post('price');
			$aTitle['image'] = $_FILES['userfile']['name'];
			
			//check if the form has passed validation
			if (!$this->form_validation->run()){
				//validation has failed, load the form again
				$this->load->view('insertTitleView', $aTitle);
				return;
			}

			//check if insert is successful
			if ($this->TitleModel->insertTitleModel($aTitle)) {
				$data['message']="The insert has been successful";
			}
			else {
				$data['message']="Uh oh ... problem on insert";
			}
			
			//load the view to display the message
			$this->load->view('displayMessageView', $data);
			
			return;
		}
		$aTitle['ISBN'] = "";
		$aTitle['title'] = "";
		$aTitle['editionNumber'] = "";
		$aTitle['yearPublished'] = "";
		$aTitle['publisherID'] = "";
		$aTitle['price'] = "";
		$aTitle['image'] = "";

		//load the form
		$this->load->view('insertTitleView', $aTitle);
	}

	function uploadAndResizeFile()
	{	//set config options for thumbnail creation
		$config['upload_path']='./assets/images/full/';
		$config['allowed_types']='gif|jpg|png';
		$config['max_size']='100';
		$config['max_width']='1024';
		$config['max_height']='768';
		
		$this->load->library('upload',$config);
		if (!$this->upload->do_upload())
			echo $this->upload->display_errors();
		else
			echo 'upload done<br>';	
	
		$upload_data = $this->upload->data();
		$path = $upload_data['full_path'];
		
		$config['source_image']=$path;
		$config['maintain_ratio']='FALSE';
		$config['width']='180';
		$config['height']='200';

		$this->load->library('image_lib',$config);
		if (!$this->image_lib->resize())
			echo $this->image_lib->display_errors();
		else
			echo 'image resized<br>';
			
		$this->image_lib->clear();
		return $path;
	}
	
	function createThumbnail($path)
	{	//set config options for thumbnail creation
		$config['source_image']=$path;
		$config['new_image']='./assets/images/thumbs/';
		$config['maintain_ratio']='FALSE';
		$config['width']='42';
		$config['height']='42';
		
		//load library to do the resizing and thumbnail creation
		$this->image_lib->initialize($config);
		
		//call function resize in the image library to physiclly create the thumbnail
		if (!$this->image_lib->resize())
			echo $this->image_lib->display_errors();
		else
			echo 'thumbnail created<br>';	
	}
	
}