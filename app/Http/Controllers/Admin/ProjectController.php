<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{
    use GeneralTrait;
    public function index(Request $request)
    {
        try {
            $projects = Project::orderBy('id', 'DESC')->paginate(15);
            return view('Admin.Project.index', compact('projects'));
        } catch (\Exception $e) {
            return view('general-error');
        }
    }

    public function show($id)
    {
        try {
            $project = Project::findOrFail($id);
            return view('Admin.Project.show', compact('project'));
        } catch (\Exception $e) {
            return view('general-error');
        }
    }

    public function create()
    {
        try {
            return view('Admin.Project.create');
        } catch (\Exception $e) {
            return view('general-error');
        }
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $validator = Validator::make($request->all(), [
                'name_en' => 'required',
                'name_ar' => 'required',
                'description_en' => 'required',
                'description_ar' => 'required',
            ]);
            if ($validator->fails()) {
                Session::flash('message',  $validator->errors()->first());
                Session::flash('alert-class', 'alert-danger');
                return redirect()->back()->withInput();
            }
            $project = new Project();
            $project->name_en = $request->name_en;
            $project->name_ar = $request->name_ar;
            $project->description_en = $request->description_en;
            $project->description_ar = $request->description_ar;
            $project->save();
            if (isset($request->image) && $request->hasFile('image')) {
                foreach ($request->image as $image) {
                    $photo = $this->saveImage($image, 'projects');
                    $project->images()->create([
                        'image' => $photo,
                    ]);
                }
            }
            Session::flash('message', __('app.project') . ' ' . __('app.added_successfully'));
            Session::flash('alert-class', 'alert-success');
            DB::commit();
            return redirect()->route('projects.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return view('general-error');
        }
    }

    public function edit($id)
    {
        try {
            $project = Project::findOrFail($id);
            if (!$project) {
                Session::flash('message', __('app.project') . '' .  __('app.is_not_exist'));
                Session::flash('alert-class', 'alert-danger');
                return redirect()->route('projects.index');
            }
            return view('Admin.Project.edit', compact('project'));
        } catch (\Exception $e) {
            return view('general-error');
        }
    }

    public function update($id, Request $request)
    {
        try {
            DB::beginTransaction();
            $validator = Validator::make($request->all(), [
                'name_en' => 'required',
                'name_ar' => 'required',
                'description_en' => 'required',
                'description_ar' => 'required',
            ]);
            if ($validator->fails()) {
                Session::flash('message',  $validator->errors()->first());
                Session::flash('alert-class', 'alert-danger');
                return redirect()->back()->withInput();
            }
            $project = Project::findOrFail($id);
            if (!$project) {
                Session::flash('message', __('app.project') . ' ' . __('app.is_not_exist'));
                Session::flash('alert-class', 'alert-danger');
                return redirect()->back()->withInput();;
            }
            $project->name_en = $request->name_en;
            $project->name_ar = $request->name_ar;
            $project->description_en = $request->description_en;
            $project->description_ar = $request->description_ar;
            $project->save();
            if (isset($request->image) && $request->hasFile('image')) {
                $project->images()->delete();
                foreach ($request->image as $image) {
                    $photo = $this->saveImage($image, 'projects');
                    $project->images()->create([
                        'image' => $photo,
                    ]);
                }
            }
            Session::flash('message', __('app.project') . ' ' . __('app.updated_successfully'));
            Session::flash('alert-class', 'alert-success');
            DB::commit();
            return redirect()->route('project.show', $project->id);
        } catch (\Exception $e) {
            DB::rollBack();
            return view('general-error');
        }
    }

    public function delete($id)
    {
        try {
            DB::beginTransaction();
            $project = Project::findOrFail($id);
            if (!$project) {
                Session::flash('message', __('app.project') . ' ' . __('app.is_not_exist'));
                Session::flash('alert-class', 'alert-danger');
                return redirect()->route('projects.index');
            }
            foreach ($project->images as $image) {
                $filePath = public_path('images/projects/' . $image->image);
                if (File::exists($filePath)) {
                    File::delete($filePath);
                }
            }
            $project->images()->delete();
            $project->delete();
            Session::flash('message', __('app.project') . ' ' . __('app.deleted_successfully'));
            Session::flash('alert-class', 'alert-success');
            DB::commit();
            return redirect()->route('projects.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return view('general-error');
        }
    }
}
