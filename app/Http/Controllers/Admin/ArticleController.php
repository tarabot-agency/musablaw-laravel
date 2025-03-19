<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\PagePreview;
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
                    'slug' => 'required|unique:pages,slug',
                    'show_at' => 'required',
                    'meta_description' => 'required',
                    'title_ar' => 'required',
                    'meta_title' => 'required',
                    'description_ar' => 'required',
                ]);
                $page_key = rand(100000, 999999);
            } elseif ($website_lang == 'en') {
                $validator = Validator::make($request->all(), [
                    'slug' => 'required|unique:pages,slug',
                    'show_at' => 'required',
                    'meta_description' => 'required',
                    'title_en' => 'required',
                    'description_en' => 'required',
                    'meta_title' => 'required',
                ]);
                $page_key = create_page_key($request->title_en);
            } else {
                $validator = Validator::make($request->all(), [
                    'slug' => 'required|unique:pages,slug',
                    'show_at' => 'required',
                    'meta_description' => 'required',
                    'title_ar' => 'required',
                    'title_en' => 'required',
                    'description_ar' => 'required',
                    'description_en' => 'required',
                    'meta_title' => 'required',
                ]);
                $page_key = create_page_key($request->title_en);
            }
            if ($validator->fails()) {
                Session::flash('message', $validator->errors()->first());
                Session::flash('alert-class', 'alert-danger');
                return redirect()->back()->withInput();
            }
            DB::beginTransaction();
            $article = new Page();
            $article->section = 'article';
            $article->key = $page_key;
            $article->slug = $request->slug;
            $article->meta_description = $request->meta_description;
            $article->title_en = $request->title_en;
            $article->title_ar = $request->title_ar;
            $article->meta_title = $request->meta_title;
            $article->description_en = $request->description_en;
            $article->description_ar = $request->description_ar;
            $article->show_at = $request->show_at;
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
            if (isset($request->subArticles)) {
                foreach ($request->subArticles as $sub_article) {
                    $image = isset($sub_article['image']) ? $this->saveImage($sub_article['image'], 'articles') : '';
                    $article->subArticles()->create([
                        'article_id' => $article->id,
                        'title' => $sub_article['title'],
                        'sub_title' => $sub_article['sub_title'],
                        'description_ar' => $sub_article['description_ar'] ?? null,
                        'image' => $image,
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
        $article = Page::where('section', 'article')->where('id', $id)->first();
        if (!$article) {
            return view('general-error');
        }
        return view("Admin.Article.edit", compact("article"));
    }

    public function update($id, Request $request)
    {
        try {
            $article = Page::where('section', 'article')->where('id', $id)->first();
            if (!$article) {
                return view('general-error');
            }
            $website_lang = Setting('website_language');
            if ($website_lang == 'ar') {
                $validator = Validator::make($request->all(), [
                    'slug' => 'required',
                    'show_at' => 'required',
                    'meta_description' => 'required',
                    'title_ar' => 'required',
                    'description_ar' => 'required',
                    'meta_title' => 'required',
                ]);
            } elseif ($website_lang == 'en') {
                $validator = Validator::make($request->all(), [
                    'slug' => 'required',
                    'show_at' => 'required',
                    'meta_description' => 'required',
                    'title_en' => 'required',
                    'description_en' => 'required',
                    'meta_title' => 'required',
                ]);
            } else {
                $validator = Validator::make($request->all(), [
                    'slug' => 'required',
                    'show_at' => 'required',
                    'meta_description' => 'required',
                    'title_ar' => 'required',
                    'title_en' => 'required',
                    'description_ar' => 'required',
                    'description_en' => 'required',
                    'meta_title' => 'required',
                ]);
            }
            if ($validator->fails()) {
                Session::flash('message', $validator->errors()->first());
                Session::flash('alert-class', 'alert-danger');
                return redirect()->back()->withInput();
            }
            DB::beginTransaction();
            $article->update([
                'slug' => $request->slug ?? $article->slug,
                'meta_description' => $request->meta_description ?? $article->meta_description,
                'show_at' => $request->show_at ?? $article->show_at,
                'title_ar' => $request->title_ar ?? $article->title_ar,
                'title_en' => $request->title_en ?? $article->title_en,
                'meta_title' => $request->meta_title ?? $article->meta_title,
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

            if (isset($request->subArticles)) {
                foreach ($request->subArticles as $sub_article) {
                    $sub_article_id = isset($sub_article['id']) && $sub_article['id'] > 0 ? $sub_article['id'] : null;

                    if ($sub_article_id) {

                        $sub_article_db = $article->subArticles()->where('id', $sub_article_id)->first();
                        if ($sub_article_db) {
                            $sub_article_db->update([
                                'title' => $sub_article['title'],
                                'sub_title' => $sub_article['sub_title'],
                                'description_ar' => $sub_article['description_ar'] ?? null,
                            ]);
                            if (isset($sub_article['image'])) {
                                $image = $this->saveImage($sub_article['image'], 'articles');
                                $sub_article_db->update([
                                    'image' => $image
                                ]);
                            }
                        }
                    } else {
                        $image = isset($sub_article['image']) ? $this->saveImage($sub_article['image'], 'articles') : '';
                        $article->subArticles()->create([
                            'article_id' => $article->id,
                            'title' => $sub_article['title'],
                            'sub_title' => $sub_article['sub_title'],
                            'description_ar' => $sub_article['description_ar'] ?? null,
                            'image' => $image,
                        ]);
                    }
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
            $article = Page::where('section', 'article')->where('id', $id)->first();
            if (!$article) {
                Session::flash('message', __('app.article') . '' . __('app.is_not_exist'));
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


    public function previewArticle(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'title_ar' => 'required',
                'description_ar' => 'required',
            ]);

            if ($validator->fails()) {
                return $this->returnError('422', $validator->errors());
            }
            DB::beginTransaction();
            PagePreview::truncate();
            $article = new PagePreview();
            $article->title = $request->title_ar;
            $article->description = $request->description_ar;
            if ($request->hasFile('image')) {
                $image = $this->saveImage($request->image, 'articles');
                $article->image = $image;
            }
            $article->save();
            if (isset($request->secondary_images)) {
                foreach ($request->secondary_images as $secondary_image) {
                    $image = $this->saveImage($secondary_image, 'secondary_images');
                    $article->secondaryImages()->create([
                        'image' => $image
                    ]);
                }
            }
            DB::commit();
            // return to the frontend design page (ANGULAR)
            return response()->json(['status' => 'success', 'message' => 'Article previewed successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->returnError('500', $e->getMessage());
        }
    }

    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;
            $request->file('upload')->move(public_path('media'), $fileName);
            $url = asset('media/' . $fileName);
            return response()->json(['fileName' => $fileName, 'uploaded' => 1, 'url' => $url]);
        }
    }
}
