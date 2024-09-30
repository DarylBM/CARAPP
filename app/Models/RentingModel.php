<?php
namespace App\Models;

use CodeIgniter\Model;

class RentingModel extends Model
{
    protected $table            = 'renting';
    protected $primaryKey       = 'RentalID';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'user_id',
        'FirstLocation',
        'SecondLocation',
        'Name',
        'Phone',
        'StartDate',
        'EndDate',
        'StartTime',
        'EndTime',
        'price',
        'Status',
        'created_at',
    ];

    protected bool $allowEmptyInserts = false;

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation Rules
    protected $validationRules = [
        'Name' => 'required|min_length[3]|max_length[100]',
        'Phone' => 'required|min_length[10]|max_length[15]',
        'FirstLocation' => 'required',
        'SecondLocation' => 'required',
        'StartDate' => 'required|valid_date',
        'EndDate' => 'required|valid_date',
        'StartTime' => 'required|regex_match[/^(?:2[0-3]|[01][0-9]):[0-5][0-9]$/]', // HH:MM format validation
        'EndTime' => 'required|regex_match[/^(?:2[0-3]|[01][0-9]):[0-5][0-9]$/]',   // HH:MM format validation
        'price' => 'required|decimal',
    ];
    
    protected $validationMessages = [
        'StartTime' => [
            'regex_match' => 'Please enter a valid start time in HH:MM format.'
        ],
        'EndTime' => [
            'regex_match' => 'Please enter a valid end time in HH:MM format.'
        ]
    ];
    
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = [];
    protected $afterInsert = [];
    protected $beforeUpdate = [];
    protected $afterUpdate = [];
    protected $beforeFind = [];
    protected $afterFind = [];
    protected $beforeDelete = [];
    protected $afterDelete = [];

    // Method to insert a new rental record
    public function insertRental(array $data)
    {
        // Set created_at timestamp before inserting
        $data['created_at'] = date('Y-m-d H:i:s'); // Current timestamp

        // Insert data into the database
        return $this->insert($data);
    }
}
