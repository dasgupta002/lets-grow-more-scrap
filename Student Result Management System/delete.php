<?php
  $servername = "localhost";
  $username = "root";
  $password = "";
                  
  $conn = mysqli_connect($servername, $username, $password, "student_result_management_system");
                  
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  } 

  $queries = array();
  parse_str($_SERVER['QUERY_STRING'], $queries);
  $key = $queries["roll"];
  $sql = "DELETE FROM results WHERE roll_number = $key";
    
  if(mysqli_query($conn, $sql)) {
    header("Location: dashboard.php");
  }

  mysqli_close($conn);
?>