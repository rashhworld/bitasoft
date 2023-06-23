<?php

namespace App\Models;

use CodeIgniter\Model;

class Catagory_Model extends Model
{
    protected $table = 'catagory';
    protected $primaryKey = 'cid ';
    protected $allowedFields = ['cname', 'cimg', 'cslug', 'cdesc', 'cpos'];
}
