<?php      
    $host = "localhost";  
    $user = "root";  
    $password = '';  
    $db_name = "php";  
      
    $con = mysqli_connect("localhost","shilpa","php123shilpa","Employee");  
    if(mysqli_connect_errno()) {  
        die("Failed to connect with MySQL: ". mysqli_connect_error());  
    }  
?>  