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
        $this->insert($data);
    } 
 
    public function cekData($where) 
    { 
        return $this->where('email',$where)->first(); 
    } 
    
    public function getUserWhere($where = null) 
    { 
        return $this->where($where); 
    } 
 
    public function cekUserAccess($where = null) 
    { 
        return $this->select('*')->table('access-menu')->where($where);
    } 
    public function getUserLimit() 
    { 
        return $this->limit(10)->findAll();
    } 
} 