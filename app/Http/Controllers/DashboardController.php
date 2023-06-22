<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        $user = Auth::user();
        $complaints = $user->isAdmin() ? Complaint::all() : $user->complaints;

        return view('dashboard', [
            'complaints' => $complaints
        ]);
    }
}
