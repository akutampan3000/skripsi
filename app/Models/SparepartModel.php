<?php namespace App\Models;

use CodeIgniter\Model;

class SparepartModel extends Model 
{
    protected $table = 'spareparts';
    protected $allowedFields = ['name', 'description', 'problem_type', 'category', 'performance_level', 'brands', 'related_symptoms', 'compatibility_score'];

    public function getRecommendation($ruleId, $brand, $problemType)
    {
        $sparepart = $this->where('problem_type', $problemType)
                         ->where("JSON_CONTAINS(related_symptoms, '\"$ruleId\"')")
                         ->first();
        
        if (!$sparepart) {
            return null;
        }

        $brands = json_decode($sparepart['brands'], true);
        
        return [
            'name' => $sparepart['name'],
            'description' => $sparepart['description'],
            'brands' => $brands[$brand] ?? []
        ];
    }

    public function getTotalSparepart()
    {
        return $this->countAll();
    }
}