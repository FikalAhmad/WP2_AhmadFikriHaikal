<?php

namespace App\Models;

use CodeIgniter\Model;


class ModelBuku extends Model
{
    protected $table            = 'buku';
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
    
    //manajemen buku 
    public function getBuku() 
    { 
        return $this->findAll(); 
    } 

    public function bukuWhere($where) 
    { 
        return $this->where($where)->findAll(); 
    } 

    public function simpanBuku($data = null) 
    { 
        return $this->insert($data); 
    } 
    
    public function updateBuku($data = null, $where = null) 
    { 
        return $this->update($where, $data); 
    } 
    
    public function hapusBuku($where = null) 
    { 
        return $this->delete($where); 
    } 
    
    public function total($field, $where) 
    { 
        $this->selectSum($field);
        if(!empty($where) && count($where) > 0){
            $this->where($where);
        }
        return $this->$field ?? 0;
    } 
    
    //manajemen kategori 
    public function getKategori() 
    { 
        $db = \Config\Database::connect();
        return $db->table('kategori')->get()->getResult(); 
    } 
    
    public function kategoriWhere($where) 
    { 
        $db = \Config\Database::connect();
        return $db->table('kategori')->where($where)->get()->getResult(); 
    } 
    
    public function simpanKategori($data = null) 
    { 
        $db = \Config\Database::connect();
        return $db->table('kategori')->insert($data); 
    } 

    public function hapusKategori($where = null) 
    { 
        $db = \Config\Database::connect();
        return $db->table('kategori')->delete($where); 
    } 

    public function updateKategori($where = null, $data = null) 
    {
        $db = \Config\Database::connect();
        return $db->table('kategori')->update($data, $where); 
    } 

    //join 
    public function joinKategoriBuku($where) 
    { 
        return $this->select('buku.id_kategori,kategori.kategori')
                    ->join('kategori','kategori.id = buku.id_kategori')
                    ->where($where)
                    ->findAll(); 
    } 
}
