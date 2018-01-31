<?php if (!defined('BASEPATH'))exit('No direct script access allowed');

class Home extends CI_Controller {

    function __construct() {
    	// echo "masuk sini";
    	// die();
        parent::__construct();
    }

    public function index() {

        if ($this->session->userdata('USER_ID') == "") {
            $client = new SoapClient(null, array(
                'location' => WSREDIRECT,
                'uri' => "urn://www.w3.org/TR/SOAP",
                'trace' => 1));
            $rec = $client->__soapCall('useAlias', array('alias' => 'sigmaapp'));
            // var_dump($rec);
            // die();
            redirect("http://localhost/newportal/servicelogin.php?url=" . $rec);
            //redirect("http://10.210.11.15/portalsigma/servicelogin.php?url=".$rec);
        } else {
            redirect('media/home'); // change this to page after login
        }
    }

     public function login($token = "") {
        if ($token != "") {
            $client = new SoapClient(null, array(
                'location' => WSAUTH,
                'uri' => "urn://www.w3.org/TR/SOAP",
                'trace' => 1));

            $emp = new SoapClient(null, array(
                'location' => WSEMP,
                'uri' => "urn://www.w3.org/TR/SOAP",
                'trace' => 1));
            $rec = $client->__soapCall('tlogin', array('token_uid' => $token));
            $employ = $emp->__soapCall('getBuIDbyNik', array('nik' => $rec['EMP_ID']));
            if ($rec["TOKEN_UID"] != "") {
                $sessions = array(
                    'USER_ID' => $rec["USER_ID"],
                    'd_user_name' => $rec["USER_NAME"],
                    'd_email' => $rec["EMAIL"],
                    'd_nik' => $rec["EMP_ID"],
                    'd_token' => $rec["TOKEN_UID"],
                    'd_bu_id' => $employ["BU_ID"],
                    'd_bu_name' => $employ["BU_NAME"],
                );
                $this->session->set_userdata($sessions);
            }
        }
        redirect("home");
    }

    public function logout() {

        $this->session->sess_destroy();
        $client = new SoapClient(null, array(
            'location' => WSREDIRECT,
            'uri' => "urn://www.w3.org/TR/SOAP",
            'trace' => 1));
        $rec = $client->__soapCall('useAlias', array('alias' => 'appsigma'));
        //$rec = $client->__soapCall('useAlias', array('alias'=>'kompetensi'));
        //redirect("http://localhost/portalsigma/servicelogout.php?url=".$rec);
        //redirect("https://portal.telkomsigma.co.id/servicelogout.php?url=".$rec);
        redirect("http://localhost/kompetensi/servicelogout.php?url=" . $rec);
    }
}