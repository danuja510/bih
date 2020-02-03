<?php session_start();
if(!isset($_SESSION["eno"]))
{
	header('Location:adminHome.php');
}?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>empManegement</title>
</head>

<body>
	<table>
    <tr>
        <td>
        	<a href="addEmployee.php">Add New Employee</a>
        </td>
        <td>
            <table>
                <thead><th>Employee No.</th><th>Name</th><th>Password</th><th>Type</th></thead>
                <form id="form1" method="post" action="empManenegemt.php">
                <?php
					$con = mysqli_connect("localhost","root","","bih");
					if(!$con)
					{
						die("Error while connecting to database");	
					}
					$sql="SELECT * FROM `employees`;";
					$rowSQL= mysqli_query( $con,$sql);
					while($row=mysqli_fetch_assoc( $rowSQL )){
						echo "<tr>
							 <td>
								".$row['emp_no']."
							 </td>
								<td>
								".$row['name']."
							 </td>
								<td>
								".$row['password']."
							 </td>
								<td>
								".$row['type']."
								</td>
								<td>
								<input type='submit' id='".$row['emp_no']."' name='".$row['emp_no']."' value='Edit'>
								</td>
						  </tr>";
						}
					mysqli_close($con);
                ?>
                </form>
            </table>
        </td>
    </tr>
    </table>
    <?php
					$con = mysqli_connect("localhost","root","","bih");
					if(!$con)
					{
						die("Error while connecting to database");	
					}
					$sql="SELECT * FROM `employees`;";
					$rowSQL= mysqli_query( $con,$sql);
					while($row=mysqli_fetch_assoc( $rowSQL )){
							if(isset($_POST[$row['emp_no']])){
							$_SESSION["empno"]=$row['emp_no'];
							header('Location:viewEmployee.php');
							}
						}
					mysqli_close($con);
					
    ?>
</body>
</html>