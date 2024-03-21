<?php

namespace App\Models;

use CodeIgniter\Model;

// defined('BASEPATH') or exit('No direct script access allowed'); 

class ModelUser extends Model
{ 
    protected $table            = 'user';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [];

    protected bool $allowEmptyInserts = false;

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function simpanData($data = null) 
    { 
        return $this->insert('user', $data);
    } 
 
    public function cekData($where = null) 
    { 
        return $this->where($where)->findAll(); 
    } 
    
    public function getUserWhere($where = null) 
    { 
        return $this->where($where)->findAll(); 
    } 
 
    public function cekUserAccess($where = null) 
    { 
        $db = \Config\Database::connect();
        $builder = $db->table('access_menu');
        return $builder->where($where)->get()->getResult();
    } 
    public function getUserLimit() 
    { 
        $db = \Config\Database::connect();
        $builder = $db->table('user');
        return $builder->limit(10, 0)->get()->getResult();
    } 
} 