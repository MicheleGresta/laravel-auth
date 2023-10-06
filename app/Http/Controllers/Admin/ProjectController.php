<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    // INDEX
    public function index(): View
    {
        $projects = Project::all();

        return view("admin.projects.index", compact("projects"));
    }

    // SHOW
    public function show(string $title)
    {
        $projects = Project::where("title", $title);

        return view("admin.projects.show", compact("projects"));
    }

    // CREATE
    public function create()
    {

        return view("admin.projects.create");
    }

    // STORE
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'image' => 'nullable|string',
            'link' => 'required|string',
            'date' => 'nullable|date',
            'language' => 'nullable|string'
        ]);

        $project = Project::create($data);

        return redirect()->route("admin.projects.index");
    }

    // EDIT
    public function edit($id)
    {
        $projects = Project::findOrFail($id);

        return view("admin.projects.edit", ["projects" => $projects]);
    }

    // UPDATE
    public function update(Request $request, $id)
    {
        $projects = Project::findOrFail($id);



        return redirect()->route("admin.projects.show", $projects->id);
    }

    // DESTROY
    public function destroy($id)
    {
        $projects = Project::findOrFail($id);
        $projects->delete();

        return redirect()->route("admin.projects.index");
    }
}
