$(document).ready(function(){
	var check1=0; var id;var namaOld=""; var editCheck;
	$("#kode_produk").bind("keyup change", function(){
		var produk_id = $(this).val();
		$.ajax({
			url:'barang/cekData/tbl_produk/kode_produk/'+produk_id,
			data:{send:true},
			success:function(data){
				if(data==1){
					$("#err_kode_produk").text("");
					check1=1;
				}else{
					$("#err_kode_produk").text("*Kode produk sudah terpakai");
					check1=0;
				}

			}
		});
	});

	$(".edit").click(function(){
		id = $(this).attr('id');
		$.ajax({
			url:'barang/getData/'+id,
			data:{send:true},
			success:function(data){
				$("#produk_id").val(data['produk_id']);
				$("#update_kode_produk").val(data['kode_produk']);
				$("#update_nama").val(data['produk_nama']);
				$("#update_harga").val(data['produk_harga']);
			}
		});
	});

	$("#update_kode_produk").bind("keyup change", function(){
		var produk_id = $(this).val();
		$.ajax({
			// url:'barang/cekDataEdit/tbl_produk/kode_produk/'+id+'/'+namaOld,
			url:'barang/cekData/tbl_produk/kode_produk/'+produk_id,
			data:{send:true},
			success:function(data){
				if(data==1){
					$("#editerr_kode_produk").text("");
					editCheck=1;
				}else{
					$("#editerr_kode_produk").text("*Kode produk sudah terpakai");
					editCheck=0;
				}

			}
		});
	});
	
	$("#editform").submit(function(e){
		if (editCheck==0){
			$("#editModal").animate({scrollTop:0}, 'slow');
		}else{
			e.preventDefault();
			var formData = new FormData($(this)[0]);
			$.ajax({
				url:'barang/update/'+id,
				data:formData,
				type:'POST',
				contentType: false,
				processData: false,
				success:function(data){
					$("#editModal").hide();
					window.location.reload(true);
				}
			});
		}	
		return false;	
	});
	$('#tambahform').submit(function(e){
		if (check1==0){
			$("#addModal").animate({scrollTop:0}, 'slow');
		}else{
			e.preventDefault();
		    var formData = new FormData($(this)[0]);
		    $.ajax({
				url:'barang/insert',
				data:formData,
				type:'POST',
				contentType: false,
				processData: false,
				success:function(data){
					// return false;
					$("#addModal").hide();
					window.location.reload(true);
				}
			});
		}
		return false;
    });
	
	$(".info").click(function(){
			id = $(this).attr('id');
			$.ajax({
				url:'barang/getData/'+id,
				data:{send:true},
				success:function(data){
					$("#infodeskripsi").text(data['deskripsi']);
					$("#infofoto").html(data['foto']);		
				}
			});
		});

	$("#infoform").submit(function(e){
		e.preventDefault();
		var formData = new FormData($(this)[0]);
		$.ajax({
			url:'barang/getData/'+id,
			data:formData,
			type:'POST',
			contentType: false,
			processData: false,
			success:function(data){
				$("#infoModal").hide();
				window.location.reload(true);
			}
		});
		
	});

});