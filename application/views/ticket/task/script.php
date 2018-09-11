<script type="text/javascript">
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
</script>