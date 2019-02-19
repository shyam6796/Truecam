<?php
$page_id="507";

/*
 * @author Ravi Patel
 */
include("connect.php");
$ctable 	= "user";
$ctable1 	= "User";

$ctable_where = "";
// Get the total number of rows in the table

if(isset($_REQUEST['searchName']) && $_REQUEST['searchName']!=""){
	$ctable_where .= " (
							name like '%".$_REQUEST['searchName']."%' 
							OR phone like '%".$_REQUEST['searchName']."%'
							OR id like '%".$_REQUEST['searchName']."%'
						) AND ";
}

$ctable_where .= " isDelete=0";

$item_per_page =  ($_REQUEST["show"] <> "" && is_numeric($_REQUEST["show"]) ) ? intval($_REQUEST["show"]) : 10;

if(isset($_REQUEST["page"])){
	$page_number = filter_var($_REQUEST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH); //filter number
	if(!is_numeric($page_number)){die('Invalid page number!');} //incase of invalid page number
}else{
	$page_number = 1; //if there's no page number, set it to 1
}

$get_total_rows = $db->rp_getTotalRecord($ctable,$ctable_where); //hold total records in variable
//break records into pages
$total_pages = ceil($get_total_rows/$item_per_page);

//get starting position to fetch the records
$page_position = (($page_number-1) * $item_per_page);

$ctable_r = $db->rp_getData($ctable,"*",$ctable_where,"id DESC limit $page_position, $item_per_page");
?>
<form action="" name="frm" id="frm" method="post">
	<table id="datatable_1" class="table table-striped table-bordered table-hover">
       <thead>
            <tr>
               
					<th>User ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
					<th>Date</th>
                    <th>Action</th>

            </tr>
        </thead>
        <tbody>
        <?php
        if($ctable_r){
            $count = 0;
            
            while($ctable_d = mysql_fetch_array($ctable_r)){
                $count++;
        ?>
            <tr>
                <td><?php echo stripslashes($ctable_d['id']); ?></td>
                <td><span class="<?php echo ($ctable_d['isActive']==0)?"text-danger":"text-success"; ?>"><?php echo stripslashes($ctable_d['name']); ?></span></td>
				<td><?php echo stripslashes($ctable_d['email']); ?></td>
				<td><?php echo stripslashes($ctable_d['phone']); ?></td>
				<td><?php echo date('d-m-Y',strtotime($ctable_d['regDate'])); ?></td>
				<td>
                <?php 									
					if($rights['delete_flag']==1)
					{
						?>
						<a class="btn btn-danger btn-sm" onClick="del_conf('<?php echo $ctable_d['id']; ?>');" title="Delete"><i class="fa fa-times"></i></a>
						<?php
					}
					if($rights['update_flag']==1)
					{
						?>
                                 &nbsp;
                 <div class="btn-group">
                    <button class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> More
                        <i class="fa fa-angle-down"></i>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li>
                            	<?php
							if($ctable_d['isActive']==0){
							?>
								<a  href="<?php echo $ctable; ?>_crud.php?mode=ac&submit=1&id=<?php echo $ctable_d['id']; ?>&status=1" title="Activate"><span class="text-success"><i class="fa fa-circle"></i> &nbsp;Activate</span></a>
							<?php
							}else{
							?>
								<a  href="<?php echo $ctable; ?>_crud.php?mode=ac&submit=1&&id=<?php echo $ctable_d['id']; ?>&status=0" title="Deactivate"><span class="text-danger" ><i class="fa fa-circle-o"></i> &nbsp; Deactivate </span></a>
							<?php
							}
							?>

                            	
                        </li>
						<?php
                        if($rights['view_flag']==1)
                      	{ ?>
                        <li>
                            <a href="#myModal" data-id="<?php echo  stripslashes($ctable_d['id']); ?>" data-toggle="modal" title="View Info"><span class="text-success"><i class="fa fa-circle"></i>&nbsp; Full Info</span></a>

                        </li>
						<?php } ?>
                    </ul>
                </div>

						<?php
					}
				?>
				
				
                </td>
            </tr>
        <?php
            }
        }
        ?>
        </tbody>
    </table>
    <div class="row">
		<div class="col-md-6">
			<div class="dataTables_info"> Rows Limit:
				<select id="numRecords" onChange="changeDisplayRowCount(this.value);">
					<option value="10" <?php if ($_REQUEST["show"] == 10 || $_REQUEST["show"] == "" ) { echo ' selected="selected"'; }  ?> >10</option>
					<option value="20" <?php if ($_REQUEST["show"] == 20) { echo ' selected="selected"'; }  ?> >20</option>
					<option value="30" <?php if ($_REQUEST["show"] == 30) { echo ' selected="selected"'; }  ?> >30</option>
				</select>
			</div>
		</div>
		<div class="col-md-6">
			<div class="dataTables_paginate paging_simple_numbers">
				<ul class="pagination">
				<?php 
				echo $db->rp_paginate_function($item_per_page, $page_number, $get_total_rows, $total_pages); 
				?>
				</ul>
			</div>
		</div>
	</div>
</form>