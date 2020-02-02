<?php
  $fileDestination = "./uploads/".basename($_FILES['file']['name']);
  $filetmp = $_FILES['file']['tmp_name'];
  // echo json_encode('asd');
  if(move_uploaded_file($filetmp,$fileDestination))
    echo json_encode(['success'=>true]);
  else
    echo json_encode(['success'=>false, 'msg'=> 'error uploading file']);
    
?>