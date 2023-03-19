<!DOCTYPE html>
<html>
	<head lang="fr">
		<title>Serp Shape 2</title>
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
							<div class="site-box-div bg-white">
								<div class="site-title-div">
									<h2 class="site-title">Shape Selection</h2>
								</div>
								<form action="<?php echo site_url('sentinal/save_shape_and_sub_category_data');?>" method="post" autocomplete="off" id="shape-form">	
									<div class="shape-tab-box active" id="tab_btn_1_box">
										<ul class="site-input-list w-75 mx-auto grid-3 clearfix pt-3">
											<li class="input-list-li">							
												<div class="form-group">
													<label class="input-label">SHAPE</label>
													<input type="text" class="form-control site-input" value="<?php echo $sentinal_data[0]->shape;?>" name="shape">
												</div>
											</li>
											<li class="input-list-li">							
												<div class="form-group">
													<label class="input-label">MODULE</label>
													<input type="text" class="form-control site-input" value="<?php echo $sentinal_data[0]->module;?>" name="module">
												</div>
											</li>
											<li class="input-list-li">							
												<div class="form-group">
													<label class="input-label">MATERIAL DESCRIPTION</label>
													<input type="text" class="form-control site-input" value="<?php echo $sentinal_data[0]->materialdesc;?>" name="materialdesc">
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
										<div class="site-btn-div mt-3 pb-3 pt-2 text-center">
											<a href="<?php echo site_url('sentinal/shape/step-one.html?row_id='.$row_id.'&plant_id='.$plant_id.'&is_edit=1');?>" class="site-btn px-5 f-18 mr-5" id="rect_1_page">Back</a>
											<button type="button" class="site-btn px-5 f-18" id="tab_btn_1">Select Modal</button>
										</div>
									</div>
									<div class="shape-tab-box" id="tab_btn_2_box">
										<ul class="site-input-list w-75 mx-auto grid-3 clearfix pt-3">
											<li class="input-list-li">							
												<div class="form-group filter-sel">
													<label class="input-label">MATERIAL DESCRIPTION</label>
													<input type="text" class="form-control site-input" value="<?php echo $sentinal_data[0]->materialdesc;?>" name="materialdesc">
												</div>
											</li>
											<li class="input-list-li">							
												<div class="form-group filter-sel">
													<label class="input-label">SHAPE</label>
													<select class="form-control custom-select s-input-border" id="shape-selection" name="productname">
														<option value="">Select a shape</option>
														<?php foreach($shape_available as $sh){ ?>
														<option value="<?php echo $sh->productname;?>"><?php echo $sh->productname;?></option>
														<?php } ?>
													</select>
												</div>
											</li>
										</ul>
										<div class="site-title-div">
											<h2 class="site-title">Shape Library</h2>
										</div>
										<div class="shape-outer-div pb-5">
											<div class="shape-slider-owl site-owl owl-carousel">
												<div class="item">
													<div class="item-inner">
														<div class="shape-list-div">
															<ul class="custom-radios" id="shape-slider-div">
																<?php if(isset($is_edit)){if($sentinal_data[0]->productname != ''){foreach($sub_category_available as $avail){ ?>
																<li class="<?php if($sentinal_data[0]->sub_category == $avail->sub_category){ ?>active<?php } ?>" data-sub="<?php echo $avail->sub_category;?>">
																    <div class="custom-div-inner">
																      	<span class="shape-img-span">
																      		<img data-src="<?php echo img_url('shape/subcategory/'.$plant_id.'/'.$sentinal_data[0]->productname.'/3D IMAGES/'.$avail->sub_category.'.JPG');?>" class="img-fluid lazyload shape-img">
																      	</span>
																      	<p class="shape-label font-600 mb-0 mt-2"><?php echo $avail->sub_category;?></p>
																    </div>
																</li>
																<?php }}} ?>
															</ul>
														</div>
													</div>
												</div>
											</div>
											<div class="site-btn-div mt-4 pt-2 text-center">
												<button type="button" class="site-btn tab-box-btn px-5 f-18" id="tab_btn_2">Proceed</button>
											</div>
											<input type="hidden" id="row_id" name="row_id" value="<?php echo $row_id;?>">
											<input type="hidden" id="plant_id" name="plant_id" value="<?php echo $plant_id;?>">
											<input type="hidden" id="castingtype" name="castingtype" value="<?php echo $sentinal_data[0]->castingtype;?>">
											<input type="hidden" id="module" name="module" value="<?php echo $sentinal_data[0]->module;?>">
											<input type="hidden" name="sub_category" id="sub_category" value="<?php if(isset($is_edit)){if($sentinal_data[0]->sub_category != ''){ echo $sentinal_data[0]->sub_category;}}?>">
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
		<?php $this->load->view('bloc/footer'); ?>
		<script>
			// Shape slider
			$(".shape-slider-owl").owlCarousel({
				margin: 0,
		    	nav: true,
		  		navText: ['<i class="fas fa-chevron-left arrow-icon"></i>','<i class="fas fa-chevron-right arrow-icon"></i>'],
		    	loop: false,
		    	dots: false,
		    	responsive: {
		      		0: {
		        		items: 1,
		      		},
		      		600: {
		        		items: 1,
		      		},
		      		1000: {
		        		items: 1
		      		}
		    	}
			});
			$(document).ready(function(){
				<?php if($sentinal_data[0]->mold_type == ''){ if($plant_id == '2001'){ ?>
				$('#mold_type').val('FENOTEC');
				<?php }else{ ?>
				$('#mold_type').val('GRAPHITE');
				<?php }}else{ ?>
				$('#mold_type').val('<?php echo $sentinal_data[0]->mold_type;?>');
				<?php } ?>

				<?php if($sentinal_data[0]->drawing_type != ''){ ?>
				$('#drawing_type').val('<?php echo $sentinal_data[0]->drawing_type;?>');
				<?php } ?>

				<?php if($sentinal_data[0]->productname != ''){ ?>
				$('#shape-selection').val('<?php echo $sentinal_data[0]->productname;?>');
				<?php } ?>

				var length = $('#shape-selection > option').length;
				if(length == 2){
					$('#shape-selection').find('option')[1].selected=true;
					var shape = $('#shape-selection').val();
				    var plant_id = $('#plant_id').val();
				    var castingtype = $('#castingtype').val();
				    var module_name = $('#module').val();
				    var cat_img_url = "<?php echo img_url('shape/subcategory/');?>"+plant_id+"/"+shape+"/3D IMAGES/";

				    $('#shape-slider-div').html('');

				    if(shape != ''){
				    	$.ajax({
				            url: '<?php echo site_url("sentinal/get_sub_category_by_shape");?>',
				            type: 'post',
				            data: {shape:shape, plant_id:plant_id, castingtype:castingtype, module_name:module_name},
							dataType:'json',
							async: false,
				            success: function(data){
								var count = data.sub_category_available.length;
								if(count>0){
									$.each(data.sub_category_available,function(index,element){
										var div = '<li data-sub="'+data.sub_category_available[index].sub_category+'"><div class="custom-div-inner"><span class="shape-img-span"><img data-src="'+cat_img_url+data.sub_category_available[index].sub_category+'.JPG" class="img-fluid lazyload shape-img"> </span><p class="shape-label font-600 mb-0 mt-2">'+data.sub_category_available[index].sub_category+'</p></div></li>';
										$("#shape-slider-div").append(div);
									});
								}
							}
				        });
				    }

				    $('#sub_category').val();
				}

				$(document).on( "click", ".custom-radios > li", function() {
					$('.custom-radios > li').removeClass('active');
					$('#sub_category').val($(this).data('sub'));
					$(this).addClass('active');
				});

				$('#tab_btn_1').on('click' , function(){
					$('.shape-tab-box').removeClass('active');
					$('#tab_btn_2_box').addClass('active');
				})

				$('#tab_btn_2').on('click' , function(){
					if($('#shape-selection').val() != '' && $('#sub_category').val() != ''){
						$('#shape-form').submit();
					}
				});

				$('#shape-selection').on('change', function() {
				    var shape = $(this).find(":selected").val();
				    var plant_id = $('#plant_id').val();
				    var castingtype = $('#castingtype').val();
				    var module_name = $('#module').val();
				    var cat_img_url = "<?php echo img_url('shape/subcategory/');?>"+plant_id+"/"+shape+"/3D IMAGES/";

				    $('#shape-slider-div').html('');

				    if(shape != ''){
				    	$.ajax({
				            url: '<?php echo site_url("sentinal/get_sub_category_by_shape");?>',
				            type: 'post',
				            data: {shape:shape, plant_id:plant_id, castingtype:castingtype, module_name:module_name},
							dataType:'json',
							async: false,
				            success: function(data){
								var count = data.sub_category_available.length;
								if(count>0){
									$.each(data.sub_category_available,function(index,element){
										var div = '<li data-sub="'+data.sub_category_available[index].sub_category+'"><div class="custom-div-inner"><span class="shape-img-span"><img data-src="'+cat_img_url+data.sub_category_available[index].sub_category+'.JPG" class="img-fluid lazyload shape-img"> </span><p class="shape-label font-600 mb-0 mt-2">'+data.sub_category_available[index].sub_category+'</p></div></li>';
										$("#shape-slider-div").append(div);
									});
								}
							}
				        });
				    }

				    $('#sub_category').val();
				});
			});
		</script>
	</body>
</html>