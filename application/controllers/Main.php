<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	public function index()
	{
		$this->load->view('create');
	}

	public function create()
	{
		$this->load->model('Git_db_workhours');
		$this->load->view('create');
	}

	public function action_create()
	{
				$this->load->model('Git_db_workhours');
				//寫入記錄至 Report
				$newRow = array(
					'post_num' => $this->input->post('post_num'),
					'submit_date' => $this->input->post('submit_date'),
					'publish_status' => $this->input->post('publish_status'),
					'report_num' => $this->input->post('report_num'),
					'username' => $this->input->post('username'),

				);
		
				$newRow_item =array();
				$count = count($this->input->post('work_hours'));
				for($i=0; $i<$count; $i++) {
					$newRow_item[] = array(
					'report_num' => $this->input->post('report_num'),
					'work_category' => $this->input->post('work_category')[$i],
					'sub_work_category' => $this->input->post('sub_work_category')[$i],
					'work_date' => $this->input->post('work_date')[$i],
					'work_hours' => $this->input->post('work_hours')[$i],
					'project_code' => $this->input->post('project_code')[$i],
					'project_status' => $this->input->post('project_status')[$i],
					'remark' => $this->input->post('remark')[$i],

					);
				}
				
				$this->Git_db_workhours->insert($newRow);
				$this->db->insert_batch('report_list', $newRow_item);

			    echo "<html><head><meta charset='utf-8'></head><body><script type='text/javascript'>
					alert('表單新增成功！');
					window.location.href='create';
				  </script></body></html>";
	}

	public function review(){
		
		$this->load->model('Git_db_workhours');
		$data['results'] = $this->Git_db_workhours->get_report();
		$this->load->view('review', $data);
		
	}

	public function review_standarduser(){
		
		$this->load->model('Git_db_workhours');
		$data['results'] = $this->Git_db_workhours->get_report_standarduser();
		$this->load->view('review', $data);
		
	}

	public function review_filter() {

		
		$query=$this->db->where('work_date >=', $this->input->post('startdate'))
					->where('work_date <=', $this->input->post('enddate'))
					->join('report','report_list.report_num = report.report_num')
					->get('report_list');
					$data['results'] = $query->result();

		$data['results'] = $query->result();

		$this->load->view('review',$data);
	}

	public function get_sub_category(){

		$this->load->model('Git_db_workhours');
		if(isset($_POST['cid']))
       {
           $this->output
           ->set_content_type("application/json")
           ->set_output(json_encode($this->Git_db_workhours->get_sub_category($_POST['cid'])));
       }

    }

    public function review_project(){
		
		$this->load->model('Git_db_workhours');
		$data['results'] = $this->Git_db_workhours->get_project();
		$this->load->view('project_list', $data);
		
	}

    public function review_project_advance(){

    	$this->load->model('Git_db_workhours');
		$data['results'] = $this->Git_db_workhours->get_project();
		$this->load->view('project_list_review', $data);

    }

    public function action_create_project(){

    	$this->load->model('Git_db_workhours');
		$newRow = array(
					'code' => $this->input->post('code'),
					'name' => $this->input->post('name'),
					'status' => $this->input->post('status'),
					'start_date' => $this->input->post('start_date'),
					'end_date' => $this->input->post('end_date'),
				);
		$this->Git_db_workhours->insert_project($newRow);
		echo "<html><head><meta charset='utf-8'></head><body><script type='text/javascript'>
					alert('新增專案成功！');
					window.location.href='review_project_advance';
				  </script></body></html>";

    }

    public function update_project(){

		$this->load->model('Git_db_workhours');
		$id= $this->uri->segment(3);
		$data['results'] = $this->Git_db_workhours->get_project_all($id);
		$this->load->view('project_list_update', $data);
	}

	public function action_update_project(){

    	$this->load->model('Git_db_workhours');
		$newRow = array(
					'code' => $this->input->post('code'),
					'name' => $this->input->post('name'),
					'status' => $this->input->post('status'),
					'start_date' => $this->input->post('start_date'),
					'end_date' => $this->input->post('end_date'),
				);
		$this->Git_db_workhours->update_project($newRow);
		echo "<html><head><meta charset='utf-8'></head><body><script type='text/javascript'>
					alert('修改專案成功！');
					window.location.href='review_project_advance';
				  </script></body></html>";

    }

    public function review_category_item(){

    	$this->load->model('Git_db_workhours');
		$data['results'] = $this->Git_db_workhours->get_category_item();
		$this->load->view('category_item_review', $data);

    }

    public function action_create_category_item(){

    	$this->load->model('Git_db_workhours');
		$newRow = array(
					'code' => $this->input->post('code'),
					'name' => $this->input->post('name'),
					'status' => $this->input->post('status'),
					'start_date' => $this->input->post('start_date'),
					'end_date' => $this->input->post('start_date'),
				);
		$this->Git_db_workhours->insert_project($newRow);
		echo "<html><head><meta charset='utf-8'></head><body><script type='text/javascript'>
					alert('新增專案成功！');
					window.location.href='review_project_advance';
				  </script></body></html>";

    }

    public function update_category_item(){

		$this->load->model('Git_db_workhours');
		$id= $this->uri->segment(3);
		$data['results'] = $this->Git_db_workhours->get_project_all($id);
		$this->load->view('project_list_update', $data);
	}

	public function action_update_category_item(){

    	$this->load->model('Git_db_workhours');
		$newRow = array(
					'code' => $this->input->post('code'),
					'name' => $this->input->post('name'),
					'status' => $this->input->post('status'),
					'start_date' => $this->input->post('start_date'),
					'end_date' => $this->input->post('end_date'),
				);
		$this->Git_db_workhours->update_project($newRow);
		echo "<html><head><meta charset='utf-8'></head><body><script type='text/javascript'>
					alert('修改專案成功！');
					window.location.href='review_project_advance';
				  </script></body></html>";

    }

}//End:class Main extends CI_Controller
