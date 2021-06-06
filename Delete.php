<?php 
include_once 'connection.php';
// sql to delete a record
$id = $_GET['id'];
$sql = "DELETE FROM empdata WHERE id = $id"; 

if (mysqli_query($con, $sql)) {
    mysqli_close($con);
    header('Location: index.php'); 
	echo "Record deleted successfully";
    exit;
} else {
    echo "Error deleting record";
}

?>