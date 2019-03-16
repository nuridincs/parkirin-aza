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
			if($this->session->userdata('levelaks') == 2){
				$data['dosen'] = $this->main->get_data('dosen');
				$data['mahasiswa'] = $this->main->get_data('mahasiswa');
				$data['pegawai'] = $this->main->get_data('pegawai');
			}
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

		public function daftarparkir(){
			$param = $this->input->post();
			$data['result'] = $this->main->get_data('daftarparkir',$param);
			$data['content'] = "content/daftar_parkir";
			$this->load->view("layouts/main",$data);
		}

		public function loadbarcode(){
			$data['content'] = "content/scan_barcode";
			$this->load->view("layouts/main",$data);
		}

		public function bynoinduk(){
			$data['content'] = "content/form_inout";
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
				}else if($act == 'inout'){
					$param = $this->input->post();
					$result = $this->main->execute('save','inout',$param);
					if($param['status'] == "in"){
						$status = "Masuk";
					}else{
						$status = "Keluar";
					}
					if($result == 0){
						$_view = "Data tidak ditemukan";
					}else if($result == 1){
						$_view = "Anda sedang parkir";
					}else if($result == 2){
						$_view = "Anda sedang tidak parkir";
					}else{
						$_view = '<div><h4>Info Parkir '.$status.'</h4>';
							$_view .= '<div class="row">';
								$_view .= '<div class="col-sm-8" align="center">';
									$_view .= '<img src="'. base_url() .'assets/qrcode/'.$result['member'][0]['no_induk'].'.png" alt="" class="img-responsive">';
								$_view .= '</div>';
							$_view .= '</div>';
							$_view .= '<div class="row">';
								$_view .= '<div class="col-sm-6">No. Induk</div>';
								$_view .= '<div class="col-sm-6">'.$result['member'][0]['no_induk'].'</div>';
							$_view .= '</div>';
							$_view .= '<div class="row">';
								$_view .= '<div class="col-sm-6">Fakultas</div>';
								$_view .= '<div class="col-sm-6">'.$result['member'][0]['nama_fakultas'].'</div>';
							$_view .= '</div>';
							$_view .= '<div class="row">';
								$_view .= '<div class="col-sm-6">Jurusan</div>';
								$_view .= '<div class="col-sm-6">'.$result['member'][0]['nama_jurusan'].'</div>';
							$_view .= '</div>';
							$_view .= '<div class="row">';
								$_view .= '<div class="col-sm-6">Zona</div>';
								$_view .= '<div class="col-sm-6">'.$result['member'][0]['zona'].'</div>';
							$_view .= '</div>';
							$_view .= '<div class="row">';
								$_view .= '<div class="col-sm-6">Slot parkir tersedia</div>';
								$_view .= '<div class="col-sm-6">'.$result['kouta']['sisa_kuota'].'</div>';
							$_view .= '</div>';
						$_view .= '</div>';
					}

					header('Content-Type: application/json');
					echo json_encode($_view);
				}
			}else if($type == 'getdata'){
				if($act == 'member'){
					$id = $param = $this->input->post('id');
					$result = $this->main->get_data('member',$id);
					header('Content-Type: application/json');
					echo json_encode($result);
				}else if($act == 'memberbyid'){
					$data['result'] = $this->main->get_data('member',$id);
					$data['fakultas'] = $this->main->get_data('fakultas');
					$data['jurusan'] = $this->main->get_data('jurusan');
					$data['zona'] = $this->main->get_data('zona');
					$data['content'] = "content/form_member";
					$this->load->view("layouts/main",$data);
				}
			}else if($type == 'delete'){
				if($act == 'member'){
					$this->db->where('id', $id);
					$this->db->delete('app_member');
					redirect(($_SERVER['HTTP_REFERER']), 'refresh');
				}
			}else if($type == 'edit'){
				if($act == 'member'){
					// print_r($_POST);
					$data = array(
						'no_induk' => $this->input->post('update_no_induk'),
						'fullname' => $this->input->post('update_fullname'),
						'id_fakultas' => $this->input->post('update_id_fakultas'),
						'id_jurusan' => $this->input->post('update_id_jurusan'),
						'no_kendaraan' => $this->input->post('update_no_kendaraan'),
						'id_zona' => $this->input->post('update_id_zona'),
					);
					$this->db->where('id',$this->input->post('update_id'));
					$this->db->update('app_member',$data);
					redirect(base_url('main/daftarmember'), 'refresh');
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

		public function export($act="",$id=""){
			$this->load->library('m_pdf');
			error_reporting(E_ALL);
			if($act == 'cetak_kartu'){
				$nama_dokumen='PDF';
				$mpdf=new mPDF('utf-8', 'A4', 10.5, 'arial');
				ob_start();
				$data['result'] = $this->main->get_data('daftarmember',$id);
				$data['content'] = "content/data_member";
				$_view = $this->load->view("layouts/main",$data);
			}
			
			echo $_view;
				
			$html = ob_get_contents();
			//ob_end_clean();
			$mpdf->WriteHTML(utf8_encode($html));
			$mpdf->Output($nama_dokumen.".pdf" ,'I');
			exit;
		}

	}

?>