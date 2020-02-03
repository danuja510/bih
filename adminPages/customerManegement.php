<?php session_start();
if(!isset($_SESSION["eno"]))
{
	header('Location:adminHome.php');
}?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>customerManegement</title>
</head>

<body>
<table>
                <thead><th>Customer No.</th><th>Name</th><th>Password</th><th>E-mail</th></thead>
                <form id="form1" method="post" action="customerManegement.php">
                <?php
					$con = mysqli_connect("localhost","root","","bih");
					if(!$con)
					{
						die("Error while connecting to database");	
					}
					$sql="SELECT * FROM `customers`;";
					$rowSQL= mysqli_query( $con,$sql);
					while($row=mysqli_fetch_assoc( $rowSQL )){
						echo "<tr>
							 <td>
								".$row['cno']."
							 </td>
								<td>
								".$row['name']."
							 </td>
								<td>
								".$row['password']."
							 </td>
								<td>
								".$row['email']."
								</td>
								<td>
								<input type='submit' id='".$row['cno']."' name='".$row['cno']."' value='View'>
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
					$sql="SELECT * FROM `customers`;";
					$rowSQL= mysqli_query( $con,$sql);
					while($row=mysqli_fetch_assoc( $rowSQL )){
							if(isset($_POST[$row['cno']])){
							$_SESSION["cno"]=$row['cno'];
							header('Location:viewCustomer.php');
							}
						}
					mysqli_close($con);
					
    ?>
</body>
</html>