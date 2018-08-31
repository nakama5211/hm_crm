<script type="text/javascript">
      $(".nav-tabs").on("click", "a", function (e) {
              e.preventDefault();
              if (!$(this).hasClass('add-contact')) {
                  $(this).tab('show');
              }
                })
                .on("click", ".fa-times", function () {
                  var id = $(".nav-tabs").children().length;
                  // alert(id);
                  var widthsub = window.top.$('.nav-insert').width() * 2;
                  var width = window.top.$('#lengthmenu').width() - widthsub;
                  if(id >4)
                  {
                      $("ul.nav-tabs li").each(function(){
                        $(this).attr('style', 'width:'+width/(id)+'px !important;');
                      });
                     
                  }
                  else{
                    $("ul.nav-tabs li").each(function(){
                        $(this).attr('style', 'width:170px !important;');
                      });
                  }
                  if(id >1)
                  {
                    var anchor = $(this).siblings('a');
                    $(anchor.attr('href')).remove();
                    $(this).parent().remove();
                    $('.nav-tabs li:nth-child(' + (id-1) + ') a').click();
                  }
       });
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
          $('a.app-menu__item').click(function(){
              $('a.app-menu__item').removeClass("active");
              $(this).addClass("active");
          });
</script>