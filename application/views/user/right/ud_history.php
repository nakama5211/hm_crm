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
				        <p class="no-margin-bot">
				        	<?php $data = json_decode($value['dataaction'],true);
				        	if(count($data)>0)
				        	{
				        foreach ($data as $key => $value) {
				        	if($key == "custname")
				        	{
				        		echo "Họ và tên: ".$value."<br />";
				        	}
				        	if($key == "roleid")
				        	{
				        		echo "Phân quyền: ".switchRoleId($value,$role_list)."<br />";
				        	}
				        	if($key == "groupid")
				        	{
				        		echo "Nhóm: ".switchGroupId($value,$group_list)."<br />";
				        	}
				        	if($key == "extinfo")
				        	{
				        		echo switchExtField($value);
				        	}
				        }
				        }
				         ?></p>
				    </div>
			  	</div>
			  	 <?php	$i++;}} ?>
			</div>

<?php 
function switchRoleId($value1,$role_list)
{
	foreach ($role_list as $key => $value) {
		if($value1 == $key)
		{
			return $value;
		}
	}
}
function switchGroupId($value1,$group_list)
{
	foreach ($group_list as  $value) {
		if($value1 == $value['groupid'])
		{
			return $value['groupname'];
		}
	}
} 
function switchExtField($extfields)
{
	$text = "";
	foreach ($extfields as $key => $value) {
		$text.= $key.": ".$value."</br>";
	}
	return $text;
}
?>