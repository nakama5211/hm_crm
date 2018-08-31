<div class="tile height-1024">
	            <div class="content-title">
			        <div class="div">
			          <h5>Người dùng</h5>
			        </div>
			        <ul class="app-breadcrumb breadcrumb">
				        <li class="breadcrumb-item"><a style="cursor: pointer;" onclick="addTab('<?php echo base_url().'user/create' ?>','Thêm User')">Thêm</a></li>
			        </ul>
			    </div>
			    <p class="margin-top-10 no-margin-bot">Người dùng là những người tương tác với hệ thống AGI CRM, bao gồm chuyên viên của AGI và khách hàng của AGI, họ tương tác thông qua chủ thể là Phiếu hỗ trợ (Tickets). Bạn có thể tạo các trường thông tin mở rộng và phân nhóm để quản lý người dùng được tốt hơn.</p>
			    <div class="row margin-top-10">
	                <div class="form-group col-md-6 no-padding-right">
	                  <input id="keyword" class="form-control" type="text" placeholder="Nhập từ khóa...">
	                </div>
	                <div class="form-group col-md-3 align-self-end padding-left-1">
	                  <button class="btn btn-primary" onclick="search()" type="button">Tìm kiếm</button>
	                  <img src="<?php echo base_url().'images/loader.gif' ?>" style="display: none;"  id="loading">
	                </div>
	            </div>
	            <ul class="app-breadcrumb breadcrumb">
            		<p class="margin-right-10 font-size-12">Lọc nhanh:</p>
			        <li class="breadcrumb-item"><a class="user-name" style="cursor: pointer;" onclick="searchRoleid('3')">Khách hàng</a></li>
			        <li class="breadcrumb-item"><a class="user-name" style="cursor: pointer;" onclick="searchRoleid('2')">Chuyên viên</a></li>
			        <li class="breadcrumb-item"><a class="user-name" style="cursor: pointer;" onclick="searchRoleid('1')">Quản trị viên</a></li>
		        </ul>
		        <div class="content-search">
		        <div class="table-responsive">
	              <table class="table" id="tableUser">
	              	<thead>
	              		<tr>
				            <th></th>
				            <th>Họ tên</th>
				            <th>SĐT</th>
				            <th>Email</th>
				        </tr>
	              	</thead>
	                <tbody>
	                  	<?php foreach ($user as $value) { ?>
	                  		<tr>
	                  		<td width="40px">
		                    	<img class="user-avatar" src="<?php echo $value['avatar'] ?>" alt="User Image">
		                    </td>
		                    <td width="252px">
		                    	<a class="user-name" style="cursor: pointer;" onclick="addTab('<?php echo base_url().'user/detail/?cusid='.$value['custid'].'&idcard='.$value['idcard'].'&roleid='.$value['roleid'] ?>','<?php echo $value['custname'] ?>')"><?php echo $value['custname'] ?></a>
		                    	<p class=""><?php echo $value['groupid'] ?></p>
		                    </td>
		                    <td width="229px"><?php echo $value['telephone'] ?></td>
		                    <td width="218px"><?php echo $value['email'] ?></td>
		                  </tr>
	                  	<?php } ?>
	                    
	                </tbody>
	              </table>
	            </div>
	            </div>
          	</div>