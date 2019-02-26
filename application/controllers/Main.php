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
			$data['fakultas'] = $this->main->get_data('fakultas');
			$data['jurusan'] = $this->main->get_data('jurusan');
			$data['zona'] = $this->main->get_data('zona');
			$data['content'] = "content/daftar_member";
			$this->load->view("layouts/main",$data);
		}

		public function execute($type="",$act="",$id=""){
			if($type == 'cetak'){
				if($act == 'member'){
					$data['result'] = $this->main->get_data('daftarmember',$id);
					$data['content'] = "content/data_member";
					$this->load->view("layouts/main",$data);
				}
			}else if($type == 'save'){
				if($act == 'member'){
					$param = $this->input->post();
					$no_induk = $this->input->post('no_induk');
					$this->generateqrcode($no_induk);
					$data = $this->main->execute('save','member',$param);
					// echo $data;
				}
			}else if($type == 'getdata'){
				if($act == 'member'){
					$id = $param = $this->input->post('id');
					$result = $this->main->get_data('member',$id);
					header('Content-Type: application/json');
					echo json_encode($result);
				}
			}
			//$this->load->view("layouts/main",$data);
		}

		public function generateqrcode($no_induk){
			$this->load->library('ciqrcode'); //meload library barcode
			$this->load->helper('url'); //meload helper url untuk aktifkan base urlnya
	        $barcode_create=$no_induk; // membuat code barcode yang nilainya 123456789
	        //settingang pada barcode 
	        $params['data'] = $barcode_create;
			$params['level'] = 'H';
			$params['size'] =5;
			//settingan untuk membuat file barcode dalam format .png dan di simpan dalam folder assets
			$params['savename'] = FCPATH . "assets/qrcode/".$barcode_create.".png";
			//mulai menggenerate barcode
			$this->ciqrcode->generate($params);
			//mencoba mengeluarkan nilai barcode yang baru saja di generate
			// echo '<img src="'.base_url().'assets/qrcode/'.$barcode_create.'.png" />';
		}

	}

?>