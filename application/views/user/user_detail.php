<main class="app-content padding-5 no-padding-right">
    <div class="row">
      	<div class="col-md-12 margin-bot-10 margin-top-5 margin-left-10">
      		<?php echo isset($top) ? $top : ''; ?>
      	</div>
        <div class="col-md-2 col-md-24 no-padding padding-left-15">
          	<?php echo isset($left) ? $left : ''; ?>
        </div>
        <div class="col-md-6 no-padding padding-left-5">
          	<?php echo isset($center) ? $center : ''; ?>
        </div>
        <div class="col-md-3 no-padding padding-left-5 padding-top-10 padding-right-10">
          <iframe class="iframehistory" id="iframehistory" style="width: 100%;height:1000px;display: block; border: none;"  src="<?php echo base_url() ?>user/viewUserHistory?cusid=<?php echo strval($this->input->get('cusid')) ?>"></iframe>
        	<!-- <?php echo isset($right) ? $right : ''; ?> -->
        </div>
    </div>
</main>