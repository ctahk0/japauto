<?php

if( isset( $_POST['kupac'] ) )
{

	$name = $_POST['kupac'];

	$host = '138.201.205.168';
	$user = 'clockwel_japauto';
	$pass = 'k4k0d4n3';
	$dbname = 'clockwel_japauto';

	$conn = mysqli_connect($host, $user, $pass, $dbname);
	if (!$conn) {
		die ('Failed to connect to MySQL: ' . mysqli_connect_error());	
	}

	// SELECT *, @curRank := @curRank + saldo AS lsaldo 
	// FROM tblkarticekupaca p, 
	// (SELECT @curRank := 0) r 
	// where naziv LIKE '%cat%' ORDER BY datum, karticeid
	$sql = "SELECT *, @ts := @ts + saldo AS lsaldo
			FROM tblkarticekupaca  p,
			(SELECT @ts := 0) r
			WHERE naziv = '$name' 
			ORDER BY datum, karticeid";
	
	//echo $sql;

	$query = mysqli_query($conn, $sql);

	if (!$query) {
		die ('SQL Error: ' . mysqli_error($conn));
	}

	$rows = array();
	while($r = mysqli_fetch_assoc($query)) {
	    $rows[] = $r;
	}
	print json_encode($rows);
	// while($row = mysqli_fetch_array($query)){
	// 	echo "<p>".$row['naziv']."</p>";
	//  	echo "<p>".$row['jib']."</p>";
	// }
mysqli_close($conn);
}
?>