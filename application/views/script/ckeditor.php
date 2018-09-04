
<script type="text/javascript">
	$(document).ready(function(){
		$('#ck-edit').click(function(){
			var stt = $('#content').attr('ck-edit');
			var title = $('#knl-title')[0].innerText;$('#knl-title').html('<input name="title" autofocus value="'+title+'">');
			console.log(title);
			if(stt && stt == 'close'){
				console.log('ck-edit is now close');
				var ck = CKEDITOR.replace( 'content' ,{
			        filebrowserBrowseUrl : '<?=base_url()?>ckfinder/ckfinder.html',
			        filebrowserImageBrowseUrl : '<?=base_url()?>ckfinder/ckfinder.html?type=Images',
			        filebrowserFlashBrowseUrl : '<?=base_url()?>ckfinder/ckfinder.html?type=Flash',
			        filebrowserUploadUrl : '<?=base_url()?>ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
			        filebrowserImageUploadUrl : '<?=base_url()?>ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
			        filebrowserFlashUploadUrl : '<?=base_url()?>ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
			        allowedContent: true,
			        disableAutoInline: true,
			        toolbarStartupExpanded : false,
			        toolbarCanCollapse: false,
			        width: '100%',
			        height: 700,
			        });
			    	ck.on( 'change', function( evt ) {
			          // getData() returns CKEditor's HTML content.
			          $('#content').html(evt.editor.getData());
			        });
			    if (ck) {
			    	$('#content').attr('ck-edit','open');
			    	$(this).css('display','none');
			    	$('#ck-save').css('display','block');
			    }
			}else {
				console.log('ck-edit is now open yet');
			}
		});
		$('#ck-save').click(function(){
			var stt = $('#content').attr('ck-edit');
			var action = $(this).attr('action');
			var id = '<?php echo $this->uri->segment(4) ?>';
			var title = $('#knl-title').find('input').val();$('#knl-title').html(title);
			var content = $('#content').html();
			var group = $('select[name="group"]').val();
			var cate = $('select[name="cate"]').val();
			var type = $('select[name="type"]').val();
			var status = $('select[name="status"]').val();
			var ticketprioty = $('select[name="ticketprioty"]').val();
			console.log(title);
			if(stt && stt == 'open'){
				console.log('ck-edit is now open');
				var aInst = CKEDITOR.instances;
				console.log(aInst);
				for (var key in aInst){
				    CKEDITOR.instances[key].destroy();
				}
				$('#content').attr('ck-edit','close');
				$(this).css('display','none');
			    $('#ck-edit').css('display','block');
			}else {
				console.log('ck-edit is now not close yet');
			}
			if(action =='add')
			{
				var url = '<?php echo base_url().'knowledge/insertKnowledge' ?>';
			}
			else{
				var url = '<?php echo base_url().'knowledge/updateKnowledge' ?>';
			}
			$.ajax({
		          url: url,
		          type: 'POST',
		          dataType: 'JSON',
		          data: {id:id,title:title,article: content,group:group,cate:cate,type:type,status:status,ticketprioty:ticketprioty},
		        })
		        .done(function(data) {
		          if(data.code==0){
		             alert('')
		          }
		          alert(data.message);
		          /*
		          		location.href= '<?php echo base_url().'/ticket/detail/' ?>'+data.data;
		              // alert('<?php echo base_url().'/ticket/detail/' ?>'+data.data);
		              */
		          })
		        .fail(function() {
		            alert('Lỗi hệ thống,vui lòng liên hệ admin để được hỗ trợ');
		        });
		});
		var action = '<?php echo isset($action)?$action:'' ?>';
		if(action !='')
		{
			$('#ck-edit').trigger('click');
		}

		$('select#level_1').change(function(){
	        var val = $(this).val();
	        if(val){
	          $('select#level_2 option, select#level_3 option').each(function(){
	            var ref1 = $(this).attr('ref1');
	            if (ref1==val) {
	              $(this).removeClass('hide').addClass('show');
	            }else{
	              $(this).addClass('hide').removeClass('show');
	            }
	          });
	        }else{
	          $('select#level_2 option, select#level_3 option').each(function(){
	            $(this).removeClass('hide').addClass('show');
	          });
	        }
	        $('select#level_2 option.show:first').prop('selected',true);
        	$('select#level_3 option.show:first').prop('selected',true);
	    });
	    $('select#level_2').change(function(){
	        var val = $(this).val();
	        if(val){
	          $('select#level_3 option').each(function(){
	            var ref2 = $(this).attr('ref2');
	            if (ref2==val) {
	              $(this).removeClass('hide').addClass('show');
	            }else{
	              $(this).addClass('hide').removeClass('show');
	            }
	          });
	        }else{
	          $('select#level_3 option').each(function(){
	            $(this).removeClass('hide').addClass('show');
	          });
	        }
	        $('select#level_3 option.show:first').prop('selected',true);
	    });
	});
    
</script>