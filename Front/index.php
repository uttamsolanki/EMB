<?php
	include('../admin/config.php');
?>
<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Welcome to Embroidery Design</title>
        <link rel="stylesheet" href="css/style.css">
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection" />
  		<link href="css/jquery.fancybox.css" type="text/css" rel="stylesheet" media="screen,projection" />
  		<script src="js/jquery-1.11.3.min.js"></script>
  		<script src="js/jquery.fancybox.pack.js"></script>
  		<script src="js/jquery.elevatezoom.js"></script>

  </head>
  <script type="text/javascript">
  $( document ).ready(function() {

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
  	$('select').change(function(){
  		var category = $('select#design_category').val();
  		var type = $('select#design_type').val();
  		var subtype = $('select#design_subtype').val();
  		 $.ajax({
            type: 'POST',
            url:'ajax.php',
            data:  {type:'sorting',design_category:category,design_type:type,design_subtype:subtype },
            success:function(data){
            		if(data)
            		{
            			$( "#ajax_div").empty().html(data);
            		}
            		else
            		{
            			$( "#ajax_div").empty().html('<h1>Record does not exits</hq>')	
            		}
            	}
        	});
  	});

  	$(".zoom_1").elevateZoom({cursor: 'pointer', galleryActiveClass: 'active', imageCrossfade: true});

  });
  </script>
 <body>
 
			<nav class="indigo lighten-1 fix_nav">
				<div class="nav-wrapper">
				  <a href="uploademb.html" class="brand-logo logo_space">Logo</a>
				  <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
				  <ul class="right hide-on-med-and-down">
					<li class="active"><a href="index.html">Home</a></li>
					<li><a href="aboutus.html">About Us</a></li>
					<li><a href="contactus.html">Contact Us</a></li>
				  </ul>
				  <ul class="side-nav" id="mobile-demo">
					<li class="active"><a href="index.html">Home</a></li>
					<li><a href="aboutus.html">About Us</a></li>
					<li><a href="contactus.html">Contact Us</a></li>
				  </ul>
				</div>
			</nav>
			  
			  <div class="container slider_main">
				<div class="slider">
					<ul class="slides">
					  <li>
						<img src="images/one.png"> <!-- random image --><!-- http://lorempixel.com/580/250/nature/1 --> <!-- 1080 X 400 px-->
						<div class="caption center-align">
						  <h3>Slider one</h3>
						  <h5 class="light grey-text text-lighten-3">Ad one</h5>
						</div>
					  </li>
					  <li>
						<img src="images/two.png"> <!-- random image -->
						<div class="caption left-align">
						  <h3>Slider two</h3>
						  <h5 class="light grey-text text-lighten-3">Ad one</h5>
						</div>
					  </li>
					  <li>
						<img src="images/three.jpg"> <!-- random image -->
						<div class="caption right-align">
						  <h3>Slider three</h3>
						  <h5 class="light grey-text text-lighten-3">Ad one</h5>
						</div>
					  </li>
					  <li>
						<img src="images/four.jpg"> <!-- random image -->
						<div class="caption center-align">
						  <h3>Slider Four</h3>
						  <h5 class="light grey-text text-lighten-3">Ad one</h5>
						</div>
					  </li>
					</ul>
				  </div>
			    </div>
				
				<div class="container">
				<div class="divider"></div>
					<h5 class="center_con">All Designs</h5>
					<select class="filters" id="design_category">
						  <option value="">-Select Design Category</option>
						  <option value="">All</option>
						  <option value="Sequence">Sequence</option>
						  <option value="Multi">Multi</option>
						  <option value="Coding">Coding</option>
						  <option value="Chain Work">Chain Work</option>
					</select>
					<select class="filters" id="design_type" >
						  <option value="" selected="selected">-Select Design Type</option>
						  <option value="">All</option>
						  <?php
								$query="select * from tbl_design_type ";
				  				$result=mysql_query($query);
								while ($row=mysql_fetch_array($result))
								{
									echo '<option id='.$row['dt_id'].' value='.$row['design_type_name'].'>'.$row['design_type_name'].'</option>';
								}
						 ?>
					</select>
					<select class="filter_last" id="design_subtype">
						<option value="" selected="selected">-Select Design Subtype</option>
						<option value="" >All</option>
						  <?php
								$query="select * from tbl_design_subtype where dt_id=1";
				  				$result=mysql_query($query);
								while ($row=mysql_fetch_array($result))
								{
									echo '<option id='.$row['dst_id'].' value='.$row['design_subtype_name'].'>'.$row['design_subtype_name'].'</option>';
								}
						 	?>
					</select>
				<div class="divider"></div>
				</div>
  
				  <div class="container">
				  <div class="row" id="ajax_div">
				  <?php
				  	
				  	$query ="select * from tbl_design";
					$result=mysql_query($query);
				  	
					  	while($row=mysql_fetch_array($result))
					  	{
					  		if($row['design_pic'] =='' ) { $img = 'noimg.jpg'; } else { $img = $row['design_pic']; }
							
							if(count($row['design_name']) > 15)	{$designName = substr($row['design_name'],0,15).'..';} else { $designName = $row['design_name']; }

							if($row['design_emb'] != '') { $downLoadImage = "download.php?folder_name=design_emb&filename=".$row['design_emb'];} else { $downLoadImage = "";}

							echo'<div class="card  col s12 m4">
							<div class="card-image waves-effect waves-block waves-light">
							  <img class="zoom_1" src="../admin/design_pic/'.$img.'"  data-zoom-image="../admin/design_pic/'.$img.'"  height="341px" width="341px">
							</div>
							<div class="card-content">
							  <p><i class="material-icons right activator card-title design_info">more_vert</i><a href="'.$downLoadImage.'"><i class="material-icons right small down_design">play_for_work</i></a></p>
							  <span class="grey-text text-darken-4 design_name">'.$designName.'</span><br><span class="stich_space">(Stiches :'.$row['stiches'].')</span>     
							</div>
							<div class="card-reveal reveal_info">
							  <span class="card-title grey-text text-darken-4">'.$row['design_name'].'<i class="material-icons right">close</i></span>
							  <p>
								'.$row['design_desc'].'
							  </p>
							</div>
						  </div>';
						} 
					

					?>

				  </div>
				</div>

	<div class="container center_con">
		<a class="waves-effect waves-light btn indigo">Load More</a>
	</div>
	
	
        <footer class="page-footer indigo lighten-1">
          <div class="container">
            <div class="row">
              <div class="col l6 s12">
                <h5 class="white-text">Embroidery Design</h5>
                <p class="grey-text text-lighten-4">We are providing embroidery design without any cost. Our aim is to reach the texttile industry to the next level.</p>
				<ul>
					<li class="social_icn"><img src="images/fb.png"></li>
					<li class="social_icn"><img src="images/tw.png"></li>
					<li class="social_icn"><img src="images/gp.png"></li>
					<li class="social_icn"><img src="images/in.png"></li>
				</ul>
              </div>
              <div class="col l4 offset-l2 s12">
                <ul>
				  <li><a class="grey-text text-lighten-3" href="index.html">Home</a></li>
                  <li><a class="grey-text text-lighten-3" href="aboutus.html">About Us</a></li>
                  <li><a class="grey-text text-lighten-3" href="contactus.html">Contact Us</a></li>
                  <li><a class="grey-text text-lighten-3" href="#">Privacy & Policy</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="footer-copyright">
            <div class="container">
            © 2015 Copyright Embroidery Design
            <a class="grey-text text-lighten-4 right" href="#">Developed by XYZ</a>
            </div>
          </div>
        </footer>
            
	
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src="js/materialize.js"></script>
    <script src="js/index.js"></script>    
 </body>
</html>
