<?php
  include "head.php";
?>
<body>
    <nav class = "container-fluid bg-dark text-center fs-1 p-5">
        <span class = "text-white p-5">Student Result Management System</span>
    </nav>
    
    <main class = "container w-50">
        <div class = "row pt-5 mt-5">            
            <div class = "col-md-8 border-end border-dark">
                <div id = "alert"></div>
                <label class = "d-inline-block fs-4 mb-2 pt-4">Teacher Name</label>
                <input type = "name" id = "alias" class = "d-inline-block rounded-3 w-100 p-2 mb-4" required>
                <label class = "d-inline-block fs-4 mb-2">Teacher Password</label>
                <input type = "password" id = "key" class = "d-inline-block rounded-3 w-100 p-2 mb-4" required>
                <button class = "d-inline-block bg-primary rounded-3 w-100 p-2 mb-4" id = "teacherLogging"><i class = "fas fa-sign-in-alt"></i></button>
                <span class = "d-inline-block">
                    Does not have an account? 
                    <a href = "register.php">Register here!</a>
                </span>
            </div>            
            <div class = "col-md-4">
                <span class = "d-flex align-items-center justify-content-center bg-warning rounded-3 p-3">
                    <i class = "fas fa-poll fa-2x"></i>
                    <a href = "result.php" class = "mx-3">View Result</a>
                </span>
            </div>
        </div>
    </main>

    <script type = "text/javascript">
      const button = document.getElementById("teacherLogging");
      const reference = document.getElementById("alert");
      const name = document.getElementById ("alias");
      const password = document.getElementById ("key");

      button.addEventListener("click", function() {
          if(name.value && password.value) {
              $.ajax({
                type: "POST",
                url: "login.php",
                data: "authUser=" + name.value + "&passKey=" + password.value,
                success: function(status) {
                  if(status == "200") {
                      window.location.href = "dashboard.php";
                  } else if(status == "500") {
                      error = "<span class = 'alert alert-danger mx-5 mt-5'>Invalid credentials. Try again!</span>";
                      reference.innerHTML = error;
                  } else {
                      error = "<span class = 'alert alert-danger mx-5 mt-5'>Some error while logging you in. Try later!</span>";
                      reference.innerHTML = error;
                  }
                }
              });
          }
      })
    </script>
</body>
</html>