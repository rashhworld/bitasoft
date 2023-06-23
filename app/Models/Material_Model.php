<?php

namespace App\Models;

use CodeIgniter\Model;

class Material_Model extends Model
{
    protected $table = 'material';
    protected $primaryKey = 'mid';
    protected $allowedFields = ['cid', 'sid', 'mdid', 'mtitle', 'mfile', 'mslug', 'mdesc', 'mdate', 'mstatus', 'mpos'];
}
