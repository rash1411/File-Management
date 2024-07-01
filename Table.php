<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body style="margin:50px;">
    <h1>List</h1>
    <br>
    <table class="table">
        <thead>
            <tr>
                <th>S.No</th>
                <th>Subject/title</th>
                <th>Letter No.</th>
                <th>Letter Date</th>
                <th>Letter recieved from</th>
                <th>remarks</th>
                <th>Action</th>
            </tr>
        </thead>



        <!-- // //read all row from database table
            // $sql="SELECT * FROM file_table";
            // $result=$connection->query($sql);

            // if(!result){
            //     die("Invalid query: " .$connection->error);
            // }

            // //read data of each row
            // while($row=$result->fetch_assoc()){
            //     echo <tr>
            //         <td>".$row["sno"]."</td>
            //         <td>".$row["sub"]."</td>
            //         <td>".$row["letter_no"]."</td>
            //         <td>".$row["letter_date"]."</td>
            //         <td>".$row["letter_recieved"]."</td>
            //         <td>".$row["remarks"]."</td>
            //         <td>
            //         <a class='btn btn-primary btn-sm' href="viewpage.php">veiwfile</a>
            //         <a class='btn btn-danger btn-sm' href="index.html">veiwdetails</a>
            //         </td>
            //     </tr>
            // } -->


    </table>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "file_management";

    //create connection
    $connection = new mysqli($servername, $username, $password, $database);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    } else {
        echo "connection";
    }
    ?>
</body>

</html>