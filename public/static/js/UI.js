var UI={
		
		//加载页面
		open:function(obj){
			var title = obj.title;
			var url = obj.url;
			var width = obj.width;
			var height = obj.height;
			
			var html = '<div class="modal fade" tabindex="-1" role="dialog" id="UI_open_lg">\
					      <div class="modal-dialog modal-lg" role="document">\
					        <div class="modal-content" >\
					          <div class="modal-header" style="background-color: #f7f7f7  ">\
					            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>\
					            <h4 class="modal-title">'+title+'</h4>\
					          </div>\
					          <div class="modal-body">\
					            <iframe src="'+url+'" style="width:100%;height:100%;" frameborder=0>\
					            </div>\
					        </div>\
					      </div>\
					    </div>';
					    
		    $('body').append(html);
		    $('#UI_open_lg .modal-lg').css('width',width);
		    $('#UI_open_lg .modal-body').css('height',height);
			$('#UI_open_lg').modal({backdrop:'static'});
		 	// $('#UI_open_lg').modal({keyboard:false});
			$('#UI_open_lg').modal('show');
			$('#UI_open_lg').on('hidden.bs.modal', function (e) {
				$('#UI_open_lg').remove();
				});
			
		},
	
		//加载模态框
		alert:function(obj){
		var title = obj.title;
		var msg = obj.msg;
		var icon = obj.icon;
		
		var html = '<div class="modal fade" tabindex="-1" role="dialog" id="UI_alert_sm">\
				      <div class="modal-dialog modal-sm" role="document">\
				        <div class="modal-content">\
				          <div class="modal-header">\
				            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>\
				            <h4 class="modal-title">'+title+'</h4>\
				          </div>\
				          <div class="modal-body">\
				            <p><img src="/static/image/'+icon+'.png" style="width:32px;height:32px;margin-right:5px;" /> '+msg+'</p>\
				          </div>\
				          <div class="modal-footer">\
				            <button type="button" class="btn btn-primary" onclick="$(\'#UI_alert_sm\').modal(\'hide\');">确定</button>\
				          </div>\
				        </div>\
				      </div>\
				    </div>';
				    
	    $('body').append(html);
		$('#UI_alert_sm').modal({backdrop:'static'});
//	 	$('#UI_alert_sm').modal({keyboard:false});
		$('#UI_alert_sm').modal('show');
		$('#UI_alert_sm').on('hidden.bs.modal', function (e) {
			$('#UI_alert_sm').remove();
			});
		
	}


}