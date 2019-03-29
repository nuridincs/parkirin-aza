<h3>Update Member</h3>
<form id="tambahform" action="<?= base_url("main/execute/edit/member/"); ?><?= $result->id; ?>" method="post">	
    <div class="form-group">
        <input type="hidden" readonly name="update_id" value="<?= $result->id ?>">
        <label>Nim/Nip</label>&nbsp;<span class="error" id="err_no_induk"></span>
        <input type="text" name="update_no_induk" id="update_no_induk" value="<?= $result->no_induk ?>" class="form-control" maxlength="13" required>
    </div>
    <div class="form-group">
        <label>Nama</label>&nbsp;<span class="error" id="report1"></span>
        <input type="text" id="update_fullname" name="update_fullname" value="<?= $result->fullname ?>" class="form-control" maxlength="100" required>
    </div>
    <div class="form-group">
        <label>Fakultas</label>&nbsp;<span class="error" id="fakultas"></span>
        <select name="update_id_fakultas" id="update_id_fakultas" class="form-control">
            <option value="">-Pilih Fakultas-</option>
            <?php
                foreach ($fakultas as $value) {
                    if($value['id'] == $result->id_fakultas){
                        $option = "<option value='".$value['id']."' selected>".$value['nama_fakultas']."</option>";
                    }else {
                        $option = "<option value='".$value['id']."'>".$value['nama_fakultas']."</option>";
                    }
                    echo $option;//"<option value='".$value['id']."'>".$value['nama_fakultas']."</option>";
                }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label>Jurusan</label>&nbsp;<span class="error" id="jurusan"></span>
        <select name="update_id_jurusan" id="update_id_jurusan" class="form-control">
            <option value="">-Pilih Jurusan-</option>
            <?php
                foreach ($jurusan as $value) {
                    if($value['id'] == $result->id_jurusan){
                        $option = "<option value='".$value['id']."' selected>".$value['nama_jurusan']."</option>";
                    }else {
                        $option = "<option value='".$value['id']."'>".$value['nama_jurusan']."</option>";
                    }
                    echo $option;//"<option value='".$value['id']."'>".$value['nama_jurusan']."</option>";
                }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label>No. Kendaraan</label>&nbsp;<span class="error" id="no_kendaraan"></span>
        <input type="text" id="update_no_kendaraan" name="update_no_kendaraan" value="<?= $result->no_kendaraan ?>" class="form-control" maxlength="100" required>
    </div>
    <div class="form-group">
        <label>Zona</label>&nbsp;<span class="error" id="zona"></span>
        <select name="update_id_zona" id="update_id_zona" class="form-control">
            <option value="">-Pilih Zona-</option>
            <?php
                foreach ($zona as $value) {
                    if($value['id'] == $result->id_zona){
                        $option = "<option value='".$value['id']."' selected>".$value['nama_zona']."</option>";
                    }else {
                        $option = "<option value='".$value['id']."'>".$value['nama_zona']."</option>";
                    }
                    echo $option;//"<option value='".$value['id']."'>".$value['nama_zona']."</option>";
                }
            ?>
        </select>
    </div>
    <button type="submit" class="btn btn-primary" style="width:100%;" id="updatemember">Update</button>
</form>
<!-- <div id="a"></div> -->
</div>