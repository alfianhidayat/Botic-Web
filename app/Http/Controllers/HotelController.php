<?php

namespace App\Http\Controllers;

use App\Category;
use App\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Alert;
class HotelController extends Controller
{
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd($request);
        $data=new Hotel();
        $data->name = $request->name;
        $data->address = $request->address;
        $data->phone = $request->phone;
        $data->description = $request->description;
        $data->price = $request->price;
        $data->open = $request->open;
        $data->close = $request->close;
        $data->id_category = $request->id_category;
        $data->id_menu = $request->id_menu;
        $data->created_by = Auth::user()->id;
        $data->save();
        Alert::success('Data Berhasil Disimpan');
        return redirect('showMenu/'.$request->id_menu);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function show($id,$id_menu)
    {
        $hotel = Hotel::all()->where('id_category', $id);
        $kategori = Category::find($id);
        return view('hotel/data',['datas'=>$hotel,'categories'=>$kategori]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function edit(Hotel $hotel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $lokasi=Hotel::find($id);
//        dd($lokasi);
        $lokasi->name = $request->name;
        $lokasi->address = $request->address;
        $lokasi->phone = $request->phone;
        $lokasi->price = $request->price;
        $lokasi->description = $request->description;
        $lokasi->open = $request->open;
        $lokasi->close = $request->close;
        $lokasi->lat = $request->lat;
        $lokasi->lng = $request->lng;
        $lokasi->save();
        Alert::success('Data Berhasil Diubah');
        return redirect('showMenu/'.$request->id_menu);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hotel $hotel)
    {
        //
    }
}
