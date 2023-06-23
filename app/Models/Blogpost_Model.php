<?php

namespace App\Models;

use CodeIgniter\Model;

class Blogpost_Model extends Model
{
    protected $table = 'blogpost';
    protected $primaryKey = 'bid';
    protected $allowedFields = ['btitle', 'bimg', 'bslug', 'bdesc', 'bdate', 'bstatus'];
}
