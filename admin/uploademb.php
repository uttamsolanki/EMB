<?php
include('config.php');
if(isset($_POST['submit']))
{
	$design_name=$_POST['design_name'];
	$stiches=$_POST['stiches'];
	$design_category=$_POST['design_category'];
	$design_type=$_POST['design_type'];
	$design_subtype=$_POST['design_subtype'];
	$design_desc=$_POST['design_desc'];
	//upload png----------------------------------start----------------------------
	$file_pic = rand(1000,100000)."-".$_FILES['design_pic']['name'];
    $file_loc_pic = $_FILES['design_pic']['tmp_name'];
	$folder_pic="design_pic/";  
	$new_file_name_pic = strtolower($file_pic);
	
	$final_file_pic=str_replace(' ','-',$new_file_name_pic);
	
	if(move_uploaded_file($file_loc_pic,$folder_pic.$final_file_pic))
	{
		$design_pic=$final_file_pic;
		 
		//$sql="INSERT INTO tbl_uploads(file,type,size) VALUES('$final_file','$file_type','$new_size')";
		//mysql_query($sql);
	/*?>
		<script>
		alert('successfully uploaded');
        window.location.href='index.php?success';
        </script>
		<?php*/
	}
	else
	{
		/*?>
		<script>
		alert('error while uploading file');
        window.location.href='index.php?fail';
        </script>
		<?php*/
		echo "string";
		exit;
	}
	//upload png-------------------------------------end----------------------------------------------
	
	//upload emb------------------------------------start---------------------------------------------

	
	$file_emb = rand(1000,100000)."-".$_FILES['design_emb']['name'];
    $file_loc_emb = $_FILES['design_emb']['tmp_name'];
	//$file_size_pic = $_FILES['design_pic']['size'];
	//$file_type_pic = $_FILES['design_pic']['type'];
	$folder_emb="design_emb/";  
	$new_file_name_emb = strtolower($file_emb);
	
	$final_file_emb=str_replace(' ','-',$new_file_name_emb);
	
	if(move_uploaded_file($file_loc_emb,$folder_emb.$final_file_emb))
	{
		$design_emb=$final_file_emb;
		
		//$sql="INSERT INTO tbl_uploads(file,type,size) VALUES('$final_file','$file_type','$new_size')";
		//mysql_query($sql);
	/*?>
		<script>
		alert('successfully uploaded');
        window.location.href='index.php?success';
        </script>
		<?php*/
	}
	else
	{
		/*?>
		<script>
		alert('error while uploading file');
        window.location.href='index.php?fail';
        </script>
		<?php*/
	}

	//upload emb------------------------------------end-----------------------------------------------
	$insertQuery="INSERT INTO tbl_design(d_id,design_name,stiches,design_category,design_type,design_subtype,design_desc,design_pic,design_emb,created_at)
	VALUES(NULL,'$design_name','$stiches','$design_category','$design_type','$design_subtype','$design_desc','$design_pic','$design_emb',NOW())";
	$result = mysql_query($insertQuery);
	if($result)
	{
		
		?>
		<script>
        window.location.href='prevadded.php?success';
        </script>
		<?php
	}
}
?>
<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Welcome to Restaurants Hub</title>
        <link rel="stylesheet" href="css/style.css">
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection" />
		<script src="js/jquery-1.11.3.min.js"></script>
  </head>
  <script type="text/javascript">
  $( document ).ready(function() {
    $("#upload").bind("click", function () {
        var Upload_pic = $("#Upload_pic")[0];
        

        var Upload_emb = $("#Upload_emb")[0];
	    var regex1 = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(.jpg|.png|.gif)$");
        if (regex1.test(Upload_pic.value.toLowerCase())) {

                if (typeof (Upload_pic.files) != "undefined") 
                {
	                var reader = new FileReader();
	                reader.readAsDataURL(Upload_pic.files[0]);
	                reader.onload = function (e) {
	                    var image = new Image();
	                    image.src = e.target.result;
	                    image.onload = function () {
	                        var height = this.height;
	                        var width = this.width;
	                        if (height <= 500 && height >= 510) {
	                        	console.log(height);
	                            alert("Height should be between 500 to 510.");
	                            return false;
	                        }
	                        if (width <= 500 && width >= 510) {
	                            console.log(width);
	                            alert("Width should be between 500 to 510.");
	                            return false;
	                        }
	                        
	                        return true;
	                    };
	                }
            	} 
            	else 
            	{
                	alert("This browser does not support HTML5.");
                	return false;
            	}
        } 
        else 
        {
            alert("Please select a valid Image file.");
            return false;
        }
        var regex2 = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(.emb)$");
        if (regex2.test(Upload_emb.value.toLowerCase())) {

            	return true;
        } 
        else 
        {
            alert("Please select a valid EMB file.");
            return false;
        }

    	});

		
	 $("#design_type").change(function(){
		
		var id=$( "select#design_type option:selected").attr('id');
        $.ajax({
            type: 'POST',
            url:'ajax.php',
            data:  {type:'get_subtype',design_type:id },
            success:function(data){
            	$( "select#design_subtype").empty().append(data);
            	}
        	});
    	});

	});
  </script>
 <body>
			  <nav class="indigo">
				<div class="nav-wrapper">
				  <a href="#!" class="brand-logo">Logo</a>
				  <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
				  <ul class="right hide-on-med-and-down">
					<li class="active"><a href="uploademb.php">Upload New Design</a></li>
					<li><a href="prevadded.php">Previous Added</a></li>
					<li><a href="index.html">Logout</a></li>
				  </ul>
				  <ul class="side-nav" id="mobile-demo">
					<li class="active"><a href="uploademb.php">Upload New Design</a></li>
					<li><a href="prevadded.php">Previous Added</a></li>
					<li><a href="index.php">Logout</a></li>
				  </ul>
				</div>
			  </nav>
			  
		<h4 class="upload_but main_upload_form text_color">Upload New Design</h4>
			  
		<div class="container main_upload_form">			
		  <div class="row">
			<form class="col s12" action="uploademb.php" method="post" enctype="multipart/form-data">
			  	<div class="row">
				<div class="input-field col s12">
				  <input id="first_name" type="text" name="design_name" class="validate">
				  <label for="first_name">Design Name</label>
				</div>				
			  </div>
			  <div class="row">
				<div class="input-field col s12">
				  <input id="first_name" type="number" name="stiches" class="validate">
				  <label for="first_name">Number Of Stiches</label>
				</div>				
			  </div>
			  <div class="row drop_space">
			  <p>Select Design Category</p>
				<select class="filters" name="design_category">
						  <option value="All">All</option>
						  <option value="Sequence">Sequence</option>
						  <option value="Multi">Multi</option>
						  <option value="Coding">Coding</option>
						  <option value="Chain Work">Chain Work</option>
				</select>
			  </div>
			  <div class="row drop_space">
			  <p>Select Design Type</p>
				<select class="filters" name="design_type" id="design_type">
						<option value="All">All</option>
			   			<?php
								$query="select * from tbl_design_type ";
				  				$result=mysql_query($query);
								while ($row=mysql_fetch_array($result))
								{
									echo '<option id='.$row['dt_id'].' value='.$row['design_type_name'].'>'.$row['design_type_name'].'</option>';
								}
						 ?>
				</select>
			  </div>
			  <div class="row drop_space">
			  <p>Select Design Subtype</p>
				<select class="filters" name="design_subtype" id="design_subtype">
						  <option value="All">All</option>
						   <?php
								$query="select * from tbl_design_subtype where dt_id=1";
				  				$result=mysql_query($query);
								while ($row=mysql_fetch_array($result))
								{
									echo '<option id='.$row['dst_id'].' value='.$row['design_subtype_name'].'>'.$row['design_subtype_name'].'</option>';
								}
						 	?>
			</select>
			  </div>
			  <div class="row">
					<div class="input-field col s12">
						<textarea id="textarea1" type="textarea" name="design_desc" class="materialize-textarea"></textarea>
						<label for="textarea1">Design Discription</label>
					</div>
			  </div>
			  <div class="row button_back">
				<div class="file-field input-field">
					  <div class="btn amber darken-3">
						<span>Upload JPEG</span>
						<input type="file" name="design_pic" id="Upload_pic">
					  </div>
						<div class="file-path-wrapper">
							<input class="file-path validate" type="text">
						</div>
				</div>				
			  </div>
				<div class="row button_back">
				<div class="file-field input-field">
					  <div class="btn amber darken-3">
						<span>Upload Emb File</span>
						<input type="file" name="design_emb" id="Upload_emb">
					  </div>
					  <div class="file-path-wrapper">
						<input class="file-path validate" type="text">
					  </div>
				</div>
				</div>
			  <div class="row upload_but">
				<button id="upload" class="waves-effect waves-light btn-large amber darken-3" name="submit">Upload Design</button>
			  </div>
			</form>
		  </div>       		
		</div>

	<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src="js/materialize.js"></script>
    <script src="js/index.js"></script>    
 </body>
</html>
