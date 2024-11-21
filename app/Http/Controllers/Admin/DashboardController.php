<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use App\Models\Page;
use App\Models\Partener;
use App\Models\Project;

class DashboardController extends Controller
{
    public function index()
    {
        try {
            $our_services_count = Page::where('section', 'our_services')->count();
            $articles_count = Page::where('section', 'article')->count();
            $contact_uss_count = ContactUs::count();
            $parteners_count = Partener::count();
            return view(
                'Admin.Dashboard.index',
                compact(
                    'our_services_count',
                    'articles_count',
                    'contact_uss_count',
                    'parteners_count'
                )
            );
        } catch (\Exception $e) {
            return view('general-error');
        }
    }
}
