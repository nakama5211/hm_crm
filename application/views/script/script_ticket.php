<script type="text/javascript">
   function locphieu($custid,$status,$lienquan){
      document.getElementById('iframesearch').src = "<?php echo base_url()?>search/rightSearchTicket/?search=&agentcreated=&agentcurrent="+$custid+"&priority=&status="+$status+"&lienquan="+$lienquan;
   }

   function loctheonhom(type){
      	 document.getElementById('iframesearch').src = "<?php echo base_url()?>search/ticketByType/"+type;
   }

</script>