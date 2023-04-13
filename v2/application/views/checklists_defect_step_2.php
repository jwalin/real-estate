
    <script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
    <!--<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">-->
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
<style>
    .custom-file-upload {
        border: 1px solid #ccc;
        display: inline-block;
        padding: 6px 12px;
        cursor: pointer;
    }
    #toast-container>div{opacity: 1 !important;}
</style>
<div class="content container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <?php if ($this->session->flashdata('success')) { ?>
                <div class="alert alert-success clearfix"><?php echo $this->session->flashdata('success'); ?>
                    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                </div>
            <?php } if ($this->session->flashdata('error')) { ?>
                <div class="alert alert-danger clearfix"><?php echo $this->session->flashdata('error'); ?></div>
            <?php } ?>
            <div class="card mb-0">
                <div class="card-body p-3 text-center">
                    <div class="col-sm-3 pull-left">&nbsp;</div>
                    <div class="col-sm-6 p-0 pull-left">
                        <form action="<?php echo base_url('checklists_defect/insert_step_2'); ?>" method="post" onsubmit="return validate_form()">
                            <input type="hidden" name="tract_id" value="<?php echo @$this->uri->segment(3); ?>">
                            <input type="hidden" name="lot_id" value="<?php echo @$this->uri->segment(4); ?>">
                            <input type="hidden" name="location" value="<?php echo @$this->uri->segment(5); ?>">
                            <input type="hidden" name="category" value="<?php echo @$this->uri->segment(6); ?>">
                            <input type="hidden" name="defect_type" value="<?php echo @$this->uri->segment(7); ?>">
                            <input type="hidden" name="scanner_url" id="scanner_url" value="">
                            <fieldset>
                                <h2 class="theme_color">New Defect List - Step 1</h2><br>
                                <?php 
                                if(@$this->uri->segment(3) && @$this->uri->segment(4)){
                                $tract_data = $this->home_model->get_tract_name(@$this->uri->segment(3));
                                $lot_data = $this->home_model->get_lot_name(@$this->uri->segment(4));
                                ?>
                                <h4><?php echo $tract_data->tract_no; ?> - <?php echo $lot_data->lot_no; ?></h4><br>
                                <?php } ?>
                                <h4><u>Scan the Defect’s EZQC Label</u></h4>
<!--                                <br>
                                <label for="file-upload" class="custom-file-upload">
                                    <i class="fa fa-barcode"></i> Scan Defect
                                </label>
                                <input id="file-upload" type="file" accept="image/*" capture="camera" style="display: none;"> 
                                <input id="file-upload" type="file" style="display: none;"/>-->
                                <br/>
                                
                                <!-- Start Scanner -->

                                <div>
                                    <b>Device has camera: </b>
                                    <span id="cam-has-camera"></span>
                                    <br>
                                    <video muted playsinline id="qr-video" style="width: 300px;height: 300px;"></video>
                                </div>
                                <div style="display: none;">
                                    <select id="inversion-mode-select">
                                        <option value="original">Scan original (dark QR code on bright background)</option>
                                        <option value="invert">Scan with inverted colors (bright QR code on dark background)</option>
                                        <option value="both" selected="">Scan both</option>
                                    </select>
                                    <br>
                                </div>
                                <b>Detected QR code: </b>
                                <span id="cam-qr-result">None</span>
                                <br>
                                <div style="display: none;">
                                <b>Last detected at: </b>
                                <span id="cam-qr-result-timestamp"></span>
                                </div>
                                <div style="display: none;">
                                <h1>Scan from File:</h1>
                                <input type="file" id="file-selector">
                                <b>Detected QR code: </b>
                                <span id="file-qr-result">None</span>
                                </div>
                                
                                <!-- End Scanner -->
                                
                                <br>
                                <input type="submit" id="sub_click" class="btn btn-primary mt-3" value="Next" /><br/>
                                <a href="<?php echo base_url('checklists_defect/defect_step_2_custom/'.@$this->uri->segment(3).'/'.@$this->uri->segment(4).'/'.@$this->uri->segment(5).'/'.@$this->uri->segment(6).'/'.@$this->uri->segment(7)); ?>"><input type="button" class="btn btn-primary mt-3" value="No EZQC Label?" /></a><br/>
                                <a href="<?php echo base_url('checklists/checklist_defects/'.base64_decode(base64_decode(@$this->uri->segment(3))).'/'.base64_decode(base64_decode(@$this->uri->segment(4))).'/'.base64_decode(base64_decode(@$this->uri->segment(5))).'/'.base64_decode(base64_decode(@$this->uri->segment(6))).'/'.base64_decode(base64_decode(@$this->uri->segment(7)))); ?>"><input type="button" class="btn btn-primary mt-3" value="Cancel" /></a>
                                
                            </fieldset>
                        </form>
                    </div>
                    <div class="col-sm-3 pull-left">&nbsp;</div>
                </div>
            </div>
        </div>
    </div>
</div>



<script type="module">
    import QrScanner from "<?php echo base_url(); ?>assets/scanner/qr-scanner.min.js";
    QrScanner.WORKER_PATH = '<?php echo base_url(); ?>assets/scanner/qr-scanner-worker.min.js';

    const video = document.getElementById('qr-video');
    const camHasCamera = document.getElementById('cam-has-camera');
    const camQrResult = document.getElementById('cam-qr-result');
    const camQrResultTimestamp = document.getElementById('cam-qr-result-timestamp');
    const fileSelector = document.getElementById('file-selector');
    const fileQrResult = document.getElementById('file-qr-result');

    function setResult(label, result) {
    label.textContent = result;
    camQrResultTimestamp.textContent = new Date().toString();
    label.style.color = 'teal';
    clearTimeout(label.highlightTimeout);
    label.highlightTimeout = setTimeout(() => label.style.color = 'inherit', 100);
//    alert('Code detected.');
    validate_code();
    toastr.remove();
    toastr.success('Code detected.', result, {timeOut: 5000})
    }

    // ####### Web Cam Scanning #######

    QrScanner.hasCamera().then(hasCamera => camHasCamera.textContent = hasCamera);

    const scanner = new QrScanner(video, result => setResult(camQrResult, result));
    scanner.start();

    document.getElementById('inversion-mode-select').addEventListener('change', event => {
    scanner.setInversionMode(event.target.value);
    });

    // ####### File Scanning #######

    fileSelector.addEventListener('change', event => {
    const file = fileSelector.files[0];
    if (!file) {
    return;
    }
    QrScanner.scanImage(file)
    .then(result => setResult(fileQrResult, result))
    .catch(e => setResult(fileQrResult, e || 'No QR code found.'));
    });

</script>
<script>
    function validate_form(){
        var scan_data = $('#cam-qr-result').html();
        $('#scanner_url').val(scan_data);
        if(scan_data == "" || scan_data == "None"){
            toastr.remove();
            toastr.error('No QR code found.', {timeOut: 5000})
            return false;
        }
        return true;
    }
    function validate_code(){
        $('#sub_click').click();
    }
    
    <?php if ($this->session->flashdata('toastr_success')) : ?>
        $(function () { //ready
            toastr.success("<?php echo $this->session->flashdata('toastr_success'); ?>");
        });
    <?php endif; ?>
    <?php if ($this->session->flashdata('toastr_error')) : ?>
        $(function () { //ready
            toastr.error("<?php echo $this->session->flashdata('toastr_error'); ?>");
        });
    <?php endif; ?>
</script>