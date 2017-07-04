<?php

namespace App\Http\Controllers;

use App\Leisure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Auth;
use DB;
use Excel;
class LeisureController extends Controller
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
     * @param  \App\Leisure  $leisure
     * @return \Illuminate\Http\Response
     */
    public function show(Leisure $leisure)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Leisure  $leisure
     * @return \Illuminate\Http\Response
     */
    public function edit(Leisure $leisure)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Leisure  $leisure
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Leisure $leisure)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Leisure  $leisure
     * @return \Illuminate\Http\Response
     */
    public function destroy(Leisure $leisure)
    {
        //
    }

    public function importExport()
    {
        return view('importExport');
    }
    public function downloadExcel($type)
    {
        $data = Leisure::get()->toArray();
        return Excel::create('itsolutionstuff_example', function($excel) use ($data) {
            $excel->sheet('mySheet', function($sheet) use ($data)
            {
                $sheet->fromArray($data);
            });
        })->download($type);
    }
    public function importExcel()
    {
//        dd(Input::file('import_file'));
        if(Input::hasFile('import_file')){
            $path = Input::file('import_file')->getRealPath();
            $data = Excel::load($path, function($reader) {
            })->get();
            if(!empty($data) && $data->count()){
                foreach ($data as $key => $value) {
                    $insert[] = [
                        'name' => $value->name,
                        'address' => $value->address,
                        'phone' => $value->phone,
                        'description' => $value->description,
                        'price' => $value->price,
                        'open' => $value->open,
                        'close' => $value->close,
                        'id_category' => $value->id_category,
                        'created_by'=> Auth::user()->id
                    ];
                }
                if(!empty($insert)){
                    DB::table('leisures')->insert($insert);
                    dd('Insert Record successfully.');
                }
            }
        }
        return back();
    }
}
