<?php

namespace App\Http\Controllers;

use App\Asset;
use App\Booking;
use App\IdentityType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class ApiBookingController extends ApiBaseController
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
        return Booking::all();
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
        $data = new Booking();
        if ($request->id_category == 29) {
            $data->identity_type_id = $request->identity_type_id;
            $data->identity_number = $request->identity_number;
            $data->name = $request->name;
            $data->phone = $request->phone;
            $data->date = $request->date;
            $data->id_time = $request->time;
            $data->description = $request->description;
            $data->id_object = $request->id_object;
            $data->id_category = $request->id_category;
            $data->booking_status_id = 1;
            $data->id_menu = 15;
            $data->user_id = Auth::user()->id;
            if ($data->save()) {
                return $this->baseResponse(false, 'berhasil', null);
            } else {
                return $this->baseResponse(true, 'gagal membuat booking', null);
            }
        } elseif ($request->id_category == 30) {
            $data->identity_type_id = $request->identity_type_id;
            $data->identity_number = $request->identity_number;
            $data->name = $request->name;
            $data->phone = $request->phone;
            $data->date = $request->date;
            $data->id_time = $request->time;
            $data->description = $request->description;
            $data->id_object = $request->id_object;
            $data->id_category = $request->id_category;
            $data->booking_status_id = 1;
            $data->id_menu = 15;
            $data->user_id = Auth::user()->id;
            if ($data->save()) {
                return $this->baseResponse(false, 'berhasil', null);
            } else {
                return $this->baseResponse(true, 'gagal membuat booking', null);
            }
        }
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

    public function getListAsset()
    {
        $assets = Asset::all();
        $data = array();
        foreach ($assets as $asset) {
//            if (Input::get('id_time') == 3) {
//                $isExist1 = Booking::where('id_object', $asset->id)
//                    ->where('bookings.id_time', Input::get('id_time'))
//                    ->where('bookings.date', 1)
//                    ->where('bookings.booking_status_id', 1)
//                    ->orWhere('bookings.booking_status_id', 2)
//                    ->first();
//                $isExist2 = Booking::where('id_object', $asset->id)
//                    ->where('bookings.id_time', Input::get('id_time'))
//                    ->where('bookings.date', 2)
//                    ->where('bookings.booking_status_id', 1)
//                    ->orWhere('bookings.booking_status_id', 2)
//                    ->first();
//                if (sizeof($isExist1) == 0 && sizeof($isExist2) == 0) {
//                    $data[] = $asset;
//                }
//            } else {
                $isExist = Booking::where('id_object', $asset->id)
                    ->where('bookings.id_time', Input::get('id_time'))
                    ->where('bookings.date', Input::get('date'))
                    ->where('bookings.booking_status_id', 1)
                    ->orWhere('bookings.booking_status_id', 2)
                    ->first();
                if (sizeof($isExist) == 0) {
                    $data[] = $asset;
                }
//            }
        }
        return $this->baseResponse(false, 'berhasil', $data);
    }

    public function getListIdentity()
    {
        return $this->baseResponse(false, 'berhasil', IdentityType::all());
    }
}
