<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\RentingModel;
use DateTime;

class Rental extends BaseController
{
    public function index()
    {
        $model = new RentingModel();
        $rentals = $model->findAll(); // Fetch all rentals
    
        $userName = session()->get('user_name', '');
        $userPhone = session()->get('user_phone', '');
    
        // Pass user and rental data to the view
        return view('user/renting', [
            'user_name' => $userName,
            'user_phone' => $userPhone,
            'rentals' => $rentals, // Ensure this is included
        ]);
    }

    public function submit()
    {
        $model = new RentingModel();

        // Get form data
        $data = [
            'CarID' => $this->request->getVar('car_id'),
            'FirstLocation' => $this->request->getVar('firstlocation'),
            'SecondLocation' => $this->request->getVar('secondlocation'),
            'Name' => $this->request->getVar('name'),
            'Phone' => $this->request->getVar('phone'),
            'StartDate' => $this->request->getVar('start_date'),
            'EndDate' => $this->request->getVar('end_date'),
            'StartTime' => $this->request->getVar('start_time'),
            'EndTime' => $this->request->getVar('end_time'),
            'price' => $this->request->getVar('price'),
            'Status' => 'pending', // Set initial status as 'pending'
        ];

        // Insert data into the database
        $model->insert($data);

        // Redirect after submission
        return redirect()->to(site_url('rental'));
    }

    public function adminIndex()
    {
        $model = new RentingModel();
        $rentals = $model->findAll(); // Retrieve all rentals

        return view('admin/rental_management', ['rentals' => $rentals]);
    }

    public function getRentals()
    {
        $model = new RentingModel();
        $rentals = $model->findAll(); // Retrieve all rentals

        $events = [];
        foreach ($rentals as $rental) {
            // Determine rental status based on current date and time
            $currentDateTime = new DateTime();
            $startDateTime = new DateTime($rental['StartDate'] . ' ' . $rental['StartTime']);
            $endDateTime = new DateTime($rental['EndDate'] . ' ' . $rental['EndTime']);
            $status = 'pending';

            if ($currentDateTime >= $startDateTime && $currentDateTime <= $endDateTime) {
                $status = 'ongoing';
            } elseif ($currentDateTime > $endDateTime) {
                $status = 'done';
            }

            $rental['Status'] = $status;

            $events[] = [
                'id' => $rental['RentalID'],
                'title' => $rental['Name'],
                'start' => $rental['StartDate'] . 'T' . $rental['StartTime'],
                'end' => $rental['EndDate'] . 'T' . $rental['EndTime'],
                'color' => $this->getRentalColor($status),
                'extendedProps' => [
                    'firstLocation' => $rental['FirstLocation'],
                    'secondLocation' => $rental['SecondLocation'],
                    'phone' => $rental['Phone'],
                    'price' => $rental['price'],
                    'status' => $status
                ]
            ];
        }

        return $this->response->setJSON($events);
    }

    public function updateRental()
    {
        $model = new RentingModel();

        // Get rental ID and form data
        $rentalId = $this->request->getVar('rental_id');
        $data = [
            'FirstLocation' => $this->request->getVar('firstlocation'),
            'SecondLocation' => $this->request->getVar('secondlocation'),
            'Name' => $this->request->getVar('name'),
            'Phone' => $this->request->getVar('phone'),
            'StartDate' => $this->request->getVar('start_date'),
            'EndDate' => $this->request->getVar('end_date'),
            'StartTime' => $this->request->getVar('start_time'),
            'EndTime' => $this->request->getVar('end_time'),
        ];

        // Update the rental record in the database
        $model->update($rentalId, $data);

        // Redirect back to the rental management page after updating
        return redirect()->to(site_url('rentman'))->with('status', 'Rental updated successfully');
    }

    public function deleteRental($id)
    {
        $model = new RentingModel();
        $model->delete($id); // Delete the rental by its ID

        // Redirect to admin page with success message
        return redirect()->to(site_url('rentman'))->with('status', 'Rental deleted successfully');
    }

    // Method to determine the color for rental events based on their status
    private function getRentalColor($status)
    {
        switch ($status) {
            case 'ongoing':
                return 'green';
            case 'done':
                return 'yellow';
            case 'pending':
            default:
                return 'red';
        }
    }
}
