<div class="tile height-1024">
	            <div class="content-title">
			        <div class="div">
			          <h5>Trường dữ liệu Phiếu hỗ trợ</h5>
			        </div>
			    </div>
			    <p class="margin-top-10 no-margin-bot">Trường dữ liệu người dùng cho phép định nghĩa các trường dữ liệu(fields) bổ sung các thông tin Phiếu hỗ trợ, các trường dữ liệu này chỉ có thể dùng cho mục đích phân tích PIVOT hoặc Báo cáo quản trị được thiết kế dành riêng cho, không áp dụng cho báo cáo, bảng điều khiển (dashboard) và đồ thị mặc định của hệ thống.</p>
			    <div class="row" style="margin-top: 50px;">
			    	<div class="col-md-5">
			    		<span><b>Trường dữ liệu hiện tại (<?php echo count($list_ext) ?>)</b></span>
			    	</div>
			    	<div class="col-md-7">
						    <div style="float: right;">
								<button type="button" class="fc-agendaWeek-button fc-button fc-state-default fc-state-active fc-corner-right" data-toggle="modal" data-target="#myModal1">Thêm</button>
							</div>
			    	</div>
			    </div>
			    
				<div class="bs-component margin-top-10">
					<?php 
					if(count($list_ext) >0)
					{
					foreach ($list_ext as $value) { ?>
					<a style="cursor: pointer;" class="user-name" onclick="addTab('<?php echo base_url()?>groupuser/fielddetail/<?php echo $value['fieldcode'] ?>/<?php echo $value['fieldtype'] ?>/<?php echo $value['datasource'] ?>','<?php echo $value['fieldname'] ?>')">
					<div class="component-fields">
						<?php if($value['fieldtype'] == 'T')
				                    {
				                    	$icon = 'fas fa-font';
				                    }
				                    else{
				                    	$icon = 'far fa-caret-square-down';
				                    }
				                     ?>
				                    <i class="<?php echo $icon ?>"></i> 
				                    <span class="title_tab" style="padding-left: 6px"><?php echo $value['fieldname'] ?></span>
					</div>
					</a>
					<?php }} ?>
	            </div>
          	</div>

          		<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document" style="margin-top: 8%">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Thêm trường dữ liệu Phiếu hỗ trợ</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
      		<div class="form-group">
					    <label for="exampleInputEmail1">Kiểu dữ liệu</label>
					    <select class="form-control" id="fieldtype" name="fieldtype" onchange="selectType(this)">
	              			<option selected="" class="group_item" value="T">Text</option>
	              			<option class="group_item" value="D">Drop down list</option>
	              		</select>
			</div>

			<div class="form-group">
					    <label for="exampleInputEmail1">Mã trường</label>
					    <input type="text" class="form-control" name="fieldcode" id="fieldcode" placeholder="-Mã trường">
			</div>

			<div class="form-group extendbottom">
					    <label for="exampleInputEmail1">Tên trường</label>
					    <input type="text" class="form-control" name="fieldname" id="fieldname" placeholder="-Tên trường">
			</div>

			
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
        <button type="button" class="btn btn-primary" onclick="insertExtUser('ticket')">Thêm</button>
      </div>
    </div>
  </div>
</div>