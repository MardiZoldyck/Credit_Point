<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Media extends CI_Controller{
    public function __construct(){
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        if($this->session->userdata('USER_ID')==""){

            redirect('Home');
            
        }

        //switch ($this->srcbasic->privilege) {
        switch (1) {
            case 1:
                $this->navi = 'navigation/navmain';
                break;
            case 2:
                $this->navi = 'navigation/navuser';
                break;
            case 3:
                $this->navi = 'navigation/pmonav';
                break;
            case 4:
                $this->navi = 'navigation/salenav';
                break;
            case 5:
                $this->navi = 'navigation/usernav';
                break;
            case 6:
                $this->navi = 'navigation/special';
                break;
        }
    }

    public function profilling(){
        // $data['ownerphoto'] = $this->srcbasic;
        $data['navigation'] = $this->navi;
        // $data['menuname'] = $this->menu_name;
        // $data['panel_alert'] = $this->alert;
        $data['content'] = 'content/v_profilling';
        ///$data['menu2'] = 1;
        // $data['action_page']=   'profilebase/newtraining';
        $this->load->view('template', $data);
    }

    public function home(){
        // $data['ownerphoto'] = $this->srcbasic;
        $data['navigation'] = $this->navi;
        // $data['menuname'] = $this->menu_name;
        // $data['panel_alert'] = $this->alert;
        $data['content'] = 'content/v_dashboard';
        $data['menu_1'] = 1;
        // $data['action_page']=   'profilebase/newtraining';
        $this->load->view('template', $data);
    }

    

}