<?php

namespace App\Controllers;

use App\Models\DiveModel;
use App\Models\DiveSiteModel;

class Home extends BaseController
{
    public function index()
    {
        $diveModel = new DiveModel();
        $siteModel = new DiveSiteModel();

        $data = [
            'title' => lang('Home.welcome'),
            'recentDives' => $diveModel->getPublicDives(6),
            'diveSites' => $siteModel->getAllSites(),
        ];

        return view('home/index', $data);
    }

    public function about()
    {
        return view('home/about', ['title' => lang('Home.about')]);
    }
}
