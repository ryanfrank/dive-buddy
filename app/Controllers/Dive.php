<?php

namespace App\Controllers;

use App\Models\DiveModel;
use App\Models\DiveSiteModel;
use App\Models\RatingModel;

class Dive extends BaseController
{
    public function index()
    {
        $diveModel = new DiveModel();
        $data = [
            'title' => lang('Dive.recent_dives'),
            'dives' => $diveModel->getPublicDives(20),
        ];
        return view('dive/list', $data);
    }

    public function view(int $id)
    {
        $diveModel = new DiveModel();
        $dive = $diveModel->getDiveWithSite($id);
        if (!$dive) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $participants = $diveModel->getParticipants($id);
        $ratings = $diveModel->getRatings($id);

        return view('dive/view', [
            'title' => lang('Dive.dive_details'),
            'dive' => $dive,
            'participants' => $participants,
            'ratings' => $ratings,
        ]);
    }

    public function create()
    {
        if (!session()->get('is_logged_in')) {
            return redirect()->to('/login');
        }
        $siteModel = new DiveSiteModel();
        return view('dive/create', [
            'title' => lang('Dive.log_dive'),
            'sites' => $siteModel->getAllSites(),
        ]);
    }

    public function store()
    {
        if (!session()->get('is_logged_in')) {
            return redirect()->to('/login');
        }

        $rules = [
            'dive_site_id' => 'permit_empty|integer',
            'dive_date'    => 'required|valid_date',
            'max_depth'    => 'permit_empty|decimal',
            'bottom_time'  => 'permit_empty|integer',
            'visibility'   => 'permit_empty|decimal',
            'conditions'   => 'permit_empty|max_length[100]',
            'notes'        => 'permit_empty|max_length[2000]',
        ];
        if (!$this->validate($rules)) {
            return redirect()->back()->with('errors', $this->validator->getErrors())->withInput();
        }

        $diveModel = new DiveModel();
        $diveModel->save([
            'user_id' => session()->get('user_id'),
            'dive_site_id' => $this->request->getPost('dive_site_id') ?: null,
            'dive_date' => $this->request->getPost('dive_date'),
            'max_depth' => $this->request->getPost('max_depth') ?: null,
            'bottom_time' => $this->request->getPost('bottom_time') ?: null,
            'visibility' => $this->request->getPost('visibility') ?: null,
            'conditions' => $this->request->getPost('conditions'),
            'notes' => $this->request->getPost('notes'),
            'is_public' => $this->request->getPost('is_public') ? true : false,
        ]);

        return redirect()->to('/user/dives')->with('success', lang('Dive.dive_logged'));
    }

    public function edit(int $id)
    {
        if (!session()->get('is_logged_in')) {
            return redirect()->to('/login');
        }
        $diveModel = new DiveModel();
        $dive = $diveModel->find($id);
        if (!$dive || $dive['user_id'] !== session()->get('user_id')) {
            return redirect()->to('/user/dives')->with('error', lang('Dive.not_found_or_unauthorized'));
        }

        $siteModel = new DiveSiteModel();
        return view('dive/edit', [
            'title' => lang('Dive.edit_dive'),
            'dive' => $dive,
            'sites' => $siteModel->getAllSites(),
        ]);
    }

    public function update(int $id)
    {
        if (!session()->get('is_logged_in')) {
            return redirect()->to('/login');
        }
        $diveModel = new DiveModel();
        $dive = $diveModel->find($id);
        if (!$dive || $dive['user_id'] !== session()->get('user_id')) {
            return redirect()->to('/user/dives')->with('error', lang('Dive.not_found_or_unauthorized'));
        }

        $diveModel->update($id, [
            'dive_site_id' => $this->request->getPost('dive_site_id') ?: null,
            'dive_date' => $this->request->getPost('dive_date'),
            'max_depth' => $this->request->getPost('max_depth') ?: null,
            'bottom_time' => $this->request->getPost('bottom_time') ?: null,
            'visibility' => $this->request->getPost('visibility') ?: null,
            'conditions' => $this->request->getPost('conditions'),
            'notes' => $this->request->getPost('notes'),
            'is_public' => $this->request->getPost('is_public') ? true : false,
        ]);

        return redirect()->to('/dives/' . $id)->with('success', lang('Dive.dive_updated'));
    }

    public function delete(int $id)
    {
        if (!session()->get('is_logged_in')) {
            return redirect()->to('/login');
        }
        $diveModel = new DiveModel();
        $dive = $diveModel->find($id);
        if (!$dive || $dive['user_id'] !== session()->get('user_id')) {
            return redirect()->to('/user/dives')->with('error', lang('Dive.not_found_or_unauthorized'));
        }

        $diveModel->delete($id);
        return redirect()->to('/user/dives')->with('success', lang('Dive.dive_deleted'));
    }
}
