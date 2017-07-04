<?php

namespace App\Http\Controllers;

use App\Tourism;
use Illuminate\Http\Request;

use Alert;
use Illuminate\Support\Facades\Input;
use DB;
use Excel;
class TourismController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tourism  $tourism
     * @return \Illuminate\Http\Response
     */
    public function show(Tourism $tourism)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tourism  $tourism
     * @return \Illuminate\Http\Response
     */
    public function edit(Tourism $tourism)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tourism  $tourism
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tourism $tourism)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tourism  $tourism
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tourism $tourism)
    {
        //
    }
    public function importExport()
    {
        return view('importExport');
    }

    public function downloadExcel($type)
    {
        $data = Tourism::get()->toArray();
        return Excel::create('tourism', function ($excel) use ($data) {
            $excel->sheet('mySheet', function ($sheet) use ($data) {
                $sheet->fromArray($data);
            });
        })->download($type);
    }

    public function importExcel()
    {
//        dd(Input::file('file'));
        if (Input::hasFile('file')) {
            $path = Input::file('file')->getRealPath();
            $data = Excel::load($path, function ($reader) {
            })->get();
            if (!empty($data) && $data->count()) {
                foreach ($data as $key => $value)
                {
//                    dd($data);
                    $insert[] = [
                        'name' => $value->name,
                        'address' => $value->address,
                        'phone' => $value->phone,
                        'manager' => $value->manager,
                        'description' => $value->description,
                        'price' => $value->price,
                        'open' => $value->open,
                        'close' => $value->close,
                        'id_category' => $value->id_category,
                        'id_menu' => $value->id_menu
                    ];
                }
                if (!empty($insert)) {
                    DB::table('tourisms')->insert($insert);
                    alert()->success('Data Berhasil Di Import', 'Berhasil');
                    return redirect('showMenu/1');
                }
            }
        }
        return back();
    }
}
