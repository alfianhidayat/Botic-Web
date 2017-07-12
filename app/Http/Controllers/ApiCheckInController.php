<?php

namespace App\Http\Controllers;

use App\Coordinator;
use App\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiCheckInController extends ApiBaseController
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $req = json_decode($request->getContent(), true);
        $coord = new Coordinator();
        $coord->user_id = Auth::user()->id;
        $coord->phone = $req["phone"];
        $coord->visitor_number = $req["visitor_number"];
        $coord->long_visit = $req["long_visit"];
        $coord->id_menu = 14;
        $visitors = $req["visitors"];
        if ($coord->save()) {
            foreach ($visitors as $visitor) {
                $visit = new Visitor();
                $visit->name = $visitor["name"];
                $visit->age = $visitor["age"];
                $visit->origin = $visitor["origin"];
                $visit->coordinator_id = $coord->id;
                $visit->id_menu = 14;
                $visit->save();
            }
        }
        return $this->baseResponse(false, 'berhasil', null);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
