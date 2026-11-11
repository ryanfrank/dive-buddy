<?php

namespace App\Models;

use CodeIgniter\Model;

class RatingModel extends Model
{
    protected $table = 'ratings';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'dive_id', 'rated_user_id', 'rating_user_id', 'rating', 'comment',
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $validationRules = [
        'dive_id'       => 'required|integer',
        'rated_user_id' => 'required|integer',
        'rating'        => 'required|integer|greater_than[0]|less_than[6]',
        'comment'       => 'permit_empty|max_length[1000]',
    ];

    public function hasRated(int $diveId, int $ratedUserId, int $ratingUserId): bool
    {
        return (bool) $this->where('dive_id', $diveId)
            ->where('rated_user_id', $ratedUserId)
            ->where('rating_user_id', $ratingUserId)
            ->countAllResults();
    }

    public function getUserRatings(int $userId): array
    {
        return $this->where('rated_user_id', $userId)
            ->orderBy('created_at', 'DESC')
            ->findAll();
    }

    public function getAverageRating(int $userId): ?float
    {
        $row = $this->select('AVG(rating) as avg_rating, COUNT(*) as count')
            ->where('rated_user_id', $userId)
            ->get()
            ->getRow();
        if (!$row || $row->count == 0) {
            return null;
        }
        return round((float) $row->avg_rating, 2);
    }
}
