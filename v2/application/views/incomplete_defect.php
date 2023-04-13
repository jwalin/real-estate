<style>
    .image_view_lg{
        width: 80px;
        height: 80px;
        border: 2px solid gainsboro;
    }
    .table td{vertical-align: middle;}
    thead{border-top: 2px solid #dee2e6;}
    .title_tbl{
        color: #4f4f4f;
        float: left;
        font-weight: 500;
        margin-right: 15px;
        width: 100px;
        font-size: 14px;
    }
    .text_tbl{
        color: #8e8e8e;
        font-size: 14px;
        margin-bottom: 5px;
    }
    .tract_select{width: 150px;float: right;margin: 0;margin-right: 5px;}
    .lot_select{width: 200px;float: right;margin: 0;}
    @media (max-width: 768px){
        .tract_select{width: 100%;margin: 0;}
        .lot_select{width: 100%;margin-bottom: 5px;}
    }
</style>
<div class="content container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Incomplete Defects</h3>
            </div>
        </div>
    </div>
    <!-- /Page Header -->
    <div class="row">
        <div class="col-sm-12">
            <div class="card mb-0 pt-3">
                <div class="card-body text-center">

                    <div class="col-lg-12 p-0">
                        <div class="form-group" style="width: 200px;float: right;margin-top: 15px;">
                            <select class="select" id="tracts" onchange="select_tract(this.value)">
                                <option value="">All Tract</option>
                                <?php foreach ($data_tract as $row) { ?>
                                    <option value="<?php echo $row->id; ?>"><?php echo $row->tract_no; ?></option>
                                <?php } ?>
                            </select>
                            <script>document.getElementById('tracts').value = <?php echo @$this->uri->segment(3); ?>;</script>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="datatable table table-stripped mb-0" style="margin-top: 0 !important;">
                            <thead>
                                <tr>
                                    <th>Tract No.</th>
                                    <th>Lot No.</th>
                                    <th>Number Of Incomplete Defects</th>
                                    <th class="text-center">Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                if (count($data) == 0) {
                                    echo "<td colspan='2' class='text-danger'>" . RECORD_NOT_FOUND . "</td>";
                                } else {
                                    foreach ($data as $row) {
                                        ?>
                                        <tr>
                                            <td><?php echo $row->tract_no; ?></td>
                                            <td><?php echo $row->lot_no; ?></td>
                                            <td><?php echo $row->defect_count; ?></td>
                                            <td class="text-center">
                                                <a href="<?php echo base_url('search_defect/search_result/'.$row->tract_id.'-'.$row->lot_id.'-1'); ?>" class="theme_color" style="font-size: 30px;"><i class="fa fa-arrow-circle-right"></i></a>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function select_tract(ele) {
        window.location.href = "<?php echo base_url('incomplete_defects/index/'); ?>" + ele;
    }
</script>