<?php

namespace App\Models;

use CodeIgniter\Model;

class DivePartnerModel extends Model
{
    protected $table = 'dive_participants';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'dive_id', 'user_id', 'role',
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function getUserDiveHistory(int $userId): array
    {
        return $this->db->table('dive_participants dp')
            ->select('dp.*, d.dive_date, ds.name as site_name, ds.location as site_location')
            ->join('dives d', 'd.id = dp.dive_id', 'inner')
            ->join('dive_sites ds', 'ds.id = d.dive_site_id', 'left')
            ->where('dp.user_id', $userId)
            ->orderBy('d.dive_date', 'DESC')
            ->get()
            ->getResultArray();
    }

    public function findPotentialPartners(string $location, int $excludeUserId): array
    {
        return $this->db->table('users u')
            ->select('u.*, AVG(r.rating) as avg_rating, COUNT(r.id) as rating_count')
            ->join('ratings r', 'r.rated_user_id = u.id', 'left')
            ->where('u.location LIKE', '%' . $location . '%')
            ->where('u.id !=', $excludeUserId)
            ->where('u.is_active', true)
            ->groupBy('u.id')
            ->orderBy('avg_rating', 'DESC')
            ->get()
            ->getResultArray();
    }

    public function addParticipant(int $diveId, int $userId, string $role = 'participant'): bool
    {
        $existing = $this->db->table('dive_participants')
            ->where('dive_id', $diveId)
            ->where('user_id', $userId)
            ->countAllResults();
        if ($existing > 0) {
            return false;
        }
        return (bool) $this->insert([
            'dive_id' => $diveId,
            'user_id' => $userId,
            'role' => $role,
        ]);
    }
}
