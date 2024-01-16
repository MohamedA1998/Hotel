<?php

namespace App\Http\Controllers\Backend;

use App\Facades\ImageFacade;
use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    

    public function index()
    {
        // $team = Team::find(6);
        // dd(Storage::url($team->images->path));
        return view('backend.team.index' , ['teams' => Team::all() ]);
    }

    
    

    public function create()
    {
        return view('backend.team.create');
    }

    
    

    public function store(Request $request)
    {
        $team = Team::create([
            'name'          => $request->name ,
            'postion'       => $request->postion ,
            'facebook'      => $request->facebook
        ]);

        ImageFacade::size(550 , 670)->save($team , 'photo' , 'upload/team');

        return redirect()->route('team.index');
    }
    


    public function show(Team $team)
    {
        //
    }
    

    public function edit(Team $team)
    {
        return view('backend.team.edit' , ['team' => $team]);
    }
    


    public function update(Request $request, Team $team)
    {
        $team->update([
            'name'          => $request->name ,
            'postion'       => $request->postion ,
            'facebook'      => $request->facebook
        ]);
        
        ImageFacade::size(550 , 670)->update($team , 'photo' , 'upload/team');

        return redirect()->route('team.index');
    }



    public function destroy(Team $team)
    {        
        ImageFacade::delete($team);

        $team->delete();

        return redirect()->route('team.index')->with($this->alert('success' , 'One From Team Was Deleted Successfully'));
    }

}
