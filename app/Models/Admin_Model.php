<?php

namespace App\Models;

use CodeIgniter\Model;

class Admin_Model extends Model
{
    protected $table = 'admin';
    protected $primaryKey = 'aId';
    protected $allowedFields = ['aName', 'aEmail', 'aPass', 'aAccessType'];
}
