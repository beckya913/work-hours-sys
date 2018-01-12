<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Authorize extends CI_Controller {

	public function __construct(){
		
	      session_start();
	      parent::__construct();
      	
     }

    public function login(){

	if ( isset($_SESSION['username'])) {
         header("location: ".base_url()."main/create");
      }
		$this->load->view('login');
	}

	public function checklogin(){
	
	$query=$this->db->where('username', $this->input->post('username'))
					->where('password', md5($this->input->post('password')))
					->get('authorize');
		
	$res= $query->num_rows();
	$row = $query->row();
	$level = $row->level;

	if($res == 1){

		$_SESSION['username']= $this->input->post('username');
		redirect('main/create', 'refresh');
		
	} else {

		echo "<html><head><meta charset='utf-8'></head><body><script type='text/javascript'>
				alert('帳號密碼錯誤！');
				window.location.href='login';
			  </script></body></html>";

		} 
	}

	public function logout(){
		
		session_destroy();
		header("location: ".base_url()."authorize/login");
	 }

	 public function create_user(){

	 	$this->load->model('Git_db_workhours');
		$data['results'] = $this->Git_db_workhours->get_user();
		$this->load->view('create_user',$data);
	}

	public function action_create_user(){
		
				$newRow1 =array();
				$count = count($this->input->post('username'));
				for($i=0; $i<$count; $i++) {
					$newRow1[] = array(
					'username' => $this->input->post('username')[$i],
					'password' => md5($this->input->post('password')[$i]),
					'level' => $this->input->post('level')[$i],
					);
				}

				$newRow2 =array();
				$count = count($this->input->post('username'));
				for($i=0; $i<$count; $i++) {
					$newRow2[] = array(
					'username' => $this->input->post('username')[$i],
					'name_tw' => $this->input->post('name_tw')[$i],
					'name_en' => $this->input->post('name_en')[$i],
					'department' => $this->input->post('department')[$i],
					'division' => $this->input->post('division')[$i],
					'unit' => $this->input->post('unit')[$i],
					'supervisor_1' => $this->input->post('supervisor_1')[$i],
					'supervisor_2' => $this->input->post('supervisor_2')[$i],
					'supervisor_3' => $this->input->post('supervisor_3')[$i],

					);
				}
				
				$this->db->insert_batch('authorize', $newRow1);
				$this->db->insert_batch('user_profile', $newRow2);

			    echo "<html><head><meta charset='utf-8'></head><body><script type='text/javascript'>
					alert('使用者新增成功！');
					window.location.href='create_user';
				  </script></body></html>";
	}

	public function update_user(){

		$this->load->model('Git_db_workhours');
		$id= $this->uri->segment(3);
		$data['results'] = $this->Git_db_workhours->get_user_all($id);
		$this->load->view('update_user',$data);
	}

	public function action_update_user(){
		
		$this->load->model('Git_db_workhours');
		$newRow1 = array(
					'level' => $this->input->post('level'),
					'status' => $this->input->post('status'),
				);
		$newRow2 = array(
					'username' => $this->input->post('username'),
					'name_tw' => $this->input->post('name_tw'),
					'name_en' => $this->input->post('name_en'),
					'department' => $this->input->post('department'),
					'division' => $this->input->post('division'),
					'unit' => $this->input->post('unit'),
					'supervisor_1' => $this->input->post('supervisor_1'),
					'supervisor_2' => $this->input->post('supervisor_2'),
					'supervisor_3' => $this->input->post('supervisor_3'),

				);
		$this->Git_db_workhours->update_user($newRow1);
		$this->Git_db_workhours->update_user_profile($newRow2);
		echo "<html><head><meta charset='utf-8'></head><body><script type='text/javascript'>
					alert('修改使用者成功！');
					window.location.href='create_user';
				  </script></body></html>";
	}

	public function action_update_user_pw(){

		$this->load->model('Git_db_workhours');
		$newRow1 = array(
					'password' => md5($this->input->post('password')),
				);
		$this->Git_db_workhours->update_user($newRow1);
		echo "<html><head><meta charset='utf-8'></head><body><script type='text/javascript'>
					alert('修改密碼成功！');
					window.location.href='create_user';
				  </script></body></html>";

	}

//End
}