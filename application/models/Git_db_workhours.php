<?php 

class Git_db_workhours extends CI_Model { 

	function __construct()
    {
        // 呼叫模型(Model)的建構函數
        parent::__construct();
        session_start();
    }

    function insert($data){
	
		$this->db->insert('report', $data);
	}

    function insert_subcatecogy($data){
    
        $this->db->insert('subcategories', $data);
    }

    function get_report(){
    
        $query = $this->db->order_by('submit_date', 'desc')->get('report'); 
        return $query->result();
        
    }

    function get_report_standarduser(){
        $username= $_SESSION['username'];
        $query = $this->db->order_by('submit_date', 'desc')
                          ->where('username',$username)
                          ->get('report'); 
        return $query->result();
        
    }

    function get_project(){
    
        $query = $this->db->order_by('start_date', 'desc')->get('project'); 
        return $query->result();
        
    }

    function insert_project($data){
    
        $this->db->insert('project', $data);
    }

    function update_project($data) {
        
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('project',$data);
    }

    function get_project_all($id){
    
        $query = $this->db->get_where('project',array('id'=>$id));
        return $query->result();        

    }

    function get_category_item(){
    
        $query = $this->db->get('subcategories'); 
        return $query->result();
        
    }

    function insert_category_item($data){
    
        $this->db->insert('subcategories', $data);
    }

    function update_category_item($data) {
        
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('subcategories',$data);
    }

    function get_category_all($id){
    
        $query = $this->db->get_where('subcategories',array('id'=>$id));
        return $query->result();        

    }

    function get_sub_category($id){

    $query = $this->db->where('cid',$id)->get('subcategories');          
    return $query->result();

    }

}

?>