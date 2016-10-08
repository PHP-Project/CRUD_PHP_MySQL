<!DOCTYPE html>
<html lang="en">
<head>
	<title>PHP</title>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>	
	<style type="text/css">
		.container #container{
			padding: 200px;
			margin:0 auto;
			border: 0;
			padding: 0;
		}
		.col-md-12{
			margin: 0;
			padding: 0;
			border: 0;
		}
		.row{
			margin: 0 auto;
			padding: 0;
			border: 0;
		}
		#wrap{
			margin: 0 auto;
			padding: 0;
			border: 0;
		}
		h2{
			border-top-left-radius: 12;
			text-align: center;
			text-decoration: underline;
			font-size: 25px;
		}
        button{
            border: 1px;
            
        }
        #message{
            font-size: 15px;
            text-align: center;
            color: red;
        }
	</style>
    <?php
	   include_once("connection.php");
    ?>
    <?php
    
    if (isset($_GET['format']) && $_GET['format'] == "json"){
        $query = "SELECT * FROM tblproduct";
        $result = mysqli_query($conn,$query);
        $myArray = array();
        while($row = $result->fetch_array(MYSQL_ASSOC)){
            $myArray[] = $row;
        }
        echo json_encode($myArray);
        $result->close();
        exit;
    }

    echo "Add <i>?format=json</i> the end of URL ";
    ?>
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
				<a href="addnew.php"><button type="button" class="btn btn-primary btn-md">Add New Product</button></a>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<div class="table-responsive">
                    <p name="message" id="message"></p>
				    <table class="table table-hover">
				        <thead>
                        <tr>
				            <th>ID</th>
							<th>Name</th>
				            <th>Qty</th>
                            <th>Price</th>
                            <th>Image</th>
                            <th>Action</th>   		
				        </tr>
                        </thead>
				        <tbody>
                            <?php
                                $sql= "SELECT * FROM tblproduct";
                                $i = 0;
                                $result = mysqli_query($conn ,$sql);
                                    while (($row = mysqli_fetch_assoc($result))== true){
                                        $data[] = $row;
                                    $i ++;
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $row['name'];?></td>
                                <td><?php echo $row['qty'];?></td>
                                <td><?php echo $row['price'];?></td>
                                <td>
                                    <img src="user_images/<?php echo $row['image'];?>" class="img-rounded" width="200px" height="100px" />
                                </td>
                                <td>
                                    <div class="btn-group btn-group-md">
								        <button type="button" 
                                                class="btn btn-danger" 
                                            href="?delete_id=<?php echo  $row['id']; ?>"
                                                onclick="">
                                            <?php echo  $row['id']; ?>
                                            <span class="glyphicon glyphicon-remove-circle">
                                            </span>Delete
                                        </button>
                                        &nbsp;
								        <button type="button" 
                                                class="btn btn-warning">
                                                Update
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <?php
                                }
                            ?>
				    </tbody>
				</table>
            </div>
        </div>
    </div>
</div>
</div>
    <!--btnAdd-->
    <?php
         /* if(isset($_GET['delete_id']))
	      {
              
            $id = $_GET['delete_id'];
            // select image from db to delete
            $sql = "SELECT  FROM tblproduct WHERE id = $id";
		    //RESULT SET
            $result = mysqli_query($conn ,$sql);
            //Execute
			if($result)
			{
				echo "<script> alert('Delete Seccessfull');</script>";
                 // redirects image view page after 5 seconds.
                header("refresh:5;index.php");
			}
			else
			{
				echo "<script> alert('Delete Unseccessfully');</script>";
			}
		  header("Location: index.php");*/
    ?>

</body>
</html>
