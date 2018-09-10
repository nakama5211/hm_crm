<script type="text/javascript">
	$(document).ready(function(){
		loadFirst();
	});

  function loadFirst()
  {
    $('#table-1-searchticket').DataTable({
             "paging":   true,
             "language": {
              "paginate": {
                "previous": "Trước",
                "next":"Sau"
              }
            },
            "ordering": false,
            "info":     false,
            "searching": false,
            "scrollY":        "100%",
            // "scrollX":        true,
            "bLengthChange": false,
            "iDisplayLength": 25,
            "scrollCollapse": true
    }).columns.adjust().draw();
    $('#table-1-searchuser').DataTable({
             "paging":   true,
             "language": {
              "paginate": {
                "previous": "Trước",
                "next":"Sau"
              }
            },
             "columns":[
          { "width": "20%" },
          { "width": "20%" },
          { "width": "20%" },
          { "width": "20%" },
          { "width": "20%" }
        ],
        "ordering": false,
            "info":     false,
            "searching": false,
            "scrollY":        "100%",
            // "scrollX":        true,
            "bLengthChange": false,
            "iDisplayLength": 25,
            "scrollCollapse": true
          }).columns.adjust().draw();
    keyPress('search');
    keyPress('custname');
    keyPress('custid');
    keyPress('telephone');
    keyPress('email');
    keyPress('mapping1');

    keyPressTicket('searchticket');
    keyPressTicket('answerInput');
    keyPressTicket('agentInput');
    $('#search_customer').click(function(){
      searchCustomer();
    });

    $('#search_ticket').click(function(){
      searchTicket();
    });
  }
  function searchCustomer()
  {
    var search1 = $('#search').val();
    var search = encodeURI(search1);
    var custname = $('#custname').val();
    var custid = $('#custid').val();
    var telephone = $('#telephone').val();
    var email = $('#email').val();
    var mapping1 = $('#mapping1').val();

    document.getElementById('iframesearch').src = "<?php echo base_url().'search/rightSearch/?search=' ?>"+search+"&custname="+custname+"&idcard="+custid+"&telephone="+telephone+"&email="+email+"&mapping1="+mapping1+"&roleid=<?php echo($this->session->userdata('roleid'))?>";
  }
  function searchTicket()
  {
    var searchticket  = $('#searchticket').val();
    var customer      = $('#customer').val();
    var agentcurrent  = $('#agentcurrent').val();
    var priority      = $('#priority').val();
    var status        = $('#status').val();
    var ticketchannel = $('#ticketchannel').val();
    document.getElementById('iframesearch').src = "<?php echo base_url().'search/rightSearchTicketInput/?search='?>"+searchticket+"&customer="+customer+"&agentcurrent="+agentcurrent+"&priority="+priority+"&status="+status+"&ticketchannel="+ticketchannel+"&custid=<?php echo($this->session->userdata('custid'))?>&groupid=<?php echo($this->session->userdata('groupid'))?>";
  }
  function keyPress(id)
  {
     $('#'+id+'').keypress(function(e1){
       if(e1.keyCode==13){          // if user is hitting enter
           searchCustomer();
       }
      });
  }

  function keyPressTicket(id)
  {
    $('#'+id+'').keypress(function(e1){
       if(e1.keyCode==13){          // if user is hitting enter
           searchTicket();
       }
      });
  }

  function deleteTextboxSearch()
  {
      $('#searchticket').val('');
      $('#search').val('');
      $('#search').removeAttr('minLength');
      $('#searchticket').removeAttr('maxLength');
      $('#search').removeAttr('minLength');
      $('#searchticket').removeAttr('maxLength');
  }

  function checkKeyPressTicket(id)
  {
    if($('#ticketchannel').val() != '' || $('#priority').val() != '' || $('#status').val() != '' || $('#answerInput').val() != "" || $('#agentInput').val() != "" )
    {
      $('#'+id+'').val("");
      $('#'+id+'').prop('minLength', 0);
      $('#'+id+'').prop('maxLength', 0);
      if($('#'+id+'').val() == "")
      {
        $('#'+id+'').prop('minLength', 0);
        $('#'+id+'').prop('maxLength', 0);
      }
    }
    else
    {
      $('#'+id+'').removeAttr('minLength');
      $('#'+id+'').removeAttr('maxLength');
    }
  }
  function checkKeyPressUser(id)
  {
    if($('#custname').val() != "" || $('#custid').val() != "" || $('#telephone').val() != "" || $('#email').val() != "" || $('#mapping1').val() != "" )
    {
      $('#'+id+'').val("");
      $('#'+id+'').prop('minLength', 0);
      $('#'+id+'').prop('maxLength', 0);
      if($('#'+id+'').val() == "")
      {
        $('#'+id+'').prop('minLength', 0);
        $('#'+id+'').prop('maxLength', 0);
      }
    }
    else
    {
      $('#'+id+'').removeAttr('minLength');
      $('#'+id+'').removeAttr('maxLength');
    }
  }

</script>