<h1>Notifications</h1>

<?php

include '../../server/functions.php';

$id = $_GET['id'];

$query = "UPDATE `problem_tb` SET `status` = 'read' WHERE `id` = $id;";
performQuery($query);

$query = "SELECT * from `problem_tb` where `id` = '$id';";
if (count(fetchAll($query)) > 0) {
  foreach (fetchAll($query) as $i) {
    if ($i['name'] == 'name') {
      echo ucfirst($i['name']) . " liked your post. <br/>" . $i['currentdate'];
    } else {
      echo "Some commented on your post.<br/>";
    }
  }
}

?><br />

<a href="./technician/technicianhomepage.php">Back</a>