<?php
  session_start();
 
  if(isset($_SESSION["teacherOn"])) {
    include "head.php";
?>

    <nav class = "container-fluid bg-dark text-center fs-1 p-5">
      <span class = "text-white p-5">Student Result Management System</span>
    </nav>

    <main class = "container w-50">
      <div class = "alert alert-dark mt-5">
        Hello, you are currently logged in as <?php echo $_SESSION["teacherOn"] ?>!
        <br>
        Current session ID is <?php echo $_SESSION["sessionID"] ?>.
        <br>
        When used up, you can logout from <a href = "logout.php">here</a>.
      </div>
      <div class = "clearfix border-bottom border-dark mt-5 mb-3">
        <h3 class = "float-start">Student Marks In Cellar</h2>
        <a href = "create.php" class = "btn btn-warning float-end">
          <i class = "fa fa-plus"></i>
        </a>
      </div>

      <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
                        
        $conn = mysqli_connect($servername, $username, $password, "student_result_management_system");
                        
        if (!$conn) {
          die("Connection failed: " . mysqli_connect_error());
        } 

        $sql = "SELECT * FROM results";
      
        if($result = mysqli_query($conn, $sql)){
          if(mysqli_num_rows($result) > 0){
            echo '<table class = "table table-bordered table-striped bg-white mt-5">';
            echo "<thead>";
            echo "<tr>";
            echo "<th>Student Name</th>";
            echo "<th>Student Roll</th>";
            echo "<th>Paper One</th>";
            echo "<th>Paper Two</th>";
            echo "<th>Actions</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            
            while($row = mysqli_fetch_array($result)){
              echo "<tr>";
              echo "<td>" . $row['full_name'] . "</td>";
              echo "<td>" . $row['roll_number'] . "</td>";
              echo "<td>" . $row['paper_one'] . "</td>";
              echo "<td>" . $row['paper_two'] . "</td>";
              echo "<td>";
              echo '<a href = "update.php?roll='. $row['roll_number'] .'"><span class = "fa fa-pencil-alt"></span></a>';
              echo '&nbsp; &nbsp;';
              echo '<a href = "delete.php?roll='. $row['roll_number'] .'"><span class = "fa fa-trash"></span></a>';
              echo "</td>";
              echo "</tr>";
            }
            
            echo "</tbody>";                            
            echo "</table>";
          }
        }

        mysqli_close($conn);
      ?>
    </main>

<?php
  } else {
    header("Location: index.php");
  }
?>