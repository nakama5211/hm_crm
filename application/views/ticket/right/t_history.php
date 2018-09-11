<div class="div-info-customer">
<?php if(isset($customer)){ ?>
<div class="tile p-0 padding-5 margin-bot-5">
  <div class="content-title user-history">
    <div class="width-100per">
    	<p class="flex">
        <img onclick="addTab('<?php echo base_url()."user/detail/?cusid=".$customer[0]['custid']."&idcard=".$customer[0]['idcard']."&roleid=".$customer[0]['roleid']?>','<?php echo $customer[0]['custname'] ?>')" class="user-avatar" src="<?php echo $customer[0]['avatar']; ?>" alt="User Image"><?php echo $customer[0]['custname'];?> - <?php echo $customer[0]['groupname'];?>
      </p>
    	<p class="header-desc field-click-able">
        Ngày tạo: <?php echo date("d/m/Y", strtotime($customer[0]['createddate']));?>
      </p>
      <p class="margin-left-50">
        Số điện thoại: 
        <a href="#" onclick="parent.iframe_click('<?php echo($customer[0]['telephone'])?>','<?php echo($this->uri->segment(3))?>')" id="user_phone_number">
          <?php echo($customer[0]['telephone'])?>
        </a>
      </p>
    </div>
  </div>
</div>
<?php } ?>
</div>
<div class="div-recent-ticket">
  <div class="tile p-0 padding-5 margin-bot-5">
	 <p class="no-margin">Phiếu gần nhất</p>
      <div class="table-responsive">
        <table class="table" id="table-22">
          <thead class="hide">
            <tr>
              <th></th>
              <th></th>
            </tr>
          </thead>
        </table>
      </div>
  </div>
</div>

<div class="div-contract">
  <div class="tile p-0 padding-5 margin-bot-5">
  	<p class="no-margin">Giao dịch gần nhất</p>
      <div class="table-responsive">
        <table class="table" id="table-23">
          <thead class="hide">
            <tr>
              <th></th>
              <th></th>
              <th></th>
            </tr>
          </thead>
        </table>
      </div>
  </div>
</div>
<div class="tile p-0 padding-5 margin-bot-5 toggle-up">
   <p>Thư viện kiến thức
    <i class="fa fa-angle-double-up knl-caret"></i>
    </p>
    <div class="flex margin-top-12 padding-right-5">
      <button class="btn btn_blank" id="knl-btn-back" type="button">
        <i class="fa fa-arrow-left"></i>
      </button>
      <div class="knl-input-group flex">
          <input name="knl_text" class="width-100per" type="text">
          <i class="fa fa-search search-knowledge"></i>
      </div>
    </div>
    <div class="knl-board hide margin-top-5">
      <div id="knl_list" class="padding-5">
      <?php 
      if(count($news)>0)
      {
        $i=0;
        foreach ($news as $value) { ?>

        <p><a style="cursor: pointer; color: #009688" onclick="showDetailKnowledge('<?php echo $value['id'] ?>')">#<?php echo $value['title'] ?></a></p>

        <?php if ($i==2) {
        // break;
      }else{
        $i++;
      } } }?>
      </div>
      <div class="knl-content hide padding-5">
      </div>
    </div>
</div>