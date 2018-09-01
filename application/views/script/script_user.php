<script type="text/javascript">
      var dayCompare = new Date("2000-01-01T00:00:00");
      $(document).ready( function () {
        loadFirst();
        });
      
      function selectCity(obj){
          var $id = obj.value;

            $('.gicungdc').remove(); 
          $.ajax({
            url: '<?php echo base_url()?>user/selectCity',
            type: 'POST',
            dataType: 'JSON',
            data: {id_city : $id},
          })
          .done(function(data) {
                     for (var i = 0; i < data.length; i++) {
                      $('#dodulieu').after('<option class="gicungdc" value="'+data[i]['id_district']+'">'+data[i]['name']+'</option>');
                     }
                        
                  })
          .fail(function() {
            console.log("error");
          })
        }

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
                     for (var i = 0; i < data.length; i++) {
                      $('#dodulieu1').after('<option selected class="gicungdc1" value="'+data[i]['id_ward']+'">'+data[i]['name']+'</option>');
                     }
                        
                  })
          .fail(function() {
            console.log("error");
          })
        }
      

       $('#demoNotify').click(function(){
            $.notify({
                  title: "Update Complete : ",
                  message: "Something cool is just updated!",
                  icon: 'fa fa-check' ,
                  url: 'https://github.com/mouse0270/bootstrap-notify',
                  target: '_blank'
            },{
                  // settings
                  element: 'body',
                  position: null,
                  type: "info",
                  allow_dismiss: true,
                  newest_on_top: false,
                  showProgressbar: false,
                  placement: {
                        from: "top",
                        align: "right"
                  },
                  offset: {
                        x: 10,
                        y: 40
                  },
                  spacing: 10,
                  z_index: 1031,
                  delay: 5000,
                  timer: 1000,
                  url_target: '_blank',
                  mouse_over: null,
                  animate: {
                        enter: 'animated fadeInDown',
                        exit: 'animated fadeOutUp'
                  },
                  onShow: null,
                  onShown: null,
                  onClose: null,
                  onClosed: null,
                  icon_type: 'class',
                  template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' +
                        '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
                        '<span data-notify="icon"></span> ' +
                        '<span data-notify="title">{1}</span> ' +
                        '<span data-notify="message">{2}</span>' +
                        '<div class="progress" data-notify="progressbar">' +
                              '<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
                        '</div>' +
                        '<a href="{3}" target="{4}" data-notify="url"></a>' +
                  '</div>' 
            });
      });
      $('#demoSwal').click(function(){
            swal({
                  title: "Are you sure?",
                  text: "You will not be able to recover this imaginary file!",
                  type: "warning",
                  showCancelButton: true,
                  confirmButtonText: "Yes, delete it!",
                  cancelButtonText: "No, cancel plx!",
                  closeOnConfirm: false,
                  closeOnCancel: false
            }, function(isConfirm) {
                  if (isConfirm) {
                        swal("Deleted!", "Your imaginary file has been deleted.", "success");
                  } else {
                        swal("Cancelled", "Your imaginary file is safe :)", "error");
                  }
            });
      });
      $('#demoModal').click(function(){
            var modal = $(
            '<div class="modal fade">\
                  <div class="modal-dialog" role="document">\
                        <div class="modal-content">\
                              <div class="modal-header">\
                                    <h5 class="modal-title">Ghép vào một người khác</h5>\
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>\
                              </div>\
                              <div class="modal-body">\
                                    <div class="flex">\
                                          <div class="div user-call-pad col-sm-5">\
                                            <p class="phone-name"><img class="user-avatar phone-avatar" src="https://s3.amazonaws.com/uifaces/faces/twitter/jsa/48.jpg" alt="User Image">Lan Phạm</p>\
                                            <p class="phone-num header-desc field-click-able">038 8485 4949</p>\
                                            <p class="phone-time header-desc field-click-able">00 : 00 : 25</p>\
                                          </div>\
                                          <div class="row col-sm-7">\
                                                <div class="col-md-3">\
                                                      <span class="user-history-label span-danger">O</span>\
                                                      <span>5</span>\
                                                </div>\
                                                <div class="col-md-3">\
                                                      <span class="user-history-label span-warning">P</span>\
                                                      <span>5</span>\
                                                </div>\
                                                <div class="col-md-3">\
                                                      <span class="user-history-label span-success">S</span>\
                                                      <span>5</span>\
                                                </div>\
                                                <div class="col-md-3">\
                                                      <span class="user-history-label span-info">R</span>\
                                                      <span>5</span>\
                                                </div>\
                                                <div class="col-md-3">\
                                                      <span class="fa fa-phone user-history-icon span-default"></span>\
                                                      <span>5</span>\
                                                </div>\
                                                <div class="col-md-3">\
                                                      <span class="fa fa-comment user-history-icon span-default"></span>\
                                                      <span>5</span>\
                                                </div>\
                                                <div class="col-md-3">\
                                                      <span class="fa fa-file-alt user-history-icon span-default"></span>\
                                                      <span>5</span>\
                                                </div>\
                                          </div>\
                                    </div>\
                                    <p>Tìm người cần ghép</p>\
                                    <div id="call-input">\
                                          <input class="form-control margin-top-10 margin-bot-5" type="text" name="" placeholder="Phone Number or name">\
                                    </div>\
                                    <div class="flex">\
                                          <div class="div user-call-pad col-sm-6">\
                                            <p class="phone-name"><img class="user-avatar phone-avatar" src="https://s3.amazonaws.com/uifaces/faces/twitter/jsa/48.jpg" alt="User Image">Lan Phạm</p>\
                                            <p class="phone-num header-desc field-click-able">038 8485 4949</p>\
                                            <p class="phone-time header-desc field-click-able">00 : 00 : 25</p>\
                                          </div>\
                                          <div class="div user-call-pad col-sm-6">\
                                            <p class="phone-name"><img class="user-avatar phone-avatar" src="https://s3.amazonaws.com/uifaces/faces/twitter/jsa/48.jpg" alt="User Image">Lan Phạm</p>\
                                            <p class="phone-num header-desc field-click-able">038 8485 4949</p>\
                                            <p class="phone-time header-desc field-click-able">00 : 00 : 25</p>\
                                          </div>\
                                    </div>\
                              </div>\
                              <div class="modal-footer">\
                                    <button class="btn btn-primary btn-89" type="button" data-dismiss="modal">Hủy</button>\
                                    <button class="btn btn-secondary btn-89" type="button">Ghép</button>\
                              </div>\
                        </div>\
                  </div>\
            </div>');  
            modal.modal("show").on("hidden", function(){
                  modal.remove();
            }); 
      });
  function formatNumber (num) {
      return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
  }
  function arrayContains(needle, arrhaystack)
  {
      return (arrhaystack.indexOf(needle) > -1);
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
  function loadFirst(){
        var arrayCheck = [];
        var contractid = '<?php echo $this->uri->segment(3) ?>';
    $('.nav-tabs')
          .scrollingTabs({
            enableSwiping: true
          })
          .on('ready.scrtabs', function() {
            $('.tab-content').show();
          });
      
        $.ajax({
        url: 'http://crm.tavicosoft.com/api/get_erp_token/C0001',
        type: 'GET',
        dataType: 'JSON'
      })
      .done(function(data) {
        var json = jQuery.parseJSON(data);
      $(".a_contractid").attr('href','http://demo.tavicosoft.com/connectdb/loginprovider?opid=C0001@AGT&returnUrl=%2F%23PCT&token='+json.result.data+'&dataseg=contractid%3D<?php echo $trade[0]['contractid'] ?>%26action%3DV');
      $(".a_custid").attr('href','http://demo.tavicosoft.com/connectdb/loginprovider?opid=C0001@AGT&returnUrl=%2F%23NAD&token='+json.result.data+'&dataseg=nadcode%3D<?php echo $trade[0]['clientcode'] ?>%26action%3DV');
              })
      .fail(function() {
         console.log('Load Fail!!!');
      })
      $('#table-1-ticketcontract').DataTable({
          "paging":   false,
                    "columns": [
                      { "width": "60px" },
                      { "width": "160px" },
                      { "width": "100px" },
                      { "width": "112px" },
                      { "width": "110px" }
                    ],
                    "info":     false,
                    "searching": false,
                    "scrollY":        "235px",
                    "scrollX":        true,
                    "scrollCollapse": true,
                    "ajax":
                        "<?php echo base_url() ?>user/loadTicketContract/"+contractid,
                    dom: "Bfrtip",
                    "processing": true,
                    'language':{ 
                       "loadingRecords": "<img style='width:50px; height:50px;' src='<?php echo base_url().'images/ajax-loading.gif' ?>' />",
                       "processing": ""
                    }
        });

       $.ajax('http://crm.tavicosoft.com/api/get_list_contract',{
            'data': JSON.stringify({  
             "reportcode":"crmContract01e",
            "limit":25,
            "start":0,
            "queryFilters":{"contractid":contractid}
            }),
            'type': 'POST',
            'processData': false,
            'contentType': 'application/json' 
        })
          .done(function(data) {
                      $('#div-content-1').css("background","none");
                     var obj = jQuery.parseJSON(data);
                     if(obj.result.data.length >0)
                     {
                      var data_html='';
                      for (var i = 0; i < obj.result.data.length; i++) {
                        if(obj.result.data[i].name !== null)
                        {
                           var name = obj.result.data[i].name;
                        }else{var name ='';}
                        if(obj.result.data[i].gender !== null)
                        {
                           var gender = obj.result.data[i].gender;
                        }else{var gender ='';}
                        if(obj.result.data[i].birthday !== null)
                        {
                           var birthday = obj.result.data[i].birthday+"/"+obj.result.data[i].birthmonth+"/"+obj.result.data[i].birthyear;
                        }else{var birthday ='';}
                        if(obj.result.data[i].telephone !== null)
                        {
                           var telephone = obj.result.data[i].telephone;
                        }else{var telephone ='';}
                        if(obj.result.data[i].email !== null)
                        {
                           var email = obj.result.data[i].email;
                        }else{var email ='';}
                        if(obj.result.data[i].idcard !== null)
                        {
                           var idcard = obj.result.data[i].idcard;
                        }else{var idcard ='';}
                        if(obj.result.data[i].issueddate !== null)
                        {
                           var t3 = new Date(obj.result.data[i].issueddate);
                           if(t3 > dayCompare)
                           {
                           var issueddate = formatDMY(t3.getDate(),t3.getMonth()+1,t3.getFullYear());
                          }else{var issueddate = ''}
                        }else{var issueddate ='';}
                        if(obj.result.data[i].issuedplace !== null)
                        {
                           var issuedplace = obj.result.data[i].issuedplace;
                        }else{var issuedplace ='';}
                        if(obj.result.data[i].residencyaddress !== null)
                        {
                           var residencyaddress = obj.result.data[i].residencyaddress;
                        }else{var residencyaddress ='';}
                        if(obj.result.data[i].contactaddress !== null)
                        {
                           var contactaddress = obj.result.data[i].contactaddress;
                        }else{var contactaddress ='';}
                        if(obj.result.data[i].title !== null)
                        {
                           var title = obj.result.data[i].title;
                        }else{var title ='';}
                        if(obj.result.data[i].bankaccountno !== null)
                        {
                           var bankaccountno = obj.result.data[i].bankaccountno;
                        }else{var bankaccountno ='';}
                        if(obj.result.data[i].bankname !== null)
                        {
                           var bankname = obj.result.data[i].bankname;
                        }else{var bankname ='';}
                        if(obj.result.data[i].nationalily !== null)
                        {
                           var nationalily = obj.result.data[i].nationalily;
                        }else{var nationalily ='';}
                        if(obj.result.data[i].cellphone !== null)
                        {
                           var cellphone = obj.result.data[i].cellphone;
                        }else{var cellphone ='';}
                         if(obj.result.data[i].authorizedletter !== null)
                        {
                           var authorizedletter = obj.result.data[i].authorizedletter;
                        }else{var authorizedletter ='';}
                        if(obj.result.data[i].company !== null)
                        {
                           var company = obj.result.data[i].company;
                        }else{var company ='';}
                        if(obj.result.data[i].remarks !== null)
                        {
                           var remarks = obj.result.data[i].remarks;
                        }else{var remarks ='';}

                          data_html+='<div class="row">\
                    <div class="col-md-4">\
                      <div class="form-group">\
                        <label for="exampleInputName2"><strong>Họ và Tên: </strong></label>\
                        <label for="exampleInputName2">'+name+'</label>\
                      </div>\
                    </div>\
                    <div class="col-md-4">\
                      <div class="form-group">\
                        <label for="exampleInputName2"><strong>Giới tính: </strong></label>\
                        <label for="exampleInputName2">'+gender+'</label>\
                      </div>\
                    </div>\
                    <div class="col-md-4">\
                      <div class="form-group">\
                         <label for="exampleInputName2"><strong>Ngày sinh: </strong></label>\
                        <label for="exampleInputName2">'+birthday+'</label>\
                      </div>\
                    </div>\
                  </div>\
                  <div class="row">\
                    <div class="col-md-6">\
                      <div class="form-group">\
                        <label for="exampleInputName2"><strong>Số điện thoại: </strong></label>\
                        <label for="exampleInputName2">'+telephone+'</label>\
                      </div>\
                    </div>\
                    <div class="col-md-6">\
                      <div class="form-group">\
                        <label for="exampleInputName2"><strong>Email: </strong></label>\
                        <label for="exampleInputName2">'+email+'</label>\
                      </div>\
                    </div>\
                  </div>\
                  <div class="row">\
                    <div class="col-md-4">\
                      <div class="form-group">\
                        <label for="exampleInputName2"><strong>Số CMND: </strong></label>\
                        <label for="exampleInputName2">'+idcard+'</label>\
                      </div>\
                    </div>\
                    <div class="col-md-4">\
                      <div class="form-group">\
                        <label for="exampleInputName2"><strong>Ngày cấp: </strong></label>\
                        <label for="exampleInputName2">'+issueddate+'</label>\
                      </div>\
                    </div>\
                    <div class="col-md-4">\
                      <div class="form-group">\
                        <label for="exampleInputName2"><strong>Nơi cấp: </strong></label>\
                        <label for="exampleInputName2">'+issuedplace+'</label>\
                      </div>\
                    </div>\
                  </div>\
                  <div class="row">\
                    <div class="col-md-12">\
                      <div class="form-group">\
                        <label for="exampleInputName2"><strong>Địa chỉ thường trú: </strong></label>\
                        <label for="exampleInputName2">'+residencyaddress+'</label>\
                      </div>\
                    </div>\
                  </div>\
                  <div class="row">\
                    <div class="col-md-12">\
                      <div class="form-group">\
                        <label for="exampleInputName2"><strong>Địa chỉ liên lạc: </strong></label>\
                        <label for="exampleInputName2">'+contactaddress+'</label>\
                      </div>\
                    </div>\
                  </div>\
                  <div class="row">\
                    <div class="col-md-4">\
                      <div class="form-group">\
                        <label for="exampleInputName2"><strong>Chức vụ: </strong></label>\
                        <label for="exampleInputName2">'+title+'</label>\
                      </div>\
                    </div>\
                    <div class="col-md-4">\
                      <div class="form-group">\
                        <label for="exampleInputName2"><strong>Số TKNH: </strong></label>\
                        <label for="exampleInputName2">'+bankaccountno+'</label>\
                      </div>\
                    </div>\
                    <div class="col-md-4">\
                      <div class="form-group">\
                        <label for="exampleInputName2"><strong>Ngân hàng: </strong></label>\
                        <label for="exampleInputName2">'+bankname+'</label>\
                      </div>\
                    </div>\
                  </div>\
                  <div class="row">\
                    <div class="col-md-4">\
                      <div class="form-group">\
                        <label for="exampleInputName2"><strong>Quốc gia: </strong></label>\
                        <label for="exampleInputName2">'+nationalily+'</label>\
                      </div>\
                    </div>\
                    <div class="col-md-4">\
                      <div class="form-group">\
                        <label for="exampleInputName2"><strong>Số DTDD: </strong></label>\
                        <label for="exampleInputName2">'+cellphone+'</label>\
                      </div>\
                    </div>\
\
                    <div class="col-md-4">\
                      <div class="form-group">\
                        <label for="exampleInputName2"><strong>Giấy uỷ quyền: </strong></label>\
                        <label for="exampleInputName2">'+authorizedletter+'</label>\
                      </div>\
                    </div>\
                    \
                  </div>\
                  <div class="row">\
                    <div class="col-md-12">\
                      <div class="form-group">\
                        <label for="exampleInputName2"><strong>Công ty: </strong></label>\
                        <label for="exampleInputName2">'+company+'</label>\
                      </div>\
                    </div>\
                    \
                  </div>\
\
                  <div class="row">\
                    <div class="col-md-12">\
                      <div class="form-group">\
                        <label for="exampleInputName2"><strong>Ghi chú: </strong></label>\
                        <label for="exampleInputName2">'+remarks+'</label>\
                      </div>\
                    </div>\
                  </div>';
                      }
                      $('#div-content-1').html(data_html);
                      }
                  })
          .fail(function() {
            console.log("error");
          })
      $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        var contractid = '<?php echo $this->uri->segment(3) ?>';
          var target = $(e.target).attr("alt") ;
          var check = arrayContains(target,arrayCheck);
          if(check == true)
          {
            return;
          }
          else{arrayCheck.push(target);}
          if(target == "crmContract01g")
          {

          }
        //    $.ajax('http://crm.tavicosoft.com/api/get_list_contract',{
        //     'data': JSON.stringify({  
        //      "reportcode":target,
        //     "limit":25,
        //     "start":0,
        //     "queryFilters":{"contractid":contractid}
        //     }),
        //     'type': 'POST',
        //     'processData': false,
        //     'contentType': 'application/json' 
        // })
        //   .done(function(data) {

        //              var obj = jQuery.parseJSON(data);
                     
        //              if(target == "crmContract01g")
        //              {
        //              $("#div-content-6").css('background', 'none');
        //               if(obj.result.data.length >0){

        //              if (obj.result.data[0].duedate !== null)
        //              {
        //                 var t2 = new Date(obj.result.data[0].duedate);
        //                 if(t2 > dayCompare)
        //                    {
        //                 var duedate = formatDMY(t2.getDate(),t2.getMonth()+1,t2.getFullYear());
        //                   }
        //                   else{var duedate = '';}
        //              }else{ var duedate = "";}
        //              if (obj.result.data[0].adjustdate !== null)
        //              {
        //                 var t2 = new Date(obj.result.data[0].adjustdate);
        //                 if(t2 > dayCompare)
        //                    {
        //                 var adjustdate = formatDMY(t2.getDate(),t2.getMonth()+1,t2.getFullYear());
        //                   }else{var adjustdate ='';}
        //              }else{ var adjustdate = "";}
        //              if (obj.result.data[0].value0 !== null)
        //              {
        //                 var value0 = formatNumber(obj.result.data[0].value0);
        //              }else{ var value0 = "";}
        //              if (obj.result.data[0].value3 !== null)
        //              {
        //                 var value3 = formatNumber(obj.result.data[0].value3);
        //              }else{ var value3 = "";}
        //              if (obj.result.data[0].value1 !== null)
        //              {
        //                 var value1 = formatNumber(obj.result.data[0].value1);
        //              }else{ var value1 = "";}
        //              if (obj.result.data[0].value2 !== null)
        //              {
        //                 var value2 = formatNumber(obj.result.data[0].value2);
        //              }else{ var value2 = "";}

        //              if (obj.result.data[0].pptarea !== null)
        //              {
        //                 var pptarea = obj.result.data[0].pptarea;
        //              }else{ var pptarea = "";}
        //              if (obj.result.data[0].contractvalue !== null)
        //              {
        //                 var contractvalue = obj.result.data[0].contractvalue;
        //              }else{ var contractvalue = "";}
        //              if (obj.result.data[0].comments !== null)
        //              {
        //                 var comments = obj.result.data[0].comments;
        //              }else{ var comments = "";}
        //             $('#div-content-6').html('<div class="row">\
        //             <div class="col-md-6">\
        //               <div class="form-group">\
        //                 <label for="exampleInputName2"><strong>Ngày Đc: </strong></label>\
        //                 <label for="exampleInputName2">'+
        //                 // obj.result.data[0].adjustdate
        //                 adjustdate
        //                 +'</label>\
        //               </div>\
        //             </div>\
        //             <div class="col-md-6">\
        //               <div class="form-group">\
        //                 <label for="exampleInputName2"><strong>Giá bán chưa VAT: </strong></label>\
        //                 <label for="exampleInputName2">'+
        //                 value0+'</label>\
        //               </div>\
        //             </div>\
        //             </div>\
        //             <div class="row">\
        //             <div class="col-md-6">\
        //               <div class="form-group">\
        //                 <label for="exampleInputName2"><strong>Ngày đến hạn: </strong></label>\
        //                 <label for="exampleInputName2">'+duedate+'</label>\
        //               </div>\
        //             </div>\
        //             <div class="col-md-6">\
        //               <div class="form-group">\
        //                 <label for="exampleInputName2"><strong>Thuế VAT: </strong></label>\
        //                 <label for="exampleInputName2">'+ value1 +'</label>\
        //               </div>\
        //             </div>\
        //           </div>\
        //           </div>\
        //           <div class="row">\
        //             <div class="col-md-6">\
        //               <div class="form-group">\
        //                 <label for="exampleInputName2"><strong>Diện tích: </strong></label>\
        //                 <label for="exampleInputName2">'+ pptarea +'</label>\
        //               </div>\
        //             </div>\
        //             <div class="col-md-6">\
        //               <div class="form-group">\
        //                 <label for="exampleInputName2"><strong>Phí bảo trì: </strong></label>\
        //                 <label for="exampleInputName2">'+value2+'</label>\
        //               </div>\
        //             </div>\
        //           </div>\
        //           <div class="row">\
        //             <div class="col-md-6">\
        //               <div class="form-group">\
        //                 <label for="exampleInputName2"><strong>Giá trị hợp đồng: </strong></label>\
        //                 <label for="exampleInputName2">'+ contractvalue+'</label>\
        //               </div>\
        //             </div>\
        //             <div class="col-md-6">\
        //               <div class="form-group">\
        //                 <label for="exampleInputName2"><strong>Giá trị quyền SDĐ:</strong></label>\
        //                 <label for="exampleInputName2">'+value3 +'</label>\
        //               </div>\
        //             </div>\
        //           </div>\
        //           <div class="row">\
        //             <div class="col-md-12">\
        //               <div class="form-group">\
        //                  <label for="exampleInputName2"><strong>Ghi chú: </strong></label>\
        //                 <label for="exampleInputName2">'+ comments +'</label>\
        //               </div>\
        //             </div>\
        //           </div>');
        //               }
        //             }
        //             else if(target == "crmContract01f"){
        //                 $("#div-content-5").css('background', 'none');
        //                 var data_html = '';
        //                 for(var i = 0;i<obj.result.data.length;i++)
        //                 {
        //                     if(obj.result.data[i].name !== null)
        //                     {
        //                       var name = obj.result.data[i].name;
        //                     }else{var name = "";}
        //                     if(obj.result.data[i].name1 !== null)
        //                     {
        //                       var name1 = obj.result.data[i].name1;
        //                     }else{var name1 = "";}
        //                     if(obj.result.data[i].remarks !== null)
        //                     {
        //                       var remarks = obj.result.data[i].remarks;
        //                     }else{var remarks = "";}
        //                     if(obj.result.data[i].commissionrate !== null)
        //                     {
        //                       var float_commissionrate = obj.result.data[i].commissionrate.toFixed(5);
        //                     }else{var float_commissionrate = "";}
                            
        //                     data_html+=' <tr class="border-bot-1">\
        //                         <td>\
        //                           '+name+'\
        //                         </td>\
        //                         <td>'+name1+'</td>\
        //                         <td>'+float_commissionrate+'</td>\
        //                         <td>'+remarks+'</td>\
        //                       </tr>';
        //                 }
        //                 $('#div-content-5').html('<table class="table" id="table-1">\
        //                   <thead class="no-border-top">\
        //                     <tr>\
        //                       <th style="\
        //         width: 30%;">Nhân viên</th><th style="\
        //         width: 18%;">Sàn</th><th style="\
        //         width: 12.8%;">Tỉ lệ thưởng</th>\
        //                                       <th>Ghi chú</th>\
        //                     </tr>\
        //                   </thead>\
        //                   <tbody>\
        //                     '+data_html+'\
        //                   </tbody>\
        //                 </table>');
        //             }
        //             else if(target == "crmContract01d")
        //             {
        //                 $("#div-content-4").css('background', 'none');
        //                 var data_html = '';
        //                 for(var i = 0;i<obj.result.data.length;i++)
        //                 {
        //                 if(obj.result.data[i].promotiondate !== null)
        //                   {
        //                     var t3 = new Date(obj.result.data[i].promotiondate);
        //                     if(t3 > dayCompare)
        //                    {
        //                     var promotiondate = formatDMY(t3.getDate(),t3.getMonth()+1,t3.getFullYear());
        //                     }else{var promotiondate='';}
        //                   }else{var promotiondate = "";}
        //                   if(obj.result.data[i].description !== null)
        //                   {
        //                     var description = obj.result.data[i].description;
        //                   }else{var description = "";}
        //                   if(obj.result.data[i].quantity !== null)
        //                   {
        //                     var quantity = obj.result.data[i].quantity;
        //                   }else{var quantity = "";}
        //                   if(obj.result.data[i].amount !== null)
        //                   {
        //                     var amount = formatNumber(Math.abs(obj.result.data[i].amount));
        //                   }else{var amount = "";}
        //                   if(obj.result.data[i].remarks !== null)
        //                   {
        //                     var remarks = obj.result.data[i].remarks;
        //                   }else{var remarks = "";}
        //                     data_html+=' <tr class="border-bot-1">\
        //                         <td width="100">\
        //                         '+promotiondate+'\
        //                         </td>\
        //                         <td>\
        //                         '+description+'\
        //                         </td>\
        //                         <td>'+quantity+'</td>\
        //                         <td>'+amount+'</td>\
        //                         <td>'+remarks+'</td>\
        //                       </tr>';
        //                 }
        //                 $('#div-content-4').html('<table class="table" id="table-1">\
        //                   <thead class="no-border-top">\
        //                     <tr>\
        //                       <th style="\
        //                 width: 11%;">Ngày</th>\
        //                 <th style="\
        //                 width: 19%;;">HH/DV</th>\
        //                 <th style="\
        //                 width: 10.3%;">Số lượng</th><th style="\
        //                 width: 10%;;">Giá trị</th>\
        //                       <th>Ghi chú</th>\
        //                     </tr>\
        //                   </thead>\
        //                   <tbody>\
        //                   '+data_html+'\
        //                   </tbody>\
        //                 </table>');
        //             }
        //             else if(target == "crmContract01b")
        //             {
        //                 $("#div-content-2").css('background', 'none');
        //                 var data_html = '';
        //                 for(var i = 0;i<obj.result.data.length;i++)
        //                 {
        //                 if(obj.result.data[i].status !== null)
        //                   {
        //                     var status = obj.result.data[i].status;
        //                   }else{var status = "";}
        //                   if(obj.result.data[i].statusdate !== null)
        //                   {
        //                     var t3 = new Date(obj.result.data[i].statusdate);
        //                     if(t3 > dayCompare)
        //                    {
        //                     var statusdate = formatDMY(t3.getDate(),t3.getMonth()+1,t3.getFullYear());}else{var statusdate='';}
        //                   }else{var statusdate = "";}
        //                   if(obj.result.data[i].name !== null)
        //                   {
        //                     var name = obj.result.data[i].name;
        //                   }else{var name = "";}
        //                   if(obj.result.data[i].name1 !== null)
        //                   {
        //                     var name1 = formatNumber(Math.abs(obj.result.data[i].name1));
        //                   }else{var name1 = "";}
        //                   if(obj.result.data[i].remarks !== null)
        //                   {
        //                     var remarks = obj.result.data[i].remarks;
        //                   }else{var remarks = "";}
        //                     data_html+=' <tr class="border-bot-1">\
        //                         <td width="100">\
        //                           '+status+'\
        //                         </td>\
        //                         <td>\
        //                           '+statusdate+'\
        //                         </td>\
        //                         <td>'+name+'\</td>\
        //                         <td>'+name1+'\</td>\
        //                         <td>'+remarks+'\</td>\
        //                       </tr>';
        //                 }
        //                 $('#div-content-2').html('<table class="table" id="table-1">\
        //                   <thead class="no-border-top">\
        //                     <tr>\
        //                       <th style="\
        //                 width: 11%;">HH/DV</th>\
        //                 <th style="\
        //                 width: 19%;;">Ngày</th>\
        //                 <th style="\
        //                 width: 10.3%;">Số lượng</th><th style="\
        //                 width: 10%;;">Giá trị</th>\
        //                       <th>Ghi chú</th>\
        //                     </tr>\
        //                   </thead>\
        //                   <tbody>\
        //                   '+data_html+'\
        //                   </tbody>\
        //                 </table>');
        //             }
        //             else if(target == "crmContract01h")
        //             {
        //                 $("#div-content-7").css('background', 'none');
        //               var data_html = '';
        //                 for(var i = 0;i<obj.result.data.length;i++)
        //                 {
        //                 if(obj.result.data[i].eventtype !== null)
        //                   {
        //                     var eventtype = obj.result.data[i].eventtype;
        //                   }else{var eventtype = "";}
        //                   if(obj.result.data[i].eventdate !== null)
        //                   {
        //                     var t3 = new Date(obj.result.data[i].eventdate);
        //                     if(t3 > dayCompare)
        //                    {
        //                     var eventdate = formatDMY(t3.getDate(),t3.getMonth()+1,t3.getFullYear());}else{var eventdate='';}
        //                   }else{var eventdate = "";}
        //                   if(obj.result.data[i].eventstatus !== null)
        //                   {
        //                     var eventstatus = obj.result.data[i].eventstatus;
        //                   }else{var eventstatus = "";}
        //                   if(obj.result.data[i].name !== null)
        //                   {
        //                     var name = obj.result.data[i].name;
        //                   }else{var name = "";}
        //                   if(obj.result.data[i].notes !== null)
        //                   {
        //                     var notes = obj.result.data[i].notes;
        //                   }else{var notes = "";}
        //                     data_html+=' <tr class="border-bot-1">\
        //                         <td width="150">\
        //                           '+eventtype+'\
        //                         </td>\
        //                         <td>\
        //                           '+eventdate+'\
        //                         </td>\
        //                         <td>'+eventstatus+'\</td>\
        //                         <td>'+name+'\</td>\
        //                         <td>'+notes+'\</td>\
        //                       </tr>';
        //                 }
        //                 $('#div-content-7').html('<table class="table" id="table-1">\
        //                   <thead class="no-border-top">\
        //                     <tr>\
        //                       <th style="\
        //                 width: 12.5%;">Loại ghi chú</th><th style="\
        //                 width: 14.3%;">Ngày ghi chú</th><th style="\
        //                 width: 11%;;">Tình trạng</th><th style="\
        //                 width: 26%;">Nhân viên</th>\
        //                       <th>Nội dung</th>\
        //                     </tr>\
        //                   </thead>\
        //                   <tbody>\
        //                     '+data_html+'\
        //                   </tbody>\
        //                 </table>');
        //             }
        //           })
        //   .fail(function() {
        //     console.log("error");
        //   })
        });
    $.fn.dataTable.moment('DD/MM/YYYY');
          $('#table-1-congno').DataTable({
            "paging":   false,
                    "columns": [
              { "width": "46px" },
              { "width": "19px" },
              { "width": "38px" },
              { "width": "50px"},
              { "width": "50px" },
              { "width": "55px" },
              { "width": "220px" },
              { "width": "18px" },
              { "width": "450px" }
                    ],
                    "info":     false,
                    "searching": false,
                    "scrollY":        "235px",
                    "scrollX":        true,
                    "scrollCollapse": true,
                    dom: "Bfrtip",
                    "processing": true,
                    'language':{ 
                       "loadingRecords": "<img style='width:50px; height:50px;' src='<?php echo base_url().'images/ajax-loading.gif' ?>' />",
                       "processing": "<img style='width:50px; height:50px;' src='<?php echo base_url().'images/ajax-loading.gif' ?>' />"
                    },
                    "ajax": 'http://crm.tavicosoft.com/dev/user/getCongnoThanhtoan/AGR00001'
          }).columns.adjust().draw();

          $('#table-1-dchd').DataTable({
             "paging":   false,
            "info":     false,
            "searching": false,
            "scrollY":        "294px",
            "scrollX":        true,
            "scrollCollapse": true,
            "columns": [
               { "width": "70px" },
              { "width": "100px" },
              { "width": "60px" },
              { "width": "43px" },
              { "width": "100px" },
              { "width": "110px" },
              { "width": "80px" },
              { "width": "100px" },
              { "width": "100px" },
               { "width": "100px" }
            ]
          }).columns.adjust().draw();

          $("a[data-toggle=\"tab\"]").on("shown.bs.tab", function (e) {
              $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
          });
  }
</script>