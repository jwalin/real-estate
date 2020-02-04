<style>
    .profile-basic{margin-left: 40px !important;}
    .personal-info{margin-left: 0;}
    ul.personal-info li{clear: both;}
    .image_view_lg{
        width: 100px;
        height: 100px;
        /*object-fit: cover;*/
        border: 2px solid gainsboro;
    }
    @media (max-width: 768px){
        .profile-basic{margin-left: 0 !important;}
    }
</style>
<div class="content container-fluid">

    <div class="card mb-0">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="profile-view">
                        <div class="profile-basic">
                            <div class="row">
                                <div class="col-md-7">
                                    <h2 class="theme_color">New Defect List - Step 4</h2><br>
                                    <h4>Building xyz - Appartement 123</h4><br>
                                    <h4 class="mb-3"><u>Review & Complete Defect List</u></h4><br>
                                    <ul class="personal-info">
                                        <li>
                                            <div class="title">Tile Defects:</div>
                                            <div class="text">Tile Defects</div>
                                        </li>
                                        <li>
                                            <div class="title">Code:</div>
                                            <div class="text">AA0001</div>
                                        </li>
                                        <li>
                                            <div class="title">Label Image:</div>
                                            <div class="text"><img src="<?php echo base_url(); ?>assets/images/logo.jpg" class="image_view_lg"></div>
                                        </li>
                                        <li>
                                            <div class="title">Defect Description:</div>
                                            <div class="text">The app provides a scrolling list of
                                                every defect, including each defect’s
                                                alphanumeric code, images of the label and
                                                defect, the defect description, and attributes
                                                selected. The list is sorted by trade category
                                                and then by the order in which each
                                                category’s defects were physically labeled. </div>
                                        </li>
                                        <li>
                                            <div class="title">Trade Category:</div>
                                            <div class="text">Trade Category</div>
                                        </li>
                                        <li>
                                            <div class="title">Trade Partner:</div>
                                            <div class="text">Trade Partner</div>
                                        </li>
                                        <li>
                                            <div class="title">Defect Type:</div>
                                            <div class="text">Defect Type</div>
                                        </li>
                                        <li>
                                            <div class="title">Location:</div>
                                            <div class="text">Location</div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-7">
                                    <a href="#"><input type="button"class="btn btn-primary mt-3" value="Save Defect List, Notify Trades" /></a>
                                    <a href="#"><input type="button" class="btn btn-primary mt-3" value="Save Defect List, Do Not Notify Trades" /></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>