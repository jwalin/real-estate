<html>
<head>
 <title>RealEstate Template</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/font-awesome.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
<body>
<!-- Main Wrapper -->
        <div class="main-wrapper">
			<div class="account-content">
				
				<div class="container">
				
					<!-- Account Logo -->
					<div class="account-logo" style="margin-top: 10%;">
						<a href="#"><img src="<?php echo base_url(); ?>assets/images/logo2.png" alt="Dreamguy's Technologies"></a>
					</div>
					<!-- /Account Logo -->
					
					<div class="account-box">
						<div class="account-wrapper">
							<h3 class="account-title">Login</h3>
							<p class="account-subtitle">Access to our dashboard</p>
							
							<!-- Account Form -->
							<form action="<?php echo base_url('login/profile'); ?>">
								<div class="form-group">
									<label>Email Address</label>
									<input class="form-control" type="text">
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col">
											<label>Password</label>
										</div>
										<div class="col-auto">
											<a class="text-muted" href="<?php echo base_url('Login/register'); ?>">
												Forgot password?
											</a>
										</div>
									</div>
									<input class="form-control" type="password">
								</div>
								<div class="form-group text-center">
									<button class="btn btn-primary account-btn" type="submit">Login</button>
								</div>
								<div class="account-footer">
									
								</div>
							</form>
							<!-- /Account Form -->
							
						</div>
					</div>
				
			
				
			</div>
		</div>
	</div>
		<!-- /Main Wrapper -->

                          
                

            
<script src="<?php echo base_url(); ?>assets/js/jquery-3.2.1.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/popper.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/app.js"></script>
<script src="<?php echo base_url(); ?>assets/js/summernote-bs4.min.js"></script>

</body>
</html>