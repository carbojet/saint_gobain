<!DOCTYPE html>
<html>
	<head lang="fr">
		<title>Drawing List</title>
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
		<link rel="stylesheet" type="text/css" href="<?php echo css_url('plugins/dataTables.bootstrap4.min');?>">
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
									<h2 class="site-title">Drawing List</h2>
								</div>
								<ul class="site-input-list w-75 mx-auto grid-3 clearfix pt-3">
									<li class="input-list-li">							
										<div class="form-group">
											<label class="input-label">Customer name</label>
											<input type="text" class="form-control site-input" id="customername" placeholder="">
										</div>
									</li>
									<li class="input-list-li">							
										<div class="form-group">
											<label class="input-label">OA No.</label>
											<input type="text" class="form-control site-input" id="oano" placeholder="">
										</div>
									</li>
									<li class="input-list-li">							
										<div class="form-group">
											<label class="input-label">MODULE</label>
											<input type="text" class="form-control site-input" id="module" placeholder="">
										</div>
									</li>
								</ul>
								<div class="site-btn-div pt-2 text-center">
									<button type="button" class="site-btn px-5 f-18" id="search-drawing">Search</button>
								</div>
								<div class="page-datatable table-responsive my-4">
									<table class="table table-striped table-bordered table-hover site-dataTables-table" id="new-drawings">
										<thead>
										  <tr>
										      <th>Customer name</th>
										      <th>OA no</th>
										      <th>Module</th>
										      <th>Item No</th>
										      <th>Category</th>
										      <th>Shape</th>
										      <th>Size</th>
										      <th>Action</th>
										  </tr>
										</thead>
										<tbody>
										  
										</tbody>
									</table>
						        </div>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
		<?php $this->load->view('bloc/footer'); ?>
		<script src="<?php echo js_url('plugins/datatables.min');?>"></script>
		<script src="<?php echo js_url('plugins/dataTables.bootstrap4.min');?>"></script>
		<script>
			$(document).ready(function(){
				var oTable1 = $('#new-drawings').dataTable({
		       		"iDisplayLength": 25,
		       		"bFilter": false,
		       		"bServerSide": true,
		        	"bAutoWidth": false,                    
		        	"bScrollCollapse": true,
		        	"oSearch": {"sSearch": ''},
		        	"aaSorting" : [[ 0, "DESC" ]],
		        	"sAjaxSource": "<?php echo site_url('sentinal/load_drawing_data');?>",
				    "fnServerData": function ( sSource, aoData, fnCallback ) {
						var customername  = $('#customername').val();
						var oano = $('#oano').val();
						var modulename 	 = $('#module').val();

						aoData.push(
							{"name": "customername", "value":customername},
							{"name": "oano", "value":oano},
							{"name": "module", "value":modulename}
						);

						$.ajax({
							"dataType": 'json', 
							"type": "POST", 
							"url": sSource, 
							"data": aoData, 
							"success": fnCallback
						});
					},
					"fnInitComplete": function(oSettings, json) {

					} ,
					"fnRowCallback": function( nRow, aData, iDisplayIndex ) {
					  
					},
					fnDrawCallback:function(){
						
					},
					"fnInfoCallback": function( oSettings, iStart, iEnd, iMax, iTotal, sPre ) {
						if(iTotal == 0) {
							return sPre; 
						}
						if(iTotal == 1) {
							return sPre.replace('entrées', 'entrée');
						}
						if(iTotal > 1) { 
							return sPre; 
						}
				  	}   
				});

				$( document ).on( "click", "#search-drawing", function() {
					var oTable1 = $('#new-drawings').dataTable();
					oTable1.fnDraw();
				});
			});
		</script>
	</body>
</html>