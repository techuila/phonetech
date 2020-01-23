<!DOCTYPE html>
<html>
<head>
  <style>
    .error{
      font-size: 20px;
      font-family: "Barlow";
      color: #001b48
    }
    .errorreg{
      color: red;
      text-align: center;
    }
  </style>
</head>

<body>

<?php  if (count($errors) > 0) : ?>
  <div class="errorreg">
    <?php foreach ($errors as $error) : ?>
      <strong><?php echo $error ?></strong>
    <?php endforeach ?>
  </div>
<?php  endif ?>

</body>
</html>