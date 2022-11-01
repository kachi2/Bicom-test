<?php

namespace App\Http\Controllers;

use App\Models\AnnouncedLgaResult;
use App\Models\AnnouncedPuResults;
use App\Models\Lga;
use App\Models\Party;
use App\Models\PollingUnit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function getLga(){
        return view('polling_results')
        ->with('lga', Lga::orderBy('uniqueid','DESC')->get());
    }

    public function getLgaPolls($id){
        $polls= PollingUnit::where('lga_id', $id)->get();
        return response()->json($polls);
    }

    public function getPollsResult($id){
        $data['results'] = AnnouncedPuResults::where('polling_unit_uniqueid', $id)->get();
        $data['total'] = AnnouncedPuResults::where('polling_unit_uniqueid', $id)->sum('party_score');
        return response()->json($data);
    }

public function LgaResults(){
        return view('lga_results')
        ->with('lga', Lga::orderBy('uniqueid','DESC')->get());
    }

public function LgaPollsResult($id){
    $data['results'] = AnnouncedLgaResult::where('lga_name', $id)->get();
    $data['total'] = AnnouncedLgaResult::where('lga_name', $id)->sum('party_score');
    return response()->json($data);
}

public function CreatePolls(){
    return view('store_polls')
    ->with('lga', Lga::orderBy('uniqueid','DESC')->get())
    ->with('party', Party::get());
}

public function PollsStore(Request $request){
    $valid = Validator::make($request->all(), [
    'polling_id' => 'required',
    'polls_results' => 'required'
    ]);
//dd($request->polling_id);
    if($valid->fails()){
        \Session::flash('alert', 'error');
        \Session::flash('message', 'Some fields are missing');
    }
    $polls = explode(',',$request->polls_results);
    foreach($polls as $poll){
       $data = explode(':',$poll);
       $unit = AnnouncedPuResults::where('polling_unit_uniqueid', $request->polling_id)->first();
      // if($data[0] !== $unit->party_abbreviation){
      AnnouncedPuResults::create([
        'polling_unit_uniqueid' => $request->polling_id,
        'party_abbreviation' => $data[0],
        'party_score' => $data[1],
        'entered_by_user' => 'michael',
        'date_entered' => Carbon::now(),
        'user_ip_address' => $request->ip()
       ]);
   // }
}
    \Session::flash('alert', 'success');
    \Session::flash('message', 'Polls Scores submitted Successfully');
    return back();
}


}