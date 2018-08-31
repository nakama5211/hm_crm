<script type="text/javascript">
          $('#udpategroup_btn').click(function(){
               var groupid = $('#groupid').val();
          	   var ticketrule = $('#ticketrule').val();
          	   var taskrule = $('#taskrule').val();
          	   var userrule = $('#userrule').val();
          	   var knowledgerule = $('#knowledgerule').val();var status = $('#status').val()
          $.ajax({
             url: '<?php echo base_url().'groupuser/updategroup' ?>',
             type: 'POST',
             dataType: 'JSON',
             data: {groupid:groupid,ticketrule:ticketrule,taskrule:taskrule,userrule:userrule,knowledgerule:knowledgerule,status:status},
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

</script>