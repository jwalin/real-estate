<style>
    #comp_cards .card-body {
        padding: 1.25rem !important;
    }
    .set_line_1{
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
    }
    .set_line_3{
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        text-align: justify;
    }
    .border_none{border: none !important;}
</style>
<div class="content container-fluid">

    <!-- Page Header -->
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <h3 class="page-title">Tutorial</h3>
<!--                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url('home'); ?>">Home</a></li>
                    <li class="breadcrumb-item active">Tutorial</li>
                </ul>-->
            </div>
        </div>
    </div>
    <!-- /Page Header -->

    <section class="comp-section comp-cards" id="comp_cards">
        <div class="row">
            
            <?php $i = 1; foreach ($datas as $data){ ?>
            <div class="col-12 col-md-6 col-lg-4 d-flex">
                <div class="card flex-fill">
                    <img alt="" src="<?php echo $data->image; ?>" class="card-img-top" style="height: 240px;object-fit: cover;">
                    <div class="card-header">
                        <h5 class="card-title mb-0 set_line_1"><?php echo $data->title; ?></h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text set_line_3"><?php echo $data->description; ?></p>
                        <p class="card-text theme_color text-right" style="cursor: pointer;" onclick="read_more('<?php echo $data->image; ?>', '<?php echo $data->title; ?>', '<?php echo $data->description; ?>')">Read More</p>
                    </div>
                </div>
            </div>
            <?php } ?>
            
        </div>
    </section>

</div>

<!-- Start Modal -->
<div id="read_more" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <!--<h5 class="modal-title">Detail</h5>-->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-lg-12 d-flex">
                    <div class="card flex-fill border_none">
                        <img alt="" src="" id="img" class="card-img-top" style="height: 240px;object-fit: cover;">
                        <div class="card-header border_none" style="padding: 15px 0;">
                            <h5 class="card-title mb-0" id="title"></h5>
                        </div>
                        <div class="card-body p-0">
                            <p class="card-text" id="description"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Modal -->

<script>
    function read_more(img, title, desc){
        $("#img").attr("src", img);
        $('#title').html(title);
        $('#description').html(desc);
        $('#read_more').modal('show');
    }
</script>