<script src="<?php echo base_url('callevent/node_modules/socket.io-client/dist/socket.io.js');?>"></script>
<script>

    var timer=null,record=null;
    $(document).ready(function(){

    	var socket = io.connect( 'http://'+window.location.hostname+':3000' ,{ query: "custid=C0001<?php echo($this->session->userdata('telephone')!=null?'&phone='.$this->session->userdata('telephone'):'')?>" });
      socket.on('connect', function () {
        clientid = socket.id;
        $('#phone-chat').attr('extension',"<?php echo($this->session->userdata('telephone')!=null?$this->session->userdata('telephone'):'')?>");
        // socket.emit('new_client', { 
        //     name: getRandomName(),
        //     phone: getRandomNumber(),
        //     id: clientid
        //   });
      });
    	socket.on( 'new_connect', function( data ) {
  
      		console.log(data);

  		});

      socket.on('object_event',function(data){
        // console.log(data);
      });

      // $.post(
      //   "http://"+window.location.hostname+":3000/call",
      //   {
      //     name: getRandomName(),
      //     phone: getRandomNumber()
      //   },
      //   function(data){
      //     console.log(data);
      // });

      function getRandomName() {
            const arr = ["Lê Hưng", "Văn Nam", "Khang Thanh", "Gia Gia", "Bảo Bảo", "Thới Hòa", "TRung THông", "Đà An", "Lái Siêu", "Đại Bản"];
            return arr[Math.floor(Math.random() * arr.length)];
        }

        function getRandomNumber() {
            const arr = ["2455","7895","1230","4587","7849","2368","7842","8953","7412","5687"];
            return arr[Math.floor(Math.random() * arr.length)];
        }

  		socket.on( 'disconnect_client', function( data ) {
  
      		console.log(data);
          $("#node-view").find('button[id="'+data.client+'"]').remove();
  		});

  		socket.on( 'new_client', function( data ) {
  
      		console.log(data);
          $("#node-view").append('<button class="btn btn-primary btn-call" type="button" id="'+data.id+'">'+data.name+' - '+data.phone+'</button> ');
  		});
      socket.on('e_ringing',function(data){
            console.log(data);
            save_call_log("call","ringing",data);
            var phone = data.fromnumber;
            var p_data = {};
            $('#phone-chat').css('display','block');
            hideScreen(0,p_data);
            start_timer('#has-call-pad #c-time');
            p_data['phone'] = phone;
            p_data['channel'] = data.channel;
            $.ajax({
                    type: "GET",
                    url: 'http://'+window.location.hostname+'/api/get_infor_user/'+phone,
                    dataType: "json",
                    success: function(data){
                      if (data.data!=null) {
                        var rec = data.data[0];
                        console.log(rec);
                        p_data['avatar'] = rec.avatar;
                        p_data['custname'] = rec.custname;
                        p_data['custid'] = rec.custid;
                        p_data['phone_act'] = 'newtab';
                        hideScreen(0,p_data);
                      }else{
                        p_data['avatar'] = null;
                        p_data['custname'] = "---";
                        p_data['phone_act'] = 'newuser';
                        hideScreen(0,p_data);
                      }
                    },error: function(xhr, status, error) {
                      console.log(error);
                      p_data['avatar'] = null;
                      p_data['custname'] = "---";
                      p_data['phone_act'] = 'newuser';
                      hideScreen(0,p_data);
                    }
                  });
        });
      socket.on('e_answered',function(data){

            console.log('e_answered');
            console.log(data);
            save_call_log("call","answered",data);

            var phone = data.fromnumber;
            var callrefid = data.callrefid;
            var p_data = {};
            var act = $('#has-call-pad #c-number').attr('act');
            var custid = $('#has-call-pad #c-number').attr('custid');
            console.log(act+'-'+custid+'-'+phone);


            p_data['phone'] = phone;
            p_data['channel'] = data.channel;
            p_data['custid'] = custid;

            $('#phone-chat').css('display','block');
            hideScreen(1,p_data);
            start_record('#has-call-pad #c-record');
            


            if (act) {
              if (act=='newtab'&&custid) {
                showNewTab(phone);
                $.ajax({
                  type: "POST",
                  url: 'http://'+window.location.hostname+'/api/aj_crm_isrt_ticket/',
                  dataType: "json",
                  data:{
                    ticketchanel:2,
                    agentcreated:'<?php echo($this->session->userdata('custid'))?>',
                    custid:custid,
                    priority:1,
                    phone:phone,
                    callrefid:callrefid
                  },
                  success: function(data){
                    console.log(data);
                    p_data['ticket'] = data.data;
                    hideScreen(1,p_data);
                    showTicketTab(data.data);
                  },error: function(xhr, status, error) {
                    console.log(error);
                    alert(error);
                  }
                });
              }else if(act=='newuser'){
                $.ajax({
                        type: "GET",
                        url: 'http://'+window.location.hostname+'/api/aj_tvc_isrt_user/'+phone,
                        dataType: "json",
                        success: function(data){
                          console.log(data);
                          if (data.code==1) {
                            showNewTab(phone);
                            $.ajax({
                              type: "POST",
                              url: 'http://'+window.location.hostname+'/api/aj_crm_isrt_ticket/',
                              dataType: "json",
                              data:{
                                ticketchanel:2,
                                agentcreated:'<?php echo($this->session->userdata('custid'))?>',
                                custid:data.custid,
                                priority:1,
                                phone:phone,
                                callrefid:callrefid
                              },
                              success: function(data){
                                console.log(data);
                                p_data['ticket'] = data.data;
                                hideScreen(1,p_data);
                                showTicketTab(data.data);
                              },error: function(xhr, status, error) {
                                console.log(error);
                                alert(error);
                              }
                            });
                          }
                        },error: function(xhr, status, error) {
                          console.log(error);
                          alert(error);
                        }
                      });
              }
            }
      });



      // e_answered event
      socket.on('e_completed',function(data){
            console.log('e_completed');
            console.log(data);
            save_call_log("call","completed",data);
            // $('#phone-chat').css('display','block');
            // hideScreen(1,data.fromnumber);

            var phone = data.fromnumber;
            var tonum = data.tonumber;
            var callrefid = data.callrefid;
            var record = data.recording_file;
            var duration = data.billsec;
            var custid = $('#has-call-pad #c-number').attr('custid');
            var ticketid = $('#has-call-pad #c-ticket').attr('ticketid');
            console.log(ticketid);
            $.ajax({
                  type: "POST",
                  url: 'http://'+window.location.hostname+'/api/aj_crm_isrt_tcklog/',
                  dataType: "json",
                  data:{
                    ticketid:ticketid,
                    agentcreated:'<?php echo($this->session->userdata('custid'))?>',
                    custid:custid,
                    phone:phone,
                    callrefid:callrefid,
                    record:record,
                    duration:duration,
                    tonum:tonum
                  },
                  success: function(data){
                    console.log(data);
                  },error: function(xhr, status, error) {
                    console.log(error);
                    alert(error);
                  }
                });
      });





      socket.on('e_misscall',function(data){
        console.log('e_misscall');
            console.log(data);
            save_call_log("call","misscall",data);
            $('#phone-chat').css('display','block');
            hideScreen(1,data.fromnumber);
      });
      socket.on('e_hangup',function(data){
        console.log('e_hangup');
            console.log(data);
            save_call_log("call","hangup",data);
            $('#phone-chat').css('display','block');
            hideScreen(5,data.fromnumber);
      });
      socket.on('e_customer_hangup',function(data){
        console.log('e_customer_hangup');
        console.log(data);
        save_call_log("call","hangup",data);
        $('#phone-chat').css('display','block');
        hideScreen(5,data.fromnumber);
      });
      socket.on('e_customer_answered',function(data){
          console.log('e_cusomter_answered');
          console.log(data);

          save_call_log("call","answered",data);
          var phone = data.tonumber;
          var extension = data.fromnumber;
          var p_data = {};
          p_data['phone'] = phone;

          p_data['channel'] = data.channel;
          p_data['ticket'] = "-----";
          p_data['calltype'] = "Cuộc gọi đi";
          if (extension=='<?php echo($this->session->userdata('telephone'));?>') {
            $('#phone-chat').css('display','block');
            hideScreen(9,p_data);
          }
          stop_timer();
          start_record('#has-call-pad #c-record');
      });

      socket.on('e_misscall_outbound',function(data){
        console.log(data);
        save_call_log("call","misscall",data);
      });

      socket.on('e_completed_outbound',function(data){
        console.log(data);
        save_call_log("call","completed",data);
        var phone = data.fromnumber;
            var tonum = data.tonumber;
            var callrefid = data.callrefid;
            var record = data.recording_file;
            var duration = data.billsec;
            var custid = $('#has-call-pad #c-number').attr('custid');
            var ticketid = $('#has-call-pad #c-ticket').attr('ticketid');
            console.log(ticketid);
            $.ajax({
                  type: "POST",
                  url: 'http://'+window.location.hostname+'/api/aj_crm_isrt_tcklog/',
                  dataType: "json",
                  data:{
                    ticketid:ticketid,
                    agentcreated:'<?php echo($this->session->userdata('custid'))?>',
                    custid:custid,
                    phone:phone,
                    callrefid:callrefid,
                    record:record,
                    duration:duration,
                    tonum:tonum
                  },
                  success: function(data){
                    console.log(data);
                  },error: function(xhr, status, error) {
                    console.log(error);
                    alert(error);
                  }
                });
      });

      socket.on('e_ringing_outbound',function(data){
        console.log(data);
        save_call_log("call","ringing",data);
        var p_data = [];
        p_data['phone'] = data.tonumber;
        p_data['channel'] = data.channel;
        p_data['avatar'] = null;
        p_data['custname'] = "---";
        hideScreen(8,p_data);
        start_timer('#has-call-pad #c-time');
      });

      socket.on('e_not_inuse',function(data){
        console.log(data);
        var status = $('#phone-chat').css("display");
        console.log(status);
        if (status == "block") {
          console.log(status);
          hideScreen(5);
        }
      });

      $(document).on('click','#c-number',function(){

      });

      
      $(document).on('click','.btn-call',function(){
        var id = $(this).attr('id');
        socket.emit('to_target',id,{event:"ringing"});
      });

      $(document).on('click','#deny-call,#are-b-end a',function(){
        var channel = $('#c-chanel #channel').attr('channel');
        stop_timer();
        start_record();
        if (channel!='Kênh thoại') {
          console.log(channel);
          $.ajax({
                    type: "GET",
                    url: 'http://'+window.location.hostname+'/api/aj_mitek_hang_up/'+channel,
                    dataType: "json",
                    success: function(data){
                      console.log(data);
                    },error: function(xhr, status, error) {
                      console.log(error);
                    }
                  });
        }else{
          hideScreen(5,{});
        }
      });

      $(document).on('click','#are-b-call a',function(){
        var extension = $('#phone-chat').attr('extension');
        var phone = $('#user-call-search').val();
        var p_data = [];
        if (phone) {
          p_data['phone'] = phone;
          p_data['channel'] = '';
          p_data['avatar'] = null;
          p_data['custname'] = "---";
          p_data['ticket'] = "-----";
          // p_data['phone_act'] = 'newuser';
          hideScreen(7,p_data);
          api_call_to_number(extension,phone);
          $.ajax({
            type: "GET",
            url: 'http://'+window.location.hostname+'/api/get_infor_user/'+phone,
            dataType: "json",
            success: function(data){
              if (data.data!=null) {
                var rec = data.data[0];
                console.log(rec);
                p_data['avatar'] = rec.avatar;
                p_data['custname'] = rec.custname;
                p_data['custid'] = rec.custid;
                p_data['phone_act'] = 'newtab';
                hideScreen(7,p_data);
              }
            },error: function(xhr, status, error) {
              console.log(error);
            }
          });
        }
      });

      $("#user-call-search").on("keyup", function(e){
        if (e.which == 13){
            var text = $(this).val();
            var notif = $(this).parent().find('ul#s-rst');
            if (text !== ""){
                console.log(text);    
                $(this).val('');
                $('#call-input').css('display','block');
            }else{
                $('#call-input').css('display','none');
            }
        }
      });

      $("#status-options ul li").click(function(){
        $("#status-options ul li").each(function(){
            if ($(this).hasClass('active')) {
                $(this).removeClass('active');
            }
        });
        $(this).addClass('active');
        var stt = $(this).attr('id');
        var txt = $(this).find('p').html();
        $("#status-selection").removeClass().addClass(stt).find('p').html(txt);
      });

      $(document).on('click','.s-rst-li',function(){
        var act = $(this).closest('ul').attr('action');
        var extension = $('#phone-chat').attr('extension');
        var phone = $(this).find('.user-num').html();
        var channel = $('#c-chanel #channel').attr('channel');
        if (act=='call') {
          hideScreen(7);
          api_call_to_number(extension,phone);
        }else if(act=='tranfer'){
          api_tranfer_to_extension(phone,channel);
          hideScreen(3);
        }
      });

      $(document).on('click','#direct-call',function(){
        var p_data = {};
        p_data['channel'] = $('#c-chanel #channel').attr('channel');
        p_data['avatar'] = $('#has-call-pad').find('#c-avatar').find('img').attr('src');
        p_data['custname'] = $('#has-call-pad').find('#c-name').html();
        p_data['phone'] = $('#has-call-pad').find('#c-number').html();
        hideScreen(2,p_data);
      });

      $(document).on('click','#deny-direct',function(){
        
        hideScreen(2,p_data);
      });

      $(document).on('click','#call-direct',function(){
       
      });
  	});
  function api_call_to_number(extension,phone){
    $.ajax({
      type: "GET",
      url: 'http://'+window.location.hostname+'/api/aj_mitek_clicktocall/'+extension+'/'+phone,
      dataType: "json",
      success: function(data){
        console.log(data);
      },error: function(xhr, status, error) {
        console.log(error);
      }
    });
  }
  function api_tranfer_to_extension(extension,channel){
    $.ajax({
      type: "GET",
      url: 'http://'+window.location.hostname+'/api/aj_mitek_tranfer/'+extension+'/'+channel,
      dataType: "json",
      success: function(data){
        console.log(data);
      },error: function(xhr, status, error) {
        console.log(error);
      }
    });
  }
  function start_timer(element){
    var time = 0;
    stop_timer();
    timer = setInterval(countdown, 1000);
    function countdown() {
        if (time > 59 ) {
            clearTimeout(timer);
        }else{
          time++;
          $(element).html('Thời gian chờ: '+time+' s');
        }
    }
  }

  function stop_timer(){
    if (timer!=null) {clearTimeout(timer);timer=null}
  }

  function stop_record(){
    if (record!=null) {clearTimeout(record);record=null}
  }

  function start_record(element){
    var timer = 0, minutes, seconds;
    stop_record();
    record = setInterval(function () {
        minutes = parseInt(timer / 60, 10)
        seconds = parseInt(timer % 60, 10);

        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        $(element).html(minutes + ":" + seconds); 

        if (++timer > 300) {
            timer = 0;
        }
    }, 1000);
  }

  function save_call_log(object,event,data){
    $.ajax({
      type: "POST",
      url: 'http://'+window.location.hostname+'/api/save_call_log/',
      dataType: "json",
      data:{
        value:data,
        object:object,
        event:event
      },
      success: function(data){
        console.log(data);
      },error: function(xhr, status, error) {
        console.log(error);
        alert(error);
      }
    });
  }
  function iframe_click(number=undefined,ticket=undefined){
    var extension = $('#phone-chat').attr('extension');
        if (number && ticket) {
          api_call_to_number(extension,number);
          var p_data = [];
          p_data['phone'] = number;
          p_data['channel'] = '';
          p_data['avatar'] = null;
          p_data['custname'] = "---";
          p_data['ticket'] = ticket;
          // p_data['phone_act'] = 'newuser';
          $('#phone-chat').css("display","block");
          hideScreen(7,p_data);
          $.ajax({
            type: "GET",
            url: 'http://'+window.location.hostname+'/api/get_infor_user/'+number,
            dataType: "json",
            success: function(data){
              if (data.data!=null) {
                var rec = data.data[0];
                console.log(rec);
                p_data['avatar'] = rec.avatar;
                p_data['custname'] = rec.custname;
                p_data['custid'] = rec.custid;
                p_data['phone_act'] = 'newtab';
                hideScreen(7,p_data);
              }
            },error: function(xhr, status, error) {
              console.log(error);
            }
          });
        }
  }
</script>

<!-- https://api-popupcontact-02.mitek.vn/api/v1/call -->
<!-- ac97db2cca493ad87045946aed59eb29 -->