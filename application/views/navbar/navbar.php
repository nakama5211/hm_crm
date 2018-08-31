<header class="app-header">
    <div class="row" style="width: 100%">
          <div id="lengthmenu" class="col-md-11">
            <ul class="nav nav-tabs nav-menu main-nav nav-inline" role="tablist">
                    <?php $var = $this->session->userdata;
                        $roleid = $var['roleid'];
                        if($roleid == '1')
                        {
                            $title_first = 'Cài đặt';
                            $icon_first = 'fas fa-user-circle';
                            $link = base_url().'settings';
                        }
                        else{
                            $title_first = 'Phiếu';
                            $icon_first = 'fas fa-file-alt'; 
                            $link = base_url().'ticket';  
                        }

                         ?>
                <li class="nav-item width-170" role="presentation">
                    <a name="<?php echo $link ?>" class="nav-link active show" role="tab" data-toggle="tab" href="#1000" title="<?php echo $title_first ?>">
                        <i class="<?php echo $icon_first ?>"></i> 
                        <span class="title_tab">
                     <?php echo $title_first ?></span></a><span class="fa fas fa-times" aria-hidden="true"></span>
                </li>
            </ul>
            
            <ul class="nav-insert nav-inline">
                <li class="dropdown dropdown-left" id="li-main">
                <a class="nav-link" aria-expanded="false" href="#add" data-toggle="dropdown"><i class="fa fa-plus fa-lg"></i></a>
              <ul class="dropdown-menu settings-menu dropdown-menu-right">
                <?php if ($var['roleid'] != '1') { ?>
                    
                <li><a class="dropdown-item" alt="insert" onclick="addTab('<?php echo base_url().'ticket/viewInsert/' ?>','Thêm Ticket',true)" href="#"><i class="fa fa-file-alt fa-fw"></i> Thêm Ticket</a></li>
                <?php } ?>
                <li><a class="dropdown-item" alt="insert" onclick="addTab('<?php echo base_url().'user/create' ?>','Thêm User',true)" href="#"><i class="fa fa-user fa-lg"></i> Thêm User</a></li>
                <li><a class="dropdown-item" alt="insert" onclick="addTab('<?php echo base_url().'task/create' ?>','Thêm Công việc',true)" href="#"><i class="fa fa-tasks fa-lg"></i> Thêm Task</a></li>
              </ul>
            </li>
            </ul>
          </div>
          <div class="col-md-1">
              <ul class="app-nav">
                <li class="dropdown">
                    <a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Show notifications">
                        <span class="fa-stack fa-sm"><i class="fa fa-circle fa-stack-2x text-primary"></i><i class="fa fa-bell fa-stack-1x fa-inverse"></i></span>
                    </a>
                  <ul class="app-notification dropdown-menu dropdown-menu-right">
                    <li class="app-notification__title">You have 4 new notifications.</li>
                    <div class="app-notification__content">
                      <li><a class="app-notification__item" href="javascript:;"><span class="app-notification__icon"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x text-primary"></i><i class="fa fa-envelope fa-stack-1x fa-inverse"></i></span></span>
                          <div>
                            <p class="app-notification__message">Lisa sent you a mail</p>
                            <p class="app-notification__meta">2 min ago</p>
                          </div></a></li>
                      <li><a class="app-notification__item" href="javascript:;"><span class="app-notification__icon"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x text-danger"></i><i class="fa fa-hdd-o fa-stack-1x fa-inverse"></i></span></span>
                          <div>
                            <p class="app-notification__message">Mail server not working</p>
                            <p class="app-notification__meta">5 min ago</p>
                          </div></a></li>
                      <li><a class="app-notification__item" href="javascript:;"><span class="app-notification__icon"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x text-success"></i><i class="fa fa-money fa-stack-1x fa-inverse"></i></span></span>
                          <div>
                            <p class="app-notification__message">Transaction complete</p>
                            <p class="app-notification__meta">2 days ago</p>
                          </div></a></li>
                      
                    </div>
                    <li class="app-notification__footer"><a href="#">See all notifications.</a></li>
                  </ul>
                </li>
                <!-- phone -->

                <li class="dropdown">
                    <a class="app-nav__item" href="#" id="dropdown-btn" aria-label="Open Profile Menu">
                        <span class="fa-stack fa-sm">
                            <i class="fa fa-circle fa-stack-2x text-primary"></i>
                            <i class="fa fa-envelope fa-stack-1x fa-inverse"></i>
                        </span>
                    </a>
                  <div id="phone-chat" class="dropdown-menu settings-menu dropdown-menu-right" extension="" style="width: 241px; padding: 5px;">
                    <div id="c-chanel" class="margin-left-right-5">
                        <label id="channel" channel="" class="control-label col-md-6 no-padding">Kênh thoại</label>
                        <div id="status-selection" class="active status-online">
                            <span class="status-circle"></span> 
                            <p>Online</p>
                            <i class="fa fa-caret-down fa-md float-right margin-top-3"></i>
                        </div>
                        <div id="status-options" class="info-area">
                            <ul>
                                <li id="status-online" class="active margin-top-5"><span class="status-circle"></span> <p>Online</p></li>
                                <li id="status-away"><span class="status-circle"></span> <p>Away</p></li>
                                <li id="status-busy"><span class="status-circle"></span> <p>Busy</p></li>
                                <li id="status-offline"><span class="status-circle"></span> <p>Offline</p></li>
                            </ul>
                        </div>
                        <div class="break-line margin-bot-5"></div>
                    </div>
                    <div id="c-phone-option" class="margin-right-5 margin-left-5">
                        <i class="fa fa-phone fa-md col-md-1 margin-top-3 margin-left--5 font-size-18"></i>
                        <label class="control-label col-md-4 no-padding">1900 8888</label>
                        <i class="fa fa-th fa-md float-right margin-top-3"></i>
                    </div>
                    <div id="c-call-header" class="div user-call-pad hide">
                        <p class="phone-name" id="u-name"><img id="u-avatar" class="user-avatar phone-avatar" src="https://s3.amazonaws.com/uifaces/faces/twitter/jsa/48.jpg" alt="User Image">Lan Phạm</p>
                        <p id="u-phone" class="phone-num header-desc field-click-able">038 8485 4949</p>
                        <p id="u-time" class="phone-time header-desc field-click-able">00 : 00 : 25</p>
                        <p id="u-ticket" class="text-center margin-top--10">Phiếu: #47748</p>
                    </div>
                    <div class="break-line margin-bot-5"></div>
                    <div id="call-search" class="hide">
                        <input class="form-control margin-top-10 margin-bot-5" id="user-call-search" type="text" name="" placeholder="Phone Number or name">
                    </div>
                    <div id="call-input">
                        <div class="info-area search-result">
                            <ul id="s-rst" class="no-list-style" action="call">
                                <p class="type first font-size-10 no-margin">Khách hàng</p>
                                <li class="s-rst-li">
                                    <div class="s-rst-user">
                                        <p class="no-margin"><img src="https://s3.amazonaws.com/uifaces/faces/twitter/jsa/48.jpg" alt="User Image">Lan Phạm</p>
                                        <p class="user-num field-click-able">01663288281</p>
                                        <span class="status"></span>
                                    </div>
                                </li>
                                <li class="s-rst-li">
                                    <div class="s-rst-user">
                                        <p class="no-margin"><img src="https://s3.amazonaws.com/uifaces/faces/twitter/jsa/48.jpg" alt="User Image">Lan Phạm</p>
                                        <p class="user-num field-click-able">2304</p>
                                        <span class="status"></span>
                                    </div>
                                </li>
                                <p class="type font-size-10 no-margin">Khách hàng</p>
                                <li class="s-rst-li">
                                    <div class="s-rst-user">
                                        <p class="no-margin"><img src="https://s3.amazonaws.com/uifaces/faces/twitter/jsa/48.jpg" alt="User Image">Lan Phạm</p>
                                        <p class="user-num field-click-able">2303</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div id="has-call-pad" class="text-center">
                        <div id="num-pad" class="num-pad">
                            <div class="span4">
                                <div class="num">
                                    <div class="txt">
                                        1
                                    </div>
                                </div>
                            </div>
                            <div class="span4">
                                <div class="num">
                                    <div class="txt">
                                        2 <span class="small">
                                            <p>
                                                ABC</p>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="span4">
                                <div class="num">
                                    <div class="txt">
                                        3 <span class="small">
                                            <p>
                                                DEF</p>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="span4">
                                <div class="num">
                                    <div class="txt">
                                        4 <span class="small">
                                            <p>
                                                GHI</p>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="span4">
                                <div class="num">
                                    <div class="txt">
                                        5 <span class="small">
                                            <p>
                                                JKL</p>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="span4">
                                <div class="num">
                                    <div class="txt">
                                        6 <span class="small">
                                            <p>
                                                MNO</p>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="span4">
                                <div class="num">
                                    <div class="txt">
                                        7 <span class="small">
                                            <p>
                                                PQRS</p>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="span4">
                                <div class="num">
                                    <div class="txt">
                                        8 <span class="small">
                                            <p>
                                                TUV</p>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="span4">
                                <div class="num">
                                    <div class="txt">
                                        9 <span class="small">
                                            <p>
                                                WXYZ</p>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="span4">
                                <div class="num">
                                    <div class="txt">
                                        *
                                    </div>
                                </div>
                            </div>
                            <div class="span4">
                                <div class="num">
                                    <div class="txt">
                                        0 <span class="small">
                                            <p>
                                                +</p>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="span4">
                                <div class="num">
                                    <div class="txt">
                                        #
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p id="c-title"></p>
                        <div class="loader">
                            <ul>
                              <li></li>
                              <li></li>
                              <li></li>
                              <li></li>
                              <li></li>
                              <li></li>
                              <li></li>
                            </ul>
                        </div>
                        <p id="c-avatar" class="margin-top-10">
                            <img class="user-avatar" src="" alt="User Image">
                        </p>
                        <p id="c-name" class="no-margin">Lan Phạm</p>
                        <p id="c-number" class="field-click-able">091 234 6688</p>
                        <p id="c-time" class="field-click-able"></p>
                        <p id="c-record" class="field-click-able hide">00 : 00 : 00</p>
                        <p id="c-option-1" class="font-size-8">Mới: 5  -  Đang xử lý: 1  -  Đóng: 2  -  Liên quan: 0</p>
                        <p id="c-option-2" class="font-size-8">Cuộc gọi: 6 - Email: 0 - Chat: 0</p>
                        <p id="c-ticket">Phiếu: #47748</p>
                        <div id="c-hang-up" class="col-md-12 flex margin-top-10 margin-bot-5">
                            <div class="col-md-4">
                                <div class="call-action">
                                    <img src="<?=base_url('images/icons/1.png')?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="call-action">
                                    <img src="<?=base_url('images/icons/2.png')?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="call-action">
                                    <img id="direct-call" src="<?=base_url('images/icons/3.png')?>">
                                </div>
                            </div>
                        </div>
                        <div class="clearfix">
                        </div>
                        <div id="are-b-end" class="col-md-12 no-padding">
                            <a href="#" class="btn btn-danger btn-block flatbtn margin-top-10">Kết thúc</a>
                        </div> 
                        <div id="are-b-has" class="col-md-12 flex no-padding font-size-12">
                            <div class="col-md-12 no-padding">
                                <a id="deny-call" href="#" class="btn btn-danger btn-block flatbtn margin-top-10">Từ chối</a>
                            </div>
                        </div>
                        <div id="are-b-call" class="col-md-12 no-padding">
                            <a href="#" class="btn btn-primary btn-block flatbtn margin-top-10">Gọi</a>
                        </div>
                        <div id="are-b-direct" class="col-md-12 flex no-padding font-size-12">
                            <div class="col-md-6 no-padding padding-right-5">
                                <a id="deny-direct" href="#" class="btn btn-danger btn-block flatbtn margin-top-10">Hủy chuyển</a>
                            </div>
                            <div class="col-md-6 no-padding">
                                <a id="call-direct" href="#" class="btn btn-primary btn-block flatbtn margin-top-10">Chuyển tiếp</a>
                            </div>
                        </div>
                        <div id="are-b-close" class="col-md-12 no-padding hide">
                            <a id="close-call" href="#" class="btn btn-gray btn-block flatbtn margin-top-10">Đóng</a>
                        </div>
                    </div>
                  </div>
                </li>
                <!-- User Menu-->
                <li class="dropdown">
                    <a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu">
                        <?php
                            $var1 = $this->session->userdata;
                            $custid = $var1['custid'];
                            $idcard = $var1['idcard'];
                            $roleid = $var1['roleid'];
                        ?>
                        <img class="app-nav__user-avatar" src="
                        <?php $var = $this->session->userdata;
                            if($var['avatar'] != 'null')
                            {
                                echo $var['avatar'];
                            }
                            else{ echo 'https://s3.amazonaws.com/uifaces/faces/twitter/jsa/48.jpg';} ?>" alt="User Image">
                    </a>
                  <ul class="dropdown-menu settings-menu dropdown-menu-right">
                    <li><a class="dropdown-item" onclick="addTab('<?php echo base_url().'user/detail/?cusid='.$custid.'&idcard='.$idcard.'&roleid='.$roleid.'&action=profile'?>','Profile')"><i class="fa fa-user fa-lg"></i> Profile</a></li>
                    <li><a class="dropdown-item" href="<?=base_url('login/logout')?>"><i class="fa fa-sign-out fa-lg"></i> Logout</a></li>
                  </ul>
                </li>
            </ul>
          </div>
    </div>
    </header>