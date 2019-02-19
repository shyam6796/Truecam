function callAJAX(params,url,type,callback,callbackParams='',callType=0)
{
	$.ajax({       
		url:url,
		type:type,
		data:params,
		cache: false,
		beforeSend:function(){
			/*if(callType!=0)progressDialog(1);*/
		},
		success:function(data)
		{
			var json_obj=data;
			if(callbackParams!="")		
			callback(json_obj,callbackParams);
			else
			callback(json_obj);
			
		},
		error:function()
		{
			/*progressDialog(0);*/
			alertDialog(1,"danger","warning","Alert","Connection Error!! Try Later.")
			//alert('Connection Error Try Again Later');
		},
        
	});
}