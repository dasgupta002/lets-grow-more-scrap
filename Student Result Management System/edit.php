<?php
  $student = $_POST["nominiee"]; 
  $rollNumber = intval($_POST["rollPhrase"]);
  $scoreOne = intval($_POST["paperI"]);
  $scoreTwo = intval($_POST["paperII"]);
  
  $servername = "localhost";
  $username = "root";
  $password = "";
                  
  $conn = mysqli_connect($servername, $username, $password, "student_result_management_system");
                  
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  } 

  $sql = "UPDATE results SET full_name = '$student', paper_one = $scoreOne, paper_two = $scoreTwo WHERE roll_number = $rollNumber";
 
  if (mysqli_query($conn, $sql)) {
    echo "200";
  }

  mysqli_close($conn);
?>