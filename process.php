<?php
include 'db.php';

if (isset($_POST['tea'])) {
	$team = mysqli_real_escape_string($conn, $_POST['team']);
	if (empty($team)) {
		echo 9;
		exit();
	}
	$checkk = mysqli_query($conn, "SELECT * FROM teams WHERE team = '$team'");
	$check = mysqli_num_rows($checkk);
	
	if ($check > 0) {
		echo 0;
		exit();
	} else {
		echo 1;
		exit();
	}
}

if (isset($_POST['teamm'])) {
	$team = mysqli_real_escape_string($conn, $_POST['team']);
	$url = mysqli_real_escape_string($conn, $_POST['url']);

	$assign = mysqli_query($conn, "INSERT INTO teams (team, url, count) VALUES ('$team', '$url', 0)");
		if ($assign) {
			echo 1;
			exit();
		} else {
			echo 0;
	}
}

if (isset($_POST['first'])) {
	$username = mysqli_real_escape_string($conn, $_POST['username']);
	if (empty($username)) {
			echo 9;
			exit();
		}
	$checkk = mysqli_query($conn, "SELECT * FROM joined WHERE username = '$username'");
	$check = mysqli_num_rows($checkk);
	
	if ($check > 0) {
		echo 0;
		exit();
	} else {
		echo 1;
		exit();
	}
}

if (isset($_POST['second'])) {
	$username = mysqli_real_escape_string($conn, $_POST['username']);
	$team_count = mysqli_query($conn, "SELECT * FROM teams WHERE count < 20 ORDER BY RAND() LIMIT 1");
	
	$ch = mysqli_num_rows($team_count);
	if ($ch < 1) {
		echo 3;
		exit();
	}
	$rows = array();
	while ($team = mysqli_fetch_array($team_count)) {
		$user_team = $team['team'];
		$rows[] = $team['team'];
		$rows[] = $team['url'];
	}
	$update_count = mysqli_query($conn, "UPDATE teams SET count = count + 1 where team = '$user_team'");

	if ($update_count) {
		$assign = mysqli_query($conn, "INSERT INTO joined (team, username) VALUES ('$user_team', '$username')");
		if ($assign) {
			echo json_encode($rows);
			exit();
		}
	} else {
		echo 0;
	}
}

if (isset($_POST['drop'])) {
	$result = mysqli_query($conn, "SELECT * FROM teams ORDER BY team ASC");
	 
	$r = '<option value="all">Export All...</option>';
	while($row = mysqli_fetch_array($result))
	  {
	 $r .= '<option value="'.$row['team'].'">' . $row['team'] . "</option>";
	    //echo $row['drink_type'] ."<br/>";
  }
  echo $r;
}
?>