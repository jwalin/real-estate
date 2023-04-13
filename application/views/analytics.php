<style>
    .bor-right{
        border-right: 2px solid #000;padding: 0 30px;
    }
    .bor-left{
        padding: 0 30px
    }
    @media(max-width: 768px){
        .bor-right{
            border-right: none !important;padding: 0 !important;
        }
        .bor-left{
            padding: 0 !important;
        }
    }
</style>
<div class="content container-fluid">

    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Analytics</h3>
                <!--                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('home'); ?>">Home</a></li>
                                    <li class="breadcrumb-item active">Analytics</li>
                                </ul>-->
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">

                <div class="card-body">
                    <?php if ($this->session->userdata('type') != 4) { ?>
                        <div class="col-sm-12 mt-3 text-center">
                            <b style="text-decoration: underline;font-size: 17px;">Overall Data</b>
                            <p class="mt-3">Average Defects Per Lot: <span class="theme_color"><?php echo $avg_defect_count_per_lot; ?></span></p>
                            <p class="mt-3">Average Days to List Completion: <span class="theme_color"><?php echo $avg_days_list_completion_count; ?></span></p>
                            <!--<p class="mt-3">Trade Partners with Most Defects Count Per Lot:</p>
                            <div id="partner_defect_graph" style="width: 100%; height: 300px;margin: auto;"></div>-->
							
							<p class="mt-3">Trade Categories w/ Most Defects Per Lot:</p>
                            <div id="category_defect_graph" style="width: 100%; height: 300px;margin: auto;"></div>

                            <p class="mt-3">Trade Partners w/ the Most Days to List Completion:</p>
                            <?php if ($lot_complation_graph != "") { ?>
                            <div id="lot_complation_graph" style="width: 100%; height: 300px;margin: auto;"></div>
                            <?php } else { ?>
                            <p class="text-danger">Data  not found.</p>
                            <?php } ?>

                        </div>
                    <?php } ?>
                    <div class="col-sm-12 pull-left mt-3 pt-3" style="border-top: 2px solid #000;">
                        <?php if ($this->session->userdata('type') != 4) { ?>
                            <div class="col-sm-6 pull-left bor-right">
                                <b style="font-size: 16px;">Data by Tract</b>
                                <div class="form-group mt-3">
                                    <select class="form-control" id="tract_id" name="tract_id" onchange="tractIdSelect(this.value)">
                                        <!--<option value="">Statistics by Tract</option>-->
                                        <?php foreach ($tracts as $tracts) { ?>
                                            <option value="<?php echo $tracts->id; ?>"><?php echo $tracts->tract_no; ?></option>
                                        <?php } ?>
                                    </select>
                                    <script> document.getElementById('tract_id').value = <?php echo $this->input->get('tract_id'); ?>;</script>
                                </div>
                                <p class="mt-3">Average Defects Per Lot: <span class="theme_color"><?php echo @$avg_defect_count_per_lot_tract; ?></span></p>
                                <p class="mt-3">Average Days to List Completion: <span class="theme_color"><?php echo @$avg_days_list_completion_count_tract; ?></span></p>

                                <p class="mt-3">Trade Partners w/ the Most Defects Per Lot:</p>
                                <?php if ($partner_defect_graph_tract != "") { ?>
                                    <div id="partner_defect_graph_tract" style="width: 100%; height: 300px;"></div>
                                <?php } else { ?>
                                    <p class="text-danger">Data  not found.</p>
                                <?php } ?>

                                <p class="mt-3">Total Defects Per Lot Trend:</p>
                                <?php if ($total_defect_per_lot_graph != "") { ?>
                                    <div id="total_defect_per_lot_graph" style="width: 100%; height: 300px;"></div>
                                <?php } else { ?>
                                    <p class="text-danger">Data  not found.</p>
                                <?php } ?>

                                <p class="mt-3">Total Days to List Completion Trend:</p>
                                <?php if ($total_days_complation_graph != "") { ?>
                                    <div id="total_days_complation_graph" style="width: 100%; height: 300px;"></div>
                                <?php } else { ?>
                                    <p class="text-danger">Data  not found.</p>
                                <?php } ?>

                            </div>
                        <?php } ?>
                        <div class="col-sm-6 pull-left bor-left">
                            <b style="font-size: 16px;">Data by Trade Partner</b>
                            <?php if ($this->session->userdata('type') != 4) { ?>
                            <div class="form-group mt-3">
                                <select class="form-control" id="partner_id" name="partner_id" onchange="partnerIdSelect(this.value)">
                                    <!--<option value="">Statistics by Trade Partner</option>-->
                                    <?php foreach ($trade_partner as $trade_partner) { ?>
                                        <option value="<?php echo $trade_partner->id; ?>"><?php echo $trade_partner->partner_name; ?></option>
                                    <?php } ?>
                                </select>
                                <script> document.getElementById('partner_id').value = <?php echo $this->input->get('partner_id'); ?>;</script>
                            </div>
                            <?php } ?>
                            <p class="mt-3">Average Defects Per Lot: <span class="theme_color"><?php echo @$avg_defect_count_per_lot_partner; ?></span></p>
                            <p class="mt-3">Average Days to List Completion: <span class="theme_color"><?php echo @$avg_days_list_completion_count_partner; ?></span></p>
                            <p class="mt-3">Tracts with Highest Average Defect Count Per Lot:</p>

                            <?php if ($partner_defect_graph_partner != "") { ?>
                                <div id="partner_defect_graph_partner" style="width: 100%; height: 300px;"></div>
                            <?php } else { ?>
                                <p class="text-danger">Data  not found.</p>
                            <?php } ?>

                            <p class="mt-3">Total Defects Per Lot Trend:</p>
                            <?php if ($total_defect_per_lot_graph_partner != "") { ?>
                                <div id="total_defect_per_lot_graph_partner" style="width: 100%; height: 300px;"></div>
                            <?php } else { ?>
                                <p class="text-danger">Data  not found.</p>
                            <?php } ?>

                            <p class="mt-3">Total Days to List Completion Trend:</p>
                            <?php if ($total_days_complation_graph_partner != "") { ?>
                                <div id="total_days_complation_graph_partner" style="width: 100%; height: 300px;"></div>
                            <?php } else { ?>
                                <p class="text-danger">Data  not found.</p>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="col-sm-3 pull-left">&nbsp;</div>
                </div>
            </div>
        </div>
    </div>

</div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
                                    google.charts.load('current', {'packages': ['bar']});

<?php if ($this->session->userdata('type') != 4) { ?>

google.charts.setOnLoadCallback(drawStuffMulti0);
    function drawStuffMulti0() {
        var data = new google.visualization.arrayToDataTable([
          ['', 'Count'],
          <?php echo $category_defect_graph; ?>
        ]);
        var options = {
            legend: { position: 'none' },
            bar: { groupWidth: "100%" }
        };
        var chart = new google.charts.Bar(document.getElementById('category_defect_graph'));
        chart.draw(data, options);
    };



                                        google.charts.setOnLoadCallback(drawStuff);
                                        function drawStuff() {
                                            var data = new google.visualization.arrayToDataTable([
                                                ['', 'Count'],
    <?php echo $partner_defect_graph; ?>
                                            ]);
                                            var options = {
                                                legend: {position: 'none'},
                                                bar: {groupWidth: "100%"}
                                            };
                                            var chart = new google.charts.Bar(document.getElementById('partner_defect_graph'));
                                            chart.draw(data, options);
                                        }

    <?php if ($partner_defect_graph_tract != "") { ?>
                                            google.charts.setOnLoadCallback(drawStuff1);
                                            function drawStuff1() {
                                                var data = new google.visualization.arrayToDataTable([
                                                    ['', 'Count'],
        <?php echo $partner_defect_graph_tract; ?>
                                                ]);
                                                var options = {
                                                    legend: {position: 'none'},
                                                    bar: {groupWidth: "100%"}
                                                };
                                                var chart = new google.charts.Bar(document.getElementById('partner_defect_graph_tract'));
                                                chart.draw(data, options);
                                            }
    <?php } ?>

    <?php if ($total_defect_per_lot_graph != "") { ?>
                                            google.charts.setOnLoadCallback(drawStuff3);
                                            function drawStuff3() {
                                                var data = new google.visualization.arrayToDataTable([
                                                    ['', 'Count'],
        <?php echo $total_defect_per_lot_graph; ?>
                                                ]);
                                                var options = {
                                                    legend: {position: 'none'},
                                                    bar: {groupWidth: "100%"}
                                                };
                                                var chart = new google.charts.Bar(document.getElementById('total_defect_per_lot_graph'));
                                                chart.draw(data, options);
                                            }
    <?php } ?>

    <?php if ($total_days_complation_graph != "") { ?>
                                            google.charts.setOnLoadCallback(drawStuff5);
                                            function drawStuff5() {
                                                var data = new google.visualization.arrayToDataTable([
                                                    ['', 'Count'],
        <?php echo $total_days_complation_graph; ?>
                                                ]);
                                                var options = {
                                                    legend: {position: 'none'},
                                                    bar: {groupWidth: "100%"}
                                                };
                                                var chart = new google.charts.Bar(document.getElementById('total_days_complation_graph'));
                                                chart.draw(data, options);
                                            }
    <?php } ?>
<?php } ?>

<?php if ($partner_defect_graph_partner != "") { ?>
                                            google.charts.setOnLoadCallback(drawStuff2);
                                            function drawStuff2() {
                                                var data = new google.visualization.arrayToDataTable([
                                                    ['', 'Count'],
                <?php echo $partner_defect_graph_partner; ?>
                                                ]);
                                                var options = {
                                                    legend: {position: 'none'},
                                                    bar: {groupWidth: "100%"}
                                                };
                                                var chart = new google.charts.Bar(document.getElementById('partner_defect_graph_partner'));
                                                chart.draw(data, options);
                                            }
    <?php } ?>

<?php if ($total_defect_per_lot_graph_partner != "") { ?>
                                        google.charts.setOnLoadCallback(drawStuff4);
                                        function drawStuff4() {
                                            var data = new google.visualization.arrayToDataTable([
                                                ['', 'Count'],
    <?php echo $total_defect_per_lot_graph_partner; ?>
                                            ]);
                                            var options = {
                                                legend: {position: 'none'},
                                                bar: {groupWidth: "100%"}
                                            };
                                            var chart = new google.charts.Bar(document.getElementById('total_defect_per_lot_graph_partner'));
                                            chart.draw(data, options);
                                        }
<?php } ?>



<?php if ($total_days_complation_graph_partner != "") { ?>
                                        google.charts.setOnLoadCallback(drawStuff6);
                                        function drawStuff6() {
                                            var data = new google.visualization.arrayToDataTable([
                                                ['', 'Count'],
    <?php echo $total_days_complation_graph_partner; ?>
                                            ]);
                                            var options = {
                                                legend: {position: 'none'},
                                                bar: {groupWidth: "100%"}
                                            };
                                            var chart = new google.charts.Bar(document.getElementById('total_days_complation_graph_partner'));
                                            chart.draw(data, options);
                                        }
<?php } ?>

<?php if($lot_complation_graph != ""){ ?>
    google.charts.setOnLoadCallback(drawStuffMulti);
    function drawStuffMulti() {
        var data = new google.visualization.arrayToDataTable([
          ['', 'Count'],
          <?php echo $lot_complation_graph; ?>
        ]);
        var options = {
            legend: { position: 'none' },
            bar: { groupWidth: "100%" }
        };
        var chart = new google.charts.Bar(document.getElementById('lot_complation_graph'));
        chart.draw(data, options);
    };
<?php } ?>

                                    function tractIdSelect(ele) {
                                        var partner_id = $('#partner_id').val();
                                        window.location.href = "<?php echo base_url('analytics/index?tract_id='); ?>" + ele + '&partner_id=' + partner_id;
                                    }

                                    function partnerIdSelect(ele) {
                                        var tract_id = $('#tract_id').val();
                                        window.location.href = "<?php echo base_url('analytics/index?tract_id='); ?>" + tract_id + '&partner_id=' + ele;
                                    }
</script>