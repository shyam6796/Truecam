<?php
require_once('connect.php');
$api_r = $db->rp_getData("api_table","*","1=1");
?>

<html>
<head>

<style type="text/css">
.mainDiv, table{
    height: auto;
    width:190mm;
	font-family: Calibri,sans-serif;
    font-style: normal;
    font-weight: 400;
    padding: 0;
    text-decoration: none;
	font-size: 8pt;
	margin:auto;
	padding:auto;
}
table , td, th {
	border: 1px solid #595959;
	border-collapse: collapse;
}

    }
.bolder
{
	font-weight: 700 !important;
}
.center
{
	text-align:center;

}
.font8{	font-size: 8pt !important;}
.righter
{
	text-align:right;

}
td, th {
	padding: 3px;
	height:23px;
	text-align:left;
	vertical-align:middle;
	color: black;
    font-family: Calibri,sans-serif;
    font-style: normal;
    font-weight: 400;
    text-decoration: none;
	font-size: 8pt;
	
}
th {
	//background: #f0e6cc;
}
.title {
	//background: #f0f0f0;
}
.odd {
	//background: #fefcf9;
}
input{
	height:auto;
	width:100%;
	margin:0px !import.
	
	
}
.header_logo
{
	background-image: url("lakhmi.jpg");
    background-position: center center;
    background-repeat: no-repeat;
    background-size: contain;
    height: 161px;
    width: 190mm;
}
 
</style>
<script>
document.find('td').contentEditable = true;
</script>
</head>

<body>
<div class="mainDiv">



<table style="overflow: wrap" >
	<tbody style="padding:10px;">
	    <colgroup width="75"/>
		    <colgroup width="75"/>
			    <colgroup width="75"/>
				    <colgroup width="75"/>
					    <colgroup width="75"/>
						    <colgroup width="75"/>
							    <colgroup width="75"   />
								    <colgroup width="75"   />
									    <colgroup width="75"   />
										    
									   
											   			
	
	
	
	
	
	
		<tr>
			<td colspan="9">
			<h1>&nbsp;<?php echo  SITETITLE." Web APIs";?></h1>
			</td>
		</tr>
		<tr>
			<td colspan="9">
			</td>
		
		</tr>
		<?php

			$count=1;
			while($api=mysql_fetch_array($api_r)){
			
			?>
			<tr>
			<td colspan="9">
			<h3><?php echo $count;?>.<?php echo $api['api_title']?></h3>
			</td>
		
		</tr>
		<tr>
			<td colspan="1"><b>API Code</b>		
				
			</td>
			<td colspan="3"><?php echo $api['id']?></td>
			<td colspan="1"><b>API Slug</b>		
				
			</td>
			<td colspan="4"><?php echo $api['api_slug']?></td>
		</tr>
		<tr>
			<td colspan="1"><b>Url</b>			
			</td>
			<td colspan="8"><a href="<?php echo SITEURL."service/".$api['api_url']?>"><?php echo ($api['api_url']!="")?SITEURL."service/".$api['api_url']:"#"; ?></a></td>
		</tr>
		
		
		
		<tr>
			<td colspan="9" class="lefter bolder"><b>DETAILS OF APIs		</b>						
</td>
		</tr>
		<tr>
			<td colspan="9" class="lefter bolder"><?php echo $api['api_description']?>						
</td>
		</tr>
		<tr>
			<td colspan="9" class="lefter bolder"><b>Required Parameters OF API		</b>						
</td>
		</tr>
		
		
		<?php  
			
			$api_url=explode("?",$api['api_url']);
			if(sizeof($api_url)==2)
			{
				$sub_count=0;
				$parmas=explode("&",$api_url[1]);
				foreach($parmas as $p)
				{
					?>
					<tr>
					
					<td colspan="8" class="lefter bolder">
					<?php
					$key_value=explode("=",$p);
					echo $key_value[0]."=".$key_value[1]."<br>";
					
					?>
						</td>
						<?php if($sub_count==0){?>
							<td class="center" rowspan="<?php echo sizeof($parmas);?>" colspan=1 >
							<h1><?php echo sizeof($parmas);?></h1>
						</td>
						<?php }?>
			</tr>
					<?php
					$sub_count++;
				}
			}
			else
			{
				?>
				<tr>
				<td colspan="8" class="lefter bolder">
				<?php				
				echo "Hurrah! No Parameters Required!!";	
				?>
				</td>
				</tr>
				<?php
			}	
			
		?>
									
	
			<?php
			
			$count++;
		}?>
		
	
		
		

	
		</tbody>
</table>		
</div>

</body>
</html>