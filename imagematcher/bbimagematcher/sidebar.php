<?php 
// Include SIDEBAR HTML Here..
//Initialize the XML parser
$parser=xml_parser_create();

//Function to use at the start of an element
function start($parser,$element_name,$element_attrs) {
    switch($element_name) {
        case "GROUP":
		$selected=($GLOBALS['page_id']==$element_attrs['PAGE_ID'])?' <span class="selected"></span>':"";
		$active=($GLOBALS['page_id']==$element_attrs['PAGE_ID'])?'active':"";
		$open=($GLOBALS['page_id']==$element_attrs['PAGE_ID'])?'open':"";
        echo '<li  class="nav-item start '.$active.'">
		 <a href="javascript:;" class="nav-link nav-toggle">
                                    <i class="'.$element_attrs['ICON'].'"></i>
                                   <span class="title">'.$element_attrs['TITLE'].'</span>
								  '.$selected.'
								  <span class="arrow '.$open.' "></span>
                                </a>
								<ul class="sub-menu">';
    break;     
        case "ITEM":		
        echo '<li><a href="'.$element_attrs['URL'].'"><i class="'.$element_attrs['ICON'].'" class="nav-link "></i><span class="title"></span>';
    }
}

//Function to use at the end of an element
function stop($parser,$element_name) {    
	 switch($element_name) {
        case "GROUP":
        echo "</ul></li>";
    break;     
        case "ITEM":		
        echo '</a></li>';
    }
}

//Function to use when finding character data
function char($parser,$data) {
    echo $data;
}

//Specify element handler
xml_set_element_handler($parser,"start","stop");

//Specify data handler
xml_set_character_data_handler($parser,"char");

//Open XML file
$fp=fopen(__DIR__."/xml/var_config_sidebar.xml","r");

?>
<div class="page-sidebar-wrapper">
                    <!-- BEGIN SIDEBAR -->
                    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                    <div class="page-sidebar navbar-collapse collapse">
                        <!-- BEGIN SIDEBAR MENU -->
                        <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
                        <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
                        <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
                        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                        <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
                        <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                        <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
                            <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
                            <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                            <li class="sidebar-toggler-wrapper hide">
                                <div class="sidebar-toggler">
                                    <span></span>
                                </div>
                            </li>
                            <!-- END SIDEBAR TOGGLER BUTTON -->                            
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
                           
                        </ul>
                        <!-- END SIDEBAR MENU -->
                        <!-- END SIDEBAR MENU -->
                    </div>
                    <!-- END SIDEBAR -->
                </div>