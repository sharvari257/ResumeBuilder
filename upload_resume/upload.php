<?php
require("../config.php");

// Secure file upload handling
$target_dir = "uploads/"; // Directory to store uploaded PDFs
$target_file = $target_dir . basename($_FILES["pdf"]["name"]);
$uploadOk = 1;
$fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Allow only PDF files
if($fileType != "pdf") {
  echo "Error: Only PDF files are allowed.";
  $uploadOk = 0;
}

// If everything is OK, move the file and store details in database
if ($uploadOk == 1) {
  if (move_uploaded_file($_FILES["pdf"]["tmp_name"], $target_file)) {
    $filename = $_FILES["pdf"]["name"];
    $sql = "INSERT INTO pdf_files (filename, filepath) VALUES (?, ?)";
    $stmt = $link->prepare($sql);
    $stmt->bind_param("ss", $filename, $target_file);
    $stmt->execute();
    echo "PDF uploaded successfully.";
  } else {
    echo "Error uploading PDF.";
  }
}

// Fetch list of uploaded PDFs from database
$sql = "SELECT id, filename FROM pdf_files";
$result = $link->query($sql);

if ($result->num_rows > 0) {
  echo "<h2>Uploaded PDFs:</h2>";
  echo "<ul id='pdf-list'>";
  while($row = $result->fetch_assoc()) {
    echo "<li><a href='#' onclick='displayPDF(" . $row['id'] . ")'>" . $row['filename'] . "</a></li>";
  }
  echo "</ul>";
} else {
  echo "No PDFs uploaded yet.";
}

$link->close();
?>