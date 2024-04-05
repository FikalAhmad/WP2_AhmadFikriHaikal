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
    protected $allowedFields    = ['judul_buku', 'id_kategori', 'pengarang', 'penerbit', 'tahun_terbit', 'isbn', 'stok', 'dipinjam', 'dibooking', 'image'];

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
        return $this->where($where)->find(); 
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
    
    public function total($field, $where = null) 
    { 
        $this->selectSum($field);
        if(!empty($where)){
            $this->where($where);
        }
        return $this->get()->getRow($field);
    } 
    
    //manajemen kategori 
    public function getKategori() 
    {   
        $query = $this->db->table('kategori')->get();
        return $query->getResultArray();
    } 
    
    public function kategoriWhere($where) 
    { 
        $query = $this->db->table('kategori')->where($where)->get();
        return $query->getResultArray(); 
    } 
    
    public function simpanKategori($data = null) 
    { 
        return $this->db->table('kategori')->insert($data); 
    } 

    public function hapusKategori($where = null) 
    { 
        return $this->db->table('kategori')->delete($where); 
    } 

    public function updateKategori($where = null, $data = null) 
    {
        return $this->db->table('kategori')->update($data, $where); 
    } 

    //join 
    public function joinKategoriBuku($where) 
    { 
        return $this->select('buku.id_kategori, kategori.nama_kategori')->join('kategori','kategori.id_kategori = buku.id_kategori')->where($where)->findAll(); 
    } 
}
