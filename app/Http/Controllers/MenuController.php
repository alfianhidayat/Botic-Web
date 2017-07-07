<?php

namespace App\Http\Controllers;

use App\Asset;
use App\Booking;
use App\BookingStatus;
use App\Category;
use App\Culinary;
use App\Culture;
use App\Event;
use App\Finance;
use App\Health;
use App\Hotel;
use App\Leisure;
use App\Menu;
use App\Praying;
use App\PublicService;
use App\Review;
use App\Shopping;
use App\Tourism;
use App\Transportation;
use App\Visitor;
use Illuminate\Http\Request;
use Alert;
use Illuminate\Support\Facades\Input;
use DB;
use Excel;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        $menu = Menu::all();
        return view('home', ['menus' => $menu]);
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
        $data = new Menu();
        $data->menu = $request->menu;
        $data->save();
        alert()->success('Data Tersimpan', 'Berhasil');
        return redirect('menu');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Menu $menu
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kategori = Category::all()->where('id_menu', $id);
        $menu = Menu::find($id);
        $menus = Menu::all();

        switch ($id) {
            case 1:
                $items = Tourism::all();
                return view('tourism/category', ['datas' => $kategori, 'menu' => $menu, 'items' => $items, 'menus' => $menus]);
                break;
            case 2:
                $items = Hotel::all();
                return view('hotel/category', ['datas' => $kategori, 'menu' => $menu, 'items' => $items, 'menus' => $menus]);
                break;
            case 3:
                $items = Culinary::all();
                return view('culinary/category', ['datas' => $kategori, 'menu' => $menu, 'items' => $items, 'menus' => $menus]);
                break;
            case 4:
                $items = Shopping::all();
                return view('shopping/category', ['datas' => $kategori, 'menu' => $menu, 'items' => $items, 'menus' => $menus]);
                break;
            case 5:
                $items = Praying::all();
                return view('praying/category', ['datas' => $kategori, 'menu' => $menu, 'items' => $items, 'menus' => $menus]);
                break;
            case 6:
                $items = Transportation::all();
                return view('transportation/category', ['datas' => $kategori, 'menu' => $menu, 'items' => $items, 'menus' => $menus]);
                break;
            case 7:
                $items = PublicService::all();
                return view('public_service/category', ['datas' => $kategori, 'menu' => $menu, 'items' => $items, 'menus' => $menus]);
                break;
            case 8:
                $items = Finance::all();
                return view('finance/category', ['datas' => $kategori, 'menu' => $menu, 'items' => $items, 'menus' => $menus]);
                break;
            case 9:
                $items = Asset::all();
                return view('asset/category', ['datas' => $kategori, 'menu' => $menu, 'items' => $items, 'menus' => $menus]);
                break;
            case 10:
                $items = Culture::all();
                return view('culture/category', ['datas' => $kategori, 'menu' => $menu, 'items' => $items, 'menus' => $menus]);
                break;
            case 11:
                $items = Leisure::all();
                return view('leisure/category', ['datas' => $kategori, 'menu' => $menu, 'items' => $items, 'menus' => $menus]);
                break;
            case 12:
                $items = Health::all();
                return view('health/category', ['datas' => $kategori, 'menu' => $menu, 'items' => $items, 'menus' => $menus]);
                break;
            case 13:
                $items = Event::all();
                return view('event/category', ['datas' => $kategori, 'menu' => $menu, 'items' => $items, 'menus' => $menus]);
                break;
            case 14:
                $items = Visitor::with('coordinator.user')->get();

                foreach ($items as $item) {
//                    DB::table($data->menu->)->where('name', 'John')->first();
                    switch ($item->id_menu) {
                        case 1:
                            $item["object"] = Tourism::find($item->id_object);
                            break;
                        case 2:
                            $item["object"] = Hotel::find($item->id_object);
                            break;
                        case 3:
                            $item["object"] = Culinary::find($item->id_object);
                            break;
                        case 4:
                            $item["object"] = Shopping::find($item->id_object);
                            break;
                        case 5:
                            $item["object"] = Praying::find($item->id_object);
                            break;
                        case 6:
                            $item["object"] = Transportation::find($item->id_object);
                            break;
                        case 7:
                            $item["object"] = PublicService::find($item->id_object);
                            break;
                        case 8:
                            $item["object"] = Finance::find($item->id_object);
                            break;
                        case 9:
                            $item["object"] = Asset::find($item->id_object);
                            break;
                        case 10:
                            $item["object"] = Culture::find($item->id_object);
                            break;
                        case 11:
                            $item["object"] = Leisure::find($item->id_object);
                            break;
                        case 12:
                            $item["object"] = Health::find($item->id_object);
                            break;
                        case 13:
                            $item["object"] = Event::find($item->id_object);
                            break;
                        case 14:
                            $item["object"] = Visitor::find($item->id_object);
                            break;
                        case 15:
                            $item["object"] = Booking::find($item->id_object);
                            break;
                        case 15:
                            $item["object"] = Review::find($item->id_object);
                            break;

                    }
                }
                return view('visitor/category', ['datas' => $kategori, 'menu' => $menu, 'items' => $items, 'menus' => $menus]);
                break;
            case 15:
                $items = Booking::all();
                return view('booking/category', ['datas' => $kategori, 'menu' => $menu, 'items' => $items, 'menus' => $menus]);
                break;
            case 16:
                $items = Review::with('menu')->get();
                foreach ($items as $item) {
//                    DB::table($data->menu->)->where('name', 'John')->first();
                    switch ($item->id_menu) {
                        case 1:
                            $item["object"] = Tourism::find($item->id_object);
                            break;
                        case 2:
                            $item["object"] = Hotel::find($item->id_object);
                            break;
                        case 3:
                            $item["object"] = Culinary::find($item->id_object);
                            break;
                        case 4:
                            $item["object"] = Shopping::find($item->id_object);
                            break;
                        case 5:
                            $item["object"] = Praying::find($item->id_object);
                            break;
                        case 6:
                            $item["object"] = Transportation::find($item->id_object);
                            break;
                        case 7:
                            $item["object"] = PublicService::find($item->id_object);
                            break;
                        case 8:
                            $item["object"] = Finance::find($item->id_object);
                            break;
                        case 9:
                            $item["object"] = Asset::find($item->id_object);
                            break;
                        case 10:
                            $item["object"] = Culture::find($item->id_object);
                            break;
                        case 11:
                            $item["object"] = Leisure::find($item->id_object);
                            break;
                        case 12:
                            $item["object"] = Health::find($item->id_object);
                            break;
                        case 13:
                            $item["object"] = Event::find($item->id_object);
                            break;
                        case 14:
                            $item["object"] = Visitor::find($item->id_object);
                            break;
                        case 15:
                            $item["object"] = Booking::find($item->id_object);
                            break;
                        case 15:
                            $item["object"] = Review::find($item->id_object);
                            break;

                    }
                }
                return view('review/category', ['datas' => $kategori, 'menu' => $menu, 'items' => $items, 'menus' => $menus]);
                break;
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Menu $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Menu $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Menu $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        $data = new Menu();
        $data->delete();
        $data->save();
        alert()->success('Data Berhasil Terhapus', 'Berhasil');
        return redirect('menu');
    }


    public function importExport()
    {
        return view('importExport');
    }

    public function downloadExcel($type)
    {
        $data = Menu::get()->toArray();
        return Excel::create('itsolutionstuff_example', function ($excel) use ($data) {
            $excel->sheet('mySheet', function ($sheet) use ($data) {
                $sheet->fromArray($data);
            });
        })->download($type);
    }

    public function importExcel()
    {
//        dd(Input::file('import_file'));
        if (Input::hasFile('import_file')) {
            $path = Input::file('import_file')->getRealPath();
            $data = Excel::load($path, function ($reader) {
            })->get();
            if (!empty($data) && $data->count()) {
                foreach ($data as $key => $value) {
                    dd($data);
                    $insert[] = [
                        'menu' => $value->menu,
                        'icon' => $value->icon
                    ];
                }
                if (!empty($insert)) {
                    DB::table('menus')->insert($insert);
                    alert()->success('Data Berhasil Di Import', 'Berhasil');
                    return redirect('menu');
                }
            }
        }
        return back();
    }
}
