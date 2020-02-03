<?php session_start();
if(!isset($_SESSION["eno"]))
{
	header('Location:adminHome.php');
}?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>feedbackManegement</title>
</head>

<body>
<table>
                <thead><th>Feedback No.</th><th>Type</th><th>Description</th><th>Customer No.</th><th>Status</th></thead>
                <form id="form1" method="post" action="feedbackManegement.php">
                <?php
					$con = mysqli_connect("localhost","root","","bih");
					if(!$con)
					{
						die("Error while connecting to database");	
					}
					$sql="SELECT * FROM `feedback`;";
					$rowSQL= mysqli_query( $con,$sql);
					while($row=mysqli_fetch_assoc( $rowSQL )){
						echo "<tr>
							 <td>
								".$row['fno']."
							 </td>
								<td>
								".$row['type']."
							 </td>
								<td>
								".$row['description']."
							 </td>
								<td>
								".$row['cno']."
								</td>
								<td>
								<select name='status".$row['fno']."' name='status".$row['fno']."'>
									<option value='".$row['status']."'>".$row['status']."</option>
									<option value='Not Attended'>Not Attended</option>
									<option value='Attended'>Attended</option>
								</td>
								<td>
								<input type='submit' id='".$row['fno']."' name='".$row['fno']."' value='Update'>
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
					$sql="SELECT * FROM `feedback`;";
					$rowSQL= mysqli_query( $con,$sql);
					while($row=mysqli_fetch_assoc( $rowSQL )){
						
							if(isset($_POST[$row['fno']])){
								echo $sql;
							$sql2="UPDATE `feedback` SET `status` = '".$_POST['status'.$row['fno']]."' WHERE `feedback`.`fno` = ".$row['fno'].";";
							echo $sql2;
							mysqli_query( $con,$sql2);
							header('Location:feedbackManegement.php');
							}
						}
					mysqli_close($con);
					
					
    ?>
</body>
</html>