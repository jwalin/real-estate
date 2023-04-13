
<div class="content container-fluid">

    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Trade Users</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url('home'); ?>">Home</a></li>
                    <li class="breadcrumb-item active">Trade Users</li>
                </ul>
            </div>
            <div class="col-auto float-right ml-auto">
                <a href="<?php echo base_url('trade_user/add'); ?>" class="btn add-btn"><i class="fa fa-plus"></i>Create Trade User</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card mb-0">
                <div class="card-body">

                    <div class="col-lg-12 p-0">
                        <div class="form-group" style="width: 200px;float: right;margin-top: 15px;">
                            <select class="select" id="partner_select" onchange="select_partner_data(this.value)">
                                <option value="All">All Trade Partner</option>
                                <?php foreach ($data_partner as $row_partner) { ?>
                                    <option value="<?php echo $row_partner->id; ?>"><?php echo $row_partner->partner_name; ?></option>
                                <?php } ?>
                            </select>
                            <script>document.getElementById('partner_select').value = <?php echo @$this->uri->segment(3); ?>;</script>
                        </div>
                    </div>

                    <?php if ($this->session->flashdata('success')) { ?>
                        <div class="alert alert-success clearfix"><?php echo $this->session->flashdata('success'); ?>
                            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                        </div>
                    <?php } if ($this->session->flashdata('error')) { ?>
                        <div class="alert alert-danger clearfix"><?php echo $this->session->flashdata('error'); ?></div>
                    <?php } ?>

                    <div class="table-responsive">
                        <table class="datatable table table-stripped mb-0" style="margin-top: 0 !important;"><!--table-bordered-->
                            <thead>
                                <tr>
                                    <th>Trade Partner</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if(count($data) == 0){
                                    echo "<td colspan='5' class='text-danger'>". RECORD_NOT_FOUND ."</td>";
                                }else{
                                foreach ($data as $row) {
                                    ?>
                                    <tr>
                                        <td><?php echo $row->partner_name; ?></td>
                                        <td><?php echo $row->name; ?></td>
                                        <td><?php echo $row->email; ?></td>
                                        <td>
                                            <?php
                                            if ($row->status == 1) {
                                                echo '<span style="color: green;">Active</span>';
                                            } else {
                                                echo '<span style="color: red;">Inactive</span>';
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="<?php echo base_url('trade_user/edit/' . $row->id); ?>"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                    <a class="dropdown-item" href="<?php echo base_url('trade_user/delete/' . $row->id); ?>" onclick="return confirm('<?php echo CONFIRM_ALERT_DELETE; ?>');"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<script>
function select_partner_data(ele){
    window.location.href = "<?php echo base_url('trade_user/index/'); ?>" + ele;
}
</script>