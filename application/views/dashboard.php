<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Customer Relationship Managerment</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <!-- Customer CSS-->
    <link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    
    <link rel="stylesheet" href="<?php echo base_url() ?>css/jquery.scrolling-tabs.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>css/customer.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>css/customer2.css">
  </head>
  <body class="app sidebar-mini rtl sidenav-toggled">
    <!-- <?php $dayCompare = strtotime('2000-01-01T00:00:00');?> -->
    <?php echo isset($mainview) ? $mainview : ''; ?>
    

    <!-- Essential javascripts for application to work-->
    <script src="<?=base_url()?>js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
    <script type="text/javascript" src="http://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.4/moment.min.js"></script>
    <script type="text/javascript" src="//cdn.datatables.net/plug-ins/1.10.19/sorting/datetime-moment.js"></script>
    <script src="<?=base_url()?>js/popper.min.js"></script>
    <script src="<?=base_url()?>js/bootstrap.min.js"></script>
    <script src="<?=base_url()?>js/main.js"></script>
    <script src="<?=base_url()?>js/main2.js"></script>
    <script src="<?=base_url()?>js/plugins/pace.min.js"></script>
    <script type="text/javascript" src="<?=base_url()?>js/plugins/chart.js"></script>
    <script type="text/javascript" src="<?=base_url()?>js/plugins/sweetalert.min.js"></script>
    <script src="<?php echo base_url() ?>datetimepicker-master/build/jquery.datetimepicker.full.min.js"></script>
    
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>datetimepicker-master/jquery.datetimepicker.css"/>
    <script src="<?php echo base_url() ?>js/jquery.scrolling-tabs.js"></script>
    <script type="text/javascript" src="<?=base_url()?>js/plugins/jquery.validate.min.js"></script>
    <script type="text/javascript" src="<?=base_url()?>ckeditor/ckeditor.js"></script>
    <script type="text/javascript" src="<?=base_url()?>ckfinder/ckfinder.js"></script>

    <?php echo isset($script) ? $script : ''; ?>
    <?php echo isset($script2) ? $script2 : ''; ?>
    
  </body>
</html>