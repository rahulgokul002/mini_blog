<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function index()
	{
        $query=$this->db->query("SELECT * FROM `articles` order by blogid desc");
        $data['results']=$query->result_array();
        $this->load->view('admin_panel/viewblog',$data);
	}
	
	public function addblog()
	{
		$this->load->view('admin_panel/addblog');
	}
    public function addblog_post(){
        if($_FILES){
            $config['upload_path']          = './assets/upload/blogimg';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
            $this->load->library('upload', $config);
            if ( ! $this->upload->do_upload('file'))
            {
                $error = array('error' => $this->upload->display_errors());
                die('Error');
                    // $this->load->view('upload_form', $error);
            }
            else
            {
                $data = array('upload_data' => $this->upload->data());
                $fileurl="assets/upload/blogimg/".$data['upload_data']['file_name'];            
                $blog_title=$_POST['blog_title'];
                $desc=$_POST['desc'];
                $query=$this->db->query("INSERT INTO `articles`(`blog_title`, `blog_desc`, `blog_img`) VALUES ('$blog_title','$desc','$fileurl')");
                if($query){
                    $this->session->set_flashdata('inserted','yes');
                    redirect('admin/blog/addblog');
                }else{
                    $this->session->set_flashdata('inserted','no');
                    redirect('admin/blog/addblog');
                }
            }
        }else{

        }
    }
    public function deleteblog(){
    //    print_r($_POST);
       $delete_id=$_POST['delete_id'];
       $q=$this->db->query("DELETE FROM `articles` WHERE `blogid`='$delete_id'");
        if($q){
            echo "Deleted";
        }else{
            echo "Notdeleted";
        }
    }
    public function editblog($blogid){
        $q=$this->db->query("SELECT `blog_title`,`blog_desc`,`blog_img`,`status` FROM `articles` WHERE `blogid`='$blogid'");
        $data['result']=$q->result_array();
        $data['blogid']=$blogid;
        // print_r($data);
        $this->load->view('admin_panel/editblog',$data);    
    }
    public function editblog_post(){

        if($_FILES['file']['name']){
            $config['upload_path']          = './assets/upload/blogimg';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
            $this->load->library('upload', $config);
            if ( ! $this->upload->do_upload('file'))
            {
                $error = array('error' => $this->upload->display_errors());
                die('Error');
                    // $this->load->view('upload_form', $error);
            }
            else
            {
                $data = array('upload_data' => $this->upload->data());
                $fileurl="assets/upload/blogimg/".$data['upload_data']['file_name'];            
                $blog_title=$_POST['blog_title'];
                $desc=$_POST['desc'];
                $blogid=$_POST['blogid'];
                $status=$_POST['publish_unpublish'];
                
                $query=$this->db->query("UPDATE `articles` SET `blog_title`='$blog_title',`blog_desc`='$desc',`blog_img`='$fileurl',`status`='$status'  WHERE `blogid`='$blogid'");
                if($query){
                    $this->session->set_flashdata('updated','yes');
                    redirect('admin/blog');
                }else{
                    $this->session->set_flashdata('updated','no');
                    redirect('admin/blog');
                }
            }
        }   else{
            $blog_title=$_POST['blog_title'];
                $desc=$_POST['desc'];
                $blogid=$_POST['blogid'];
                $status=$_POST['publish_unpublish'];

                $query=$this->db->query("UPDATE `articles` SET `blog_title`='$blog_title',`blog_desc`='$desc',`status`='$status' WHERE `blogid`='$blogid'");
                if($query){
                    $this->session->set_flashdata('updated','yes');
                    redirect('admin/blog');
                }else{
                    $this->session->set_flashdata('updated','no');
                    redirect('admin/blog');
                }

        }     
    }
}
