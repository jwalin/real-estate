<div class="content container-fluid">

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Add Label - Trade Association </h4>
                </div>
                <div class="card-body">
                    <form action="<?php echo base_url('label_trade_associations/insert'); ?>" method="post">
                        <div class="form-group row" style="margin-top: 20px;">
                            <label class="col-form-label col-md-2">Category</label>
                            <div class="col-md-10">
                                <select class="form-control" name="category_id" required="">
                                    <option value="">Select Category</option>
                                    <?php
                                    $cat_data = $this->label_trade_associations_model->get_labels();
                                    foreach ($cat_data as $cat_data_row) {
                                        $data_array_cat[] = $cat_data_row->category_id;
                                    }
                                    foreach ($data_category as $row_category) {
                                        if (!in_array($row_category->id, $data_array_cat)) {
                                        ?>
                                        <option value="<?php echo $row_category->id; ?>"><?php echo $row_category->category_name; ?></option>
                                    <?php } } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-2">Label</label>
                            <div class="col-md-10">
                                <select class="form-control" name="label" required="">
                                    <option value="">Select Label</option>
                                    <?php 
                                    $label_data = $this->label_trade_associations_model->get_labels();
                                    foreach ($label_data as $label_data_row) {
                                        $data_array[] = $label_data_row->label;
                                    }
                                    foreach ($data_label as $row_label) { 
                                        if (!in_array($row_label->id, $data_array)) {
                                        ?>
                                        <option value="<?php echo $row_label->id; ?>"><?php echo $row_label->label; ?></option>
                                    <?php } } ?>
                                </select>
                            </div>
                        </div>
                        <div class="text-right">
                            <a href="<?php echo base_url('label_trade_associations'); ?>"><button type="button" class="btn btn-danger">Cancel</button></a>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>