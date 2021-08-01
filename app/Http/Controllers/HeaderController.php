<?php

namespace App\Http\Controllers;
use App\Models\Header;
use App\Models\Location;
use Illuminate\Http\Request;

class HeaderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return Header::all();
        return Location::where('town', '')->get();
    }

    /**
     * Display a listing of the resource.
     *
     * @param  string  $town
     * @return \Illuminate\Http\Response
     */
    public function getTown($town)
    {
        // return Header::all();
        return Location::where('town', $town)->get();
        // return Location::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required',
            'description'=>'required',
            'image'=>'required',
        ]);
        return Header::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $town
     * @return \Illuminate\Http\Response
     */
    public function show(Location $location)
    {
        $headers = $location->headers;
        
        \Log::info($headers);
        return response()->json($headers);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $header = Header::find($id);

        $header->update($request->all());
        return $header;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Header::destroy($id);
    }
}
