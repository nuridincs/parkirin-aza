<br><br><Br>
<div>
    <div style="padding:10px">
        <div style="width: 70%;padding: 15px;margin: 0 auto;">
            <table width="60%" cellspacing="0">
                <tbody>
                    <tr>
                        <td style="width: 100px;">Zona</td>
                        <td><?php echo $result[0]['zona'] ?></td>
                    </tr>
                    <tr>
                        <td>No. Induk</td>
                        <td><?php echo $result[0]['no_induk'] ?></td>
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td><?php echo $result[0]['fullname'] ?></td>
                    </tr>
                    <tr>
                        <td>Fakultas</td>
                        <td><?php echo $result[0]['nama_fakultas'] ?></td>
                    </tr>
                    <tr>
                        <td>Jurusan</td>
                        <td><?php echo $result[0]['nama_jurusan'] ?></td>
                    </tr>
                </tbody>
            </table>
            <div align="right" style="margin: -120px 250px;position: absolute;border: 1px solid #000;border-radius: 10px;">
                <img src="<?php echo base_url(); ?>assets/qrcode/<?php echo $result[0]['no_induk'] ?>.png" alt="" style="border-radius: 10px;border: 1px solid #000;margin: 5px;" class="img-responsive2">
            </div>
        </div>
    </div>
</div>