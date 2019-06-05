<?php
$id = $_GET["id"];
$requestedUser = R::findOne("user", "id = ?", [$id]);
$medias = R::find("posts", "from_id = ?", [$id]);
$friendsCount = R::count("relationship", "first_id = ? OR second_id = ?", [$id, $id]);
$data = $_POST;
if (isset($data["do-post"])) {
  if (!empty(trim($data["post"]))) {
    $post = R::dispense("posts");
    $post->from_id = $_SESSION["logged_user"]["id"];
    $post->to_id = 1;
    $post->content = $data["post"];
    $post->pub_date = time();
    R::store($post);
    header("Location: /my?id={$_SESSION["logged_user"]["id"]}");
  }
}

//if ($_SESSION["logged_user"]["id"] !== $id) {
//
//}

if (isset($_GET["fid"]) && isset($id)) {
  if (!empty(trim($_GET["fid"])) && !empty(trim($id))) {
    $relation = R::dispense("relationship");
    $relation->first_id = $id;
    $relation->second_id = $_GET["fid"];
    R::store($relation);
    header("Location: /my?id={$id}");
  }
}
if ($requestedUser === null) : ?>
  <h1>Error 404. User is not found!</h1>;
<?php else : ?>

<div id="my">
  <div class="container">
    <div class="row">
      <?php
      if (isset($_SESSION["logged_user"])) {
        include "components/sidebar.php";
      }
      ?>
      <div id="my_header" class="col <?php if (isset($_SESSION["logged_user"])) { echo "m8"; } ?> s12 z-depth-3">
        <div class="row">
          <div class="col s12 m3" id="photo_container">
            <img src="<?php echo $requestedUser["img"]; ?>" alt="photo" width="150" height="150" class="circle">
          </div>
          <div class="col s12 l6 m5 right" id="info_container">
            <div class="row" id="name_container">
              <h5><?php echo $requestedUser["name"] ?></h5>
            </div>
            <div class="row" id="status_container">
              <h6>Група: <?php echo $requestedUser["status"]; ?></h6>
            </div>
            <div class="row">
              <hr>
            </div>
            <div class="row" id="analytics">
              <div class="col">
                <div class="row"><?php echo $friendsCount; ?></div>
                <div class="row">Друзів</div>
              </div>
              <div class="col">
                <div class="row">1</div>
                <div class="row">Просторів</div>
              </div>
            </div>
            <?php if (isset($_SESSION["logged_user"])) : ?>
            <div class="row" id="operation_container">
              <?php if ($_SESSION["logged_user"]["id"] !== $id) : ?>
              <div class="col">
                <a href="#" class="btn waves-effect send_message">Написати повідомлення</a>
              </div>
              <div class="col">
                <a href="/my?id=<?php echo $id; ?>&fid=<?php echo $_SESSION["logged_user"]["id"]; ?>"
                   class="btn waves-effect add_to_friends"
                   >Додати до друзів</a>
              </div>
              <?php else : ?>
                <div class="col">
                  <a href="#" class="btn waves-effect send_message">Редагувати профіль</a>
                </div>
              <?php endif; ?>
            </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
    <?php if ($_SESSION["logged_user"]["id"] === $id) : ?>
      <div class="row" id="write-post">
        <form action="my?id=<?php echo $id; ?>" method="post">
          <div class="input-field col s12">
            <i class="material-icons prefix">mode_edit</i>
            <textarea class="materialize-textarea" name="post" id="post" cols="30" rows="10" data-length="2000"></textarea>
            <label for="post">Ваш пост</label>
          </div>
          <div id="sendPost" class="input-field right">
            <div class="file-field input-field">
              <div class="btn waves-effect">
                <span>File</span>
                <input type="file">
              </div>
              <div class="file-path-wrapper">
                <input class="file-path validate" type="text">
              </div>
            </div>
            <button class="btn waves-effect" name="do-post">Опублікувати</button>
          </div>
        </form>
      </div>
    <?php endif; ?>
    <div id="feed">
      <div id="media">
        <?php
        if (empty($medias)) : ?>
        <h3 class="center">Поки що постів немає</h3>
        <?php endif; ?>
        <?php for ($i = count($medias); $i >= 1; $i--) : ?>
        <div class="media_object z-depth-3">
          <div class="row media_head">
            <div class="col">
              <?php $user = R::findOne("user", "id = ?", [$medias[$i]["from_id"]]); ?>
              <img src="<?php echo $user["img"]; ?>" alt="logo" width="50" height="50" class="circle">
            </div>
            <div class="col s8 no-padding">
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

<?php endif; ?>