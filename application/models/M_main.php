<?php
class M_main extends CI_Model{

	function get_data($act="",$id=""){
		if($act == 'daftarmember'){
			$conditions = "";
			if(isset($id['search2'])){
				$conditions = "WHERE mbr.fullname LIKE '%".$id['search2']."%' OR mbr.no_induk LIKE'%".$id['search2']."%'";
			}else{
				if(!empty($id)){
					$conditions = "WHERE mbr.id=".$id;
				}
			}

			$sql = "SELECT mbr.id,mbr.no_induk,mbr.fullname,mbr.no_kendaraan, fkl.nama_fakultas,jrn.nama_jurusan,zona.nama_zona AS zona, CASE WHEN mbr.status=1 THEN 'AKTIF' ELSE 'TIDAK AKTIF' END AS status 
					FROM app_member mbr
					LEFT JOIN app_fakultas fkl ON fkl.id = mbr.id_fakultas
					LEFT JOIN app_jurusan jrn ON jrn.id = mbr.id_jurusan
					LEFT JOIN app_zona zona ON zona.id = mbr.id_zona "
					.$conditions.
					" ORDER BY mbr.id DESC";
			$result = $this->db->query($sql)->result_array();
			return $result;
		}else if($act == 'memberinfo'){
			if($id != ""){
				$conditions = "WHERE mbr.id=".$id;
			}else{
				$conditions = "";
			}
			$sql = "SELECT mbr.id,mbr.no_induk,mbr.fullname,mbr.no_kendaraan, fkl.nama_fakultas,jrn.nama_jurusan,zona.nama_zona AS zona, io.created_date AS waktu_parkir, io.created_date_out AS waktu_keluar, io.id, zona.sisa_kuota,
				CASE WHEN mbr.status=1 THEN 'AKTIF' ELSE 'TIDAK AKTIF' END AS status
				FROM app_member mbr
				LEFT JOIN app_fakultas fkl ON fkl.id = mbr.id_fakultas
				LEFT JOIN app_jurusan jrn ON jrn.id = mbr.id_jurusan
				LEFT JOIN app_zona zona ON zona.id = mbr.id_zona 
				LEFT JOIN app_inout io ON io.no_induk = mbr.no_induk
				".$conditions."
				ORDER BY io.id DESC";
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
			$conditions = "";
			if(isset($id['search'])){
				$conditions = "WHERE mbr.no_kendaraan LIKE '%".$id['search']."%' OR mbr.no_induk LIKE'%".$id['search']."%'";
			}else{
				if(!empty($id)){
					$conditions = "WHERE DATE(ant.created_date_out) >= '".$id['date']."' AND DATE(ant.created_date_out) <= '".$id['date_2']."'";
				}
			}
			
			$sql = "SELECT ant.*, zona.nama_zona,mbr.no_kendaraan
					FROM app_inout ant 
					LEFT JOIN app_member mbr ON mbr.no_induk = ant.no_induk
					LEFT JOIN app_zona zona ON zona.id = mbr.id_zona "
					.$conditions.
					" ORDER BY ant.id DESC";
					// WHERE DATE(created_date) = CURDATE()
			// echo $sql;die;
			$result = $this->db->query($sql)->result_array();
			return $result;
		}else if($act == 'report'){
			$conditions = "";
			$conditionstotal = "";
			$conditionstarif = "WHERE zona.id IN(1,2,3)";
			if(isset($id['search'])){
				$conditions = "WHERE mbr.no_kendaraan LIKE '%".$id['search']."%' OR mbr.no_induk LIKE'%".$id['search']."%'";
			}else{
				if(!empty($id)){
					$zonaid = " AND zona.id=".$id['zona'];
					$zonaidbytarif = "WHERE zona.id ='".$id['zona']."'";
					if($id['zona'] == 0){
						$zonaid = "";
						$zonaidbytarif = "";//$conditionstarif;
					}
					$conditions = "WHERE DATE(ant.created_date_out) >= '".$id['date']."' AND DATE(ant.created_date_out) <= '".$id['date_2']."'".$zonaid;
					$conditionstotal = "AND DATE(ant.created_date_out) >= '".$id['date']."' AND DATE(ant.created_date_out) <= '".$id['date_2']."'".$zonaid;
					$conditionstarif = $zonaidbytarif;//"WHERE zona.id ='".$id['zona']."'";
				}
			}
			// print_r($conditions);die;
			$sql = "SELECT ant.*, zona.nama_zona,mbr.no_kendaraan
					FROM app_inout ant 
					LEFT JOIN app_member mbr ON mbr.no_induk = ant.no_induk
					LEFT JOIN app_zona zona ON zona.id = mbr.id_zona "
					.$conditions.
					" ORDER BY ant.id DESC";
					// WHERE DATE(created_date) = CURDATE()
			// echo $sql;die;
			$result = $this->db->query($sql)->result_array();
			$sqlgettotal = "SELECT zona.nama_zona,count(zona.id) as total_parkir, IFNULL(SUM(ant.tarif),0) as total_tarif
							FROM app_inout ant 
							LEFT JOIN app_member mbr ON mbr.no_induk = ant.no_induk
							LEFT JOIN app_zona zona ON zona.id  = mbr.id_zona
							WHERE zona.id = 1 ".$conditionstotal."
							UNION ALL
							SELECT zona.nama_zona,count(zona.id) as dosen,IFNULL(SUM(ant.tarif),0) as total_tarif
							FROM app_inout ant 
							LEFT JOIN app_member mbr ON mbr.no_induk = ant.no_induk
							LEFT JOIN app_zona zona ON zona.id  = mbr.id_zona
							WHERE zona.id = 2 ".$conditionstotal."
							UNION ALL
							SELECT zona.nama_zona,count(zona.id) as pgw,IFNULL(SUM(ant.tarif),0) as total_tarif
							FROM app_inout ant 
							LEFT JOIN app_member mbr ON mbr.no_induk = ant.no_induk
							LEFT JOIN app_zona zona ON zona.id  = mbr.id_zona
							WHERE zona.id = 3 ".$conditionstotal."				
							";
					// echo $sqlgettotal;die;		
			$resultTotal = $this->db->query($sqlgettotal)->result_array();

			$sqltarif = "SELECT sum(ant.tarif) as total_tarif
						FROM app_inout ant 
						LEFT JOIN app_member mbr ON mbr.no_induk = ant.no_induk
						LEFT JOIN app_zona zona ON zona.id  = mbr.id_zona ".$conditionstarif;
			$resultTarif = $this->db->query($sqltarif)->result_array();
// echo $sqltarif;die;	
			$resultcombine = [
				'data' => $result,
				'total' => $resultTotal,
				'tarif' => $resultTarif
			];
			// echo "<pre>";
			// print_r($resultcombine);
			// die;
			return $resultcombine;
		}else if($act == 'dosen'){
			$sql = "SELECT * FROM app_zona WHERE id=2";
			$result = $this->db->query($sql)->result_array();
			return $result;
		}else if($act == 'mahasiswa'){
			$sql = "SELECT * FROM app_zona WHERE id=1";
			$result = $this->db->query($sql)->result_array();
			return $result;
		}else if($act == 'pegawai'){
			$sql = "SELECT * FROM app_zona WHERE id=3";
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

					$result['member'] = $this->get_data('memberinfo',$getKuota[0]['id_member']);
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