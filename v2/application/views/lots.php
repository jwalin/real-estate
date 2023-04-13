<style>
    #xlsx_err
    {
        display: none;
        clear: both;
        text-align: left;
        width: 100%;
        color: #ff0000;
        font-size: 11px;
        letter-spacing: 0.5px;
        margin-bottom: 0;
    }
</style>
<div class="content container-fluid">

    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Lots</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url('home'); ?>">Home</a></li>
                    <li class="breadcrumb-item active">Lots</li>
                </ul>
            </div>
            <div class="col-auto float-right ml-auto">
                <a href="<?php echo base_url('lots/add'); ?>" class="btn add-btn"><i class="fa fa-plus"></i>Create Lot</a>
                <a href="#" class="btn add-btn" data-toggle="modal" data-target="#upload_excel" style="margin-right: 5px;"><i class="fa fa-cloud-upload"></i>Upload Excel</a>
                <a href="<?php echo base_url(); ?>assets/sample_excel/tracts_lots.xlsx" class="btn add-btn" style="margin-right: 5px;" download=""><i class="fa fa-cloud-download"></i>Sample Excel</a>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card mb-0">

                <div class="card-body pt-3">
                    <?php if ($this->session->flashdata('success')) { ?>
                        <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?>
                            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                        </div>
                    <?php } if ($this->session->flashdata('error')) { ?>
                        <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
                    <?php } ?>
                    <div class="table-responsive">
                        <table class="datatable table table-stripped mb-0">
                            <thead>
                                <tr>
                                    <th>Tract No.</th>
                                    <th>Lot No.</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (count($data) == 0) {
                                    echo "<td colspan='3' class='text-danger'>" . RECORD_NOT_FOUND . "</td>";
                                } else {
                                    foreach ($data as $row) {
                                        ?>
                                        <tr>
                                            <td><?php echo $row->tract_no; ?></td>
                                            <td><?php echo $row->lot_no; ?></td>
                                            <td>
                                                <div class="dropdown dropdown-action">
                                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="<?php echo base_url('lots/edit/' . $row->id); ?>"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                        <a class="dropdown-item" href="<?php echo base_url('lots/delete/' . $row->id); ?>" onclick="return confirm('<?php echo CONFIRM_ALERT_DELETE; ?>');"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                                    </div>
                                                </div>
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

<!-- Start Modal -->
<div id="upload_excel" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Upload Excel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url('lots/excel_import'); ?>" method="post" enctype="multipart/form-data" id="form_id_dis">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Select Excel</label>
                                <input type="file" name="file" id="fl" class="form-control" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" required="" onchange="check_extension()">
                                <p id="xlsx_err"></p>
                            </div>
                        </div>
                    </div>
                    <div class="submit-section">
                        <button type="submit" id="save_id_dis" class="btn btn-primary submit-btn">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Modal -->


<script>
    $("form#form_id_dis").submit(function () {
        $("#save_id_dis").attr('disabled', true);
    });
    function check_extension() {
        var ext = $('#fl').val().split('.').pop().toLowerCase();
        if ($.inArray(ext, ['xlsx']) == -1) {
            $('#xlsx_err').show();
            $('#xlsx_err').html('Only xlsx files accepted.');
            $('#fl').val('');
        } else {
            $('#xlsx_err').hide();
            $('#xlsx_err').html('');
        }
    }
</script>