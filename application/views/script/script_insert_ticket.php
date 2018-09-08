<script type="text/javascript">
  $(document).ready(function(){
    var cus_res = $('input[name=customer]').val();
    if (cus_res) {
      var val = $('#suggestionList '+'option[data-value='+cus_res+']').html();
      $('#answerInput').val(val);
    }
    $('#createat,#sla,#duedate,#finishdate,#appointmentdate,#lastupdate').datetimepicker();

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

    $('select[name=agentgroup]').change(function(){
      var id = $(this).val();
      $('input#agentInput').val('');
      $('input[name=agentcurrent]').val('');
      $('datalist#suggestionListAgent option').each(function(){
        var group = $(this).attr('data-group');
        if (id!==group) {
          $(this).prop('disabled',true);
        }else{
          $(this).prop('disabled',false);
        }
        if (!id) {
          $(this).prop('disabled',false);
        }
      });
    });
  });

  $('.btn-insertTicket').click(function(){
        var form = $('#form-ticket')[0]; 
        var formData = new FormData(form);
        var agentcurrent = formData.get('agentcurrent');
        var agentgroup   = formData.get('agentgroup');
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
          if (agentcurrent=='' && agentgroup=='') {
            error['responsi'] = "Vui lòng nhập 1 trong 2 thông tin: Nhóm phụ trách, Người phụ trách.";
            parent.alertLog('Cảnh báo',error['responsi'],"warning");
          }
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
                   $(this).prop('disabled',false).find('i').removeClass().addClass('fa fa-share');
                   parent.alertLog("Cảnh báo !", data.message, "warning");
                }else{
                   // alert("thêm thành công.");
                   parent.alertLog("Thành công !", "Thêm phiếu thành công.", "success");
                    var tab = window.top.$('div.tab-pane.active').attr('id');
                    window.top.$('li a.nav-link[href="#'+tab+'"]').find('span').html('#'+data.data);
                   location.href= '<?php echo base_url().'/ticket/detail/';?>'+data.data;
                }
              },
              error: function(xhr, status, error) {
                console.log(error);
                $(this).prop('disabled',false).find('i').removeClass().addClass('fa fa-share');
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