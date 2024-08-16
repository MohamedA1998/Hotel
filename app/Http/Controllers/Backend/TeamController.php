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
        return view('backend.team.index' , [
            'teams' => Team::latest()->get()
        ]);
    }

    public function store(Request $request)
    {
        $team = Team::create([
            'name'          => $request->name ,
            'postion'       => $request->postion ,
            'facebook'      => $request->facebook,
            'image'         => ImageFacade::size(550 , 670)->save('upload/team')
        ]);

        toastr('An error has occurred please try again later.' ,'success' , 'Team Created');

        return redirect()->route('team.index');
    }

    public function update(Request $request, Team $team)
    {
        $team->update([
            'name'          => $request->name ,
            'postion'       => $request->postion ,
            'facebook'      => $request->facebook,
        ]);

        ImageFacade::size(550 , 670)->update($team , 'upload/team');

        return redirect()->route('team.index');
    }

    public function destroy(Team $team)
    {
        ImageFacade::delete($team->image);

        $team->delete();

        return redirect()->route('team.index')->with($this->alert('success' , 'One From Team Was Deleted Successfully'));
    }
}
