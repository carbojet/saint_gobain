<!DOCTYPE html>
<html>
	<head lang="fr">
		<title>Serp Rect 1</title>
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
							<form action="<?php echo site_url('sentinal/save_sentinal_data');?>" method="post" autocomplete="off">	
								<div class="site-box-div bg-white py-5">
									<div class="site-title-div">
										<h2 class="site-title">Sentinel Data</h2>
									</div>
									<ul class="site-input-list grid-5 clearfix pt-3">
										<li class="input-list-li">							
											<div class="form-group">
												<label class="input-label">Customer name</label>
												<input type="text" class="form-control site-input" name="customer_name" value="<?php echo $sentinal_data['customer_name'];?>">
											</div>
										</li>
										<li class="input-list-li">							
											<div class="form-group">
												<label class="input-label">Item No</label>
												<input type="text" class="form-control site-input" name="item_number" value="<?php echo $sentinal_data['item_number'];?>">
											</div>
										</li>
										<li class="input-list-li">							
											<div class="form-group">
												<label class="input-label">OA No.</label>
												<input type="text" class="form-control site-input" name="oa_num" value="<?php echo $sentinal_data['oa_num'];?>">
											</div>
										</li>
										<li class="input-list-li">							
											<div class="form-group">
												<label class="input-label">MODULE</label>
												<select class="form-control custom-select s-input-border" name="module" required>
													<?php foreach($module_master as $mm){ ?>
													<option value="<?php echo $mm->Module;?>" <?php if($mm->Module == $sentinal_data['module']){?>Selected<?php } ?>><?php echo $mm->Module;?></option>
													<?php } ?>
												</select>
											</div>
										</li>
										<li class="input-list-li">							
											<div class="form-group">
												<label class="input-label">CATEGORY</label>
												<input type="text" class="form-control site-input" name="category" value="<?php echo $sentinal_data['category'];?>">
											</div>
										</li>
										<li class="input-list-li">							
											<div class="form-group">
												<label class="input-label">ORDER QUALITY</label>
												<select class="form-control custom-select s-input-border" name="quality" required>
													<?php foreach($quality_master as $qm){ ?>
													<option value="<?php echo $qm->OrderQuality;?>" <?php if($qm->OrderQuality == $sentinal_data['quality']){?>Selected<?php } ?>><?php echo $qm->OrderQuality;?></option>
													<?php } ?>
												</select>
											</div>
										</li>
										<li class="input-list-li">							
											<div class="form-group">
												<label class="input-label">SHAPE</label>
												<input type="text" class="form-control site-input" name="shape" value="<?php echo $sentinal_data['shape'];?>">
											</div>
										</li>
										<li class="input-list-li">							
											<div class="form-group">
												<label class="input-label">SIZE</label>
												<input type="text" class="form-control site-input" name="size" placeholder="0 x 0 x 0" value="<?php echo $sentinal_data['size'];?>" <?php if($sentinal_data['shape'] == "SHAPE"){?>disabled<?php } ?>>
											</div>
										</li>
										<li class="input-list-li">							
											<div class="form-group">
												<label class="input-label">MATERIAL DESCRIPTION</label>
												<input type="text" class="form-control site-input" name="matl_desc" value="<?php echo $sentinal_data['matl_desc'];?>">
											</div>
										</li>
										<li class="input-list-li">							
											<div class="form-group">
												<label class="input-label">ORDER QTY</label>
												<input type="text" class="form-control site-input" name="order_qty" value="<?php echo $sentinal_data['order_qty'];?>">
											</div>
										</li>							
									</ul>
									<div class="site-btn-div mt-4 pt-2 text-center">
										<button type="submit" class="site-btn px-5 f-18" id="rect_2_page">Proceed</button>
									</div>
									<input type="hidden" name="url_prefix" value="<?php echo $shape;?>">
									<input type="hidden" name="row_id" value="<?php echo $row_id;?>">
									<input type="hidden" name="plant_id" value="<?php echo $plant_id;?>">
									<input type="hidden" name="sale_line_no" value="<?php echo $sentinal_data['sale_line_no'];?>">
									<input type="hidden" name="castingtype" value="<?php echo $sentinal_data['castingtype'];?>">
								</div>
							</form>
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