<?php
class M_main extends CI_Model{

	function get_data($act="",$id=""){
		if($act == 'daftarmember'){
			if($id != ""){
				$conditions = "WHERE id=".$id;
			}else{
				$conditions = "";
			}
			$sql = "SELECT id,fullname,email,no_kendaraan, CASE WHEN status=1 THEN 'AKTIF' ELSE 'TIDAK AKTIF' END AS status, CASE WHEN role=1 THEN 'MAHASISWA' ELSE 'KARYAWAN' END AS role FROM app_member ".$conditions;
			$result = $this->db->query($sql)->result_array();
			return $result;
		}else if($act == 'member'){
			$sql = "SELECT * FROM app_member WHERE id=".$id;
			$result = $this->db->query($sql)->row();
			return $result;
		}else if($act == 'fakultas'){
			$sql = "SELECT * FROM app_fakultas";
			$result = $this->db->query($sql)->result_array();
			return $result;
		}else if($act == 'jurusan'){
			$sql = "SELECT * FROM app_jurusan";
			$result = $this->db->query($sql)->result_array();
			return $result;
		}else if($act == 'zona'){
			$sql = "SELECT * FROM app_zona";
			$result = $this->db->query($sql)->result_array();
			return $result;
		}else if($act == 'jabatan'){
			$sql = "SELECT * FROM app_jabatan";
			$result = $this->db->query($sql)->result_array();
			return $result;
		}
	}
	
	function execute($type="",$act="",$data=""){
		if($type=="save"){
			if($act=="member"){
				$this->db->insert('app_member',$data);
			}
		}
	}
}