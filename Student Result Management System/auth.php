<?php
  $teacher = $_POST["authUser"]; 
  $phrase = $_POST["passKey"];
  
  $servername = "localhost";
  $username = "root";
  $password = "";
                  
  $conn = mysqli_connect($servername, $username, $password, "student_result_management_system");
                  
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  } 

  $sql = "SELECT ID, full_name, hashed_password FROM teachers WHERE full_name = '$teacher'";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        echo "500";
    }
  } else {
    $encodedPass = password_hash($phrase, PASSWORD_DEFAULT);
    $sql = "INSERT INTO teachers (full_name, hashed_password) VALUES ('$teacher', '$encodedPass')";
    
    if (mysqli_query($conn, $sql)) {
        echo "200";
    }
  }

  mysqli_close($conn);
?>