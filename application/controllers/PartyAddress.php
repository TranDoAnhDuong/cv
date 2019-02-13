<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PartyAddress extends CI_Controller {

	public function index()
	{
		$this->load->view('template/main.php',array('view_name'=>'partyaddress/index.php'));
    }
    	
}
