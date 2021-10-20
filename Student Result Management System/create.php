<?php
  session_start();
 
  if(isset($_SESSION["teacherOn"])) {
    include "head.php";
?>

<body>
    <nav class = "container-fluid bg-dark text-center fs-1 p-5">
        <span class = "text-white p-5">Student Result Management System</span>
    </nav>

    <main class = "container w-50">
      <div class = "row mt-5">
        <div class = "col-12">
          <h2 class = "mt-5 border-bottom border-dark pb-2">Add Student Term Scores</h2>
          <div class = "mt-4" id = "alert"></div>
          <form class = "mt-4" onsubmit = "doCreation(event);">
            <label class = "fs-5 mb-2">Full Name</label>
            <input type = "text" id = "name" class = "d-inline-block rounded-3 w-100 p-2 mb-2">
            <label class = "fs-5 mb-2">First Paper</label>
            <input type = "number" id = "scoreA" class = "d-inline-block rounded-3 w-100 p-2 mb-2">
            <label class = "fs-5 mb-2">Second Paper</label>
            <input type = "number" id = "scoreB" class = "d-inline-block rounded-3 w-100 p-2 mb-4">
            <button type = "submit" class = "btn btn-warning w-100">Save Scores</button>
            <a href = "dashboard.php" class = "btn btn-dark mt-2 mb-2 w-100">Cancel</a>
          </form>
        </div>
      </div>        
    </main>

    <script type = "text/javascript">
      const reference = document.getElementById("alert");
      const student = document.getElementById ("name");
      const paperOne = document.getElementById ("scoreA");
      const paperTwo = document.getElementById ("scoreB");

      function doCreation(event) {
          event.preventDefault();

          if(student.value && paperOne.value && paperTwo.value) {
            $.ajax({
              type: "POST",
              url: "add.php",
              data: "nominiee=" + student.value + "&paperI=" + paperOne.value + "&paperII=" + paperTwo.value,
              success: function(status) {
                if(status == "200") {
                   error = "<span class = 'alert alert-danger mx-5 mt-5'>Grades recorded. Whoosh!</span>";
                   reference.innerHTML = error;

                   window.location.href = "dashboard.php";
                } else if(status == "500") {
                   error = "<span class = 'alert alert-danger mx-5 mt-5'>Duplicate record. Try a fresh one!</span>";
                   reference.innerHTML = error;
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

<?php
  } else {
    header("Location: dashboard.php");
  }
?>