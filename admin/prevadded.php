<?php
	include('config.php');

	$query ="select * from tbl_design";
	$result=mysql_query($query);
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
	$('.point_delete').click(function(){

		var result = confirm("Want to delete?");
		if (result) {
    		var id = $('.point_delete').attr('id');
			$(this).closest('tr').remove();
			$.ajax({
            type: 'POST',
            url:'ajax.php',
            data:  {type:'delete_record',deleted_id:id },
            success:function(data){
            	
            	}
        	});
		}
	});
});
  </script>
 <body>
			  <nav class="indigo">
				<div class="nav-wrapper">
				  <a href="uploademb.php" class="brand-logo">Logo</a>
				  <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
				  <ul class="right hide-on-med-and-down">
					<li><a href="uploademb.php">Upload New Design</a></li>
					<li class="active"><a href="prevadded.php">Previous Added</a></li>
					<li><a href="index.php">Logout</a></li>
				  </ul>
				  <ul class="side-nav" id="mobile-demo">
					<li><a href="uploademb.php">Upload New Design</a></li>
					<li class="active"><a href="prevadded.php">Previous Added</a></li>
					<li><a href="index.php">Logout</a></li>
				  </ul>
				</div>
			  </nav>
			  
		<h4 class="upload_but main_upload_form text_color">Previous Designs List</h4>
			  
		<div class="container main_upload_form">	
		  <table class="centered striped text_color_one responsive-table">
			<thead>
			  <tr>
				  <th data-field="id">Sr. No.</th>
				  <th data-field="name">Design Name</th>
				  <th data-field="">Number of Stiches</th>
				  <th data-field="">Design Catagory</th>
				  <th data-field="">Saree/Dress</th>
				  <th data-field="">Type of Design</th>
				  <th data-field="">JPEGs</th>
				  <th data-field="">Emb Files</th>
				  <th data-field="">Date/Time</th>
				  <th data-field="">Delete</th>
			  </tr>
			</thead>

			<tbody>
			  <tr>
				<td><input placeholder="Sr.No." id="first_name" type="text" class=""></td>
				<td><input placeholder="Design Name" id="first_name" type="text" class=""></td>
				<td><input placeholder="Saree/Dress" id="first_name" type="text" class=""></td>
				<td><input placeholder="Type of Design" id="first_name" type="text" class=""></td>
				<td><input placeholder="JPEGs" id="first_name" type="text" class=""></td>
				<td><input placeholder="Emb Files" id="first_name" type="text" class=""></td>
				<td><input placeholder="Date/Time" id="first_name" type="text" class=""></td>
				<td>-</td>
			  </tr>
			  <?php
			  $i=1;
			  	while($row=mysql_fetch_array($result))
			  	{
			  		echo'<tr>
						<td>'.$i++.'</td>
						<td>'.$row['design_name'].'</td>
						<td>'.$row['stiches'].'</td>
						<td>'.$row['design_category'].'</td>
						<td>'.$row['design_type'].'</td>
						<td>'.$row['design_subtype'].'</td>

						<td><a href="download.php?folder_name=design_pic&filename='.$row['design_pic'].'">'.$row['design_pic'].'</a></td>
						<td><a href="download.php?folder_name=design_emb&filename='.$row['design_emb'].'">'.$row['design_emb'].'</a></td>
						<td>'.$row['created_at'].'</td>
						<td class="point_delete" id='.$row['d_id'].'><i class="material-icons tiny">delete</i></td>
					  </tr>';
					
				}
				$i=0;
			  ?>
			</tbody>
		  </table>
		</div>

	<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src="js/materialize.js"></script>
    <script src="js/index.js"></script>    
 </body>
</html>
