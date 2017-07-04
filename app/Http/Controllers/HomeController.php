<?php

namespace App\Http\Controllers;

use App\Asset;
use App\Booking;
use App\Category;
use App\Culinary;
use App\Culture;
use App\Event;
use App\Finance;
use App\Health;
use App\Hotel;
use App\IdentityType;
use App\Leisure;
use App\Menu;
use App\Picture;
use App\Praying;
use App\PublicService;
use App\Review;
use App\Shopping;
use App\Tourism;
use App\Transportation;
use App\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Alert;

use Illuminate\Support\Facades\Input;
use DB;
use Excel;

use Validator;
use Response;
use Redirect;
use Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function show($id, $id_menu)
    {
        $menus = Menu::all();
        switch ($id_menu) {
            case 1:
                $hotel = Tourism::all()->where('id_category', $id);
                $kategori = Category::find($id);
                $back = Menu::find($id_menu);
                return view('tourism/data', ['datas' => $hotel, 'categories' => $kategori, 'back' => $back, 'menus' => $menus]);
                break;
            case 2:
                $hotel = Hotel::all()->where('id_category', $id);
                $kategori = Category::find($id);
                $back = Menu::find($id_menu);
                return view('hotel/data', ['datas' => $hotel, 'categories' => $kategori, 'back' => $back, 'menus' => $menus]);
                break;
            case 3:
                $hotel = Culinary::all()->where('id_category', $id);
                $kategori = Category::find($id);
                $back = Menu::find($id_menu);
                return view('culinary/data', ['datas' => $hotel, 'categories' => $kategori, 'back' => $back, 'menus' => $menus]);
                break;
            case 4:
                $hotel = Shopping::all()->where('id_category', $id);
                $kategori = Category::find($id);
                $back = Menu::find($id_menu);
                return view('shopping/data', ['datas' => $hotel, 'categories' => $kategori, 'back' => $back, 'menus' => $menus]);
                break;
            case 5:
                $hotel = Praying::all()->where('id_category', $id);
                $kategori = Category::find($id);
                $back = Menu::find($id_menu);
                return view('praying/data', ['datas' => $hotel, 'categories' => $kategori, 'back' => $back, 'menus' => $menus]);
                break;
            case 6:
                $hotel = Transportation::all()->where('id_category', $id);
                $kategori = Category::find($id);
                $back = Menu::find($id_menu);
                return view('transportation/data', ['datas' => $hotel, 'categories' => $kategori, 'back' => $back, 'menus' => $menus]);
                break;
            case 7:
                $hotel = PublicService::all()->where('id_category', $id);
                $kategori = Category::find($id);
                $back = Menu::find($id_menu);
                return view('public_service/data', ['datas' => $hotel, 'categories' => $kategori, 'back' => $back, 'menus' => $menus]);
                break;
            case 8:
                $hotel = Finance::all()->where('id_category', $id);
                $kategori = Category::find($id);
                $back = Menu::find($id_menu);
                return view('finance/data', ['datas' => $hotel, 'categories' => $kategori, 'back' => $back, 'menus' => $menus]);
                break;
            case 9:
                $hotel = Asset::all()->where('id_category', $id);
                $kategori = Category::find($id);
                $back = Menu::find($id_menu);
                return view('asset/data', ['datas' => $hotel, 'categories' => $kategori, 'back' => $back, 'menus' => $menus]);
                break;
            case 10:
                $hotel = Culture::all()->where('id_category', $id);
                $kategori = Category::find($id);
                $back = Menu::find($id_menu);
                return view('culture/data', ['datas' => $hotel, 'categories' => $kategori, 'back' => $back, 'menus' => $menus]);
                break;
            case 11:
                $hotel = Leisure::all()->where('id_category', $id);
                $kategori = Category::find($id);
                $back = Menu::find($id_menu);
                return view('leisure/data', ['datas' => $hotel, 'categories' => $kategori, 'back' => $back, 'menus' => $menus]);
                break;
            case 12:
                $hotel = Health::all()->where('id_category', $id);
                $kategori = Category::find($id);
                $back = Menu::find($id_menu);
                return view('health/data', ['datas' => $hotel, 'categories' => $kategori, 'back' => $back, 'menus' => $menus]);
                break;
            case 13:
                $hotel = Event::all()->where('id_category', $id);
                $kategori = Category::find($id);
                $back = Menu::find($id_menu);
                return view('event/data', ['datas' => $hotel, 'categories' => $kategori, 'back' => $back, 'menus' => $menus]);
                break;
            case 14:
                $hotel = Visitor::all()->where('id_category', $id);
                $kategori = Category::find($id);
                $back = Menu::find($id_menu);
                return view('visitor/data', ['datas' => $hotel, 'categories' => $kategori, 'back' => $back, 'menus' => $menus]);
                break;
            case 15:
                $hotel = Booking::all()->where('id_category', $id);
                $kategori = Category::find($id);
                $back = Menu::find($id_menu);
                return view('booking/data', ['datas' => $hotel, 'categories' => $kategori, 'back' => $back, 'menus' => $menus]);
                break;
            case 16:
                $hotel = Review::all()->where('id_category', $id);
                $kategori = Category::find($id);
                $back = Menu::find($id_menu);
                return view('visitor/data', ['datas' => $hotel, 'categories' => $kategori, 'back' => $back, 'menus' => $menus]);
                break;
        }

    }


    public function insert($id, $id_menu)
    {
        $menus = Menu::all();
        switch ($id_menu) {

            case 1:
                $kategori = Category::find($id);
                $menu = Menu::find($id_menu);
                return view('tourism/insert', ['data' => $kategori, 'menu' => $menu, 'menus' => $menus]);
                break;
            case 2:
                $kategori = Category::find($id);
                $menu = Menu::find($id_menu);
                return view('hotel/insert', ['data' => $kategori, 'menu' => $menu, 'menus' => $menus]);
                break;
            case 3:
                $kategori = Category::find($id);
                $menu = Menu::find($id_menu);
                return view('culinary/insert', ['data' => $kategori, 'menu' => $menu, 'menus' => $menus]);
                break;
            case 4:
                $kategori = Category::find($id);
                $menu = Menu::find($id_menu);
                return view('shopping/insert', ['data' => $kategori, 'menu' => $menu, 'menus' => $menus]);
                break;
            case 5:
                $items = Praying::find($id);
                $kategori = Category::all()->where('id_menu', $id_menu);;
                return view('praying/edit', ['item' => $items, 'datas' => $kategori, 'menus' => $menus]);
                break;
            case 6:
                $kategori = Category::find($id);
                $menu = Menu::find($id_menu);
                return view('transportation/insert', ['data' => $kategori, 'menu' => $menu, 'menus' => $menus]);
                break;
            case 7:
                $kategori = Category::find($id);
                $menu = Menu::find($id_menu);
                return view('public_service/insert', ['data' => $kategori, 'menu' => $menu, 'menus' => $menus]);
                break;
            case 8:
                $kategori = Category::find($id);
                $menu = Menu::find($id_menu);
                return view('finance/insert', ['data' => $kategori, 'menu' => $menu, 'menus' => $menus]);
                break;
            case 9:
                $kategori = Category::find($id);
                $menu = Menu::find($id_menu);
                return view('asset/insert', ['data' => $kategori, 'menu' => $menu, 'menus' => $menus]);
                break;
            case 10:
                $kategori = Category::find($id);
                $menu = Menu::find($id_menu);
                return view('culture/insert', ['data' => $kategori, 'menu' => $menu, 'menus' => $menus]);
                break;
            case 11:
                $kategori = Category::find($id);
                $menu = Menu::find($id_menu);
                return view('leisure/insert', ['data' => $kategori, 'menu' => $menu, 'menus' => $menus]);
                break;
            case 12:
                $kategori = Category::find($id);
                $menu = Menu::find($id_menu);
                return view('health/insert', ['data' => $kategori, 'menu' => $menu, 'menus' => $menus]);
                break;
            case 13:
                $kategori = Category::find($id);
                $menu = Menu::find($id_menu);
                return view('event/insert', ['data' => $kategori, 'menu' => $menu, 'menus' => $menus]);
                break;
            case 14:
                $kategori = Category::find($id);
                $menu = Menu::find($id_menu);
                return view('visitor/insert', ['data' => $kategori, 'menu' => $menu, 'menus' => $menus]);
                break;
            case 15:
                $kategori = Category::find($id);
                $menu = Menu::find($id_menu);
                $identity = IdentityType::all();
                return view('booking/insert', ['data' => $kategori, 'menu' => $menu, 'menus' => $menus,'identities'=>$identity]);
                break;
            case 16:
                $kategori = Category::find($id);
                $menu = Menu::find($id_menu);
                return view('review/insert', ['data' => $kategori, 'menu' => $menu, 'menus' => $menus]);
                break;
        }

    }

    public function insertWithCategory($id)
    {
        $menus = Menu::all();
        switch ($id) {

            case 1:
                $kategori = Category::all()->where('id_menu', $id);
                $menu = Menu::find($id);
                return view('tourism/insert-with-category', ['datas' => $kategori, 'menu' => $menu, 'menus' => $menus]);
                break;
            case 2:
                $kategori = Category::all()->where('id_menu', $id);
                $menu = Menu::find($id);
                return view('hotel/insert-with-category', ['datas' => $kategori, 'menu' => $menu, 'menus' => $menus]);
                break;
            case 3:
                $kategori = Category::all()->where('id_menu', $id);
                $menu = Menu::find($id);
                return view('culinary/insert-with-category', ['datas' => $kategori, 'menu' => $menu, 'menus' => $menus]);
                break;
            case 4:
                $kategori = Category::all()->where('id_menu', $id);
                $menu = Menu::find($id);
                return view('shopping/insert-with-category', ['datas' => $kategori, 'menu' => $menu, 'menus' => $menus]);
                break;
            case 5:
                $kategori = Category::all()->where('id_menu', $id);
                $menu = Menu::find($id);
                return view('praying/insert-with-category', ['datas' => $kategori, 'menu' => $menu, 'menus' => $menus]);
                break;
            case 6:
                $kategori = Category::all()->where('id_menu', $id);
                $menu = Menu::find($id);
                return view('transportation/insert-with-category', ['datas' => $kategori, 'menu' => $menu, 'menus' => $menus]);
                break;
            case 7:
                $kategori = Category::all()->where('id_menu', $id);
                $menu = Menu::find($id);
                return view('public_service/insert-with-category', ['datas' => $kategori, 'menu' => $menu, 'menus' => $menus]);
                break;
            case 8:
                $kategori = Category::all()->where('id_menu', $id);
                $menu = Menu::find($id);
                return view('finance/insert-with-category', ['datas' => $kategori, 'menu' => $menu, 'menus' => $menus]);
                break;
            case 9:
                $kategori = Category::all()->where('id_menu', $id);
                $menu = Menu::find($id);
                return view('asset/insert-with-category', ['datas' => $kategori, 'menu' => $menu, 'menus' => $menus]);
                break;
            case 10:
                $kategori = Category::all()->where('id_menu', $id);
                $menu = Menu::find($id);
                return view('culture/insert-with-category', ['datas' => $kategori, 'menu' => $menu, 'menus' => $menus]);
                break;
            case 11:
                $kategori = Category::all()->where('id_menu', $id);
                $menu = Menu::find($id);
                return view('leisure/insert-with-category', ['datas' => $kategori, 'menu' => $menu, 'menus' => $menus]);
                break;
            case 12:
                $kategori = Category::all()->where('id_menu', $id);
                $menu = Menu::find($id);
                return view('health/insert-with-category', ['datas' => $kategori, 'menu' => $menu, 'menus' => $menus]);
                break;
            case 13:
                $kategori = Category::all()->where('id_menu', $id);
                $menu = Menu::find($id);
                return view('event/insert-with-category', ['datas' => $kategori, 'menu' => $menu, 'menus' => $menus]);
                break;
            case 14:
                $kategori = Category::all()->where('id_menu', $id);
                $menu = Menu::find($id);
                return view('visitor/insert-with-category', ['datas' => $kategori, 'menu' => $menu, 'menus' => $menus]);
                break;
            case 15:
                $kategori = Category::all()->where('id_menu', $id);
                $menu = Menu::find($id);
                return view('booking/insert-with-category', ['datas' => $kategori, 'menu' => $menu, 'menus' => $menus]);
                break;
            case 16:
                $kategori = Category::all()->where('id_menu', $id);
                $menu = Menu::find($id);
                return view('review/insert-with-category', ['datas' => $kategori, 'menu' => $menu, 'menus' => $menus]);
                break;
        }

    }


    public function store(Request $request, $id, $id_menu)
    {
        switch ($request->id_menu) {
            case 1:
                $data = new Tourism();
                $data->name = $request->name;
                $data->address = $request->address;
                $data->phone = $request->phone;
                $data->manager = $request->manager;
                $data->description = $request->description;
                $data->price = $request->price;
                $data->open = $request->open;
                $data->close = $request->close;
                $data->id_category = $request->id_category;
                $data->id_menu = $request->id_menu;
                $data->created_by = Auth::user()->id;
                $data->save();
                Alert::success('Data Berhasil Disimpan');
                return redirect('showMenu/' . $request->id_menu);
                break;
            case 2:
                $data = new Hotel();
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
                return redirect('showMenu/' . $request->id_menu);
                break;
            case 3:
                $data = new Culinary();
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
                return redirect('showMenu/' . $request->id_menu);
                break;
            case 4:
                $data = new Shopping();
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
                return redirect('showMenu/' . $request->id_menu);
                break;
            case 5:
                $data = new Praying();
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
                return redirect('showMenu/' . $request->id_menu);
                break;
            case 6:
                $data = new Transportation();
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
                return redirect('showMenu/' . $request->id_menu);
                break;
            case 7;
                $data = new PublicService();
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
                return redirect('showMenu/' . $request->id_menu);
                break;
            case 8:
                $data = new Finance();
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
                return redirect('showMenu/' . $request->id_menu);
                break;
            case 9:
                $data = new Asset();
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
                return redirect('showMenu/' . $request->id_menu);
                break;
            case 10:
                $data = new Culture();
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
                return redirect('showMenu/' . $request->id_menu);
                break;
            case 11:
                $data = new Leisure();
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
                return redirect('showMenu/' . $request->id_menu);
                break;
            case 12:
                $data = new Health();
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
                return redirect('showMenu/' . $request->id_menu);
                break;
            case 13:
                $data = new Event();
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
                return redirect('showMenu/' . $request->id_menu);
                break;
            case 14:
                $data = new Visitor();
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
                return redirect('showMenu/' . $request->id_menu);
                break;

        }
    }

    public function ubah($id, $id_menu)
    {
        $menus = Menu::all();
        switch ($id_menu) {

            case 1:
                $items = Tourism::find($id);
                $kategori = Category::all()->where('id_menu', $id_menu);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object',$id);
                return view('tourism/edit', ['item' => $items, 'datas' => $kategori, 'menu' => $menu, 'pictures'=>$gambar, 'menus' => $menus]);
                break;
            case 2:
                $items = Hotel::find($id);
                $kategori = Category::all()->where('id_menu', $id_menu);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object',$id);
                return view('hotel/edit', ['item' => $items, 'datas' => $kategori, 'menu' => $menu, 'pictures'=>$gambar, 'menus' => $menus]);
                break;
            case 3:
                $items = Culinary::find($id);
                $kategori = Category::all()->where('id_menu', $id_menu);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object',$id);
                return view('culinary/edit', ['item' => $items, 'datas' => $kategori, 'menu' => $menu, 'pictures'=>$gambar, 'menus' => $menus]);
                break;
            case 4:
                $items = Shopping::find($id);
                $kategori = Category::all()->where('id_menu', $id_menu);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object',$id);
                return view('shopping/edit', ['item' => $items, 'datas' => $kategori, 'menu' => $menu, 'pictures'=>$gambar, 'menus' => $menus]);
                break;
            case 5:
                $items = Praying::find($id);
                $kategori = Category::all()->where('id_menu', $id_menu);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object',$id);
                return view('praying/edit', ['item' => $items, 'datas' => $kategori, 'menu' => $menu, 'pictures'=>$gambar, 'menus' => $menus]);
                break;
            case 6:
                $items = Transportation::find($id);
                $kategori = Category::all()->where('id_menu', $id_menu);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object',$id);
                return view('transportation/edit', ['item' => $items, 'datas' => $kategori, 'menu' => $menu, 'pictures'=>$gambar, 'menus' => $menus]);
                break;
            case 7:
                $items = PublicService::find($id);
                $kategori = Category::all()->where('id_menu', $id_menu);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object',$id);
                return view('public_service/edit', ['item' => $items, 'datas' => $kategori, 'menu' => $menu, 'pictures'=>$gambar, 'menus' => $menus]);
                break;
            case 8:
                $items = Finance::find($id);
                $kategori = Category::all()->where('id_menu', $id_menu);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object',$id);
                return view('finance/edit', ['item' => $items, 'datas' => $kategori, 'menu' => $menu,'pictures'=>$gambar, 'menus' => $menus]);
                break;
            case 9:
                $items = Asset::find($id);
                $kategori = Category::all()->where('id_menu', $id_menu);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object',$id);
                return view('asset/edit', ['item' => $items, 'datas' => $kategori, 'menu' => $menu,'pictures'=>$gambar, 'menus' => $menus]);
                break;
            case 10:
                $items = Culture::find($id);
                $kategori = Category::all()->where('id_menu', $id_menu);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object',$id);
                return view('culture/edit', ['item' => $items, 'datas' => $kategori, 'menu' => $menu, 'pictures'=>$gambar, 'menus' => $menus]);
                break;
            case 11:
                $items = Leisure::find($id);
                $kategori = Category::all()->where('id_menu', $id_menu);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object',$id);
                return view('leisure/edit', ['item' => $items, 'datas' => $kategori, 'menu' => $menu,'pictures'=>$gambar, 'menus' => $menus]);
                break;
            case 12:
                $items = Health::find($id);
                $kategori = Category::all()->where('id_menu', $id_menu);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object',$id);
                return view('health/edit', ['item' => $items, 'datas' => $kategori, 'menu' => $menu,'pictures'=>$gambar, 'menus' => $menus]);
                break;
            case 13:
                $items = Event::find($id);
                $kategori = Category::all()->where('id_menu', $id_menu);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object',$id);
                return view('event/edit', ['item' => $items, 'datas' => $kategori, 'menu' => $menu,'pictures'=>$gambar, 'menus' => $menus]);
                break;
            case 14:
                $items = Visitor::find($id);
                $kategori = Category::all()->where('id_menu', $id_menu);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object',$id);
                return view('visitor/edit', ['item' => $items, 'datas' => $kategori, 'menu' => $menu,'pictures'=>$gambar, 'menus' => $menus]);
                break;
            case 15:
                $items = Booking::find($id);
                $kategori = Category::all()->where('id_menu', $id_menu);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object',$id);
                return view('booking/edit', ['item' => $items, 'datas' => $kategori, 'menu' => $menu,'pictures'=>$gambar, 'menus' => $menus]);
                break;
            case 16:
                $items = Review::find($id);
                $kategori = Category::all()->where('id_menu', $id_menu);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object',$id);
                return view('review/edit', ['item' => $items, 'datas' => $kategori, 'menu' => $menu,'pictures'=>$gambar, 'menus' => $menus]);
                break;
        }
    }

    public function edit($id_category, $id, $id_menu)
    {
        $menus = Menu::all();
        switch ($id_menu) {

            case 1:
                $items = Tourism::find($id);
                $kategori = Category::all()->where('id_menu', $id_menu);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object',$id);
                return view('tourism/edit', ['item' => $items, 'datas' => $kategori, 'menu' => $menu, 'pictures'=>$gambar, 'menus' => $menus]);
                break;
            case 2:
                $items = Hotel::find($id);
                $kategori = Category::all()->where('id_menu', $id_menu);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object',$id);
                return view('hotel/edit', ['item' => $items, 'datas' => $kategori, 'menu' => $menu, 'pictures'=>$gambar, 'menus' => $menus]);
                break;
            case 3:
                $items = Culinary::find($id);
                $kategori = Category::all()->where('id_menu', $id_menu);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object',$id);
                return view('culinary/edit', ['item' => $items, 'datas' => $kategori, 'menu' => $menu, 'pictures'=>$gambar, 'menus' => $menus]);
                break;
            case 4:
                $items = Shopping::find($id);
                $kategori = Category::all()->where('id_menu', $id_menu);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object',$id);
                return view('shopping/edit', ['item' => $items, 'datas' => $kategori, 'menu' => $menu, 'pictures'=>$gambar, 'menus' => $menus]);
                break;
            case 5:
                $items = Praying::find($id);
                $kategori = Category::all()->where('id_menu', $id_menu);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object',$id);
                return view('praying/edit', ['item' => $items, 'datas' => $kategori, 'menu' => $menu, 'pictures'=>$gambar, 'menus' => $menus]);
                break;
            case 6:
                $items = Transportation::find($id);
                $kategori = Category::all()->where('id_menu', $id_menu);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object',$id);
                return view('transportation/edit', ['item' => $items, 'datas' => $kategori, 'menu' => $menu, 'pictures'=>$gambar, 'menus' => $menus]);
                break;
            case 7:
                $items = PublicService::find($id);
                $kategori = Category::all()->where('id_menu', $id_menu);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object',$id);
                return view('public_service/edit', ['item' => $items, 'datas' => $kategori, 'menu' => $menu, 'pictures'=>$gambar, 'menus' => $menus]);
                break;
            case 8:
                $items = Finance::find($id);
                $kategori = Category::all()->where('id_menu', $id_menu);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object',$id);
                return view('finance/edit', ['item' => $items, 'datas' => $kategori, 'menu' => $menu,'pictures'=>$gambar, 'menus' => $menus]);
                break;
            case 9:
                $items = Asset::find($id);
                $kategori = Category::all()->where('id_menu', $id_menu);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object',$id);
                return view('asset/edit', ['item' => $items, 'datas' => $kategori, 'menu' => $menu,'pictures'=>$gambar, 'menus' => $menus]);
                break;
            case 10:
                $items = Culture::find($id);
                $kategori = Category::all()->where('id_menu', $id_menu);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object',$id);
                return view('culture/edit', ['item' => $items, 'datas' => $kategori, 'menu' => $menu, 'pictures'=>$gambar, 'menus' => $menus]);
                break;
            case 11:
                $items = Leisure::find($id);
                $kategori = Category::all()->where('id_menu', $id_menu);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object',$id);
                return view('leisure/edit', ['item' => $items, 'datas' => $kategori, 'menu' => $menu,'pictures'=>$gambar, 'menus' => $menus]);
                break;
            case 12:
                $items = Health::find($id);
                $kategori = Category::all()->where('id_menu', $id_menu);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object',$id);
                return view('health/edit', ['item' => $items, 'datas' => $kategori, 'menu' => $menu,'pictures'=>$gambar, 'menus' => $menus]);
                break;
            case 13:
                $items = Event::find($id);
                $kategori = Category::all()->where('id_menu', $id_menu);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object',$id);
                return view('event/edit', ['item' => $items, 'datas' => $kategori, 'menu' => $menu,'pictures'=>$gambar, 'menus' => $menus]);
                break;
            case 14:
                $items = Visitor::find($id);
                $kategori = Category::all()->where('id_menu', $id_menu);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object',$id);
                return view('visitor/edit', ['item' => $items, 'datas' => $kategori, 'menu' => $menu,'pictures'=>$gambar, 'menus' => $menus]);
                break;
            case 15:
                $items = Booking::find($id);
                $kategori = Category::all()->where('id_menu', $id_menu);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object',$id);
                return view('booking/edit', ['item' => $items, 'datas' => $kategori, 'menu' => $menu,'pictures'=>$gambar, 'menus' => $menus]);
                break;
            case 16:
                $items = Review::find($id);
                $kategori = Category::all()->where('id_menu', $id_menu);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object',$id);
                return view('review/edit', ['item' => $items, 'datas' => $kategori, 'menu' => $menu,'pictures'=>$gambar, 'menus' => $menus]);
                break;
        }
    }

    public function simpan(Request $request, $id, $id_menu)
    {
        switch ($id_menu) {

            case 1:
                $lokasi = Tourism::find($id);
                $lokasi->name = $request->name;
                $lokasi->address = $request->address;
                $lokasi->phone = $request->phone;
                $lokasi->manager = $request->manager;
                $lokasi->description = $request->description;
                $lokasi->price = $request->price;
                $lokasi->open = $request->open;
                $lokasi->close = $request->close;
                $lokasi->lat = $request->lat;
                $lokasi->lng = $request->lng;
                $lokasi->id_category = $request->id_category;
                $lokasi->save();
                Alert::success('Data Berhasil Diubah');
                return redirect('showMenu/' . $request->id_menu);
                break;
            case 2:
                $lokasi = Hotel::find($id);
                $lokasi->name = $request->name;
                $lokasi->address = $request->address;
                $lokasi->phone = $request->phone;
                $lokasi->price = $request->price;
                $lokasi->description = $request->description;
                $lokasi->open = $request->open;
                $lokasi->close = $request->close;
                $lokasi->lat = $request->lat;
                $lokasi->lng = $request->lng;
                $lokasi->id_category = $request->id_category;
                $this->multipleUpload($id, $id_menu);
                $lokasi->save();
                Alert::success('Data Berhasil Diubah');
                return redirect()->back();
                break;
            case 3:
                $lokasi = Culinary::find($id);
                $lokasi->name = $request->name;
                $lokasi->address = $request->address;
                $lokasi->phone = $request->phone;
                $lokasi->price = $request->price;
                $lokasi->description = $request->description;
                $lokasi->open = $request->open;
                $lokasi->close = $request->close;
                $lokasi->lat = $request->lat;
                $lokasi->lng = $request->lng;
                $lokasi->id_category = $request->id_category;
                $lokasi->save();
                Alert::success('Data Berhasil Diubah');
                return redirect('showMenu/' . $request->id_menu);
                break;
            case 4:
                $lokasi = Shopping::find($id);
                $lokasi->name = $request->name;
                $lokasi->address = $request->address;
                $lokasi->phone = $request->phone;
                $lokasi->price = $request->price;
                $lokasi->description = $request->description;
                $lokasi->open = $request->open;
                $lokasi->close = $request->close;
                $lokasi->lat = $request->lat;
                $lokasi->lng = $request->lng;
                $lokasi->id_category = $request->id_category;
                $lokasi->save();
                Alert::success('Data Berhasil Diubah');
                return redirect('showMenu/' . $request->id_menu);
                break;
            case 5:
                $lokasi = Praying::find($id);
                $lokasi->name = $request->name;
                $lokasi->address = $request->address;
                $lokasi->phone = $request->phone;
                $lokasi->price = $request->price;
                $lokasi->description = $request->description;
                $lokasi->open = $request->open;
                $lokasi->close = $request->close;
                $lokasi->lat = $request->lat;
                $lokasi->lng = $request->lng;
                $lokasi->id_category = $request->id_category;
                $lokasi->save();
                Alert::success('Data Berhasil Diubah');
                return redirect('showMenu/' . $request->id_menu);
                break;
            case 6:
                $lokasi = Transportation::find($id);
                $lokasi->name = $request->name;
                $lokasi->address = $request->address;
                $lokasi->phone = $request->phone;
                $lokasi->price = $request->price;
                $lokasi->description = $request->description;
                $lokasi->open = $request->open;
                $lokasi->close = $request->close;
                $lokasi->lat = $request->lat;
                $lokasi->lng = $request->lng;
                $lokasi->id_category = $request->id_category;
                $lokasi->save();
                Alert::success('Data Berhasil Diubah');
                return redirect('showMenu/' . $request->id_menu);
                break;
            case 7:
                $lokasi = PublicService::find($id);
                $lokasi->name = $request->name;
                $lokasi->address = $request->address;
                $lokasi->phone = $request->phone;
                $lokasi->price = $request->price;
                $lokasi->description = $request->description;
                $lokasi->open = $request->open;
                $lokasi->close = $request->close;
                $lokasi->lat = $request->lat;
                $lokasi->lng = $request->lng;
                $lokasi->id_category = $request->id_category;
                $lokasi->save();
                Alert::success('Data Berhasil Diubah');
                return redirect('showMenu/' . $request->id_menu);
                break;
            case 8:
                $lokasi = Finance::find($id);
                $lokasi->name = $request->name;
                $lokasi->address = $request->address;
                $lokasi->phone = $request->phone;
                $lokasi->price = $request->price;
                $lokasi->description = $request->description;
                $lokasi->open = $request->open;
                $lokasi->close = $request->close;
                $lokasi->lat = $request->lat;
                $lokasi->lng = $request->lng;
                $lokasi->id_category = $request->id_category;
                $lokasi->save();
                Alert::success('Data Berhasil Diubah');
                return redirect('showMenu/' . $request->id_menu);
                break;
            case 9:
                $lokasi = Asset::find($id);
                $lokasi->name = $request->name;
                $lokasi->address = $request->address;
                $lokasi->phone = $request->phone;
                $lokasi->price = $request->price;
                $lokasi->description = $request->description;
                $lokasi->open = $request->open;
                $lokasi->close = $request->close;
                $lokasi->lat = $request->lat;
                $lokasi->lng = $request->lng;
                $lokasi->id_category = $request->id_category;
                $lokasi->save();
                Alert::success('Data Berhasil Diubah');
                return redirect('showMenu/' . $request->id_menu);
                break;
            case 10:
                $lokasi = Culture::find($id);
                $lokasi->name = $request->name;
                $lokasi->address = $request->address;
                $lokasi->phone = $request->phone;
                $lokasi->price = $request->price;
                $lokasi->description = $request->description;
                $lokasi->open = $request->open;
                $lokasi->close = $request->close;
                $lokasi->lat = $request->lat;
                $lokasi->lng = $request->lng;
                $lokasi->id_category = $request->id_category;
                $lokasi->save();
                Alert::success('Data Berhasil Diubah');
                return redirect('showMenu/' . $request->id_menu);
                break;
            case 11:
                $lokasi = Leisure::find($id);
                $lokasi->name = $request->name;
                $lokasi->address = $request->address;
                $lokasi->phone = $request->phone;
                $lokasi->price = $request->price;
                $lokasi->description = $request->description;
                $lokasi->open = $request->open;
                $lokasi->close = $request->close;
                $lokasi->lat = $request->lat;
                $lokasi->lng = $request->lng;
                $lokasi->id_category = $request->id_category;
                $lokasi->save();
                Alert::success('Data Berhasil Diubah');
                return redirect('showMenu/' . $request->id_menu);
                break;
            case 12:
                $lokasi = Health::find($id);
                $lokasi->name = $request->name;
                $lokasi->address = $request->address;
                $lokasi->phone = $request->phone;
                $lokasi->price = $request->price;
                $lokasi->description = $request->description;
                $lokasi->open = $request->open;
                $lokasi->close = $request->close;
                $lokasi->lat = $request->lat;
                $lokasi->lng = $request->lng;
                $lokasi->id_category = $request->id_category;
                $lokasi->save();
                Alert::success('Data Berhasil Diubah');
                return redirect('showMenu/' . $request->id_menu);
                break;
            case 13:
                $lokasi = Event::find($id);
                $lokasi->name = $request->name;
                $lokasi->address = $request->address;
                $lokasi->phone = $request->phone;
                $lokasi->manager = $request->manager;
                $lokasi->description = $request->description;
                $lokasi->price = $request->price;
                $lokasi->open = $request->open;
                $lokasi->close = $request->close;
                $lokasi->lat = $request->lat;
                $lokasi->lng = $request->lng;
                $lokasi->id_category = $request->id_category;
                $lokasi->save();
                Alert::success('Data Berhasil Diubah');
                return redirect('showMenu/' . $request->id_menu);
                break;
            case 14:
                $lokasi = Event::find($id);
                $lokasi->name = $request->name;
                $lokasi->address = $request->address;
                $lokasi->phone = $request->phone;
                $lokasi->price = $request->price;
                $lokasi->description = $request->description;
                $lokasi->open = $request->open;
                $lokasi->close = $request->close;
                $lokasi->lat = $request->lat;
                $lokasi->lng = $request->lng;
                $lokasi->id_category = $request->id_category;
                $lokasi->save();
                Alert::success('Data Berhasil Diubah');
                return redirect('showMenu/' . $request->id_menu);
                break;
        }

    }

    public function update(Request $request, $id_category, $id, $id_menu)
    {
        switch ($id_menu) {

            case 1:
                $lokasi = Tourism::find($id);
                $lokasi->name = $request->name;
                $lokasi->address = $request->address;
                $lokasi->phone = $request->phone;
                $lokasi->manager = $request->manager;
                $lokasi->description = $request->description;
                $lokasi->price = $request->price;
                $lokasi->open = $request->open;
                $lokasi->close = $request->close;
                $lokasi->lat = $request->lat;
                $lokasi->lng = $request->lng;
                $lokasi->id_category = $request->id_category;
                $lokasi->save();
                Alert::success('Data Berhasil Diubah');
                return redirect('showMenu/' . $request->id_menu);
                break;
            case 2:
                $lokasi = Hotel::find($id);
                $lokasi->name = $request->name;
                $lokasi->address = $request->address;
                $lokasi->phone = $request->phone;
                $lokasi->price = $request->price;
                $lokasi->description = $request->description;
                $lokasi->open = $request->open;
                $lokasi->close = $request->close;
                $lokasi->lat = $request->lat;
                $lokasi->lng = $request->lng;
                $lokasi->id_category = $request->id_category;
                $lokasi->save();
                Alert::success('Data Berhasil Diubah');
                return redirect()->back();
                break;
            case 3:
                $lokasi = Culinary::find($id);
                $lokasi->name = $request->name;
                $lokasi->address = $request->address;
                $lokasi->phone = $request->phone;
                $lokasi->price = $request->price;
                $lokasi->description = $request->description;
                $lokasi->open = $request->open;
                $lokasi->close = $request->close;
                $lokasi->lat = $request->lat;
                $lokasi->lng = $request->lng;
                $lokasi->id_category = $request->id_category;
                $lokasi->save();
                Alert::success('Data Berhasil Diubah');
                return redirect('showMenu/' . $request->id_menu);
                break;
            case 4:
                $lokasi = Shopping::find($id);
                $lokasi->name = $request->name;
                $lokasi->address = $request->address;
                $lokasi->phone = $request->phone;
                $lokasi->price = $request->price;
                $lokasi->description = $request->description;
                $lokasi->open = $request->open;
                $lokasi->close = $request->close;
                $lokasi->lat = $request->lat;
                $lokasi->lng = $request->lng;
                $lokasi->id_category = $request->id_category;
                $lokasi->save();
                Alert::success('Data Berhasil Diubah');
                return redirect('showMenu/' . $request->id_menu);
                break;
            case 5:
                $lokasi = Praying::find($id);
                $lokasi->name = $request->name;
                $lokasi->address = $request->address;
                $lokasi->phone = $request->phone;
                $lokasi->price = $request->price;
                $lokasi->description = $request->description;
                $lokasi->open = $request->open;
                $lokasi->close = $request->close;
                $lokasi->lat = $request->lat;
                $lokasi->lng = $request->lng;
                $lokasi->id_category = $request->id_category;
                $lokasi->save();
                Alert::success('Data Berhasil Diubah');
                return redirect('showMenu/' . $request->id_menu);
                break;
            case 6:
                $lokasi = Transportation::find($id);
                $lokasi->name = $request->name;
                $lokasi->address = $request->address;
                $lokasi->phone = $request->phone;
                $lokasi->price = $request->price;
                $lokasi->description = $request->description;
                $lokasi->open = $request->open;
                $lokasi->close = $request->close;
                $lokasi->lat = $request->lat;
                $lokasi->lng = $request->lng;
                $lokasi->id_category = $request->id_category;
                $lokasi->save();
                Alert::success('Data Berhasil Diubah');
                return redirect('showMenu/' . $request->id_menu);
                break;
            case 7:
                $lokasi = PublicService::find($id);
                $lokasi->name = $request->name;
                $lokasi->address = $request->address;
                $lokasi->phone = $request->phone;
                $lokasi->price = $request->price;
                $lokasi->description = $request->description;
                $lokasi->open = $request->open;
                $lokasi->close = $request->close;
                $lokasi->lat = $request->lat;
                $lokasi->lng = $request->lng;
                $lokasi->id_category = $request->id_category;
                $lokasi->save();
                Alert::success('Data Berhasil Diubah');
                return redirect('showMenu/' . $request->id_menu);
                break;
            case 8:
                $lokasi = Finance::find($id);
                $lokasi->name = $request->name;
                $lokasi->address = $request->address;
                $lokasi->phone = $request->phone;
                $lokasi->price = $request->price;
                $lokasi->description = $request->description;
                $lokasi->open = $request->open;
                $lokasi->close = $request->close;
                $lokasi->lat = $request->lat;
                $lokasi->lng = $request->lng;
                $lokasi->id_category = $request->id_category;
                $lokasi->save();
                Alert::success('Data Berhasil Diubah');
                return redirect('showMenu/' . $request->id_menu);
                break;
            case 9:
                $lokasi = Asset::find($id);
                $lokasi->name = $request->name;
                $lokasi->address = $request->address;
                $lokasi->phone = $request->phone;
                $lokasi->price = $request->price;
                $lokasi->description = $request->description;
                $lokasi->open = $request->open;
                $lokasi->close = $request->close;
                $lokasi->lat = $request->lat;
                $lokasi->lng = $request->lng;
                $lokasi->id_category = $request->id_category;
                $lokasi->save();
                Alert::success('Data Berhasil Diubah');
                return redirect('showMenu/' . $request->id_menu);
                break;
            case 10:
                $lokasi = Culture::find($id);
                $lokasi->name = $request->name;
                $lokasi->address = $request->address;
                $lokasi->phone = $request->phone;
                $lokasi->price = $request->price;
                $lokasi->description = $request->description;
                $lokasi->open = $request->open;
                $lokasi->close = $request->close;
                $lokasi->lat = $request->lat;
                $lokasi->lng = $request->lng;
                $lokasi->id_category = $request->id_category;
                $lokasi->save();
                Alert::success('Data Berhasil Diubah');
                return redirect('showMenu/' . $request->id_menu);
                break;
            case 11:
                $lokasi = Leisure::find($id);
                $lokasi->name = $request->name;
                $lokasi->address = $request->address;
                $lokasi->phone = $request->phone;
                $lokasi->price = $request->price;
                $lokasi->description = $request->description;
                $lokasi->open = $request->open;
                $lokasi->close = $request->close;
                $lokasi->lat = $request->lat;
                $lokasi->lng = $request->lng;
                $lokasi->id_category = $request->id_category;
                $lokasi->save();
                Alert::success('Data Berhasil Diubah');
                return redirect('showMenu/' . $request->id_menu);
                break;
            case 12:
                $lokasi = Health::find($id);
                $lokasi->name = $request->name;
                $lokasi->address = $request->address;
                $lokasi->phone = $request->phone;
                $lokasi->price = $request->price;
                $lokasi->description = $request->description;
                $lokasi->open = $request->open;
                $lokasi->close = $request->close;
                $lokasi->lat = $request->lat;
                $lokasi->lng = $request->lng;
                $lokasi->id_category = $request->id_category;
                $lokasi->save();
                Alert::success('Data Berhasil Diubah');
                return redirect('showMenu/' . $request->id_menu);
                break;
            case 12:
                $lokasi = Event::find($id);
                $lokasi->name = $request->name;
                $lokasi->address = $request->address;
                $lokasi->phone = $request->phone;
                $lokasi->price = $request->price;
                $lokasi->description = $request->description;
                $lokasi->open = $request->open;
                $lokasi->close = $request->close;
                $lokasi->lat = $request->lat;
                $lokasi->lng = $request->lng;
                $lokasi->id_category = $request->id_category;
                $lokasi->save();
                Alert::success('Data Berhasil Diubah');
                return redirect('showMenu/' . $request->id_menu);
                break;
            case 14:
                $lokasi = Visitor::find($id);
                $lokasi->name = $request->name;
                $lokasi->address = $request->address;
                $lokasi->phone = $request->phone;
                $lokasi->price = $request->price;
                $lokasi->description = $request->description;
                $lokasi->open = $request->open;
                $lokasi->close = $request->close;
                $lokasi->lat = $request->lat;
                $lokasi->lng = $request->lng;
                $lokasi->id_category = $request->id_category;
                $lokasi->save();
                Alert::success('Data Berhasil Diubah');
                return redirect('showMenu/' . $request->id_menu);
                break;
        }
    }

    public function lihat($id, $id_category, $id_menu)
    {
        $menus = Menu::all();
        switch ($id_menu) {
            case 1:
                $items = Tourism::find($id);
                $kategori = Category::find($id_category);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object',$id);
                return view('tourism/view', ['item' => $items, 'data' => $kategori, 'menu' => $menu,'pictures'=>$gambar, 'menus'=>$menus]);
                break;
            case 2:
                $items = Hotel::find($id);
                $kategori = Category::find($id_category);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object',$id);
                return view('hotel/view', ['item' => $items, 'data' => $kategori, 'menu' => $menu, 'pictures'=>$gambar, 'menus'=>$menus]);
                break;
            case 3:
                $items = Culinary::find($id);
                $kategori = Category::find($id_category);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object',$id);
                return view('culinary/view', ['item' => $items, 'data' => $kategori, 'menu' => $menu,'pictures'=>$gambar, 'menus'=>$menus]);
                break;
            case 4:
                $items = Shopping::find($id);
                $kategori = Category::find($id_category);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object',$id);
                return view('shopping/view', ['item' => $items, 'data' => $kategori, 'menu' => $menu,'pictures'=>$gambar, 'menus'=>$menus]);
                break;
            case 5:
                $items = Praying::find($id);
                $kategori = Category::find($id_category);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object',$id);
                return view('praying/view', ['item' => $items, 'data' => $kategori, 'menu' => $menu,'pictures'=>$gambar, 'menus'=>$menus]);
                break;
            case 6:
                $items = Transportation::find($id);
                $kategori = Category::find($id_category);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object',$id);
                return view('transportation/view', ['item' => $items, 'data' => $kategori, 'menu' => $menu,'pictures'=>$gambar, 'menus'=>$menus]);
                break;
            case 7:
                $items = PublicService::find($id);
                $kategori = Category::find($id_category);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object',$id);
                return view('public_service/view', ['item' => $items, 'data' => $kategori, 'menu' => $menu,'pictures'=>$gambar, 'menus'=>$menus]);
                break;
            case 8:
                $items = Finance::find($id);
                $kategori = Category::find($id_category);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object',$id);
                return view('finance/view', ['item' => $items, 'data' => $kategori, 'menu' => $menu,'pictures'=>$gambar, 'menus'=>$menus]);
                break;
            case 9:
                $items = Asset::find($id);
                $kategori = Category::find($id_category);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object',$id);
                return view('asset/view', ['item' => $items, 'data' => $kategori, 'menu' => $menu,'pictures'=>$gambar, 'menus'=>$menus]);
                break;
            case 10:
                $items = Culture::find($id);
                $kategori = Category::find($id_category);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object',$id);
                return view('culture/view', ['item' => $items, 'data' => $kategori, 'menu' => $menu,'pictures'=>$gambar, 'menus'=>$menus]);
                break;
            case 11:
                $items = Leisure::find($id);
                $kategori = Category::find($id_category);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object',$id);
                return view('leisure/view', ['item' => $items, 'data' => $kategori, 'menu' => $menu,'pictures'=>$gambar, 'menus'=>$menus]);
                break;
            case 12:
                $items = Health::find($id);
                $kategori = Category::find($id_category);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object',$id);
                return view('health/view', ['item' => $items, 'data' => $kategori, 'menu' => $menu,'pictures'=>$gambar, 'menus'=>$menus]);
                break;
            case 13:
                $items = Event::find($id);
                $kategori = Category::find($id_category);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object',$id);
                return view('event/view', ['item' => $items, 'data' => $kategori, 'menu' => $menu,'pictures'=>$gambar, 'menus'=>$menus]);
                break;
            case 14:
                $items = Visitor::find($id);
                $kategori = Category::find($id_category);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object',$id);
                return view('visitor/view', ['item' => $items, 'data' => $kategori, 'menu' => $menu,'pictures'=>$gambar, 'menus'=>$menus]);
                break;
            case 15:
                $items = Booking::find($id);
                $kategori = Category::find($id_category);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object',$id);
                return view('booking/view', ['item' => $items, 'data' => $kategori, 'menu' => $menu,'pictures'=>$gambar, 'menus'=>$menus]);
                break;
            case 16:
                $items = Review::find($id);
                $kategori = Category::find($id_category);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object',$id);
                return view('review/view', ['item' => $items, 'data' => $kategori, 'menu' => $menu,'pictures'=>$gambar, 'menus'=>$menus]);
                break;
        }

    }

    public function view($id_category, $id, $id_menu)
    {
        $menus = Menu::all();
        switch ($id_menu) {
            case 1:
                $items = Tourism::find($id);
                $kategori = Category::find($id_category);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object',$id);
                return view('tourism/view', ['item' => $items, 'data' => $kategori, 'menu' => $menu,'pictures'=>$gambar, 'menus'=>$menus]);
                break;
            case 2:
                $items = Hotel::find($id);
                $kategori = Category::find($id_category);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object',$id);
                return view('hotel/view', ['item' => $items, 'data' => $kategori, 'menu' => $menu, 'pictures'=>$gambar, 'menus'=>$menus]);
                break;
            case 3:
                $items = Culinary::find($id);
                $kategori = Category::find($id_category);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object',$id);
                return view('culinary/view', ['item' => $items, 'data' => $kategori, 'menu' => $menu,'pictures'=>$gambar, 'menus'=>$menus]);
                break;
            case 4:
                $items = Shopping::find($id);
                $kategori = Category::find($id_category);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object',$id);
                return view('shopping/view', ['item' => $items, 'data' => $kategori, 'menu' => $menu,'pictures'=>$gambar, 'menus'=>$menus]);
                break;
            case 5:
                $items = Praying::find($id);
                $kategori = Category::find($id_category);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object',$id);
                return view('praying/view', ['item' => $items, 'data' => $kategori, 'menu' => $menu,'pictures'=>$gambar, 'menus'=>$menus]);
                break;
            case 6:
                $items = Transportation::find($id);
                $kategori = Category::find($id_category);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object',$id);
                return view('transportation/view', ['item' => $items, 'data' => $kategori, 'menu' => $menu,'pictures'=>$gambar, 'menus'=>$menus]);
                break;
            case 7:
                $items = PublicService::find($id);
                $kategori = Category::find($id_category);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object',$id);
                return view('public_service/view', ['item' => $items, 'data' => $kategori, 'menu' => $menu,'pictures'=>$gambar, 'menus'=>$menus]);
                break;
            case 8:
                $items = Finance::find($id);
                $kategori = Category::find($id_category);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object',$id);
                return view('finance/view', ['item' => $items, 'data' => $kategori, 'menu' => $menu,'pictures'=>$gambar, 'menus'=>$menus]);
                break;
            case 9:
                $items = Asset::find($id);
                $kategori = Category::find($id_category);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object',$id);
                return view('asset/view', ['item' => $items, 'data' => $kategori, 'menu' => $menu,'pictures'=>$gambar, 'menus'=>$menus]);
                break;
            case 10:
                $items = Culture::find($id);
                $kategori = Category::find($id_category);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object',$id);
                return view('culture/view', ['item' => $items, 'data' => $kategori, 'menu' => $menu,'pictures'=>$gambar, 'menus'=>$menus]);
                break;
            case 11:
                $items = Leisure::find($id);
                $kategori = Category::find($id_category);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object',$id);
                return view('leisure/view', ['item' => $items, 'data' => $kategori, 'menu' => $menu,'pictures'=>$gambar, 'menus'=>$menus]);
                break;
            case 12:
                $items = Health::find($id);
                $kategori = Category::find($id_category);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object',$id);
                return view('health/view', ['item' => $items, 'data' => $kategori, 'menu' => $menu,'pictures'=>$gambar, 'menus'=>$menus]);
                break;
            case 13:
                $items = Event::find($id);
                $kategori = Category::find($id_category);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object',$id);
                return view('event/view', ['item' => $items, 'data' => $kategori, 'menu' => $menu,'pictures'=>$gambar, 'menus'=>$menus]);
                break;
            case 14:
                $items = Visitor::find($id);
                $kategori = Category::find($id_category);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object',$id);
                return view('visitor/view', ['item' => $items, 'data' => $kategori, 'menu' => $menu,'pictures'=>$gambar, 'menus'=>$menus]);
                break;
            case 15:
                $items = Booking::find($id);
                $kategori = Category::find($id_category);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object',$id);
                return view('booking/view', ['item' => $items, 'data' => $kategori, 'menu' => $menu,'pictures'=>$gambar, 'menus'=>$menus]);
                break;
            case 16:
                $items = Review::find($id);
                $kategori = Category::find($id_category);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object',$id);
                return view('review/view', ['item' => $items, 'data' => $kategori, 'menu' => $menu,'pictures'=>$gambar, 'menus'=>$menus]);
                break;
        }

    }

    public function destroy($id_category, $id, $id_menu)
    {
        switch ($id_menu) {

            case 1:
                $items = Tourism::find($id);
                $items->delete();
                return redirect('showMenu/data/' . $id_category . '/' . $id_menu);
                break;
            case 2:
                $items = Hotel::find($id);
                $items->delete();
                return redirect('showMenu/data/' . $id_category . '/' . $id_menu);
                break;
            case 3:
                $items = Culinary::find($id);
                $items->delete();
                return redirect('showMenu/data/' . $id_category . '/' . $id_menu);
                break;
            case 4:
                $items = Shopping::find($id);
                $items->delete();
                return redirect('showMenu/data/' . $id_category . '/' . $id_menu);
                break;
            case 5:
                $items = Praying::find($id);
                $items->delete();
                return redirect('showMenu/data/' . $id_category . '/' . $id_menu);
                break;
            case 6:
                $items = Transportation::find($id);
                $items->delete();
                return redirect('showMenu/data/' . $id_category . '/' . $id_menu);
                break;
            case 7:
                $items = PublicService::find($id);
                $items->delete();
                return redirect('showMenu/data/' . $id_category . '/' . $id_menu);
                break;
            case 8:
                $items = Finance::find($id);
                $items->delete();
                return redirect('showMenu/data/' . $id_category . '/' . $id_menu);
                break;
            case 9:
                $items = Asset::find($id);
                $items->delete();
                return redirect('showMenu/data/' . $id_category . '/' . $id_menu);
                break;
            case 10:
                $items = Culture::find($id);
                $items->delete();
                return redirect('showMenu/data/' . $id_category . '/' . $id_menu);
                break;
            case 11:
                $items = Leisure::find($id);
                $items->delete();
                return redirect('showMenu/data/' . $id_category . '/' . $id_menu);
                break;
            case 12:
                $items = Health::find($id);
                $items->delete();
                return redirect('showMenu/data/' . $id_category . '/' . $id_menu);
                break;
            case 13:
                $items = Event::find($id);
                $items->delete();
                return redirect('showMenu/data/' . $id_category . '/' . $id_menu);
                break;
            case 14:
                $items = Visitor::find($id);
                $items->delete();
                return redirect('showMenu/data/' . $id_category . '/' . $id_menu);
                break;
        }

    }

    public function hapus($id, $id_menu)
    {
        switch ($id_menu) {

            case 1:
                $items = Tourism::find($id);
                $items->delete();
                return redirect('showMenu/' . $id_menu);
                break;
            case 2:
                $items = Hotel::find($id);
                $items->delete();
                return redirect('showMenu/' . $id_menu);
                break;
            case 3:
                $items = Culinary::find($id);
                $items->delete();
                return redirect('showMenu/' . $id_menu);
                break;
            case 4:
                $items = Shopping::find($id);
                $items->delete();
                return redirect('showMenu/' . $id_menu);
                break;
            case 5:
                $items = Praying::find($id);
                $items->delete();
                return redirect('showMenu/' . $id_menu);
                break;
            case 6:
                $items = Transportation::find($id);
                $items->delete();
                return redirect('showMenu/' . $id_menu);
                break;
            case 7:
                $items = PublicService::find($id);
                $items->delete();
                return redirect('showMenu/' . $id_menu);
                break;
            case 8:
                $items = Finance::find($id);
                $items->delete();
                return redirect('showMenu/' . $id_menu);
                break;
            case 9:
                $items = Asset::find($id);
                $items->delete();
                return redirect('showMenu/' . $id_menu);
                break;
            case 10:
                $items = Culture::find($id);
                $items->delete();
                return redirect('showMenu/' . $id_menu);
                break;
            case 11:
                $items = Leisure::find($id);
                $items->delete();
                return redirect('showMenu/' . $id_menu);
                break;
            case 12:
                $items = Health::find($id);
                $items->delete();
                return redirect('showMenu/' . $id_menu);
                break;
            case 13:
                $items = Event::find($id);
                $items->delete();
                return redirect('showMenu/' . $id_menu);
                break;
            case 14:
                $items = Visitor::find($id);
                $items->delete();
                return redirect('showMenu/' . $id_menu);
                break;
        }
    }

    public function deleteRecord($id)
    {
        switch ($id) {

            case 1:
                $items = Tourism::all()->where('id_menu', $id);
                foreach ($items as $item) {
                    $item->delete();
                }
                return redirect()->back();
                break;
            case 2:
                $items = Hotel::all()->where('id_menu', $id);
                foreach ($items as $item) {
                    $item->delete();
                }
                return redirect()->back();
                break;
            case 3:
                $items = Culinary::all()->where('id_menu', $id);
                foreach ($items as $item) {
                    $item->delete();
                }
                return redirect()->back();
                break;
            case 4:
                $items = Shopping::all()->where('id_menu', $id);
                foreach ($items as $item) {
                    $item->delete();
                }
                return redirect()->back();
                break;
            case 5:
                $items = Praying::all()->where('id_menu', $id);
                foreach ($items as $item) {
                    $item->delete();
                }
                return redirect()->back();
                break;
            case 6:
                $items = Transportation::all()->where('id_menu', $id);
                foreach ($items as $item) {
                    $item->delete();
                }
                return redirect()->back();
                break;
            case 7:
                $items = PublicService::all()->where('id_menu', $id);
                foreach ($items as $item) {
                    $item->delete();
                }
                return redirect()->back();
                break;
            case 8:
                $items = Finance::all()->where('id_menu', $id);
                foreach ($items as $item) {
                    $item->delete();
                }
                return redirect()->back();
                break;
            case 9:
                $items = Asset::all()->where('id_menu', $id);
                foreach ($items as $item) {
                    $item->delete();
                }
                return redirect()->back();
                break;
            case 10:
                $items = Culture::all()->where('id_menu', $id);
                foreach ($items as $item) {
                    $item->delete();
                }
                return redirect('showMenu/' . $id);
                break;
            case 11:
                $items = Leisure::all()->where('id_menu', $id);
                foreach ($items as $item) {
                    $item->delete();
                }
                return redirect()->back();
                break;
            case 12:
                $items = Health::all()->where('id_menu', $id);
                foreach ($items as $item) {
                    $item->delete();
                }
                return redirect()->back();
                break;
            case 13:
                $items = Event::all()->where('id_menu', $id);
                foreach ($items as $item) {
                    $item->delete();
                }
                return redirect()->back();
                break;
            case 14:
                $items = Visitor::all()->where('id_menu', $id);
                foreach ($items as $item) {
                    $item->delete();
                }
                return redirect()->back();
                break;
        }
    }

    public function hapusKategori($id, $id_menu)
    {
        $lokasi = Category::find($id);
        $object = Hotel::all()->where('id_category', $id);
//        dd($object);
        foreach ($object as $a) {
//            dd($a);
            $a->delete();
        }
        $lokasi->delete();
        return redirect('showMenu/' . $id_menu);
    }

    public function importExcel($id_menu)
    {

        switch ($id_menu) {
            case 1:
                if (Input::hasFile('file')) {
                    $path = Input::file('file')->getRealPath();
                    $data = Excel::load($path, function ($reader) {
                    })->get();
                    if (!empty($data) && $data->count()) {
                        foreach ($data as $key => $value) {
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
                            alert()->success('Data Wisata Berhasil Di Import', 'Berhasil');
                            return redirect()->back();
                        }
                    }
                }
                break;
            case 2:
                if (Input::hasFile('file')) {
                    $path = Input::file('file')->getRealPath();
                    $data = Excel::load($path, function ($reader) {
                    })->get();
                    if (!empty($data) && $data->count()) {
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
                                'id_menu' => $value->id_menu
                            ];
                        }
                        if (!empty($insert)) {
                            DB::table('hotels')->insert($insert);
                            alert()->success('Data Hotel Berhasil Di Import', 'Berhasil');
                            return redirect()->back();
                        }
                    }
                }
                break;
            case 3:
                if (Input::hasFile('file')) {
                    $path = Input::file('file')->getRealPath();
                    $data = Excel::load($path, function ($reader) {
                    })->get();
                    if (!empty($data) && $data->count()) {
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
                                'id_menu' => $value->id_menu
                            ];
                        }
                        if (!empty($insert)) {
                            DB::table('culinary')->insert($insert);
                            alert()->success('Data Kuliner Berhasil Di Import', 'Berhasil');
                            return redirect()->back();
                        }
                    }
                }
                break;
            case 4:
                if (Input::hasFile('file')) {
                    $path = Input::file('file')->getRealPath();
                    $data = Excel::load($path, function ($reader) {
                    })->get();
                    if (!empty($data) && $data->count()) {
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
                                'id_menu' => $value->id_menu
                            ];
                        }
                        if (!empty($insert)) {
                            DB::table('shoppings')->insert($insert);
                            alert()->success('Data Tempat Belanja Berhasil Di Import', 'Berhasil');
                            return redirect()->back();
                        }
                    }
                }
                break;
            case 5:
                if (Input::hasFile('file')) {
                    $path = Input::file('file')->getRealPath();
                    $data = Excel::load($path, function ($reader) {
                    })->get();
                    if (!empty($data) && $data->count()) {
                        foreach ($data as $key => $value) {
                            $insert[] = [
                                'name' => $value->name,
                                'address' => $value->address,
                                'phone' => $value->phone,
                                'description' => $value->description,
                                'id_category' => $value->id_category,
                                'id_menu' => $value->id_menu
                            ];
                        }
                        if (!empty($insert)) {
                            DB::table('prayings')->insert($insert);
                            alert()->success('Data Tempat Ibadah Berhasil Di Import', 'Berhasil');
                            return redirect()->back();
                        }
                    }
                }
                break;
            case 6:
                if (Input::hasFile('file')) {
                    $path = Input::file('file')->getRealPath();
                    $data = Excel::load($path, function ($reader) {
                    })->get();
                    if (!empty($data) && $data->count()) {
                        foreach ($data as $key => $value) {
                            $insert[] = [
                                'name' => $value->name,
                                'address' => $value->address,
                                'phone' => $value->phone,
                                'description' => $value->description,
                                'price' => $value->price,
                                'departure' => $value->departure,
                                'arriving' => $value->arriving,
                                'id_category' => $value->id_category,
                                'id_menu' => $value->id_menu
                            ];
                        }
                        if (!empty($insert)) {
                            DB::table('transportations')->insert($insert);
                            alert()->success('Data Transaportasi Berhasil Di Import', 'Berhasil');
                            return redirect()->back();
                        }
                    }
                }
                break;
            case 7:
                if (Input::hasFile('file')) {
                    $path = Input::file('file')->getRealPath();
                    $data = Excel::load($path, function ($reader) {
                    })->get();
                    if (!empty($data) && $data->count()) {
                        foreach ($data as $key => $value) {
                            $insert[] = [
                                'name' => $value->name,
                                'address' => $value->address,
                                'phone' => $value->phone,
                                'description' => $value->description,
                                'open' => $value->open,
                                'close' => $value->close,
                                'id_category' => $value->id_category,
                                'id_menu' => $value->id_menu
                            ];
                        }
                        if (!empty($insert)) {
                            DB::table('public_services')->insert($insert);
                            alert()->success('Data Layanan Publik Berhasil Di Import', 'Berhasil');
                            return redirect()->back();
                        }
                    }
                }
                break;
            case 8:
                if (Input::hasFile('file')) {
                    $path = Input::file('file')->getRealPath();
                    $data = Excel::load($path, function ($reader) {
                    })->get();
                    if (!empty($data) && $data->count()) {
                        foreach ($data as $key => $value) {
                            $insert[] = [
                                'name' => $value->name,
                                'address' => $value->address,
                                'phone' => $value->phone,
                                'description' => $value->description,
                                'open' => $value->open,
                                'close' => $value->close,
                                'id_category' => $value->id_category,
                                'id_menu' => $value->id_menu
                            ];
                        }
                        if (!empty($insert)) {
                            DB::table('finances')->insert($insert);
                            alert()->success('Data Bank Berhasil Di Import', 'Berhasil');
                            return redirect()->back();
                        }
                    }
                }
                break;
            case 9:
                if (Input::hasFile('file')) {
                    $path = Input::file('file')->getRealPath();
                    $data = Excel::load($path, function ($reader) {
                    })->get();
                    if (!empty($data) && $data->count()) {
                        foreach ($data as $key => $value) {
                            $insert[] = [
                                'name' => $value->name,
                                'address' => $value->address,
                                'phone' => $value->phone,
                                'manager' => $value->manager,
                                'capacity' => $value->capacity,
                                'description' => $value->description,
                                'id_category' => $value->id_category,
                                'id_menu' => $value->id_menu
                            ];
                        }
                        if (!empty($insert)) {
                            DB::table('assets')->insert($insert);
                            alert()->success('Data Aset Berhasil Di Import', 'Berhasil');
                            return redirect()->back();
                        }
                    }
                }
                break;
            case 10:
                if (Input::hasFile('file')) {
                    $path = Input::file('file')->getRealPath();
                    $data = Excel::load($path, function ($reader) {
                    })->get();
                    if (!empty($data) && $data->count()) {
                        foreach ($data as $key => $value) {
                            $insert[] = [
                                'name' => $value->name,
                                'address' => $value->address,
                                'phone' => $value->phone,
                                'manager' => $value->manager,
                                'description' => $value->description,
                                'id_category' => $value->id_category,
                                'id_menu' => $value->id_menu
                            ];
                        }
                        if (!empty($insert)) {
                            DB::table('cultures')->insert($insert);
                            alert()->success('Data Kesenian Berhasil Di Import', 'Berhasil');
                            return redirect()->back();
                        }
                    }
                }
                break;
            case 11:
                if (Input::hasFile('file')) {
                    $path = Input::file('file')->getRealPath();
                    $data = Excel::load($path, function ($reader) {
                    })->get();
                    if (!empty($data) && $data->count()) {
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
                                'id_menu' => $value->id_menu
                            ];
                        }
                        if (!empty($insert)) {
                            DB::table('leisures')->insert($insert);
                            alert()->success('Data Leisure Berhasil Di Import', 'Berhasil');
                            return redirect()->back();
                        }
                    }
                }
                break;
            case 12:
                if (Input::hasFile('file')) {
                    $path = Input::file('file')->getRealPath();
                    $data = Excel::load($path, function ($reader) {
                    })->get();
                    if (!empty($data) && $data->count()) {
                        foreach ($data as $key => $value) {
                            $insert[] = [
                                'name' => $value->name,
                                'address' => $value->address,
                                'phone' => $value->phone,
                                'description' => $value->description,
                                'open' => $value->open,
                                'close' => $value->close,
                                'id_category' => $value->id_category,
                                'id_menu' => $value->id_menu
                            ];
                        }
                        if (!empty($insert)) {
                            DB::table('healths')->insert($insert);
                            alert()->success('Data Kesehatan Berhasil Di Import', 'Berhasil');
                            return redirect()->back();
                        }
                    }
                }
                break;
            case 13:
                if (Input::hasFile('file')) {
                    $path = Input::file('file')->getRealPath();
                    $data = Excel::load($path, function ($reader) {
                    })->get();
                    if (!empty($data) && $data->count()) {
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
                                'id_menu' => $value->id_menu
                            ];
                        }
                        if (!empty($insert)) {
                            DB::table('events')->insert($insert);
                            alert()->success('Data Event Berhasil Di Import', 'Berhasil');
                            return redirect()->back();
                        }
                    }
                }
                break;
            case 14:
                if (Input::hasFile('file')) {
                    $path = Input::file('file')->getRealPath();
                    $data = Excel::load($path, function ($reader) {
                    })->get();
                    if (!empty($data) && $data->count()) {
                        foreach ($data as $key => $value) {
                            $insert[] = [
                                'name' => $value->name,
                                'age' => $value->address,
                                'origin' => $value->origin,
                                'id_coordinator' => $value->id_coordinator,
                                'id_menu' => $value->id_menu
                            ];
                        }
                        if (!empty($insert)) {
                            DB::table('visitors')->insert($insert);
                            alert()->success('Data Pengunjung Berhasil Di Import', 'Berhasil');
                            return redirect()->back();
                        }
                    }
                }
                break;
        }


    }

    /**
     * @param $id
     * @param $id_menu
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function multipleUpload($id, $id_menu)
    {
        //getting all of post data
        $files = Input::file('images');
        //making counting of uploaded images
        $file_count = count($files);
        //start how many uploaded
        $uploadCount = 0;

        foreach ($files as $file) {
            $rules = array('file' => 'required');
            $validator = Validator::make(array('file' => $file), $rules);
            if ($validator->passes()) {
                $destinationPath = 'image';
                $filename = $file->getClientOriginalName();
                $upload_success = $file->move($destinationPath, $filename);
                $uploadCount++;

                //save to database
                $extension = $file->getClientOriginalExtension();
                $entry = new Picture();
                $entry->mime = $file->getClientMimeType();
                $entry->original_filename = $filename;
                $entry->filename = $file->getFilename() . '.' . $extension;
                $entry->id_object = $id;
                $entry->id_menu = $id_menu;
                $entry->save();
            }
        }

        if ($uploadCount == $file_count) {
            Session::flash('success', 'Upload success');
            return redirect('/');
        } else{
            return redirect('/')->withInput()->withErrors($validator);
        }
    }

    public function deleteImage($id_image){
        $items = Picture::all()->where('id', $id_image);
//        dd($items);
        foreach ($items as $item) {
            $item->delete();
        }
        return redirect()->back();
    }
}
