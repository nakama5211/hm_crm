<div class="tile height-429 no-margin-bot">
	            <div class="content-title">
	            	<?php $contractid = $this->uri->segment(3);
	            		$custidCustomer = $this->uri->segment(4) ;
	            	 ?>
			        <button class="btn btn-blank insert-manual" alt="insert" onclick="addTab('<?php echo base_url().'ticket/viewInsert/'.$contractid.'/'.$custidCustomer ?>','Thêm Ticket',true)" type="button">+ Phiếu hỗ trợ  </button>
			    </div>
			    <div class="bs-component margin-top-10 tab-table-contract">
	              	<ul class="nav nav-tabs nav-user" role="tablist">
		                <li class="nav-item" role="presentation">
		                	<a class="user-tab active show" alt="crmContract01e"  data-toggle="tab" href="#tab-content-1">Thành viên</a>
		                </li>
		                <li class="nav-item" role="presentation">
		                	<a class="user-tab" data-toggle="tab" alt="crmContract01b" href="#tab-content-2">Lịch sử trạng thái</a>
		                </li>
		                <li class="nav-item" role="presentation"> 
		                	<a class="user-tab" data-toggle="tab" alt="crmContract01c" href="#tab-content-3">Công nợ/Thanh toán</a>
		                </li>
		                <li class="nav-item" role="presentation">
		                	<a class="user-tab" data-toggle="tab" alt="crmContract01d" href="#tab-content-4">KM/Quà tặng</a>
		                </li>
		                <li class="nav-item" role="presentation">
		                	<a class="user-tab" data-toggle="tab" alt="crmContract01f" href="#tab-content-5">NV Kinh doanh</a>
		                </li>
		                <li class="nav-item" role="presentation">
		                	<a class="user-tab" alt="crmContract01g"  data-toggle="tab" href="#tab-content-6">Điều chỉnh hợp đồng</a>
		                </li>
		                <li class="nav-item" role="presentation">
		                	<a class="user-tab" data-toggle="tab" alt="crmContract01h" href="#tab-content-7">Ghi chú</a>
		                </li>
	              	</ul>
	              	<div class="tab-content" id="myTabContent">
		                <div class="tab-pane fade active show" id="tab-content-1">
		                  	<div class="table-responsive" id="div-content-1" style="height: 294px;background:url(<?php echo base_url() ?>/images/ajax-loading.gif) center center no-repeat">
		                  		
				            </div>
		                </div>
		                <div class="tab-pane fade" id="tab-content-2">
		                  	<div class="table-responsive" id="div-content-2" style="height: 294px;">
		                  		<table class="table table-striped table-bordered" id="table-1-history">
                           <thead class="no-border-top">
                             <tr>
                               <th style="
                         width: 71px;">HH/DV</th>
                         <th style="
                         width: 123px;;">Ngày</th>
                         <th style="
                         width: 67px;">Số lượng</th><th style="
                         width: 65px;;">Giá trị</th>
                               <th width="323px">Ghi chú</th>
                             </tr>
                           </thead>
                           <tbody>
                         </table>
				            </div>
		                </div>
		                <div class="tab-pane fade" id="tab-content-3">
				              	<table class="table table-striped table-bordered" id="table-1-congno">
				              		<thead class="no-border-top">
				              			<tr>
				              				<th width="46px">Loại NK</th>
				              				<th width="19px">HĐC</th>
				              				<th width="38px">HĐMB</th>
				              				<th width="50px">Ngày NV</th>
				              				<th width="50px">Ngày ĐH</th>
				              				<th width="55px">S.tiền</th>
				              				<th width="220px">Diễn Giải</th>
				              				<th width="18px">PB</th>
				              				<th width="450px">Tiến Độ</th>
				              			</tr>
				              		</thead>
					                <tbody>
					                	
					                </tbody>
				              	</table>
		                </div>
		                <div class="tab-pane fade" id="tab-content-4">
		                  	<div class="table-responsive" id="div-content-4" style="height: 294px;">
		                  		<table class="table table-striped table-bordered" id="table-1-gift">
                           <thead class="no-border-top">
                             <tr>
                               <th style="
                         width: 71px;">Ngày</th>
                         <th style="
                         width: 123px;;">HH/DV</th>
                         <th style="
                         width: 67px;">Số lượng</th><th style="
                         width: 323px;;">Giá trị</th>
                               <th>Ghi chú</th>
                             </tr>
                           </thead>
                           <tbody>
                           </tbody>
                         </table>
				            </div>
		                </div>
		                <div class="tab-pane fade" id="tab-content-5">
		                  	<div class="table-responsive" id="div-content-5" style="height: 294px;">
		                  		<table class="table table-striped table-bordered" id="table-1-buss">
                           <thead class="no-border-top">
                             <tr>
                               <th style="
                 width: 195px;">Nhân viên</th><th style="
                 width: 117px;">Sàn</th><th style="
                 width: 83px;">Tỉ lệ thưởng</th>
                                               <th width="255px">Ghi chú</th>
                             </tr>
                           </thead>
                           <tbody>
                           </tbody>
                         </table>
				            </div>
		                </div>
		                <div class="tab-pane fade" id="tab-content-6">
				              	<div class="table-responsive" id="div-content-6" style="height: 294px;background:url(<?php echo base_url() ?>/images/ajax-loading.gif) center center no-repeat">
				              		
				              	</div>
		                </div>
		                <div class="tab-pane fade" id="tab-content-7">
		                  	<div class="table-responsive" class="div-content-7" id="div-content-7" style="height: 294px;">
				              	<table class="table table-striped table-bordered" id="table-1-notes">
                           <thead class="no-border-top">
                             <tr>
                               <th style="
                         width: 81px;">Loại ghi chú</th><th style="
                         width: 93px;">Ngày ghi chú</th><th style="
                         width: 71px;">Tình trạng</th><th style="
                         width: 169px">Nhân viên</th>
                               <th width="235px">Nội dung</th>
                             </tr>
                           </thead>
                           <tbody>
                           </tbody>
                         </table>
				            </div>
		                </div>
	              	</div>
	            </div>
          	</div>
<div class="tile height-429 margin-top-7">
	<div>
	<button type="button" class="fc-agendaWeek-button fc-button fc-state-default fc-state-active fc-corner-right">Ticket</button>
			    </div>
			    <div class="bs-component margin-top-10">
          			<div class="table-responsive" style="height: 396px;" id="div-table-ticket">
		              	<table class="table table-striped table-bordered" id="table-1-ticketcontract">
                      <thead class="no-border-top">
                        <tr>
                          <th width="60px">ID</th>
                          <th width="160px">Tựa đề</th>
                          <th width="100px">Ngày yêu cầu</th>
                          <th width="112px">Người phụ trách</th>
                          <th width="110px">Cập nhật lần cuối</th>
                        </tr>
                      </thead>
                      <tbody>

                      </tbody>
                    </table>
		            </div>
	            </div>
          	</div>