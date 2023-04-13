

    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Profile</h3>
<!--                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url('home'); ?>">Home</a></li>
                    <li class="breadcrumb-item active">Profile</li>
                </ul>-->
            </div>
            <div class="col-auto float-right ml-auto">
                <a href="<?php echo base_url('profile/edit'); ?>" class="btn add-btn"><i class="fa fa-edit"></i>Edit Profile</a>
                <a href="<?php echo base_url('login/change_password'); ?>" class="btn add-btn" style="margin-right: 5px;"><i class="fa fa-lock"></i>Change Password</a>
            </div>
        </div>
        </div>
        <!-- /Page Header -->

        <div class="card mb-0">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="profile-view">
                            <div class="profile-basic">
                                <div class="row">
                                    <div class="col-md-5" style="margin-left: -80px;">
                                        <div class="profile-info-left">
                                            <h3 class="user-name m-t-0 mb-0"><?php echo $data->name; ?></h3>
<!--                                            <h6 class="text-muted">UI/UX Design Team</h6>
                                            <small class="text-muted">Web Designer</small>
                                            <div class="staff-id">Employee ID : FT-0001</div>-->
                                            <div class="small doj text-muted">Date of Join : <?php echo $this->info_model->date_format($data->created_date); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-7" style="margin-left: 80px;">
                                        <ul class="personal-info">
                                            <li class="clearfix">
                                                <div class="title">Phone:</div>
                                                <div class="text"><a href="tel:<?php echo $data->phone; ?>"><?php echo $data->phone; ?></a></div>
                                            </li>
                                            <li class="clearfix">
                                                <div class="title">Email:</div>
                                                <div class="text"><a href="mailto:<?php echo $data->email; ?>"><?php echo $data->email; ?></a></div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
       



        <!-- /Experience Modal -->

    </div>