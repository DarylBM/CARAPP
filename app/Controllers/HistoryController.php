<?php
namespace App\Controllers;

use App\Models\RentingModel;


class HistoryController extends BaseController
{
    public function index()
    {
        $session = session();
        $userId = $session->get('user_id'); // Assuming user_id is stored in session upon login

        if (!$userId) {
            return redirect()->to('/login'); // Redirect to login if not authenticated
        }

        $rentingModel = new RentingModel();
        
        // Fetching user-specific data
        $data['rentals'] = $rentingModel->where('user_id', $userId)->findAll(); // Assuming you have user_id in your renting table


        return view('/history', $data);
    }
}
