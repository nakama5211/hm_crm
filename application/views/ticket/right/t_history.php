<div class="div-info-customer">
<?php 
            if(isset($info_customer)){ ?>
<div class="tile p-0 padding-5 margin-bot-5">

    <div class="content-title user-history">
      
        <div class="div">
          	<p><img class="user-avatar" src="<?php 
            if(count($info_customer)>0){
            echo $info_customer[0]['avatar'];} ?>" alt="User Image"><?php 
            if(count($info_customer)>0){
              echo $info_customer[0]['custname'];} ?></p>
          	<p class="header-desc field-click-able">Ngày tạo: <?php 
            if(count($info_customer)>0){
                echo date("d/m/Y", strtotime($info_customer[0]['createddate'] ));}
             ?></p>
            <p class="margin-left-50">Số điện thoại: <a href="#" onclick="parent.iframe_click('<?php echo($info_customer[0]['telephone'])?>','<?php echo($ticketid)?>')" id="user_phone_number"><?php echo($info_customer[0]['telephone'])?></a></p>
        </div>
    </div>
</div>

      <?php } ?>
</div>
<div class="div-recent-ticket">
<?php if (isset($recent_ticket)){?>
<div class="tile p-0 padding-5 margin-bot-5">
	<p>Phiếu gần nhất</p>
    <div class="table-responsive">
      <?php if(count($recent_ticket)==0){
        echo 'Không có phiếu gần đây!';
      } ?>
      	<table class="table" id="table-2">
            <tbody>
              <?php if(count($recent_ticket)>0)
              {   $c = 0;
                  foreach ($recent_ticket as $value) {
                    if(($value['agentcurrent'] == $agentcurrent['custid'] || strpos($rows['ticketusers'], $agentcurrent) !== false) && $rows['hidden'] == 0 && $rows['status'] != 9)
                        {
                    ?>
              <tr>
                    <td width="60">
                      <?php $title = '#'.$value['ticketid'];
                            $url = base_url().'ticket/detail/'.$value['ticketid'].'/'.$value['custid'].'/'.$value['idcard'] ?>
                      <span class="id-label span-warning">P</span>  <a style="cursor: pointer;" class="user-name" onclick="addTab('<?php echo $url ?>','<?php echo $title ?>')">#<?php echo $value['ticketid'] ?></a>
                    </td>
                    <td><?php echo $value['title'] ?></td>
                </tr> 
              <?php if ($c==2) {
                break;
              }else $c++;}}}?>			  
            </tbody>
      	</table>

    </div>
</div>
<?php } ?>
</div>

<div class="div-contract">
<?php if(isset($contract)){ ?>
<div class="tile p-0 padding-5 margin-bot-5">
	<p>Giao dịch gần nhất</p>
    <div class="table-responsive">
       <?php if(count($contract)==0){
        echo 'Không có phiếu gần đây!';
       } ?>
      	<table class="table" id="table-2">
            <tbody>
              <?php if(count($contract)>0){
                $c=0;
                foreach ($contract as $value) { ?>
                  <tr>
                    <td width="60">
                      <?php $titleContract = '#'.$value['contractid'];
                            $urlContract= base_url().'user/contract/'.$value['contractid']; ?>
                      <a style="cursor: pointer;" class="user-name" onclick="addTab('<?php echo $urlContract ?>','<?php echo $titleContract ?>')">#<?php echo $value['contractid'] ?></a>
                    </td>
                    <td><?php echo $value['status'] ?></td>
                    <td><?php echo $value['property'] ?></td>
                </tr> 
                <?php if ($c==2) {
                  break;
                }else $c++;}} ?> 
            </tbody>
      	</table>
    </div>
</div>
<?php } ?>
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