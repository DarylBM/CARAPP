<?php
// In app/Controllers/Analytics.php
namespace App\Controllers;

use App\Models\UserModel;

class Analytics extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();
        
        // Get user counts by role
        $roleCounts = $userModel->getUserCountByRole();
        
        // Get user counts by date for the last month
        $startDate = date('Y-m-01');
        $endDate = date('Y-m-t');
        $dateCounts = $userModel->getUserCountByDate($startDate, $endDate);

        return view('analytics/index', [
            'roleCounts' => $roleCounts,
            'dateCounts' => $dateCounts,
        ]);
    }
}
