<div class="col-md-12 no-padding padding-left-5">
	    	<div class="tile height-1024">
	           <div class="table-responsive">
	              	<table class="table" id="table-1-create-user">
	              		<thead class="no-border-top">
	              			<tr>
	              				<th>Tên</th>
	              				<th>Số điện thoại</th>
	              				<th>Email</th>
	              				<th>Số CMND</th>
	              				<th>Cập nhật lần cuối</th>
	              			</tr>
	              		</thead>
		                <tbody>
		                	<?php 
		                	if(count($list_user >0))
		                	{
		                	foreach ($list_user as $rows) { ?>
		                	<tr class="border-bot-1">
			                    <td width="250">
			                    	<a class="buttonsearchiframe" onclick="addTab('<?php echo base_url().'user/detail/?cusid='.$rows['custid'].'&idcard='.$rows['idcard'].'&roleid='.$rows['roleid'] ?>','<?php echo $rows['custname'] ?>')" href="#" title=""><?php echo $rows['custname'] ?></a>
			                    </td>
			                    <td><?php echo $rows['telephone'] ?></td>
			                    <td><?php echo $rows['email'] ?></td>
			                    <td><?php echo $rows['idcard'] ?></td>
			                    <td><?php 
			                    if($rows['lastupdate']!=null)
			                    {
			                    echo date("d/m/Y", strtotime($rows['lastupdate']));}
			                     ?></td>
		                  	</tr>	
		                	<?php }} ?>				  
		                </tbody>
	              	</table>
	            </div>   
	        </div>
	    </div>