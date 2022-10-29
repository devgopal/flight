<?php

namespace App\Http\Controllers;

use App\Models\Root;
use App\Models\Location;

use Illuminate\Http\Request;

class RootController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roots = Root::latest()->paginate(10);
      
        return view('roots.index',compact('roots'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $locations = Location::all();
        
        return view('roots.create',compact('locations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $request['operational_days'] = json_encode($request['operational_days']);

        $request->validate([
            'source' => 'required',
            'destination' => 'required',
            'operational_days' => 'required',
            'frequency' => 'required',
            'gap' => 'required',
            'passenger_capacity' => 'required',
            'min_fare' => 'required',
            'booking_fare' => 'required',
            'status' => 'required'
        ]);
      
        Root::create($request->all());
       
        return redirect()->route('roots.index')
                        ->with('success','Root created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Root  $root
     * @return \Illuminate\Http\Response
     */
    public function show(Root $root)
    {
       return view('roots.show',compact('root'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Root  $root
     * @return \Illuminate\Http\Response
     */
    public function edit(Root $root)
    {
       $locations = Location::all();
       return view('roots.edit',compact('root','locations'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Root  $root
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Root $root)
    {
        $request['operational_days'] = json_encode($request['operational_days']);

        $request->validate([
            'source' => 'required',
            'destination' => 'required',
            'operational_days' => 'required',
            'frequency' => 'required',
            'gap' => 'required',
            'passenger_capacity' => 'required',
            'min_fare' => 'required',
            'booking_fare' => 'required',
            'status' => 'required'
        ]);
      
        $root->update($request->all());
      
        return redirect()->route('roots.index')
                        ->with('success','Root updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Root  $root
     * @return \Illuminate\Http\Response
     */
    public function destroy(Root $root)
    {
        $root->delete();
       
        return redirect()->route('roots.index')
                        ->with('success','Root deleted successfully');
    }
}
