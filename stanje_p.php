<?php



// if( isset( $_POST['user_name'] ) )

{



	// $name = $_POST['user_name'];

	require('conf.php');



	$conn = mysqli_connect($host, $user, $pass, $dbname);

	if (!$conn) {

		die ('Failed to connect to MySQL: ' . mysqli_connect_error());	

	}



	// $sql = "SELECT * FROM tblkarticekupaca WHERE naziv LIKE '%cat%'";

$sql =	"SELECT sifra, naziv, jm, kolicinatrn, sum(kolp) as kolicinapetricevac, mpc, ppc from (

				SELECT `sifra`, `naziv`, `jm`, `kolicinatrn`, 0 as kolp, `mpc`, `ppc` FROM `tblstanje`

				UNION all

				SELECT `sifra`, `naziv`, `jm`, '0' as t, `kolicinapetricevac`,  `mpc`, `ppc` FROM `tblstanjep`

		) as x group by sifra";



			

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