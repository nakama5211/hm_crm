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
    $('#createat,#sla,#duedate,#finishdate,#appointmentdate,#lastupdate,input[name=req_date],input[name=fns_date]').datetimepicker();

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
        $('select#level_3 option.show:first').prop('selected',true);
        var log1 = $('select#level_3').attr('log');
        if (log1) {
          var text1 = $('select#level_3').find('option:selected').text();
          changelog(log1,text1);
        }
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

    var rights = $('select[name=ticketstatus] option:selected').attr('value');
    if (rights==4 || rights==9) {
      $('.crm-control,.crm-ext,textarea,button').prop('disabled',true);
    }
	});

  $('.data-list').on('input',function() {
    var selectedOption = $('._data option[value="'+$(this).val()+'"]');
    if(selectedOption.length>0){
      $(this).next().val(selectedOption.attr('id'));
    }
  });

  $('#_btn-task').click(function(){
    $('#_form-task').css('display','block');
  });

  $('#_cancel').click(function(){
    $('#_form-task').css('display','none');
  });

  $('#f_task').on('submit',function(){
    var form = new FormData($(this)[0]);
    var url = '<?php echo(base_url().'task/aj_api_insert');?>';
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
                console.log(data);
                var title = '#task'+data.data+'';
                var link =  '<?php echo(base_url('task/de_tail/'))?>';
                var row = 
                '\
                  <tr class="border-bot-1">\
                    <td width="150">\
                      <div class="flex">\
                        <span class="label-circle label-default span-default">\
                          <i class="fa fa-check"></i>\
                        </span> \
                        <div class="task-user-name">'+form.get('realname')+'</div>\
                      </div>\
                    </td>\
                    <td width="300">\
                      <a class="new_tab" onclick="addTab('+link+','+title+')" href="#">'+form.get('title')+'</a>\
                    </td>\
                    <td>'+form.get('fns_date')+'</td>\
                  </tr>\
                ';
                $('#_tb-task tbody').prepend(row);
                $('#_form-task').css('display','none');
                var str = $('#_count-task').html(); 
                var count = str.match(/\d+/)[0];
                count = parseInt(count)+1;
                $('#_count-task').html(count+' công việc');
              }
            },
            error: function(xhr, status, error) {
              console.log(error);
            }
        });

        return false;
  });


   $('#btn-update').click(function(){
      var ticketid = $(this).attr('ticketid');
      var customer_request = $('#customer_request').val();
      var agentcurrent= $('#agentcurrent').val();
      if(!agentcurrent){
        alert('Người phụ trách chưa đúng');
        return false;
      }
      var ticketchannel = $('#ticketchannel').val();
      var status = $('#ticketstatus').val();
      var cmt = $('#action').val();
      var priority = $('#priority').val();
      var title = $('#title').val();
      var bds = $('#bds').val();
      var duan = $('#duan').val();
      var gd = $('#giaodich').val();
      var dot = $('#dot').val();
      var sla = $('#sla').val();
      if(sla_change){
        var oldchange = $('#changelog').val();
        oldchange += "Thời hạn SLA : "+$('#sla').val()+" | ";
        $('#changelog').val(oldchange);
      }
      var type = $('#type').val();
      var levelticket = $('#levelticket').val();
      var duedate = $('#duedate').val();
      if(duedate_change){
        var oldchange = $('#changelog').val();
        oldchange += "Ngày hẹn : "+duedate+" | ";
        $('#changelog').val(oldchange);
      }
      var finishdate = $('#finishdate').val();
      if(finish_change){
        var oldchange = $('#changelog').val();
        oldchange += "Ngày hoàn thành : "+finishdate+" | ";
        $('#changelog').val(oldchange);
      }
      var type = $('#type').val();
      var levelticket = $('#levelticket').val();
      var ticketusers = $('#ticketusers').val();
      var changelog = $('#changelog').val();
       $.ajax({
              url: '<?php echo base_url().'ticket/updateTicketNew' ?>',
              type: 'POST',
              dataType: 'JSON',
              data: {ticketid:ticketid,crequest:customer_request,agentcurrent: agentcurrent, priority: priority,bds:bds,gd:gd,duan:duan,dot:dot,ticketchannel:ticketchannel,sla:sla,duedate:duedate,type:type,levelticket:levelticket,finishdate:finishdate,cmt:cmt,ticketusers:ticketusers,changelog:changelog,status:status},
            })
            .done(function(data) {
                if(data.code==1){
                  window.location.reload();
                }else{
                  alert(data.message);
                }
              })
            .fail(function() {
               alert('Lỗi hệ thống, vui lòng liên hệ Admin');
            });
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

  
   $('.btn-updateActionUpdate').click(function(){
      var ticketid = $(this).attr('title');
      var action= $('#action').val();
       $.ajax({
              url: '<?php echo base_url().'ticket/updateTicketLog' ?>',
              type: 'POST',
              dataType: 'JSON',
              data: {cmt:action,ticketid:ticketid},
            })
            .done(function(data) {
                if(data.code==1){
                  window.location.reload();
                }else{
                  alert(data.message);
                }
              })
            .fail(function() {
               alert('Lỗi hệ thống, vui lòng liên hệ Admin');
            });
  });

  $(document).on('change','.crm-control,.crm-ext',function(){
    $('.btn-updateAction').html('<i class="fa fa-share"></i> Cập nhật phiếu');
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

  $('.btn-updateAction').click(function(){
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
    var changelog = $('#changelog').val();
    var tckuser = $('#ticketusers').val();
    var agentcurrent = $('#agentcurrent').val();
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
    if (agentcurrent == '') {
      parent.alertLog('Cảnh báo','Bạn phải chọn người phụ trách.','warning');
    }else{
      $(this).prop('disabled',true).find('i').removeClass().addClass('fa fa-spin fa-spinner');
      $.ajax( {
        processData: false,
        contentType: false,
        data: form,
        type:"POST",
        dataType: 'json',
        url: '<?php echo base_url('ticket/aj_update_ticket');?>',
        success: function( data ){
           console.log(data);
           if(data.code==1){
            window.location.reload();
          }else{
            alert(data.message);
          }
        },error: function(xhr, status, error) {
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
                                          <input class="form-control margin-top-10 margin-bot-5" type="text" placeholder="Nhập ID hoặc Tiêu đề phiếu để tìm kiếm" list="tck_lst">\
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
</script>