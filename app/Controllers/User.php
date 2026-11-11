<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\DiveModel;

class User extends BaseController
{
    public function profile()
    {
        if (!session()->get('is_logged_in')) {
            return redirect()->to('/login');
        }
        $userModel = new UserModel();
        $diveModel = new DiveModel();

        $userId = session()->get('user_id');
        $user = $userModel->find($userId);
        $stats = $userModel->getDiveStats($userId);
        $recentDives = $diveModel->getUserDives($userId);

        return view('user/profile', [
            'title' => lang('User.profile'),
            'user' => $user,
            'stats' => $stats,
            'recentDives' => $recentDives,
        ]);
    }

    public function edit()
    {
        if (!session()->get('is_logged_in')) {
            return redirect()->to('/login');
        }
        $userModel = new UserModel();
        $user = $userModel->find(session()->get('user_id'));

        return view('user/edit', [
            'title' => lang('User.edit_profile'),
            'user' => $user,
        ]);
    }

    public function update()
    {
        if (!session()->get('is_logged_in')) {
            return redirect()->to('/login');
        }

        $rules = [
            'name'                => 'required|min_length[2]|max_length[100]',
            'location'            => 'permit_empty|max_length[255]',
            'certification_level' => 'permit_empty|max_length[50]',
            'bio'                 => 'permit_empty|max_length[1000]',
        ];
        if (!$this->validate($rules)) {
            return redirect()->back()->with('errors', $this->validator->getErrors())->withInput();
        }

        $userModel = new UserModel();
        $userModel->update(session()->get('user_id'), [
            'name' => $this->request->getPost('name'),
            'location' => $this->request->getPost('location'),
            'certification_level' => $this->request->getPost('certification_level'),
            'bio' => $this->request->getPost('bio'),
        ]);

        session()->set('user_name', $this->request->getPost('name'));

        return redirect()->to('/user/profile')->with('success', lang('User.profile_updated'));
    }

    public function dives()
    {
        if (!session()->get('is_logged_in')) {
            return redirect()->to('/login');
        }
        $diveModel = new DiveModel();
        $dives = $diveModel->getUserDives(session()->get('user_id'));

        return view('user/dives', [
            'title' => lang('User.my_dives'),
            'dives' => $dives,
        ]);
    }
}
