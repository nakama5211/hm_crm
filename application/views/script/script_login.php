<script type="text/javascript">

  function login()
  {
    var username = $('#username').val();
            var password = $('#password').val();
            $.ajax({
              url: '<?php echo base_url().'login/post_login' ?>',
              type: 'POST',
              dataType: 'JSON',
              data: {username: username, password: password},
            })
            .done(function(data) {
              if(data.message == "Success")
              {
                  $("#custid").val(data.data[0].custid);
                  $("#groupid").val(data.data[0].groupid);
                  $("#telephone").val(data.data[0].telephone);
                  $("#custname").val(data.data[0].custname);
                  $("#avatar").val(data.data[0].avatar);
                  $("#roleid").val(data.data[0].roleid);
                  $("#idcard").val(data.data[0].idcard);
                  $("#username1").val(username);
                  $("#password1").val(password);
                 document.getElementById("myForm").submit();
              }
              else
              {
                swal("Thất Bại!", "Sai tên đăng nhập hoặc mật khẩu.", "error");
              }
                                })
            .fail(function() {
                swal("Thất Bại!", "Kiểm tra mạng.", "error");
            });
  }
  $('.login-input').keypress(function(e1){
   if(e1.keyCode==13){          // if user is hitting enter
       login();
   }
  });
	$('#btn_login').click(function(){
            login();
      });
</script>