<?php

namespace App\Models;

use CodeIgniter\Model;

class LocationModel extends Model
{
    protected $table = 'dive_sites';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'name', 'location', 'country', 'latitude', 'longitude',
    ];

    public function getCountries(): array
    {
        return $this->select('DISTINCT country')
            ->orderBy('country', 'ASC')
            ->findAll();
    }

    public function getSitesByCountry(string $country): array
    {
        return $this->where('country', $country)
            ->orderBy('name', 'ASC')
            ->findAll();
    }

    public function getNearby(float $latitude, float $longitude, int $radiusKm = 50): array
    {
        $db = db_connect();
        return $db->query(
            "SELECT *, 
             (6371 * acos(cos(radians(:lat)) * cos(radians(latitude)) * cos(radians(longitude) - radians(:lon)) + sin(radians(:lat)) * sin(radians(latitude)))) AS distance
             FROM dive_sites
             WHERE latitude IS NOT NULL AND longitude IS NOT NULL
             HAVING distance <= :radius
             ORDER BY distance",
            [':lat' => $latitude, ':lon' => $longitude, ':radius' => $radiusKm]
        )->getResultArray();
    }
}
