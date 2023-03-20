<?php

defined('BASEPATH') OR exit('No direct script access allowed');
include(dirname(__file__)."/Main.php");
class Sentinal extends CC_Main {
	
	public function __construct() {

        parent::__construct();
    }

    function load_drawing_list_page(){
    	$data['page_id'] = 0;

    	$this->load->view('drawing-list', $data);
    }

    function load_drawing_data(){
    	$iDisplayStart  = $_POST['iDisplayStart'];
        $iDisplayLength = $_POST['iDisplayLength'];

        $where = "";

        if($_POST['customername'] != ''){
        	$where .= "mimic.customername = '".$_POST['customername']."'";
        }

        if($_POST['oano'] != ''){
        	$where .= "mimic.oano = '".$_POST['oano']."'";
        }

        if($_POST['module'] != ''){
        	$where .= "mimic.module = '".$_POST['module']."'";
        }

        $table = 'mimic';
        
        if(isset($_POST['iSortCol_0'])){
            $iSortCol = $_POST['iSortCol_0'];
            $sSortDir = $_POST['sSortDir_0'];
            
            if($iSortCol == 0){
                $order_by = 'mimic.customername';
            }else if($iSortCol == 1){
                $order_by = 'mimic.oano';                              
            }else if($iSortCol == 2){
                $order_by = 'mimic.module';                              
            }else if($iSortCol == 3){
                $order_by = 'mimic.itemno';                              
            }else if($iSortCol == 4){
                $order_by = 'miscinput.category';                              
            }else if($iSortCol == 5){
                $order_by = 'miscinput.shape';                              
            }else if($iSortCol == 6){
                $order_by = 'miscinput.size';                              
            }
        }
        
        $all_drawing = $this->main_model->fetch_all_data_with_condition($where, $table, $iDisplayStart, $iDisplayLength, $order_by, $sSortDir);
        
        $output = array(
            "sEcho" => intval($_POST['sEcho']),
            "iTotalRecords" => count($all_drawing['result']),
            "iTotalDisplayRecords" => $all_drawing['total_rows'],
            "aaData" => array()
        );
        
        if(count($all_drawing['result']) > 0){
            foreach ($all_drawing['result'] as $details){
                
                $row = array();
                
                $row[] = $details['customername'];
                $row[] = $details['oano'];
                $row[] = $details['module'];
                $row[] = $details['itemno'];
                $row[] = $details['category'];
                $row[] = $details['shape'];
                $row[] = $details['size'];

                $url = base_url('/sentinal/'.strtolower($details['shape']).'/step-one.html?sgid='.$details['unique_id'].'&line_no='.$details['unique_id'].'&plant_id='.$details['plant_id']);
                $row[] = '<a class="cursor-pointer d-gray-text mr-1" title="Edit" href="'.$url.'" target="_blank"><i class="bi bi-pencil-square f-20"></i></a>';
                
                $row['DT_RowId'] = $details["unique_id"];
                $output['aaData'][] = $row;
            }
        }
        echo json_encode( $output );
    }

	function load_sentinal_data_page($shape){

		//row_id change to line_no
		if (isset($_GET['line_no']) && isset($_GET['plant_id']) && isset($_GET['sgid']) ){

			$data['row_id'] = $_GET['line_no'];
			$data['plant_id'] = $_GET['plant_id'];
			$data['sgid'] = $_GET['sgid'];
			$data['shape'] = $shape;

			$userResult = $this->get_user_verification($data);
			
			$data['module_master'] = $this->main_model->get_all_from_table('Module_Master', "plant_id = '".$data['plant_id']."'");
			$data['quality_master'] = $this->main_model->get_all_from_table('Quality_Master', "");
			
			if(isset($_GET['is_edit'])){
				$data['is_edit'] = $_GET['is_edit'];
				$sentinal_data = $this->main_model->get_all_from_table('sentineldata',  "unique_id = '".$data['row_id']."'");
				$data['sentinal_data'] = array('customer_name' => $sentinal_data[0]->customername,
												'item_number' => $sentinal_data[0]->itemno,
												'oa_num' => $sentinal_data[0]->oano,
												'module' => $sentinal_data[0]->module,
												'category' => $sentinal_data[0]->category,
												'quality' => $sentinal_data[0]->orderquality,
												'shape' => $sentinal_data[0]->shape,
												'size' => $sentinal_data[0]->size,
												'matl_desc' => $sentinal_data[0]->materialdesc,
												'order_qty' => $sentinal_data[0]->orderqty,
												'castingtype' => $sentinal_data[0]->castingtype,
												'sale_line_no' => $sentinal_data[0]->sale_line_no);

			}else{
				if (isset($_GET['plant_id'])){
					$this->db = $this->load->database('plant_'.$_GET['plant_id'], TRUE);
				}else if(isset($_POST['plant_id'])){
					$this->db = $this->load->database('plant_'.$_POST['plant_id'], TRUE);
				}

				$sentinal_data = $this->main_model->get_all_from_table('sale_order_details', 'row_id ='.$data['row_id']);

				$data['sentinal_data'] = array('customer_name' => $sentinal_data[0]->customer_name,
												'item_number' => $sentinal_data[0]->item_number,
												'oa_num' => $sentinal_data[0]->oa_num,
												'module' => $sentinal_data[0]->module,
												'category' => $sentinal_data[0]->category,
												'quality' => $sentinal_data[0]->quality,
												'shape' => strtoupper($shape),
												'size' => $sentinal_data[0]->size,
												'matl_desc' => $sentinal_data[0]->matl_desc,
												'order_qty' => $sentinal_data[0]->order_qty,
												'castingtype' => $sentinal_data[0]->type,
												'sale_line_no' => $sentinal_data[0]->sale_line_no);
			}

			$this->load->view('step-one', $data);
		}
	}

	function save_sentinal_data(){
		$row_id = $_POST['row_id'];
		$plant_id = $_POST['plant_id'];

		if($_POST['shape'] == "RECTANGLE"){
			$size = $_POST['size'];
		}else{
			$size = '0 x 0 x 0';
		}

		$validate = $this->main_model->get_all_from_table('sentineldata', "unique_id = '".$row_id."'");
		
		if(empty($validate)){
			$insert_sentinal_data = array('unique_id' => $row_id,
								  'customername' => $_POST['customer_name'],	
								  'itemno' => $_POST['item_number'],
								  'oano' => $_POST['oa_num'],
								  'module' => $_POST['module'],
								  'category' => $_POST['category'],
								  'orderquality' => $_POST['quality'],
								  'shape' => $_POST['shape'],
								  'size' => $size,
								  'materialdesc' => $_POST['matl_desc'],
								  'orderqty' => $_POST['order_qty'],
								  'mold_type' => '',
								  'drawing_type' => '',
								  'castingtype' => $_POST['castingtype'],
								  'productname' => '',
								  'sub_category' => '',
								  'drawing_status' => '',
								  'plant_id' => $plant_id,
								  'sale_line_no' => $_POST['sale_line_no']);

			$this->main_model->add_data('sentineldata', $insert_sentinal_data);
		}else{
			$update_sentinal_data = array('customername' => $_POST['customer_name'],	
								  'itemno' => $_POST['item_number'],
								  'oano' => $_POST['oa_num'],
								  'module' => $_POST['module'],
								  'category' => $_POST['category'],
								  'orderquality' => $_POST['quality'],
								  'shape' => $_POST['shape'],
								  'size' => $size,
								  'materialdesc' => $_POST['matl_desc'],
								  'orderqty' => $_POST['order_qty'],
								  'sale_line_no' => $_POST['sale_line_no']);

			$this->main_model->update_table('sentineldata', $update_sentinal_data, 'unique_id', $row_id);
		}

		header("Location: ".base_url('sentinal/'.$_POST['url_prefix'].'/step-two.html?row_id='.$row_id.'&plant_id=').$plant_id."");
	}

	function load_rectangle_shape_and_dimension_page(){
		if (isset($_GET['row_id']) && isset($_GET['plant_id'])){
			$data['row_id'] = $_GET['row_id'];
			$data['plant_id'] = $_GET['plant_id'];
			$data['shape'] = 'rectangle';

			$data['sentinal_data'] = $this->main_model->get_all_from_table('sentineldata', "unique_id = '".$data['row_id']."'");

			if(isset($_GET['is_edit'])){
				$diminput = $this->main_model->get_all_from_table_by_order('diminput', "unique_id = '".$data['row_id']."'", 'parameter', 'ASC');
				foreach($diminput as $dim){
					$data['dimension_entry'][] = array('dimenstion' => $dim->paravalue,
														'allowance' => $dim->machining);
				}
			}else{
				$size = explode(" x ", $data['sentinal_data'][0]->size);
				foreach($size as $s){
					$data['dimension_entry'][] = array('dimenstion' => $s,
														'allowance' => 0);
				}
			}

			$this->load->view('rect-step-two', $data);
		}
	}

	function save_rectangle_shape_and_dimension_data(){
		$row_id = $_POST['row_id'];
		$plant_id = $_POST['plant_id'];
		$shape = $_POST['shape'];
		$module = $_POST['module'];
		$materialdesc = $_POST['materialdesc'];

		$size = '';

		$this->main_model->delete_table('diminput', 'unique_id', $row_id);

		if($_POST['drawing_type'] == 'CHILD'){
			foreach($_POST['dimension'] as $key => $value){
				$parameter = $_POST['parameter'][$key];

				$insert_data = array('unique_id' => $row_id,
									  'shape' => 'RECTANGLE',
									  'materialdesc' => $materialdesc,
									  'subcategory' => 'NA',
									  'parameter' => $parameter,
									  'paravalue' => $value,
									  'machining' => '0');

				$this->main_model->add_data('diminput', $insert_data);

				$size .= $value.' x ';
			}
		}else{
			foreach($_POST['dimension'] as $key => $value){
				$parameter = $_POST['parameter'][$key];
				$machining = $_POST['allowance'][$key];

				$insert_data = array('unique_id' => $row_id,
									  'shape' => 'RECTANGLE',
									  'materialdesc' => $materialdesc,
									  'subcategory' => 'NA',
									  'parameter' => $parameter,
									  'paravalue' => $value,
									  'machining' => $machining);

				$this->main_model->add_data('diminput', $insert_data);

				$size .= $value.' x ';
			}
		}

		

		$size = rtrim($size, ' x ');
		$update_sentinal_data = array('size' => $size,
								  'mold_type' => $_POST['mold_type'],	
								  'drawing_type' => $_POST['drawing_type']);
		
		$this->main_model->update_table('sentineldata', $update_sentinal_data, 'unique_id', $row_id);

		header("Location: ".base_url('sentinal/rectangle/step-three.html?row_id='.$row_id.'&plant_id=').$plant_id."");
	}

	function load_rectangle_process_parameter_page(){
		if (isset($_GET['row_id']) && isset($_GET['plant_id'])){
			$data['row_id'] = $_GET['row_id'];
			$data['plant_id'] = $_GET['plant_id'];
			$data['shape'] = 'rectangle';

			$data['sentinal_data'] = $this->main_model->get_all_from_table('sentineldata', "unique_id = '".$data['row_id']."'");
			$data['process_parameter'] = $this->main_model->get_all_from_table('miscinput', "unique_id = '".$data['row_id']."'");
			if(empty($data['process_parameter'])){
				$mno_allocation = $this->main_model->get_all_from_table('serp_m_number_allocation', "customername = '".$data['sentinal_data'][0]->customername."' AND oano = '".$data['sentinal_data'][0]->oano."'");
				if(empty($mno_allocation)){
					$data['mno'] = '';
				}else{
					$data['mno'] = $this->get_mno_from_allocation($mno_allocation[0]->start_quantity, $mno_allocation[0]->end_quantity, $data['sentinal_data'][0]->customername, $data['sentinal_data'][0]->oano);
				}
			}else{
				$data['mno'] = $data['process_parameter'][0]->mno;
			}

			$data['job'] = $this->main_model->get_all_from_table('projectjobschedule', "unique_id = '".$data['row_id']."'");

			$this->load->view('rect-step-three', $data);
		}
	}

	function get_mno_from_allocation($start, $end, $customername, $oano){
		$mno = rand($start, $end+1);

		$where = "sentineldata.customername = '".$customername."' AND sentineldata.oano = '".$oano."' AND miscinput.mno = '".$mno."'";
		$validate = $this->main_model->get_sentinal_data_by_condition('sentineldata', $where);
		if(empty($validate)){
			return $mno;
		}else{
			$this->get_mno_from_allocation($start, $end, $customername, $oano);
		}
	}

	function save_rectangle_process_paremeter_data(){
		$row_id = $_POST['row_id'];
		$plant_id = $_POST['plant_id'];
		$drawing_status = $_POST['drawing_status'];

		$validate = $this->main_model->get_all_from_table('miscinput', "unique_id = '".$row_id."'");

		if(empty($validate)){
			if($drawing_status == '' || $drawing_status == 'pending'){
				$insert_data = array('unique_id' => $row_id,
								  'mno' => $_POST['mno'],	
								  'madeqty' => $_POST['madeqty'],
								  'excessqty' => '',
								  'noofpatterns' => '',
								  'pieceormold' => '',
								  'volume' => '',
								  'nominlweight' => '',
								  'headertype' => '',
								  'stockheight' => '',
								  'stockvolume' => '',
								  'radiusselectionrtrr' => '',
								  'headershapertrr' => '',
								  'headerpercent' => '',
								  'headerheight' => '',
								  'gatedia' => '',
								  'headersize' => '',
								  'pourweight' => '',
								  'moldingmethod' => '',
								  'noofsidesmachinied' => '',
								  'finishinprocessrouting' => '',
								  'pourquality' => '',
								  'internalchilling' => '',
								  'externalchilling' => '',
								  'assemblyno' => $_POST['assemblyno'],
								  'drawn' => $_POST['drawn'],
								  'specification' => $_POST['specification'],
								  'foundarynotes' => '',
								  'flaskingnotes' => '',
								  'furnacenotes' => '',
								  'finishingnotes' => '',
								  'specialnotes' => '');
			}else{
				$insert_data = array('unique_id' => $row_id,
					  'mno' => $_POST['mno'],	
					  'madeqty' => $_POST['madeqty'],
					  'excessqty' => $_POST['excessqty'],
					  'noofpatterns' => $_POST['noofpatterns'],
					  'pieceormold' => $_POST['pieceormold'],
					  'volume' => $_POST['volume'],
					  'nominlweight' => $_POST['nominlweight'],
					  'headertype' => $_POST['headertype'],
					  'stockheight' => $_POST['stockheight'],
					  'stockvolume' => $_POST['stockvolume'],
					  'radiusselectionrtrr' => $_POST['radiusselectionrtrr'],
					  'headershapertrr' => $_POST['headershapertrr'],
					  'headerpercent' => $_POST['headerpercent'],
					  'headerheight' => $_POST['headerheight'],
					  'gatedia' => $_POST['gatedia'],
					  'headersize' => $_POST['headersize'],
					  'pourweight' => $_POST['pourweight'],
					  'moldingmethod' => $_POST['moldingmethod'],
					  'noofsidesmachinied' => $_POST['noofsidesmachinied'],
					  'finishinprocessrouting' => $_POST['finishinprocessrouting'],
					  'pourquality' => $_POST['pourquality'],
					  'internalchilling' => $_POST['internalchilling'],
					  'externalchilling' => $_POST['externalchilling'],
					  'assemblyno' => $_POST['assemblyno'],
					  'drawn' => $_POST['drawn'],
					  'specification' => $_POST['specification'],
					  'foundarynotes' => $_POST['foundarynotes'],
					  'flaskingnotes' => $_POST['flaskingnotes'],
					  'furnacenotes' => $_POST['furnacenotes'],
					  'finishingnotes' => $_POST['finishingnotes'],
					  'specialnotes' => $_POST['specialnotes']);
			}

			$this->main_model->add_data('miscinput', $insert_data);
		}else{
			if($drawing_status == '' || $drawing_status == 'pending'){
				$update_data = array('mno' => $_POST['mno'],	
								  'madeqty' => $_POST['madeqty'],
								  'assemblyno' => $_POST['assemblyno'],
								  'drawn' => $_POST['drawn'],
								  'specification' => $_POST['specification']);
			}else{
				$update_data = array('mno' => $_POST['mno'],	
								  'madeqty' => $_POST['madeqty'],
								  'excessqty' => $_POST['excessqty'],
								  'noofpatterns' => $_POST['noofpatterns'],
								  'pieceormold' => $_POST['pieceormold'],
								  'volume' => $_POST['volume'],
								  'nominlweight' => $_POST['nominlweight'],
								  'headertype' => $_POST['headertype'],
								  'stockheight' => $_POST['stockheight'],
								  'stockvolume' => $_POST['stockvolume'],
								  'radiusselectionrtrr' => $_POST['radiusselectionrtrr'],
								  'headershapertrr' => $_POST['headershapertrr'],
								  'headerpercent' => $_POST['headerpercent'],
								  'headerheight' => $_POST['headerheight'],
								  'gatedia' => $_POST['gatedia'],
								  'headersize' => $_POST['headersize'],
								  'pourweight' => $_POST['pourweight'],
								  'moldingmethod' => $_POST['moldingmethod'],
								  'noofsidesmachinied' => $_POST['noofsidesmachinied'],
								  'finishinprocessrouting' => $_POST['finishinprocessrouting'],
								  'pourquality' => $_POST['pourquality'],
								  'internalchilling' => $_POST['internalchilling'],
								  'externalchilling' => $_POST['externalchilling'],
								  'assemblyno' => $_POST['assemblyno'],
								  'drawn' => $_POST['drawn'],
								  'specification' => $_POST['specification'],
								  'foundarynotes' => $_POST['foundarynotes'],
								  'flaskingnotes' => $_POST['flaskingnotes'],
								  'furnacenotes' => $_POST['furnacenotes'],
								  'finishingnotes' => $_POST['finishingnotes']);
			}

			$this->main_model->update_table('miscinput', $update_data, 'unique_id', $row_id);
		}

		$update_drawing = array('drawing_status' => 'pending');
		$this->main_model->update_table('sentineldata', $update_drawing, 'unique_id', $row_id);

		$validate_job = $this->main_model->get_all_from_table('projectjobschedule', "unique_id = '".$row_id."'");

		if(empty($validate_job)){
			$insert_data = array('unique_id' => $row_id,
								  'projectno' => $_POST['mno'],	
								  'runonserver' => 'TRUE',
								  'jobstatus' => 'FALSE',
								  'plant_id' => $plant_id,
								  'job_type' => 'sentinal-drawing');

			$this->main_model->add_data('projectjobschedule', $insert_data);
		}else{
			$update_data = array('projectno' => $_POST['mno'],
								  'runonserver' => 'TRUE',
								  'jobstatus' => 'FALSE');

			$this->main_model->update_table('projectjobschedule', $update_data, 'unique_id', $row_id);
		}

		header("Location: ".base_url('sentinal/rectangle/step-three.html?row_id='.$row_id.'&plant_id=').$plant_id."");
	}

	function load_shape_and_selection_page(){

		if (isset($_GET['row_id']) && isset($_GET['plant_id'])){
			$data['row_id'] = $_GET['row_id'];
			$data['plant_id'] = $_GET['plant_id'];
			$data['shape'] = 'shape';
			$data['sentinal_data'] = $this->main_model->get_all_from_table('sentineldata', "unique_id = '".$data['row_id']."'");
			
			$data['shape_available'] = $this->main_model->get_all_shape_available('modelmaster', "plant_id = '".$data['plant_id']."' AND module = '".$data['sentinal_data'][0]->module."' AND castingtype = '".$data['sentinal_data'][0]->castingtype."'");

			if (isset($_GET['is_edit'])){
				if($data['sentinal_data'][0]->productname != ''){
					$data['is_edit'] = 1;
					$data['sub_category_available'] = $this->main_model->get_all_shape_sub_category_available('modelmaster', "plant_id = '".$data['plant_id']."' AND module = '".$data['sentinal_data'][0]->module."' AND castingtype = '".$data['sentinal_data'][0]->castingtype."' AND productname = '".$data['sentinal_data'][0]->productname."'");
				}
			}
			
			$this->load->view('shape-step-two', $data);
		}
	}

	function get_sub_category_by_shape(){
		$shape = $_POST['shape'];
		$plant_id = $_POST['plant_id'];
		$module_name = $_POST['module_name'];
		$castingtype = $_POST['castingtype'];

		$data['sub_category_available'] = $this->main_model->get_all_shape_sub_category_available('modelmaster', "plant_id = '".$plant_id."' AND module = '".$module_name."' AND castingtype = '".$castingtype."' AND productname = '".$shape."'");
		echo json_encode($data);
	}

	function save_shape_and_sub_category_data(){
		$row_id = $_POST['row_id'];
		$plant_id = $_POST['plant_id'];

		$update_sentinal_data = array('productname' => $_POST['productname'],
								  'sub_category' => $_POST['sub_category'],
								  'mold_type' => $_POST['mold_type'],	
								  'drawing_type' => $_POST['drawing_type']);
		
		$this->main_model->update_table('sentineldata', $update_sentinal_data, 'unique_id', $row_id);

		header("Location: ".base_url('sentinal/shape/step-three.html?row_id='.$row_id.'&plant_id=').$plant_id."");
	}

	function load_shape_dimension_page(){
		if (isset($_GET['row_id']) && isset($_GET['plant_id'])){
			$data['row_id'] = $_GET['row_id'];
			$data['plant_id'] = $_GET['plant_id'];

			$data['sentinal_data'] = $this->main_model->get_all_from_table('sentineldata', "unique_id = '".$data['row_id']."'");
			
			if(isset($_GET['is_edit'])){
				$parameter_master = $this->main_model->get_all_from_table('diminput', "unique_id = '".$data['row_id']."'");
			}else{
				$parameter_master = $this->main_model->get_all_from_table_by_order('ParameterMaster', "plant_id = '".$data['plant_id']."' AND productname = '".$data['sentinal_data'][0]->productname."' AND sub_category = '".$data['sentinal_data'][0]->sub_category."'", 'parameter', 'ASC');
			}

			$parameter_master = json_decode(json_encode($parameter_master), true);
			$data['parameter_master'] = array_chunk($parameter_master, 10);

			if($data['sentinal_data'][0]->drawing_type == "PARENT"){
				$data['input_image'] = img_url('shape/input-images/'.$data['plant_id'].'/'.$data['sentinal_data'][0]->productname.'/SEPR-P-'.$data['sentinal_data'][0]->sub_category.'.jpg');
			}else{
				$data['input_image'] = img_url('shape/input-images/'.$data['plant_id'].'/'.$data['sentinal_data'][0]->productname.'/SEPR-C-'.$data['sentinal_data'][0]->sub_category.'.jpg');
			}

			$this->load->view('shape-step-three', $data);
		}
	}

	function load_shape_process_parameter_page(){
		if (isset($_GET['row_id']) && isset($_GET['plant_id'])){
			$data['row_id'] = $_GET['row_id'];
			$data['plant_id'] = $_GET['plant_id'];
			$data['shape'] = 'rectangle';

			$data['sentinal_data'] = $this->main_model->get_all_from_table('sentineldata', "unique_id = '".$data['row_id']."'");
			$data['process_parameter'] = $this->main_model->get_all_from_table('miscinput', "unique_id = '".$data['row_id']."'");
			if(empty($data['process_parameter'])){
				$mno_allocation = $this->main_model->get_all_from_table('serp_m_number_allocation', "customername = '".$data['sentinal_data'][0]->customername."' AND oano = '".$data['sentinal_data'][0]->oano."'");
				if(empty($mno_allocation)){
					$data['mno'] = '';
				}else{
					$data['mno'] = $this->get_mno_from_allocation($mno_allocation[0]->start_quantity, $mno_allocation[0]->end_quantity, $data['sentinal_data'][0]->customername, $data['sentinal_data'][0]->oano);
				}
			}else{
				$data['mno'] = $data['process_parameter'][0]->mno;
			}

			$data['job'] = $this->main_model->get_all_from_table('projectjobschedule', "unique_id = '".$data['row_id']."'");

			if (isset($_GET['plant_id'])){
				$this->db = $this->load->database('plant_'.$_GET['plant_id'], TRUE);
			}else if(isset($_POST['plant_id'])){
				$this->db = $this->load->database('plant_'.$_POST['plant_id'], TRUE);
			}
			$data['salesOrder'] = $salesOrder = $this->main_model->get_all_from_table('sale_order_details', "row_id = '".$data['row_id']."'");
			$data['sales_order_module'] = $this->main_model->get_distinct_module_from_sales_order('sale_order_details', "oa_num = '".$salesOrder[0]->oa_num."' AND sale_ord_no = '".$salesOrder[0]->sale_ord_no."' AND row_id != '".$data['row_id']."'");
			$data['line_item'] = $this->main_model->get_all_from_table('sale_order_details',"oa_num = '".$salesOrder[0]->oa_num."' AND sale_ord_no = '".$salesOrder[0]->sale_ord_no."' AND row_id != '".$data['row_id']."'");

			$this->load->view('shape-step-four', $data);
		}
	}

	function get_line_item_by_condition(){
		$module = $_POST['order_module'];
		if($module == ''){
			$where = "oa_num = '".$_POST['oa_num']."' AND sale_ord_no = '".$_POST['sale_ord_no']."' AND row_id != '".$_POST['row_id']."'";
		}else{
			$where = "oa_num = '".$_POST['oa_num']."' AND sale_ord_no = '".$_POST['sale_ord_no']."' AND row_id != '".$_POST['row_id']."' AND module = '".$module."'";
		}

		if (isset($_GET['plant_id'])){
			$this->db = $this->load->database('plant_'.$_GET['plant_id'], TRUE);
		}else if(isset($_POST['plant_id'])){
			$this->db = $this->load->database('plant_'.$_POST['plant_id'], TRUE);
		}

		$line_item = $this->main_model->get_all_from_table('sale_order_details', $where);
		echo json_encode($line_item);
	}

	function save_shape_and_dimension_data(){
		$row_id = $_POST['row_id'];
		$plant_id = $_POST['plant_id'];
		$shape = $_POST['shape'];
		$module = $_POST['module'];
		$materialdesc = $_POST['materialdesc'];

		$this->main_model->delete_table('diminput', 'unique_id', $row_id);

		if($_POST['drawing_type'] == 'CHILD'){
			foreach($_POST['dimension'] as $key => $value){
				$parameter = $_POST['parameter'][$key];

				$insert_data = array('unique_id' => $row_id,
									  'shape' => $_POST['productname'],
									  'materialdesc' => $materialdesc,
									  'subcategory' => 'NA',
									  'parameter' => $parameter,
									  'paravalue' => $value,
									  'machining' => '0');

				$this->main_model->add_data('diminput', $insert_data);
			}
		}else{
			foreach($_POST['dimension'] as $key => $value){
				$parameter = $_POST['parameter'][$key];
				$machining = $_POST['allowance'][$key];

				$insert_data = array('unique_id' => $row_id,
									  'shape' => $_POST['productname'],
									  'materialdesc' => $materialdesc,
									  'subcategory' => 'NA',
									  'parameter' => $parameter,
									  'paravalue' => $value,
									  'machining' => $machining);

				$this->main_model->add_data('diminput', $insert_data);
			}
		}

		$update_sentinal_data = array('mold_type' => $_POST['mold_type'],	
								  'drawing_type' => $_POST['drawing_type']);
		
		$this->main_model->update_table('sentineldata', $update_sentinal_data, 'unique_id', $row_id);

		header("Location: ".base_url('sentinal/shape/step-four.html?row_id='.$row_id.'&plant_id=').$plant_id."");
	}

	function save_shape_process_paremeter_data(){
		$row_id = $_POST['row_id'];
		$plant_id = $_POST['plant_id'];
		$drawing_status = $_POST['drawing_status'];
		
		$validate = $this->main_model->get_all_from_table('miscinput', "unique_id = '".$row_id."'");

		if(empty($validate)){
			if($drawing_status == '' || $drawing_status == 'pending'){
				$insert_data = array('unique_id' => $row_id,
								  'mno' => $_POST['mno'],	
								  'madeqty' => $_POST['madeqty'],
								  'excessqty' => '',
								  'noofpatterns' => '',
								  'pieceormold' => '',
								  'volume' => '',
								  'nominlweight' => '',
								  'headertype' => '',
								  'stockheight' => '',
								  'stockvolume' => '',
								  'radiusselectionrtrr' => '',
								  'headershapertrr' => '',
								  'headerpercent' => '',
								  'headerheight' => '',
								  'gatedia' => '',
								  'headersize' => '',
								  'pourweight' => '',
								  'moldingmethod' => '',
								  'noofsidesmachinied' => '',
								  'finishinprocessrouting' => '',
								  'pourquality' => '',
								  'internalchilling' => '',
								  'externalchilling' => '',
								  'assemblyno' => $_POST['assemblyno'],
								  'drawn' => $_POST['drawn'],
								  'specification' => $_POST['specification'],
								  'foundarynotes' => '',
								  'flaskingnotes' => '',
								  'furnacenotes' => '',
								  'finishingnotes' => '',
								  'specialnotes' => '');
			}else{
				$insert_data = array('unique_id' => $row_id,
					  'mno' => $_POST['mno'],	
					  'madeqty' => $_POST['madeqty'],
					  'excessqty' => $_POST['excessqty'],
					  'noofpatterns' => $_POST['noofpatterns'],
					  'pieceormold' => $_POST['pieceormold'],
					  'volume' => $_POST['volume'],
					  'nominlweight' => $_POST['nominlweight'],
					  'headertype' => $_POST['headertype'],
					  'stockheight' => $_POST['stockheight'],
					  'stockvolume' => $_POST['stockvolume'],
					  'radiusselectionrtrr' => $_POST['radiusselectionrtrr'],
					  'headershapertrr' => $_POST['headershapertrr'],
					  'headerpercent' => $_POST['headerpercent'],
					  'headerheight' => $_POST['headerheight'],
					  'gatedia' => $_POST['gatedia'],
					  'headersize' => $_POST['headersize'],
					  'pourweight' => $_POST['pourweight'],
					  'moldingmethod' => $_POST['moldingmethod'],
					  'noofsidesmachinied' => $_POST['noofsidesmachinied'],
					  'finishinprocessrouting' => $_POST['finishinprocessrouting'],
					  'pourquality' => $_POST['pourquality'],
					  'internalchilling' => $_POST['internalchilling'],
					  'externalchilling' => $_POST['externalchilling'],
					  'assemblyno' => $_POST['assemblyno'],
					  'drawn' => $_POST['drawn'],
					  'specification' => $_POST['specification'],
					  'foundarynotes' => $_POST['foundarynotes'],
					  'flaskingnotes' => $_POST['flaskingnotes'],
					  'furnacenotes' => $_POST['furnacenotes'],
					  'finishingnotes' => $_POST['finishingnotes'],
					  'specialnotes' => $_POST['specialnotes']);
			}

			$this->main_model->add_data('miscinput', $insert_data);
		}else{
			if($drawing_status == '' || $drawing_status == 'pending'){
				$update_data = array('mno' => $_POST['mno'],	
								  'madeqty' => $_POST['madeqty'],
								  'assemblyno' => $_POST['assemblyno'],
								  'drawn' => $_POST['drawn'],
								  'specification' => $_POST['specification']);
			}else{
				$update_data = array('mno' => $_POST['mno'],	
								  'madeqty' => $_POST['madeqty'],
								  'excessqty' => $_POST['excessqty'],
								  'noofpatterns' => $_POST['noofpatterns'],
								  'pieceormold' => $_POST['pieceormold'],
								  'volume' => $_POST['volume'],
								  'nominlweight' => $_POST['nominlweight'],
								  'headertype' => $_POST['headertype'],
								  'stockheight' => $_POST['stockheight'],
								  'stockvolume' => $_POST['stockvolume'],
								  'radiusselectionrtrr' => $_POST['radiusselectionrtrr'],
								  'headershapertrr' => $_POST['headershapertrr'],
								  'headerpercent' => $_POST['headerpercent'],
								  'headerheight' => $_POST['headerheight'],
								  'gatedia' => $_POST['gatedia'],
								  'headersize' => $_POST['headersize'],
								  'pourweight' => $_POST['pourweight'],
								  'moldingmethod' => $_POST['moldingmethod'],
								  'noofsidesmachinied' => $_POST['noofsidesmachinied'],
								  'finishinprocessrouting' => $_POST['finishinprocessrouting'],
								  'pourquality' => $_POST['pourquality'],
								  'internalchilling' => $_POST['internalchilling'],
								  'externalchilling' => $_POST['externalchilling'],
								  'assemblyno' => $_POST['assemblyno'],
								  'drawn' => $_POST['drawn'],
								  'specification' => $_POST['specification'],
								  'foundarynotes' => $_POST['foundarynotes'],
								  'flaskingnotes' => $_POST['flaskingnotes'],
								  'furnacenotes' => $_POST['furnacenotes'],
								  'finishingnotes' => $_POST['finishingnotes']);
			}

			$this->main_model->update_table('miscinput', $update_data, 'unique_id', $row_id);
		}

		$update_drawing = array('drawing_status' => 'pending');
		$this->main_model->update_table('sentineldata', $update_drawing, 'unique_id', $row_id);

		$validate_job = $this->main_model->get_all_from_table('projectjobschedule', "unique_id = '".$row_id."'");

		if(empty($validate_job)){
			$insert_data = array('unique_id' => $row_id,
								  'projectno' => $_POST['mno'],	
								  'runonserver' => 'TRUE',
								  'jobstatus' => 'FALSE',
								  'plant_id' => $plant_id,
								  'job_type' => 'sentinal-drawing');

			$this->main_model->add_data('projectjobschedule', $insert_data);
		}else{
			$update_data = array('projectno' => $_POST['mno'],
								  'runonserver' => 'TRUE',
								  'jobstatus' => 'FALSE');

			$this->main_model->update_table('projectjobschedule', $update_data, 'unique_id', $row_id);
		}

		header("Location: ".base_url('sentinal/shape/step-four.html?row_id='.$row_id.'&plant_id=').$plant_id."");
	}

	function get_user_verification($data){
		try{
			$result = $this->main_model->get_user_by_sgid($data['sgid']);
		} catch (Exception $e){
			$result['error'] = $e->getMessage();
		}
		return $result;
	}
}