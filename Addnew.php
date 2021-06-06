<?php
include_once 'connection.php';


if(isset($_POST['submit']))
{
#--------------------------

#--------------------------



    $id=$_POST['id'];
    $empname=$_POST['empname'];
    $empcode=$_POST['empcode'];
    $dep=$_POST['dep'];
    $dob=$_POST['dob'];
    $joindate=$_POST['joindate'];
    #------------------------------

    $validatedate = 0;
    $date = $_POST['dob'];
    $tempDate = explode('-', $date);
    #echo $tempDate[0];
    #echo $tempDate[1];
    #echo $tempDate[2];
    $validatedate = checkdate($tempDate[1], $tempDate[2], $tempDate[0]);
    #echo $validatedate;
    
    if($validatedate == 1)
    {
       # echo 'alert("New record added succesfully")';
       #echo '<script>alert("Valid date")</script>';


    #-----------------------------
    
    
    $sql = "INSERT INTO `empdata`( `empname`, `empcode`,`dep`,`dob`,`joindate`)
            VALUES ('$empname','$empcode','$dep','$dob','$joindate')";
    $result = $con->query($sql);
}
 
    if($result == TRUE)
    {
        #echo "New record added succesfully.";
        echo '<script language="javascript">';
        echo 'alert("New record added succesfully")';
        echo '</script>';
    }
    else
    {
        echo "error:" .$sql ."<br>" . $con->error; 
    }
    header("location:index.php? ");
#$con->close();

}

?>

<!DOCTYPE html>
<html>
<head>
	 <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
         
<link rel="stylesheet" href="styles.css">	

</head>
<body>
<nav>
    <div class="nav-wrapper">
    <h4 class="center">Add Employee details</h4>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <li><a href="index.php">HOME</a></li>
          
      </ul>
    </div>
  </nav>
<section class="container grey-text">
	
	<a  href="index.php" class="btn btn-default">HOME</a>
    <form class="frmm" action="" method="POST">
    
    

    <input type="text" name="empname" placeholder="Name" Required>
    
    <input type="text" name="empcode" placeholder="Employee Code" Required><br><br>
    
    <input type="text" name="dep" placeholder="Department" Required>
    
    <input type="date" name="dob" placeholder="D-O-B(yyyy-mm-dd)" Required><br><br>
    
    <input type="date" name="joindate" placeholder="joining date(yyyy-mm-dd)" Required><br><br>

<input class="btn" type="submit" name="submit" value="submit">

<a href="index.php" class="btn btn-default">Cancel</a>

 </form>
 </section>
 
  
  </body>
  </html>