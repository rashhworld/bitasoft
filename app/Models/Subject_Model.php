<?php

namespace App\Models;

use CodeIgniter\Model;

class Subject_Model extends Model
{
    protected $table = 'subject';
    protected $primaryKey = 'sid ';
    protected $allowedFields = ['cid', 'sname', 'sslug'];
}
