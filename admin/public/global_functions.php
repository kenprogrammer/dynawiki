<?php
	function clean_input($db,$data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  $data = $db->real_escape_string($data);
	  return $data;
	}
?>