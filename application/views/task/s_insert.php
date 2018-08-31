<script type="text/javascript">
	$('input[name=req_date],input[name=ola_date],input[name=due_date],input[name=fns_date]').datetimepicker();

	$('.data-list').on('input',function() {
		var selectedOption = $('option[value="'+$(this).val()+'"]');
		if(selectedOption.length>0){
			$(this).next().val(selectedOption.attr('id'));
		}
	});

	$('#all-in').on('submit',function(){
		var form = new FormData($(this)[0]);
		var url = '<?php echo(base_url().'task/aj_api_insert');?>';
		// for (var [key, value] of form.entries()) { 
  //           console.log(key, value);
  //       }
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

        return false;
	});
</script>