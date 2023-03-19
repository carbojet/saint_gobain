<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class CC_Main extends CI_Controller {

	public function __construct(){
		parent::__construct();
		
		$this->db = $this->load->database('default', TRUE);
		$this->load->model('main_model');
	}
}