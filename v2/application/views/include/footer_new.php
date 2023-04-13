</div>
<!-- /Main Wrapper -->

<!-- jQuery -->
<!--<script src="<?php echo base_url(); ?>assets/js/jquery-3.2.1.min.js"></script>-->

<!-- Bootstrap Core JS -->
<script src="<?php echo base_url(); ?>assets/js/popper.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>

<!-- Slimscroll JS -->
<script src="<?php echo base_url(); ?>assets/js/jquery.slimscroll.min.js"></script>

<!-- Select2 JS -->
<script src="<?php echo base_url(); ?>assets/js/select2.min.js"></script>

<!-- Datetimepicker JS -->
<script src="<?php echo base_url(); ?>assets/js/moment.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap-datetimepicker.min.js"></script>

<!-- Tagsinput JS -->
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>

<!-- Summernote JS -->
<script src="<?php echo base_url(); ?>assets/js/summernote-bs4.min.js"></script>

<!-- Datatable JS -->
<!--<script src="<?php echo base_url(); ?>assets/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/dataTables.bootstrap4.min.js"></script>-->
                
<!-- Custom JS -->
<script src="<?php echo base_url(); ?>assets/js/app.js"></script>
<script type="text/javascript">
    $("input, textarea").on("keypress", function(e) {
        if (e.which === 32 && !this.value.length)
        {
            e.preventDefault();
        }
    });
    function isNumberKey(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }
</script>
</body>
</html>