<?php
if (!isset($_SESSION["logged_user"])) {
  header("Location: /");
}
$medias = R::find("posts", "to_id = ?", [$_SESSION["logged_user"]["id"]]);
?>

<div id="dashboard">
  <div class="container">
    <div class="row">
      <?php include "components/sidebar.php"; ?>
      <div class="col m8 s12">
        <div id="media">
          <?php for ($i = count($medias); $i >= 1; $i--) : ?>
          <div class="media_object z-depth-3">
            <div class="row media_head">
              <div class="col">
                <img src="resources/img/main.jpg" alt="logo" width="50" height="50" class="circle">
              </div>
              <div class="col s8 no-padding">
                <?php $user = R::findOne("user", "id = ?", [$medias[$i]["from_id"]]); ?>
                <p><?php echo $user["username"]; ?></p>
              </div>
            </div>
            <div class="row media_text">
              <div class="col s10">
                <p style="margin-left: 20px;"><?php echo $medias[$i]["content"]; ?></p>
              </div>
            </div>
            <div class="row" style="margin-bottom: 0; margin-right: 10px;">
              <small class="right">Опубліковано: <?php echo gmdate("Y-m-d\ H:i:s", $medias[$i]["pub_date"]);; ?></small>
            </div>
          </div>
          <?php endfor; ?>
        </div>
      </div>
    </div>
  </div>
</div>