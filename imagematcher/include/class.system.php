<?php
class System extends Functions
{
	function __construct() {
	   $db = new Functions();
	   $conn = $db->connect();
	   $this->db=$db;
       
	}
	
	function deleteImage($url)
	{
		if(file_exists($url))
		{
			unlink($url);
		}
	}
	function getImageDetail($filename,$folder,$default_image)
	{
		if($filename!="")
		{
			if(file_exists($folder.$filename))
			{
				$detail=array('image_name'=>$filename,"preview_path"=>$folder.$filename,"default_img"=>$default_image);
				
			}
			else
			{				
				$detail=array('image_name'=>"","preview_path"=>$default_image,"default_img"=>$default_image);
			}
		}
		else
		{
			$detail=array('image_name'=>$filename,"preview_path"=>$default_image,"default_img"=>$default_image);
		}
		return $detail;		
	}
	function pageBar($hierarchy,$pageToolbar="")
	{
		if(!empty($hierarchy))
		{
			?>
		<!-- BEGIN PAGE BAR -->
		<div class="page-bar">
			<ul class="page-breadcrumb">
			<?php for($i=0;$i<sizeof($hierarchy);$i++)
			{				
			?>
				<li>
					<?php if($i!=sizeof($hierarchy)-1)
					{
						?>
						<a href="<?php echo $hierarchy[$i]['link'];?>"><?php echo $hierarchy[$i]['title'];?></a>
						<i class="fa fa-circle"></i>
					<?php 
					}
					else
					{
						?>
						 <span><?php echo $hierarchy[$i]['title'];?></span>
						<?php 
					}
					?>
				</li>
			<?php 
			}
			?>								
			</ul>
			<div class="page-toolbar">
				<?php echo $pageToolbar;?>
			</div>
		</div>
		<!-- END PAGE BAR -->
		<?php 
		}
	}
	function changeThemeMenu()
	{
		?>
		 <!-- BEGIN THEME PANEL -->
			<div class="theme-panel hidden-xs hidden-sm">
				<div class="toggler"> </div>
				<div class="toggler-close"> </div>
				<div class="theme-options">
					<div class="theme-option theme-colors clearfix">
						<span> THEME COLOR </span>
						<ul>
							<li class="color-default current tooltips" data-style="default" data-container="body" data-original-title="Default"> </li>
							<li class="color-darkblue tooltips" data-style="darkblue" data-container="body" data-original-title="Dark Blue"> </li>
							<li class="color-blue tooltips" data-style="blue" data-container="body" data-original-title="Blue"> </li>
							<li class="color-grey tooltips" data-style="grey" data-container="body" data-original-title="Grey"> </li>
							<li class="color-light tooltips" data-style="light" data-container="body" data-original-title="Light"> </li>
							<li class="color-light2 tooltips" data-style="light2" data-container="body" data-html="true" data-original-title="Light 2"> </li>
						</ul>
					</div>
					<div class="theme-option">
						<span> Layout </span>
						<select class="layout-option form-control input-sm">
							<option value="fluid" selected="selected">Fluid</option>
							<option value="boxed">Boxed</option>
						</select>
					</div>
					<div class="theme-option">
						<span> Header </span>
						<select class="page-header-option form-control input-sm">
							<option value="fixed" selected="selected">Fixed</option>
							<option value="default">Default</option>
						</select>
					</div>
					<div class="theme-option">
						<span> Top Menu Dropdown</span>
						<select class="page-header-top-dropdown-style-option form-control input-sm">
							<option value="light" selected="selected">Light</option>
							<option value="dark">Dark</option>
						</select>
					</div>
					<div class="theme-option">
						<span> Sidebar Mode</span>
						<select class="sidebar-option form-control input-sm">
							<option value="fixed">Fixed</option>
							<option value="default" selected="selected">Default</option>
						</select>
					</div>
					<div class="theme-option">
						<span> Sidebar Menu </span>
						<select class="sidebar-menu-option form-control input-sm">
							<option value="accordion" selected="selected">Accordion</option>
							<option value="hover">Hover</option>
						</select>
					</div>
					<div class="theme-option">
						<span> Sidebar Style </span>
						<select class="sidebar-style-option form-control input-sm">
							<option value="default" selected="selected">Default</option>
							<option value="light">Light</option>
						</select>
					</div>
					<div class="theme-option">
						<span> Sidebar Position </span>
						<select class="sidebar-pos-option form-control input-sm">
							<option value="left" selected="selected">Left</option>
							<option value="right">Right</option>
						</select>
					</div>
					<div class="theme-option">
						<span> Footer </span>
						<select class="page-footer-option form-control input-sm">
							<option value="fixed">Fixed</option>
							<option value="default" selected="selected">Default</option>
						</select>
					</div>
				</div>
			</div>
			<!-- END THEME PANEL -->
		<?php
	}
}
?>