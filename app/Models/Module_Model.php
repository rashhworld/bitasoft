<?php

namespace App\Models;

use CodeIgniter\Model;

class Module_Model extends Model
{
    protected $table = 'module';
    protected $primaryKey = 'mdid ';
    protected $allowedFields = ['sid', 'mdname', 'mdslug'];
}
