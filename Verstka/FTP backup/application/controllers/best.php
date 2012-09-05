<?php
class best extends CI_Controller
{

    function index()
    {

        $data = array(
            'title' => 'Лучшие'
            );

        $this->load->view('pages/best', $data);
    }
}
?>  