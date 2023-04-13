<style>
    .submenu ul li a i{font-size: 13px !important;}
    .noti-dot:before{border: none;width: 0;}
    .sidebar-menu li.active a{background-color: rgba(0, 0, 0, 0.1);}
    ul.menu_sidebar li.active{background-color: rgba(0, 0, 0, 0.2);}
</style>
<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul class="menu_sidebar">
                
                <li class="<?php if ($this->router->fetch_class() == 'company') { ?> active <?php } ?>"> 
                    <a href="<?php echo base_url('company'); ?>"><i class="la la-cube"></i> <span>Company Management</span></a>
                </li>
				
                <li class="<?php if ($this->router->fetch_class() == 'login') { ?> active <?php } ?>"> 
                    <a href="<?php echo base_url('login/my_profile'); ?>"><i class="la la-user"></i> <span>Profile</span></a>
                </li>
                
            </ul>
        </div>
    </div>
</div>
<!-- /Sidebar -->