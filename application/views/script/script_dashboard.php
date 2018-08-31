<script type="text/javascript">
	$(document).ready(function(){
		$('#modalDelete').on('shown.bs.modal', function (e) {
  			var code = $(e.relatedTarget).data('code');
			$(e.currentTarget).find('input[name="codedelete"]').val(code);
			var category = $(e.relatedTarget).data('category');
			$(e.currentTarget).find('input[name="categorydelete"]').val(category);
		});
		$('#modalUpdate').on('shown.bs.modal', function (e) {
  			var code = $(e.relatedTarget).data('code');
			$(e.currentTarget).find('input[name="code"]').val(code);
			var category = $(e.relatedTarget).data('category');
			$(e.currentTarget).find('input[name="category"]').val(category);
			var name = $(e.relatedTarget).data('name');
			$(e.currentTarget).find('input[name="name"]').val(name);
		});
	});
	function insertExtUser(formid)
	{
		var fieldtype = $('#fieldtype').val();
		var fieldcode = $('#fieldcode').val();
		var fieldname = $('#fieldname').val();
		var datasource = $('#datasource').val();
		var dataExt = $('#dataExt').serialize();
		 $.ajax({
             url: '<?php echo base_url().'groupuser/insertFieldUser' ?>',
             type: 'POST',
             dataType: 'JSON',
             data: {fieldtype:fieldtype,fieldcode:fieldcode,fieldname:fieldname,formid:formid,dataExt : dataExt,datasource:datasource},
           })
           .done(function(data) {
               if(data.code==1){
               	window.location.reload();
               }else{
                 alert(data.message);
               }
             })
           .fail(function() {
              alert('Lỗi hệ thống, vui lòng liên hệ Admin');
           });
	}

	function selectType(obj)
	{
		$('.optionD').remove();
		var id = obj.value;
		if(id == 'D')
		{
			$('.extendbottom').append('<form id="dataExt" method="POST" role="form"><div class="optionD">\
				<div class="form-group">\
					    <label for="exampleInputEmail1">Mã nguồn dữ liệu</label>\
					    <input type="text" class="form-control" name="datasource" id="datasource" placeholder="-Mã nguồn dữ liệu">\
				</div>\
						<div class="form-group optionbottom">\
					    <label for="exampleInputEmail1">Dropdown Options</label>\
					    <div class="">\
	            		<label class="control-label user-label col-md-2 no-padding">Mã trường:</label>\
	              		<label class="control-label col-md-8 no-padding-right">\
		              		<input name="code[]" class="form-control" placeholder="Mã trường">\
		              	</label>\
	            		</div>\
	            		<div class="">\
	            		<label class="control-label user-label col-md-2 no-padding">Tên trường:</label>\
	              		<label class="control-label col-md-8 no-padding-right">\
		              		<input name="name[]" class="form-control" placeholder="Tên trường">\
		              	</label>\
	            		</div>\
	            		\
			</div>\
			<div class="addoption">\
	            		<label class="control-label user-label col-md-3 no-padding"></label>\
	              		<label class="control-label col-md-8 no-padding-right field-click-able"><a onclick="addOption()" style="cursor: pointer;" class="user-name">+ Thêm Option</a></label>\
	        </div></div></form>');
		}
	}
	function addOption()
	{
		$('.addoption').before('<div class="optionD">\
						<div class="form-group optionbottom">\
					    <label for="exampleInputEmail1">Options</label>\
					    <div class="">\
	            		<label class="control-label user-label col-md-2 no-padding">Mã trường:</label>\
	              		<label class="control-label col-md-8 no-padding-right">\
		              		<input name="code[]" class="form-control" placeholder="Mã trường">\
		              	</label>\
	            		</div>\
	            		<div class="">\
	            		<label class="control-label user-label col-md-2 no-padding">Tên trường:</label>\
	              		<label class="control-label col-md-8 no-padding-right">\
		              		<input name="name[]" class="form-control" placeholder="Tên trường">\
		              	</label>\
	            		</div>\
	            		\
			</div>\
			</div>');
	}
	function insertSelectBox()
	{
		var code = $('#code').val();
		var name = $('#name').val();
		var category = $('#category').val();
		$.ajax({
             url: '<?php echo base_url().'groupuser/insertSelectBox' ?>',
             type: 'POST',
             dataType: 'JSON',
             data: {code:code,name:name,category:category},
           })
           .done(function(data) {
               if(data.code==1){
               	window.location.reload();
               }else{
                 alert(data.message);
               }
             })
           .fail(function() {
              alert('Lỗi hệ thống, vui lòng liên hệ Admin');
           });
	}
	$('#udpategroup_btn').click(function(){
               var groupid = $('#groupid').val();
          	   var ticketrule = $('#ticketrule').val();
          	   var taskrule = $('#taskrule').val();
          	   var userrule = $('#userrule').val();
          	   var knowledgerule = $('#knowledgerule').val();var status = $('#status').val()
          $.ajax({
             url: '<?php echo base_url().'groupuser/updategroup' ?>',
             type: 'POST',
             dataType: 'JSON',
             data: {groupid:groupid,ticketrule:ticketrule,taskrule:taskrule,userrule:userrule,knowledgerule:knowledgerule,status:status},
           })
           .done(function(data) {
               if(data.code==1){
                 window.location.reload();
               }else{
                 alert(data.message);
               }
             })
           .fail(function() {
              alert('Lỗi hệ thống, vui lòng liên hệ Admin');
           });
          });
	function uddateFields()
	{
		var fieldcode = $('#fieldcode').val();
		var fieldname = $('#fieldname').val();
		var status = $('#status').val();
		$.ajax({
             url: '<?php echo base_url().'groupuser/updateFields' ?>',
             type: 'POST',
             dataType: 'JSON',
             data: {fieldcode:fieldcode,fieldname:fieldname,status:status},
           })
           .done(function(data) {
               if(data.code==1){
                 window.location.reload();
               }else{
                 alert(data.message);
               }
             })
           .fail(function() {
              alert('Lỗi hệ thống, vui lòng liên hệ Admin');
           });
	}

	function deleteButton()
	{
		var category = $('#categorydelete').val();
		var code = $('#codedelete').val();
		var action = 'delete';
		$.ajax({
             url: '<?php echo base_url().'groupuser/updateCodictionary' ?>',
             type: 'POST',
             dataType: 'JSON',
             data: {category:category,code:code,action:action},
           })
           .done(function(data) {
               if(data.code==1){
                 window.location.reload();
               }else{
                 alert(data.message);
               }
             })
           .fail(function() {
              alert('Lỗi hệ thống, vui lòng liên hệ Admin');
           });
	}

	function updateButton()
	{
		var category = $('#category').val();
		var code = $('.code').val();
		var name = $('.nameField').val();
		var action = 'update';
		$.ajax({
             url: '<?php echo base_url().'groupuser/updateCodictionary' ?>',
             type: 'POST',
             dataType: 'JSON',
             data: {category:category,code:code,name:name,action:action},
           })
           .done(function(data) {
               if(data.code==1){
                 window.location.reload();
               }else{
                 alert(data.message);
               }
             })
           .fail(function() {
              alert('Lỗi hệ thống, vui lòng liên hệ Admin');
           });
	}
</script>