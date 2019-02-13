<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class WeddingBlog extends CI_Controller {

	public function index()
	{
		$this->load->model('blog/blog_model','myblog_model');
		$data = $this->myblog_model->getRecord();
		$this->load->view('template/main.php',array('view_name'=>'weddingblog/index.php','data'=>$data));
	}

	public function overview()
	{
		$this->load->view('template/main.php',array('view_name'=>'weddingblog/overview.php'));
	}	
}
