<script type="text/javascript">
	$(document).ready( function () {
    $('#table-1-create-user').DataTable({
             "paging":   true,
             "language": {
              "paginate": {
                "previous": "Trước",
                "next":"Sau"
              }
            },
            "columns": [
              { "width": "20%" },
              { "width": "20%" },
              { "width": "20%" },
              { "width": "20%" },
              { "width": "20%" }
            ],
            "info":     false,
            "searching": false,
            "scrollY":        "100%",
            "iDisplayLength": 25,
            "scrollX":        true,
            "bLengthChange": false,
            "scrollCollapse": true
          }).columns.adjust().draw();
    $('form#insertUserVal').on('submit',function(){
        
      var formData = new FormData($(this)[0]);

      for (var [key, value] of formData.entries()) { 
            console.log(key, value);
      }

      $(this).find('button[type=submit]').prop('disabled',true).find('i').removeClass().addClass('fa fa-spin fa-spinner');
      $.ajax({
              type: "POST",
              url: "<?php echo base_url().'user/aj_insert';?>",
              data:  formData,
              dataType:'json',
              contentType: false,
              cache: false,
              processData:false,
              beforeSend: function() {
              },
              success: function(data) {
                if(data.code==0){
                  $(this).find('button[type=submit]').prop('disabled',false).find('i').removeClass().addClass('fa fa-share');
                   alert(data.message);
                }else{
                   // alert("thêm thành công.");
                   // location.reload();
                }
              },
              error: function(xhr, status, error) {
                console.log(error);
              }
          });
      return false;
    });
      $('#fullbirthday').datetimepicker({timepicker:false,
      format:'d/m/Y'});});
      var fulladdress = '';
      var city = '';
      var district = '';
      var ward='';
  function selectCity(obj){
    var $id = obj.value;
    city = obj.options[obj.selectedIndex].text;
    fulladdress = city; 
    $('#fulladdress').val(fulladdress);
    // alert(fulladdress);
      $('.gicungdc').remove(); 
    $.ajax({
      url: '<?php echo base_url()?>user/selectCity',
      type: 'POST',
      dataType: 'JSON',
      data: {id_city : $id},
    })
    .done(function(data) {
               // console.log(data.loaisp);
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
      fulladdress = district+' '+city;
    $('#fulladdress').val(fulladdress);
      // alert(fulladdress);
        $('.gicungdc1').remove(); 
      $.ajax({
        url: '<?php echo base_url()?>user/selectDistrict',
        type: 'POST',
        dataType: 'JSON',
        data: {id_district : $id},
      })
      .done(function(data) {
                 // console.log(data.loaisp);
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
      fulladdress = ward+' '+district+' '+city;
      // alert(fulladdress);
      $('#fulladdress').val(fulladdress);
    }

    function selectGroup(obj){
      var $id = obj.value;
      $('.div-add').remove();
      $('.group_item').remove(); 
      $('.div-queue').remove();
      
                if($id != 3)
                 {
                    $('.div-ghichu').hide();
                    $('.div-bonus').hide();
                    $('.div-cmnd').hide();
                    $('.div-address').hide();
                    $('.div-danhxung').hide();
                    $('.div-ngaysinh').hide();
                    document.querySelector('#idcard').required = false;
                    document.querySelector('#email').required = false;
                    if($id == 2){
                     $('.div-phone').after('<div class="div-queue">\
                   <label class="control-label user-label col-md-3 no-padding">Hàng chờ cuộc gọi</label>\
                     <select class="control-label col-md-8 no-border no-padding margin-left-10" id="queue">\
                                                <option value="21114" >Chuyển nhượng hợp đồng</option>\
                                                       <option value="21115" >Thanh toán vay</option>\<option value="21121" >Tiếng Anh</option>\
                                                       <option value="21116" >Khác</option>\
                                                      </select>\
                </div>');
                     }
                     $('.div-group').after('<div class="div-add">\
                         <label class="control-label user-label col-md-3 no-padding">ID:</label>\
                           <label class="control-label col-md-8 no-padding-right">\
                             <input class="col-md-12 no-padding font-size-12" value="" placeholder="Nhập ID" minlength="5" maxlength="10" id="custid" name="custid">\
                           </label>\
                       </div>\
                       <div class="div-add">\
                         <label class="control-label user-label col-md-3 no-padding">Password:</label>\
                           <label class="control-label col-md-8 no-padding-right">\
                             <input class="col-md-12 no-padding font-size-12" value="" placeholder="Nhập Password" type="password" id="password" name="password">\
                           </label>\
                       </div>\
                       ');
                 }
                 else{
                    $('.div-ghichu').show();
                    $('.div-bonus').show();
                    $('.div-cmnd').show();
                    $('.div-address').show();
                    $('.div-danhxung').show();
                    $('.div-ngaysinh').show();
                 }
    }

    function keyUpAddress(obj)
    {
      var text = obj.value;
      fulladdress = text+' ' + ward+' '+district+' '+city;
      $('#fulladdress').val(fulladdress);
    }
</script>