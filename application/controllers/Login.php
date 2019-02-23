<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
	}

	public function index(){
		$this->sessionIn(); //check session
		$this->load->view('login_page');
	}

	public function loginProcess(){
		$this->load->model('Crud'); //load model
		$email = $this->input->post('email');
		$password = md5($this->input->post('password'));
		$query = $this->Crud->read('petugas', array('email'=>$email, 'password'=>$password), null, null);
		if($query->num_rows()==0){
			redirect(base_url('').'?balasan=1');
		}else{
			$this->load->driver('session'); //activate sessionp
			// print_r($query->result());
			// die;
			foreach($query->result() as $result){
				$id_user = $result->idpetugas;
				$kategori = $result->kategori;
				$nama = $result->nama;
			}
			$this->session->set_userdata('iduser', $id_user);
			$this->session->set_userdata('levelaks', $kategori);
			$this->session->set_userdata('nama', $nama);
			if($kategori==1){
				redirect(base_url('admin/dashboard'), 'refresh');
			}else{
				redirect(base_url('main/home'), 'refresh');
				// $this->load->view("layouts/main");
			}
		}
	}

	public function logoutProcess(){
		$this->load->driver('session'); //activate session
		$this->session->unset_userdata('iduser');
		$this->session->unset_userdata('levelaks');
		redirect(base_url(''), 'refresh');
	}
}