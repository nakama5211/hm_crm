<script type="text/javascript">
	$('.btn-creategroupuser').click(function(){
		 $.ajax({
        url: '<?php echo base_url()?>groupuser/groupuserinsert',
        type: 'POST',
        dataType: 'JSON',
        data: $('#dataInsertGroup').serialize(),
        // data: $('#insertUserVal').serialize(),
      })
      .done(function(data) {
                 if(data.message =='Success')
                 {
                  alert('Thêm nhóm người dùng thành công');
                    location.reload();
                 }
                 else{
                  alert(data.message);
                 }
              })
      .fail(function() {
         alert('Thêm nhóm người dùng thất bại');
      })
	});
</script>