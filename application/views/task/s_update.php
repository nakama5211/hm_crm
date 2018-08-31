<script type="text/javascript">
	$('input[name=req_date],input[name=ola_date],input[name=due_date],input[name=fns_date]').datetimepicker();

	$('.data-list').on('input',function() {
		var selectedOption = $('option[value="'+$(this).val()+'"]');
		if(selectedOption.length>0){
			$(this).next().val(selectedOption.attr('id'));
		}
	});

	$(document).ready(function(){
		var select = $('input[name=u_request]'),value = select.val();
		if (value!='') {
			select.prev().val($('option[id="'+value+'"]').val());
		}
		var select1 = $('input[name=u_responsi]'),value1 = select1.val();
		if (value1!='') {
			select1.prev().val($('option[id="'+value1+'"]').val());
		}
	});

	$(document).on('change','.crm-control',function(){
	    var log = $(this).attr('log');
	    if (log) {
	      var text = $(this).find('option:selected').text();
	      if (!text) {
	        text = $(this).val();
	      }
	      var oldchange = $('input[name=changelog]').val();
	      var newchange = '';
	      var arr_log = oldchange.split('|');
	      if (arr_log.length>0) {
	        for (var i = 0; i < arr_log.length; i++) {
	          // console.log(arr_log[i]);
	          if(arr_log[i]!= ' ' && arr_log[i]!= '' && arr_log[i].indexOf(log) == -1){
	            newchange += arr_log[i].trim()+" | ";
	          }
	        }
	      }
	      newchange += log+': '+text+" | ";
	      // console.log(newchange);
	      $('input[name=changelog]').val(newchange);
	    }
	    // $('.btn-updateAction').html("Cập nhật phiếu");
	});

	$('#all-in').on('submit',function(){
		var form = new FormData($(this)[0]);
		var url = '<?php echo(base_url().'task/aj_api_update');?>';
		// for (var [key, value] of form.entries()) { 
  //           console.log(key, value);
  //       }
  		var ticket = form.get('ticketid');
  		if(ticket == '')
  		{
  			ticket = 0;
  		}
  		var ticket_sel = $('#l_ticket '+'option[value='+ticket+']');
  		// if (ticket_sel.length==0) {
  		// 	$('input[name=ticketid]').addClass('error-input');
  		// }else{
  		// 	$('input[name=ticketid]').removeClass('error-input');
  			$(this).find('button[type=submit]').prop('disabled',true).find('i').removeClass().addClass('fa fa-spin fa-spinner');
  		$.ajax({
	          type: "POST",
	          url: url,
	          data:  form,
	          dataType:'json',
	          contentType: false,
	          cache: false,
	          processData:false,
	          success: function(data) {
	          	if (data.code==1) {
	        		window.location.reload();
	        	}
	          },
	          error: function(xhr, status, error) {
	            console.log(error);
	          }
        });
  	// }
        return false;
	});

	$(document).on('click','#btn-accept',function(){
		var f = new FormData($('#all-in')[0]);
		var id = f.get('taskid');
		var form = new FormData();
		form.set('status','W');
		form.set('taskid',id);
		form.set('action',"Tiếp nhận công việc");
		var url = '<?php echo(base_url().'task/aj_api_update');?>';
		$.ajax({
	          type: "POST",
	          url: url,
	          data:  form,
	          dataType:'json',
	          contentType: false,
	          cache: false,
	          processData:false,
	          success: function(data) {
	          	if (data.code==1) {
	        		window.location.reload();
	        	}
	          },
	          error: function(xhr, status, error) {
	            console.log(error);
	          }
        });
        return false;
	});

	$(document).on('click','#btn-complete',function(){
		var f = new FormData($('#all-in')[0]);
		var id = f.get('taskid');
		var form = new FormData();
		form.set('status','C');
		form.set('taskid',id);
		form.set('action',"Hoàn thành công việc");
		var url = '<?php echo(base_url().'task/aj_api_update');?>';
		$.ajax({
	          type: "POST",
	          url: url,
	          data:  form,
	          dataType:'json',
	          contentType: false,
	          cache: false,
	          processData:false,
	          success: function(data) {
	          	if (data.code==1) {
	        		window.location.reload();
	        	}
	          },
	          error: function(xhr, status, error) {
	            console.log(error);
	          }
        });
        return false;
	});
</script>