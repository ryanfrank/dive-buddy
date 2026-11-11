<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\DiveSiteModel;
use App\Models\DiveModel;

class Admin extends BaseController
{
    public function dashboard()
    {
        if (!session()->get('is_admin')) {
            return redirect()->to('/user/profile')->with('error', lang('Auth.admin_required'));
        }
        $userModel = new UserModel();
        $diveModel = new DiveModel();
        $siteModel = new DiveSiteModel();

        return view('admin/dashboard', [
            'title' => lang('Admin.dashboard'),
            'userCount' => $userModel->countAllResults(),
            'diveCount' => $diveModel->countAllResults(),
            'siteCount' => $siteModel->countAllResults(),
            'recentUsers' => $userModel->orderBy('created_at', 'DESC')->limit(5)->findAll(),
        ]);
    }

    public function users()
    {
        if (!session()->get('is_admin')) {
            return redirect()->to('/user/profile')->with('error', lang('Auth.admin_required'));
        }
        $userModel = new UserModel();
        return view('admin/users', [
            'title' => lang('Admin.manage_users'),
            'users' => $userModel->getActiveUsers(),
        ]);
    }

    public function toggleAdmin(int $id)
    {
        if (!session()->get('is_admin')) {
            return redirect()->to('/user/profile')->with('error', lang('Auth.admin_required'));
        }
        $userModel = new UserModel();
        $user = $userModel->find($id);
        if (!$user) {
            return redirect()->to('/admin/users')->with('error', lang('Admin.user_not_found'));
        }
        $userModel->update($id, ['is_admin' => !$user['is_admin']]);
        return redirect()->to('/admin/users')->with('success', lang('Admin.admin_toggled'));
    }

    public function sites()
    {
        if (!session()->get('is_admin')) {
            return redirect()->to('/user/profile')->with('error', lang('Auth.admin_required'));
        }
        $siteModel = new DiveSiteModel();
        return view('admin/sites', [
            'title' => lang('Admin.manage_sites'),
            'sites' => $siteModel->getAllSites(),
        ]);
    }

    public function addSite()
    {
        if (!session()->get('is_admin')) {
            return redirect()->to('/user/profile')->with('error', lang('Auth.admin_required'));
        }
        return view('admin/add_site', ['title' => lang('Admin.add_site')]);
    }

    public function storeSite()
    {
        if (!session()->get('is_admin')) {
            return redirect()->to('/user/profile')->with('error', lang('Auth.admin_required'));
        }
        $siteModel = new DiveSiteModel();
        if (!$this->validate($siteModel->validationRules)) {
            return redirect()->back()->with('errors', $this->validator->getErrors())->withInput();
        }
        $siteModel->save([
            'name' => $this->request->getPost('name'),
            'location' => $this->request->getPost('location'),
            'country' => $this->request->getPost('country'),
            'description' => $this->request->getPost('description'),
            'difficulty' => $this->request->getPost('difficulty'),
        ]);
        return redirect()->to('/admin/sites')->with('success', lang('Admin.site_added'));
    }

    public function config()
    {
        if (!session()->get('is_admin')) {
            return redirect()->to('/user/profile')->with('error', lang('Auth.admin_required'));
        }
        return view('admin/config', ['title' => lang('Admin.site_config')]);
    }

    public function updateConfig()
    {
        if (!session()->get('is_admin')) {
            return redirect()->to('/user/profile')->with('error', lang('Auth.admin_required'));
        }
        return redirect()->to('/admin/config')->with('success', lang('Admin.config_updated'));
    }
}
