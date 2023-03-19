<!DOCTYPE html>
<html>
	<head lang="fr">
		<title>Serp rect 3</title>
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
							<div class="site-box-div bg-white">
								<div class="site-title-div">
									<h2 class="site-title">Preview and Download</h2>
								</div>
								<div class="site-btn-div mt-4 pb-4 pt-2 text-center">
									<?php if(empty($job)){ ?>
									<button type="button" class="site-btn tab-box-btn px-5 f-16 mr-5" id="tab_btn_3">Preview</button>
									<button type="button" class="site-btn tab-box-btn active px-5 f-16" id="tab_btn_2">Process Parameter</button>
									<?php }else{ if($job[0]->jobstatus == "FALSE"){?>
									<button type="button" class="site-btn tab-box-btn px-5 f-16 mr-5" id="tab_btn_3">Preview</button>
									<button type="button" class="site-btn tab-box-btn active px-5 f-16" id="tab_btn_2">Process Parameter</button>
									<?php }else{ ?>
									<button type="button" class="site-btn tab-box-btn active px-5 f-16 mr-5" id="tab_btn_1">Preview</button>
									<button type="button" class="site-btn tab-box-btn px-5 f-16" id="tab_btn_2">Process Parameter</button>
									<?php }} ?>
								</div>
								<?php if(!empty($job)){ if($job[0]->jobstatus == "TRUE"){?>
								<div class="s-tab-box pre-dwn-img-div text-center active" id="tab_btn_1_box">
									<div class="pre-dwn-img-inner site-shadow">
										<img src="<?php echo $design_img = design_url(date('Y').'/'.$sentinal_data[0]->customername.'/'.$sentinal_data[0]->oano.'/'.$sentinal_data[0]->module.'/'.$process_parameter[0]->mno.'/'.$process_parameter[0]->mno.'.jpg');?>" class="img-fluid">
										<div class="mt-3">
											<ul class="pre-down-btn">
												<li>
													<a href="<?php echo site_url('sentinal/rectangle/step-two.html?row_id='.$row_id.'&plant_id='.$plant_id.'&is_edit=1');?>" class="site-btn">Edit</a>
												</li>
												<li class="clearfix checkbox-li">
													<input type="checkbox" name="jpg" class="form-check-input">
													<a href="<?php echo $design_img;?>" class="site-btn form-check-btn disabled-btn" download="<?php echo $process_parameter[0]->mno.'.jpg';?>">Download JPG</a>
												</li>
												<li>
													<a href="Javascript:void(0)" class="site-btn" data-toggle="modal" data-target="#prevSubmitModal" data-backdrop='static' data-keyboard='false' id="download-all">Submit</a>
												</li>
											</ul>
										</div>
									</div>
								</div>
								<?php }} ?>
								<div class="s-tab-box <?php if(!empty($job)){ if($job[0]->jobstatus == "FALSE"){ ?>active<?php }}else{ ?>active<?php } ?>" id="tab_btn_2_box">
									<form action="<?php echo site_url('sentinal/save_rectangle_process_paremeter_data');?>" method="post" autocomplete="off">	
										<?php if($sentinal_data[0]->drawing_status == '' || $sentinal_data[0]->drawing_status == 'pending'){ ?>
										<ul class="site-input-list clearfix pt-3">
											<li class="input-list-li">							
												<div class="form-group">
													<label class="input-label">Customer name</label>
													<input type="text" class="form-control site-input" placeholder="" maxlength="100" value="<?php echo $sentinal_data[0]->customername;?>" disabled>
												</div>
											</li>
											<li class="input-list-li">							
												<div class="form-group">
													<label class="input-label">Item No</label>
													<input type="text" class="form-control site-input" placeholder="" maxlength="20" value="<?php echo $sentinal_data[0]->itemno;?>" disabled>
												</div>
											</li>
											<li class="input-list-li">							
												<div class="form-group">
													<label class="input-label">OA No</label>
													<input type="text" class="form-control site-input" placeholder="" maxlength="30" value="<?php echo $sentinal_data[0]->oano;?>" disabled>
												</div>
											</li>
											<li class="input-list-li">							
												<div class="form-group">
													<label class="input-label">MODULE</label>
													<input type="text" class="form-control site-input" placeholder="" maxlength="10" value="<?php echo $sentinal_data[0]->module;?>" disabled>
												</div>
											</li>
											<li class="input-list-li">							
												<div class="form-group">
													<label class="input-label">CATEGORY</label>
													<input type="text" class="form-control site-input" placeholder="" maxlength="10" value="<?php echo $sentinal_data[0]->category;?>" disabled>
												</div>
											</li>
											<li class="input-list-li">							
												<div class="form-group">
													<label class="input-label">ORDER QUALITY</label>
													<input type="text" class="form-control site-input" placeholder="" maxlength="50" value="<?php echo $sentinal_data[0]->orderquality;?>" disabled>
												</div>
											</li>
											<li class="input-list-li">							
												<div class="form-group">
													<label class="input-label">SHAPE</label>
													<input type="text" class="form-control site-input" placeholder="" maxlength="50" value="<?php echo $sentinal_data[0]->shape;?>" disabled>
												</div>
											</li>
											<li class="input-list-li">							
												<div class="form-group">
													<label class="input-label">MATERIAL DESCRIPTION</label>
													<input type="text" class="form-control site-input" placeholder="" maxlength="100" value="<?php echo $sentinal_data[0]->materialdesc;?>" disabled>
												</div>
											</li>
											<li class="input-list-li">							
												<div class="form-group">
													<label class="input-label">ORDER QTY</label>
													<input type="text" class="form-control site-input" placeholder="" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" value="<?php echo $sentinal_data[0]->orderqty;?>" disabled>
												</div>
											</li>
											<li class="input-list-li">							
												<div class="form-group">
													<label class="input-label">MADE QTY</label>
													<input type="text" class="form-control site-input" placeholder="" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" name="madeqty" id="madeqty">
												</div>
											</li>
											<li class="input-list-li">							
												<div class="form-group">
													<label class="input-label">M NUMBER</label>
													<input type="text" class="form-control site-input" placeholder="" maxlength="20" name="mno" id="mno" value="<?php echo $mno;?>">
												</div>
											</li>
											<li class="input-list-li">							
												<div class="form-group">
													<label class="input-label">ASSEMBLY NUMBER</label>
													<input type="text" class="form-control site-input" placeholder="" maxlength="200" name="assemblyno" id="assemblyno">
												</div>
											</li>
											<li class="input-list-li">							
												<div class="form-group">
													<label class="input-label">DRAWN</label>
													<input type="text" class="form-control site-input" placeholder="" maxlength="20" name="drawn" id="drawn">
												</div>
											</li>
											<li class="input-list-li">							
												<div class="form-group">
													<label class="input-label">SPECIFICATION</label>
													<input type="text" class="form-control site-input" placeholder="" maxlength="50" name="specification" id="specification">
												</div>
											</li>
										</ul>
										<?php }else{ ?>
										<ul class="site-input-list clearfix pt-3">
											<li class="input-list-li">							
												<div class="form-group">
													<label class="input-label">Customer name</label>
													<input type="text" class="form-control site-input" placeholder="" maxlength="100" value="<?php echo $sentinal_data[0]->customername;?>" disabled>
												</div>
											</li>
											<li class="input-list-li">							
												<div class="form-group">
													<label class="input-label">Item No</label>
													<input type="text" class="form-control site-input" placeholder="" maxlength="20" value="<?php echo $sentinal_data[0]->itemno;?>" disabled>
												</div>
											</li>
											<li class="input-list-li">							
												<div class="form-group">
													<label class="input-label">OA No</label>
													<input type="text" class="form-control site-input" placeholder="" maxlength="30" value="<?php echo $sentinal_data[0]->oano;?>" disabled>
												</div>
											</li>
											<li class="input-list-li">							
												<div class="form-group">
													<label class="input-label">MODULE</label>
													<input type="text" class="form-control site-input" placeholder="" maxlength="10" value="<?php echo $sentinal_data[0]->module;?>" disabled>
												</div>
											</li>
											<li class="input-list-li">							
												<div class="form-group">
													<label class="input-label">CATEGORY</label>
													<input type="text" class="form-control site-input" placeholder="" maxlength="10" value="<?php echo $sentinal_data[0]->category;?>" disabled>
												</div>
											</li>
											<li class="input-list-li">							
												<div class="form-group">
													<label class="input-label">ORDER QUALITY</label>
													<input type="text" class="form-control site-input" placeholder="" maxlength="50" value="<?php echo $sentinal_data[0]->orderquality;?>" disabled>
												</div>
											</li>
											<li class="input-list-li">							
												<div class="form-group">
													<label class="input-label">SHAPE</label>
													<input type="text" class="form-control site-input" placeholder="" maxlength="50" value="<?php echo $sentinal_data[0]->shape;?>" disabled>
												</div>
											</li>
											<li class="input-list-li">							
												<div class="form-group">
													<label class="input-label">MATERIAL DESCRIPTION</label>
													<input type="text" class="form-control site-input" placeholder="" maxlength="100" value="<?php echo $sentinal_data[0]->materialdesc;?>" disabled>
												</div>
											</li>
											<li class="input-list-li">							
												<div class="form-group">
													<label class="input-label">ORDER QTY</label>
													<input type="text" class="form-control site-input" placeholder="" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" value="<?php echo $sentinal_data[0]->orderqty;?>" disabled>
												</div>
											</li>
											<li class="input-list-li">							
												<div class="form-group">
													<label class="input-label">MADE QTY</label>
													<input type="text" class="form-control site-input" placeholder="" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" name="madeqty" id="madeqty">
												</div>
											</li>
											<li class="input-list-li">							
												<div class="form-group">
													<label class="input-label">EXCESS QTY</label>
													<input type="text" class="form-control site-input" placeholder="" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" name="excessqty" id="excessqty">
												</div>
											</li>
											<li class="input-list-li">							
												<div class="form-group">
													<label class="input-label">NO OF PATTERNS</label>
													<input type="text" class="form-control site-input" placeholder="" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" name="noofpatterns" id="noofpatterns">
												</div>
											</li>
											<li class="input-list-li">							
												<div class="form-group">
													<label class="input-label">PIECE/MOLD</label>
													<input type="text" class="form-control site-input" placeholder="" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" name="pieceormold" id="pieceormold">
												</div>
											</li>
											<li class="input-list-li">							
												<div class="form-group">
													<label class="input-label">VOLUME</label>
													<input type="text" class="form-control site-input" placeholder="" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" name="volume" id="volume">
												</div>
											</li>
											<li class="input-list-li">							
												<div class="form-group">
													<label class="input-label">NOMINAL WEIGHT</label>
													<input type="text" class="form-control site-input" placeholder="" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" name="nominlweight" id="nominlweight">
												</div>
											</li>
											<?php if($plant_id == 2002){ ?>
											<li class="input-list-li">							
												<div class="form-group filter-sel">
													<label class="input-label">HEADER TYPE</label>
													<select class="form-control custom-select s-input-border" name="headertype" id="headertype">
														<option value="">Select</option>
														<option value="Sand Header">Sand Header</option>
														<option value="DCL type Header">DCL type Header</option>
														<option value="Cylindrical Header">Cylindrical Header</option>
														<option value="Elliptical Header">Elliptical Header</option>
														<option value="Cylindrical Dome Header">Cylindrical Dome Header</option>
														<option value="Elliptical Dome Header">Elliptical Dome Header</option>
													</select>
												</div>
											</li>
											<?php }else{ ?>
											<li class="input-list-li">							
												<div class="form-group">
													<label class="input-label">HEADER TYPE</label>
													<input type="text" class="form-control site-input" placeholder="" maxlength="30" name="headertype" id="headertype">
												</div>
											</li>
											<?php } ?>
											<?php if (strpos($sentinal_data[0]->orderquality, 'RN') !== false) { ?>
											<input type="hidden" name="stockheight" value="">
											<input type="hidden" name="stockvolume" value="">
											<input type="hidden" name="radiusselectionrtrr" value="">
											<input type="hidden" name="headershapertrr" value="">
											<input type="hidden" name="headerpercent" value="">
											<input type="hidden" name="headerheight" value="">
											<?php }else{ ?>
											<li class="input-list-li">							
												<div class="form-group">
													<label class="input-label">STOCK HEIGHT</label>
													<input type="text" class="form-control site-input" placeholder="" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" name="stockheight" id="stockheight">
												</div>
											</li>
											<li class="input-list-li">							
												<div class="form-group">
													<label class="input-label">STOCK VOLUME</label>
													<input type="text" class="form-control site-input" placeholder="" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" name="stockvolume" id="stockvolume">
												</div>
											</li>
											<li class="input-list-li">							
												<div class="form-group">
													<label class="input-label">RADIUS SELECTION-RT/RR</label>
													<input type="text" class="form-control site-input" placeholder="" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" name="radiusselectionrtrr" id="radiusselectionrtrr">
												</div>
											</li>
											<li class="input-list-li">							
												<div class="form-group">
													<label class="input-label">HEADER SHAPE-RT/RR</label>
													<input type="text" class="form-control site-input" placeholder="" maxlength="30" name="headershapertrr" id="headershapertrr">
												</div>
											</li>
											<li class="input-list-li">							
												<div class="form-group">
													<label class="input-label">HEADER PERCENTAGE-RT/RR/RTD</label>
													<input type="text" class="form-control site-input" placeholder="" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" name="headerpercent" id="headerpercent">
												</div>
											</li>
											<li class="input-list-li">							
												<div class="form-group">
													<label class="input-label">HEADER HEIGHT-RT/RR</label>
													<input type="text" class="form-control site-input" placeholder="" maxlength="50" name="headerheight" id="headerheight">
												</div>
											</li>
											<?php } ?>
											<?php if($plant_id == 2002){ ?>
											<li class="input-list-li">							
												<div class="form-group">
													<label class="input-label">GATE DIA</label>
													<select class="form-control custom-select s-input-border" name="gatedia" id="gatedia">
														<option value="">Select</option>
														<option value="∅80">∅80</option>
														<option value="∅115">∅115</option>
														<option value="∅125">∅125</option>
														<option value="∅150">∅150</option>
														<option value="∅175">∅175</option>
														<option value="Elliptical">Elliptical</option>
													</select>
												</div>
											</li>
											<li class="input-list-li">							
												<div class="form-group">
													<label class="input-label">HEADER SIZE</label>
													<select class="form-control custom-select s-input-border" name="headersize" id="headersize">
														<option value="">Select</option>
														<option value="M#2 Sand Header">M#2 Sand Header</option>
														<option value="M#3 Sand Header">M#3 Sand Header</option>
														<option value="M#4 Sand Header">M#4 Sand Header</option>
														<option value="M#5 Sand Header">M#5 Sand Header</option>
														<option value="M#6 Sand Header">M#6 Sand Header</option>
														<option value="M#7 Sand Header">M#7 Sand Header</option>
														<option value="M#2 Sand Header (2Nos)">M#2 Sand Header (2Nos)</option>
														<option value="M#3 Sand Header (2Nos)">M#3 Sand Header (2Nos)</option>
														<option value="M#4 Sand Header (2Nos)">M#4 Sand Header (2Nos)</option>
														<option value="M#5 Sand Header (2Nos)">M#5 Sand Header (2Nos)</option>
														<option value="M#6 Sand Header (2Nos)">M#6 Sand Header (2Nos)</option>
													</select>
												</div>
											</li>
											<?php }else{ ?>
											<li class="input-list-li">							
												<div class="form-group">
													<label class="input-label">GATE DIA</label>
													<input type="text" class="form-control site-input" placeholder="" maxlength="50" name="gatedia" id="gatedia">
												</div>
											</li>
											<li class="input-list-li">							
												<div class="form-group">
													<label class="input-label">HEADER SIZE</label>
													<input type="text" class="form-control site-input" placeholder="" maxlength="50" name="headersize" id="headersize">
												</div>
											</li>
											<?php } ?>
											<li class="input-list-li">							
												<div class="form-group">
													<label class="input-label">POUR WEIGHT</label>
													<input type="text" class="form-control site-input" placeholder="" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" name="pourweight" id="pourweight">
												</div>
											</li>
											<?php if($plant_id == 2002){ ?>
											<li class="input-list-li">							
												<div class="form-group">
													<label class="input-label">MOLDING METHOD</label>
													<select class="form-control custom-select s-input-border" name="moldingmethod" id="moldingmethod">
														<option value="">Select</option>
														<option value="Fenotec Mould">Fenotec Mould</option>
														<option value="Furan Mould">Furan Mould</option>
														<option value="Sodium Silicate Mould">Sodium Silicate Mould</option>
													</select>
												</div>
											</li>
											<?php }else{ ?>
											<li class="input-list-li">							
												<div class="form-group">
													<label class="input-label">MOLDING METHOD</label>
													<input type="text" class="form-control site-input" placeholder="" maxlength="50" name="moldingmethod" id="moldingmethod">
												</div>
											</li>
											<?php } ?>
											<li class="input-list-li">							
												<div class="form-group">
													<label class="input-label">NO OF SIDES TO BE MACHINED</label>
													<input type="text" class="form-control site-input" placeholder="" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" name="noofsidesmachinied" id="noofsidesmachinied">
												</div>
											</li>
											<li class="input-list-li">							
												<div class="form-group">
													<label class="input-label">FINISHING PROCESS ROUTING</label>
													<input type="text" class="form-control site-input" placeholder="" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" name="finishinprocessrouting" id="finishinprocessrouting">
												</div>
											</li>
											<?php if($plant_id == 2002){ ?>
											<li class="input-list-li">							
												<div class="form-group">
													<label class="input-label">POUR QUALITY</label>
													<select class="form-control custom-select s-input-border" name="pourquality" id="pourquality">
														<option value="">Select</option>
														<option value="1681 RN">1681 RN</option>
														<option value="1681 RR">1681 RR</option>
														<option value="1681 RT">1681 RT</option>
														<option value="1681 RTD">1681 RTD</option>
														<option value="1685 RN">1685 RN</option>
														<option value="1685 RR">1685 RR</option>
														<option value="1685 RT">1685 RT</option>
														<option value="1685 RTD">1685 RTD</option>
														<option value="1711 RN">1711 RN</option>
														<option value="1711 RR">1711 RR</option>
														<option value="1711 RT">1711 RT</option>
														<option value="1711 RTD">1711 RTD</option>
														<option value="1851 RN">1851 RN</option>
														<option value="1851 RR">1851 RR</option>
														<option value="1851 RT">1851 RT</option>
														<option value="1851 RTD">1851 RTD</option>
													</select>
												</div>
											</li>
											<li class="input-list-li">							
												<div class="form-group">
													<label class="input-label">INTERNAL CHILLING</label>
													<select class="form-control custom-select s-input-border" name="internalchilling" id="internalchilling">
														<option value="">Select</option>
														<option value="No Chill">No Chill</option>
														<option value="Internal Bottom Metallic Chill">Internal Bottom Metallic Chill</option>
														<option value="Internal Major Sides Metallic Chill">Internal Major Sides Metallic Chill</option>
														<option value="Internal 4 Sides Metallic Chill">Internal 4 Sides Metallic Chill</option>
														<option value="Internal 5 Sides Metallic Chill">Internal 5 Sides Metallic Chill</option>
														<option value="Internal Metallic Chill as Shown">Internal Metallic Chill as Shown</option>
													</select>
												</div>
											</li>
											<li class="input-list-li">							
												<div class="form-group">
													<label class="input-label">EXTERNAL CHILLING</label>
													<select class="form-control custom-select s-input-border" name="externalchilling" id="externalchilling">
														<option value="">Select</option>
														<option value="No Chill">No Chill</option>
														<option value="External Bottom Metallic Chill">External Bottom Metallic Chill</option>
														<option value="External Major Sides Metallic Chill">External Major Sides Metallic Chill</option>
														<option value="External 4 Sides Metallic Chill">External 4 Sides Metallic Chill</option>
														<option value="External 5 Sides Metallic Chill">External 5 Sides Metallic Chill</option>
														<option value="External Metallic Chill as Shown">External Metallic Chill as Shown</option>
													</select>
												</div>
											</li>
											<?php }else{ ?>
											<li class="input-list-li">							
												<div class="form-group">
													<label class="input-label">POUR QUALITY</label>
													<input type="text" class="form-control site-input" placeholder="" maxlength="50" name="pourquality" id="pourquality">
												</div>
											</li>
											<li class="input-list-li">							
												<div class="form-group">
													<label class="input-label">INTERNAL CHILLING</label>
													<input type="text" class="form-control site-input" placeholder="" maxlength="200" name="internalchilling" id="internalchilling">
												</div>
											</li>
											<li class="input-list-li">							
												<div class="form-group">
													<label class="input-label">EXTERNAL CHILLING</label>
													<input type="text" class="form-control site-input" placeholder="" maxlength="200" name="externalchilling" id="externalchilling">
												</div>
											</li>
											<?php } ?>
											<li class="input-list-li">							
												<div class="form-group">
													<label class="input-label">M NUMBER</label>
													<input type="text" class="form-control site-input" placeholder="" maxlength="20" name="mno" id="mno" value="<?php echo $mno;?>">
												</div>
											</li>
											<li class="input-list-li">							
												<div class="form-group">
													<label class="input-label">ASSEMBLY NUMBER</label>
													<input type="text" class="form-control site-input" placeholder="" maxlength="200" name="assemblyno" id="assemblyno">
												</div>
											</li>
											<li class="input-list-li">							
												<div class="form-group">
													<label class="input-label">DRAWN</label>
													<input type="text" class="form-control site-input" placeholder="" maxlength="20" name="drawn" id="drawn">
												</div>
											</li>
											<li class="input-list-li">							
												<div class="form-group">
													<label class="input-label">SPECIFICATION</label>
													<input type="text" class="form-control site-input" placeholder="" maxlength="50" name="specification" id="specification">
												</div>
											</li>
										</ul>
										<?php if($plant_id == 2002){ ?>
										<input type="hidden" name="foundarynotes" value="">
										<input type="hidden" name="flaskingnotes" value="">
										<input type="hidden" name="furnacenotes" value="">
										<input type="hidden" name="finishingnotes" value="">
										<ul class="site-input-list grid-2">
											<li class="input-list-li">							
												<div class="form-group">
													<label class="input-label">FOUNDRY NOTES</label>
													<textarea class="form-control site-input textarea-input" placeholder="" rows="3" maxlength="1000" name="specialnotes" id="specialnotes"></textarea>
												</div>
											</li>
										</ul>
										<?php }else{ ?>
										<ul class="site-input-list grid-2">
											<input type="hidden" name="specialnotes" value="">
											<li class="input-list-li">							
												<div class="form-group">
													<label class="input-label">FOUNDRY NOTES</label>
													<textarea class="form-control site-input textarea-input" placeholder="" rows="3" maxlength="1000" name="foundarynotes" id="foundarynotes"></textarea>
												</div>
											</li>
											<li class="input-list-li">							
												<div class="form-group">
													<label class="input-label">FLASKING NOTES</label>
													<textarea class="form-control site-input textarea-input" placeholder="" rows="3" maxlength="1000" name="flaskingnotes" id="flaskingnotes"></textarea>
												</div>
											</li>
											<li class="input-list-li">							
												<div class="form-group">
													<label class="input-label">FURNACE NOTES</label>
													<textarea class="form-control site-input textarea-input" placeholder="" rows="3" maxlength="1000" name="furnacenotes" id="furnacenotes"></textarea>
												</div>
											</li>
											<li class="input-list-li">							
												<div class="form-group">
													<label class="input-label">FINISHING NOTES</label>
													<textarea class="form-control site-input textarea-input" placeholder="" rows="3" maxlength="1000" name="finishingnotes" id="finishingnotes"></textarea>
												</div>
											</li>
										</ul>
										<?php } ?>
										
										<?php } ?>
										<div class="site-btn-div mt-4 pb-4 pt-2 text-center">
											<button type="submit" class="site-btn px-5 f-18">Proceed</button>
										</div>
										<input type="hidden" name="row_id" value="<?php echo $row_id;?>">
										<input type="hidden" name="plant_id" value="<?php echo $plant_id;?>">
										<input type="hidden" name="drawing_status" value="<?php echo $sentinal_data[0]->drawing_status;?>">
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
		<!-- Modal -->
		<div class="modal fade" id="design-message" tabindex="-1" aria-labelledby="prevSubmitModalLabel" aria-hidden="true">
		  	<div class="modal-dialog modal-dialog-centered">
		    	<div class="modal-content">
		      		<div class="modal-header">
		        		<p class="modal-title f-16 mx-auto" id="prevSubmitModalLabel">Drawing Creation is Pending</p>
		      		</div>
		  		</div>
			</div>
		</div>
		<div class="modal fade" id="mno-allocation-message" tabindex="-1" data-keyword="false" data-backdrop="static">
		  	<div class="modal-dialog modal-dialog-centered">
		    	<div class="modal-content">
		      		<div class="modal-header">
		        		<p class="modal-title f-16 mx-auto" id="prevSubmitModalLabel">Mno allocation is not created for combination <?php echo $sentinal_data[0]->customername.' AND '.$sentinal_data[0]->oano;?>, Please create and refresh the page.</p>
		      		</div>
		  		</div>
			</div>
		</div>
		<?php $this->load->view('bloc/footer'); ?>
		<script>
			$(document).ready(function(){
				<?php if($mno == ""){ ?>
				$("#mno-allocation-message").modal('show');
				<?php } ?>

				<?php if(!empty($process_parameter)){ ?>
				$("#mno").val('<?php echo $process_parameter[0]->mno;?>');	
				$("#madeqty").val('<?php echo $process_parameter[0]->madeqty;?>');
				$("#excessqty").val('<?php echo $process_parameter[0]->excessqty;?>');
				$("#noofpatterns").val('<?php echo $process_parameter[0]->noofpatterns;?>');
				$("#pieceormold").val('<?php echo $process_parameter[0]->pieceormold;?>');
				$("#volume").val('<?php echo $process_parameter[0]->volume;?>');
				$("#nominlweight").val('<?php echo $process_parameter[0]->nominlweight;?>');
				$("#headertype").val('<?php echo $process_parameter[0]->headertype;?>');
				$("#stockheight").val('<?php echo $process_parameter[0]->stockheight;?>');
				$("#stockvolume").val('<?php echo $process_parameter[0]->stockvolume;?>');
				$("#radiusselectionrtrr").val('<?php echo $process_parameter[0]->radiusselectionrtrr;?>');
				$("#headershapertrr").val('<?php echo $process_parameter[0]->headershapertrr;?>');
				$("#headerpercent").val('<?php echo $process_parameter[0]->headerpercent;?>');
				$("#headerheight").val('<?php echo $process_parameter[0]->headerheight;?>');
				$("#gatedia").val('<?php echo $process_parameter[0]->gatedia;?>');
				$("#headersize").val('<?php echo $process_parameter[0]->headersize;?>');
				$("#pourweight").val('<?php echo $process_parameter[0]->pourweight;?>');
				$("#moldingmethod").val('<?php echo $process_parameter[0]->moldingmethod;?>');
				$("#noofsidesmachinied").val('<?php echo $process_parameter[0]->noofsidesmachinied;?>');
				$("#finishinprocessrouting").val('<?php echo $process_parameter[0]->finishinprocessrouting;?>');
				$("#pourquality").val('<?php echo $process_parameter[0]->pourquality;?>');
				$("#internalchilling").val('<?php echo $process_parameter[0]->internalchilling;?>');
				$("#externalchilling").val('<?php echo $process_parameter[0]->externalchilling;?>');
				$("#assemblyno").val('<?php echo $process_parameter[0]->assemblyno;?>');
				$("#drawn").val('<?php echo $process_parameter[0]->drawn;?>');
				$("#specification").val('<?php echo $process_parameter[0]->specification;?>');
				$("#foundarynotes").text('<?php echo $process_parameter[0]->foundarynotes;?>');
				$("#flaskingnotes").text('<?php echo $process_parameter[0]->flaskingnotes;?>');
				$("#furnacenotes").text('<?php echo $process_parameter[0]->furnacenotes;?>');
				$("#finishingnotes").text('<?php echo $process_parameter[0]->finishingnotes;?>');
				$("#specialnotes").text('<?php echo $process_parameter[0]->specialnotes;?>');
				<?php } ?>

				$('.tab-box-btn').on('click' , function(){
					var getIdBtn = $(this).attr('id');

					if(getIdBtn == 'tab_btn_3'){
						$('#design-message').modal('show');
					}else{
						$('.tab-box-btn').removeClass('active');
						$(this).addClass('active');
						
						var submitId = '#' + getIdBtn + '_box';
						$('.s-tab-box').removeClass('active');
						$(submitId).addClass('active');
					}
				});

				$('.form-check-input').on('change' , function(){
					if($(this).value = 1) {
						$('.form-check-btn').toggleClass('disabled-btn');
					}
				});

				<?php if(!empty($job)){ if($job[0]->jobstatus == "TRUE"){?>
				var path = "<?php echo design_url(date('Y').'/'.$sentinal_data[0]->customername.'/'.$sentinal_data[0]->oano.'/'.$sentinal_data[0]->module.'/'.$process_parameter[0]->mno.'/');?>";
				var links = [
				   '<?php echo $process_parameter[0]->mno.'.dwg';?>',
				   '<?php echo $process_parameter[0]->mno.'.pdf';?>',
				   '<?php echo $process_parameter[0]->mno.'3D.dwg';?>'
				];

				function downloadAll(urls) {
				   var link = document.createElement('a');

				   link.style.display = 'none';

				   document.body.appendChild(link);

				   for (var i = 0; i < urls.length; i++) {
				   	  link.setAttribute('download', urls[i]);
				      link.setAttribute('href', path+urls[i]);
				      link.click();
				   }

				   document.body.removeChild(link);
				}

				$('#download-all').on('click' , function(){
					downloadAll(links);
				});
				<?php }else{ ?>
				setTimeout(function () { location.reload(true);}, 5000);
				<?php }} ?>
			});
		</script>
	</body>
</html>