<div class="content container-fluid">

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Edit Tract </h4>
                </div>
                <div class="card-body">
                    <form action="<?php echo base_url('tracts/update'); ?>" method="post">
                        <input type="hidden" class="form-control" name="id" value="<?php echo $data->id; ?>">
                        <div class="form-group row" style="margin-top: 20px;">
                            <label class="col-form-label col-md-2">Name</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="name" value="<?php echo $data->name; ?>" required="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-2">Tract No.</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="tract_no" value="<?php echo $data->tract_no; ?>" required="" onkeypress="return isNumberKey(event)">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-12 theme_color">Trade Category - Trade Partner Associations</label>
                        </div>
                        
                        <?php 
                        $partner_array = array();
//                        $category_array = array();
                        foreach ($data_category_partner as $row_category_partner){
                            $partner_array[$row_category_partner->category_id] = $row_category_partner->partner_id;
//                            $category_array[] = $row_category_partner->category_id;
                        }
//                        print_r($partner_array);
//                        print_r($category_array);exit;
                        ?>
                        
                        <?php foreach ($data_category as $row_category){ ?>
                        
                        <div class="form-group row">
                            <input type="hidden" name="category_id[]" value="<?php echo $row_category->id; ?>">
                            <label class="col-form-label col-md-2"><?php echo $row_category->category_name; ?></label>
                            <div class="col-md-10">
                                <select class="form-control" name="partner_id[]" id="partner_id">
                                    <option value="">Select Partner</option>
                                    <?php foreach ($data_partner as $row_partner){ ?>
                                    <option value="<?php echo $row_partner->id; ?>"
                                            <?php
                                            if(!empty($partner_array[$row_category->id])){
                                            if($partner_array[$row_category->id] == $row_partner->id){
//                                            if(in_array($row_partner->id, $partner_array)){
                                                echo 'selected';
//                                            }
                                            }
                                            }
                                            ?>
                                            ><?php echo $row_partner->partner_name; ?></option>
                                    <?php } ?>
                                </select>
<!--                                <script>
                                    document.getElementById('partner_id').value = "<?php echo $row_category_partner->partner_id; ?>";
                                </script>-->
                            </div>
                        </div>
                        
                        <?php } ?>
                        <?php // } ?>
                        
                        <div class="text-right">
                            <a href="<?php echo base_url('tracts'); ?>"><button type="button" class="btn btn-danger">Cancel</button></a>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

