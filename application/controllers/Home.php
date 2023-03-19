<?php

defined('BASEPATH') OR exit('No direct script access allowed');
include(dirname(__file__)."/Main.php");
class Home extends CC_Main {
	
	public function __construct() {

        parent::__construct();
		$this->load->model('home_model');
    }

	public function index(){
		
	}
}