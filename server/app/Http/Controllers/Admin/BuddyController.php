<?php

namespace App\Http\Controllers\Admin;

use Response;
use App\Http\Controllers\Controller;
use App\Imports\BuddiesImport;
use App\Models\Buddy;
use App\Models\LogTime;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Maatwebsite\Excel\Facades\Excel;

class BuddyController extends Controller
{
    public function index()
    {
        $buddies = Buddy::where('user_id','=', auth()->user()->id)->latest()->when(request()->q, function($buddies) {
            $buddies = $buddies->where('name', 'like', '%'. request()->q . '%');
        })->paginate(8);
        return view('admin.buddy.index', compact('buddies'));
    }

        /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.buddy.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'   => 'required',
            'batch'  => 'required',
            'api_key'   => 'required'
        ]);

        $buddy = Buddy::create([
            'name'   => $request->name,
            'batch'   => $request->batch,
            'api_key'   => $request->api_key,
            'user_id' => auth()->user()->id
        ]);

        if($buddy){
            //redirect dengan pesan sukses
            return redirect()->route('admin.buddy.index')->with(['success' => 'SUCCESS TO CREATE NEW DATA']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('admin.buddy.index')->with(['error' => 'FAILED TO CREATE NEW DATA']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Buddy $buddy)
    {
        return view('admin.buddy.edit', compact('buddy'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Buddy $buddy)
    {
        $this->validate($request, [
            'name'   => 'required',
            'batch'  => 'required',
            'api_key'   => 'required'
        ]);

        $buddy = Buddy::findOrFail($buddy->id);

        $buddy->update([
            'name'   => $request->name,
            'batch'   => $request->batch,
            'api_key'   => $request->api_key
        ]);


        if($buddy){
            //redirect dengan pesan sukses
            return redirect()->route('admin.buddy.index')->with(['success' => 'DATA SUCCESS TO BE UPDATED']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('admin.buddy.index')->with(['error' => 'FAILED TO UPDATE THE DATA']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $buddy = Buddy::findOrFail($id);
        $buddy->delete();

        if($buddy){
            return response()->json([
                'status' => 'success'
            ]);
        }else{
            return response()->json([
                'status' => 'error'
            ]);
        }
    }

        /**
    * @return \Illuminate\Support\Collection
    */
    public function importExportView()
    {
       return view('admin.buddy.import');
    }
     
    /**
    * @return \Illuminate\Support\Collection
    */
    public function import(Request $request) 
    {
        
        $this->validate($request, [
            'file'   => 'required|max:5000|mimes:xlsx,xls,csv,txt',
        ]);
        
        try {
            Excel::import(new BuddiesImport,request()->file('file'));
            return redirect()->route('admin.buddy.index')->with(['success' => 'DATA SUCCESS TO BE ADDED']);
        } catch (QueryException $e) {
            // dd($e->errorInfo);
            $failures = $e->errorInfo;
            // dd($failures[2]);
            return back()->withErrors($failures[2]);
        } 
             
    }

    /**
     * buddy log time
     */

     public function logTime(Buddy $buddy)
     {
        return view('admin.buddy.log', compact('buddy'));
     }

     /**
      *  compare timetracker between buddies
     */

     public function compare(Request $request, Buddy $buddy){
        
        $startDate = date("Y-m-d",strtotime("-21 days"));
        $endDate = date("Y-m-d");
        $buddyIds = $request -> buddyIds;
        $buddiesLogTime = LogTime::whereIn("buddy_id", [1,2])
        ->WhereBetween('date', [$startDate, $endDate] )
        ->with('buddy')
        ->get();
        // return Response::json($buddiesLogTime);

        return view('admin.buddy.compare', compact('buddiesLogTime'));
     }
     
}
