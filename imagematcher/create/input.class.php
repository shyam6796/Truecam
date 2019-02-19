<?php 
class Input{
public $input_type=array("text","email","number","textarea","spinner","datepicker","timepicker","datetimepicker");
public $input_html_node=array("text"=>'<div class="form-group form-md-line-input form-md-floating-label">
									<input class="form-control [[:CLASS:]]" value="[[:VALUE:]]" name="[[:NAME:]]" id="[[:ID:]]" type="text"  [[:VALIDATION:]] >
									<label for="[[:ID:]]">[[:LABEL:]]</label>
									<span class="help-block">[[:HELP_BLOCK:]]</span>
								</div>',
						"email"=>'<div class="form-group form-md-line-input form-md-floating-label">
									<input class="form-control [[:CLASS:]]"  value="[[:VALUE:]]" name="[[:NAME:]]" id="[[:ID:]]" type="email"  [[:VALIDATION:]] >
									<label for="[[:ID:]]">[[:LABEL:]]</label>
									<span class="help-block">[[:HELP_BLOCK:]]</span>
								</div>',
						"number"=>'<div class="form-group form-md-line-input form-md-floating-label">
									<input class="form-control [[:CLASS:]]" value="[[:VALUE:]]"  name="[[:NAME:]]" id="[[:ID:]]" type="number"  [[:VALIDATION:]] >
									<label for="[[:ID:]]">[[:LABEL:]]</label>
									<span class="help-block">[[:HELP_BLOCK:]]</span>
								</div>',
						"textarea"=>'<div class="form-group form-md-line-input form-md-floating-label">
										<textarea name="[[:NAME:]]" class="form-control [[:CLASS:]]" id="[[:ID:]]" rows="3"  [[:VALIDATION:]] >[[:VALUE:]]</textarea>
										<label for="[[:ID:]]">[[:LABEL:]]</label>
										<span class="help-block">[[:HELP_BLOCK:]]</span>
									</div>',
						"spinner"=>'<div class="form-group form-md-line-input form-md-floating-label has-info">
										<select class="form-control edited [[:CLASS:]]"  value="[[:VALUE:]]"  id="[[:ID:]]" name="[[:NAME:]]" [[:VALIDATION:]] >
											<option value=""></option>
											<option value="1" selected="">Option 1</option>
											<option value="2">Option 2</option>
											<option value="3">Option 3</option>
											<option value="4">Option 4</option>
										</select>
										<label for="[[:ID:]]">[[:LABEL:]]</label>
										<span class="help-block">[[:HELP_BLOCK:]]</span>
									</div>',
						"datepicker"=>'<div class="form-group form-md-line-input form-md-floating-label has-info">
										<div class="input-group date date-picker margin-bottom-5" [[:VALIDATION:]]>
										<input class="form-control form-filter input-sm date-picker" readonly="" id="[[:ID:]]" name="[[:NAME:]]"  value="[[:VALUE:]]"   placeholder="From" type="text">
										<span class="input-group-btn">
											<button class="btn btn-sm default " type="button">
												<i class="fa fa-calendar"></i>
											</button>
										</span>
										<label for="[[:ID:]]">[[:LABEL:]]</label>
										<span class="help-block">[[:HELP_BLOCK:]]</span>
									</div>
									</div>',
						"timepicker"=>'',
						"datetimepicker"=>'');
public $required_JS=array("text"=>'',"email"=>'',"number"=>'',"textarea"=>'',"spinner"=>'',
						  "datepicker"=>'
<script src="../assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>		  
<script src="../assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
<script type="text/javascript">
	$(".date-picker-btn").on("click",function(){
	$(this).closest("input.date-picker").datepicker("show");
	})
	$(".date-picker").datepicker();
</script>  ',
						  "timepicker"=>'
<script src="../assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>		  
<script src="../assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
<script type="text/javascript">
	$(".date-picker-btn").on("click",function(){
	   $(this).closest("input.date-picker").datepicker("show");
	})
	$(".date-picker").datepicker();
</script>',
						  "datetimepicker"=>'
<script src="../assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
<script type="text/javascript">
	$(".date-picker-btn").on("click",function(){
	   $(this).closest("input.date-picker").datepicker("show");
	})
	$(".date-picker").datepicker();
</script>');	
public $required_CSS=array("text"=>'',
							"email"=>'',
							"number"=>'',
							"textarea"=>'',
							"spinner"=>'',
							"datepicker"=>'
<link href="../assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css">
<link href="../assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css">',
							"timepicker"=>'
<link href="../assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css">
<link href="../assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css">',
							"datetimepicker"=>'
<link href="../assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css">
<link href="../assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css">'
						);

function createInput($input_type,$id,$name,$class,$label,$value,$help_block,$validation="")
{
		if(in_array($input_type,$this->input_type))
		{
			$input_html_node=$this->input_html_node[$input_type];
			if(strrpos($input_html_node,"[[:ID:]]"))
			{
				if($id!="")
				$input_html_node=str_replace("[[:ID:]]",$id,$input_html_node);
				else
				$input_html_node=str_replace("[[:ID:]]","#TEST",$input_html_node);	
			}		
			if(strrpos($input_html_node,"[[:NAME:]]"))
			{
				if($name!="")
				$input_html_node=str_replace("[[:NAME:]]",$name,$input_html_node);
				else
				$input_html_node=str_replace("[[:NAME:]]","TEST_INPUT_NAME",$input_html_node);	
			}
			if(strrpos($input_html_node,"[[:CLASS:]]"))
			{
				if($class!="")
				$input_html_node=str_replace("[[:CLASS:]]",$class,$input_html_node);
				else
				$input_html_node=str_replace("[[:CLASS:]]","",$input_html_node);	
			}			
			if(strrpos($input_html_node,"[[:LABEL:]]"))
			{
				if($label!="")
				$input_html_node=str_replace("[[:LABEL:]]",$label,$input_html_node);
				else
				$input_html_node=str_replace("[[:LABEL:]]","Test Input Label",$input_html_node);	
			}
			if(strrpos($input_html_node,"[[:VALUE:]]"))
			{
				if($value!="")
				$input_html_node=str_replace("[[:VALUE:]]",$value,$input_html_node);
				else
				$input_html_node=str_replace("[[:VALUE:]]","",$input_html_node);	
			}
			if(strrpos($input_html_node,"[[:HELP_BLOCK:]]"))
			{
				if($help_block!="" && $help_block!="NONE")
				$input_html_node=str_replace("[[:HELP_BLOCK:]]",$help_block,$input_html_node);
				else
				$input_html_node=str_replace("[[:HELP_BLOCK:]]","",$input_html_node);	
			}
			
			if(strrpos($input_html_node,"[[:VALIDATION:]]"))
			{
				if($validation!="" && $validation!="NONE")
				$input_html_node=str_replace("[[:VALIDATION:]]",$validation,$input_html_node);
				else
				$input_html_node=str_replace("[[:VALIDATION:]]","",$input_html_node);	
			}
			
			$result=array("ack"=>1,"ack_msg"=>"Input Created Successfully","result"=>$input_html_node);
			return $result;
			
			
		}
		else
		{
			
			$result=array("ack"=>1,"ack_msg"=>"Invalid Input Type Found!!");
			return $result;
		}
		
}

public function getRequiredAssets($inputs)
{
	$inputs=explode(",",$inputs);	
	$intersection=array_intersect($inputs,$this->input_type);
	if($intersection==$inputs)
	{
		$required_js=array();
		$required_css=array();
		foreach($inputs as $i)
		{
			$required_js[]=$this->required_JS[$i];
			$required_css[]=$this->required_CSS[$i];
		}
		$required_css=implode("",array_unique($required_css));
		$required_js=implode("",array_unique($required_js));
		$result=array("ack"=>1,"ack_msg"=>"Here are your required assests!!","result"=>array("required_js"=>$required_js,"required_css"=>$required_css));
		return $result;
	}
	else	
	{
		$result=array("ack"=>0,"ack_msg"=>"Invalid Input Type Found!!");
		return $result;
	}
	
}
	
}

?>