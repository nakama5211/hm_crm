<script type="text/javascript">
  $(document).ready(function(){
    var cus_res = $('input[name=customer]').val();
    if (cus_res) {
      var val = $('#suggestionList '+'option[data-value='+cus_res+']').html();
      $('#answerInput').val(val);
    }
    $('#createat,#sla,#duedate,#finishdate,#appointmentdate,#lastupdate').datetimepicker();
  });

  $('.btn-insertTicket').click(function(){
        var form = $('#form-ticket')[0]; 
        var formData = new FormData(form);
        var action = $('#action').val();
        var title = $('#title').val();
        var contractid = '<?php echo $this->uri->segment(3);?>'; formData.set('contractid',contractid);
        var error = [];
        if (title=='') {
          error['title'] = "Vui lòng nhập tiêu đề cho phiếu.";
          $('#title').addClass('error-input');
        }else{
          $('#title').removeClass('error-input');
          formData.set('title',title);
          formData.set('cmt',action);
        }
        // console.log(title);
        for (var [key, value] of formData.entries()) { 
            // console.log(key, value);
            switch(key){
              case 'customer':
                if (value=='') {
                  error[key] = "Vui lòng chọn người yêu cầu."
                  $('#answerInput').addClass('error-input');
                }else{
                  $('#answerInput').removeClass('error-input');
                }
                break;
              case 'agentcurrent':
                if (value=='') {
                  error[key] = "Vui lòng chọn người phụ trách."
                }
                break;
              default: break;
            }
        }
        // console.log(error);
        if (!jQuery.isEmptyObject(error)) {
          var msg = '';
          for (let key in error){
            msg+= error[key]+"\n";
          }
          // alert(msg);
        }else{
          $(this).prop('disabled',true).find('i').removeClass().addClass('fa fa-spin fa-spinner');
          $.ajax({
              type: "POST",
              url: "<?php echo base_url().'ticket/aj_insert_ticket';?>",
              data:  formData,
              dataType:'json',
              contentType: false,
              cache: false,
              processData:false,
              beforeSend: function() {
              },
              success: function(data) {
                if(data.code==0){
                   alert(data.message);
                }else{
                   // alert("thêm thành công.");
                   location.href= '<?php echo base_url().'/ticket/detail/';?>'+data.data;
                }
              },
              error: function(xhr, status, error) {
                console.log(error);
              }
          });
        }
  });
  function showDetailKnowledge(id)
   {
       var show = $('.knl-caret');
       if (show.hasClass('fa-angle-double-up')) {$('.knl-caret').trigger('click');}
       $('#knl_list').css('display','none');
       $('.knl-content').html("Đang tải dữ liệu...").css('display','block');
       $.ajax({
              url: '<?php echo base_url().'knowledge/detailKnowledge' ?>',
              type: 'POST',
              dataType: 'JSON',
              data: {id:id},
            })
            .done(function(data) {
                $('.knl-content').html(data.data[0].article).css('display','block');
                
              })
            .fail(function() {
               alert('Lỗi hệ thống, vui lòng liên hệ Admin');
            });
   }
</script>