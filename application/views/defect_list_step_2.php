<style>
    .custom-file-upload {
        border: 1px solid #ccc;
        display: inline-block;
        padding: 6px 12px;
        cursor: pointer;
    }
</style>
<div class="content container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card mb-0">
                <div class="card-body p-20 text-center">
                    <div class="col-sm-3 pull-left">&nbsp;</div>
                    <div class="col-sm-6 pull-left">
                        <form action="#" method="post">
                            <fieldset>
                                <h2 class="theme_color">New Defect List - Step 2</h2><br>
                                <h4>Building xyz - Appartement 123</h4><br>
                                <h4><u>Scan the Defect’s E-ZQC Label</u></h4>
                                <br>
                                <label for="file-upload" class="custom-file-upload">
                                    <i class="fa fa-barcode"></i> Scan Defect
                                </label>
                                <input id="file-upload" type="file" accept="image/*" capture="camera" style="display: none;"> 
                                <input id="file-upload" type="file" style="display: none;"/>
                                <br/>
                                <a href="<?php echo base_url('home/defect_list_step_3'); ?>"><input type="button" class="btn btn-primary mt-3" value="Next" /></a>
                            </fieldset>
                        </form>
                    </div>
                    <div class="col-sm-3 pull-left">&nbsp;</div>
                </div>
            </div>
        </div>
    </div>
</div>