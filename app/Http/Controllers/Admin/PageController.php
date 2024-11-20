<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PageController extends Controller
{
    use GeneralTrait;
    public function show($key)
    {
        $page = Page::where('key', $key)->first();
        if (!$page) {
            return view('general-error');
        }
        return view("Admin.Page.show", compact("page"));
    }

    public function edit($key)
    {
        $page = Page::where('key', $key)->first();
        if (!$page) {
            return view('general-error');
        }
        return view("Admin.Page.edit", compact("page"));
    }

    public function update($key, Request $request)
    {
        try {
            $page = Page::where('key', $key)->first();
            if (!$page) {
                return view('general-error');
            }
            DB::beginTransaction();
            $page->update([
                'title_en' => $request->title_en,
                'title_ar' => $request->title_ar,
                'description_en' => $request->description_en,
                'description_ar' => $request->description_ar,
                'icon' => $request->icon
            ]);
            if ($request->hasFile('image')) {
                $image = $this->saveImage($request->image, 'pages');
                $page->update([
                    'image' => $image
                ]);
            }
            $page->subPages()->delete();
            if (isset($request->supSections)) {
                foreach ($request->supSections as $sub_section) {
                    $page->subPages()->create([
                        'content_en' => $sub_section['content_en'] ?? null,
                        'content_ar' => $sub_section['content_ar'] ?? null
                    ]);
                }
            }
            Session::flash('message', __('app.page') . ' ' . __('app.updated_successfully'));
            Session::flash('alert-class', 'alert-success');
            DB::commit();
            return redirect()->route('page.show', $key);
        } catch (\Exception $e) {
            DB::rollback();
            return view('general-error');
        }
    }
}
