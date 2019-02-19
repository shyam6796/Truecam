<?php
$page_id=515;$page_slug='page_inquiry';
/*
 * @author Ravi Patel
 */
include("connect.php");
$inquiry_id=$_REQUEST['id'];
$ctable_where	= "id='".$_REQUEST['id']."' AND isDelete=0";
$ctable_r = $db->rp_getData("user","*",$ctable_where,"",0);

?>
<div id="print_info">
<div class="row">
<div class="col-sm-12">
			<h4><b>Personal Detail</b></h4>
			<table id="datatable_1" class="table table-striped table-bordered table-hover">
			<tbody>
			<?php
        if(mysql_num_rows($ctable_r)>0){
            $count = 0;
            
            while($ctable_d = mysql_fetch_array($ctable_r)){
                $count++;
        ?>
            <tr>
			<th>Address</th>
			<td><?php echo  $ctable_d['address']; ?></td>
			</tr>
			<tr>
			<th>Locality</th>
			<td><?php echo  $ctable_d['locality']; ?>
			</tr>
			<tr>
			<th>Pincode</th>
			<td><?php echo  $ctable_d['zip']; ?></td>
			</tr>
			<tr>									
			<th>Country</th>
			<td><?php echo  $db->rp_getValue("country","name","id='".$ctable_d['country']."'",0); ?></td>
			</tr>
			<tr>
			<th>State</th>
			<td><?php echo  $db->rp_getValue("state","name","id='".$ctable_d['state']."'",0); ?></td>
			</tr>
			<tr>
			<th>City</th>
			<td><?php echo  $ctable_d['city']; ?></td>
			</tr>
			<tr>
			<?php
			}
		}
		else
		{
		?>
			<tr>
			<td colspan="6">No data available in table</td>
			</tr>
			<?php
		}
?>
			</tbody>
			</table>
			</div>

			</div>
			
	</div>
			