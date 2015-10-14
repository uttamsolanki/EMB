<?php
include('config.php');
if(isset($_POST['type']) && $_POST['type']=='get_subtype' )
{
			$id = $_POST['design_type'];
 	 		echo '<option value="All">All</option>';
		  	$query="SELECT * FROM tbl_design_subtype where dt_id='$id'";
			$result=mysql_query($query);
			while ($row=mysql_fetch_array($result))
				{
					echo '<option id='.$row['dst_id'].' value='.$row['design_subtype_name'].'>'.$row['design_subtype_name'].'</option>';
				}
}
if(isset($_POST['type']) && $_POST['type']=='delete_record' )
{
		$id = $_POST['deleted_id'];
		$query="DELETE FROM tbl_design WHERE  d_id='$id'";
		$result=mysql_query($query);
}
?>