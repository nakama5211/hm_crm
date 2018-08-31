<script type="text/javascript">
	$(document).ready(function(){
    $('#tableUser').DataTable({
             "paging":   true,
             "language": {
              "paginate": {
                "previous": "Trước",
                "next":"Sau"
              }
            },
             "order": false,
            "info":     false,
            "searching": false,
            "scrollY":        "100%",
            "scrollX":        true,
            "bLengthChange": false,
            "scrollCollapse": true
          }).columns.adjust().draw();

		$('#keyword').keypress(function(e1){
		   if(e1.keyCode==13){          // if user is hitting enter
		       search();
		   }
		  });
		
	});
	function search() {
		$('#loading').attr('style', 'display: initial;width: 30px; height: 30px;');
		var keyword = $('#keyword').val();
		$.ajax({
          url: '<?php echo base_url()?>setting/searchUser',
          type: 'POST',
          dataType: 'JSON',
          data: {keyword : keyword},
        })
        .done(function(data) {
        	$('#loading').attr('style', 'display:none');
        	var data_html = '';
        	for(var i = 0;i<data.data.length;i++)
        	{
        		var custid = data.data[i].custid;
        		var idcard = data.data[i].idcard;
        		var roleid = data.data[i].roleid;
        		var url1 = '<?php echo base_url() ?>user/detail/?cusid='+custid+'&idcard='+idcard+'&roleid='+roleid;
        		var url = "'"+url1+"'";
        		var custname = "'"+data.data[i].custname+"'";
        		data_html+=
        		'<tr>\
	      			<td width="40px">\
	            	<img class="user-avatar" src="'+data.data[i].avatar+'" alt="User Image">\
	            </td>\
	            <td width="252px">\
	            	<a class="user-name" style="cursor: pointer;" onclick="addTab('+url+','+custname+')">'+data.data[i].custname+'</a>\
	            	<p class="">'+data.data[i].groupid+'</p>\
	            </td>\
	            <td width="229px">'+data.data[i].telephone+'</td>\
	            <td  width="218px">'+data.data[i].email+'</td>\
	          </tr>';
        	}
          $('.content-search').html('<div class="table-responsive">\
	              <table class="table" id="tableUser">\
                <thead>\
                    <tr>\
                    <th></th>\
                    <th>Họ tên</th>\
                    <th>SĐT</th>\
                    <th>Email</th>\
                </tr>\
                  </thead>\
	                <tbody>'+data_html+'\
	                </tbody>\
	              </table>\
	            </div>');

           $('#tableUser').DataTable({
             "paging":   true,
             "language": {
              "paginate": {
                "previous": "Trước",
                "next":"Sau"
              }
            },
             "order": false,
            "info":     false,
            "searching": false,
            "scrollY":        "100%",
            "scrollX":        true,
            "bLengthChange": false,
            "scrollCollapse": true
          }).columns.adjust().draw();
        })
        .fail(function() {
            console.log('error');
            $('#loading').attr('style', 'display:none');
        })	
	}

	function searchRoleid(roleid) {
		$('#loading').attr('style', 'display: initial;width: 30px; height: 30px;');
		var keyword = '';
		$.ajax({
          url: '<?php echo base_url()?>setting/searchUser',
          type: 'POST',
          dataType: 'JSON',
          data: {keyword : keyword},
        })
        .done(function(data) {
        	$('#loading').attr('style', 'display:none');
        	var data_html = '';
        	for(var i = 0;i<data.data.length;i++)
        	{

        		if(data.data[i].roleid == roleid)
        		{
        			var custid = data.data[i].custid;
	        		var idcard = data.data[i].idcard;
	        		var url1 = '<?php echo base_url() ?>user/detail/?cusid='+custid+'&idcard='+idcard+'&roleid='+roleid;
	        		var url = "'"+url1+"'";
	        		var custname = "'"+data.data[i].custname+"'";
        		data_html+=
        		'<tr>\
	      			<td width="40px">\
	            	<img class="user-avatar" src="'+data.data[i].avatar+'" alt="User Image">\
	            </td>\
	            <td width="252px">\
	            	<a class="user-name" style="cursor: pointer;" onclick="addTab('+url+','+custname+')">'+data.data[i].custname+'</a>\
	            	<p class="">'+data.data[i].groupid+'</p>\
	            </td>\
	            <td width="229px">'+data.data[i].telephone+'</td>\
	            <td width="218px">'+data.data[i].email+'</td>\
	          </tr>';
	          	}
        	}
          $('.content-search').html('<div class="table-responsive">\
	              <table class="table" id="tableUser">\
                <thead>\
                    <tr>\
                    <th></th>\
                    <th>Họ tên</th>\
                    <th>SĐT</th>\
                    <th>Email</th>\
                </tr>\
                  </thead>\
	                <tbody>'+data_html+'\
	                </tbody>\
	              </table>\
	            </div>');
          $('#tableUser').DataTable({
             "paging":   true,
             "language": {
              "paginate": {
                "previous": "Trước",
                "next":"Sau"
              }
            },
             "order": false,
            "info":     false,
            "searching": false,
            "scrollY":        "100%",
            "bLengthChange": false,
            "scrollX":        true,
            "scrollCollapse": true
          }).columns.adjust().draw();
        })
        .fail(function() {
            alert("Lỗi hệ thống, vui lòng liên hệ admin");
        })	
	}
    function clickChangeIframe(src)
    {
        document.getElementById('iframesetting').src = src;
    }
	
</script>