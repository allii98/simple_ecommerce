<?php

defined('BASEPATH') or exit('No direct script access allowed');

use Xendit\Xendit;

class Tes extends CI_Controller
{

    private $token = 'xnd_development_dvmm2zEIIW8loHUfZs1zYNH8WXXUfXk0GwMdSCBROr0sKG7s0MeKqd1TdYPSm4';

    public function index()
    {
        Xendit::setApiKey($this->token);

        $getVABank = \Xendit\VirtualAccounts::getVABanks();

        var_dump($getVABank) . die();
    }
}

/* End of file Tes.php */