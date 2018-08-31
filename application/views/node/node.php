<script src="<?php echo base_url('callevent/node_modules/socket.io-client/dist/socket.io.js');?>"></script>
<script>
    $(document).ready(function(){

    	var socket = io.connect( 'http://'+window.location.hostname+':3000' ),clientid;

    	socket.on('connect', function () {

        	clientid = socket.id;

	    	socket.emit('new_client', { 
		        name: getRandomName(),
		        phone: getRandomNumber(),
		        id: clientid
	        });
    	});

        $.post("http://"+window.location.hostname+":3000/call",{name: getRandomName(),phone: getRandomNumber()}, function(data){
            if(data==='yes'){
                alert("login success");
            }
        });

        socket.on('prv_event',function(data){
            console.log(data);
            $('#dropdown-btn').trigger('click');
        });

        function getRandomName() {
            const arr = ["Lê Hưng", "Văn Nam", "Khang Thanh", "Gia Gia", "Bảo Bảo", "Thới Hòa", "TRung THông", "Đà An", "Lái Siêu", "Đại Bản"];
            return arr[Math.floor(Math.random() * arr.length)];
        }

        function getRandomNumber() {
            const arr = ["2455","7895","1230","4587","7849","2368","7842","8953","7412","5687"];
            return arr[Math.floor(Math.random() * arr.length)];
        }
  	});
</script>