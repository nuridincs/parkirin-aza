<?php

	class Main extends CI_Controller{

		function __construct(){
			parent::__construct();
			$this->load->model('m_main','main');
		}

		public function index(){
			$this->load->view("index");
		}

		public function home(){
			$data['content'] = "content/dashboard";
			$this->load->view("layouts/main",$data);
		}

		public function daftarmember(){
			$data['result'] = $this->main->get_data('daftarmember');
			$data['content'] = "content/daftar_member";
			$this->load->view("layouts/main",$data);
		}

		public function execute($type,$act,$id){
			if($type == 'cetak'){
				if($act == 'member'){
					$data['result'] = $this->main->get_data('daftarmember',$id);
					$data['content'] = "content/data_member";
				}
			}
			$this->load->view("layouts/main",$data);
		}
	}

?>