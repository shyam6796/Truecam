var User=function()
{
	var id,name,email,profile_picture_path;	
	var user;
	var chat_users=[];
	var chat_rooms=[];
	return{
		createUser:function(id,type,name,email,profile_picture_path)
		{
			if(id!="" && type!="" && name!="" && email!="")
			{
				var obj={};
				obj.id=id;
				obj.type=type;
				obj.name=name;
				obj.email=email;
				obj.profile_picture_path=profile_picture_path;
				this.user=obj;
				return obj;
			}
			else
			{
				return null;
			}
		}
	}
	
	
}();