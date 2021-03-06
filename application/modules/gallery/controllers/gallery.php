<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gallery extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        
        $this->load->library(array('form_validation','image_lib'));    
        $this->load->model('gallery_model','mod');
    }
    
    public function index(){
        
        $isLogin = $this->session->userdata('logged_in');
        
        if ($isLogin === TRUE) {
                
                //map the folder which is in /uploads/gallery folder
                $map = $this->mod->iterate();
            
                $this->form_validation->set_rules('dir','folder name','required');
                if($this->form_validation->run()== FALSE){
                $data['cssPage'] ='';
                $data['jsPage'] ='';
                
                $data['map'] = $map;
                $data['sliders']    = $this->mod->select_all();
                //$data['allCategory'] = $this->category_model->listCat();

                $this->load->view('admin/header',$data);
                $this->load->view('index',$data);
                $this->load->view('admin/footer');
                }
                else {
                    
                    $album = $this->input->post('dir');
                    if (is_dir('./uploads/gallery'))
                    {
                        if(! mkdir('./uploads/gallery/' . $album, 0777, true)){
                            
                            echo 'Unable to create folder';
                        }
                    }
                    
                    $this->session->set_flashdata('msg','has completed create');
                    
                    redirect('gallery','location',302);
                    
                }
        }
        else{
                redirect('secure/login');
        }
        
        
        /*
        $this->form_validation->set_rules('caption','caption','required');
        if($this->form_validation->run() == FALSE){
            
            $data['result']     = $this->mod->select_all();
            
            $this->template->display('index', $data);
            
        }
        else {
            
             if($this->do_upload()){
                    $dataimage = $this->upload->data();
                    $fields = array(
                                'caption'          =>	$this->input->post("caption"),
                                'image'             =>	$dataimage['file_name']
                            );
                    $this->mod->insert_new_gallery($fields);
                    $this->session->set_flashdata('msg', 'New Gallery Has Been Created');
                    redirect('gallery/','location',302);
                }
                else{
                    redirect('gallery/','location',302);                
            
                    
            }
            
        }
         * 
         */
        
    }
    
    function path($path){

                $this->load->helper('directory');

                 
                $data['cssPage'] ='';
                $data['jsPage'] ='';

                $data['path']   = $path;
                
                
                
                $data['mapdata']    = directory_map('./uploads/gallery/'.$path);

                //$data['allCategory'] = $this->category_model->listCat();

                $this->load->view('admin/header',$data);
                $this->load->view('path', $data);
                $this->load->view('admin/footer');  
                 
                 
    }
    
    function do_upload($user_file = 'image'){

            $valid = TRUE;
            $path = $this->input->post('path');
            $config['upload_path']      = './uploads/gallery/'.$path;
            $config['allowed_types']    = 'gif|jpg|png';
            $config['max_size']         = '1000';
            $config['max_width']        = '0';
            $config['max_height']       = '0';


            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload($user_file))
            {
                    $valid = FALSE;
                    $this->session->set_flashdata('msg', $this->upload->display_errors());
            }
            else
            {
                $checked = $this->input->post('slider');
                    if(!$checked){
                            //$this->upload->do_upload($user_file);
                            redirect('gallery/path/'.$path,'location',302);
                    }
                    else{
                            $dataimage = $this->upload->data();
                            $data = array('upload_data' => $this->upload->data());

                            unset($config);
                            $config['image_library']	= 'gd2';
                            $config['source_image']     = $dataimage['full_path'];
                            $config['create_thumb']	= FALSE;
                            $config['maintain_ratio']	= TRUE;
                            $config['width']		= 1368;
                            $this->image_lib->initialize($config);

                            $this->image_lib->resize();
                            
                            unset($config);
                            $config['image_library']	= 'gd2';
                            $config['source_image']     = $dataimage['full_path'];
                            $config['create_thumb']	= FALSE;
                            $config['maintain_ratio']	= FALSE;
                            $config['width']		= 1368;
                            $config['height']           = 522;
                            $config['x_axis']           = '0';
                            $config['y_axis']           = '0';
                            
                            $this->image_lib->initialize($config);

                            $this->image_lib->crop();
                            
                            $now = date("Y-m-d H:i:s");

                            $fields = array(
                                        'slider_path'              => $path,
                                        'slider_title'             => $this->input->post('title'),
                                        'slider_caption'           =>	$this->input->post("caption"),
                                        'slider_img'             =>	$dataimage['file_name'],
                                        'created_at'                => $now
                                    );
                            $this->mod->insert_new_gallery($fields);

                            redirect('gallery','location',302);
    
            }
        }    

            
    }
    
    function delete($id){
        
        $this->delete_old_images($id);
        
        $this->mod->delete_row($id);
        $this->session->set_flashdata('msg','Image Gallery Deleted');
        
        redirect('gallery','location',302);
        
    }
    
    function edit($id){
        
        $this->form_validation->set_rules('caption','caption','required');
        
        if($this->form_validation->run() == FALSE){
            
            $data['row']    = $this->mod->get_row($id);
            
            $this->template->display('edit', $data);            
        }
        else {
            
            $this->mod->update($id);
            $this->session->set_flashdata('msg','Caption Updated');
            
            redirect('gallery','location',302);
            
        }
        
    }
    
    function remove_files($path, $image){
        
        $completepath = './uploads/gallery/'.$path.'/'.$image;
        $this->load->helper("file"); // load the helper
        unlink($completepath); // delete all files/folders
        
        redirect('gallery/path/'.$path,'location',302);
        
        //echo $completepath;
        
        
    }
    
    function remove_slider($id){
        
        $this->mod->delete_row($id);
        
        redirect('gallery','location',302);
        
        
    }
    
}    