<aside class="app-sidebar">
      <div class="app-sidebar__user"><img src="<?=base_url('images/icons/agi-logo.png')?>">
        <div>
          <p class="app-sidebar__user-name">John Doe</p>
          <p class="app-sidebar__user-designation">Frontend Developer</p>
        </div>
      </div>
      <ul class="app-menu">
        <li>
        	<a class="app-menu__item" onclick="addTab('<?= base_url('search') ?>','Tìm kiếm')" target="myiframetext" href="#" title="" alt="search">
	        	<img src="<?=base_url('images/icons/timkiem.png')?>">
	        	<span class="app-menu__label">Tìm kiếm</span>
	        </a>
	    </li>
	     <?php $var = $this->session->userdata;
                    $roleid = $var['roleid'];
                    if($roleid == '1')
                    {
                        $title_first = 'Cài đặt';
                        $alt_first = 'settings';
                        $icon_first = 'fas fa-user-circle';
                        $link = 'settings';
                    }
                    else{
                        $title_first = 'Phiếu';
                        $alt_first = 'ticket';
                        $icon_first = 'fas fa-file-alt'; 
                        $link = 'ticket';  
                    }

                     ?>
	    <?php $var = $this->session->userdata;
                    $roleid = $var['roleid'];
                    if($roleid != '1'){?> 
	    <li>
	        <a class="app-menu__item active" onclick="addTab('<?= base_url($link) ?>','<?php echo $title_first ?>')" target="myiframetext" href="#">
	        	<img src="<?=base_url('images/icons/list.png')?>">
	        	<span class="app-menu__label">Ticket</span>
	        </a>
	    </li>
	    <?php } ?>
	    <li>
        	<a class="app-menu__item click_navtab" onclick="addTab('<?= base_url('knowledge') ?>','Thư viện kiến thức')" target="myiframetext" href="#" alt="knowledge">
        		<img src="<?=base_url('images/icons/6.png')?>">
	        	<span class="app-menu__label">Thư viện kiến thức</span>
	        </a>
	    </li>

	    <li>
        	<a class="app-menu__item click_navtab" onclick="addTab('<?= base_url('task') ?>','Công việc')" target="myiframetext" href="#" alt="task">
        		<img src="<?=base_url('images/icons/7.png')?>">
	        	<span class="app-menu__label">Công việc</span>
	        </a>
	    </li>
	    <?php $var = $this->session->userdata;
                    $roleid = $var['roleid'];
                    if($roleid == '1'){?> 
	     <li>
        	<a class="app-menu__item active click_navtab" onclick="addTab('<?= base_url($link) ?>','<?php echo $title_first ?>')" target="myiframetext" target="myiframetext" href="#" alt="<?php echo $alt_first ?>">
	        	<img src="<?=base_url('images/icons/8.png')?>">
	        	<span class="app-menu__label">Cài đặt</span>
	        </a>
	    </li>
		<?php } ?>
      </ul>
    </aside>
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>