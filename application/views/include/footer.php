<script src="<?php echo base_url(); ?>assets/plugins/common/common.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/custom.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/settings.js"></script>
<script src="<?php echo base_url(); ?>assets/js/gleek.js"></script>
<script src="<?php echo base_url(); ?>assets/js/styleSwitcher.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/tables/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/tables/js/datatable/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/tables/js/datatable-init/datatable-basic.min.js"></script>

    
<script>
//    $(".zero-configuration1").DataTable({ "aaSorting": [] });
    $('.zero-configuration1').DataTable({
        "paging": false,
        "ordering": false,
        "info": false
    });
    $("input, textarea").on("keypress", function (e) {
        if (e.which === 32 && !this.value.length)
        {
            e.preventDefault();
        }
    });
</script>
<script language="javascript" type="text/javascript">
    $(function () {
        $("#fileupload").change(function (e) {
            var file = $(this)[0].files[0];
            var allowedExtensions = ['jpg','JPG', 'png','jpeg'];
            var extension = file.name.split('.')[file.name.split('.').length - 1];
            $('.imgval').text("").css({color: 'red'}).hide();
           // alert(extension);
            if (allowedExtensions.indexOf(extension) >= 0) {
                var reader = new FileReader;

                reader.onload = function (e) {
                    $('#dvPreview').html('<img src="' + e.target.result + '" height="200" />');
                }
                 $("#btnsubmit").prop("disabled", false);
                reader.readAsDataURL(file);
            } else {
                $("#btnsubmit").prop("disabled", true);
                $('.imgval').text("Please upload a valid image file.").show();
            }
        });
        $("#fileupload2").change(function (e) {
            var file = $(this)[0].files[0];
            var allowedExtensions = ['jpg', 'JPG', 'png','jpeg'];
            var extension = file.name.split('.')[file.name.split('.').length - 1];
            $('.imgval').text("").css({color: 'red'}).hide();
           // alert(extension);
            if (allowedExtensions.indexOf(extension) >= 0) {
                var reader = new FileReader;

                reader.onload = function (e) {
                    $('#dvPreview2').html('<img src="' + e.target.result + '" height="200" />');
                }
                 $("#btnsubmit").prop("disabled", false);
                reader.readAsDataURL(file);
            } else {
                $("#btnsubmit").prop("disabled", true);
                $('.imgval').text("Please upload a valid image file.").show();
            }
        });
    });
</script>
</body>

</html>
