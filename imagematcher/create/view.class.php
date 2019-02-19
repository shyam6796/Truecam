<?php 
class View{
	
	public function createView($columns,$table_id,$table_class)
	{
		$result="";
		$for_comments=array();
		$col=$val="";
		
		if($columns!="" && !empty($columns))
		{
			foreach($columns as $c)
			{
				$col=$col."<th>".$c['label']."</th>".PHP_EOL;			
				$for_comments[]=$c['slug'];
				$val=$val."<td><?php echo \$r['".$c['slug']."']; ?></td>".PHP_EOL;
			}
		}
		$result='<table class="table table-striped table-hover table-bordered '.$table_class.'" id="'.$table_id.'">
                                            <thead>
                                                <tr>
                                                    '.$col.'
                                                </tr>
                                            </thead>
                                            <tbody>
                                             <?php 
											 if($result[\'ack\']==1)
											 {
												 $items=$result[\'result\'];
												 
												 if(!empty($items))
												 {
													 // In Items there are all objects you need here are keys you will find in this array
													// '.implode("|",$for_comments).'	
													 foreach($items as $r)
													 {
														 ?>
														 <tr>
														'.$val.'
														 </tr>
														 <?php
													 }
												 }
											 }
											 ?>   
                                            </tbody>
                                        </table>';
		return array("ack"=>1,"result"=>array("content"=>$result));
	}
	
}

?>