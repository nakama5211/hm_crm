<div class="timeline">
				<?php 
				$array = array("gray","red","green","yellow");
				$i = 0;
				if(count($history)>0)
				{
				foreach ($history as $value) { 
					if($i >3)
					{
						$i=0;
					}
					?>
			  	<div class="entry">
				    <div class="title <?php echo $array[$i] ?>">
				      	<p class="time-detail"><?php 
				      	if($value['createat'] !=null)
				      	{
				      	echo date("G:i:s", strtotime($value['createat']));} ?></p>
				      	<p class="date-detail"><?php 
				      	if($value['createat'] !=null)
				      	{
				      		echo date("d/m/Y", strtotime($value['createat']));} ?></p>
				    </div>
				    <div class="body">
				      	<p class="margin-bot-3"><?php echo $value['action'] ?></p>
				        <p class="no-margin-bot"><?php $data = json_decode($value['dataaction'],true);
				        foreach ($data as $key => $value) {
				        	if($key == "roleid")
				        	{
				        		echo "Phân quyền: ".switchRoleId($value)."<br />";
				        	}
				        	// echo $key.": ".$value."<br />";
				        }
				         ?></p>
				    </div>
			  	</div>
			  	 <?php	$i++;}} ?>
			</div>

<?php public function switchRoleId($value)
{
	if($value == 3)
	{
		echo "Khách hàng";
	}
} ?>