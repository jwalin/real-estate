<div class="nk-sidebar">           

            <div class="nk-nav-scroll">

                <ul class="metismenu" id="menu">

                    <!--                    <li class="nav-label">Dashboard</li>

                                        <li>

                                            <a href="#" aria-expanded="false">

                                                <i class="icon-badge menu-icon"></i><span class="nav-text">Dashboard</span>

                                            </a>

                                        </li>-->



<!--                    <li class="<?php if ($this->router->fetch_class() == 'dashboard') { ?> active <?php } ?>">

                        <a href="<?php echo base_url('dashboard');?>" aria-expanded="false">

                            <i class="fa fa-tachometer"></i><span class="nav-text">Dashboard</span>

                        </a>

                    </li>-->
<!--                    <li class="<?php if ($this->router->fetch_class() == 'user') { ?> active <?php } ?>">

                        <a href="<?php echo base_url('user');?>" aria-expanded="false">

                            <i class="fa fa-group"></i><span class="nav-text">User</span>

                        </a>

                    </li>-->
                    
                    <li class="<?php if ($this->router->fetch_class() == 'content_management') { ?> active <?php } ?>">
                        <a href="<?php echo base_url('content_management');?>" aria-expanded="false">
                            <i class="fa fa-bars"></i><span class="nav-text">Content Management</span>
                        </a>
                        
                    </li>
                    
                    <li class="<?php if ($this->router->fetch_class() == 'category') { ?> active <?php } ?>">
                        <a href="<?php echo base_url('category');?>" aria-expanded="false">
                            <i class="fa fa-list"></i><span class="nav-text">Category</span>
                        </a>
                        
                    </li>
                    
                    
                     <li class="<?php if ($this->router->fetch_class() == 'change_password') { ?> active <?php } ?>">
                        <a href="<?php echo base_url('change_password/');?>" aria-expanded="false">
                            <i class="fa fa-lock"></i><span class="nav-text">Change Password</span>
                        </a>
                    </li>			
                   <li class="<?php if ($this->router->fetch_class() == 'Logout') { ?> active <?php } ?>">
                        <a href="<?php echo base_url('logout/');?>" aria-expanded="false">
                            <i class="fa fa-key"></i><span class="nav-text">Logout</span>
                        </a>
                    </li> 

                   

                </ul>

                      

            </div>

        </div>