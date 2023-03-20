<!DOCTYPE html>
<html>
	<head lang="fr">
		<title>You are reached unauthorized page</title>
		<meta name="description" content="">
		<meta charset="utf-8">
		<meta name="robots" content="noindex, nofollow">
		<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
		<link href="<?php echo css_url('animate.min');?>" rel="stylesheet">
		<link rel="stylesheet" href="<?php echo css_url('bootstrap.min');?>">
		<link rel="stylesheet" href="<?php echo css_url('style');?>">
	</head>
	<body>
		<?php $this->load->view('bloc/menu'); ?>
		<div class="body-wrapper">
			<section>
				<div class="container modified-container">
					<div class="row">
						<div class="col-12">
							<div class="site-box-div bg-white py-5">
                                <div class="site-title-div">
                                    <h2 class="site-title">You Are Unauthorized !</h2>
                                    <p>Please make sure <b>SGID</b>, <b>Plant ID</b> and <b>Line ID</b> Must Pass through to Processed farther...</p>
                                </div>
                            </div>
						</div>
					</div>
				</div>
			</section>
		</div>
		<?php $this->load->view('bloc/footer'); ?>
		<script>
			$(document).ready(function() {
        		$('#shape_selection').on('change', function() {
  					var shape_selection = this.value;

  					if(shape_selection == "SHAPE"){
  						$('#shape_size').prop('disabled', true);

  					}else{
  						$('#shape_size').prop('disabled', false);

  					}
				});
    		}); 
		</script>
	</body>
</html>