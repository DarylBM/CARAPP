<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class CheckoutController extends BaseController
{
    public function checkout()
    {
        return view('user/checkouts');
    }
}
