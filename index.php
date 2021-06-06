<?php 
include_once 'connection.php';

$message ='';
if(isset($_POST["upload"]))
{
    if($_FILES['empdatafile']['name'])
    {
       $filename = explode(".",$_FILES['empdatafile']['name']);
       if(end($filename) == "csv")
       {
          $handle = fopen($_FILES['empdatafile']['tmp_name'],"r");
          while($data = fgetcsv($handle))
          {
              $empcode = mysqli_real_escape_string($con,$data[0]);
              $empname = mysqli_real_escape_string($con,$data[1]);
              $dep = mysqli_real_escape_string($con,$data[2]);
              $dob = mysqli_real_escape_string($con,$data[3]);
              $joindate  = mysqli_real_escape_string($con,$data[4]);

             /* $query ="UPDATE Employeedata SET 
              empname = '$empname',
              dep = '$dep',
              age ='$age',
              experience  = '$experience ' WHERE empcode = '$empcode'";
              mysqli_query($con,$query);*/
#---------------------------------------------------
/*$query ="INSERT INTO employeedata SET 
              empcode = '$empcode',
              empname = '$empname',
              dep = '$dep',
              age ='$age',
              experience  = '$experience'";
              mysqli_query($con,$query);*/

              $query = "INSERT INTO `empdata`(`empname`, `empcode`, `dep`, `dob`, `joindate`)
              VALUES ('$empname','$empcode','$dep','$dob','$joindate')";
              mysqli_query($con,$query);


#--------------------------------------------------

          }
          fclose($handle);
          #header("location:index.php? updation=1");
          header("location:index.php? ");
       }
       else
       {
        $message ='<label class="text-danger">* Please Select a validfile</label>';
        
       }
    }
    /*else
    {
        $message ='<label class="text-danger">plz Select File</label>';
    }*/
}

/*if(isset($_GET["updation"]))
{
    $message ='<label class="text-danger">Product Updation Done</label>';
}*/
//Calculating the age from date of birth and experience from joining date........
$today = date("y-m-d");
$query = "SELECT `id`, `empname`, `empcode`, `dep`,`dob`, DATEDIFF('$today',`dob`) as age,`joindate`,
 DATEDIFF('$today',`joindate`) as joiningdate FROM empdata";

$result = mysqli_query($con,$query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload csv</title>

<!-- Compiled and minified CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

<!-- Compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
        
<style>
h3,th{
    color:#099c97;
}
label{
    color:red;
}
</style>
</head>

<body>
<nav>
    <div class="nav-wrapper">
      <a href="#" class="brand-logo">Employee Data</a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <li><a href="Addnew.php">Addnew</a></li>

      </ul>
    </div>
  </nav>
  
    <div class="container">
    <!--<h3 allign="center">Employee Data</h3>-->
    <br>
    <form method="post" enctype="multipart/form-data">
    <p>
    <label> Select File(CSV Files only supported)</label>
    </p>
    <input type="file" name="empdatafile"placeholder="Field is empty" Required><br><br>
    <input type="submit" name="upload" class="btn btn-info" value="upload"/>
    </form><br><br>
    
    <br>
    <?php echo $message;?>
    <div class="responsive">
    <table class="table table-bordered table-striped table-hover">
    <tr>
    
    <th>Employee Code</th>
    <th>Employee Name</th>
    <th>Department</th>
    <th>DOB</th>
    <th>Age</th>
    <th>Joining Date</th>
    <th>Experience in the<br> Organization(months)</th>
    <th>Actions</th>
    <th>Actions</th>
    </tr>
    <?php 
     while($row=mysqli_fetch_array($result))
     {
        $age = 0;
        $age = $row["age"];
        $age = FLOOR($age/365);

        $joiningdate = 0;
        $joiningdate = $row ["joiningdate"];
        $joiningdate = FLOOR($joiningdate/30.4);

        /* echo'
         <tr>
         
         <td>'.$row["empcode"].'</td>
         <td>'.$row["empname"].'</td>
         <td>'.$row["dep"].'</td>
         <td>'.$row["dob"].'</td>
         <td>'.$age.'</td>
         <td>'.$row["joindate"].'</td>
         <td>'.$joiningdate.'</td>
         <td><a href="Edit.php">Edit</a></td>
         <td><a href="Delete.php">Delete</a></td>
         </tr>
         ';*/
         echo "<tr>";
         echo "<td>".$row['empcode']."</td>";
         echo "<td>".$row['empname']."</td>";
         echo "<td>".$row['dep']."</td>";
         echo "<td>".$row['dob']."</td>";
         echo "<td>".$age."</td>";
         echo "<td>".$row['joindate']."</td>";
         echo "<td>".$joiningdate."</td>";
         echo "<td>";
         echo "<div class='btn-group'>";
         echo "<a type ='button' class='btn btn-primary' href='Edit.php?id=".$row['id']."'>Edit</a>";
         echo "</div>";
         echo "</td>";
         echo "<td>";
         echo "<div class='btn-group'>";
         echo "<a type ='button' class='btn btn-danger' href='Delete.php?id=".$row['id']."' >Delete</a>";
         echo "</div>";
         echo "</td>";
        
         echo "</tr>";
     }
     

    ?>
    
    </table>
    </div>
    </div>
    <!--<?php
    $dob='';

    $diff = (date('Y') - date('Y',strtotime($dob)));
    echo $diff;
?>-->
</body>
</html>
