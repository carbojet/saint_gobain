<!DOCTYPE html>
<html>
	<head lang="fr">
		<title>Serp Rect 2</title>
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
		<link href="<?php echo css_url('owl.carousel.min');?>" rel="stylesheet">
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
							<form action="<?php echo site_url('sentinal/save_rectangle_shape_and_dimension_data');?>" method="post" autocomplete="off">
								<div class="site-box-div bg-white">
									<div class="site-title-div">
										<h2 class="site-title">Shape Selection</h2>
									</div>
									<ul class="site-input-list w-75 mx-auto grid-3 clearfix pt-3">
										<li class="input-list-li">							
											<div class="form-group">
												<label class="input-label">SHAPE</label>
												<input type="text" class="form-control site-input" placeholder="" value="<?php echo $sentinal_data[0]->shape;?>" name="shape">
											</div>
										</li>
										<li class="input-list-li">							
											<div class="form-group">
												<label class="input-label">MODULE</label>
												<input type="text" class="form-control site-input" placeholder="" value="<?php echo $sentinal_data[0]->module;?>" name="module">
											</div>
										</li>
										<li class="input-list-li">							
											<div class="form-group">
												<label class="input-label">MATERIAL DESCRIPTION</label>
												<input type="text" class="form-control site-input" placeholder="" value="<?php echo $sentinal_data[0]->materialdesc;?>" name="materialdesc">
											</div>
										</li>
										<li class="input-list-li">							
											<div class="form-group filter-sel">
												<label class="input-label">MOLD TYPE</label>
												<select class="form-control custom-select s-input-border" name="mold_type" id="mold_type">
													<option value="FENOTEC">FENOTEC</option>
													<option value="FURAN">FURAN</option>
													<option value="GRAPHITE">GRAPHITE</option>
												</select>
											</div>
										</li>
										<li class="input-list-li">							
											<div class="form-group filter-sel">
												<label class="input-label">DRAWING TYPE</label>
												<select class="form-control custom-select s-input-border" name="drawing_type" id="drawing_type">
													<option value="PARENT">PARENT</option>
													<option value="CHILD">CHILD</option>
												</select>
											</div>
										</li>
									</ul>
									<div class="site-seprator"></div>
									<div class="site-title-div">
										<h2 class="site-title">Dimension Entry</h2>
									</div>
									<div class="row">
										<div class="col-md-5">
											<div class="dimension-outer-div pb-5">	
												<div class="title-grid-div">
													<div>Side</div>
													<div>Dimension</div>
													<div>Machining Allowance</div>
												</div>							
												<div class="dimension-slider-owl site-owl owl-carousel">
													<div class="item">
														<div class="item-inner">
															<div class="dimension-list-div">
																<ul class="dimension-inputlist">
																	<li class="dimension-li">
																		<div class="dimension-no f-20">
																			<span>A</span>
																		</div>
																	    <div class="form-group">
																			<input type="text" name="dimension[]" class="form-control site-input" value="<?php echo $dimension_entry[0]['dimenstion'];?>" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" maxlength="3">
																		</div>
																		<div class="form-group">
																			<input type="text" name="allowance[]" class="form-control site-input" value="<?php echo $dimension_entry[0]['allowance'];?>" maxlength="2">
																		</div>
																		<input type="hidden" name="parameter[]" value="A">
																	</li>
																	<li class="dimension-li">
																		<div class="dimension-no f-20">
																			<span>B</span>
																		</div>
																	    <div class="form-group">
																			<input type="text" name="dimension[]" class="form-control site-input" value="<?php echo $dimension_entry[1]['dimenstion'];?>" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" maxlength="3">
																		</div>
																		<div class="form-group">
																			<input type="text" name="allowance[]" class="form-control site-input" value="<?php echo $dimension_entry[1]['allowance'];?>" maxlength="2">
																		</div>
																		<input type="hidden" name="parameter[]" value="B">
																	</li>
																	<li class="dimension-li">
																		<div class="dimension-no f-20">
																			<span>C</span>
																		</div>
																	    <div class="form-group">
																			<input type="text" name="dimension[]" class="form-control site-input" value="<?php echo $dimension_entry[2]['dimenstion'];?>" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" maxlength="3">
																		</div>
																		<div class="form-group">
																			<input type="text" name="allowance[]" class="form-control site-input" value="<?php echo $dimension_entry[2]['allowance'];?>" maxlength="2">
																		</div>
																		<input type="hidden" name="parameter[]" value="C">
																	</li>
																</ul>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="col-md-7">
											<div class="dimension-chart-div dimension-rect-chart text-center">
												<img data-src="<?php echo img_url('models/shape-new.png');?>" class="img-fluid lazyload h-100">
											</div>
										</div>
										<div class="col-md-12">
											<div class="site-btn-div mt-4 pb-5 pt-2 text-center">
												<a href="<?php echo site_url('sentinal/rectangle/step-one.html?row_id='.$row_id.'&plant_id='.$plant_id.'&is_edit=1');?>" class="site-btn px-5 f-18 mr-5" id="rect_1_page">Back</a>
												<button type="submit" class="site-btn px-5 f-18 mr-5" id="rect_3_page">Proceed</button>
											</div>
										</div>
									</div>
								</div>
								<input type="hidden" name="row_id" value="<?php echo $row_id;?>">
								<input type="hidden" name="plant_id" value="<?php echo $plant_id;?>">
							</form>
						</div>
					</div>
				</div>
			</section>
		</div>
		<?php $this->load->view('bloc/footer'); ?>
		<script>
			<?php if($sentinal_data[0]->mold_type == ''){ if($plant_id == '2001'){ ?>
			$('#mold_type').val('FENOTEC');
			<?php }else{ ?>
			$('#mold_type').val('GRAPHITE');
			<?php }}else{ ?>
			$('#mold_type').val('<?php echo $sentinal_data[0]->mold_type;?>');
			<?php } ?>

			
			<?php if($sentinal_data[0]->drawing_type != ''){ ?>
			$('#drawing_type').val('<?php echo $sentinal_data[0]->drawing_type;?>');
			<?php if($sentinal_data[0]->drawing_type == 'CHILD'){ ?>
			$('input[name="allowance[]"]').prop('disabled', true);
			<?php }else{ ?>
			$('input[name="allowance[]"]').prop('disabled', false);
			<?php }} ?>

			$('#drawing_type').on('change', function() {
				var drawing_type = this.value;
				
				if(drawing_type == 'CHILD'){
					$('input[name="allowance[]"]').prop('disabled', true);
				}else{
					$('input[name="allowance[]"]').prop('disabled', false);
				}
			});

			// Destination slider page banner
			$(".dimension-slider-owl").owlCarousel({
				margin: 0,
			    nav: true,
			  	navText: ['<i class="fas fa-chevron-left arrow-icon"></i>','<i class="fas fa-chevron-right arrow-icon"></i>'],
			    loop: false,
			    dots: false,
			    // lazyLoad: true,
			    // itemSlide : 4,
			    responsive: {
			      0: {
			        items: 1,
			        // stagePadding: 20
			      },
			      600: {
			        items: 1,
			        // stagePadding: 20
			      },
			      1000: {
			        items: 1

			      }
			    }
			});
		</script>
	</body>
</html>