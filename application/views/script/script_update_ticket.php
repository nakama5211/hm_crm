<script type="text/javascript">
	$(document).ready( function () {
    var ticketchannel = '<?php echo $ticket['data'][0]['ticketchannel'] ?>';
    var status = '<?php echo $ticket['data'][0]['status'] ?>';
    if(ticketchannel != '')
    {
		$('#ticketchannel').val(ticketchannel);
    }
    if(status != '')
    {
		$('#status').val(status);
    }
    $('#sla,#duedate,#finishdate,#appointmentdate,input[name=req_date],input[name=fns_date],input[name=firstreply],input[name=requestdate]')
    .datetimepicker({format:'d/m/Y H:i'});

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
        $('select#level_2 option.show:first').prop('selected',true); $('select#level_2').removeClass('changed').addClass('changed');
        $('select#level_3 option.show:first').prop('selected',true); $('select#level_3').removeClass('changed').addClass('changed');

        var log = $('select#level_2').attr('log');
        if (log) {
          var text = $('select#level_2').find('option:selected').text();
          changelog(log,text);
        }

        var log1 = $('select#level_3').attr('log');
        if (log1) {
          var text1 = $('select#level_3').find('option:selected').text();
          changelog(log1,text1);
        }
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
        $('select#level_3 option.show:first').prop('selected',true); $('select#level_3').removeClass('changed').addClass('changed');
        var log1 = $('select#level_3').attr('log');
        if (log1) {
          var text1 = $('select#level_3').find('option:selected').text();
          changelog(log1,text1);
        }
    });

    $('.data-list').on('input',function() {
      var datalist = $(this).attr('list');
      var selectedOption = $('#'+datalist+' option[value="'+$(this).val()+'"]');
      if(selectedOption.length>0){
        $(this).next().val(selectedOption.attr('id')).removeClass('changed').addClass('changed');
      }else{
        $(this).next().val('').removeClass('changed').addClass('changed');
      }
    });

    $('select[name=agentgroup]').change(function(){
      var id = $(this).val();
      $('input[list="l_agentcurrent"]').val('');
      $('input[name=agentcurrent]').val('');
      $('datalist#l_agentcurrent option').each(function(){
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

    var rights = $('select[name=ticketstatus] option:selected').attr('value');
    if (rights==4 || rights==9) {
      $('.crm-control,.crm-ext,textarea,.btn-updateAction,.btn-updateActionUpdate').prop('disabled',true);
    }

    var agentcurrent = $('input[name=agentcurrent]').val();
    if (agentcurrent) {
      $('#btn-accept').remove();
    }else{
      $('.crm-control,.crm-ext').prop('disabled',true);
    }
	});
  $('#table-23').DataTable( {
    "ajax": "<?php echo base_url('ticket/recent_contract/'.$param['idcard']);?>",
    "paging":         false,
    "info":           false,
    "searching":      false,
    "scrollY":        false,
    "scrollX":        false,
    "scrollCollapse": false,
    "ordering": false,
    "processing": true,
    'language':{ 
       "loadingRecords": "<img style='width:50px; height:50px;' src='<?php echo base_url().'images/ajax-loading.gif' ?>' />"
    },
    "initComplete": function(settings, json){ 
        this.find('thead').css("display","none");
        this.fnAdjustColumnSizing(true);
        $(this).find('tbody td').css('padding','2px 8px');
    }
  });
  $('#table-22').DataTable( {
    "ajax": "<?php echo base_url('ticket/recent_ticket/'.$this->uri->segment(4).'/'.$this->session->userdata('custid').'/'.$param['idcard'])?>",
    "paging":         false,
    "info":           false,
    "searching":      false,
    "scrollY":        false,
    "scrollX":        false,
    "scrollCollapse": false,
    "ordering": false,
    "processing": true,
    'language':{ 
       "loadingRecords": "<img style='width:50px; height:50px;' src='<?php echo base_url().'images/ajax-loading.gif' ?>' />"
    },
    "initComplete": function(settings, json){ 
        this.find('thead').css("display","none");
        this.fnAdjustColumnSizing(true);
        $(this).find('tbody td').css('padding','2px 8px');
    }
  });
  $('.data-list').on('input',function() {
    var selectedOption = $('._data option[value="'+$(this).val()+'"]');
    if(selectedOption.length>0){
      $(this).next().val(selectedOption.attr('id'));
    }
  });

  $(document).on('change','.crm-control,.crm-ext',function(){
    // $('.btn-updateAction').html('<i class="fa fa-share"></i> Cập nhật phiếu');
    $(this).addClass('changed');
    var log = $(this).attr('log');
    if (log) {
      var text = $(this).find('option:selected').text();
      if (!text) {
        text = $(this).val();
      }
      changelog(log,text);
    }
    
  });

  $('.btn-updateActionUpdate').click(function(){
    var cur = $(this);
    var ticketid = $(this).attr('title');
    var cmt= $('#action').val();
    if (cmt=='') {
      parent.alertLog('Cảnh báo','Bạn chưa nhập ghi chú cho phiếu.','warning');
    }else{
      cur.prop('disabled',true).find('i').removeClass().addClass('fa fa-spin fa-spinner');
     $.ajax({
        url: '<?php echo base_url().'ticket/updateTicketLog' ?>',
        type: 'POST',
        dataType: 'JSON',
        data: {cmt:cmt,ticketid:ticketid},
      })
      .done(function(data) {
          cur.prop('disabled',false).find('i').removeClass().addClass('fa fa-share');
          if(data.code==1){
            $('#action').val('');
            var iframe = window.tck_log;
            iframe.location.reload();
            parent.notification("OK");
            iframe.onload = function() {
             alert('myframe is loaded'); 
            }; // before setting 'src'
          }else{
            alert(data.message);
          }
        })
      .fail(function() {
         cur.prop('disabled',false).find('i').removeClass().addClass('fa fa-share');
         alert('Lỗi hệ thống, vui lòng liên hệ Admin');
      });
    }
  });

  $('.btn-updateAction').click(function(){
    var cur = $(this);
    var ticketid = $(this).attr('title');
    var form = new FormData();
    form.set('ticketid',ticketid);

    $('input.crm-ext,input.crm-control.changed').each(function(){
      var name = $(this).attr('name');
      var value = $(this).val();
      if (value) {
        console.log(value);
        form.set(name,value);
      }else{
        form.set(name,'');
      }
    });
    $('select.crm-ext,select.crm-control.changed').each(function(){
      var name = $(this).attr('name');
      value = $(this).find('option:selected').val();
      if (value) {
        console.log(value);
        form.set(name,value);
      }else{
        form.set(name,'');
      }
    });

    var cmt = $('#action').val();
    var agentgroup = $('select[name="agentgroup"]').val();
    var changelog = $('#changelog').val();
    var tckuser = $('#ticketusers').val();
    var agentcurrent = $('input[name="agentcurrent"]').val();
    var title = $('#title').val();
    var agentcurrentold = $('#agentcurrentold').val();
    var ticketusersold = $('#ticketusers').val();
    form.set('cmt',cmt);
    form.set('changelog',changelog);
    form.set('ticketusers',tckuser);
    form.set('title',title);

    if(agentcurrentold != agentcurrent)
    {
      form.set('agentcurrent',agentcurrent);
      form.set('ticketusers',ticketusersold+','+agentcurrent);
    }
    if (agentcurrent == '' && agentgroup == '') {
      parent.alertLog('Cảnh báo','Bạn phải điền 1 trong 2 thông tin: Người phụ trách, Nhóm phụ trách.','warning');
    }else{
      cur.prop('disabled',true).find('i').removeClass().addClass('fa fa-spin fa-spinner');
      $.ajax( {
        processData: false,
        contentType: false,
        data: form,
        type:"POST",
        dataType: 'json',
        url: '<?php echo base_url('ticket/aj_update_ticket');?>',
        success: function( data ){
          cur.prop('disabled',false).find('i').removeClass().addClass('fa fa-share');
          console.log(data);
          if(data.code==1){
            // $('#changelog').val('');
            // var iframe = window.tck_log;
            // iframe.location.reload();
            // iframe.onload = function() {
            //  alert('myframe is loaded'); 
            // }; // before setting 'src'
            parent.alertLog('Thành công.','Cập nhật thông tin thành công.','success');
            window.location.reload();
          }else{
            parent.alertLog("Cảnh báo",data.message,'warning');
          }
        },error: function(xhr, status, error) {
          cur.prop('disabled',false).find('i').removeClass().addClass('fa fa-share');
          console.log(error);
        }
      });
    }
    // for(var pair of form.entries()) {
    //   console.log(pair[0]+ ', '+ pair[1]); 
    // }
  });

  $('#btn-ticket-merge').click(function(){
    var old_ticketid = $(this).attr('tck-id'),new_ticketid='';
    var old_status   = $(this).attr('tck-stt');
    var old_title    = $(this).attr('tck-title');
    var stt_cls   = "danger",stt_txt = "OPEN";
    if (old_status==0) {stt_cls="warning";stt_txt="PENDDING"}
    if (old_status==4) {stt_cls="success";stt_txt="SUCCESS"}

    var modal = createModal();
    modal.modal("show").on("hidden", function(){
          modal.remove();
    });
    $.ajax({
      url: '<?php echo base_url().'api/aj_tck_id_title';?>',
      type: 'GET',
      dataType: 'JSON',
    })
    .done(function(data) {
        if(data){
          // console.log(data);
          var option = '';
          for (var i = 0; i < data.length; i++) {
            option += '<option status="'+data[i]['status']+'" value="'+data[i]['ticketid']+'">'+data[i]['title']+'</option>';
          }
          modal.find('.modal-body').html('<div class="table-responsive">\
                                        <table class="table margin-bot-5 table1" id="table-1">\
                                            <tbody>\
                                              <tr class="no-border">\
                                                <td class="no-border" width="150">\
                                                  <span class="id-label span-'+stt_cls+'">'+stt_txt+'</span>  #Ticket '+old_ticketid+'\
                                                </td>\
                                                <td class="no-border">\
                                                  '+old_title+'\
                                                </td>\
                                                \
                                              </tr>\
                                            </tbody>\
                                        </table>\
                                    </div>\
                                    <p>Tìm phiếu cần ghép</p>\
                                    <div id="call-input">\
                                          <input class="form-control margin-top-10 margin-bot-5" type="number" placeholder="Nhập ID phiếu để tìm kiếm" list="tck_lst">\
                                          <datalist id="tck_lst">\
                                            '+option+'\
                                          </datalist>\
                                    </div>\
                                    <div class="table-responsive">\
                                        <table class="table margin-bot-5 table2" id="table-1">\
                                            <tbody>\
                                            </tbody>\
                                        </table>\
                                    </div>');
          modal.find('input').on('keyup',function(){
            var val = $(this).val();
            var opt = modal.find('option[value="'+val+'"]');
            console.log(opt);
            if (opt.length>0) {
              var tck_id    = new_ticketid = opt.attr('value');
              var tck_title = opt.html();
              var tck_stt   = opt.attr('status');
              var stt_cls   = "danger",stt_txt = "OPEN";
              if (tck_stt==0) {stt_cls="warning";stt_txt="PENDDING"}
              if (tck_stt==4) {stt_cls="success";stt_txt="SUCCESS"}
              modal.find('.modal-body table.table2 tbody').html('<tr class="no-border">\
                                                <td class="no-border" width="150">\
                                                  <span class="id-label span-'+stt_cls+'">'+stt_txt+'</span>  #Ticket '+tck_id+'\
                                                </td>\
                                                <td class="no-border">\
                                                  '+tck_title+'\
                                                </td>\
                                              </tr>');
            }
          });

          modal.find('button#submit').click(function(){
            var cur = $(this);
            if (new_ticketid=='') {
              alert("Vui lòng chọn 1 ticket.");
            }else{
              modal.find('button').prop('disabled',true);
              cur.find('i').addClass('fa fa-spinner fa-spin');
            $.ajax({
                  url: '<?php echo base_url().'api/aj_merge_ticket';?>',
                  type: 'POST',
                  dataType: 'JSON',
                  data: {oldticket:old_ticketid,newticket:new_ticketid},
                })
                .done(function(data) {
                    console.log(data);
                    if (data.code==1) {
                      console.log('ok');
                      modal.find('button').prop('disabled',false);
                      modal.find('button#remove').click();
                      parent.notification("Ghép phiếu thành công");
                    }else{
                      modal.find('button').prop('disabled',false);
                      cur.find('i').removeClass('fa fa-spinner fa-spin');
                    }
                  })
                .fail(function() {
                   modal.find('button').prop('disabled',false);
                   cur.find('i').removeClass('fa fa-spinner fa-spin');
                   alert('error');
                });
            }
          });
        }
      })
    .fail(function() {
       alert('Kết nối dữ liệu tới server thất bại, vui lòng liên hệ bộ phận IT để được hỗ trợ.');
    });
  });

  $('#btn-accept').click(function(){
    var cur = $(this);
    var tckid = $(this).attr('tckid');
    if (tckid)
    cur.prop('disabled',true).find('i').removeClass().addClass('fa fa-spin fa-spinner');
    $.ajax({
        url: '<?php echo base_url().'ticket/get_to_my_ticket/'?>'+tckid,
        type: 'POST',
        dataType: 'JSON',
      })
      .done(function(data) {
          if(data.code==1){
            parent.notification('Tiếp nhận phiếu thành công.');
            window.location.reload();
          }else{
            parent.alertLog('Lỗi',data.message,'danger');
            // alert(data.message);
          }
        })
      .fail(function() {
         cur.prop('disabled',false).find('i').removeClass().addClass('fa fa-share');
         alert('Lỗi hệ thống, vui lòng liên hệ Admin');
      });
  });

  function createModal(){
    var modal = $(
            '<div class="modal fade">\
                  <div class="modal-dialog" role="document" style="top:15%;">\
                        <div class="modal-content">\
                              <div class="modal-header">\
                                    <h5 class="modal-title">Ghép vào một phiếu khác</h5>\
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>\
                              </div>\
                              <div class="modal-body relative">\
                                    <i class="fa fa-spinner fa-spin" style="position:absolute;top:30%;left:49%;font-size:18px;"></i>\
                              </div>\
                              <div class="modal-footer">\
                                    <button class="btn btn-primary btn-89" type="button" id="remove" data-dismiss="modal">Hủy</button>\
                                    <button class="btn btn-secondary btn-89" type="button" id="submit"><i></i>Ghép</button>\
                              </div>\
                        </div>\
                  </div>\
            </div>');  
    return modal;
  }

  function changelog(log,text){
    var oldchange = $('#changelog').val();
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
    console.log(newchange);
    $('#changelog').val(newchange);
    return false;
  }

  function showDetailKnowledge(id){
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