<div class="row">
  <div class="col-md-2">&nbsp;</div>
  <div class="col-md-8">
    <!-- <div class="row space-16">&nbsp;</div>
    <div class="row">
      <div class="col-sm-4">
        <div class="thumbnail">
          <div class="caption text-center" onclick="location.href='https://flow.microsoft.com/en-us/connectors/shared_slack/slack/'">
            <div class="position-relative">
              <img src="<?php //echo base_url("assets/img/user.png") ?>" style="width:72px;height:72px;" />
            </div>
            <h4 id="thumbnail-label"><a href="https://flow.microsoft.com/en-us/connectors/shared_slack/slack/" target="_blank"><?php //echo $result[0]['fullname'] ?></a></h4>
            <p><i class="glyphicon glyphicon-user light-red lighter bigger-120"></i>&nbsp;<?php //echo $result[0]['zona'] ?></p>
            <div class="thumbnail-description smaller" align="center">
              <img src="<?php //echo base_url(); ?>assets/qrcode/<?php //echo $result[0]['no_induk'] ?>.png" alt="" class="img-responsive">
            </div>
          </div>
          <div class="caption card-footer text-center">
            <ul class="list-inline">
              <li><i class="people lighter"></i>&nbsp;<span class="badge"><?php //echo $result[0]['status'] ?></span></li>
              <li></li>
            </ul>
          </div>
        </div>
      </div>
    </div> -->
    <?php //print_r($result) ?>
    <div class="col-md-2">&nbsp;</div>
    <div class="wrappet-card">
      <div class="wrapper">
        <div class="col-md-6">
          <div class="row">
            <div class="col-md-6">Zona</div>
            <div class="col-md-3"><?php echo $result[0]['zona'] ?></div>
          </div>
          <div class="row">
            <div class="col-md-6">No. Induk</div>
            <div class="col-md-3"><?php echo $result[0]['no_induk'] ?></div>
          </div>
          <div class="row">
            <div class="col-md-6">Nama</div>
            <div class="col-md-3"><?php echo $result[0]['fullname'] ?></div>
          </div>
          <div class="row">
            <div class="col-md-6">Fakultas</div>
            <div class="col-md-3"><?php echo $result[0]['nama_fakultas'] ?></div>
          </div>
          <div class="row">
            <div class="col-md-6">Jurusan</div>
            <div class="col-md-3"><?php echo $result[0]['nama_jurusan'] ?></div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="row">
            <div class="col-md-3">
              <!-- <div class="thumbnail-description smaller" align="center"> -->
              <div>
                <img src="<?php echo base_url(); ?>assets/qrcode/<?php echo $result[0]['no_induk'] ?>.png" alt="" style="border-radius: 10px;border: 1px solid #000;margin: 5px;" class="img-responsive2">
              </div>
              <!-- </div> -->
            </div>
            <!-- <div class="col-md-4">B 1234 TIT</div> -->
          </div>
        </div>
        <!-- <div class="icon">
          @
        </div>
        <div class="content">
          <h4>Application #1</h4>
          <p>This is an example application's description text.</p>
        </div> -->
      </div>
    </div>
  </div>
</div>