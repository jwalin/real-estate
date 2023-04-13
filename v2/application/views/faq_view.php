<div class="content container-fluid">

    <!-- Page Header -->
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <h3 class="page-title">FAQ</h3>
<!--                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url('home'); ?>">Home</a></li>
                    <li class="breadcrumb-item active">FAQ</li>
                </ul>-->
            </div>
        </div>
    </div>
    <!-- /Page Header -->

    <div class="faq-card" style="margin-top: 20px;">
        
        <?php $i = 1; foreach ($datas as $data){ ?>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    <a class="collapsed" data-toggle="collapse" href="#collapse<?php echo $i; ?>"><?php echo $data->title; ?></a>
                </h4>
            </div>
            <div id="collapse<?php echo $i; ?>" class="card-collapse collapse">
                <div class="card-body">
                    <p class="pt-3"><?php echo $data->description; ?></p>
                </div>
            </div>
        </div>
        <?php $i++; } ?>
        
    </div>
</div>
<!-- /Page Content -->
