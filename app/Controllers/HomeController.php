<?php 
namespace App\Controllers;  
use CodeIgniter\Controller;
use App\Models\CarModel;
  
class HomeController extends Controller
{
    public function index()
    {   

        echo view('user/usertest');
    
    }
    public function ecom()
    {   

        echo view('user/ecom');
    
    }
    public function cars()
    {   

        echo view('user/cars');
    
    }
    public function rent()
    {   

        echo view('user/renting');
    
    }
    public function start()
    {   

        echo view('layout/getstarted');
    
    }
    public function admin()
    {   

        echo view('dashboard');
    
    }
    public function fecars()
    {
        // Load the car model
        $carModel = new CarModel();

        // Fetch all cars from the database
        $cars = $carModel->findAll();

        // Pass the cars data to the view
        return view('layout/fecars', ['cars' => $cars]);
    }



}