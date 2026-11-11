<?php

namespace App\Models;

use CodeIgniter\Model;

class DiveSiteModel extends Model
{
    protected $table = 'dive_sites';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'name', 'location', 'country', 'latitude', 'longitude',
        'description', 'max_depth', 'difficulty', 'water_type', 'best_season',
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $validationRules = [
        'name'        => 'required|min_length[2]|max_length[255]',
        'location'    => 'required|max_length[255]',
        'country'     => 'required|max_length[100]',
        'description' => 'permit_empty|max_length[2000]',
        'difficulty'  => 'permit_empty|max_length[50]',
    ];

    public function getAllSites(): array
    {
        return $this->orderBy('name', 'ASC')->findAll();
    }

    public function search(string $query): array
    {
        return $this->like('name', $query)
            ->orLike('location', $query)
            ->orLike('country', $query)
            ->orderBy('name', 'ASC')
            ->findAll();
    }

    public function getSiteWithStats(int $siteId): ?array
    {
        $site = $this->find($siteId);
        if (!$site) {
            return null;
        }
        $db = db_connect();
        $diveCount = $db->table('dives')->where('dive_site_id', $siteId)->countAllResults();
        $site['dive_count'] = (int) $diveCount;
        return $site;
    }
}
