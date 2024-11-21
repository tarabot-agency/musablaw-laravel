<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ArticleController extends Controller
{
    use GeneralTrait;

    public function index(Request $request)
    {
        try {
            $articles = Page::where('section', 'article')->orderBy('id', 'DESC')
                ->paginate(15);
            return view('Admin.Article.index', compact('articles'));
        } catch (\Exception $e) {
            return view('general-error');
        }
    }
    public function show($id)
    {
        $article = Page::where('section', 'article')->where('id', $id)->first();
        if (!$article) {
            return view('general-error');
        }
        return view("Admin.Article.show", compact("article"));
    }
    public function create()
    {
        try {
            return view('Admin.Article.create');
        } catch (\Exception $e) {
            return view('general-error');
        }
    }

    public function store(Request $request)
    {
        try {
            $website_lang = Setting('website_language');
            $page_key = '';
            if ($website_lang == 'ar') {
                $validator = Validator::make($request->all(), [
                    'title_ar' => 'required',
                    'description_ar' => 'required',
                ]);
                $page_key = rand(100000, 999999);
            } elseif ($website_lang == 'en') {
                $validator = Validator::make($request->all(), [
                    'title_en' => 'required',
                    'description_en' => 'required',
                ]);
                $page_key = create_page_key($request->title_en);
            } else {
                $validator = Validator::make($request->all(), [
                    'title_ar' => 'required',
                    'title_en' => 'required',
                    'description_ar' => 'required',
                    'description_en' => 'required',
                ]);
                $page_key = create_page_key($request->title_en);
            }
            if ($validator->fails()) {
                Session::flash('message',  $validator->errors()->first());
                Session::flash('alert-class', 'alert-danger');
                return redirect()->back()->withInput();
            }
            DB::beginTransaction();
            $article = new Page();
            $article->section = 'article';
            $article->key = $page_key;
            $article->title_en = $request->title_en;
            $article->title_ar = $request->title_ar;
            $article->description_en = $request->description_en;
            $article->description_ar = $request->description_ar;
            if ($request->hasFile('image')) {
                $image = $this->saveImage($request->image, 'articles');
                $article->image = $image;
            }
            $article->save();
            if (isset($request->supSections)) {
                foreach ($request->supSections as $sub_section) {
                    $article->subPages()->create([
                        'content_en' => $sub_section['content_en'] ?? null,
                        'content_ar' => $sub_section['content_ar'] ?? null
                    ]);
                }
            }
            if (isset($request->secondary_images)) {
                foreach ($request->secondary_images as $secondary_image) {
                    $image = $this->saveImage($secondary_image, 'secondary_images');
                    $article->secondaryImages()->create([
                        'image' => $image
                    ]);
                }
            }
            Session::flash('message', __('app.article') . ' ' . __('app.added_successfully'));
            Session::flash('alert-class', 'alert-success');
            DB::commit();
            return redirect()->route('articles.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return view('general-error');
        }
    }


    public function edit($id)
    {
        $article =  Page::where('section', 'article')->where('id', $id)->first();
        if (!$article) {
            return view('general-error');
        }
        return view("Admin.Article.edit", compact("article"));
    }

    public function update($id, Request $request)
    {
        try {
            $article =  Page::where('section', 'article')->where('id', $id)->first();
            if (!$article) {
                return view('general-error');
            }
            $website_lang = Setting('website_language');
            if ($website_lang == 'ar') {
                $validator = Validator::make($request->all(), [
                    'title_ar' => 'required',
                    'description_ar' => 'required',
                ]);
            } elseif ($website_lang == 'en') {
                $validator = Validator::make($request->all(), [
                    'title_en' => 'required',
                    'description_en' => 'required',
                ]);
            } else {
                $validator = Validator::make($request->all(), [
                    'title_ar' => 'required',
                    'title_en' => 'required',
                    'description_ar' => 'required',
                    'description_en' => 'required',
                ]);
            }
            if ($validator->fails()) {
                Session::flash('message',  $validator->errors()->first());
                Session::flash('alert-class', 'alert-danger');
                return redirect()->back()->withInput();
            }
            DB::beginTransaction();
            $article->update([
                'title_ar' => $request->title_ar ?? $article->title_ar,
                'title_en' => $request->title_en ?? $article->title_en,
                'description_ar' => $request->description_ar ?? $article->description_ar,
                'description_en' => $request->description_en ?? $article->description_en
            ]);
            if ($request->hasFile('image')) {
                $image = $this->saveImage($request->image, 'articles');
                $article->update([
                    'image' => $image
                ]);
            }
            if (isset($request->supSections)) {
                $article->subPages()->delete();
                foreach ($request->supSections as $sub_section) {
                    $article->subPages()->create([
                        'content_en' => $sub_section['content_en'] ?? null,
                        'content_ar' => $sub_section['content_ar'] ?? null
                    ]);
                }
            }
            if (isset($request->secondary_images)) {
                $article->secondaryImages()->delete();
                foreach ($request->secondary_images as $secondary_image) {
                    $image = $this->saveImage($secondary_image, 'secondary_images');
                    $article->secondaryImages()->create([
                        'image' => $image
                    ]);
                }
            }
            Session::flash('message', __('app.article') . ' ' . __('app.updated_successfully'));
            Session::flash('alert-class', 'alert-success');
            DB::commit();
            return redirect()->route('article.show', $id);
        } catch (\Exception $e) {
            DB::rollback();
            return view('general-error');
        }
    }

    public function delete($id)
    {
        try {
            DB::beginTransaction();
            $article =  Page::where('section', 'article')->where('id', $id)->first();
            if (!$article) {
                Session::flash('message', __('app.article') . '' .  __('app.is_not_exist'));
                Session::flash('alert-class', 'alert-danger');
                return redirect()->route('article.index');
            }
            $filePath = public_path('images/articles/' . $article->image);
            if (File::exists($filePath)) {
                File::delete($filePath);
            }
            $article->subPages()->delete();
            $article->secondaryImages()->delete();
            $article->delete();
            Session::flash('message', __('app.article') . ' ' . __('app.deleted_successfully'));
            Session::flash('alert-class', 'alert-success');
            DB::commit();
            return redirect()->route('articles.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return view('general-error');
        }
    }
}
