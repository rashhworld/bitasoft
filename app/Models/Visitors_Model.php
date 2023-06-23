<?php

namespace App\Models;

use CodeIgniter\Model;

class Visitors_Model extends Model
{
    protected $table = 'visitors';
    protected $primaryKey = 'vid ';
    protected $allowedFields = ['page_type', 'page_url', 'ip_address'];
}
