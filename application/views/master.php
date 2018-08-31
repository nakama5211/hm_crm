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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>css/jquery.scrolling-tabs.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>css/customer.css">
     <link rel="stylesheet" type="text/css" href="<?=base_url()?>css/customer2.css">
  </head>
  <body class="app sidebar-mini rtl sidenav-toggled">
    <!-- Navbar-->
    <?php echo isset($navbar) ? $navbar : ''; ?>
    <!-- Sidebar menu-->
    <?php echo isset($sidebar) ? $sidebar : ''; ?>
     
    <?php if(isset($link)){ ?>
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="1000">
                <iframe id="myiframe" class="myiframe" name="myiframe" src="<?php echo base_url().$link ?>" frameborder="0"></iframe>
            </div>
        </div>
    <?php } ?>
    <div class="holds-the-iframe">
    <script type="text/javascript">
        var arrayTab = [];
        for(var i = 100; i<1000;i++)
        {
            arrayTab.push(i);
        }
    </script>
    <iframe id="myiframetext" width="0" height="0" class="myiframetext" name="myiframetext" src="<?php echo base_url().$link ?>" frameborder="0"></iframe>
    </div>
    <!-- Essential javascripts for application to work-->
    <script src="<?=base_url()?>js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="<?=base_url()?>js/popper.min.js"></script>
    <script src="<?=base_url()?>js/bootstrap.min.js"></script>
    <script src="<?=base_url()?>js/main.js"></script>
    <script src="<?=base_url()?>js/main2.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="<?=base_url()?>js/plugins/pace.min.js"></script>
    <!-- Page specific javascripts-->
    <script type="text/javascript" src="<?=base_url()?>js/plugins/chart.js"></script>
    <script type="text/javascript" src="<?=base_url()?>js/plugins/bootstrap-notify.min.js"></script>
    <script type="text/javascript" src="<?=base_url()?>js/plugins/sweetalert.min.js"></script>
    
            <script src="<?php echo base_url() ?>js/jquery.scrolling-tabs.js"></script>
            <?php echo isset($script2) ? $script2 : ''; ?>
    <!-- <------------------script -->
    <?php echo isset($script) ? $script : ''; ?>
    <?php echo isset($nodejs) ? $nodejs : ''; ?>
  </body>
</html>