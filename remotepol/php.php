<?php



$host="db-instancia.cfd4aaj7jp5z.us-east-1.rds.amazonaws.com";
$port=3306;
$socket="";
$user="root";
$password="alejandro123456";
$dbname="db1";


$con = new mysqli($host, $user, $password, $dbname, $port, $socket)
	or die ('Could not connect to the database server' . mysqli_connect_error());




  //$query = "select * from syrus.coordinates Order by id desc limit 1";
  $query = "SELECT * FROM db1.tablaprueba2 ORDER by id DESC LIMIT 1";

   $result = mysqli_query($con,$query);

   $rows = array();

   
   while($r = mysqli_fetch_array($result)) {
     $rows[] = $r;
    

   }
   echo json_encode($rows);

   mysqli_close($con);

  
 ?>
