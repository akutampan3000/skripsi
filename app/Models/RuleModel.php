<?php namespace App\Models;

use CodeIgniter\Model;

class RuleModel extends Model
{
    protected $table = 'rules';
    
    public function getRecommendations(array $gejalaIds)
    {
        return $this->db->table('rules')
            ->select('spareparts.*')
            ->join('spareparts', 'spareparts.id = rules.sparepart_id')
            ->whereIn('rules.gejala_ids', [implode(',', $gejalaIds)])
            ->get()
            ->getResultArray();
    }
}