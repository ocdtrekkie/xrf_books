<?php
/* Credit to W. S. Toh https://code-boxx.com/simple-drag-and-drop-file-upload/ */
/* MIT License */

require("ismodule.php");
require("modules/$modfolder/functions_lib.php");
require("modules/$modfolder/include_lconfig.php");
$do = $_GET['do'];
if ($do == "upload")
{
	// SOURCE + DESTINATION
	$source = $_FILES["file-upload"]["tmp_name"];
	$destination = "../books/covers/" . $_FILES["file-upload"]["name"];
	$error = "";

	// CHECK IF FILE ALREADY EXIST
	if (file_exists($destination)) {
	  $error = $destination . " already exist.";
	}

	// ALLOWED FILE EXTENSIONS
	if ($error == "") {
	  $allowed = ["png"]; // All covers should be PNGs
	  $ext = strtolower(pathinfo($_FILES["file-upload"]["name"], PATHINFO_EXTENSION));
	  if (!in_array($ext, $allowed)) {
		$error = "$ext file type not allowed - " . $_FILES["file-upload"]["name"];
	  }
	}

	// LEGIT IMAGE FILE CHECK
	if ($error == "") {
	  if (getimagesize($_FILES["file-upload"]["tmp_name"]) == false) {
		$error = $_FILES["file-upload"]["name"] . " is not a valid image file.";
	  }
	}

	// FILE SIZE CHECK
	if ($error == "") {
	  // 1,000,000 = 1MB
	  if ($_FILES["file-upload"]["size"] > 250000) { // 244 KB should be enough
		$error = $_FILES["file-upload"]["name"] . " - file size too big!";
	  }
	}

	// ALL CHECKS OK - MOVE FILE
	if ($error == "") {
	  if (!move_uploaded_file($source, $destination)) {
		$error = "Error moving $source to $destination";
	  }
	}

	// ERROR OCCURED OR OK?
	if ($error == "") {
	  echo $_FILES["file-upload"]["name"] . " upload OK";
	} else {
	  echo $error;
	}
}
else
{
	echo "<style>
      #uploader {
        width: 300px; 
        height: 200px; 
        background: #0f0f0f;
        padding: 10px;
      }
      #uploader.highlight {
        background:#ff0;
      }
      #uploader.disabled {
        background:#aaa;
      }
    </style>
    <script src=\"acp_module_api.php?modfolder=$modfolder&modpanel=uploadcovers.js\"></script>
	
	<!-- DROP ZONE -->
    <div id=\"uploader\">
      Drop Files Here
    </div>

    <!-- STATUS -->
    <div id=\"upstat\"></div>

    <!-- FALLBACK -->
    <form action=\"acp_module_panel.php?modfolder=$modfolder&modpanel=uploadcovers&do=upload\" method=\"post\" enctype=\"multipart/form-data\">
      <input type=\"file\" name=\"file-upload\" id=\"file-upload\" accept=\"image/*\">
      <input type=\"submit\" value=\"Upload File\" name=\"submit\">
    </form>";
}
?>