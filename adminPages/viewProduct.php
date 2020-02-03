<?php session_start();
if(!isset($_SESSION["eno"]))
{
	header('Location:adminHome.php');
} 
else if(!isset($_SESSION["pnum"]))
{
	header('Location:productManegement.php');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>viewProduct</title>

</head>

<body>
<form action='viewProduct.php' id='viewpro' method='post' enctype="multipart/form-data">
<?php 
	$pnum=$_SESSION['pnum'];
	$con = mysqli_connect("localhost","root","","bih");
	if(!$con)
	{
		die("Error while connecting to database");	
	}
	$sql="SELECT * FROM `products` WHERE `pnum` = ".$pnum.";";
	$rowSQL= mysqli_query( $con,$sql);
	$row = mysqli_fetch_array( $rowSQL );
	echo "
		<table>
			<tr>
				<td><label for='txtname'>Name</label></td><td><input type='text' id='txtname' name='txtname' value='".$row["name"]."'></td>
			</tr>
            <tr>
				<td><label for='listCategory'>Category</label></td><td><select id='listCategory' name='listCategory'>
    			<option value='".$row['category']."'>".$row['category']."</option>
                <option value='comic'>Comic</option>
                <option value='apperel'>Apperel</option>
                <option value='action'>Action Figures</option>
            </select></td>
			</tr>
            <tr>
				<td><label for='txtfranchise'>Franchise</label></td><td><input type='text' id='txtfranchise' name='txtfranchise' value='".$row['franchise']."'></td>
			</tr>
			<tr>
				<td><label for='txtprice'>Price</label></td><td><input type='text' id='txtprice' name='txtprice' value='".$row['price']."'></td>
			</tr>
			<tr>
				<td><label for='txtqty'>Available Stocks</label></td><td><input type='number' id='txtqty' name='txtqty' value='".$row['available_qty']."'></td>
			</tr>
			<tr>
				<td><label for='pic'>Product Picture</label></td><td><input type='file' id='pic' name='pic'></td>
			</tr>";
			
			if($row['category']=='comic'){
				$sql1="SELECT * FROM `comics` WHERE `pnum` = ".$pnum.";";
				$rowSQL1= mysqli_query( $con,$sql1);
				$row1 = mysqli_fetch_array( $rowSQL1 );
				
				echo "<tr>
						<td><label for='txtdescription'>Description</label></td><td><input type='text' id='txtdescription' name='txtdescription' value='".$row1['description']."'></td>
						</tr>
						<tr>
						<td><label for='txtartist'>Artist</label></td><td><input type='text' id='txtartist' name='txtartist' value='".$row1['artist']."'></td>
						</tr>
						<tr>
						<td><label for='txtauthor'>Author</label></td><td><input type='text' id='txtauthor' name='txtauthor' value='".$row1['author']."'></td>
						</tr>
						<tr>
						<td><label for='rdate'>Release Date</label></td><td><input type='date' id='rdate' name='rdate' value='".$row1['release_date']."'></td>
						</tr>
				";
								
				}else if($row['category']=='apperel'){
					$sql1="SELECT * FROM `apperel` WHERE `pnum` = ".$pnum.";";
					$rowSQL1= mysqli_query( $con,$sql1);
					$row1 = mysqli_fetch_array( $rowSQL1 );
					
					echo "<tr>
						<td><label for='txtdescription'>Description</label></td><td><input type='text' id='txtdescription' name='txtdescription' value='".$row1['description']."'></td>
						</tr>
						<tr>
						<td><label for='txtmanu'>Manufacturer</label></td><td><input type='text' id='txtmanu' name='txtmanu' value='".$row1['manufacturer']."'></td>
						</tr>
					";
					
				}else if($row['category']=='action'){
					$sql1="SELECT * FROM `action_figures` WHERE `pnum` = ".$pnum.";";
					$rowSQL1= mysqli_query( $con,$sql1);
					$row1 = mysqli_fetch_array( $rowSQL1 );
					
					echo "<tr>
						<td><label for='txtdescription'>Description</label></td><td><input type='text' id='txtdescription' name='txtdescription' value='".$row1['description']."'></td>
						</tr>
						<tr>
						<td><label for='txtmanu'>Manufacturer</label></td><td><input type='text' id='txtmanu' name='txtmanu' value='".$row1['manufacturer']."'></td>
						</tr>
					";
					
					}
			
				echo "<tr><td></td><td><input type='submit' id='btnsubmit' name='btnsubmit'><input type='submit' name='btndelete' id='btndelete' value='Delete Product'></td></tr>
		</table>";
	mysqli_close($con); 
	?>
</form>

<?php
		if(isset($_POST['btnsubmit'])){
			$name=$_POST['txtname'];
			$category=$_POST['listCategory'];
			$franchise=$_POST['txtfranchise'];
			$price=$_POST['txtprice'];
			$qty=$_POST['txtqty'];
			if(isset($_FILES['pic'])){
				$image="../uploads/".$_FILES['pic']["name"];
				move_uploaded_file($_FILES['pic']["tmp_name"],$image); 
				}
			if($image == "../uploads/"){
				$image=$row['image'];}
				
				$con = mysqli_connect("localhost","root","","bih");
			if(!$con)
			{
				die("Error while connecting to database");	
			}
				
			if($row['category']=='comic'){
				$author=$_POST['txtauthor'];
				$artist=$_POST['txtartist'];
				$rdate=$_POST['rdate'];
				$description=$_POST['txtdescription'];
				$sql21="UPDATE `comics` SET `description` = '".$description."', `artist` = '".$artist."', `author` = '".$author."', `release_date` = '".$rdate."' WHERE `comics`.`pnum` = ".$pnum.";
";
			mysqli_query($con,$sql21);
				
				}else if($row['category']=='apperel'){
					$description=$_POST['txtdescription'];
					$manu=$_POST['txtmanu'];
					$sql21="UPDATE `apperel` SET `description` = '".$description."', `manufacturer` = '".$manu."' WHERE `apperel`.`pnum` = ".$pnum.";";
			mysqli_query($con,$sql21);
					
					}else if($row['category']=='action'){
						$description=$_POST['txtdescription'];
						$manu=$_POST['txtmanu'];
						$sql21="UPDATE `action_figures` SET `description` = '".$description."', `manufacturer` = '$manu' WHERE `action_figures`.`pnum` = ".$pnum.";";
			mysqli_query($con,$sql21);
						
						}
				
				
			$sql2="UPDATE `products` SET `name` = '".$name."', `franchise` = '".$franchise."', `available_qty` = '".$qty."', `price` = '".$price."', `category` = '".$category."', `image`='".$image."' WHERE `products`.`pnum` = ".$pnum.";";
			mysqli_query($con,$sql2);
			mysqli_close($con);
			header('Location:productManegement.php');
		}
		if(isset($_POST['btndelete'])){
			$con = mysqli_connect("localhost","root","","bih");
			if(!$con)
			{
				die("Error while connecting to database");	
			}	
			$sql2="DELETE FROM `products` WHERE `products`.`pnum` =".$pnum.";";
			
			mysqli_query($con,$sql2);
			if($row['category']=='comic'){
				$sql121="DELETE FROM `comics` WHERE `comics`.`pnum` = ".$pnum.";";
				mysqli_query($con,$sql121);
				}else if($row['category']=='apperel'){
					$sql121="DELETE FROM `apperel` WHERE `apperel`.`pnum` = ".$pnum.";";
					
					mysqli_query($con,$sql121);
					}else if($row['category']=='action'){
						$sql121="DELETE FROM `action_figures` WHERE `action_figures`.`pnum` = ".$pnum.";";
						mysqli_query($con,$sql121);
					}
			mysqli_close($con);
			header('Location:productManegement.php');
		}
?>
</body>
</html>