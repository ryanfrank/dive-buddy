<?php

namespace App\Controllers;

use App\Models\DivePartnerModel;
use App\Models\UserModel;

class DivePartner extends BaseController
{
    public function index()
    {
        if (!session()->get('is_logged_in')) {
            return redirect()->to('/login');
        }
        $partnerModel = new DivePartnerModel();
        $userModel = new UserModel();

        $userId = session()->get('user_id');
        $user = $userModel->find($userId);
        $history = $partnerModel->getUserDiveHistory($userId);

        // Find potential partners in same location
        $potential = [];
        if ($user['location']) {
            $potential = $partnerModel->findPotentialPartners($user['location'], $userId);
        }

        return view('dive-partner/index', [
            'title' => lang('DivePartner.find_partners'),
            'history' => $history,
            'potential' => $potential,
            'user' => $user,
        ]);
    }

    public function connect(int $diveId)
    {
        if (!session()->get('is_logged_in')) {
            return redirect()->to('/login');
        }
        $partnerModel = new DivePartnerModel();
        $partnerModel->addParticipant($diveId, session()->get('user_id'));

        return redirect()->to('/dives/' . $diveId)->with('success', lang('DivePartner.joined_dive'));
    }
}
