<?php
  session_start();

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
        if(password_verify($phrase, $row["hashed_password"])) {
            $_SESSION["teacherOn"] = $row["full_name"];
            $_SESSION["sessionID"] = mt_rand(67, 9999);

            echo "200";
        } else {
            echo "500";
        }
    }
  }    

  mysqli_close($conn);
?>