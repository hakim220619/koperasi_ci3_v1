<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Notification extends CI_Controller
{

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
     * @see http://codeigniter.com/user_guide/general/urls.html
     */


    public function __construct()
    {
        parent::__construct();
        $params = array('server_key' => 'SB-Mid-server-z5T9WhivZDuXrJxC7w-civ_k', 'production' => false);
        $this->load->library('veritrans');
        $this->veritrans->config($params);
        $this->load->helper('url');
    }

    public function index()
    {
        echo 'test notification handler';
        $json_result = file_get_contents('php://input');
        $result = json_decode($json_result, "true");
        $order_id = $result['order_id'];
        $data = [
            'status' => $result['status_code']
        ];
        if ($result['status_code'] == 200) {
            $this->db->update("angsuran", $data, array('order_id' => $order_id));
        } elseif ($result['status_code'] == 200) {
          $this->db->update("simpanan", $data, array('order_id' => $order_id));
        }
    }
    
}