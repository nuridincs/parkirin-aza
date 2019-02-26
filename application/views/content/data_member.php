<div class="row">
  <div class="col-md-2">&nbsp;</div>
  <div class="col-md-8">
    <div class="row space-16">&nbsp;</div>
    <div class="row">
      <div class="col-sm-4">
        <div class="thumbnail">
          <div class="caption text-center" onclick="location.href='https://flow.microsoft.com/en-us/connectors/shared_slack/slack/'">
            <div class="position-relative">
              <img src="<?= base_url("assets/img/user.png") ?>" style="width:72px;height:72px;" />
            </div>
            <h4 id="thumbnail-label"><a href="https://flow.microsoft.com/en-us/connectors/shared_slack/slack/" target="_blank"><?= $result[0]['fullname'] ?></a></h4>
            <p><i class="glyphicon glyphicon-user light-red lighter bigger-120"></i>&nbsp;<?= $result[0]['zona'] ?></p>
            <div class="thumbnail-description smaller" align="center">
              <img src="<?= base_url(); ?>assets/qrcode/<?= $result[0]['no_induk'] ?>.png" alt="" class="img-responsive">
            </div>
          </div>
          <div class="caption card-footer text-center">
            <ul class="list-inline">
              <li><i class="people lighter"></i>&nbsp;<span class="badge"><?= $result[0]['status'] ?></span></li>
              <li></li>
              <!-- <li><i class="glyphicon glyphicon-envelope lighter"></i><a href="#">&nbsp;Help</a></li> -->
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-2">&nbsp;</div>
  </div>
</div>