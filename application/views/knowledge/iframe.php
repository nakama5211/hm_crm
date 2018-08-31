<main class="app-content col-md-100 no-padding no-margin">
    		<div class="tile height-1024">
          		<div class="offset-10 col-md-2 margin-bot-10">
          			<?php $link =  base_url().'knowledge/detail';
          					$title = 'Thêm Knowledge';
          			?>
			    			<button onclick="addTab('<?php echo $link?>','<?php echo $title ?>')"  class="btn btn-primary float-right" id="ck-edit" type="button"> Thêm mới </button>
			    		</div>
	            <div class="table-responsive">
	              	<table class="table" id="table-1-knowledge">
	              		<thead class="no-border-top">
	              			<tr>
	              				<th>Chủ đề</th>
	              				<th>Phân loại</th>
	              				<th width="100">Nhóm vấn đề</th>
	              				<th>Chi tiết VĐ</th>
	              				
	              				<th>Đăng bởi</th>
	              				<th>Ngày đăng</th>
	              				<th>Trạng thái</th>
	              			</tr>
	              		</thead>
		                <tbody>
		                	<?php if(!empty($news)){ foreach ($news as $key => $value) { ?>
		                		<tr class="border-bot-1">

			                    <?php $linkUpdate=  base_url().'knowledge/detail/edit/'.$value['id'];
			                    	$titleUpdate = 'Cập nhật Knowledge '.$value['id']; ?>
			                    <td><a onclick="addTab('<?php echo $linkUpdate ?>','<?php echo $titleUpdate ?>')" href="#"><?php echo $value['title'] ?></a></td>

			                    <td>
			                    	
			                    	<?php if (isset($l_type) && !empty($l_type)) {
		                				$exi = 'Không xác định';
		                				foreach ($l_type as $k => $v) {
		                					if ($value['tickettype']==$v['code']) {
		                						$exi = $v['name'];
		                						break;
		                					}
		                				}
		                				echo $exi;
		                			} ?>
			                    </td>
		                		<td>
		                			<?php if (isset($l_group) && !empty($l_group)) {
		                				$exi = 'Không xác định';
		                				foreach ($l_group as $k => $v) {
		                					if ($value['groupid']==$v['code']) {
		                						$exi = $v['name'];
		                						break;
		                					}
		                				}
		                				echo $exi;
		                			} ?>
			                    </td>
			                    <td>
		                			<?php 
			                    	if (isset($l_cate) && !empty($l_cate)) {
		                				$exi = 'Không xác định';
		                				foreach ($l_cate as $k => $v) {
		                					if ($value['categoryid']==$v['code']) {
		                						$exi = $v['name'];
		                						break;
		                					}
		                				}
		                				echo $exi;
		                			} ?>
			                    </td>
			                    
			                    <td><?php echo($value['custname']); ?></td>
			                    <td><?php echo date("d-m-Y", strtotime($value['createdat'])); ?></td>
			                    <td><?php if($value['hidden']=='0')echo "Đang hoạt động"; else echo "Ngưng hoạt động"; ?></td>
			                    <!-- <td><?php echo($value['hidden']); ?></td> -->
		                  	</tr>
		                	<?php }} else echo("the data is empty"); ?>
		                </tbody>
	              	</table>
	            </div>
          	</div>   
</main>