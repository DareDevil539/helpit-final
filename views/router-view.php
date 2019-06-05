<!doctype html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="<?php echo $materializeCss ?>">
  <link rel="stylesheet" href="<?php echo $materializeIcons ?>">
  <link rel="stylesheet" href="<?php echo $style ?>">
  <link rel="icon" href="<?php echo $favicon ?>">
  <link rel="stylesheet" href="<?php echo $comfortaa ?>">
  <title><?php echo $title ?></title>
</head>
<body>
<?php include $header ?>
<div id="content">
  <?php include $content ?>
</div>
<?php include $footer ?>

<script src="<?php echo $jquery ?>"></script>
<script src="<?php echo $materializeJs ?>"></script>
<script src="<?php echo $parallax ?>"></script>
<script>
  $(document).ready(function() {
    $('textarea#post').characterCounter();
  });
</script>

</body>
</html>