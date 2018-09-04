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
            $('#btn-save').prop('disabled',false).find('i').removeClass().addClass('fa fa-share');
              if(data.code==0){
                swal("Lỗi", data.message, "error");
              }else{
                swal("Thành công !", "Thêm người dùng thành công.", "success");
              }
            },
            error: function(xhr, status, error) {
              console.log(error);
            }
        });
    return false;
  });

  $('#fullbirthday').datetimepicker({timepicker:false,format:'d/m/Y'});

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
});
  

    function selectDistrict(obj){
      var $id = obj.value;
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
</script>