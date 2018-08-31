<script type="text/javascript">
	
  $(document).ready( function () {
    loadFirst();
      });
    function loadFirst()
    {
      $('#roleid').val('<?php echo $detail[0]['roleid'] ?>');
      $('#gender').val('<?php echo $detail[0]['gender'] ?>');
      var load_roleid = $('#roleid').val();
      var idcard = '<?php echo strval($_GET['idcard']) ?>';
      loadGroup(load_roleid);
      $.ajax('http://crm.tavicosoft.com/api/get_list_contract',{
            'data': JSON.stringify({  
             "reportcode":"crmContract01","limit":25,"start":0,"queryFilters":{"idcard":idcard}
            }),
            'type': 'POST',
            'processData': false,
            'contentType': 'application/json' 
        })
          .done(function(data) {
                  $("#div-content-1").css('background', 'none');
            var data_html = '';
                 var obj = jQuery.parseJSON(data);
                 $("#tab1").text('Giao Dịch('+obj.result.data.length+')');
                 for (var i = 0; i < obj.result.data.length; i++) {
                  var t1 = new Date(obj.result.data[i].startdate);
                  var startdate = formatDMY(t1.getDate(),t1.getMonth()+1,t1.getFullYear());
                  var t2 = new Date(obj.result.data[i].effectivedate);
                  var effectivedate = formatDMY(t2.getDate(),t2.getMonth()+1,t2.getFullYear());
                  var custidCustomer = '<?php echo $this->input->get('cusid')?>' ;
                 var href = "'<?php echo base_url() ?>user/contract/"+obj.result.data[i].contractid+"/"+custidCustomer+"'";
                 var title = "'#"+obj.result.data[i].contractid+"'";
                 data_html+=' <tr>\
                          <td><a class="buttonnewiframe" onClick="addTab('+href+','+title+')" href="#">#'+obj.result.data[i].contractid+'</a>\
                                </td>\
                                <td>\
                                  '+obj.result.data[i].status+'\
                                </td>\
                                <td>'+obj.result.data[i].property+'</td>\
                                <td>'+startdate+'</td>\
                                <td>'+effectivedate+'</td>\
                                <td>'+obj.result.data[i].notes+'</td>\
                      </tr>';
                  }
                  $('#div-content-1').html('<table class="table table-striped table-bordered" cellspacing="0" id="table-1-contract">\
                          <thead>\
                    <tr>\
                        <th>Mã GD</th>\
                            <th>Tình trạng</th>\
                            <th>Mã căn hộ</th>\
                            <th>Ngày bắt đầu</th>\
                            <th>Ngày hiệu lực</th>\
                            <th>Ghi chú</th>\
                    </tr>\
                  </thead>\
                  <tbody>\
                    '+data_html+'\
                  </tbody>\
                        </table>');
                  $('#table-1-contract').DataTable({
                    "paging":   false,
                    "columns": [
                      { "width": "60px" },
                      { "width": "80px" },
                      { "width": "90px" },
                      { "width": "73px" },
                      { "width": "75px" },
                      { "width": "250px" }
                    ],
                    "info":     false,
                    "searching": false,
                    "scrollY":        "235px",
                    "scrollX":        true,
                    "scrollCollapse": true
                  });
              })
      .fail(function() {
        console.log('Load Fail!');
      })
    $('.btn-update').click(function(){
        var custid = '<?php echo strval($_GET['cusid']) ?>';
        var roleid = $('#roleid').val();
        var groupid = $('#groupid').val();
        var custname = $('#custname').val();
        var idcard = $('#idcard').val();
        var fullbirthday = $('#fullbirthday').val();
        var gender = $('#gender').val();
        var telephone = $('#telephone').val();
        var email = $('#email').val();
        var country = $('#country').val();
        var city = $('#city').val();
        var district = $('#district').val();
        var ward = $('#ward').val();
        var text = '';
        var address = $('#address').val();
        var comments = $('#comments').val();
        var thunhap = $('#thunhap').val();
        var fulladdress = $('#fulladdress').val();
        // var custid = $('#custid').val();
        var password = $('#password').val();
        var queue = $('#queue').val();
        var queueold = $('#queue_old').val();
        $.ajax({
        url: '<?php echo base_url()?>user/updateUser',
        type: 'POST',
        dataType: 'JSON',
        data: {roleid : roleid, groupid: groupid, custname:custname,idcard:idcard,fullbirthday:fullbirthday,telephone:telephone,email:email,country:country,city:city,district:district,ward:ward,address:address,comments:comments,thunhap:thunhap,gender:gender,fulladdress: fulladdress,custid:custid,password:password,queue:queue,queueold:queueold, ext:$('#dataExt').serialize()},
      })
      .done(function(data) {
                 if(data.message =='Success')
                 {
                  alert('Sửa thông tin thành công');
                    location.reload();
                 }
                 else{
                  alert(data.message);
                 }
              })
      .fail(function() {
         alert('Sửa thông tin thất bại');
      })
    });
    $('#insertUserVal').submit(function(e){
        e.preventDefault();
        
    });
            $('#fullbirthday').datetimepicker({timepicker:false,
          format:'d/m/Y'});
          
           $("a[data-toggle=\"tab\"]").on("shown.bs.tab", function (e) {
              $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
          });
    }
    function keyUpAddress(obj)
    {
      text = obj.value;
      fulladdress = text;
      $('#fulladdresstemp').val(fulladdress);
    }
      function selectCity(obj){
    var $id = obj.value;
    city = obj.options[obj.selectedIndex].text;
    fulladdress = text+ ' '+ 'Thành phố '+city; 
    $('#fulladdresstemp').val(fulladdress);
    // alert(fulladdress);
      $('.gicungdc').remove(); 
    $.ajax({
      url: '<?php echo base_url()?>user/selectCity',
      type: 'POST',
      dataType: 'JSON',
      data: {id_city : $id},
    })
    .done(function(data) {
               for (var i = 0; i < data.length; i++) {
                $('#dodulieu').after('<option title="'+data[i]['name']+'" class="gicungdc" value="'+data[i]['id_district']+'">'+data[i]['name']+'</option>');
               }
                  
            })
    .fail(function() {
      console.log("error");
    })
  }

  function selectDistrict(obj){
      var $id = obj.value;
      district = obj.options[obj.selectedIndex].text;
      fulladdress =text+ ' '+ district+' '+city;
    $('#fulladdresstemp').val(fulladdress);
      // alert(fulladdress);
        $('.gicungdc1').remove(); 
      $.ajax({
        url: '<?php echo base_url()?>user/selectDistrict',
        type: 'POST',
        dataType: 'JSON',
        data: {id_district : $id},
      })
      .done(function(data) {
                 for (var i = 0; i < data.length; i++) {
                  $('#dodulieu1').after('<option title="'+data[i]['name']+'" class="gicungdc1" value="'+data[i]['id_ward']+'">'+data[i]['name']+'</option>');
                 }
                    
              })
      .fail(function() {
        console.log("error");
      })
    }

    function selectWard(obj){
      var $id = obj.value;
      ward = obj.options[obj.selectedIndex].text;
      fulladdress =text+ ' '+ ward+' '+district+' '+city;
      $('#fulladdresstemp').val(fulladdress);
    }

    function updateUser(obj)
    {
      var id = obj.title;
      var data = $('#'+id+'').val();
      $.ajax({
        url: '<?php echo base_url()?>user/selectDistrict',
        type: 'POST',
        dataType: 'JSON',
        data: {id_district : $id},
      })
      .done(function(data) {
                 for (var i = 0; i < data.length; i++) {
                  $('#dodulieu1').after('<option title="'+data[i]['name']+'" selected class="gicungdc1" value="'+data[i]['id_ward']+'">'+data[i]['name']+'</option>');
                 }
                    
              })
      .fail(function() {
        console.log("error");
      })

    }
   
   function selectGroup(obj){
      var $id = obj.value;
      $('.div-add').remove();
      $('.group_item').remove(); 
      $.ajax({
        url: '<?php echo base_url()?>user/getGroupByRoleId',
        type: 'POST',
        dataType: 'JSON',
        data: {roleid : $id},
      })
      .done(function(data) {
                 data =data.data;
                 if(data[0]['roleid'] == 3)
                 {
                   for (var i = 0; i < data.length; i++) {
                    console.log(data[0]['roleid']);

                      $('.grouplist').append('<option selected class="group_item" value="'+data[i]['groupid']+'">'+data[i]['groupname']+'</option>');
                   }
                 }
                 else{
                    for (var i = 0; i < data.length; i++) {
                    console.log(data[0]['roleid']);

                      $('.grouplist').append('<option selected class="group_item" value="'+data[i]['groupid']+'">'+data[i]['groupname']+'</option>');
                   }
                   $('.div-group').after('<div class="div-add">\
                  <label class="control-label user-label col-md-3 no-padding">ID:</label>\
                    <label class="control-label col-md-8 no-padding-right">\
                      <input class="col-md-12 no-padding font-size-12" value="" placeholder="Nhập ID" id="custid" name="custid">\
                    </label>\
                </div>\
                <div class="div-add">\
                  <label class="control-label user-label col-md-3 no-padding">Password:</label>\
                    <label class="control-label col-md-8 no-padding-right">\
                      <input class="col-md-12 no-padding font-size-12" value="" placeholder="Nhập Password" type="password" id="password" name="password">\
                    </label>\
                </div>\
                ')
                 }
                      
              })
      .fail(function() {
          console.log("error");
      })
    }

    function loadGroup(roleid)
    {
      var $id = roleid;
      $('.div-add').remove();
      $('.group_item').remove(); 
      $.ajax({
        url: '<?php echo base_url()?>user/getGroupByRoleId',
        type: 'POST',
        dataType: 'JSON',
        data: {roleid : $id},
      })
      .done(function(data) {

                 data =data.data;
                 if(data[0]['roleid'] == 3)
                 {
                   for (var i = 0; i < data.length; i++) {
                    console.log(data[0]['roleid']);

                      $('.grouplist').append('<option selected class="group_item" value="'+data[i]['groupid']+'">'+data[i]['groupname']+'</option>');
                   }
                 }
                 else{
                    for (var i = 0; i < data.length; i++) {

                      $('.grouplist').append('<option selected class="group_item" value="'+data[i]['groupid']+'">'+data[i]['groupname']+'</option>');
                   }
                   $('.div-group').after('<div class="div-add">\
                  <label class="control-label user-label col-md-3 no-padding">ID:</label>\
                    <label class="control-label col-md-8 no-padding-right">\
                      <input class="col-md-12 no-padding font-size-12" value="" placeholder="Nhập ID" id="custid" name="custid">\
                    </label>\
                </div>\
                <div class="div-add">\
                  <label class="control-label user-label col-md-3 no-padding">Password:</label>\
                    <label class="control-label col-md-8 no-padding-right">\
                      <input class="col-md-12 no-padding font-size-12" value="" placeholder="Nhập Password" type="password" id="password" name="password">\
                    </label>\
                </div>\
                ')
                 }
                  
                  $('#groupid').val('<?php echo $detail[0]['groupid'] ?>');    
              })
      .fail(function() {
          console.log("error");
      })
    }

    function removeemail($email, $emaillist){
        var custid = $('#cusit_id').attr('custid');
        $.ajax({
          url: '<?php echo base_url()?>user/updateUserEmailList',
          type: 'POST',
          dataType: 'JSON',
          data: {custid : custid,email:$email,emaillist:$emaillist},
        })
        .done(function(data) {
          if(data.code==1){
              window.location.reload();
            }else{
              alert(data.message);
            }
        })
        .fail(function() {
            alert("Lỗi hệ thống, vui lòng liên hệ admin");
        })
    }

    function removephone($phone, $phonelist){
        var custid = $('#cusit_id').attr('custid');
        $.ajax({
          url: '<?php echo base_url()?>user/updateUserPhoneList',
          type: 'POST',
          dataType: 'JSON',
          data: {custid : custid,phone:$phone,phonelist:$phonelist},
        })
        .done(function(data) {
            if(data.code==1){
              window.location.reload();
            }else{
              alert(data.message);
            }
        })
        .fail(function() {
           alert("Lỗi hệ thống, vui lòng liên hệ admin");
        })
    }

    $('.btn-addfulladdress').click(function(){
        var addid = $(this).attr('addid');
        var fulladdress = $('#fulladdresstemp').val();
        var city = $('#city').val();
        var district = $('#dodulieu').val();
        var ward = $('#dodulieu1').val();
        var sonha = $('#sonha').val();
        $.ajax({
          url: '<?php echo base_url()?>user/updateAddress',
          type: 'POST',
          dataType: 'JSON',
          data: {addressid : addid,fulladdress:fulladdress,city:city,district:district,ward:ward,address:sonha},
        })
        .done(function(data) {
          if(data.code==1){
              window.location.reload();
            }else{
              alert(data.message);
            }
        })
        .fail(function() {
            alert("Lỗi hệ thống, vui lòng liên hệ admin");
        })
    });
    
  function formatDMY(dd,mm,yyyy)
  {
      if(dd<10){
      dd='0'+dd;
      } 
      if(mm<10){
          mm='0'+mm;
      } 
      var today = dd+'/'+mm+'/'+yyyy;
      return today;
  }
</script>