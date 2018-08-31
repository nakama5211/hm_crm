<main class="app-content padding-5 no-padding-right">
    <div class="row">
        <div class="col-md-2 col-md-18 no-padding padding-left-10">
          	<?php echo isset($left)?$left:'' ?>
        </div>
        <div class="col-md-7 col-md-64 no-padding padding-left-1">

        <iframe class="iframesetting" id="iframesetting" style="width: 100%;display: block; border: none;height: 100vh"  src="<?php echo base_url().'setting/viewUser' ?>"></iframe>
        </div>
        <div class="col-md-2 col-md-18 no-padding padding-left-5">
        	<?php echo isset($right)?$right:'' ?>
        </div>
    </div>
</main>