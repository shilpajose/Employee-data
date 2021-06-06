<!--<?php 
include_once 'connection.php';
$id = $empcode = $empname = $dep = $dob = $age = $joindate = $joiningdate =  "";

	if (isset($_GET['edit'])) {
		$id = $_GET['edit'];
		$update = true;
		$record = mysqli_query($con, "SELECT * FROM empdata WHERE id=$id");

		if (count($record) == 1 ) {
			$n = mysqli_fetch_array($record);
            $id = $n['id'];
			$empcode = $n['empcode'];
			$empname = $n['empname'];
            $dep = $n['dep'];
			$dob = $n['dob'];
            $age = $n['age'];
			$joindate = $n['joindate'];
            $joiningdate = $n['joiningdate'];
			
		}
	}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Updation</title>
</head>
<body>
    <form>

<input type="hidden" name="id" value="<?php echo $id; ?>"><br><br>


<input type="text" name="empcode" value="<?php echo $empcode; ?>"><br><br>
<input type="text" name="empname" value="<?php echo $empname; ?>"><br><br>
<input type="text" name="dep" value="<?php echo $dep; ?>"><br><br>
<input type="date" name="dob" value="<?php echo $dob; ?>"><br><br>
<input type="date" name="age" value="<?php echo $age; ?>"><br><br>
<input type="date" name="joindate" value="<?php echo $joindate; ?>"><br><br>
<input type="date" name="joiningdate" value="<?php echo $joiningdate; ?>"><br><br>
<?php 
if ($update == true): ?>
	<button class="btn" type="submit" name="update" style="background: #556B2F;" >update</button>
<?php else: ?>
	<button class="btn" type="submit" name="save" >Save</button>
<?php endif ?>

</form>
</body>
</html>-->


<?php

include "connection.php"; // Using database connection file here

$id = $_GET['id']; // get id through query string

$qry = mysqli_query($con,"select * from empdata where id='$id'"); // select query

$data = mysqli_fetch_array($qry); // fetch data

if(isset($_POST['update'])) // when click on Update button
{
    
            $id = $_POST['id'];
			$empcode = $_POST['empcode'];
			$empname = $_POST['empname'];
            $dep = $_POST['dep'];
			$dob = $_POST['dob'];
			$joindate = $_POST['joindate'];
            
	
    $edit = mysqli_query($con,"update empdata set empcode ='$empcode', empname='$empname',dep='$dep', dob='$dob',
    joindate='$joindate'  where id='$id'");
	
    if($edit)
    {
        mysqli_close($con); // Close connection
        header("location:index.php"); // redirects to all records page
        exit;
    }
    else
    {
        echo mysqli_error($con);
    }    	
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>updation</title>
    
<!-- Compiled and minified CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

<!-- Compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<link rel="stylesheet" href="styles.css">
<nav>
    <div class="nav-wrapper">
    <h4 class="center">Update Employee details</h4>
    </div>
  </nav>

</head>
<body>
<a href="index.php" class="btn btn-default">HOME</a>

<form class="frmm" method="POST">
<h4>Update Data</h4>
<input type="hidden" name="id" value="<?php echo $id; ?>"><br>
<input type="text" name="empcode" value="<?php echo $data['empcode'] ; ?>"placeholder="Enter empcode" Required><br><br>
<input type="text" name="empname" value="<?php echo $data['empname'] ; ?>"placeholder="Enter empname" Required><br><br>
<input type="text" name="dep" value="<?php echo $data['dep']  ; ?>"placeholder="Enter dep" Required><br><br>
<input type="date" name="dob" value="<?php echo $data['dob']; ?>"placeholder="Enter dob(yyyy-mm-dd)" Required><br><br>
<input type="date" name="joindate" value="<?php echo $data['joindate']; ?>"placeholder="Enter joindate(yyyy-mm-dd)" Required><br><br>

<input type="submit" name="update" class="btn btn-default" value="Update">

<a href="index.php" class="btn btn-default">Cancel</a>
</form>

</body>
</html>

