<script type="text/javascript">
  
  var dayCompare = new Date("2000-01-01T00:00:00");	
  $(document).ready( function () {
    loadFirst();

  $( "#idcard" ).click(function() {
      $('#updateIdcard').modal('show');
      $('#updateIdcard').on('shown.bs.modal', function (e) {
          $('#issueddate').datetimepicker({timepicker:false,
          format:'d/m/Y'});
        })
  });
      });
    function loadFirst()
    {
      $('#roleid').val('<?php echo $detail[0]['roleid'] ?>');
      $('#gender').val('<?php echo $detail[0]['gender'] ?>');
      var load_roleid = $('#roleid').val();
      var idcard = '<?php echo strval($_GET['idcard']) ?>';
      var opid = $('#opid').val();
      loadGroup(load_roleid);
      $('input[name=city]').on('keyup',function(){
    var val = $(this).val();
    var opt = $('datalist#l_city').find('option[value="'+val+'"]');
    if (opt.length>0) {
      var idcity = opt.attr('id-city');
      $.ajax({
        url: '<?php echo base_url()?>user/selectCity',
        type: 'POST',
        dataType: 'JSON',
        data: {id_city : idcity},
      })
      .done(function(data) {
        var l_r = '';
        for (var i = 0; i < data.length; i++) {
          l_r+='<option value="'+data[i]['name']+'" id="'+data[i]['id_district']+'"></option>';
        }
        $('datalist#l_distr').html(l_r);
      })
      .fail(function() {
        console.log("error");
      })
    }
  });

  $('input[name=district').on('keyup',function(){
    var val = $(this).val();
    var opt = $('datalist#l_distr').find('option[value="'+val+'"]');
    if (opt.length>0) {
      var id = opt.attr('id');
      $.ajax({
        url: '<?php echo base_url()?>user/selectDistrict',
        type: 'POST',
        dataType: 'JSON',
        data: {id_district : id},
      })
      .done(function(data) {
        var l_r = '';
        for (var i = 0; i < data.length; i++) {
          l_r+='<option value="'+data[i]['name']+'" id="'+data[i]['id_ward']+'"></option>';
        }
        $('datalist#l_ward').html(l_r);
      })
      .fail(function() {
        console.log("error");
      })
    }
  });
    var table_contract = $('#table-1-contract').DataTable({
                    "paging":   false,
                    "info":     false,
                    "searching": false,
                    "scrollY":        "235px",
                    "scrollX":        true,
                    "scrollCollapse": true,
                    "ajax": '<?php echo base_url() ?>user/testContract?idcard='+idcard+'&opid='+opid+'',
                    dom: "Bfrtip",
                    "processing": true,
                    'language':{ 
                       "loadingRecords": "<img style='width:50px; height:50px;' src='<?php echo base_url().'images/ajax-loading.gif' ?>' />",
                       "processing": ""
                    },
                    "initComplete": function(settings, json){ 
                        var info = this.api().page.info();
                        console.log('Total records', info.recordsTotal);
                        console.log('Displayed records', info.recordsDisplay);
                        $("#tab1").text('Giao dịch ('+info.recordsDisplay+')');
                        this.fnAdjustColumnSizing(true);
                    }
                  });
    $('.btn-update-idcard').click(function(){
      $('.btn-update-idcard').prop('disabled',true).find('i').addClass('fa fa-spin fa-spinner');
        var custid = '<?php echo strval($_GET['cusid']) ?>';
        var roleid = $('#roleid').val();
        var groupid = $('#groupid').val();
        var idcard = $('#idcard_modal').val();
        var issueddate = $('#issueddate').val();
        var issuedplace = $('#issuedplace').val();
        $.ajax({
        url: '<?php echo base_url()?>user/updateUser',
        type: 'POST',
        dataType: 'JSON',
        data: {roleid : roleid, groupid: groupid,custid:custid,idcard: idcard, issueddate: issueddate, issuedplace: issuedplace, ext:$('#dataExt').serialize()},
      })
        .done(function(data){
          $('.btn-update-idcard').prop('disabled',false).find('i').removeClass();
          $('#updateIdcard').modal('toggle');
          parent.notification("Lưu CMND thành công!!!");
          $('#idcard').val(idcard);

        })
        .fail(function(){
          parent.notification("Lưu CMND thất bại!!!");
        })
    });
    $('.btn-update').click(function(){
      $('#updateUser').prop('disabled',true).find('i').removeClass().addClass('fa fa-spin fa-spinner');
        var custid = '<?php echo strval($_GET['cusid']) ?>';
        var roleid = $('#roleid').val();
        var groupid = $('#groupid').val();
        var custname = $('#custname').val();
        // var idcard = $('#idcard').val();
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

                      $('#updateUser').prop('disabled',false).find('i').removeClass().addClass('fa fa-share');
                      // location.reload();
                        parent.notification("Cập nhật thành công");
                        //update
                      // loadHistory();
                      var iframe = document.getElementById('iframehistory');
                      iframe.src = iframe.src;
                 }
                 else{
                  alert(data.message);
                 }
              })
      .fail(function() {
         parent.notification("Sửa thông tin thất bại");
      })
    });
    $('#insertUserVal').submit(function(e){
        e.preventDefault();
        
    });
            $('#fullbirthday').datetimepicker({timepicker:false,
          format:'d/m/Y'});
          
           $("a[data-toggle=\"tab\"]").on("shown.bs.tab", function (e) {
              $($.fn.dataTable.tables( true ) ).css('width', '100%');
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

    function removeemail($email, $emaillist,roleid,groupid){
        var custid = $('#cusit_id').attr('custid');
        $.ajax({
          url: '<?php echo base_url()?>user/updateUserEmailList',
          type: 'POST',
          dataType: 'JSON',
          data: {custid : custid,email:$email,emaillist:$emaillist,ext:$('#dataExt').serialize(),roleid:roleid,groupid:groupid},
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

    function removephone($phone, $phonelist,roleid,groupid){
        var custid = $('#cusit_id').attr('custid');
        $.ajax({
          url: '<?php echo base_url()?>user/updateUserPhoneList',
          type: 'POST',
          dataType: 'JSON',
          data: {custid : custid,phone:$phone,phonelist:$phonelist,ext:$('#dataExt').serialize(),roleid:roleid,groupid:groupid},
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
      $('.btn-addfulladdress').prop('disabled',true).find('i').addClass('fa fa-spin fa-spinner');
        var custid = '<?php echo strval($_GET['cusid']) ?>';
        var roleid = '<?php echo strval($_GET['roleid']) ?>';
        var groupid = $('#log_groupid').val();
        var addid = $(this).attr('addid');
        var country = $('#country').val();
        var city = $('#city').val();
        var district = $('#district').val();
        var ward = $('#ward').val();
        var street = $('#street').val();
        var address = $('#address').val();
        var label = $('#label').val();
        $.ajax({
          url: '<?php echo base_url()?>user/aj_insert_bonus_address',
          type: 'POST',
          dataType: 'JSON',
          data: {custid: custid, city:city,district:district,ward:ward,street:street,address: address,label:label,roleid:roleid,groupid:groupid},
        })
        .done(function(data) {
          if(data.code==1){
              $.ajax({
                url: '<?php echo base_url()?>user/getAddressApi',
                type: 'POST',
                dataType: 'JSON',
                data: {custid: custid},
              })
              .done(function(data){
                $('.btn-addfulladdress').prop('disabled',false).find('i').removeClass();
                parent.notification("Thêm địa chỉ thành công!!!");
                $('#updateAddress').modal('toggle');
                var data_html = '';
                var j  = 0;
                for (var i = 0; i < data.data.length; i++) {
                    
                    if(data.data[i].hidden != 1)
                    {
                      if(j==0)
                      {
                      var label_diachi = "Địa chỉ";
                      }else{
                      var label_diachi = '';}
                    var label = "'"+data.data[i].label+"'";
                    var city = "'"+data.data[i].city+"'";
                    var district = "'"+data.data[i].district+"'";
                    var ward = "'"+data.data[i].ward+"'";
                    var street = "'"+data.data[i].street+"'";
                    var address = "'"+data.data[i].address+"'";
                    var addressid = "'"+data.data[i].addressid+"'";
                    data_html +='<label class="control-label user-label col-md-3 no-padding">'+label_diachi+'</label>\
                      <label class="control-label col-md-7 no-padding-right">\
                        <input onclick="openModalEdit(\
                        '+label+',\
                        '+city+',\
                        '+district+',\
                        '+ward+',\
                        '+street+',\
                        '+address+',\
                        '+addressid+'\
                        )" class="col-md-12 no-padding font-size-12" value="'+data.data[i].label+'">\
                      </label>\
                      <a href="#" onclick="removeAddress('+addressid+')"><i class="fas fa-times-circle fa-md float-right margin-top-3" style="margin-right: 2px"></i></a>\
                      ';
                      j++;
                    }
                }
                $('.div-address').html(data_html);
                $('#country').val("");
                $('#city').val("");
                $('#district').val("");
                $('#ward').val("");
                $('#street').val("");
                $('#address').val("");
                $('#label').val("");
                var iframe = document.getElementById('iframehistory');
                iframe.src = iframe.src;
                // alert(data_html);

              }).fail(function(){
                  alert('fail');
              })
            }else{
              alert(data.message);
            }
        })
        .fail(function() {
            alert("Lỗi hệ thống, vui lòng liên hệ admin");
        })
    });
    $('.btn-updatefulladdress').click(function(){
      $('.btn-updatefulladdress').prop('disabled',true).find('i').addClass('fa fa-spin fa-spinner');
        var custid = '<?php echo strval($_GET['cusid']) ?>';
        var addressid = $('#addressid').val();
        var roleid = '<?php echo strval($_GET['roleid']) ?>';
        var groupid = $('#log_groupid').val();
        // var country = $('#country_edit').val();
        var city = $('#city_edit').val();
        var district = $('#district_edit').val();
        var ward = $('#ward_edit').val();
        var street = $('#street_edit').val();
        var address = $('#address_edit').val();
        var label = $('#label_edit').val();
        $.ajax({
          url: '<?php echo base_url()?>user/aj_update_bonus_address',
          type: 'POST',
          dataType: 'JSON',
          data: {city:city,district:district,ward:ward,street:street,address: address,label:label,addressid:addressid,roleid:roleid,groupid:groupid,custid:custid},
        })
        .done(function(data) {
          if(data.code==1){
              $.ajax({
                url: '<?php echo base_url()?>user/getAddressApi',
                type: 'POST',
                dataType: 'JSON',
                data: {custid: custid},
              })
              .done(function(data){
                $('.btn-updatefulladdress').prop('disabled',false).find('i').removeClass();
                parent.notification("Thêm địa chỉ thành công!!!");
                $('#updateFullAddress').modal('toggle');
                var data_html = '';
                var j  = 0;
                for (var i = 0; i < data.data.length; i++) {
                    
                    if(data.data[i].hidden != 1)
                    {
                      if(j==0)
                      {
                      var label_diachi = "Địa chỉ";
                      }else{
                      var label_diachi = '';}
                    var label = "'"+data.data[i].label+"'";
                    var city = "'"+data.data[i].city+"'";
                    var district = "'"+data.data[i].district+"'";
                    var ward = "'"+data.data[i].ward+"'";
                    var street = "'"+data.data[i].street+"'";
                    var address = "'"+data.data[i].address+"'";
                    var addressid = "'"+data.data[i].addressid+"'";
                    data_html +='<label class="control-label user-label col-md-3 no-padding">'+label_diachi+'</label>\
                      <label class="control-label col-md-7 no-padding-right">\
                        <input onclick="openModalEdit(\
                        '+label+',\
                        '+city+',\
                        '+district+',\
                        '+ward+',\
                        '+street+',\
                        '+address+',\
                        '+addressid+'\
                        )" class="col-md-12 no-padding font-size-12" value="'+data.data[i].label+'">\
                      </label>\
                      <a href="#" onclick="removeAddress('+addressid+')"><i class="fas fa-times-circle fa-md float-right margin-top-3" style="margin-right: 2px"></i></a>\
                      ';
                      j++;
                    }
                }
                $('.div-address').html(data_html);
                // alert(data_html);

              }).fail(function(){
                  alert('fail');
              })
            }else{
              alert(data.message);
            }
        })
        .fail(function() {
            alert("Lỗi hệ thống, vui lòng liên hệ admin");
        })
    });

    function openModalEdit(label,city,district,ward,street,address,addressid)
    {
        $('#updateFullAddress').modal('toggle');
        $('#updateFullAddress').on('shown.bs.modal', function (e) {
            $('#label_edit').val(label);
            $('#city_edit').val(city);
            $('#district_edit').val(district);
            $('#ward_edit').val(ward);
            $('#street_edit').val(street);
            $('#address_edit').val(address);
            $('#addressid').val(addressid);
        });
    }
    
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
  function formatHMS(hh,mm,ss)
  {
      if(hh<10){
      hh='0'+hh;
      } 
      if(mm<10){
          mm='0'+mm;
      } 
      if(ss<10){
          ss='0'+ss;
      } 
      var today = hh+':'+mm+':'+ss;
      return today;
  }
  function removeAddress(addressid)
  {
      $('#modalDeleteAddress').modal('toggle');
      $('#modalDeleteAddress').on('shown.bs.modal', function (e) {
            $('#addressid_delete').val(addressid);
        });
  }
  function deleteAddress()
  {
    var custid = '<?php echo strval($_GET['cusid']) ?>';
    $('.btn-danger').prop('disabled',true).find('i').addClass('fa fa-spin fa-spinner');
    var addressid = $('#addressid_delete').val();
     $.ajax({
        url: '<?php echo base_url()?>user/aj_delete_address',
                type: 'POST',
                dataType: 'JSON',
                data: {addressid: addressid},
     })
     .done(function(data){
        if(data.code == 1)
        {
            $.ajax({
                url: '<?php echo base_url()?>user/getAddressApi',
                type: 'POST',
                dataType: 'JSON',
                data: {custid: custid},
              })
              .done(function(data){
                $('.btn-danger').prop('disabled',false).find('i').removeClass();
                parent.notification("Đã xoá địa chỉ!!!");
                $('#modalDeleteAddress').modal('toggle');
                var data_html = '';
                var j  = 0;
                for (var i = 0; i < data.data.length; i++) {
                    
                    if(data.data[i].hidden != 1)
                    {
                      if(j==0)
                      {
                      var label_diachi = "Địa chỉ";
                      }else{
                      var label_diachi = '';}
                    var label = "'"+data.data[i].label+"'";
                    var city = "'"+data.data[i].city+"'";
                    var district = "'"+data.data[i].district+"'";
                    var ward = "'"+data.data[i].ward+"'";
                    var street = "'"+data.data[i].street+"'";
                    var address = "'"+data.data[i].address+"'";
                    var addressid = "'"+data.data[i].addressid+"'";
                    data_html +='<label class="control-label user-label col-md-3 no-padding">'+label_diachi+'</label>\
                      <label class="control-label col-md-7 no-padding-right">\
                        <input onclick="openModalEdit(\
                        '+label+',\
                        '+city+',\
                        '+district+',\
                        '+ward+',\
                        '+street+',\
                        '+address+',\
                        '+addressid+'\
                        )" class="col-md-12 no-padding font-size-12" value="'+data.data[i].label+'">\
                      </label>\
                      <a href="#" onclick="removeAddress('+addressid+')"><i class="fas fa-times-circle fa-md float-right margin-top-3" style="margin-right: 2px"></i></a>\
                      ';
                      j++;
                    }
                }
                $('.div-address').html(data_html);
                // alert(data_html);

              }).fail(function(){
                  alert('fail');
              })
        }

     })
     .fail(function(){

     });
  }
  function addTelephone(id,idcard,roleid,groupid)
  {
    var listtelephone = $('#listtelephone').val();
    var telephonelist = $('#telephonelist').val();
    if(listtelephone.length == 0)
    {
      var listphone = telephonelist;
    }
    else{
      var listphone = listtelephone+','+telephonelist;
    }
     $.ajax({
        url: '<?php echo base_url()?>user/insertPhoneList',
                type: 'POST',
                dataType: 'JSON',
                data: {telephonelist: listphone,custid:id,idcard:idcard,roleid:roleid,ext:$('#dataExt').serialize(),groupid:groupid},
     })
     .done(function(data){
        if(data.code==1){
              window.location.reload();
            }else{
              alert(data.message);
            }
     })
     .fail(function(){

     });
  }

  function addEmail(id,idcard,roleid,groupid)
  {
    var listemail = $('#listemail').val();
    var emaillist = $('#emaillist').val();
    if(listemail.length == 0)
    {
      var listmail = emaillist;
    }
    else{
      var listmail = listemail+','+emaillist;
    }
     $.ajax({
        url: '<?php echo base_url()?>user/insertEmailList',
                type: 'POST',
                dataType: 'JSON',
                data: {emaillist: listmail,custid:id,idcard:idcard,roleid:roleid,ext:$('#dataExt').serialize(),groupid:groupid},
     })
     .done(function(data){
        if(data.code==1){
              window.location.reload();
            }else{
              alert(data.message);
            }
     })
     .fail(function(){

     });
  }
</script>