<main class="app-content padding-5 no-padding-right">
    <div class="row">
        <div class="col-md-12 margin-bot-10 margin-top-5 margin-left-10">
          <?php echo isset($top) ? $top : ''; ?>
        </div>
        <div class="col-md-3 col-md-24 no-padding padding-left-15 height-1024">
            <?php echo isset($left) ? $left : ''; ?>
        </div>
        <div class="col-md-6 no-padding padding-left-5">
            <?php echo isset($center) ? $center : ''; ?>
        </div>
        <div class="col-md-3 no-padding padding-left-5 relative height-1024">
          <?php echo isset($right) ? $right : ''; ?>
        </div>
    </div>
</main>