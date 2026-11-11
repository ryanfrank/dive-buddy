<?php

namespace App\Controllers;

use App\Models\RatingModel;
use App\Models\DiveModel;
use App\Models\UserModel;

class Rating extends BaseController
{
    public function create(int $diveId)
    {
        if (!session()->get('is_logged_in')) {
            return redirect()->to('/login');
        }
        $diveModel = new DiveModel();
        $dive = $diveModel->getDiveWithSite($diveId);
        if (!$dive) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $participants = $diveModel->getParticipants($diveId);
        // Filter out the current user
        $partners = array_filter($participants, fn($p) => $p['user_id'] !== session()->get('user_id'));

        return view('rating/create', [
            'title' => lang('Rating.rate_partner'),
            'dive' => $dive,
            'partners' => array_values($partners),
        ]);
    }

    public function store()
    {
        if (!session()->get('is_logged_in')) {
            return redirect()->to('/login');
        }

        $rules = [
            'dive_id'       => 'required|integer',
            'rated_user_id' => 'required|integer',
            'rating'        => 'required|integer|greater_than[0]|less_than[6]',
            'comment'       => 'permit_empty|max_length[1000]',
        ];
        if (!$this->validate($rules)) {
            return redirect()->back()->with('errors', $this->validator->getErrors())->withInput();
        }

        $ratingModel = new RatingModel();
        if ($ratingModel->hasRated(
            $this->request->getPost('dive_id'),
            $this->request->getPost('rated_user_id'),
            session()->get('user_id')
        )) {
            return redirect()->back()->with('error', lang('Rating.already_rated'));
        }

        $ratingModel->save([
            'dive_id' => $this->request->getPost('dive_id'),
            'rated_user_id' => $this->request->getPost('rated_user_id'),
            'rating_user_id' => session()->get('user_id'),
            'rating' => $this->request->getPost('rating'),
            'comment' => $this->request->getPost('comment'),
        ]);

        return redirect()->to('/dives/' . $this->request->getPost('dive_id'))
            ->with('success', lang('Rating.rating_saved'));
    }

    public function view(int $id)
    {
        $ratingModel = new RatingModel();
        $rating = $ratingModel->find($id);
        if (!$rating) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('rating/view', [
            'title' => lang('Rating.rating_details'),
            'rating' => $rating,
        ]);
    }
}
