<div class="tile p-0 padding-5 margin-bot-5">
	            <div class="tile-body">
	            	<div class="">
	            		<label class="control-label user-label col-md-3 no-padding">Mã giao dịch:</label>
	              		<label class="control-label col-md-8 no-padding-right col-brk-8"><a class="a_contractid" id="a_contractid" href="#" target="_blank"><?php echo $trade[0]['contractid'] ?></a></label>
	            	</div>
	            	<div class="">
	            		<label class="control-label user-label col-md-3 no-padding">Tình trạng</label>
	              		<label class="control-label col-md-8 no-padding-right"><?php echo $trade[0]['status'] ?></label>
	            	</div>
	            </div>
          	</div>
          	<div class="tile p-0 padding-5 margin-bot-5">
	            <div class="tile-body">
	            	<div class="">
	            		<label class="control-label user-label col-md-3 no-padding">Mã KH</label>
	              		<label class="control-label col-md-8 no-padding-right"><a class="a_custid" id="a_custid" href="#" target="_blank"><?php echo $trade[0]['clientcode'] ?></a></label>
	            	</div>
	            	<div class="">
	            		<label class="control-label user-label col-md-3 no-padding">BĐS</label>
	              		<label class="control-label col-md-8 no-padding-right"><?php echo $trade[0]['property'] ?></label>
	            	</div>
	            	<div class="">
	            		<label class="control-label user-label col-md-3 no-padding">Sàn</label>
	              		<label class="control-label col-md-8 no-padding-right"><?php echo $trade[0]['name'] ?></label>
	            	</div>
	            	<div class="">
	            		<label class="control-label user-label col-md-3 no-padding">NV phụ trách</label>
	              		<label class="control-label col-md-8 no-padding-right"><?php echo $trade[0]['name2'] ?></label>
	            	</div>
	            </div>
          	</div>
          	<div class="tile p-0 padding-5 margin-bot-5">
	            <div class="tile-body">
	            	<div class="">
	            		<label class="control-label user-label col-md-3 no-padding">Ngày bắt đầu</label>
	              		<label class="control-label col-md-8 no-padding-right"><?php 
	              		if($trade[0]['startdate'] !=null)
	              		{
	              		echo date("d/m/Y", strtotime($trade[0]['startdate']));} ?></label>
	            	</div>
	            	<div class="">
	            		<label class="control-label user-label col-md-3 no-padding">Ngày kết thúc</label>
	              		<label class="control-label col-md-8 no-padding-right">22/06/2018</label>
	            	</div>
	            	<div class="break-line margin-bot-5"></div>
	            	<div class="">
	            		<label class="control-label user-label col-md-3 no-padding">Giá trị HĐ</label>
	              		<label class="control-label col-md-8 no-padding-right"><?php echo number_format($trade[0]['contractvalue']) ?></label>
	            	</div>
	            	<div class="">
	            		<label class="control-label user-label col-md-3 no-padding">Giá chưa VAT</label>
	              		<label class="control-label col-md-8 no-padding-right"><?php echo number_format($trade[0]['value0']) ?></label>
	            	</div>
	            	<div class="">
	            		<label class="control-label user-label col-md-3 no-padding">Thuế VAT</label>
	              		<label class="control-label col-md-8 no-padding-right"><?php echo number_format($trade[0]['value1']) ?></label>
	            	</div>
	            	<div class="break-line margin-bot-5"></div>
	            	<div class="">
	            		<label class="control-label user-label col-md-3 no-padding">Phí bảo trì</label>
	              		<label class="control-label col-md-8 no-padding-right"><?php echo number_format($trade[0]['value2']) ?></label>
	            	</div>
	            	<div class="">
	            		<label class="control-label user-label col-md-3 no-padding">GT Q SDĐ</label>
	              		<label class="control-label col-md-8 no-padding-righte"><?php echo number_format($trade[0]['value3']) ?></label>
	            	</div>
	            	<div class="">
	            		<label class="control-label user-label col-md-3 no-padding">Giá tính VAT</label>
	              		<label class="control-label col-md-8 no-padding-righte"><?php echo number_format($trade[0]['value4']) ?></label>
	            	</div>
	            	<div class="">
	            		<label class="control-label user-label col-md-3 no-padding">Phí tư vấn</label>
	              		<label class="control-label col-md-8 no-padding-righte"><?php echo number_format($trade[0]['value5']) ?></label>
	            	</div>
	            	<div class="">
	            		<label class="control-label user-label col-md-3 no-padding">Giá trị CK</label>
	              		<label class="control-label col-md-8 no-padding-righte"><?php echo number_format($trade[0]['value6']) ?></label>
	            	</div>
	            	<div class="">
	            		<label class="control-label user-label col-md-3 no-padding">Giá trị cọc</label>
	              		<label class="control-label col-md-8 no-padding-righte"><?php echo number_format($trade[0]['value7']) ?></label>
	            	</div>
	            	<div class="">
	            		<label class="control-label user-label col-md-3 no-padding">Giá chuẩn <br> chưa VAT</label>
	              		<label class="control-label col-md-8 no-padding-righte"><?php echo number_format($trade[0]['value8']) ?></label>
	            	</div>
	            	<div class="break-line margin-bot-5"></div>
	            	<div class="">
	            		<label class="control-label user-label col-md-3 no-padding">Tổng GT HĐ</label>
	              		<label class="control-label col-md-8 no-padding-righte"><?php echo number_format($trade[0]['value9']) ?></label>
	            	</div>
	            </div>
          	</div>
          	<div class="tile p-0 padding-5 margin-bot-5">
	            <div class="tile-body">
	            	<div class="">
	            		<label class="control-label user-label col-md-3 no-padding">Loại vay</label>
	              		<label class="control-label col-md-8 no-padding-right"><?php echo $trade[0]['anal_pct8'] ?></label>
	            	</div>
	            	<div class="">
	            		<label class="control-label user-label col-md-3 no-padding">Ngân hàng</label>
	              		<label class="control-label col-md-8 no-padding-right"><?php echo $trade[0]['name1'] ?></label>
	            	</div>
	            	<div class="">
	            		<label class="control-label user-label col-md-3 no-padding">Chứng từ NH</label>
	              		<label class="control-label col-md-8 no-padding-right"></label>
	            	</div>
	            	<div class="break-line margin-bot-5"></div>
	            	<div class="">
	            		<label class="control-label user-label col-md-3 no-padding">Giá trị vay</label>
	              		<label class="control-label col-md-8 no-padding-right"><?php echo $trade[0]['loanvalue'] ?></label>
	            	</div>
	            	<div class="">
	            		<label class="control-label user-label col-md-3 no-padding">Ngày vay</label>
	              		<label class="control-label col-md-8 no-padding-right"><?php echo $trade[0]['loandate'] ?></label>
	            	</div>
	            	<div class="">
	            		<label class="control-label user-label col-md-3 no-padding">Ghi chú vay</label>
	              		<label class="control-label col-md-8 no-padding-right"><?php echo $trade[0]['loannotes'] ?></label>
	              		<label class="control-label user-label col-md-3 no-padding">Ngày ký</label>
	              		<label class="control-label col-md-8 no-padding-right"><?php echo $trade[0]['anal_pct7'] ?></label>



	            	</div>
	            	<div class="break-line margin-bot-5"></div>
	            	<div class="">
	            		<label class="control-label user-label col-md-3 no-padding">Số HĐ cọc</label>
	              		<label class="control-label col-md-8 no-padding-right"><?php echo $trade[0]['anal_pct8'] ?></label>
	              		<label class="control-label user-label col-md-3 no-padding">Số HĐ</label>
	              		<label class="control-label col-md-8 no-padding-right"><?php echo $trade[0]['anal_pct9'] ?></label>
	            	</div>
	            </div>
          	</div>
          	<div class="tile p-0 padding-5 margin-bot-5">
	            <div class="tile-body">
	            	<div class="">
	            		<label class="control-label user-label col-md-3 no-padding">Ghi chú</label>
	              		<label class="control-label col-md-8 no-padding-right"><?php echo $trade[0]['notes'] ?></label>
	            	</div>
	            </div>
          	</div>