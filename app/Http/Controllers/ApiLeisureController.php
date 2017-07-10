<?php

namespace App\Http\Controllers;

use App\Leisure;
use App\Picture;
use Illuminate\Http\Request;

class ApiLeisureController extends ApiBaseController
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if ($id == 32) {
            $data = Leisure::with('category', 'menu')->where('id_category', 32)->orWhere('id_category', 52)->get();
        } else {
            $data = Leisure::with('category', 'menu')->where('id_category', $id)->get();
        }
        foreach ($data as $dt) {
            $picture = Picture::where('id_object', $dt->id)->where('id_menu', $dt->id_menu)->get();
            $dt["picture"] = $picture;
        }
        return $this->baseResponse(false, "Berhasil mendapatkan data", $data);
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
