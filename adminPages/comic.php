<?php session_start();
if(!isset($_SESSION["eno"]))
{
	header('Location:adminHome.php');
}
else if(!isset($_SESSION["pno"]))
{
	header('Location:addProduct.php');
}?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>addProducts-Comics</title>
</head>

<body>
	<form method="post" action="comic.php" id="comic">
    	<table>
        	<tr><td><label for="txtauthor">Author</label></td><td><input type="text" id="txtauthor" name="txtauthor" /></td></tr>
            <tr><td><label for="txtartist">Artist</label></td><td><input type="text" id="txtartist" name="txtartist" /></td></tr>
            <tr><td><label for="rdate">Release Date</label></td><td><input type="date" id="rdate" name="rdate" /></td></tr>
            <tr><td><label for="txtdescription">Description</label></td><td><input type="text" id="txtdescription" name="txtdescription" /></td></tr>
            <tr><td></td><td><input type="submit" id="btnsubmit" name="btnsubmit" /><input type="reset" name="reset" /></td></tr>

        </table>
    </form>
    <?php
    	if(isset($_POST["btnsubmit"])){
			$author=$_POST["txtauthor"];
			$artist=$_POST["txtartist"];
			$rdate=$_POST["rdate"];
			$description=$_POST["txtdescription"];
			$con = mysqli_connect("localhost","root","","bih");
			if(!$con)
			{
				die("Error while connecting to database");	
			}
			$sql="INSERT INTO `comics` (`pnum`, `description`, `artist`, `author`, `release_date`) VALUES ('".$_SESSION["pno"]."', '".$description."', '".$artist."', '".$author."', '".$rdate."');";
			mysqli_query($con,$sql);
			mysqli_close($con);
			header('location:productManegement.php');
			}
	?>
</body>
</html>