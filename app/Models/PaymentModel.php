<?php

namespace App\Models;

use CodeIgniter\Model;

class PaymentModel extends Model
{
    protected $table = 'payments'; // Replace with your actual table name
    protected $primaryKey = 'id'; // Primary key of the table
    protected $allowedFields = ['card_number', 'name', 'address', 'payment_method']; // Fields you want to allow for insertion
}