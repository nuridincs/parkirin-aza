$(document).ready(function(){
    $("#savemember").click(function(){
        // var no_induk = $("#no_induk").val(),
        //     nama = $("#nama").val(),
        //     fakultas = $("#fakultas").val(),
        //     jurusan = $("#jurusan").val(),
        //     no_kendaraan = $("#no_kendaraan").val(),
        //     zona = $("#zona").val();
        var formData = new FormData(document.getElementById("tambahform"));
        $.ajax({
            url:'execute/save/member',
            data:formData,
            type:'POST',
            contentType: false,
            processData: false,
            success:function(data){
                console.log(data);
                // $("#editModal").hide();
                // window.location.reload(true);
            }
        });
    });

    $(".edit").click(function(){
        id = $(this).attr('id');
        $.ajax({
            url:'execute/getdata/member',
            // data: {id:id},
            type:'POST',
            data:{send:true,id:id},
            success:function(data){
                console.log(data['no_induk']);
                $("#update_produk_id").val(data['produk_id']);
                $("#update_kode_produk").val(data['kode_produk']);
                $("#update_nama").val(data['produk_nama']);
                $("#update_harga").val(data['produk_harga']);
            }
        });
    });
});