<?php 
class Validation{
public $validator=array("required","length","number","email","url","date","alphanumeric","checkbox_group");
public $validator_params=array("required"=>'',"length"=>'data-validation-length="[[:R:]]"',"number"=>'data-validation-allowing="[[:O:]]"',"email"=>'',"url"=>'',"date"=>'data-validation-format="[[:O:]]"',"alphanumeric"=>' data-validation-allowing="[[:O:]]"',"checkbox_group"=>'data-validation-qty="[[:R:]]"');
function createValidation($validation,$validation_params,$validation_error_message="",$validation_help_text="")
{
		$validations=explode(",",$validation);
		$validation_params=explode(",",$validation_params);
		$intersection=array_intersect($validations,$this->validator);
		if($intersection==$validations)
		{
			if(sizeof($validations)==sizeof($validation_params))
			{
				$validation_string='data-validation="'.$validation.'"';
				$validation_params_string="";
				
				for($i=0;$i<sizeof($validations);$i++)
				{
					$current_validation=$validations[$i];
					$current_validation_param_value=$validation_params[$i];
					if(array_key_exists($current_validation,$this->validator_params))
					{
						$validator_current_param=$this->validator_params[$current_validation];
						if(strrpos($validator_current_param,"[[:R:]]"))
						{
							if($current_validation_param_value!=NULL)
							{
								$validator_current_param=str_replace("[[:R:]]",$current_validation_param_value,$validator_current_param);
							}
							else
							{
								$result=array("ack"=>0,"ack_msg"=>"Invalid Validation Found!! Required value for validation param at position ".$i);
								return $result;
							}
						}
						else if(strrpos($validator_current_param,"[[:O:]]"))
						{
							if($current_validation_param_value!=NULL)
							{
								$validator_current_param=str_replace("[[:O:]]",$current_validation_param_value,$validator_current_param);
							}
						}
						$validation_params_string=$validation_params_string." ".$validator_current_param;	
					}
					
				}
				
				if($validation_error_message!="")
				$validation_error_string='data-validation-error-msg="'.$validation_error_message.'"';
				if($validation_help_text!="")
				$validation_help_string='data-validation-help="'.$validation_help_text.'"';
			
				$validation_string=$validation_string." ".$validation_params_string." ".$validation_error_string." ".$validation_help_string;
				$result=array("ack"=>1,"ack_msg"=>"Validation String Created Successfully","result"=>$validation_string);
				return $result;
			}
			else
			{
				$result=array("ack"=>0,"ack_msg"=>"Validations and validation parameter not matched!!");
				return $result;
			}
			
		}
		else
		{
			$result=array("ack"=>0,"ack_msg"=>"Invalid Validation Found!!");
			return $result;
		}
		
}
	
}

?>