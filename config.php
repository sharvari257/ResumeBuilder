<?php
define("DB_SERVER", "localhost");
define("DB_NAME", "resume_db");
define("DB_USERNAME", "root");
define("DB_PASSWORD", "");

# Connection
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

# Check connection
if (!$link) {
  die("Connection failed: " . mysqli_connect_error());
}
