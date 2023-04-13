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
    .thumbnail{
      width: 100px;
      height: 100px;
      margin: 10px 10px 0 0;
      float: left;
      object-fit: cover
    }
</style>
<div class="content container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card mb-0">
                <div class="card-body p-20 text-center">
                    <div class="col-sm-3 pull-left">&nbsp;</div>
                    <div class="col-sm-6 pull-left">
                        <form id="formid" action="<?php echo base_url('home/insert_step_3'); ?>" method="post" enctype="multipart/form-data">
                            <?php 
                                if(@$this->uri->segment(3) && @$this->uri->segment(4)){
                                    $tract_data = $this->home_model->get_tract_name(@$this->uri->segment(3));
                                    $lot_data = $this->home_model->get_lot_name(@$this->uri->segment(4));
                                }
                            ?>
                            <input type="hidden" name="tract_id" id="tract_id" value="<?php echo @$tract_data->id; ?>">
                            <input type="hidden" name="lot_id" value="<?php echo @$lot_data->id; ?>">
                            <input type="hidden" name="scanner_url" value="<?php echo base64_decode(base64_decode(@$this->uri->segment(5))); ?>">
                            <?php
                                if(@$this->uri->segment(5)){
                                    $ex = explode('_', base64_decode(base64_decode(@$this->uri->segment(5))));
                                    if($ex[0] !== 'ZZ'){
                                    $data_lbl = $this->home_model->get_label_id(@$ex[0]);
                                    $data_lbl_cat = $this->home_model->get_label_catagory_id(@$data_lbl->id);
                                    }
                                }
                            ?>
                            <fieldset>
                                <h2 class="theme_color">New Defect List - Step 2</h2><br>
                                <?php 
                                if(@$this->uri->segment(3) && @$this->uri->segment(4)){
                                ?>
                                <h4><?php echo $tract_data->tract_no; ?> - <?php echo $lot_data->lot_no; ?></h4><br>
                                <?php } ?>
                                <div class="col-sm-12 clearfix">
                                    <h4 class="mb-3"><u>Take a Picture of the Defect</u></h4>
                                    <label for="file-upload" class="custom-file-upload mb-3">
                                        <i class="fa fa-cloud-upload"></i> Take Picture
                                    </label>
                                    <input id="file-upload" name="img[]" type="file" accept="image/*" capture="camera" class="image_lg" style="display: none;" multiple="">
                                    <br/>
                                    <!--<img src="#" class="image_view_lg">-->
                                    <output id="result" style="width: 100%;margin-bottom: 15px;padding-left: 35px;"/>
                                </div>
                                <div class="col-sm-12 clearfix">
                                    <h4 class="mb-3"><u>Defect Description</u></h4>
                                    <textarea rows="6" class="form-control mb-3" name="description" required=""></textarea>
                                </div>
                                <div class="col-sm-12 clearfix">
                                    <h4 class="mb-3"><u>Defect Attributes</u></h4>
                                    <div id="add_more_data" class="block">
                                        <div class="form-group">
                                            <select class="form-control" name="trade_category[]" id="cat" required="" onchange="category_to_defect(this.value)">
                                                <?php
                                                if(@$tract_data->id){
                                                $data_category = $this->home_model->get_defect_category(@$tract_data->id);
                                                foreach ($data_category as $row_data_category) { ?>
                                                    <option value="<?php echo $row_data_category->cat_id; ?>" <?php if($row_data_category->cat_id == @$data_lbl_cat->category_id){ echo 'selected'; } ?>><?php echo $row_data_category->category_name; ?></option>
                                                <?php } } ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <select class="form-control" name="trade_partner[]" id="trade_partner" required="">
                                            </select>
                                        </div>
                                    </div>
                                    <p class="add" style="color: green;cursor: pointer;">Add a follow-up Trade Category and Trade Partner?</p>
                                    <div class="form-group">
                                        <select class="form-control" id="defect_type" name="defect_type">
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <select class="form-control" id="location" name="location">
                                            <option value="">Select Location</option>
                                            <?php foreach ($data_defect_location as $row_data_defect_location) { ?>
                                                <option value="<?php echo $row_data_defect_location->id; ?>"><?php echo $row_data_defect_location->defect_location; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <input type="submit" name="submit" class="btn btn-primary mt-3" value="Save & Start Next Defect" />
                                <input type="submit" name="submit_review" class="btn btn-primary mt-3" value="Save & Review List" />
                            </fieldset>
                        </form>
                    </div>
                    <div class="col-sm-3 pull-left">&nbsp;</div>
                </div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" id="add_cnt" value="0">
<div id="loadingb" style="position: fixed;display: none;
                 top: 0;
                 left: 0;
                 right: 0;
                 bottom: 0;
                 text-align: center;
                 background-color: rgba(0,0,0,0.7);
                 height: 100%;
                 width: 100%;
                 z-index: 9999;">
                <span  align="center" style="color: #fff;
                       position: absolute;
                       top: 40%;
                       left: 0;
                       right: 0;
                       bottom: 0;
                       display: inline-table;
                       width: 100%;
                       font-size: 17px;
                       font-weight: bold;">
                                        &nbsp;
                                        Please wait..
                </span>
            </div>
<script>
    $("form#formid").submit(function () {
        $('#loadingb').show();
        $("input[name=submit]").attr('readonly', true);
        $("input[name=submit_review]").attr('readonly', true); 
    });
    
    
    
  window.onload = function(){
        
    //Check File API support
    if(window.File && window.FileList && window.FileReader)
    {
        var filesInput = document.getElementById("file-upload");
        
        filesInput.addEventListener("change", function(event){
            
            var files = event.target.files; //FileList object
            var output = document.getElementById("result");
            
            for(var i = 0; i< files.length; i++)
            {
                var file = files[i];
                
                //Only pics
                if(!file.type.match('image'))
                  continue;
                
                var picReader = new FileReader();
                
                picReader.addEventListener("load",function(event){
                    
                    var picFile = event.target;
                    
                    var div = document.createElement("div");
                    
                    div.innerHTML = "<img class='thumbnail' src='" + picFile.result + "'" +
                            "title='" + picFile.name + "'/>";
                    
                    output.insertBefore(div,null);            
                
                });
                
                 //Read the image
                picReader.readAsDataURL(file);
            }                               
           
        });
    }
}
    
</script>
<script>
//    $('.image_lg').change(function () {
//        if (!window.FileReader) {
//            alert('File Reader not supported');
//        } else {
//            var reader = new FileReader();
//            var target = null;
//            reader.onload = function (e) {
//                target = e.target || e.srcElement;
//                $(".image_view_lg").prop("src", target.result);
//                $(".image_view_lg").show();
//            };
//            reader.readAsDataURL($(this)[0].files[0]);
//        }
//    });

    $('.add').click(function () {
//        $('.block:last').after('<div id="add_more_data" class="block"> <div class="form-group"> <select class="form-control"> <option>Trade Category</option> </select> </div> <div class="form-group"> <select class="form-control"> <option>Trade Partner</option> </select> </div> </div>');
        var add_cnt = parseInt($('#add_cnt').val());
        
        var total = add_cnt + 1;
        $('#add_cnt').val(total);
//        alert(total);
//        return false;
        var tract_id = $('#tract_id').val();
        $.ajax({
            url: '<?= base_url() . 'home/ajax_trade_category_partner/' ?>',
            data: {tract_id: tract_id, total: total},
            type: 'post',
            success: function (data) {
                $('.block:last').append(data);
            }
        });
    });

//    $('.removeIcon').on('click', function(){
//        alert('hii');
//        $(this).closest("#t_p").remove();
//    });
<?php if(@$data_lbl_cat->category_id){ ?>
var cat = <?php echo @$data_lbl_cat->category_id; ?>;
<?php }else{ ?>
var cat = $('#cat').val();    
<?php } ?>
var tract_id = $('#tract_id').val();
category_to_defect(cat, tract_id);
function category_to_defect(ele){
    var tract_id = $('#tract_id').val();
    $.ajax({
        url: '<?= base_url() . 'home/ajax_category_to_defect_type/' ?>',
        data: {cat_id: ele, tract_id: tract_id},
        type: 'post',
        success: function (data) {
			// console.log(data);
            var datas = JSON.parse(data);
            $('#defect_type').html(datas.defect);
            // $('#trade_partner').html(datas.partner);
            $('#trade_partner').html(datas.partner_all);
        }
    });
}
</script>