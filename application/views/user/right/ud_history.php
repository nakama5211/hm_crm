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

				        	$labelaction = '';
				        foreach ($data as $key => $value) {
				        	if($key == "custname")
				        	{
				        		echo "Họ và tên: ".$value."<br />";
				        	}
				        	if($key == "gender")
				        	{
				        		echo "Giới tính: ".switchGender($value)."<br />";
				        	}
				        	if($key == "telephone")
				        	{
				        		echo "Số điện thoại: ".$value."<br />";
				        	}
				        	if($key == "fullbirthday")
				        	{
				        		echo "Ngày Sinh: ".$value."<br />";
				        	}
				        	if($key == "email")
				        	{
				        		echo "Email: ".$value."<br />";
				        	}
				        	if($key == "comments")
				        	{
				        		echo "Ghi chú: ".$value."<br />";
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
				        		echo switchExtField($value,$list_ext);
				        	}
				        	if($key == "idcard")
				        	{
				        		echo "CMND: ".$value."<br />";
				        	}
				        	if($key == "issueddate")
				        	{
				        		echo "Ngày cấp: ".date('d-m-Y',strtotime($value))."<br />";
				        	}

				        	if($key == "action")
				        	{
				        		if($value == "deletephone")
				        		{
				        			$labelaction = "Xoá SĐT: ";
				        		}
				        		else
				        		{
				        			$labelaction = "Xoá Email: ";
				        		}
				        	}
				        	if($key == "telephonelist")
				        	{
				        		foreach ($value as $key1 => $data1) {
				        			if(count($data) == 2)
					        		{
					        			echo "Thêm SĐT: ".$data1;
					        			break;
					        		}
					        		else
					        		{
					        			echo $labelaction.=$data1;
				        			}
				        		}
				        	}
				        	if($key == "emaillist")
				        	{
				        		foreach ($value as $key1 => $data1) {
				        			if(count($data) == 2)
					        		{
					        			echo "Thêm Email: ".$data1;
					        			break;
					        		}
					        		else
					        		{
					        			echo $labelaction.=$data1;
				        			}
				        		}
				        	}
				        	if($key == "emaillist")
				        	{
				        		foreach ($value as $key1 => $data1) {
				        			$labelaction = $data1;
				        		}
				        		if(count($data) == 2)
				        		{
				        			echo "Thêm Email: ".$labelaction;
				        		}
				        	}
				        	if($key == "city")
				        	{
				        		echo "Thành phố: ".$value."<br />" ;
				        	}
				        	if($key == "district")
				        	{
				        		echo "Quận/ Huyện: ".$value."<br />" ;
				        	}
				        	if($key == "ward")
				        	{
				        		echo "Phường/ Xã: ".$value."<br />" ;
				        	}
				        	if($key == "street")
				        	{
				        		echo "Đường: ".$value."<br />" ;
				        	}
				        	if($key == "address")
				        	{
				        		echo "Số nhà: ".$value."<br />" ;
				        	}
				        	if($key == "label")
				        	{
				        		echo "Nhãn địa chỉ: ".$value."<br />" ;
				        	}
				        }
				        }
				         ?></p>
				    </div>
			  	</div>
			  	 <?php	$i++;}} ?>
			</div>

<?php 
function switchGender($value1)
{
	if($value1 == "M")
	{
		return "Nam";
	}
	else{
		return "Nữ";
	}
}
function switchRoleId($value1,$role_list)
{
	if(count($role_list)>0)
	{
	foreach ($role_list as $key => $value) {
		if($value1 == $key)
		{
			return $value;
		}
	}
	}
}
function switchGroupId($value1,$group_list)
{
	if(count($group_list)>0){
		foreach ($group_list as  $value) {
			if($value1 == $value['groupid'])
			{
				return $value['groupname'];
			}
		}
	}
} 
function switchExtField($extfields,$list_ext)
{
	$text = "";

	if(count($extfields)>0)
	{
		foreach ($extfields as $key => $value) {
			foreach ($list_ext as  $value1) {
				if($key == $value1['fieldcode'])
				{
					$text.= $value1['fieldname'].": ".$value."</br>";
				}
			}
		}
	}
	return $text;
}
?>