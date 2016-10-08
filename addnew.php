<?php
    //avoid notice
	error_reporting( ~E_NOTICE ); 
    // Connection
	require_once 'connection.php';
	//Check
	if(isset($_POST['btnsave']))
	{
        // name
		$name = $_POST['name'];
        // price
		$qty = $_POST['qty'];
        // price
        $price =$_POST['price'];
		//Image
		$imgFile = $_FILES['user_image']['name'];
		$tmp_dir = $_FILES['user_image']['tmp_name'];
		$imgSize = $_FILES['user_image']['size'];
		
		//Check Condition Validation
		if(empty($name))
        {
			$errMSG = "Please Enter Name.";
		}
		else if(empty($qty))
        {
			$errMSG = "Please Enter Qty.";
		}
        else if(empty($price))
        {
            $errMSG = "Please Enter Price";    
        }
		else if(empty($imgFile))
        {
			$errMSG = "Please Select Image File.";
		}
		else
		{
            // upload directory
			$upload_dir = 'user_images/'; 
	        // get image extension
			$imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); 
		    // valid image extensions & valid extensions
			$valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); 
			// rename uploading image
			$picture = rand(1000,1000000).".".$imgExt;
				
			// allow valid image file formats
			if(in_array($imgExt, $valid_extensions))
            {			
				// Check file size '5MB'
				if($imgSize < 5000000)
                {
					move_uploaded_file($tmp_dir,$upload_dir.$picture);
				}
				else
                {
					$errMSG = "Sorry, your file is too large.";
				}
			}
			else
            {
				$errMSG = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";		
			}
		}
		// if no error occured, continue ....
		if(!isset($errMSG))
		{
			/*$stmt = $conn->prepare('INSERT INTO tblproduct(name,qty,price,image) VALUES(:mname, :mqty, :mprice, :mpicture)');
            add by parametter
			$stmt->bindParam(':mname',$name);
			$stmt->bindParam(':mqty',$qty);
			$stmt->bindParam(':mpice',$price);
            $stmt->bindParam(':mpicture',$picture);
			*/
            //SQL
            $sql = "INSERT INTO tblproduct(name,qty,price,image) VALUES('$name',$qty,$price,'$picture')";
            //RESULT SET
            $result = mysqli_query($conn ,$sql);
            
            //Execute
			if($result)
			{
				$successMSG = "new record succesfully inserted ...";
                 // redirects image view page after 5 seconds.
                header("refresh:5;index.php");
			}
			else
			{
				$errMSG = "error while inserting....";
			}
		}
	}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>PHP CRUD With Android</title>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    
</head>
<body>
	<div id="wrap">
	<div id="container" class="container">
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<h2 class="text">PHP CRUD With Android</h2>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<a href="index.php"><button type="button" class="btn btn-default btn-lg">Show</button></a>
			</div>
        </div>
        <?php
            if(isset($errMSG)){
                    ?>
                    <div class="alert alert-danger">
                        <span class="glyphicon glyphicon-info-sign"></span> <strong><?php echo $errMSG; ?></strong>
                    </div>
                    <?php
            }
            else if(isset($successMSG)){
                ?>
                <div class="alert alert-success">
                      <strong><span class="glyphicon glyphicon-info-sign"></span> <?php echo $successMSG; ?></strong>
                </div>
                <?php
            }
        ?>   

    <div class="row">
			<div class="col-md-12 col-sm-12">
                <form method="post" enctype="multipart/form-data" class="form-horizontal">    
            <table class="table table-bordered table-responsive">

            <tr>
                <td><label class="control-label">Name</label></td>
                <td><input class="form-control" type="text" name="name" placeholder="Enter Username" value="<?php echo $name; ?>" /></td>
            </tr>

            <tr>
                <td><label class="control-label">Qty</label></td>
                <td><input class="form-control" type="text" name="qty" placeholder="Your Profession" value="<?php echo $qty; ?>" /></td>
            </tr>

            <tr>
                <td><label class="control-label">Price</label></td>
                <td><input class="form-control" type="text" name="price" placeholder="Your Profession" value="<?php echo $price; ?>" /></td>
            </tr>

            <tr>
                <td><label class="control-label">Image</label></td>
                <td><input class="input-group" type="file" name="user_image" accept="image/*" /></td>
            </tr>

            <tr>
                <td colspan="2">
                    <button type="submit" name="btnsave" class="btn btn-primary btn-md">
                <span class="glyphicon glyphicon-save"></span> &nbsp; save
                </button>
                </td>
            </tr>

            </table>
        </form>      
    </div>
</div>

</div>
</div>

</body>
</html>