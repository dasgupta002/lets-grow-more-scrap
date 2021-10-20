<?php
  $student = $_POST["nominiee"]; 
  $scoreOne = intval($_POST["paperI"]);
  $scoreTwo = intval($_POST["paperII"]);
  
  $servername = "localhost";
  $username = "root";
  $password = "";
                  
  $conn = mysqli_connect($servername, $username, $password, "student_result_management_system");
                  
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  } 

  $sql = "SELECT ID, full_name, roll_number, paper_one, paper_two FROM results WHERE full_name = '$student'";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        echo "500";
    }
  } else {
    $studentRoll = mt_rand(1111, 9999);
    $sql = "INSERT INTO results (full_name, roll_number, paper_one, paper_two) VALUES ('$student', $studentRoll, $scoreOne, $scoreTwo)";
    
    if (mysqli_query($conn, $sql)) {
        echo "200";
    }
  }

  mysqli_close($conn);
?>