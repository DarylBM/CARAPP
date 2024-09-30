<?php

namespace App\Models;

use CodeIgniter\Model;

class CarModel extends Model
{
    protected $table            = 'cardetails';
    protected $primaryKey       = 'Carid';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['Model', 'Year', 'Color', 'Mileage', 'Transmission', 'FuelType', 'Price', 'Image', 'Status',];

    protected bool $allowEmptyInserts = false;

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules = [
        'Model' => 'required',
        'Year' => 'required|numeric',
        'Color' => 'required',
        'Mileage' => 'required|numeric',
        'Transmission' => 'required',
        'FuelType' => 'required',
        'Price' => 'required|numeric',
        'Image' => 'permit_empty|max_size[Image,1024]|is_image[Image]',
    ];
    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}
