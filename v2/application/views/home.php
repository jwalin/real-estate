<?php

function checkDevice1() {
    if (is_numeric(strpos(strtolower($_SERVER['HTTP_USER_AGENT']), "mobile"))) {
        return is_numeric(strpos(strtolower($_SERVER['HTTP_USER_AGENT']), "tablet")) ? 2 : 1;
    } else {
        return 0;
    }
}

$deviceType1 = checkDevice1();
if ($deviceType1 == 0) {
    $device_check1 = "desktop";
} else {
    $device_check1 = "mobile_or_tablet";
}
?>
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
        width: 85px;
        font-size: 14px;
    }
    .text_tbl{
        color: #8e8e8e;
        font-size: 14px;
        margin-bottom: 5px;
    }
</style>
<div class="content container-fluid">
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Home</h3>
                <ul class="breadcrumb">
                </ul>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card mb-0">
                <div class="card-body p-20 text-center">
                    <div class="col-sm-3 pull-left">&nbsp;</div>
                    <div class="col-sm-6 pull-left">
                        <?php
                        $sess_company_data = $this->info_model->get_company_data();
                        ?>
                        <img src="<?php echo @$sess_company_data->company_logo; ?>" class="img-responsive" width="50%"><br><br>

                        <?php if ($this->session->userdata('type') == 1 || $this->session->userdata('type') == 2) { ?>
                            <?php if ($device_check1 == "mobile_or_tablet") { ?>
                                <!--<a href="<?php echo base_url('home/defect_list'); ?>"><button class="btn btn-primary mb-3" style="width: 160px;">New Defect List</button></a>-->
								<a href="<?php echo base_url('checklists'); ?>"><button class="btn btn-primary mb-3" style="width: 160px;">Checklists</button></a>
                                <?php
                            }
                        }
                        ?>
                        <a href="<?php echo base_url('search_defect/'); ?>"><button class="btn btn-primary mb-3" style="width: 200px;">Search by Trade Partner</button></a>
                    </div>
                    <div class="col-sm-3 pull-left">&nbsp;</div>
                    <div class="col-sm-12 clearfix" style="border-top: 1px solid gainsboro;">
                        <p class="mt-3">Average Defects Per Lot: <span class="theme_color"><?php echo $avg_defect_count_per_lot; ?></span></p>
                        <p class="mt-3">Average Days to List Completion: <span class="theme_color"><?php echo $avg_days_list_completion_count; ?></span></p>
                        
<!--                        <p class="mt-3">Trade Partners with Most Defects Count Per Lot:</p>
                        <div id="partner_defect_graph" style="width: 50%; height: 300px;margin: auto;"></div>-->
                        
<!--                        <p class="mt-3">Trade Partners with Most Days to List Completion:</p>
                        <span class="theme_color">#1 Trade Partner</span><br/>
                        <span class="theme_color">#2 Trade Partner</span><br/>
                        <span class="theme_color">#3 Trade Partner</span><br/>-->
                                <?php if($this->session->userdata('type') == 4){ ?>
                                    
                                <?php }else{ ?>
                        
                        <?php if($chart_type == 1){ ?>
                        <p class="mt-3">Trade Partners w/ Most Defects Per Lot:</p>
                        <div id="partner_defect_graph" style="width: 100%; height: 300px;margin: auto;"></div>
                        <?php } ?>
                        
                        <?php if($chart_type == 2){ ?>
                        <p class="mt-3">Trade Categories w/ Most Defects Per Lot:</p>
                        <div id="category_defect_graph" style="width: 100%; height: 300px;margin: auto;"></div>
                        <?php } ?>
                        
                        <?php if($chart_type == 3){ ?>
                        <p class="mt-3">Tracts w/ the Most Defects Per Lot:</p>
                        <div id="tract_defect_graph" style="width: 100%; height: 300px;margin: auto;"></div>
                        <?php } ?>
                        
                        <?php if($chart_type == 4){ ?>
                        <p class="mt-3">Trade Partners w/ the Most Days to List Completion:</p>
                        <?php if ($lot_complation_graph != "") { ?>
                        <div id="lot_complation_graph" style="width: 100%; height: 300px;margin: auto;"></div>
                        <?php } else { ?>
                            <p class="text-danger">Data  not found.</p>
                                  <?php } } } ?>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {'packages':['bar']});
    <?php if($chart_type == 1){ ?>
    google.charts.setOnLoadCallback(drawStuff);
    function drawStuff() {
        var data = new google.visualization.arrayToDataTable([
          ['', 'Count'],
          <?php echo $partner_defect_graph; ?>
        ]);
        var options = {
            legend: { position: 'none' },
            bar: { groupWidth: "100%" }
        };
        var chart = new google.charts.Bar(document.getElementById('partner_defect_graph'));
        chart.draw(data, options);
    };
    <?php } ?>
    
    <?php if($chart_type == 2){ ?>
    google.charts.setOnLoadCallback(drawStuffMulti);
    function drawStuffMulti() {
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
    <?php } ?>

    <?php if($chart_type == 3 || $this->session->userdata('type') == 4){ ?>
    google.charts.setOnLoadCallback(drawStuffMulti);
    function drawStuffMulti() {
        var data = new google.visualization.arrayToDataTable([
          ['', 'Count'],
          <?php echo $tracts_defect_graph; ?>
        ]);
        var options = {
//            width: 200,
//            height: 300,
            legend: { position: 'none' },
            bar: { groupWidth: "100%" }
        };
        var chart = new google.charts.Bar(document.getElementById('tract_defect_graph'));
        chart.draw(data, options);
    };
    <?php } ?>

    <?php if($chart_type == 4){ ?>
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
</script>