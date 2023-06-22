<?php

namespace App\Http\Controllers;

use App\Models\StatsDomain;
use App\Statistics\CardStatistics;
use App\Statistics\PluginCount;
use App\Statistics\ProjectCount;
use App\Statistics\UniqueDomains;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }
}
