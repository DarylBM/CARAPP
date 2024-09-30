<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $allowedFields = ['model', 'price', 'image', 'mileage', 'fueltype', 'transmission'];

    public function getAllProducts()
    {
        return $this->findAll();
    }

    public function getProduct($id)
    {
        return $this->find($id);
    }
    
    
}
