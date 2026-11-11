<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'email', 'password', 'oauth_provider', 'oauth_id', 'name',
        'location', 'bio', 'certification_level', 'profile_image',
        'is_active', 'is_admin', 'email_verified',
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $validationRules = [
        'email'               => 'required|valid_email|is_unique[users.email]',
        'password'            => 'required|min_length[8]',
        'name'                => 'required|min_length[2]|max_length[100]',
        'location'            => 'permit_empty|max_length[255]',
        'certification_level' => 'permit_empty|max_length[50]',
        'bio'                 => 'permit_empty|max_length[1000]',
    ];

    protected $validationMessages = [
        'email' => [
            'required' => 'An email address is required.',
            'valid_email' => 'Please enter a valid email address.',
            'is_unique' => 'This email is already registered.',
        ],
        'password' => [
            'required' => 'A password is required.',
            'min_length' => 'Password must be at least 8 characters.',
        ],
    ];

    protected $skipValidation = false;

    public function findByEmail(string $email): ?array
    {
        return $this->where('email', $email)->first();
    }

    public function findByOAuth(string $provider, string $oauthId): ?array
    {
        return $this->where('oauth_provider', $provider)
                    ->where('oauth_id', $oauthId)
                    ->first();
    }

    public function getActiveUsers(): array
    {
        return $this->where('is_active', true)->findAll();
    }

    public function getAdmins(): array
    {
        return $this->where('is_admin', true)->findAll();
    }

    public function getDiveStats(int $userId): array
    {
        $db = db_connect();
        $dives = $db->table('dives')
            ->where('user_id', $userId)
            ->countAllResults();
        $avgRating = $db->table('ratings')
            ->where('rated_user_id', $userId)
            ->select('AVG(rating) as avg_rating')
            ->get()
            ->getRow()->avg_rating;
        return [
            'total_dives' => (int) $dives,
            'average_rating' => $avgRating ? round((float) $avgRating, 2) : null,
        ];
    }
}
