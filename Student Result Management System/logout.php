<?php
  session_start();

  unset($_SESSION["teacherOn"]);
  unset($_SESSION["sessionID"]);

  header("Location: index.php");
?>