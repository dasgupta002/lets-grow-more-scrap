<?php
  include "head.php";
?>
<body>
    <nav class = "container-fluid bg-dark text-center fs-1 p-5">
        <span class = "text-white p-5">Student Result Management System</span>
    </nav>
    <main class = "container w-75 mt-5">
        <div class = "row pt-5">            
            <div class = "col-md-4 border-end border-dark">
                <label class = "d-inline-block fs-4 mb-2">Student Roll Number</label>
                <input type = "number" id = "rollKey" class = "d-inline-block rounded-3 w-100 p-2 mb-4" required>
                <button class = "d-inline-block bg-secondary rounded-3 w-100 p-2 mb-4" id = "searchResult"><i class = "fas fa-dice-d6"></i></button>
                <span class = "d-inline-block">
                    Not a student? 
                    <a href = "index.php">Login rather!</a>
                </span>
            </div>            
            <div class = "col-md-8">
                <div id = "alert"></div>
                <div id = "resultPane"></div>
            </div>
        </div>
    </main>

    <script type = "text/javascript">
      const button = document.getElementById("searchResult");
      const roll = document.getElementById("rollKey");
      const reference = document.getElementById("alert");
      const output = document.getElementById("resultPane");

      button.addEventListener("click", function() {
          if(roll.value) {
              $.ajax({
                type: "POST",
                url: "fetch.php",
                data: "studentKey=" + roll.value,
                success: function(response) {
                  let data = JSON.parse(response);

                  if(data.status == "200") {
                      let template = "";
                      reference.innerHTML = "";  

                      template += '<div class = "d-inline-block fs-4 mb-5">End Term Results</div>';
                      template += '<table class = "table table-striped bg-white">';
                      template += '<tbody>';
                      template += '<tr>';
                      template += '<td>Student Full Name</td>';
                      template += '<td>' + data.student + '</td>';
                      template += '</tr>';
                      template += '<tr>';
                      template += '<td>Student Roll Number</td>';
                      template += '<td>' + data.roll + '</td>';
                      template += '</tr>';
                      template += '<tr>';
                      template += '<td>First Paper Score</td>';
                      template += '<td>Second Paper Score</td>';
                      template += '</tr>';
                      template += '<tr>';
                      template += '<td>' + data.paperI + '</td>';
                      template += '<td>' + data.paperII + '</td>';
                      template += '</tr>';
                      template += '</tbody>';
                      template += '</table>';
                      
                      output.innerHTML = template;
                  } else if(data.status == "500") {
                      output.innerHTML = ""; 

                      error = "<span class = 'alert alert-danger mt-5'>Invalid roll number. Try a valid one!</span>";
                      reference.innerHTML = error;
                  } else {
                      output.innerHTML = "";

                      error = "<span class = 'alert alert-danger mt-5'>Some error while querying your result. Try later!</span>";
                      reference.innerHTML = error;
                  }
                }
              });
          }
      })
    </script>
</body>
</html>