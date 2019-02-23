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
		}
	}
	
}