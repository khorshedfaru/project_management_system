<?php

namespace App\Http\Controllers;

use App\Project;
use App\Company;
use App\User;
use App\ProjectUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if( Auth::check() ){
          $projects = Project::where('user_id', Auth::user()->id)->get();

        return view('projects.index', ['projects' => $projects]);  
        }
        return view('auth.login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($company_id = null)
    {
        //
        $companies = null;
        if(!$company_id){
            $companies = Company::where('user_id', Auth::user()->id)->get();
        }
        return view('projects.create',['company_id' => $company_id, 'companies' => $companies]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        if(Auth::check()){
            $project = Project::create([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'project_id' => $request->input('project_id'),
                'user_id' => Auth::user()->id,
            ]);

            if($project){
                return redirect()->route('projects.show', ['projects' => $project->id])->with('success', 'Project created successfully');
            }
        }

            return back()->withInput()->with('errors', 'Unable to create new project');
           
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        $project = Project::where('id', $project->id)->first();

        $comments = $project->comments;

        //$project = Project::find($project->id);

        return view('projects.show', ['project' => $project, 'comments' => $comments]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        //
        $project = Project::find($project->id);

        return view('projects.edit', ['project' => $project]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        //
        $projectUpdate = Project::where('id', $project->id)
        ->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);
        if($projectUpdate){
            return redirect()->route('projects.show', ['project'=>$project->id])
            ->with('success', 'Project updated successfully');
        }

        return back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        //
        $findProject = Project::find($project->id);
        if($findProject->delete()){
            return redirect()->route('projects.index')
            ->withh('success', 'Project deleted successfully');
        }

        return back()->withInput()->with('error', 'Project could not be deleted');
    }

    public function adduser(Request $request){
        
        $project = Project::find($request->input('project_id'));

        //

        if(Auth::user()->id == $project->user_id){
            $user = User::where('email', $request->input('email'))->first();
            //if User id already added to the project
            $projectUser = ProjectUser::where('user_id', $user->id)
            ->where('project_id', $project->id)->first();

            if($projectUser){
                return redirect()->route('projects.show', ['project' => $project->id])
                ->with('success', $request->input('email').'already exist to this project');
            }
            if($user && $project){
                $project->users()->attach($user->id);
                return redirect()->route('projects.show', ['project' => $project->id])
                ->with('success', $request->input('email').'user added successfully');
            }
        }
       return redirect()->route('projects.show', ['project' => $project->id])
       ->with('errors', 'Unable to add user to the project'); 
    }
}
