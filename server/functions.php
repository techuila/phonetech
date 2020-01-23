<?php

    define('DBINFO', 'mysql:dbname=phonetech_db;host=127.0.0.1');
    define('DBUSER','root');
    define('DBPASS','');

    function fetchAll($query){
      $con = new PDO(DBINFO, DBUSER, DBPASS);
      $sth = $con->prepare($query);
      $sth->execute();
      return $sth->fetchAll();
    }

    function performQuery($query){
      $con = new PDO(DBINFO, DBUSER, DBPASS);
      $stmt = $con->prepare($query);
      if($stmt->execute()){
        return true;
      }else{
        return false;
      }
    }
?>