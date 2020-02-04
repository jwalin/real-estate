<style>
    .custom-file-upload {
        border: 1px solid #ccc;
        display: inline-block;
        padding: 6px 12px;
        cursor: pointer;
    }
    .image_view_lg{
        display: none;
        width: 100px;
        height: 100px;
        box-shadow: 0 0 13px rgba(0,0,0,0.29);
        background-color: #f8f8f8;
        object-fit: cover;
        margin-top: 10px;
        margin-bottom: 20px;
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
                                <h2 class="theme_color">New Defect List - Step 3</h2><br>
                                <h4>Building xyz - Appartement 123</h4><br>
                                <div class="col-sm-12 clearfix">
                                    <h4 class="mb-3"><u>Take a Picture of the Defect</u></h4>
                                    <label for="file-upload" class="custom-file-upload mb-3">
                                        <i class="fa fa-cloud-upload"></i> Take Picture
                                    </label>
                                    <input id="file-upload" type="file" accept="image/*" capture="camera" class="image_lg" style="display: none;">
                                    <br/>
                                    <img src="#" class="image_view_lg">
                                </div>
                                <div class="col-sm-12 clearfix">
                                    <h4 class="mb-3"><u>Defect Description</u></h4>
                                    <textarea rows="6" class="form-control mb-3"></textarea>
                                </div>
                                <div class="col-sm-12 clearfix">
                                    <h4 class="mb-3"><u>Defect Attributes</u></h4>
                                    <div class="form-group">
                                        <select class="form-control">
                                            <option>Trade Category</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <select class="form-control">
                                            <option>Trade Partner</option>
                                        </select>
                                    </div>
                                    <p>Add a follow-up Trade Category and Trade Partner?</p>
                                    <div class="form-group">
                                        <select class="form-control">
                                            <option>Defect Type</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <select class="form-control">
                                            <option>Location</option>
                                        </select>
                                    </div>
                                </div>
                                <a href="<?php echo base_url('home/defect_list'); ?>"><input type="button"class="btn btn-primary mt-3" value="Save & Start Next Defect" /></a>
                                <a href="<?php echo base_url('home/review_complete_defect_list'); ?>"><input type="button" class="btn btn-primary mt-3" value="Save & Review List" /></a>
                            </fieldset>
                        </form>
                    </div>
                    <div class="col-sm-3 pull-left">&nbsp;</div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('.image_lg').change(function () {
        if (!window.FileReader) {
            alert('File Reader not supported');
        } else {
            var reader = new FileReader();
            var target = null;
            reader.onload = function (e) {
                target = e.target || e.srcElement;
                $(".image_view_lg").prop("src", target.result);
                $(".image_view_lg").show();
            };
            reader.readAsDataURL($(this)[0].files[0]);
        }
    });
</script>