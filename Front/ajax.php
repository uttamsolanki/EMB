<?php
include('../admin/config.php');
if(isset($_POST['type']) && $_POST['type']=='get_subtype' )
{
			$id = $_POST['design_type'];
 	 		echo '<option value="" selected="selected">-Select Design Subtype</option>
 	 			  <option value="">All</option>';
		  	$query="select * from tbl_design_subtype where dt_id='$id'";
			$result=mysql_query($query);
			while ($row=mysql_fetch_array($result))
				{
					echo '<option id='.$row['dst_id'].' value='.$row['design_subtype_name'].'>'.$row['design_subtype_name'].'</option>';
				}
}
if(isset($_POST['type']) && $_POST['type']=='sorting' )
{
		
		$d_category = $_POST['design_category'];
		$d_type = $_POST['design_type'];
		$d_subtype = $_POST['design_subtype'];

		if($d_category=='' && $d_type=='' && $d_subtype=='')
		{
				  	$query ="select * from tbl_design";
					$result=mysql_query($query);
				  	while($row=mysql_fetch_array($result))
				  	{
				  		
					echo'<div class="card  col s12 m4">
						<div class="card-image waves-effect waves-block waves-light">
						  <img class="activator" src="../admin/design_pic/'.$row['design_pic'].'" height="341px" width="341px">
						</div>
						<div class="card-content">
						  <p><i class="material-icons right activator card-title design_info">more_vert</i><a href="download.php?folder_name=design_emb&filename='.$row['design_emb'].'"><i class="material-icons right small down_design">play_for_work</i></a></p>
						  <span class="grey-text text-darken-4 design_name">'.$row['design_name'].'</span><br><span class="stich_space">(Stiches :'.$row['stiches'].')</span>     
						</div>
						<div class="card-reveal reveal_info">
						  <span class="card-title grey-text text-darken-4">'.$row['design_name'].'<i class="material-icons right">close</i></span>
						  <p>
							'.$row['design_desc'].'
						  </p>
						</div>
					  </div>';
					}

		}	
		else
		{
			$mqArray = array();
			if($d_category!='')
			{	
				array_push($mqArray, "design_category='".$d_category."'");
			}
			if($d_type!='')
			{
				array_push($mqArray, "design_type='".$d_type."'");	
			}
			if($d_subtype!='')
			{
				array_push($mqArray, "design_subtype='".$d_subtype."'");	
			}
			$condition = implode(' AND ', $mqArray);

					$query ="SELECT * FROM tbl_design WHERE ".$condition;
					$result=mysql_query($query);

					while($row=mysql_fetch_array($result))
				  	{
						
						echo'<div class="card  col s12 m4">
						<div class="card-image waves-effect waves-block waves-light">
						  <img class="activator" src="../admin/design_pic/'.$row['design_pic'].'" height="341px" width="341px">
						</div>
						<div class="card-content">
						  <p><i class="material-icons right activator card-title design_info">more_vert</i><a href="download.php?folder_name=design_emb&filename='.$row['design_emb'].'"><i class="material-icons right small down_design">play_for_work</i></a></p>
						  <span class="grey-text text-darken-4 design_name">'.$row['design_name'].'</span><br><span class="stich_space">(Stiches :'.$row['stiches'].')</span>     
						</div>
						<div class="card-reveal reveal_info">
						  <span class="card-title grey-text text-darken-4">'.$row['design_name'].'<i class="material-icons right">close</i></span>
						  <p>
							'.$row['design_desc'].'
						  </p>
						</div>
					  </div>';
									  		
				  	}
		}

}
?>