<?php
  include "head.php";
?>
<body>
    <nav class = "container-fluid bg-dark text-center fs-1 p-5">
        <span class = "text-white p-5">Student Result Management System</span>
    </nav>
    
    <main class = "container w-50">
        <div class = "d-flex row justify-content-center pt-5">            
            <div class = "col-8">
                <div id = "alert"></div>
                <label class = "d-inline-block fs-4 mb-2 pt-4">Teacher Name</label>
                <input type = "name" id = "alias" class = "d-inline-block rounded-3 w-100 p-2 mb-4" required>
                <label class = "d-inline-block fs-4 mb-2">Teacher Password</label>
                <input type = "password" id = "key" class = "d-inline-block rounded-3 w-100 p-2 mb-4" required>
                <label class = "d-inline-block fs-4 mb-2">Confirm Teacher Password</label>
                <input type = "password" id = "confirmKey" class = "d-inline-block rounded-3 w-100 p-2 mb-4" required>
                <button class = "d-inline-block bg-primary rounded-3 w-100 p-2 mb-4" id = "teacherRegister"><i class = "fas fa-cash-register"></i></button>
                <span class = "d-inline-block">
                    Already have an account? 
                    <a href = "index.php">Login rather!</a>
                </span>
            </div>            
        </div>
    </main>

    <script type = "text/javascript">
      const button = document.getElementById("teacherRegister");
      const reference = document.getElementById("alert");
      const name = document.getElementById ("alias");
      const password = document.getElementById ("key");
      const retypedKey = document.getElementById ("confirmKey");

      button.addEventListener("click", function() {
          if(name.value && password.value && retypedKey.value && password.value == retypedKey.value) {
              $.ajax({
                type: "POST",
                url: "auth.php",
                data: "authUser=" + name.value + "&passKey=" + password.value,
                success: function(status) {
                  if(status == "200") {
                      error = "<span class = 'alert alert-danger mx-5 mt-5'>Teacher registered. Try logging in!</span>";
                      reference.innerHTML = error;
                      window.location.href = "index.php";
                  } else if(status == "500") {
                      error = "<span class = 'alert alert-danger mx-5 mt-5'>Duplicate record. Try a new one!</span>";
                      reference.innerHTML = error;
                  } else {
                      error = "<span class = 'alert alert-danger mx-5 mt-5'>Some error while registering you here. Try later!</span>";
                      reference.innerHTML = error;
                  }
                }
              });
          } else {              
              error = "<span class = 'alert alert-danger mx-5 mt-5'>Both passwords must match. Try again!</span>";
              reference.innerHTML = error;
          }
      })
    </script>
</body>
</html>
