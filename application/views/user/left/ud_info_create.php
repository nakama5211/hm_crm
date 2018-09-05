<form id="insertUserVal" method="POST" role="form">
<div class="tile p-0 padding-5 margin-bot-5">
	            <div class="tile-body padding-left-10">
	            	<div class="">
	            		<label class="control-label user-label col-md-3 no-padding">Phân quyền
	              		(<span style="color: red">*</span>)</label>
	              		<select name="roleid" class="control-label col-md-8 no-border no-padding margin-left-10" id="roleid" onchange="selectGroup(this)" required="">
	              			<option selected="true" disabled="true" value="">--Chọn Phân Quyền--</option>
	              			<?php
	              				foreach ($role_list as $key => $value) {
	              					?>
	              						<option value="<?php echo $key ?>" ><?php echo $value?></option>
	              					<?php
	              				}
	              			?>
	              		</select>
	            	</div>
	            	<div class="div-group">
	            		<label class="control-label user-label col-md-3 no-padding">Nhóm
	              		(<span style="color: red">*</span>)</label>
	              		<select name="groupid" class="control-label col-md-8 no-border no-padding margin-left-10  grouplist" id="groupid" required="">
	              			<option selected="true" disabled="true" value="">--Chọn Nhóm Quyền--</option>
	              			<?php
	              				foreach ($group_list as $value) {
	              					?>
	              						<option value="<?php echo $value['groupid'] ?>" ><?php echo $value['groupname']?></option>
	              					<?php
	              				}
	              			?>
	              		</select>
	            	</div>
	            </div>
          	</div>

          	<div class="tile p-0 padding-5 margin-bot-5">
	            <div class="tile-body padding-left-10">
	            	<div class="">
	            		<label class="control-label user-label col-md-3 no-padding">Họ và Tên</label>
	              		<label class="control-label col-md-8 no-padding-right">
		              		<input class="col-md-12 no-padding font-size-12" required="" value="" placeholder="Nhập họ tên" name="custname" id="custname">
		              	</label>
	            	</div>
	            	<div class="div-danhxung">
	            		<label class="control-label user-label col-md-3 no-padding">Danh xưng</label>
	              		<select class="control-label col-md-8 no-border no-padding margin-left-10" name="gender" id="gender">
	              			<option value="M">Ông</option>
	              			<option value="F">Bà</option>
	              		</select>
	            	</div>

	            	<div class="div-cmnd">
	            		<label class="control-label user-label col-md-4 no-padding">CMND/Passport
	              		(<span style="color: red">*</span>):</label>
	              		<label class="control-label col-md-7 no-padding-right">
		              		<input id="idcard" name="idcard" required="" class="col-md-12 no-padding font-size-12" value="" placeholder="Nhập cmnd" required minlength="8">
		              	</label>
	            	</div>
	            	<div class="div-ngaysinh">
	            		<label class="control-label user-label col-md-3 no-padding">Ngày sinh:</label>
	              		<label class="control-label col-md-8 no-padding-right">
		              		<input id="fullbirthday" name="fullbirthday" placeholder="dd-mm-yy" class="col-md-12 no-padding font-size-12" value="">
		              	</label>
	            	</div>
	            	<div class="break-line margin-bot-5"></div>
	            	<div class="div-phone">
	            		<label class="control-label user-label col-md-3 no-padding">Điện thoại</label>
	              		<label class="control-label col-md-8 no-padding-right">
		              		<input id="telephone" name="telephone" required="" class="col-md-12 no-padding font-size-12" value="" placeholder="Nhập sdt chính">
		              	</label>
	            	</div>
	            	<div class="break-line margin-bot-5"></div>

	            	<div class="div-email">
	            		<label class="control-label user-label col-md-3 no-padding">E-mail</label> 
	            	
	            		<label class="control-label col-md-8 no-padding-right">
		              		<input id="email" name="email" type="email" required="" class="col-md-12 no-padding font-size-12" value="" placeholder="Nhập email chính">
		              	</label>
	            	</div>
	            	<div class="break-line margin-bot-5"></div>
	            	<div class="">
	            		<label class="control-label user-label col-md-3 no-padding">Địa chỉ</label>
	              		<label class="control-label col-md-8 no-padding-right">
	              			<input list="l_country" placeholder="Quốc Gia" value="Việt Nam" name="country" class="col-md-12 no-padding font-size-12">
							<datalist id="l_country">
		              				<option>Việt Nam</option>
							</datalist>
		              	</label>
	            	</div>
	            	<div class="">
	              		<label class="control-label user-label col-md-3 no-padding"></label>
	              		<label class="control-label col-md-8 no-padding-right">
	              			<input list="l_city" placeholder="Tỉnh / Thành Phố" name="city" class="col-md-12 no-padding font-size-12">
							<datalist id="l_city">
								<?php 
		              			if(isset($city)){
		              			foreach ($city as $rows) { ?>
		              				<option id-city="<?php echo $rows->id_city?>" value="<?php echo $rows->name?>"></option>
		              			<?php }} ?>
							</datalist>
	              		</label>
	            	</div>
	            	<div class="">
	            		<label class="control-label user-label col-md-3 no-padding"></label>
	              		<label class="control-label col-md-8 no-padding-right">
	              			<input list="l_distr" placeholder="Quận / Huyện" name="district" class="col-md-12 no-padding font-size-12">
							<datalist id="l_distr">
							</datalist>
	              		</label>
	            	</div>
	            	<div class="">
	            		<label class="control-label user-label col-md-3 no-padding"></label>
	              		<label class="control-label col-md-8 no-padding-right">
	              			<input list="l_ward" placeholder="Phường / Xã" name="ward" class="col-md-12 no-padding font-size-12">
							<datalist id="l_ward">
							</datalist>
	              		</label>
	            	</div>
	            	<div class="">
	            		<label class="control-label user-label col-md-3 no-padding"></label>
	            		<label class="control-label col-md-8 no-padding-right">
	              			<input name="street" class="col-md-12 no-padding font-size-12" placeholder="Đường">
		              	</label>
	            	</div>
	            	<div class="">
	            		<label class="control-label user-label col-md-3 no-padding"></label>
	            		<label class="control-label col-md-8 no-padding-right">
	              			<input name="address" class="col-md-12 no-padding font-size-12" placeholder="Số nhà">
		              	</label>
	            	</div>
	            </div>
          	</div>
          	<div class="tile p-0 padding-5 margin-bot-5 div-ghichu">
	            <div class="tile-body padding-left-10">
	            	<div class="">
	            		<label class="control-label user-label col-md-3 no-padding">Tags</label>
	              		<label class="control-label col-md-8 no-padding-right">
		              		<input name="tag" id="tag" class="col-md-12 no-padding font-size-12 available" value="" placeholder="Tags">
		              	</label>
	            	</div>
	            	<div class="">
	            		<label class="control-label user-label col-md-3 no-padding">Ghi chú</label>
	              		<label class="control-label col-md-8 no-padding-right">
		              		<input name="comments" id="comments" class="col-md-12 no-padding font-size-12 available" value="" placeholder="Nhập ghi chú">
		              	</label>
	            	</div>
	            </div>
          	</div>
          	<div class="tile p-0 padding-5 margin-bot-5 div-bonus">
	            <div class="tile-body padding-left-10">
	            	
	            	<?php foreach ($list_ext as $value) {
	            	if($value['formid'] == 'user' && $value['status'] == '1' ){
	             ?>
	            	<div class="">
	            		<label class="control-label user-label col-md-3 no-padding">
	            			<?php echo $value['fieldname'] ?>
	            		</label>
	              			<?php if($value['fieldtype'] == 'T') {?>
	              		<label class="control-label col-md-8 no-padding-right">
		              		<input name="ext[<?php echo $value['fieldcode'] ?>]" id="<?php echo $value['fieldcode'] ?>" class="col-md-12 no-padding font-size-12 available" value="" placeholder="<?php echo $value['fieldname'] ?>">
		              	</label>
	              		<?php }else if($value['fieldtype'] == 'D'){?>
	              			<select name="ext[<?php echo $value['fieldcode'] ?>]" class="control-label col-md-8 no-border no-padding margin-left-10" id="<?php echo $value['fieldcode'] ?>">
	              			<?php foreach ($list_codic as $material) {
	              				if($material['category'] == $value['datasource'] && $material['status'] =='W'){
	              				?>
	              				<option value="<?php echo $material['code'] ?>"><?php echo $material['name'] ?></option>
	              			<?php }}?> 
	              			</select>
	              		<?php } ?>
	            	</div>
	            <?php }} ?>
	            </div>
          	</div>

          	<div class="fc-corner-right">
          		<div class="fc-button-group" style="float:right">
					<button type="submit" id="btn-save" class="btn btn-primary float-right margin-bot-5">
								<i class="fa fa-share"></i> Lưu thông tin</button>
				</div>
          	</div>
     </form>

     <!-- <div class="modal fade" id="updateIdcard" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			  <div class="modal-dialog" style="margin-top: 5%; width: 31%" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h4 class="modal-title" id="myModalLabel">CMND/ID</h4>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			      </div>
			      <div class="modal-body">
					  <div class="form-group">
					    <label class="control-label user-label col-md-3 no-padding">Loại hình: </label>
	              		<label class="control-label col-md-8 no-padding-right">
	              			<input list="l_type" placeholder="Loại hình" name="type" class="col-md-12 no-padding font-size-12">
							<datalist id="l_type">
								<option data-value="cmnd">CMND</option>
								<option data-value="passport">Passport</option>
							</datalist>
	              		</label>
					  </div>
			        <div class="form-group">
					    <label class="control-label user-label col-md-3 no-padding">Số: </label>
	              		<label class="control-label col-md-8 no-padding-right">
	              			<input list="l_distr" placeholder="Số" name="idcard" class="col-md-12 no-padding font-size-12">
							<datalist id="l_distr">
							</datalist>
	              		</label>
					  </div>
					  <div class="form-group">
					    <label class="control-label user-label col-md-3 no-padding">Ngày cấp: </label>
	              		<label class="control-label col-md-8 no-padding-right">
	              			<input placeholder="Ngày cấp" name="issuedday" class="col-md-12 no-padding font-size-12" id="issuedday">
	              		</label>
					  </div>
					  
			      	<div class="form-group">
					    <label class="control-label user-label col-md-3 no-padding">Nơi cấp: </label>
					    <label class="control-label col-md-8 no-padding-right">
					    <input list="l_city" placeholder="Nơi cấp" name="issuedplace" class="col-md-12 no-padding font-size-12" id="issuedplace">
							<datalist id="l_city">
							</datalist>
						</label>
					</div>
			      </div>

			      <div class="modal-footer" style="background: #f5f5f5">
			        <button type="button" class="btn btn-gray-white float-right" data-dismiss="modal">Đóng</button>
			        <button type="button" class="btn btn-gray-black float-right btn-addfulladdress" data-dismiss="modal">Thêm</button>
			      </div>
			    </div>
			  </div>
			</div> -->
