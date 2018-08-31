<main class="app-content padding-5 no-padding-right">
    <div class="row">
      	<div class="col-md-12 margin-bot-10 margin-top-5 margin-left-10">
      		<?php echo isset($top) ? $top : ''; ?>
      	</div>
        
        <div class="col-md-3 no-padding padding-left-15">
          	<?php echo isset($left) ? $left : ''; ?>
        </div>
        <div class="col-md-9">
          	<?php echo isset($center) ? $center : ''; ?>
        </div>
        <div class="col-md-2 col-md-22 no-padding padding-left-5 padding-top-10 padding-right-10">
        	<?php echo isset($right) ? $right : ''; ?>
        </div>
    </div>
</main>