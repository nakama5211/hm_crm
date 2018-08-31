<?php $type = $this->uri->segment(4); ?>
<div class="tile height-1024">
	            <div class="content-title">
			        <div class="div">
			          <h5>Danh sách dữ liệu trường: <?php echo isset($detail[0]['fieldname'])?$detail[0]['fieldname']:'' ?></h5>
			        </div>
			    </div>
				    <div style="float: right;">
						<button <?php if($type == 'T'){echo 'hidden';} ?> type="button" class="fc-agendaWeek-button fc-button fc-state-default fc-state-active fc-corner-right" data-toggle="modal" data-target="#myModal">Thêm</button>
					</div>
			    
				<div class="bs-component" style="margin-top: 55px">
					<?php if ($type == 'T'){
						echo '<div class="component-fields">
				                    <i class="fas fa-align-justify"></i> 
				                    <span class="title_tab" style="padding-left: 6px">Text</span>
							</div>';
					} ?>
					<?php if(count($list_ext)>0){
						foreach ($list_ext as $value) { ?>
							<div class="component-fields">
				                    <i class="fas fa-align-justify"></i> 
				                    <span class="title_tab" style="padding-left: 6px"><?php echo $value['name'] ?></span>
				                    <a class="user-name" style="cursor: pointer;float: right;" data-toggle="modal" data-target="#modalDelete" data-code="<?php echo $value['code'] ?>" data-category="<?php echo $value['category'] ?>"><i class="far fa-trash-alt"></i></a>
				                     <a class="user-name" style="cursor: pointer;float: right; margin-right: 15px"  data-toggle="modal" data-target="#modalUpdate" data-code="<?php echo $value['code'] ?>" data-category="<?php echo $value['category'] ?>" data-name="<?php echo $value['name'] ?>"><i class="fas fa-edit"></i></a>
							</div>
						<?php }}?>
	            </div>
          	</div>
 <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document" style="margin-top: 5%">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Dropdown Options</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
	        	<div class="form-group optionbottom">
				    <label for="exampleInputEmail1">Mã trường</label>
				    <input type="text" class="form-control" name="code" id="code" placeholder="-Mã trường">
				</div>

				<div class="form-group extendbottom">
						    <label for="exampleInputEmail1">Tên trường</label>
						    <input type="text" class="form-control" name="name" id="name" placeholder="-Tên trường">
				</div>
				<input type="hidden" name="category" id="category" value="<?php echo $this->uri->segment(5) ?>">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
        <button type="button" onclick="insertSelectBox()" class="btn btn-primary">Thêm</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" style="margin-top: 7%" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Xoá Option</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <p class="bg-danger" style="padding: 10px;color: #FFF;" >Bạn có chắc muốn xoá không?</p>
        <input type="hidden" id="categorydelete" name="categorydelete">
        <input type="hidden" id="codedelete" name="codedelete">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
        <button type="button" onclick="deleteButton()" class="btn btn-danger">Xoá</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalUpdate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" style="margin-top: 7%" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Sửa Option</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
      	<div class="form-group">
		    <label for="exampleInputEmail1">Tên SelectBox:</label>
		    <input type="text" class="form-control nameField" id="nameField" name="name" placeholder="Tên SelectBox">
		</div>
        <input type="hidden" id="category" name="category">
        <input type="hidden" class="code" id="code" name="code">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
        <button type="button" onclick="updateButton()" class="btn btn-primary">Sửa</button>
      </div>
    </div>
  </div>
</div>