<main class="app-content padding-5 no-padding-right">
    <div class="row">
        <div class="col-md-2 col-md-22 no-padding padding-left-15">
          	<div class="tile p-0 padding-5 margin-bot-5">
	            <div class="tile-body padding-left-10" id="search_area">
	            	<div>
	              		<input class="form-control margin-top-10 margin-bot-5" type="text" name="s_text" placeholder="Tìm kiếm bài viết">
	              		<p class="font-size-8 field-click-able">Tìm theo bộ lọc</p>
	              	</div>
	              	<div class="">
	            		<label class="control-label user-label col-md-3 no-padding">Phân loại</label>
	              		<select name="s_type" class="control-label col-md-8 no-border no-padding margin-left-10" id="level_1">
	              			<option value="all" selected="" all="true">Tất cả</option>
	              			<?php if (isset($l_type) && !empty($l_type)) {
	              				foreach ($l_type as $key => $value) {
	              					echo '<option value="'.$value['code'].'">'.$value['name'].'</option>';
	              				}
	              			} ?>
	              		</select>
	            	</div>
	            	<div class="">
	            		<label class="control-label user-label col-md-3 no-padding">Nhóm vấn đề</label>
	              		<select name="s_group" class="control-label col-md-8 no-border no-padding margin-left-10" id="level_2">
	              			<option value="all" selected="" all="true">Tất cả</option>
	              			<?php if (isset($l_group) && !empty($l_group)) {
	              				foreach ($l_group as $key => $value) {
	              					echo '<option ref1="'.$value['ref1'].'" value="'.$value['code'].'">'.$value['name'].'</option>';
	              				}
	              			} ?>
	              		</select>
	            	</div>
	            	<div class="">
	            		<label class="control-label user-label col-md-3 no-padding">Chi tiết VĐ</label>
	              		<select name="s_cate" class="control-label col-md-8 no-border no-padding margin-left-10" id="level_3">
	              			<option value="all" selected="" all="true">Tất cả</option>
	              			<?php if (isset($l_cate) && !empty($l_cate)) {
	              				foreach ($l_cate as $key => $value) {
	              					echo '<option ref1="'.$value['ref1'].'" ref2="'.$value['ref2'].'" value="'.$value['code'].'">'.$value['name'].'</option>';
	              				}
	              			} ?>
	              		</select>
	            	</div>
	            	<div class="break-line margin-bot-5"></div>
	            	<div class="">
	            		<label class="control-label user-label col-md-3 no-padding">Đăng bởi</label>
	              		<select name="s_createby" class="control-label col-md-8 no-border no-padding margin-left-10">
	              			<option value="" selected="">Tất cả</option>
	              			<?php if (isset($agent) && !empty($agent)) {
	              				foreach ($agent as $key => $value) {
	              					echo '<option value="'.$value['custid'].'">'.$value['custname'].'</option>';
	              				}
	              			} ?>
	              		</select>
	            	</div>
	            	<div class="">
	            		<label class="control-label col-md-8 no-padding-right"></label>
	            		<label class="control-label col-md-8 no-padding-right"></label>
	            		<button id="btn-search" class="btn btn-primary float-right" type="button">Tìm kiếm</button>
	            		<label class="control-label col-md-8 no-padding-right"></label>
	            	</div>
	           	</div>
          	</div>       
	    </div>
        <div class="col-md-6 col-md-78 no-padding padding-left-5">
          	<iframe class="iframesearch" id="iframesearch" src="<?php echo base_url() ?>knowledge/search/?search="></iframe>     
        </div>
    </div>
</main>