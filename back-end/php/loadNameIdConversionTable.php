<?php
	include("connection.php");

	$conn = new mysqli($serverName, $userName, $password, $dbName);

	// Check connection

	if ($conn->connect_error) echo ("Error - Connection failed: " . $conn->connect_error);
	else {
		$sql = "SELECT tag_number, registry_number FROM users";
		$result = $conn->query($sql);
		if ($conn->error) echo "Error - Server error while consulting database: " . $conn->error;
		else {
			$resultsFound = $result->num_rows;
			if ($resultsFound > 0) {				
				$i = 0;
				echo "[";
				
				while($row = $result->fetch_array()) {
				$i = $i + 1;
				$return["tagNumber"] = $row["tag_number"];
				$return["registryNumber"] = $row["registry_number"];
				echo json_encode($return);
				if ($i != ($resultsFound)) echo ",";
				}
				echo "]";
			}
			else {
				echo "Error - No user found";
			}
		}
	}
	$conn->close();
?>