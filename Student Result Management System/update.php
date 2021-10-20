<?php
  $queries = array();
  parse_str($_SERVER['QUERY_STRING'], $queries);
  $key = $queries["roll"];

  if(!$key) {
    header("Location: dashboard.php");
  }

  $servername = "localhost";
  $username = "root";
  $password = "";
                  
  $conn = mysqli_connect($servername, $username, $password, "student_result_management_system");
                  
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  } 

  $sql = "SELECT ID, full_name, roll_number, paper_one, paper_two FROM results WHERE roll_number = $key";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        $name = $row["full_name"];
        $roll = $row["roll_number"];
        $paperI = $row["paper_one"];
        $PaperII = $row["paper_two"];
    }
  }    

  mysqli_close($conn);

  include "head.php";
?>

<body>
    <nav class = "container-fluid bg-dark text-center fs-1 p-5">
        <span class = "text-white p-5">Student Result Management System</span>
    </nav>

    <main class = "container w-50">
      <div class = "row mt-5">
        <div class = "col-12">
          <h2 class = "mt-5 border-bottom border-dark pb-2">Update Student Term Scores</h2>
          <div class = "mt-4" id = "alert"></div>
          <form class = "mt-4" onsubmit = "doUpdation(event);">
            <label class = "fs-5 mb-2">Full Name</label>
            <input type = "text" id = "name" value = "<?php echo $name; ?>" class = "d-inline-block rounded-3 w-100 p-2 mb-2">
            <input type = "hidden" id = "rollKey" value = "<?php echo $roll; ?>">
            <label class = "fs-5 mb-2">First Paper</label>
            <input type = "number" id = "scoreA" value = "<?php echo $paperI; ?>" class = "d-inline-block rounded-3 w-100 p-2 mb-2">
            <label class = "fs-5 mb-2">Second Paper</label>
            <input type = "number" id = "scoreB" value = "<?php echo $PaperII; ?>" class = "d-inline-block rounded-3 w-100 p-2 mb-4">
            <button type = "submit" class = "btn btn-warning w-100">Update Scores</button>
            <a href = "dashboard.php" class = "btn btn-dark mt-2 mb-2 w-100">Cancel</a>
          </form>
        </div>
      </div>        
    </main>

    <script type = "text/javascript">
      const reference = document.getElementById("alert");
      const student = document.getElementById ("name");
      const key = document.getElementById("rollKey");
      const paperOne = document.getElementById ("scoreA");
      const paperTwo = document.getElementById ("scoreB");

      function doUpdation(event) {
          event.preventDefault();

          if(student.value && paperOne.value && paperTwo.value) {
            $.ajax({
              type: "POST",
              url: "edit.php",
              data: "nominiee=" + student.value + "&rollPhrase=" + key.value + "&paperI=" + paperOne.value + "&paperII=" + paperTwo.value,
              success: function(status) {
                if(status == "200") {
                   error = "<span class = 'alert alert-danger mx-5 mt-5'>Grades updated. Whoosh!</span>";
                   reference.innerHTML = error;

                   window.location.href = "dashboard.php";
                } else {
                   error = "<span class = 'alert alert-danger mx-5 mt-5'>Some error while submission of grades. Try later!</span>";
                   reference.innerHTML = error;
                }
              }
            });
          }
      }
    </script>
</body>
</html>