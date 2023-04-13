<?php
function checkDevice() {
    if (is_numeric(strpos(strtolower($_SERVER['HTTP_USER_AGENT']), "mobile"))) {
        return is_numeric(strpos(strtolower($_SERVER['HTTP_USER_AGENT']), "tablet")) ? 2 : 1;
    } else {
        return 0;
    }
}
$deviceType = checkDevice();
if ($deviceType == 0) {
    $device_check = "desktop";
} else {
    $device_check = "mobile_or_tablet";
}

$settings = "";
$settings_display = "";
$settings_bg = "";
$support = "";
$support_display = "";
$support_bg = "";
if ($this->router->fetch_class() == 'profile' ||
        $this->router->fetch_class() == 'category' ||
        $this->router->fetch_class() == 'defect_types' ||
        $this->router->fetch_class() == 'trade_user' ||
        $this->router->fetch_class() == 'builder' ||
        $this->router->fetch_class() == 'defect_location' ||
        $this->router->fetch_class() == 'tracts' ||
        $this->router->fetch_class() == 'lots' ||
        $this->router->fetch_class() == 'trade_partner' ||
        $this->router->fetch_class() == 'label_trade_associations' ||
        $this->router->fetch_class() == 'setting_analytics') {
    $settings = "subdrop";
    $settings_display = "style='display: block;'";
    $settings_bg = "style='background-color: rgba(0, 0, 0, 0.2);'";
}

if ($this->router->fetch_class() == 'support') {
    $support = "subdrop";
    $support_display = "style='display: block;'";
    $support_bg = "style='background-color: rgba(0, 0, 0, 0.2);'";
}
?>
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

                <li class="<?php if ($this->router->fetch_class() == 'home' && $this->router->fetch_method() == 'index') { ?> active <?php } ?>"> 
                    <a href="<?php echo base_url('home'); ?>"><i class="la la-home"></i> <span>Home</span></a>
                </li>

				<?php if($this->session->userdata('type') == 1 || $this->session->userdata('type') == 2){ ?>
                <?php if($device_check == "mobile_or_tablet") { ?>
                <li class="<?php if ($this->router->fetch_method() == 'defect_list' || $this->router->fetch_method() == 'defect_list_step_2' || $this->router->fetch_method() == 'defect_list_step_3' || $this->router->fetch_method() == 'review_complete_defect_list') { ?> active <?php } ?>"> 
                    <a href="<?php echo base_url('home/defect_list'); ?>"><i class="la la-file-text"></i> <span>New List</span></a>
                </li>
                <?php } } ?>

                <li class="<?php if ($this->router->fetch_class() == 'search_defect') { ?> active <?php } ?>"> 
                    <a href="<?php echo base_url('search_defect'); ?>"><i class="la la-search"></i> <span>Search List</span></a>
                </li>

                <li class="<?php if ($this->router->fetch_class() == 'search_label') { ?> active <?php } ?>"> 
                    <a href="<?php echo base_url('search_label'); ?>"><i class="la la-search"></i> <span>Search a Label</span></a>
                </li>

                <li class="<?php if ($this->router->fetch_class() == 'incomplete_defects') { ?> active <?php } ?>"> 
                    <a href="<?php echo base_url('incomplete_defects'); ?>"><i class="la la-share-alt"></i> <span>Incomplete Defects</span></a>
                </li>

                <li class="<?php if ($this->router->fetch_class() == 'analytics') { ?> active <?php } ?>"> 
                    <a href="<?php echo base_url('analytics'); ?>"><i class="la la-object-group"></i> <span>Analytics</span></a>
                </li>

                <li class="submenu <?php echo $settings; ?>">
                    <a href="#" class="noti-dot" <?php echo $settings_bg; ?>>
                        <i class="la la-cog"></i> 
                        <span> Settings</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul aria-expanded="false" <?php echo $settings_display; ?>>
                        <li class="<?php if ($this->router->fetch_class() == 'profile') { ?> active <?php } ?>"> 
                            <a href="<?php echo base_url('profile'); ?>"><i class="la la-angle-right"></i> <span>User Profile</span></a>
                        </li>
                        
                        <?php if($this->session->userdata('type') == 1){ ?>

                        <li class="<?php if ($this->router->fetch_class() == 'builder') { ?> active <?php } ?>"> 
                            <a href="<?php echo base_url('builder'); ?>"><i class="la la-angle-right"></i> <span>Builder Profile</span></a>
                        </li>
                        
                        <li class="<?php if ($this->router->fetch_class() == 'category') { ?> active <?php } ?>"> 
                            <a href="<?php echo base_url('category'); ?>"><i class="la la-angle-right"></i> <span>Trade Categories</span></a>
                        </li>
                        
                        <li class="<?php if ($this->router->fetch_class() == 'label_trade_associations') { ?> active <?php } ?>"> 
                            <a href="<?php echo base_url('label_trade_associations'); ?>"><i class="la la-angle-right"></i> <span>Label Associations</span></a>
                        </li>
                        
                        <li class="<?php if ($this->router->fetch_class() == 'trade_partner') { ?> active <?php } ?>"> 
                            <a href="<?php echo base_url('trade_partner'); ?>"><i class="la la-angle-right"></i> <span>Trade Partners</span></a>
                        </li>

                        <li class="<?php if ($this->router->fetch_class() == 'trade_user') { ?> active <?php } ?>"> 
                            <a href="<?php echo base_url('trade_user'); ?>"><i class="la la-angle-right"></i> <span>Trade Users</span></a>
                        </li>

                        <li class="<?php if ($this->router->fetch_class() == 'tracts') { ?> active <?php } ?>"> 
                            <a href="<?php echo base_url('tracts'); ?>"><i class="la la-angle-right"></i> <span>Tracts</span></a>
                        </li>
                        
                         <li class="<?php if ($this->router->fetch_class() == 'lots') { ?> active <?php } ?>"> 
                            <a href="<?php echo base_url('lots'); ?>"><i class="la la-angle-right"></i> <span>Lots</span></a>
                        </li>

                        <li class="<?php if ($this->router->fetch_class() == 'defect_types') { ?> active <?php } ?>"> 
                            <a href="<?php echo base_url('defect_types'); ?>"><i class="la la-angle-right"></i> <span>Defect Types</span></a>
                        </li>

                        <li class="<?php if ($this->router->fetch_class() == 'defect_location') { ?> active <?php } ?>"> 
                            <a href="<?php echo base_url('defect_location'); ?>"><i class="la la-angle-right"></i> <span>Defect Locations</span></a>
                        </li>
                        
                        <?php } ?>

                        <li class="<?php if ($this->router->fetch_class() == 'setting_analytics') { ?> active <?php } ?>"> 
                            <a href="<?php echo base_url('setting_analytics'); ?>"><i class="la la-angle-right"></i> <span>Analytics</span></a>
                        </li>

                    </ul>
                </li>

                <li class="submenu <?php echo $support; ?>">
                    <a href="#" class="noti-dot" <?php echo $support_bg; ?>>
                        <i class="la la-bars"></i> 
                        <span> Support</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul aria-expanded="false" <?php echo $support_display; ?>>
                        <li class="<?php if ($this->router->fetch_method() == 'faq') { ?> active <?php } ?>"><a href="<?php echo base_url('support/faq'); ?>"><i class="la la-angle-right"></i> <span>Faq</span></a></li>
                        <li class="<?php if ($this->router->fetch_method() == 'contact_support') { ?> active <?php } ?>"><a href="<?php echo base_url('support/contact_support'); ?>"><i class="la la-angle-right"></i> <span>Contact Support</span></a></li>
                        <li class="<?php if ($this->router->fetch_method() == 'tutorial') { ?> active <?php } ?>"><a href="<?php echo base_url('support/tutorial'); ?>"><i class="la la-angle-right"></i> <span>Tutorial</span></a></li> 
                    </ul>
                </li>

            </ul>
        </div>
    </div>
</div>
<!-- /Sidebar -->