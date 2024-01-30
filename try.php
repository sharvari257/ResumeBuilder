<?php
session_start();
?>
<?= htmlspecialchars($_SESSION["username"]); ?>