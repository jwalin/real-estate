<div class="sidebar" id="sidebar">
                <div class="sidebar-inner slimscroll">
					<div id="sidebar-menu" class="sidebar-menu">
						<ul>
							
                                                    <li class="<?php if ($this->router->fetch_class() == 'home') { ?> active <?php } ?>"> 
								<a href="<?php echo base_url('home'); ?>"><i class="la la-home"></i> <span>Home</span></a>
							</li>
                                                        
                                                    <li class="<?php if ($this->router->fetch_class() == 'profile') { ?> active <?php } ?>"> 
								<a href="<?php echo base_url('profile'); ?>"><i class="la la-user"></i> <span>Profile</span></a>
							</li>
							
							<li class="<?php if ($this->router->fetch_class() == 'category') { ?> active <?php } ?>"> 
								<a href="<?php echo base_url('category'); ?>"><i class="la la-user-secret"></i> <span>Trade Category</span></a>
							</li>
							<li class="<?php if ($this->router->fetch_class() == 'defect_types') { ?> active <?php } ?>"> 
								<a href="<?php echo base_url('defect_types'); ?>"><i class="la la-ticket"></i> <span>Defect Types</span></a>
							</li>
							<li class="<?php if ($this->router->fetch_class() == 'partner') { ?> active <?php } ?>"> 
								<a href="<?php echo base_url('partner'); ?>"><i class="fa fa-handshake-o"></i> <span>Trade Partners</span></a>
							</li>
							<li class="<?php if ($this->router->fetch_class() == 'builder') { ?> active <?php } ?>"> 
								<a href="<?php echo base_url('builder'); ?>"><i class="la la-users"></i> <span>Builder</span></a>
							</li>
							<li class="<?php if ($this->router->fetch_class() == 'defect_location') { ?> active <?php } ?>"> 
								<a href="<?php echo base_url('defect_location'); ?>"><i class="la la-map-marker"></i> <span>Defect Location</span></a>
							</li>
                                                        <li class="<?php if ($this->router->fetch_class() == 'lots_tracks') { ?> active <?php } ?>"> 
								<a href="<?php echo base_url('lots_tracks'); ?>"><i class="la la-external-link"></i> <span>Lots & Tracks</span></a>
							</li>
							
							
						</ul>
					</div>
                </div>
            </div>
			<!-- /Sidebar -->