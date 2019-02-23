$(document).ready(function(){

    $("#inputbarang").click(function(){
        var id_barang = $("#id_barang").val();
        var table = "";
        table += '<table class="table table-hover">';
        table += "<tr>";
            table += "<th>Kode</th>";
            table += "<th>Nama Produk</th>";
            table += "<th>Qty</th>";
            table += "<th>Total</th>";
            table += "<th></th>";
        table +="</tr>";
        // var arrtmp = [];
        $.ajax({
            url:'transaksi/getbarang',
            data:{param:id_barang},
            dataType:'json',
            type:'POST',
            success:function(data){
                var obj = JSON.stringify(data);
                var n = 0;
                var arrtmp = [];
                var id = data[0]['id'];
                var nama_barang = data[0]['nama_barang'];
                var harga = data[0]['harga'];
                var inptQty = $("#qty_pembelian").val();
                var total = parseInt(inptQty) * parseInt(harga);
                
                arrtmp.push({id:id,nama_barang:nama_barang,qty:inptQty,total:total});
                // n++;
                // console.log(arrtmp);

                // return false
                var x = document.getElementById('POITable');
                var new_row = x.rows[1].cloneNode(true);
                var len = x.rows.length;
                new_row.cells[0].innerHTML = len;

                var inp1 = new_row.cells[1].getElementsByTagName('input')[0];
                inp1.id += len;
                inp1.value = id;

                var inp2 = new_row.cells[2].getElementsByTagName('input')[0];
                inp2.id += len;
                inp2.value = nama_barang; 

                var inp3 = new_row.cells[3].getElementsByTagName('input')[0];
                inp3.id += len;
                inp3.value = inptQty;

                var inp4 = new_row.cells[4].getElementsByTagName('input')[0];
                inp4.id += len;
                inp4.value = total;
                x.appendChild(new_row);

                var result = [];
//   $('table tr').each(function(){
//   	$('td', this).each(function(index, val){
//           console.log(val);
//     	if(!result[index]) {
//             result[index] = 0;
//         }
        
//         result[index] += parseInt($(val).text());
        
      
//     });
//   });
  
//   $('table').append('<tr></tr>');
//   $(result).each(function(){
//   	$('table tr').last().append('<td>sini</td>')
//   });
                //         table += "<tr>";
                //             table += "<td>"+id+"</td>";
                //             table += "<td>"+nama_barang+"</td>";
                //             table += "<td>"+inptQty+"</td>";
                //             table += "<td>"+qty+"</td>";
                //             table += "<td>Hapus</td>";
                //         table +="</tr>";
                //     table +="</table>";
                // $('#result_table').append(table);
            }
        });

        // console.log(arrtmp);
    })
      
});

function bayar(){
    // var elements = document.getElementsByName( 'input' );
    // var id = elements[0].getAttribute( 'kode' );
    var id = $("input[name='kode']").val();
    console.log(id);
}

function deleteRow(row) {
    var i = row.parentNode.parentNode.rowIndex;
    document.getElementById('POITable').deleteRow(i);
}  

function insRow() {
    var x = document.getElementById('POITable');
    var new_row = x.rows[1].cloneNode(true);
    var len = x.rows.length;
    new_row.cells[0].innerHTML = len;

    var inp1 = new_row.cells[1].getElementsByTagName('input')[0];
    inp1.id += len;
    inp1.value = 'A-001';
    var inp2 = new_row.cells[2].getElementsByTagName('input')[0];
    inp2.id += len;
    inp2.value = '2'; 
    var inp3 = new_row.cells[3].getElementsByTagName('input')[0];
    inp3.id += len;
    inp3.value = '10000';
    x.appendChild(new_row);
}