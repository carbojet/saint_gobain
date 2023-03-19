<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main_model extends CI_Model {

	public function __construct() {

        parent::__construct();
		//secondary data
		$this->db1 = $this->load->database('plant_2001', TRUE);
		$this->db2 = $this->load->database('plant_2002', TRUE);
    }
	
	
	function update_table($tablename,$array,$columnname,$value){
		
		$this->db->where($columnname,$value);
		$this->db->update($tablename,$array);		
	}
	
	function delete_table($tablename, $columnname, $value){
		
		$this->db->where($columnname,$value);
		$this->db->delete($tablename);
	}
	
	function delete_table_data($tablename, $where){
		
		$this->db->where($where);
		$this->db->delete($tablename);
	}

	function get_all_data_by_position($table, $where){
		$this->db->select(''.$table.'.*');
		$this->db->from($table);
		$this->db->where($where);
		$this->db->order_by('position','ASC');
		$query = $this->db->get();
		return $query->result();
	}

	function get_all_from_table($table,$where){
		$this->db->select(''.$table.'.*');
		$this->db->from($table);
		if($where != ''){
			$this->db->where($where);
		}
		$query = $this->db->get();
		return $query->result();
	}

	function get_all_from_table_by_order($table, $where, $orderby, $mode){
		$this->db->select(''.$table.'.*');
		$this->db->from($table);
		if($where != ''){
			$this->db->where($where);
		}
		$this->db->order_by($orderby, $mode);
		$query = $this->db->get();
		return $query->result();
	}

	function add_data($table, $insert_array){
		
		$this->db->insert($table, $insert_array);
		return $this->db->insert_id();
	}

	function get_all_shape_available($table,$where){
		$this->db->select('productname');
		$this->db->from($table);
		$this->db->where($where);
		$this->db->group_by('productname');
		$this->db->order_by('productname','ASC');
		$query = $this->db->get();
		return $query->result();
	}

	function get_all_shape_sub_category_available($table,$where){
		$this->db->select('sub_category');
		$this->db->from($table);
		$this->db->where($where);
		//$this->db->group_by('sub_category');
		$this->db->order_by('model_id','ASC');
		$query = $this->db->get();
		return $query->result();
	}

	function get_sentinal_data_by_condition($table, $where){
		$this->db->select(''.$table.'.*');
		$this->db->from($table);
		$this->db->join('miscinput', ''.$table.'.unique_id = miscinput.unique_id', 'left');
		$this->db->where($where);
		$query = $this->db->get();
		return $query->result();
	}

	function fetch_all_data_with_condition($where, $table, $start, $limit, $order_by, $order_by_type){
		
		$sql  = "SELECT ".$table.".*";
		$sql .= " FROM ".$table;	
		if($where != ''){
			$sql .= " WHERE ".$where."";
		}
		$sql .= " ORDER BY ".$order_by." ".$order_by_type."";
		$sql .= " OFFSET ".$start." LIMIT ".$limit; 
		
		$query = $this->db->query($sql);
		
		$sql2 = "SELECT count(*) OVER() AS total FROM ".$table;
		if($where != ''){
			$sql2 .= " WHERE ".$where."";
		}

		$totalQuery = $this->db->query($sql2);
        if(empty($totalQuery->result_array())){
			$total_rows = 0;
		}else{
			$total_rows = $totalQuery->row(0)->total;	
		}
		      
        $results = array() ;
        foreach ($query->result_array() as $row){          
            $results[] = $row ;
        }
        $res = array('total_rows' => $total_rows,
            'result'  => $results);
		
        return $res; 
	}

	function get_distinct_module_from_sales_order($table, $where){
		$this->db->select('module');
		$this->db->from($table);
		$this->db->where($where);
		$this->db->group_by('module');
		$this->db->order_by('module', 'ASC');
		$query = $this->db->get();
		return $query->result();
	}
}