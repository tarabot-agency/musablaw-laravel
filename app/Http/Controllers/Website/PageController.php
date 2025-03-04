<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Models\Experience;
use App\Models\Page;
use App\Models\Partener;
use App\Models\Project;
use App\Models\Slider;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class PageController extends Controller
{
    use GeneralTrait;
    public function home(Request $request)
    {
        try {
            $lang = $request->header('lang');
            if (!$lang || ($lang != 'en' && $lang != 'ar'))
                return $this->returnError('400', 'lang is required');

            $content['sliders'] = Slider::get()->map(function ($slider) use ($lang) {
                $image = asset('images/sliders/' . ($lang == 'en' ? $slider->image_en : $slider->image_ar));
                return [
                    'id' => $slider->id,
                    'image' => $image
                ];
            });
            $content['about_us'] = Page::select(
                'id',
                'title_' . $lang . ' as title',
                'description_' . $lang . ' as description',
                'image'
            )
                ->where('key', 'about_us')
                ->first();

            $content['about_us_video'] = Page::select(
                'id',
                'title_en as url',
                'title_ar as title',
                'description_' . $lang . ' as description',
                'image'
            )
                ->where('key', 'about_us_video')
                ->first();
            $content['about_us']->image = asset('images/pages/' . $content['about_us']->image);

            $content['our_services'] = Page::select(
                'id',
                'icon',
                'title_' . $lang . ' as title',
                'image'
            )
                ->where('section', 'our_services')
                ->take(7)
                ->get()->map(function ($page) {
                    $page->image = $page->image ? asset('images/pages/' . $page->image) : '';
                    return $page;
                });

            $content['our_partners'] = Partener::get()->map(function ($partener) {
                $image =  $partener->image ? asset('images/parteners/' . $partener->image) : null;
                return [
                    'id' => $partener->id,
                    'image' => $image,
                    'name' => $partener->name,
                ];
            });

            $content['our_mission'] = Page::select(
                'id',
                'title_' . $lang . ' as title',
                'description_' . $lang . ' as description',
                'image'
            )
                ->where('key', 'our_mission')
                ->first();
            $content['our_mission']->image = asset('images/pages/' . $content['our_mission']->image);


            $content['our_vision'] = Page::select(
                'id',
                'title_' . $lang . ' as title',
                'description_' . $lang . ' as description',
                'image'
            )
                ->where('key', 'our_vision')
                ->first();
            $content['our_vision']->image = asset('images/pages/' . $content['our_vision']->image);

            $content['our_targets'] = Page::select(
                'id',
                'title_' . $lang . ' as title',
                'description_' . $lang . ' as description',
                'image'
            )
                ->where('key', 'our_targets')
                ->first();
            $content['our_targets']->image = asset('images/pages/' . $content['our_targets']->image);

            $content['static_slider_image'] = asset('images/settings/' . Setting('static_slider_' . $lang));
            return $this->returnData('data', $content);
        } catch (\Exception $e) {
            return $this->returnError($e->getCode(), $e->getMessage());
        }
    }

    public function AboutUs(Request $request)
    {
        try {
            $lang = $request->header('lang');
            if (!$lang || ($lang != 'en' && $lang != 'ar'))
                return $this->returnError('400', 'lang is required');
            $content['content'] = Page::with('subPages')->select(
                'id',
                'title_' . $lang . ' as title',
                'description_' . $lang . ' as description',
                'image'
            )
                ->where('section', 'about_us')
                ->get()->map(function ($page) use ($lang) {
                    $page->subPages = $page->subPages->map(function ($subPage) use ($lang) {
                        $content = null;
                        if ($lang == 'en') {
                            $content = $subPage->content_en;
                        } elseif ($lang == 'ar') {
                            $content = $subPage->content_ar;
                        }
                        return [
                            'id' => $subPage->id,
                            'content' => $content,
                        ];
                    });
                    unset($page->sub_pages);
                    $page->image = $page->image ? asset('images/pages/' . $page->image) : '';
                    return $page;
                });
            $content['certificates'] =  Certificate::get()->map(function ($certificate) {
                $image = $certificate->image ? asset('images/certificates/' . $certificate->image) : null;
                return [
                    'id' => $certificate->id,
                    'image' => $image,
                    'name' => $certificate->name,
                ];
            });

            $content['experiences'] =  Experience::get()->map(function ($experience) {
                $image = $experience->image ? asset('images/experiences/' . $experience->image) : null;
                return [
                    'id' => $experience->id,
                    'image' => $image,
                    'name' => $experience->name,
                ];
            });
            return $this->returnData('data', $content);
        } catch (\Exception $e) {
            return $this->returnError($e->getCode(), $e->getMessage());
        }
    }

    public function ourServices(Request $request)
    {
        try {
            $lang = $request->header('lang');
            if (!$lang || ($lang != 'en' && $lang != 'ar'))
                return $this->returnError('400', 'lang is required');
            $content = Page::select(
                'id',
                'icon',
                'title_' . $lang . ' as title',
                'image'
            )
                ->whereNotNull('title_' . $lang)
                ->whereNotNull('description_' . $lang)
                ->where('section', 'our_services')
                ->get()->map(function ($page) {
                    $page->image = $page->image ? asset('images/pages/' . $page->image) : '';
                    return $page;
                });
            return $this->returnData('data', $content);
        } catch (\Exception $e) {
            return $this->returnError($e->getCode(), $e->getMessage());
        }
    }

    public function showPage($id)
    {
        try {
            $lang = request()->header('lang');
            if (!$lang || ($lang != 'en' && $lang != 'ar'))
                return $this->returnError('400', 'lang is required');
            $page = Page::select(
                'id',
                'icon',
                'section',
                'title_' . $lang . ' as title',
                'description_' . $lang . ' as description',
                'image'
            )
                ->where('id', $id)
                ->first();
            if (!$page)
                return $this->returnError('404', 'page not found');

            if (Route::currentRouteName() == 'service.show' && $page->section != 'our_services') {
                return $this->returnError('404', 'page not found');
            } elseif (Route::currentRouteName() == 'article.show' && $page->section != 'article') {
                return $this->returnError('404', 'page not found');
            }
            // comment
            $image_path_folder = 'pages';
            if (Route::currentRouteName() == 'article.show' && $page->section == 'article') {
                $image_path_folder = 'articles';
            }
            $page->image = $page->image ? asset('images/' . $image_path_folder . '/' . $page->image) : '';
            return $this->returnData('data', $page);
        } catch (\Exception $e) {
            return $this->returnError($e->getCode(), $e->getMessage());
        }
    }

    public function ourProjects(Request $request)
    {
        try {
            $lang = $request->header('lang');
            if (!$lang || ($lang != 'en' && $lang != 'ar'))
                return $this->returnError('400', 'lang is required');
            $content = Project::with('images:id,project_id,image')->select(
                'id',
                'name_' . $lang . ' as name',
                'description_' . $lang . ' as description'
            )
                ->get()->map(function ($project) {
                    $project->images = $project->images->map(function ($image) {
                        $image->image = asset('images/projects/' . $image->image);
                        return $image;
                    });
                    return $project;
                });
            return $this->returnData('data', $content);
        } catch (\Exception $e) {
            return $this->returnError($e->getCode(), $e->getMessage());
        }
    }

    public function ourPartners(Request $request)
    {
        try {
            $lang = $request->header('lang');
            $partners = Partener::select('id', 'name', 'image')->get()->map(function ($partner) {
                $partner->image = asset('images/parteners/' . $partner->image);
                return $partner;
            });
            return $this->returnData('data', $partners);
        } catch (\Exception $e) {
            return $this->returnError($e->getCode(), $e->getMessage());
        }
    }

    public function ourArticles()
    {
        try {
            $lang = request()->header('lang');
            if (!$lang || ($lang != 'en' && $lang != 'ar'))
                return $this->returnError('400', 'lang is required');
            $articles = Page::with(['subPages'])->where('section', 'article')
                ->whereDate('show_at', '<=', now())
                ->select('id', 'title_' . $lang . ' as title', 'image', 'meta_title' ,'meta_description', 'slug', 'show_at')
                ->get()->map(function ($article) use ($lang) {
                    $article->subPages->map(function ($tag) use ($lang) {
                        $tag->content = $tag['content_' . $lang];
                        unset($tag->content_en, $tag->content_ar);
                        return $tag;
                    });
                    $article->image = asset('images/articles/' . $article->image);
                    return $article;
                });
            return $this->returnData('data', $articles);
        } catch (\Exception $e) {
            return $this->returnError($e->getCode(), $e->getMessage());
        }
    }

    public function showArticle($slug)
    {
        try {
            $lang = request()->header('lang');
            if (!$lang || ($lang != 'en' && $lang != 'ar'))
                return $this->returnError('400', 'lang is required');
            $page = Page::with('subArticles')->select(
                'id',
                'slug',
                'icon',
                'section',
                'title_' . $lang . ' as title',
                'description_' . $lang . ' as description',
                'image',
                "meta_description",
                "meta_title"
            )
                ->where('slug', $slug)
                ->first();
            if (!$page)
                return $this->returnError('404', 'page not found');

            if (Route::currentRouteName() == 'service.show' && $page->section != 'our_services') {
                return $this->returnError('404', 'page not found');
            } elseif (Route::currentRouteName() == 'article.show' && $page->section != 'article') {
                return $this->returnError('404', 'page not found');
            }
            $page->subArticles->map(function ($article) {
                $article->image = $article->image ?  asset('images/articles/' . $article->image) : '';
                return $article;
            });
            // comment
            $image_path_folder = 'pages';
            if (Route::currentRouteName() == 'article.show' && $page->section == 'article') {
                $image_path_folder = 'articles';
            }
            $page->image = $page->image ? asset('images/' . $image_path_folder . '/' . $page->image) : '';
            return $this->returnData('data', $page);
        } catch (\Exception $e) {
            return $this->returnError($e->getCode(), $e->getMessage());
        }
    }

}
