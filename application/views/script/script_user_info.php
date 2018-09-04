<script type="text/javascript">
  
  var dayCompare = new Date("2000-01-01T00:00:00");	
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
      var id = opt.attr('id-city');
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
                    "scrollCollapse": true,
                    "ajax": '<?php echo base_url() ?>user/testContract/'+idcard+'',
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
                    }
                  });
    $('.btn-update').click(function(){
      $('#updateUser').prop('disabled',true).find('i').removeClass().addClass('fa fa-spin fa-spinner');
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
        var custid = $('#custid').val();
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