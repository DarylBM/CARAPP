<?php
namespace App\Controllers;

use App\Models\CarModel;
use CodeIgniter\Controller;

class CarController extends Controller
{
    private $carModel;

    public function __construct()
    {
        $this->carModel = new CarModel();
        helper(['form', 'url']);
    }

    public function index()
    {
        $cars = $this->carModel->findAll();
        return view('user/cars', ['cars' => $cars]);
    }

    public function indexs()
    {
        $data['cars'] = $this->carModel->findAll();
        return view('admin/car_management', $data);
    }

    public function create()
    {
        return view('admin/car_form');
    }

    public function store()
    {
        $data = $this->request->getPost();
        
        if ($this->carModel->insert($data)) {
            return redirect()->to('/admin/car_management')->with('success', 'Car added successfully.');
        } else {
            return redirect()->back()->withInput()->with('errors', $this->carModel->errors());
        }
    }

    public function edit($id)
{
    $car = $this->carModel->find($id);
    
    if (!$car) {
        return redirect()->to('/admin/car_management')->with('error', 'Car not found.');
    }
    
    return view('admin/car_form', ['car' => $car]);
}


    public function update($id)
{
    $data = $this->request->getPost();

    if ($this->carModel->update($id, $data)) {
        return redirect()->to('/admin/car_management')->with('success', 'Car updated successfully.');
    } else {
        return redirect()->back()->withInput()->with('errors', $this->carModel->errors());
    }
}

    public function delete($id)
    {
        $this->carModel->delete($id);
        return redirect()->to('/admin/car_management')->with('success', 'Car deleted successfully.');
    }


    
}