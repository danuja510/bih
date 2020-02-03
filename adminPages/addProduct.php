<?php session_start();
if(!isset($_SESSION["eno"]))
{
	header('Location:adminHome.php');
}?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>addProduct</title>

<script type="text/javascript">

function validateProName()
{
	var pname= document.getElementById("txtproname").value;
	if(pname=="")
	{
		alert("Please Enter Product Name");
		return false;
	}
	else
		return true;	
}

function validatePicture()
{
	var pic=document.getElementById("pic").value;
	
	if( pic=="")
	{
		alert("Upload a Picture of the product");
		return false;
	}
	
	else
	{
		var array= pic.split(".");
		var lastVal= array.pop();
		
		if(lastVal !="jpg"||"jpeg"||"png"||"tif"||"gif")
		{
			alert("The picture time is an incorrect format. Please choose a correct format picture");
			return false;
		}
		else
			return true;
	}
}

function validatePStock()
{
	var stock=document.getElementById("txtstock").value;
	if (stock=="")
	{
		alert("Add the stock details");
		return false;
	}
	else
		return true;
}

function validatePrice()
{
	var price=document.getElementById("txtprice").value;
	if(price=="")
	{
		alert("Enter Price");
		return false;
	}
	else
		return true;
}

function validareCategory()
{
	var cat= document.getElementById("listCategory").value;
	if(cat==null)
	{
		alert("Choose the category of the Product");
		return false;
	}
	else
		return true;
}

function validateFranchise()
{
	var fran=document.getElementById("txtfranchise").value;
	if(fran=="")
	{
		alert("Add franchise of the product");
		return false;
	}
	else
		return true;
}

function Validate()
{
	if(validateProName() && validatePicture() && validatePStock() && validatePrice() && validateFranchise())
		alert("Product added");
		
	else
		event.preventDefault();
}


</script>

</head>

<body>
<form action="addProduct.php" id="addProduct" method="post" enctype="multipart/form-data">
<table>
	<tr><td><label for="txtproname">Product Name</label></td><td><input type="text" id="txtproname" name="txtproname"></td></tr>
    <tr><td><label for="pic">Product Picture</label></td><td><input type="file" id="pic" name="pic"></td></tr>
    <tr><td><label for="txtstock">Stocks</label></td><td><input type="number" id="txtstock" name="txtstock"></td></tr>
    <tr><td><label for="txtprice">Price</label></td><td><input type="text" id="txtprice" name="txtprice"></td></tr>
    <tr><td><label for="listCategory">Product Category</label></td><td><select id="listCategory" name="listCategory">
    			<option value="_">__</option>
                <option value="comic">Comic</option>
                <option value="apperel">Apperel</option>
                <option value="action">Action Figures</option>
            </select></td></tr>
     <tr><td><label for="txtfranchise">Franchise</label></td><td><input type="text" id="txtfranchise" name="txtfranchise"></td></tr>
     <tr><td></td><td><input type="submit" id="btnsubmit" name="btnsubmit" value="Next" onclick= "Validate()"><input type="reset" name="btnreset" /></td></tr>
    
</table>
</form>

<?php
	if(isset($_POST["btnsubmit"])){
		$name=$_POST["txtproname"];
		$qty=$_POST["txtstock"];
		$price=$_POST["txtprice"];
		$category=$_POST["listCategory"];
		$fanchize=$_POST["txtfranchise"];
		if(isset($_FILES["pic"])){
		$image="../uploads/".$_FILES["pic"]["name"];
		move_uploaded_file($_FILES["pic"]["tmp_name"],$image);
		$con = mysqli_connect("localhost","root","","bih");
		if(!$con)
		{
			die("Error while connecting to database");	
		}
		$rowSQL = mysqli_query( $con,"SELECT MAX( pnum ) AS max FROM `products`;" );
		$row = mysqli_fetch_array( $rowSQL );
		$max = $row['max'];
		$pno=$max+1;
		$sql ="INSERT INTO `products` (`pnum`, `name`, `franchise`, `available_qty`, `price`, `category`, `image`, `date_added`) VALUES ('".$pno."', '".$name."', '".$fanchize."', '".$qty."', '".$price."', '".$category."', '".$image."', '".date("Y/m/d")."');";
		mysqli_query($con,$sql);
			mysqli_close($con);
			$_SESSION["pno"]= $pno;
			if($_POST["listCategory"]=="comic"){
				header('Location:comic.php');
				}
				elseif($_POST["listCategory"]=="apperel"){
				header('Location:apperel.php');
				}else{
					header('Location:action.php');
					}
		}}
?>

</body>
</html>