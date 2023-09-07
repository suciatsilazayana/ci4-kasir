<?php

namespace App\Models;

use CodeIgniter\Model;

class m_user extends Model
{
    protected $table      = 'tbl_user';
    protected $primaryKey = 'id_user';

    protected $useAutoIncrement = true;

    protected $returnType     = 'object';
    protected $allowedFields = [
        'id_user',
        'nama_user',
        'no_hp',
        'password',
        'level',
    ];
}
