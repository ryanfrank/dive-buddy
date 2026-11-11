<?php

namespace App\Models;

use CodeIgniter\Model;

class DiveModel extends Model
{
    protected $table = 'dives';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'user_id', 'dive_site_id', 'dive_date', 'max_depth',
        'bottom_time', 'visibility', 'conditions', 'notes', 'is_public',
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $validationRules = [
        'user_id'      => 'required|integer',
        'dive_date'    => 'required|valid_date',
        'max_depth'    => 'permit_empty|decimal',
        'bottom_time'  => 'permit_empty|integer',
        'visibility'   => 'permit_empty|decimal',
        'conditions'   => 'permit_empty|max_length[100]',
        'notes'        => 'permit_empty|max_length[2000]',
    ];

    public function getDiveWithSite(int $diveId): ?array
    {
        return $this->select('dives.*, dive_sites.name as site_name, dive_sites.location as site_location, dive_sites.country as site_country')
            ->join('dive_sites', 'dive_sites.id = dives.dive_site_id', 'left')
            ->where('dives.id', $diveId)
            ->first();
    }

    public function getUserDives(int $userId): array
    {
        return $this->select('dives.*, dive_sites.name as site_name, dive_sites.location as site_location')
            ->join('dive_sites', 'dive_sites.id = dives.dive_site_id', 'left')
            ->where('dives.user_id', $userId)
            ->orderBy('dives.dive_date', 'DESC')
            ->findAll();
    }

    public function getPublicDives(int $limit = 20, int $offset = 0): array
    {
        return $this->select('dives.*, users.name as user_name, dive_sites.name as site_name')
            ->join('users', 'users.id = dives.user_id', 'inner')
            ->join('dive_sites', 'dive_sites.id = dives.dive_site_id', 'left')
            ->where('dives.is_public', true)
            ->orderBy('dives.dive_date', 'DESC')
            ->limit($limit, $offset)
            ->findAll();
    }

    public function getParticipants(int $diveId): array
    {
        return $this->db->table('dive_participants dp')
            ->select('dp.*, u.name, u.certification_level, u.profile_image')
            ->join('users u', 'u.id = dp.user_id', 'inner')
            ->where('dp.dive_id', $diveId)
            ->get()
            ->getResultArray();
    }

    public function getRatings(int $diveId): array
    {
        return $this->db->table('ratings r')
            ->select('r.*, u.name as rated_name, ru.name as rating_user_name')
            ->join('users u', 'u.id = r.rated_user_id', 'inner')
            ->join('users ru', 'ru.id = r.rating_user_id', 'inner')
            ->where('r.dive_id', $diveId)
            ->orderBy('r.created_at', 'DESC')
            ->get()
            ->getResultArray();
    }
}
