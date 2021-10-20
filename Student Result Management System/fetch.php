<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
                  
    $conn = mysqli_connect($servername, $username, $password, "student_result_management_system");
                  
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    } 

    $rollNumber = intval($_POST["studentKey"]);

    $sql = "SELECT ID, full_name, roll_number, paper_one, paper_two FROM results WHERE roll_number = $rollNumber";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $response["status"] = "200";
            $response["student"] = $row["full_name"];
            $response["roll"] = $row["roll_number"];
            $response["paperI"] = $row["paper_one"];
            $response["paperII"] = $row["paper_two"];
            $data = json_encode($response);

            echo $data;
        }
    } else {
        $response["status"] = "500";
        $data = json_encode($response);

        echo $data;
    }

    mysqli_close($conn);  
?>