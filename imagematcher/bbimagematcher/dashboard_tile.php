<?php 
//Initialize the XML parser
$parser=xml_parser_create();

//Function to use at the start of an element
function startDashboardTiles($parser,$element_name,$element_attrs) {
    switch($element_name) {
        case "GROUP":
        echo '<h4>'.$element_attrs['TITLE'].'&nbsp;<small>'.$element_attrs['EXTRA'].'</small></h4> <div class="row"> ';
    break;     
        case "ITEM":
		$db=$GLOBALS['db'];
		$count=$db->rp_getTotalRecord($element_attrs['COUNT_TABLE'],$element_attrs['COUNT_CONDITION']);				
        echo '<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
			<a class="dashboard-stat dashboard-stat-v2 '.$element_attrs['COLOR'].'" href="'.$element_attrs['URL'].'">
			<div class="visual">
				<i class="'.$element_attrs['ICON'].'"></i>
			</div>
			<div class="details">
				<div class="number">
					<span data-counter="counterup" data-value="'.$count.'">0</span>
				</div>
				<div class="desc">'.$element_attrs['TITLE'].' </div>
			</div>
          
			</a>
		  </div>
       ';
    }
}

//Function to use at the end of an element
function stopDashboardTiles($parser,$element_name) {    
	 switch($element_name) {
        case "GROUP":
        echo "</div>";
    break;     
        case "ITEM":		
        echo '';
    }
}

//Function to use when finding character data
function textDashboardTiles($parser,$data) {
    echo $data;
}

//Specify element handler
xml_set_element_handler($parser,"startDashboardTiles","stopDashboardTiles");

//Specify data handler
xml_set_character_data_handler($parser,"textDashboardTiles");

//Open XML file
$fp=fopen(__DIR__."/xml/var_config_dashboard.xml","r");

?>

<!-- BEGIN DASHBOARD STATS 1-->
<div class="row">
<?php 		
			//Read data
			while ($data=fread($fp,4096)) {
				xml_parse($parser,$data,feof($fp)) or
				die (sprintf("XML Error: %s at line %d",
				xml_error_string(xml_get_error_code($parser)),
				xml_get_current_line_number($parser)));
			}

			//Free the XML parser
			xml_parser_free($parser);
?>
<div class="clearfix"></div>
</div>
	