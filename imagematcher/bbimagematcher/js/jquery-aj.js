/*
 * Toastr
 * Copyright 2012-2015
 * Authors: John Papa, Hans Fjällemark, and Tim Ferrell.
 * All Rights Reserved.
 * Use, reproduction, distribution, and modification of this code is subject to the terms and
 * conditions of the MIT license, available at http://www.opensource.org/licenses/mit-license.php
 *
 * ARIA Support: Greta Krafsig
 *
 * Project: https://github.com/CodeSeven/toastr
 */
/* global define */
(function (define) {
    define(['jquery'], function ($) {
		return (function () {
			var $container;
            var listener;
            var ajId = 0;
            var ajType = {
                error: 'error',
                info: 'info',
                success: 'success',
                warning: 'warning'
            };

            var aj = {
                               
                error: error,              
                createFormElement: createFormElement,              
                callAJAX: callAJAX,
				cropTool:cropTool,	
                version: '1.0.0',
                
            };

            var previousToast;

            return aj;
			
			function cropTool(input,width,height,preload_image,placeholder,defaultPlaceHolder,orignalUploadPath,cropuploadPath,onImageUploadcallback,onImageCropCallback,onImageDeleteCallback,uploadUrl="",cropUrl="",deleteUrl="",modal=false)
			{
				$("#"+input).css("position","relative");
				$("#"+input).css("width",width);
				$("#"+input).css("height",height);
				if(!modal)
				{
					
					customUploadButtonId='';
				}
				else
				{
					customUploadButtonId='altImageUpload';
				}
				if(preload_image=="")
				{
					$("#"+input).find('.delete-img').hide();
				}
				else
				{
					$("#"+input).find('.delete-img').on('click',function(){
						callAJAX(
							{folder:cropuploadPath,filename:preload_image},
							(deleteUrl!="")?deleteUrl:'crop/img_delete_to_file.php',
							"POST",
							function(json)
							{
								if(onImageDeleteCallback!=null)
								{
									onImageDeleteCallback(json);
								}
								else
								{
									json=$.parseJSON(json);
									msg=json.message;
									if(json.status=="success")
									{
										toastr.success(msg,"Success!!");
										$("#"+input).val("");
										$("#"+input).find('.delete-img').hide();
										$("#"+input).css("background-image","url("+defaultPlaceHolder+")");
									}
									else
									{
										toastr.error(msg,"Success!!");
									}
								}
							});
					});
				}
				
				$("#"+input).css("background-image","url("+placeholder+")");
				
				var cropperOptions = {
					imgEyecandy:true,
					imgEyecandyOpacity:0.2,
					modal:modal,
					customUploadButtonId:customUploadButtonId,
					uploadUrl:(uploadUrl!="")?uploadUrl:'crop/img_save_to_file.php',
					cropUrl:(cropUrl!="")?cropUrl:'crop/img_crop_to_file.php',					
					onBeforeImgUpload: 	function(){ console.log('onBeforeImgUpload') },
					onAfterImgUpload: 	function(data){onImageUploadcallback(data)},
					onImgDrag:		function(){ console.log('onImgDrag') },
					onImgZoom:		function(){ console.log('onImgZoom') },
					onBeforeImgCrop: 	function(){ console.log('onBeforeImgCrop') },
					onAfterImgCrop:		function(data){onImageCropCallback(data)},
					onReset:		function(){ console.log('onReset') },
					onError:		function(errormsg){ console.log('onError:'+errormsg)},							
					cropData:{
						"folder":cropuploadPath,				
					},
					uploadData:{
						"folder":orignalUploadPath,					
					}
				}		
				
				var cropperHeader = new Croppic(input, cropperOptions);
			}
			function createFormElement(type,value="",_class="",name="",id="",label="",style="",extra)
			{
				var text="";
				if(type=='radio')
				{
					text='<div class="form-group"><div class="radio"><label for="'+name+'"><input type="radio" id="'+id+'" name="'+name+'" class="'+_class+'" value="'+value+'">'+label+'</label></div></div>';					
				}
				else if(type=='checkbox')
				{
					text='<div class="form-group"><div class="md-checkbox"><input '+extra+' type="checkbox" id="'+id+'" name="'+name+'" class="md-check '+_class+'" value="'+value+'"><label for="'+id+'">'+label+'<span></span><span class="check"></span><span class="box"></span></label></div></div>';					
				}
				else if(type=='spinner')
				{
					text='<option '+extra+' value="'+value+'">'+label+'</option>';	
				}
				else if(type=='handler-list-root')
				{
					text='<div class="col-md-12"><h3 class="title-to-add" data-id="'+value+'">"'+label+'"</h3></div><div class="item sortable-to-add" data-type="offer"></div>';
				}
				else if(type=='handler-list-child')
				{
					
					text='<span class="col-md-3" id="offer_'+value+'"><div class="media tt-suggestion tt-selectable"><div class="pull-left"><div class="media-object"><img src="'+extra+'" width="50" height="50"></div></div><div class="media-body"><h4 class="media-heading">'+label+'</h4></div></div></span>';
					
				}
				else if(type=='handler-list-A-child')
				{
					
					text='<span class="col-md-3" id="advertise_'+value+'"><div class="media tt-suggestion tt-selectable"><div class="pull-left"><div class="media-object"><img src="'+extra+'" width="50" height="50"></div></div><div class="media-body"><h4 class="media-heading">'+label+'</h4></div></div></span>';
					
				}
				else if(type=='final-list')
				{
					child="";
					for(i=1;i<=extra.length;i++)
					{
						child=child+'<li class="list-item">Product '+i+'</li>';
					}
					text='<span class="item-final-class" data-type="'+value+'" data-child="'+extra+'" data-title="'+label+'" id="offer_1"><h2><div class="label label-success"><i style="font-size:18px;" class="fa fa-align-justify "></i> '+label+' <i style="font-size:18px; padding-bottom:15px" class="fa fa-close delete-item"></i> </div></h2></span>';
					
				}
				else if(type=='final-A-list')
				{
					child="";
					for(i=1;i<=extra.length;i++)
					{
						child=child+'<li class="list-item">Product '+i+'</li>';
					}					
					text='<span class="item-final-class" data-type="'+value+'" data-child="'+extra+'" data-title="'+label+'" id="advertise_1"><h2><div class="label label-success"><i style="font-size:18px;" class="fa fa-align-justify "></i> '+label+' <i style="font-size:18px; padding-bottom:15px" class="fa fa-close delete-item"></i> </div></h2></span>';
				}
				return text;
				
			}
			function error(id,msg,operation,toast=false)
			{
				if(id!="" || id!='undefined' && msg!="")
				{
					if(operation=='add_error')
					{
						$("#"+id).parent().find('.form-control').addClass("edited");
						$("#"+id).on('focus',function(){
							$(this).parent().removeClass("has-error");							
						});
										
						$("#"+id).parent().addClass("has-error");
						$("#"+id).parent().find(".help-block").html(msg);
						if(toast)
						toastr.error(msg,"Error!!");
						return true;
					}
					else if(operation=='add_success')
					{
						$("#"+id).parent().addClass("has-success");
						$("#"+id).parent().find(".help-block").html("<i class='fa fa-ok'></i>"+msg);
						if(toast)
						toastr.success(msg,"Success!!");
						return true;
					}
					else if(operation=='remove_error')
					{
						$("#"+id).parent().removeClass("has-error");
						$("#"+id).parent().find(".help-block").html("");				
					}
					else
					{
						console.log('wrong service');
					}
				}
				else
				{
					console.log('id or msg not found!!');
				}
			}
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
		})();  
	});
}
(typeof define === 'function' && define.amd ? define : function (deps, factory) {
    if (typeof module !== 'undefined' && module.exports) { //Node
        module.exports = factory(require('jquery'));
    } else {
        window.aj = factory(window.jQuery);
    }
})
);
