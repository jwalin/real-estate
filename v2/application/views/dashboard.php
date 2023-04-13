
<div class="content-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-4">
                <div class="card card-widget">
                    <a href="<?php echo base_url('user') ?>">
                        <div class="card-body gradient-3" style="background: #fff;color: #111 !important;border: 1px solid #021042;border-radius: 10px;">
                            <div class="media" style="color: #111;">
                                <span class="card-widget__icon"><i class="fa fa-group" style="color: #111;"></i></span>
                                <div class="media-body">                                
                                    <h2 class="card-widget__title" style="color: #111;"><?php echo $user->user_count; ?></h2>
                                    <h5 class="card-widget__subtitle" style="color: #111;">Total User</h5>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

           </div>

        <!--        <div class="row">
                     Line Chart 
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Order revenue</h4>
                                <canvas id="lineChart" width="500" height="250"></canvas>
                            </div>
                        </div>
                    </div>
        
                </div>
        
        
        
        
        
        
            </div>
        </div>
        
        <script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.js" type="text/javascript"></script>
        
        <script src="<?php echo base_url(); ?>assets/plugins/chart.js/Chart.bundle.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/chartist/js/chartist.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/chartist-plugin-tooltips/js/chartist-plugin-tooltip.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/dashboard/dashboard-1.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/plugins-init/chartjs-init.js"></script>
        
        <script>
        
            (function ($) {
                "use strict"
        
                var ctx = document.getElementById("lineChart");
                ctx.height = 150;
                var myChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
                        datasets: [
                            {
                                label: "Year - <?php echo date('Y'); ?>",
                                borderColor: "rgba(68, 138, 127, 1)",
                                borderWidth: "1",
                                backgroundColor: "rgba(68, 138, 127, .7)",
                                data: [<?php echo $month1; ?>, <?php echo $month2; ?>, <?php echo $month3; ?>, <?php echo $month4; ?>, <?php echo $month5; ?>, <?php echo $month6; ?>, <?php echo $month7; ?>, <?php echo $month8; ?>, <?php echo $month9; ?>, <?php echo $month10; ?>, <?php echo $month11; ?>, <?php echo $month12; ?>]
                            },
                        ]
                    },
                    options: {
                        responsive: true,
                        tooltips: {
                            mode: 'index',
                            intersect: false
                        },
                        hover: {
                            mode: 'nearest',
                            intersect: true
                        }
        
                    }
                });
        
        
        
        
        
            })(jQuery);
        
        </script>-->
