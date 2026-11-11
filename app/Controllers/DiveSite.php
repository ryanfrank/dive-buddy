<?php

namespace App\Controllers;

use App\Models\DiveSiteModel;

class DiveSite extends BaseController
{
    public function index()
    {
        $siteModel = new DiveSiteModel();
        $query = $this->request->getGet('q');
        $sites = $query ? $siteModel->search($query) : $siteModel->getAllSites();

        return view('dive-site/index', [
            'title' => lang('DiveSite.dive_sites'),
            'sites' => $sites,
            'query' => $query,
        ]);
    }

    public function view(string $id)
    {
        $siteModel = new DiveSiteModel();
        $site = $siteModel->getSiteWithStats((int) $id);
        if (!$site) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('dive-site/view', [
            'title' => $site['name'],
            'site' => $site,
        ]);
    }
}
