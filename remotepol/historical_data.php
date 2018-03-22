
<?php

$host="db-instancia.cfd4aaj7jp5z.us-east-1.rds.amazonaws.com";
$port=3306;
$socket="";
$user="root";
$password="alejandro123456";
$dbname="db1";

$con = new mysqli($host, $user, $password, $dbname, $port, $socket)
	or die ('Could not connect to the database server' . mysqli_connect_error());

    
   // $query = "SELECT * FROM db1.tablaprueba2 where Time1 between '2018-03-20 11:06:53.00' and '2018-03-20 11:09:13.00'";
   $date1 = $_GET['date_1']
   $date2 = $_GET['date_2'];
    echo ($date1);
    echo ($date2);
   $query = "SELECT * FROM db1.tablaprueba2 where Time1 between '2018-03-20 11:06:53.00' and '2018-03-20 18:09:13.00' ";

   $result = mysqli_query($con,$query);

   $rows = array();

      while($r = mysqli_fetch_array($result)) {
     $rows[] = $r;
     }

   echo json_encode($rows);

   mysqli_close($con);

  
 ?>
