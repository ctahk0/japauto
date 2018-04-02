<?php



// if( isset( $_POST['user_name'] ) )

{



	// $name = $_POST['user_name'];
	include_once('conf.php');



	$conn = mysqli_connect($host, $user, $pass, $dbname);

	if (!$conn) {

		die ('Failed to connect to MySQL: ' . mysqli_connect_error());	

	}

	if (!mysqli_set_charset($conn, "utf8")) {
                printf("Error loading character set utf8: %s\n", mysqli_error($conn));
                exit();
    }

	// $sql = "SELECT * FROM tblkarticekupaca WHERE naziv LIKE '%cat%'";

	$sql =	"SELECT updated FROM tblstanje ORDER by updated DESC LIMIT 1";

	$sql1 =	"SELECT updated FROM tblstanjep ORDER by updated DESC LIMIT 1";

			

	$query = mysqli_query($conn, $sql);



	$query1 = mysqli_query($conn, $sql1);



	if (!$query) {

		die ('SQL Error: ' . mysqli_error($conn));

	}

	if (!$query1) {

		die ('SQL Error: ' . mysqli_error($conn));

	}





	while($row = mysqli_fetch_array($query)){

		echo "<p> Stanje Trn: ".$row['updated']."</p>";

	}

	while($row1 = mysqli_fetch_array($query1)){

		echo "<p> Stanje Petricevac: ".$row1['updated']."</p>";

	}

mysqli_close($conn);

}

?>