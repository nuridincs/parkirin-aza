<?php
class M_main extends CI_Model{

	function get_data($act="",$id=""){
		if($act == 'daftarmember'){
			if($id != ""){
				$conditions = "WHERE mbr.id=".$id;
			}else{
				$conditions = "";
			}
			//$sql = "SELECT id,fullname,email,no_kendaraan, CASE WHEN status=1 THEN 'AKTIF' ELSE 'TIDAK AKTIF' END AS status, CASE WHEN role=1 THEN 'MAHASISWA' ELSE 'KARYAWAN' END AS role FROM app_member ".$conditions;
			$sql = "SELECT mbr.id,mbr.no_induk,mbr.fullname,mbr.no_kendaraan, fkl.nama_fakultas,jrn.nama_jurusan,zona.nama_zona AS zona, CASE WHEN mbr.status=1 THEN 'AKTIF' ELSE 'TIDAK AKTIF' END AS status -- ,  AS role 
					FROM app_member mbr
					LEFT JOIN app_fakultas fkl ON fkl.id = mbr.id_fakultas
					LEFT JOIN app_jurusan jrn ON jrn.id = mbr.id_jurusan
					LEFT JOIN app_zona zona ON zona.id = mbr.id_zona ".$conditions;
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
		}else if($act == "kuota"){
			$sql = "SELECT zona.id,mbr.id AS id_member,mbr.no_induk,mbr.no_kendaraan,zona.nama_zona,zona.kuota,zona.sisa_kuota
					FROM app_member mbr
					INNER JOIN app_zona zona ON zona.id = mbr.id_zona
					WHERE mbr.no_induk ='$id'";
			$result = $this->db->query($sql)->result_array();
			return $result;
		}else if($act == 'inout'){
			$sql = "SELECT * FROM app_inout WHERE no_induk='$id' ORDER BY id DESC";
			$result = $this->db->query($sql)->result_array();
			return $result;
		}else if($act == 'daftarparkir'){
			if(!empty($id)){
				$conditions = "WHERE ant.created_date_out >= '".$id['date']."' AND ant.created_date_out <= '".$id['date_2']."'";
			}else{
				$conditions = "";
			}
			$sql = "SELECT ant.*, zona.nama_zona,mbr.no_kendaraan
					FROM app_inout ant 
					LEFT JOIN app_member mbr ON mbr.no_induk = ant.no_induk
					LEFT JOIN app_zona zona ON zona.id = mbr.id_zona "
					.$conditions.
					" ORDER BY ant.id DESC";
					// WHERE DATE(created_date) = CURDATE()
			$result = $this->db->query($sql)->result_array();
			return $result;
		}
	}
	
	function execute($type="",$act="",$data=""){
		if($type=="save"){
			if($act=="member"){
				$this->db->insert('app_member',$data);
			}else if($act=="inout"){
				$no_induk = $data['no_induk'];
				$status = $data['status'];

				$cekInout = $this->get_data('inout',$no_induk);
				$getKuota = $this->get_data('kuota',$no_induk);
				if(!empty($getKuota)){
					if($status == "in"){
						if(!empty($cekInout) && $cekInout[0]['status_inout'] == 1){
							return 1;
							exit;
						}else{
							$sisa_kuota = $getKuota[0]['sisa_kuota'] - 1;
							$datainout = array(
								'no_induk' => $getKuota[0]['no_induk'],
								'no_in' => $sisa_kuota,
								'created_date' => date("Y-m-d H:i:s")
							);

							$this->db->insert('app_inout',$datainout);

							$datahistory = array(
								'no_induk' => $getKuota[0]['no_induk'],
								'status_inout'=> 1,
								'created_date' => date("Y-m-d H:i:s")
							);
						}
					}else{
						if(empty($cekInout)){
							return 0;
							exit;
						}else {
							if($cekInout[0]['status_inout'] == 2){
								return 2;
								exit;
							}else{
								$sisa_kuota = $getKuota[0]['sisa_kuota']  + 1;
								$datainout = array(
									'no_induk' => $getKuota[0]['no_induk'],
									'no_in' => $sisa_kuota,
									'status_inout' => 2,
									'created_date' => date("Y-m-d H:i:s")
								);

								$datahistory = array(
									'no_induk' => $getKuota[0]['no_induk'],
									'status_inout'=> 2,
									'created_date' => date("Y-m-d H:i:s")
								);
								$this->db->where('no_induk',$getKuota[0]['no_induk']);
								$this->db->update('app_inout',array('status_inout'=>2,'created_date_out' => date("Y-m-d H:i:s")));
							}
						}
					}

					$this->db->where('id',$getKuota[0]['id']);
					$this->db->update('app_zona',array('sisa_kuota'=>$sisa_kuota));

					$this->db->insert('app_history_inout',$datahistory);

					$result['member'] = $this->get_data('daftarmember',$getKuota[0]['id_member']);
					$result['kouta'] = array(
						'sisa_kuota' => $sisa_kuota
					);

					return $result;
				}else{
					return 0;
				}
			}
		}
	}
}