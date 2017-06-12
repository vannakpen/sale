<?php
class Language extends CI_Controller
{
    public function __construct() {
        parent::__construct();
    }

    function switch_lang($language = "") {
        $language = ($language != "") ? $language : $this->config->item('language');
        $this->session->set_userdata('site_lang', $language);
        if(!$this->input->post('ajax_request')) redirect(base_url());
    }
}