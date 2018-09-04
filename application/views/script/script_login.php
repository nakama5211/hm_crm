<script type="text/javascript">
  $(document).ready(function(){
    $('#login_form').on('submit',function(){
      var cur = $(this);
      var formData = new FormData($(this)[0]);

      for (var [key, value] of formData.entries()) { 
            // console.log(key, value);
      }
      cur.find('button[type=submit]').prop('disabled',true).find('i').removeClass().addClass('fa fa-spinner fa-spin');
      $.ajax({
      type: "POST",
        url: "<?php echo base_url().'login/post_login'?>",
        data:  formData,
        dataType:'json',
        contentType: false,
        cache: false,
        processData:false,
        beforeSend: function() {
        },
        success: function(data) {
          cur.find('button[type=submit]').prop('disabled',false).find('i').removeClass().addClass('fa fa-sign-in');
          if(data.message == "Success"){
            window.location.href = "<?php echo base_url().'login/login'?>";
          }else{
            swal("Lỗi !", "Sai tên đăng nhập hoặc mật khẩu.", "error");
          }

        },
        error: function(xhr, status, error) {
          cur.find('button[type=submit]').prop('disabled',false).find('i').removeClass().addClass('fa fa-sign-in');
          // swal("Lỗi !", "Vui lòng kiểm tra lại mạng.", "error");
          console.log(error);
        }
      });
      return false;
      });
  });
</script>