<?php
class News extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('news_model');
	}

public function index()
	{
		$data['news'] = $this->news_model->get_news();
		$data['title'] = 'News archive';

		//$this->load->view('templates/header', $data);
		$this->load->view('news/index', $data);
		//$this->load->view('templates/footer');

		
		$rowcount = $this->news_model->get_row_count();
		
		print '<strong> Row Count : '.$rowcount.'</strong>';
		
	}
	
	

	public function view($slug)
	{
		$data['news_item'] = $this->news_model->get_news($slug);

		if (empty($data['news_item']))
		{
			show_404();
		}

		$data['title'] = $data['news_item']['title'];

		//$this->load->view('templates/header', $data);
		$this->load->view('news/view', $data);
		//$this->load->view('templates/footer');
	}

	public function create()
	{
		
		$this->load->helper('form');
		
		$this->load->library('form_validation');
		
		$data['title']='Create a News Item';
		
		$this->form_validation->set_rules('title','Title','required');
		$this->form_validation->set_rules('text','Text','required');
		
		if($this->form_validation->run())
		{
		$this->news_model->set_news();
		echo 'News Saved Successfully';
		$this->load->view('news/success');	
		}
		else
		 {
			$this->load->view('news/create');
		}
	}

}