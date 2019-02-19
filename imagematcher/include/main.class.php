<?php
class Database
{
	protected $db_host = "localhost";
	protected $db_user = "root";
	protected $db_pass = "";
	protected $db_name = "image_matcher"; 
	protected $con 	= false; 
	
    public function connect()   
	{   
		if(!$this->con)
        {
		
            $myconn = @mysql_connect($this->db_host,$this->db_user,$this->db_pass);
            if($myconn)
            {
                $seldb = @mysql_select_db($this->db_name,$myconn);
                if($seldb)
                {
							
					$this->con = true;
                    return true;
                } else
                {
					
                    return false;
                }
            } else
            { 	
                return false;
            }
        } 
		else
        {
            return true;
        }
	}
	
	public function disconnect()    
	{   
		if($this->con)
		{
			if(@mysql_close())
			{
				$this->con = false;
				return true;
			}
			else
			{
				return false;
			}
		}
	}
	
	public function getDBName()   
	{   
		$dbData = $this->db_host.",".$this->db_user.",".$this->db_pass.",".$this->db_name;
		return $dbData;
	}
	//--------------------------- DB -------------------------------//
}
?>