<main class="app-content padding-5 no-padding-right">
      <div class="row">
        <div class="col-md-3 no-padding padding-left-10 col-md-22">
          	<div class="padding-5 margin-bot-5">
	        	<div class="clearfix">
	        		<div>
		          		<h5 class="tile-title folder-head font-size-12 font-weight-500">Phân chia Công việc <a href=""><i class="fa fa-sync-alt fa-md float-right margin-top-3"></i></a></h5>
		          	</div>
	          		<ul class="nav nav-pills flex-column margin-left-5 margin-right-5">
		                <li>
		                	<a class="dropdown-item no-padding margin-top-bot-10 border-radius-3" href="#">
		                		<p class="no-padding no-margin padding-left-right-10"> Công việc chưa xử lý của tôi
		                		<label class="float-right" id="_o">5</label></p>
		                	</a>
		                </li>
		                <li>
		                	<a class="dropdown-item no-padding margin-top-bot-10 border-radius-3" href="#">
		                		<p class="no-padding no-margin padding-left-right-10"> Công việc đang xử lý của tôi
		                		<label class="float-right" id="_w">5</label></p>
		                	</a>
		                </li>
		                <li>
		                	<a class="dropdown-item no-padding margin-top-bot-10 border-radius-3" href="#">
		                		<p class="no-padding no-margin padding-left-right-10"> Công việc đã hoàn thành
		                		<label class="float-right" id="_c">5</label></p>
		                	</a>
		                </li>
		                <li>
		                	<a class="dropdown-item no-padding margin-top-bot-10 border-radius-3" href="#">
		                		<p class="no-padding no-margin padding-left-right-10"> Toàn bộ Công việc của tôi
		                		<label class="float-right" id="_a"><?php echo isset($record)?count($record):'0';?></label></p>
		                	</a>
		                </li>
		                <!-- <li>
		                	<a class="dropdown-item no-padding margin-top-bot-10 border-radius-3" href="#">
		                		<p class="no-padding no-margin padding-left-right-10"> Công việc chưa xử lý của nhóm
		                		<label class="float-right">5</label></p>
		                	</a>
		                </li>
		                <li>
		                	<a class="dropdown-item no-padding margin-top-bot-10 border-radius-3" href="#">
		                		<p class="no-padding no-margin padding-left-right-10"> Công việc đang xử lý của nhóm
		                		<label class="float-right">5</label></p>
		                	</a>
		                </li>
		                <li>
		                	<a class="dropdown-item no-padding margin-top-bot-10 border-radius-3" href="#">
		                		<p class="no-padding no-margin padding-left-right-10"> Toàn bộ Công việc của nhóm
		                		<label class="float-right">5</label></p>
		                	</a>
		                </li>
			            <li>
		                	<a class="dropdown-item no-padding margin-top-bot-10 border-radius-3" href="#">
		                		<p class="no-padding no-margin padding-left-right-10"> Công việc yêu cầu bởi tôi
		                		<label class="float-right">5</label></p>
		                	</a>
		                </li> -->
	              	</ul>
	        	</div>
	        </div>
        </div>
        <div class="col-md-8 no-padding padding-left-1 col-md-78">
          	<div class="tile height-1024">
	            <div class="content-title">
			        <div class="div">
			          <h5 id="_type">Toàn bộ Công việc của tôi</h5>
			          <!-- <p id="_all"><?php echo isset($record)?count($record):'0';?> Công việc</p> -->
			        </div>
			    </div>
		        <div class="table-responsive">
	              	<table class="table" id="table-1">
		                <tbody>
		                	<?php
		                		$_o=0;$_w=0;$_c=0;
		                		if (isset($record)) {
		                			foreach ($record as $key => $value) {
		                	?>
		                	<tr class="border-bot-1">
			                    <td width="150">
			                    	<span class="id-label span-warning">T</span> 
			                    	<a class="new_tab" onclick="addTab('<?php echo(base_url('task/detail/'.$value['taskid']));?>','<?php echo('#'.$value['taskid']);?>')" href="#">#<?php echo($value['taskid']);?></a>
			                    </td>
			                    <td width="250">
			                    	<?php echo($value['title']);?>
			                    </td>
			                    <td><?php echo date('d-m-Y',strtotime($value['requestdate']));?></td>
			                    <td>
			                    	<?php 
			                    		switch ($value['priority']) {
			                    			case '1':
			                    				echo("Thường");
			                    				break;
			                    			case '2':
			                    				echo("Cao");
			                    				break;
			                    			case '3':
			                    				echo("Khẩn cấp");
			                    				break;
			                    			default:
			                    				echo("Không xác định");
			                    				break;
			                    		}
			                    	?>
			                    </td>
			                    <!-- <td><?php echo($value['tasktype']);?></td> -->
			                    <td>
			                    	<?php 
			                    		switch ($value['status']) {
			                    			case 'O':
			                    				echo("Chờ xác nhận");
			                    				$_o++;
			                    				break;
			                    			case 'W':
			                    				echo("Đang xử lý");
			                    				$_w++;
			                    				break;
			                    			case 'C':
			                    				echo("Hoàn thành");
			                    				$_c++;
			                    				break;
			                    			case 'X':
			                    				echo("Hủy");
			                    				break;
			                    			default:
			                    				echo("Không xác định");
			                    				break;
			                    		}
			                    	?>
			                    </td>
			                    <td><?php echo date('d-m-Y',strtotime($value['duedate']));?></td>
		                  	</tr>					  
		                  <?php }} ?>
		                </tbody>
		                <thead class="no-border" status-o="<?php echo($_o);?>" status-w="<?php echo($_w);?>" status-c="<?php echo($_c);?>">
	              			<tr>
	              				<th>ID Task</th>
	              				<th>Tựa đề</th>
	              				<th>Ngày yêu cầu</th>
	              				<th>Mức độ ưu tiên</th>
	              				<!-- <th>Phân loại</th> -->
	              				<th>Trạng thái công việc</th>
	              				<th>Ngày đến hạn</th>
	              			</tr>
	              		</thead>
	              	</table>
	            </div>
          	</div>
        </div>
    </div>
</main>