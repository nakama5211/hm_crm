<script type="text/javascript">
		$(document).ready(function(){

			$('.knl-caret').click(function(){
				var caret = $('.fa-angle-double-down');
				if (caret.length>0) {
					$('.knl-caret').removeClass('fa-angle-double-down');
					$('.knl-caret').addClass('fa-angle-double-up');
				}else{
					$('.knl-caret').addClass('fa-angle-double-down');
					$('.knl-caret').removeClass('fa-angle-double-up');
				}
				$(".knl-board").slideToggle("slow");
			});

			$('i.search-knowledge').click(function(){
				search();
			});

			$('#knl-btn-back').click(function(){
				$('.knl-content').css('display','none');
                $('#knl_list').css('display','block');
			});

			$('input[name="knl_text"]').keypress(function(e){
			    if(e.keyCode==13){          // if user is hitting enter
			       search();
			    }
		  	});
			function search(){
				var text = $('input[name="knl_text"]').val();
				if ($('.knl-caret').hasClass('fa-angle-double-up')) {$('.knl-caret').trigger('click');}
				var url = '<?php echo base_url().'knowledge/fulltext?search='?>'+text;
				if (text!='' && text.length<=50) {
					$('.knl-content').css('display','none');
                	$('#knl_list').html('Đang tải dữ liệu...').css('display','block');
					$.ajax({
			          url: url,
			          type: 'GET',
			          dataType: 'JSON'
			        })
			        .done(function(data) {
			          console.log(data);
			          var div = '';
			          if(data){
			          for (var i = 0; i < data.length; i++) {
			          	div+='<p><a style="cursor: pointer; color: #009688" onclick="showDetailKnowledge('+data[i]['id']+')">#'+data[i]['title']+'</a></p>';
			          	// if (i==2) {break;}
			          }
			          if (div!='') {
			          	$('#knl_list').html(div).css('display','block');
			          }else{
			          	$('#knl_list').html('Không tìm thấy kết quả nào.');
			          }
			          }else {$('#knl_list').html('Không tìm thấy kết quả nào.');}
			        })
			        .fail(function() {
			            alert('Lỗi hệ thống,vui lòng liên hệ admin để được hỗ trợ');
			        });
				}else if(text.length>50){
					alert('Chiều dài không được quá 50 ký tự.');
				}else{
					alert('Vui lòng điền vào từ khóa.');
				}
			}
		});
</script>