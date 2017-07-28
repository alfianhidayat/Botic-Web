<?php

namespace App\Http\Controllers;

use App\Asset;
use App\Booking;
use App\BookingStatus;
use App\Category;
use App\Coordinator;
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
use App\User;
use App\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Alert;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
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

    public function insertAdmin()
    {
        $menus = Menu::all();
        return view('auth.register', ['menus' => $menus]);
    }

    public function storeAdmin(Request $request)
    {

        $exist = 0;
        $existing = User::all();
        foreach ($existing as $item) {
            if ($request->email == $item->email) {
                $exist++;
            }

        }

        if ($exist == 0) {
            $data = new User();
            $data->name = $request->name;
            $data->email = $request->email;
            $data->password = bcrypt($request->password);
            $data->id_role = 2;
            $data->save();
            Alert::success('Data Berhasil Disimpan');
            return redirect('superadmin');
        } else {
            Alert::error('Email telah digunakan', 'Gagal Registrasi');
            return redirect('superadmin');
        }
    }

    public function deleteAdmin(Request $request)
    {
        $items = User::find($request->id);
        $items->delete();
        return redirect()->back();
    }

    public function insertUser()
    {
        $menus = Menu::all();
        return view('auth.register', ['menus' => $menus]);
    }

    public function storeUser(Request $request)
    {
        $exist = 0;
        $existing = User::all();
        foreach ($existing as $item) {
            if ($request->email == $item->email) {
                $exist++;
            }

        }

        if ($exist == 0) {
            $data = new User();
            $data->name = $request->name;
            $data->email = $request->email;
            $data->password = bcrypt($request->password);
            $data->id_role = 1;
            $data->save();
            Alert::success('Data Berhasil Disimpan');
            return redirect('admin');
        } else {
            Alert::error('Email telah digunakan', 'Gagal Registrasi');
            return redirect('admin');
        }
    }

    public function deleteUser(Request $request)
    {
        $items = User::find($request->id);
        $items->delete();
        return redirect()->back();
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
                $status = BookingStatus::all();
                return view('booking/data', ['datas' => $hotel, 'categories' => $kategori, 'back' => $back, 'menus' => $menus, 'statuses' => $status]);
                break;
            case 16:
                $kategori = Category::find($id);
                $back = Menu::find($id_menu);
                return view('review/data', ['categories' => $kategori, 'back' => $back, 'menus' => $menus]);
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
                $kategori = Category::find($id);
                $menu = Menu::find($id_menu);
                return view('praying/insert', ['data' => $kategori, 'menu' => $menu, 'menus' => $menus]);
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
                $cultures = Culture::all();
                $assets = Asset::all();
//                $data = array();
//                foreach ($assets as $asset) {
//                    $booking = Booking::all();
//                    foreach ($booking as $book) {
//                        $isExist = Booking::where('id_object', $asset->id)
//                            ->where('bookings.id_time', $book->id_time)
//                            ->where('bookings.date', $book->date)
//                            ->where('bookings.booking_status_id', 1)
//                            ->orWhere('bookings.booking_status_id', 2)
//                            ->first();
//                        if (sizeof($isExist) == 0) {
//                            $data[] = $asset;
//                        }
//                    }
//                }
                return view('booking/insert', ['data' => $kategori,
                    'menu' => $menu,
                    'menus' => $menus,
                    'identities' => $identity,
                    'cultures' => $cultures,
                    'assets' => $assets]);
                break;
            case 16:
                $kategori = Category::find($id);
                $menu = Menu::find($id_menu);
                return view('review/insert', ['data' => $kategori, 'menu' => $menu, 'menus' => $menus]);
                break;
        }

    }

    public function export(Request $request)
    {
        $id = $request->id;
        $menus = Menu::all();
        switch ($id) {
            case 1:
                $kategori = Category::all()->where('id_menu', $id);
                $object = Tourism::all();
                $currentUser = Auth::user();
                $judul = Menu::find($id);
                return view('export', ['datas' => $kategori, 'menus' => $menus, 'export' => $object, 'user' => $currentUser, 'id' => $id, 'judul' => $judul]);
                break;
            case 2:
                $kategori = Category::all()->where('id_menu', $id);
                $object = Hotel::all();
                $currentUser = Auth::user();
                $judul = Menu::find($id);
                return view('export', ['datas' => $kategori, 'menus' => $menus, 'export' => $object, 'user' => $currentUser, 'id' => $id, 'judul' => $judul]);
                break;
            case 3:
                $kategori = Category::all()->where('id_menu', $id);
                $object = Culinary::all();
                $currentUser = Auth::user();
                $judul = Menu::find($id);
                return view('export', ['datas' => $kategori, 'menus' => $menus, 'export' => $object, 'user' => $currentUser, 'id' => $id, 'judul' => $judul]);
                break;
            case 4:
                $kategori = Category::all()->where('id_menu', $id);
                $object = Shopping::all();
                $currentUser = Auth::user();
                $judul = Menu::find($id);
                return view('export', ['datas' => $kategori, 'menus' => $menus, 'export' => $object, 'user' => $currentUser, 'id' => $id, 'judul' => $judul]);
                break;
            case 5:
                $kategori = Category::all()->where('id_menu', $id);
                $object = Praying::all();
                $currentUser = Auth::user();
                $judul = Menu::find($id);
                return view('export', ['datas' => $kategori, 'menus' => $menus, 'export' => $object, 'user' => $currentUser, 'id' => $id, 'judul' => $judul]);
                break;
            case 6:
                $kategori = Category::all()->where('id_menu', $id);
                $object = Transportation::all();
                $currentUser = Auth::user();
                $judul = Menu::find($id);
                return view('export', ['datas' => $kategori, 'menus' => $menus, 'export' => $object, 'user' => $currentUser, 'id' => $id, 'judul' => $judul]);
                break;
            case 7:
                $kategori = Category::all()->where('id_menu', $id);
                $object = PublicService::all();
                $currentUser = Auth::user();
                $judul = Menu::find($id);
                return view('export', ['datas' => $kategori, 'menus' => $menus, 'export' => $object, 'user' => $currentUser, 'id' => $id, 'judul' => $judul]);
                break;
            case 8:
                $kategori = Category::all()->where('id_menu', $id);
                $object = Finance::all();
                $currentUser = Auth::user();
                $judul = Menu::find($id);
//                dd($judul);
                return view('export', ['datas' => $kategori, 'menus' => $menus, 'export' => $object, 'user' => $currentUser, 'id' => $id, 'judul' => $judul]);
                break;
            case 9:
                $kategori = Category::all()->where('id_menu', $id);
                $object = Asset::all();
                $currentUser = Auth::user();
                $judul = Menu::find($id);
                return view('export', ['datas' => $kategori, 'menus' => $menus, 'export' => $object, 'user' => $currentUser, 'id' => $id, 'judul' => $judul]);
                break;
            case 10:
                $kategori = Category::all()->where('id_menu', $id);
                $object = Culture::all();
                $currentUser = Auth::user();
                $judul = Menu::find($id);
                return view('export', ['datas' => $kategori, 'menus' => $menus, 'export' => $object, 'user' => $currentUser, 'id' => $id, 'judul' => $judul]);
                break;
            case 11:
                $kategori = Category::all()->where('id_menu', $id);
                $object = Leisure::all();
                $currentUser = Auth::user();
                $judul = Menu::find($id);
                return view('export', ['datas' => $kategori, 'menus' => $menus, 'export' => $object, 'user' => $currentUser, 'id' => $id, 'judul' => $judul]);
                break;
            case 12:
                $kategori = Category::all()->where('id_menu', $id);
                $object = Health::all();
                $currentUser = Auth::user();
                $judul = Menu::find($id);
                return view('export', ['datas' => $kategori, 'menus' => $menus, 'export' => $object, 'user' => $currentUser, 'id' => $id, 'judul' => $judul]);
                break;
            case 13:
                $kategori = Category::all()->where('id_menu', $id);
                $object = Event::all();
                $currentUser = Auth::user();
                $judul = Menu::find($id);
                return view('export', ['datas' => $kategori, 'menus' => $menus, 'export' => $object, 'user' => $currentUser, 'id' => $id, 'judul' => $judul]);
                break;
            case 14:
//                dd($request);
                $kategori = Category::all()->where('id_menu', $id);
                $object = Visitor::whereBetween('created_at', [$request->from, $request->until])->get();
//                $object = DB::table('visitor')->leftJoin('coordinator', 'coordinator.id', '=', 'visitor.coordinator_id')->whereBetween('created_at',$request->from,$request->until)->get();
                $currentUser = Auth::user();
                $judul = Menu::find($id);
                return view('export', ['datas' => $kategori, 'menus' => $menus, 'export' => $object, 'user' => $currentUser, 'id' => $id, 'judul' => $judul]);
                break;
            case 15:
                $kategori = Category::all()->where('id_menu', $id);
                $object = Booking::whereBetween('created_at', [$request->from, $request->until])->get();
                $currentUser = Auth::user();
                $judul = Menu::find($id);
//                dd($object);
                return view('export', ['datas' => $kategori, 'menus' => $menus, 'export' => $object, 'user' => $currentUser, 'id' => $id, 'judul' => $judul]);
                break;
            case 16:
                $kategori = Category::all()->where('id_menu', $id);
                $object = Review::all();
                $currentUser = Auth::user();
                $judul = Menu::find($id);
                return view('export', ['datas' => $kategori, 'menus' => $menus, 'export' => $object, 'user' => $currentUser, 'id' => $id, 'judul' => $judul]);
                break;
        }

    }

    public function storeNo(Request $request, $id_menu)
    {
        switch ($request->id_menu) {
            case 1:
                $data = new Tourism();
                $data->name = $request->name;
                $data->address = $request->address;
                $data->lat = $request->lat;
                $data->lng = $request->lng;
                $data->phone = $request->phone;
                $data->description = $request->description;
                $data->price = $request->price;
                $data->manager = $request->manager;
                $data->open = $request->open;
                $data->close = $request->close;
                $data->id_category = $request->id_category;
                $data->id_menu = $request->id_menu;
                $data->created_by = Auth::user()->id;
                if (Input::file('images') != null) {
                    if ($data->save()) {
                        if (!$this->multipleUpload($data->id, $id_menu)) {
                            Alert::error('Format gambar tidak sesuai', 'Data Gagal Disimpan');
                            return redirect()->back();
                        }
                        Alert::success('Data Berhasil Disimpan');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                } else {
                    if ($data->save()) {
                        Alert::success('Data Berhasil Disimpan');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                }
                break;
            case 2:
                $data = new Hotel();
                $data->name = $request->name;
                $data->address = $request->address;
                $data->lat = $request->lat;
                $data->lng = $request->lng;
                $data->phone = $request->phone;
                $data->description = $request->description;
                $data->price = $request->price;
                $data->open = $request->open;
                $data->close = $request->close;
                $data->id_category = $request->id_category;
                $data->id_menu = $request->id_menu;
                $data->created_by = Auth::user()->id;
                if (Input::file('images') != null) {
                    if ($data->save()) {
                        if (!$this->multipleUpload($data->id, $id_menu)) {
                            Alert::error('Format gambar tidak sesuai', 'Data Gagal Disimpan');
                            return redirect()->back();
                        }
                        Alert::success('Data Berhasil Disimpan');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                } else {
                    if ($data->save()) {
                        Alert::success('Data Berhasil Disimpan');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                }
                break;
            case 3:
                $data = new Culinary();
                $data->name = $request->name;
                $data->address = $request->address;
                $data->lat = $request->lat;
                $data->lng = $request->lng;
                $data->phone = $request->phone;
                $data->description = $request->description;
                $data->price = $request->price;
                $data->open = $request->open;
                $data->close = $request->close;
                $data->id_category = $request->id_category;
                $data->id_menu = $request->id_menu;
                $data->created_by = Auth::user()->id;
                if (Input::file('images') != null) {
                    if ($data->save()) {
                        if (!$this->multipleUpload($data->id, $id_menu)) {
                            Alert::error('Format gambar tidak sesuai', 'Data Gagal Disimpan');
                            return redirect()->back();
                        }
                        Alert::success('Data Berhasil Disimpan');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                } else {
                    if ($data->save()) {
                        Alert::success('Data Berhasil Disimpan');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                }
                break;
            case 4:
                $data = new Shopping();
                $data->name = $request->name;
                $data->address = $request->address;
                $data->lat = $request->lat;
                $data->lng = $request->lng;
                $data->phone = $request->phone;
                $data->description = $request->description;
                $data->open = $request->open;
                $data->close = $request->close;
                $data->id_category = $request->id_category;
                $data->id_menu = $request->id_menu;
                $data->created_by = Auth::user()->id;
                if (Input::file('images') != null) {
                    if ($data->save()) {
                        if (!$this->multipleUpload($data->id, $id_menu)) {
                            Alert::error('Format gambar tidak sesuai', 'Data Gagal Disimpan');
                            return redirect()->back();
                        }
                        Alert::success('Data Berhasil Disimpan');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                } else {
                    if ($data->save()) {
                        Alert::success('Data Berhasil Disimpan');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                }
                break;
            case 5:
                $data = new Praying();
                $data->name = $request->name;
                $data->address = $request->address;
                $data->lat = $request->lat;
                $data->lng = $request->lng;
                $data->description = $request->description;
                $data->id_category = $request->id_category;
                $data->id_menu = $request->id_menu;
                $data->created_by = Auth::user()->id;
                if (Input::file('images') != null) {
                    if ($data->save()) {
                        if (!$this->multipleUpload($data->id, $id_menu)) {
                            Alert::error('Format gambar tidak sesuai', 'Data Gagal Disimpan');
                            return redirect()->back();
                        }
                        Alert::success('Data Berhasil Disimpan');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                } else {
                    if ($data->save()) {
                        Alert::success('Data Berhasil Disimpan');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                }
                break;
            case 6:
                $data = new Transportation();
                $data->name = $request->name;
                $data->address = $request->address;
                $data->lat = $request->lat;
                $data->lng = $request->lng;
                $data->phone = $request->phone;
                $data->description = $request->description;
                $data->price = $request->price;
                $data->departure = $request->departure;
                $data->arriving = $request->arriving;
                $data->id_category = $request->id_category;
                $data->id_menu = $request->id_menu;
                $data->created_by = Auth::user()->id;
                if (Input::file('images') != null) {
                    if ($data->save()) {
                        if (!$this->multipleUpload($data->id, $id_menu)) {
                            Alert::error('Format gambar tidak sesuai', 'Data Gagal Disimpan');
                            return redirect()->back();
                        }
                        Alert::success('Data Berhasil Disimpan');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                } else {
                    if ($data->save()) {
                        Alert::success('Data Berhasil Disimpan');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                }
                break;
            case 7;
                $data = new PublicService();
                $data->name = $request->name;
                $data->address = $request->address;
                $data->lat = $request->lat;
                $data->lng = $request->lng;
                $data->phone = $request->phone;
                $data->description = $request->description;
                $data->open = $request->open;
                $data->close = $request->close;
                $data->id_category = $request->id_category;
                $data->id_menu = $request->id_menu;
                $data->created_by = Auth::user()->id;
                if (Input::file('images') != null) {
                    if ($data->save()) {
                        if (!$this->multipleUpload($data->id, $id_menu)) {
                            Alert::error('Format gambar tidak sesuai', 'Data Gagal Disimpan');
                            return redirect()->back();
                        }
                        Alert::success('Data Berhasil Disimpan');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                } else {
                    if ($data->save()) {
                        Alert::success('Data Berhasil Disimpan');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                }
                break;
            case 8:
                $data = new Finance();
                $data->name = $request->name;
                $data->address = $request->address;
                $data->lat = $request->lat;
                $data->lng = $request->lng;
                $data->phone = $request->phone;
                $data->description = $request->description;
                $data->open = $request->open;
                $data->close = $request->close;
                $data->id_category = $request->id_category;
                $data->id_menu = $request->id_menu;
                $data->created_by = Auth::user()->id;
                if (Input::file('images') != null) {
                    if ($data->save()) {
                        if (!$this->multipleUpload($data->id, $id_menu)) {
                            Alert::error('Format gambar tidak sesuai', 'Data Gagal Disimpan');
                            return redirect()->back();
                        }
                        Alert::success('Data Berhasil Disimpan');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                } else {
                    if ($data->save()) {
                        Alert::success('Data Berhasil Disimpan');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                }
                break;
            case 9:
                $data = new Asset();
                $data->name = $request->name;
                $data->address = $request->address;
                $data->lat = $request->lat;
                $data->lng = $request->lng;
                $data->phone = $request->phone;
                $data->manager = $request->manager;
                $data->description = $request->description;
                $data->capacity = $request->capacity;
                $data->id_menu = $request->id_menu;
                $data->created_by = Auth::user()->id;
                if (Input::file('images') != null) {
                    if ($data->save()) {
                        if (!$this->multipleUpload($data->id, $id_menu)) {
                            Alert::error('Format gambar tidak sesuai', 'Data Gagal Disimpan');
                            return redirect()->back();
                        }
                        Alert::success('Data Berhasil Disimpan');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                } else {
                    if ($data->save()) {
                        Alert::success('Data Berhasil Disimpan');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                }
                break;
            case 10:
                $data = new Culture();
                $data->name = $request->name;
                $data->address = $request->address;
                $data->lat = $request->lat;
                $data->lng = $request->lng;
                $data->phone = $request->phone;
                $data->manager = $request->manager;
                $data->description = $request->description;
                $data->id_menu = $request->id_menu;
                $data->created_by = Auth::user()->id;
                if (Input::file('images') != null) {
                    if ($data->save()) {
                        if (!$this->multipleUpload($data->id, $id_menu)) {
                            Alert::error('Format gambar tidak sesuai', 'Data Gagal Disimpan');
                            return redirect()->back();
                        }
                        Alert::success('Data Berhasil Disimpan');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                } else {
                    if ($data->save()) {
                        Alert::success('Data Berhasil Disimpan');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                }
                break;
            case 11:
                $data = new Leisure();
                $data->name = $request->name;
                $data->address = $request->address;
                $data->lat = $request->lat;
                $data->lng = $request->lng;
                $data->phone = $request->phone;
                $data->description = $request->description;
                $data->price = $request->price;
                $data->open = $request->open;
                $data->close = $request->close;
                $data->lat = $request->lat;
                $data->lng = $request->lng;
                $data->id_category = $request->id_category;
                $data->id_menu = $request->id_menu;
                $data->created_by = Auth::user()->id;
                if (Input::file('images') != null) {
                    if ($data->save()) {
                        if (!$this->multipleUpload($data->id, $id_menu)) {
                            Alert::error('Format gambar tidak sesuai', 'Data Gagal Disimpan');
                            return redirect()->back();
                        }
                        Alert::success('Data Berhasil Disimpan');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                } else {
                    if ($data->save()) {
                        Alert::success('Data Berhasil Disimpan');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                }
                break;
            case 12:
                $data = new Health();
                $data->name = $request->name;
                $data->address = $request->address;
                $data->lat = $request->lat;
                $data->lng = $request->lng;
                $data->phone = $request->phone;
                $data->description = $request->description;
                $data->open = $request->open;
                $data->close = $request->close;
                $data->lat = $request->lat;
                $data->lng = $request->lng;
                $data->id_category = $request->id_category;
                $data->id_menu = $request->id_menu;
                $data->created_by = Auth::user()->id;
                if (Input::file('images') != null) {
                    if ($data->save()) {
                        if (!$this->multipleUpload($data->id, $id_menu)) {
                            Alert::error('Format gambar tidak sesuai', 'Data Gagal Disimpan');
                            return redirect()->back();
                        }
                        Alert::success('Data Berhasil Disimpan');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                } else {
                    if ($data->save()) {
                        Alert::success('Data Berhasil Disimpan');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                }
                break;
            case 13:
                $data = new Event();
                $data->name = $request->name;
                $data->description = $request->description;
                $data->time = $request->time;
                $data->id_menu = $request->id_menu;
                $data->created_by = Auth::user()->id;
                if (Input::file('images') != null) {
                    if ($data->save()) {
                        if (!$this->multipleUpload($data->id, $id_menu)) {
                            Alert::error('Format gambar tidak sesuai', 'Data Gagal Disimpan');
                            return redirect()->back();
                        }
                        Alert::success('Data Berhasil Disimpan');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                } else {
                    if ($data->save()) {
                        Alert::success('Data Berhasil Disimpan');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                }
                break;
            case 14:
                $data = new Visitor();
                $data->name = $request->name;
                $data->address = $request->address;
                $data->lat = $request->lat;
                $data->lng = $request->lng;
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
            case 15:
                $data = new Booking();
                if ($request->id_category == 29) {
                    $data->identity_type_id = $request->identity_type_id;
                    $data->identity_number = $request->identity_number;
                    $data->name = $request->name;
                    $data->phone = $request->phone;
                    $data->date = $request->date;
                    $data->id_time = $request->id_time;
                    $data->description = $request->description;
                    $data->id_object = $request->id_object;
                    $data->id_category = $request->id_category;
                    $data->booking_status_id = 1;
                    $data->id_menu = $request->id_menu;
                    $data->user_id = Auth::user()->id;
                    $data->save();
                    Alert::success('Data Berhasil Disimpan');
                    return redirect('showMenu/' . $request->id_menu);
                } elseif ($request->id_category == 30) {
                    $data->identity_type_id = $request->identity_type_id;
                    $data->identity_number = $request->identity_number;
                    $data->name = $request->name;
                    $data->phone = $request->phone;
                    $data->date = $request->date;
                    $data->id_time = $request->id_time;
                    $data->description = $request->description;
                    $data->id_object = $request->id_object;
                    $data->id_category = $request->id_category;
                    $data->booking_status_id = 1;
                    $data->id_menu = $request->id_menu;
                    $data->user_id = Auth::user()->id;
                    $data->save();
                    Alert::success('Data Berhasil Disimpan');
                    return redirect('showMenu/' . $request->id_menu);
                }

                break;
            case 16:
                $data = new Review();
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

    public function store(Request $request, $id, $id_menu)
    {
        switch ($request->id_menu) {
            case 1:
                $data = new Tourism();
                $data->name = $request->name;
                $data->address = $request->address;
                $data->phone = $request->phone;
                $data->description = $request->description;
                $data->price = $request->price;
                $data->manager = $request->manager;
                $data->open = $request->open;
                $data->close = $request->close;
                $data->lat = $request->lat;
                $data->lng = $request->lng;
                $data->id_category = $request->id_category;
                $data->id_menu = $request->id_menu;
                $data->created_by = Auth::user()->id;
                if (Input::file('images') != null) {
                    if ($data->save()) {
                        if (!$this->multipleUpload($data->id, $id_menu)) {
                            Alert::error('Format gambar tidak sesuai', 'Data Gagal Disimpan');
                            return redirect()->back();
                        }
                        Alert::success('Data Berhasil Disimpan');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                } else {
                    if ($data->save()) {
                        Alert::success('Data Berhasil Disimpan');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                }
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
                $data->lat = $request->lat;
                $data->lng = $request->lng;
                $data->id_category = $request->id_category;
                $data->id_menu = $request->id_menu;
                $data->created_by = Auth::user()->id;
                if (Input::file('images') != null) {
                    if ($data->save()) {
                        if (!$this->multipleUpload($data->id, $id_menu)) {
                            Alert::error('Format gambar tidak sesuai', 'Data Gagal Disimpan');
                            return redirect()->back();
                        }
                        Alert::success('Data Berhasil Disimpan');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                } else {
                    if ($data->save()) {
                        Alert::success('Data Berhasil Disimpan');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                }
                break;
            case 3:
                $data = new Culinary();
                $data->name = $request->name;
                $data->address = $request->address;
                $data->lat = $request->lat;
                $data->lng = $request->lng;
                $data->phone = $request->phone;
                $data->description = $request->description;
                $data->price = $request->price;
                $data->open = $request->open;
                $data->close = $request->close;
                $data->id_category = $request->id_category;
                $data->id_menu = $request->id_menu;
                $data->created_by = Auth::user()->id;
                if (Input::file('images') != null) {
                    if ($data->save()) {
                        if (!$this->multipleUpload($data->id, $id_menu)) {
                            Alert::error('Format gambar tidak sesuai', 'Data Gagal Disimpan');
                            return redirect()->back();
                        }
                        Alert::success('Data Berhasil Disimpan');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                } else {
                    if ($data->save()) {
                        Alert::success('Data Berhasil Disimpan');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                }
                break;
            case 4:
                $data = new Shopping();
                $data->name = $request->name;
                $data->address = $request->address;
                $data->lat = $request->lat;
                $data->lng = $request->lng;
                $data->phone = $request->phone;
                $data->description = $request->description;
                $data->open = $request->open;
                $data->close = $request->close;
                $data->id_category = $request->id_category;
                $data->id_menu = $request->id_menu;
                $data->created_by = Auth::user()->id;
                if (Input::file('images') != null) {
                    if ($data->save()) {
                        if (!$this->multipleUpload($data->id, $id_menu)) {
                            Alert::error('Format gambar tidak sesuai', 'Data Gagal Disimpan');
                            return redirect()->back();
                        }
                        Alert::success('Data Berhasil Disimpan');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                } else {
                    if ($data->save()) {
                        Alert::success('Data Berhasil Disimpan');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                }
                break;
            case 5:
                $data = new Praying();
                $data->name = $request->name;
                $data->address = $request->address;
                $data->lat = $request->lat;
                $data->lng = $request->lng;
                $data->description = $request->description;
                $data->id_category = $request->id_category;
                $data->id_menu = $request->id_menu;
                $data->created_by = Auth::user()->id;
                if (Input::file('images') != null) {
                    if ($data->save()) {
                        if (!$this->multipleUpload($data->id, $id_menu)) {
                            Alert::error('Format gambar tidak sesuai', 'Data Gagal Disimpan');
                            return redirect()->back();
                        }
                        Alert::success('Data Berhasil Disimpan');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                } else {
                    if ($data->save()) {
                        Alert::success('Data Berhasil Disimpan');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                }
                break;
            case 6:
                $data = new Transportation();
                $data->name = $request->name;
                $data->address = $request->address;
                $data->lat = $request->lat;
                $data->lng = $request->lng;
                $data->phone = $request->phone;
                $data->description = $request->description;
                $data->price = $request->price;
                $data->departure = $request->departure;
                $data->arriving = $request->arriving;
                $data->id_category = $request->id_category;
                $data->id_menu = $request->id_menu;
                $data->created_by = Auth::user()->id;
                if (Input::file('images') != null) {
                    if ($data->save()) {
                        if (!$this->multipleUpload($data->id, $id_menu)) {
                            Alert::error('Format gambar tidak sesuai', 'Data Gagal Disimpan');
                            return redirect()->back();
                        }
                        Alert::success('Data Berhasil Disimpan');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                } else {
                    if ($data->save()) {
                        Alert::success('Data Berhasil Disimpan');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                }
                break;
            case 7;
                $data = new PublicService();
                $data->name = $request->name;
                $data->address = $request->address;
                $data->lat = $request->lat;
                $data->lng = $request->lng;
                $data->phone = $request->phone;
                $data->description = $request->description;
                $data->open = $request->open;
                $data->close = $request->close;
                $data->id_category = $request->id_category;
                $data->id_menu = $request->id_menu;
                $data->created_by = Auth::user()->id;
                if (Input::file('images') != null) {
                    if ($data->save()) {
                        if (!$this->multipleUpload($data->id, $id_menu)) {
                            Alert::error('Format gambar tidak sesuai', 'Data Gagal Disimpan');
                            return redirect()->back();
                        }
                        Alert::success('Data Berhasil Disimpan');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                } else {
                    if ($data->save()) {
                        Alert::success('Data Berhasil Disimpan');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                }
                break;
            case 8:
                $data = new Finance();
                $data->name = $request->name;
                $data->address = $request->address;
                $data->lat = $request->lat;
                $data->lng = $request->lng;
                $data->phone = $request->phone;
                $data->description = $request->description;
                $data->open = $request->open;
                $data->close = $request->close;
                $data->id_category = $request->id_category;
                $data->id_menu = $request->id_menu;
                $data->created_by = Auth::user()->id;
                if (Input::file('images') != null) {
                    if ($data->save()) {
                        if (!$this->multipleUpload($data->id, $id_menu)) {
                            Alert::error('Format gambar tidak sesuai', 'Data Gagal Disimpan');
                            return redirect()->back();
                        }
                        Alert::success('Data Berhasil Disimpan');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                } else {
                    if ($data->save()) {
                        Alert::success('Data Berhasil Disimpan');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                }
                break;
            case 9:
                $data = new Asset();
                $data->name = $request->name;
                $data->address = $request->address;
                $data->lat = $request->lat;
                $data->lng = $request->lng;
                $data->phone = $request->phone;
                $data->manager = $request->manager;
                $data->description = $request->description;
                $data->capacity = $request->capacity;
                $data->id_menu = $request->id_menu;
                $data->created_by = Auth::user()->id;
                if (Input::file('images') != null) {
                    if ($data->save()) {
                        if (!$this->multipleUpload($data->id, $id_menu)) {
                            Alert::error('Format gambar tidak sesuai', 'Data Gagal Disimpan');
                            return redirect()->back();
                        }
                        Alert::success('Data Berhasil Disimpan');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                } else {
                    if ($data->save()) {
                        Alert::success('Data Berhasil Disimpan');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                }
                break;
            case 10:
                $data = new Culture();
                $data->name = $request->name;
                $data->address = $request->address;
                $data->lat = $request->lat;
                $data->lng = $request->lng;
                $data->phone = $request->phone;
                $data->manager = $request->manager;
                $data->description = $request->description;
                $data->id_menu = $request->id_menu;
                $data->created_by = Auth::user()->id;
                if (Input::file('images') != null) {
                    if ($data->save()) {
                        if (!$this->multipleUpload($data->id, $id_menu)) {
                            Alert::error('Format gambar tidak sesuai', 'Data Gagal Disimpan');
                            return redirect()->back();
                        }
                        Alert::success('Data Berhasil Disimpan');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                } else {
                    if ($data->save()) {
                        Alert::success('Data Berhasil Disimpan');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                }
                break;
            case 11:
                $data = new Leisure();
                $data->name = $request->name;
                $data->address = $request->address;
                $data->lat = $request->lat;
                $data->lng = $request->lng;
                $data->phone = $request->phone;
                $data->description = $request->description;
                $data->price = $request->price;
                $data->open = $request->open;
                $data->close = $request->close;
                $data->lat = $request->lat;
                $data->lng = $request->lng;
                $data->id_category = $request->id_category;
                $data->id_menu = $request->id_menu;
                $data->created_by = Auth::user()->id;
                if (Input::file('images') != null) {
                    if ($data->save()) {
                        if (!$this->multipleUpload($data->id, $id_menu)) {
                            Alert::error('Format gambar tidak sesuai', 'Data Gagal Disimpan');
                            return redirect()->back();
                        }
                        Alert::success('Data Berhasil Disimpan');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                } else {
                    if ($data->save()) {
                        Alert::success('Data Berhasil Disimpan');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                }
                break;
            case 12:
                $data = new Health();
                $data->name = $request->name;
                $data->address = $request->address;
                $data->lat = $request->lat;
                $data->lng = $request->lng;
                $data->phone = $request->phone;
                $data->description = $request->description;
                $data->open = $request->open;
                $data->close = $request->close;
                $data->lat = $request->lat;
                $data->lng = $request->lng;
                $data->id_category = $request->id_category;
                $data->id_menu = $request->id_menu;
                $data->created_by = Auth::user()->id;
                if (Input::file('images') != null) {
                    if ($data->save()) {
                        if (!$this->multipleUpload($data->id, $id_menu)) {
                            Alert::error('Format gambar tidak sesuai', 'Data Gagal Disimpan');
                            return redirect()->back();
                        }
                        Alert::success('Data Berhasil Disimpan');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                } else {
                    if ($data->save()) {
                        Alert::success('Data Berhasil Disimpan');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                }
                break;
            case 13:
                $data = new Event();
                $data->name = $request->name;
                $data->description = $request->description;
                $data->time = $request->time;
                $data->id_menu = $request->id_menu;
                $data->created_by = Auth::user()->id;
                if (Input::file('images') != null) {
                    if ($data->save()) {
                        if (!$this->multipleUpload($data->id, $id_menu)) {
                            Alert::error('Format gambar tidak sesuai', 'Data Gagal Disimpan');
                            return redirect()->back();
                        }
                        Alert::success('Data Berhasil Disimpan');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                } else {
                    if ($data->save()) {
                        Alert::success('Data Berhasil Disimpan');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                }
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
            case 15:
                $data = new Booking();
                if ($request->id_category == 29) {
                    $data->identity_type_id = $request->identity_type_id;
                    $data->identity_number = $request->identity_number;
                    $data->name = $request->name;
                    $data->phone = $request->phone;
                    $data->date = $request->date;
                    $data->id_time = $request->id_time;
                    $data->description = $request->description;
                    $data->id_object = $request->id_object;
                    $data->id_category = $request->id_category;
                    $data->booking_status_id = 1;
                    $data->id_menu = $request->id_menu;
                    $data->user_id = Auth::user()->id;
                    $data->save();
                    Alert::success('Data Berhasil Disimpan');
                    return redirect('showMenu/' . $request->id_menu);
                } elseif ($request->id_category == 30) {
                    $data->identity_type_id = $request->identity_type_id;
                    $data->identity_number = $request->identity_number;
                    $data->name = $request->name;
                    $data->phone = $request->phone;
                    $data->date = $request->date;
                    $data->id_time = $request->id_time;
                    $data->description = $request->description;
                    $data->id_object = $request->id_object;
                    $data->id_category = $request->id_category;
                    $data->booking_status_id = 1;
                    $data->id_menu = $request->id_menu;
                    $data->user_id = Auth::user()->id;
                    $data->save();
                    Alert::success('Data Berhasil Disimpan');
                    return redirect('showMenu/' . $request->id_menu);
                }

                break;
            case 16:
                $data = new Review();
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
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object', $id);
                return view('tourism/edit', ['item' => $items, 'datas' => $kategori, 'menu' => $menu, 'pictures' => $gambar, 'menus' => $menus]);
                break;
            case 2:
                $items = Hotel::find($id);
                $kategori = Category::all()->where('id_menu', $id_menu);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object', $id);
                return view('hotel/edit', ['item' => $items, 'datas' => $kategori, 'menu' => $menu, 'pictures' => $gambar, 'menus' => $menus]);
                break;
            case 3:
                $items = Culinary::find($id);
                $kategori = Category::all()->where('id_menu', $id_menu);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object', $id);
                return view('culinary/edit', ['item' => $items, 'datas' => $kategori, 'menu' => $menu, 'pictures' => $gambar, 'menus' => $menus]);
                break;
            case 4:
                $items = Shopping::find($id);
                $kategori = Category::all()->where('id_menu', $id_menu);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object', $id);
                return view('shopping/edit', ['item' => $items, 'datas' => $kategori, 'menu' => $menu, 'pictures' => $gambar, 'menus' => $menus]);
                break;
            case 5:
                $items = Praying::find($id);
                $kategori = Category::all()->where('id_menu', $id_menu);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object', $id);
                return view('praying/edit', ['item' => $items, 'datas' => $kategori, 'menu' => $menu, 'pictures' => $gambar, 'menus' => $menus]);
                break;
            case 6:
                $items = Transportation::find($id);
                $kategori = Category::all()->where('id_menu', $id_menu);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object', $id);
                return view('transportation/edit', ['item' => $items, 'datas' => $kategori, 'menu' => $menu, 'pictures' => $gambar, 'menus' => $menus]);
                break;
            case 7:
                $items = PublicService::find($id);
                $kategori = Category::all()->where('id_menu', $id_menu);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object', $id);
                return view('public_service/edit', ['item' => $items, 'datas' => $kategori, 'menu' => $menu, 'pictures' => $gambar, 'menus' => $menus]);
                break;
            case 8:
                $items = Finance::find($id);
                $kategori = Category::all()->where('id_menu', $id_menu);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object', $id);
                return view('finance/edit', ['item' => $items, 'datas' => $kategori, 'menu' => $menu, 'pictures' => $gambar, 'menus' => $menus]);
                break;
            case 9:
                $items = Asset::find($id);
                $kategori = Category::all()->where('id_menu', $id_menu);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object', $id);
                return view('asset/edit', ['item' => $items, 'datas' => $kategori, 'menu' => $menu, 'pictures' => $gambar, 'menus' => $menus]);
                break;
            case 10:
                $items = Culture::find($id);
                $kategori = Category::all()->where('id_menu', $id_menu);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object', $id);
                return view('culture/edit', ['item' => $items, 'datas' => $kategori, 'menu' => $menu, 'pictures' => $gambar, 'menus' => $menus]);
                break;
            case 11:
                $items = Leisure::find($id);
                $kategori = Category::all()->where('id_menu', $id_menu);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object', $id);
                return view('leisure/edit', ['item' => $items, 'datas' => $kategori, 'menu' => $menu, 'pictures' => $gambar, 'menus' => $menus]);
                break;
            case 12:
                $items = Health::find($id);
                $kategori = Category::all()->where('id_menu', $id_menu);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object', $id);
                return view('health/edit', ['item' => $items, 'datas' => $kategori, 'menu' => $menu, 'pictures' => $gambar, 'menus' => $menus]);
                break;
            case 13:
                $items = Event::find($id);
                $kategori = Category::all()->where('id_menu', $id_menu);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object', $id);
                return view('event/edit', ['item' => $items, 'datas' => $kategori, 'menu' => $menu, 'pictures' => $gambar, 'menus' => $menus]);
                break;
            case 14:
                $items = Visitor::find($id);
                $kategori = Category::all()->where('id_menu', $id_menu);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object', $id);
                return view('visitor/edit', ['item' => $items, 'datas' => $kategori, 'menu' => $menu, 'pictures' => $gambar, 'menus' => $menus]);
                break;
            case 15:
                $items = Booking::find($id);
                $kategori = Category::all()->where('id_menu', $id_menu);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object', $id);
                return view('booking/edit', ['item' => $items, 'datas' => $kategori, 'menu' => $menu, 'pictures' => $gambar, 'menus' => $menus]);
                break;
            case 16:
                $items = Review::find($id);
                $kategori = Category::all()->where('id_menu', $id_menu);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object', $id);
                return view('review/edit', ['item' => $items, 'datas' => $kategori, 'menu' => $menu, 'pictures' => $gambar, 'menus' => $menus]);
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
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object', $id);
                return view('tourism/edit', ['item' => $items, 'datas' => $kategori, 'menu' => $menu, 'pictures' => $gambar, 'menus' => $menus]);
                break;
            case 2:
                $items = Hotel::find($id);
                $kategori = Category::all()->where('id_menu', $id_menu);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object', $id);
                return view('hotel/edit', ['item' => $items, 'datas' => $kategori, 'menu' => $menu, 'pictures' => $gambar, 'menus' => $menus]);
                break;
            case 3:
                $items = Culinary::find($id);
                $kategori = Category::all()->where('id_menu', $id_menu);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object', $id);
                return view('culinary/edit', ['item' => $items, 'datas' => $kategori, 'menu' => $menu, 'pictures' => $gambar, 'menus' => $menus]);
                break;
            case 4:
                $items = Shopping::find($id);
                $kategori = Category::all()->where('id_menu', $id_menu);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object', $id);
                return view('shopping/edit', ['item' => $items, 'datas' => $kategori, 'menu' => $menu, 'pictures' => $gambar, 'menus' => $menus]);
                break;
            case 5:
                $items = Praying::find($id);
                $kategori = Category::all()->where('id_menu', $id_menu);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object', $id);
                return view('praying/edit', ['item' => $items, 'datas' => $kategori, 'menu' => $menu, 'pictures' => $gambar, 'menus' => $menus]);
                break;
            case 6:
                $items = Transportation::find($id);
                $kategori = Category::all()->where('id_menu', $id_menu);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object', $id);
                return view('transportation/edit', ['item' => $items, 'datas' => $kategori, 'menu' => $menu, 'pictures' => $gambar, 'menus' => $menus]);
                break;
            case 7:
                $items = PublicService::find($id);
                $kategori = Category::all()->where('id_menu', $id_menu);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object', $id);
                return view('public_service/edit', ['item' => $items, 'datas' => $kategori, 'menu' => $menu, 'pictures' => $gambar, 'menus' => $menus]);
                break;
            case 8:
                $items = Finance::find($id);
                $kategori = Category::all()->where('id_menu', $id_menu);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object', $id);
                return view('finance/edit', ['item' => $items, 'datas' => $kategori, 'menu' => $menu, 'pictures' => $gambar, 'menus' => $menus]);
                break;
            case 9:
                $items = Asset::find($id);
                $kategori = Category::all()->where('id_menu', $id_menu);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object', $id);
                return view('asset/edit', ['item' => $items, 'datas' => $kategori, 'menu' => $menu, 'pictures' => $gambar, 'menus' => $menus]);
                break;
            case 10:
                $items = Culture::find($id);
                $kategori = Category::all()->where('id_menu', $id_menu);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object', $id);
                return view('culture/edit', ['item' => $items, 'datas' => $kategori, 'menu' => $menu, 'pictures' => $gambar, 'menus' => $menus]);
                break;
            case 11:
                $items = Leisure::find($id);
                $kategori = Category::all()->where('id_menu', $id_menu);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object', $id);
                return view('leisure/edit', ['item' => $items, 'datas' => $kategori, 'menu' => $menu, 'pictures' => $gambar, 'menus' => $menus]);
                break;
            case 12:
                $items = Health::find($id);
                $kategori = Category::all()->where('id_menu', $id_menu);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object', $id);
                return view('health/edit', ['item' => $items, 'datas' => $kategori, 'menu' => $menu, 'pictures' => $gambar, 'menus' => $menus]);
                break;
            case 13:
                $items = Event::find($id);
                $kategori = Category::all()->where('id_menu', $id_menu);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object', $id);
                return view('event/edit', ['item' => $items, 'datas' => $kategori, 'menu' => $menu, 'pictures' => $gambar, 'menus' => $menus]);
                break;
            case 14:
                $items = Visitor::find($id);
                $kategori = Category::all()->where('id_menu', $id_menu);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object', $id);
                return view('visitor/edit', ['item' => $items, 'datas' => $kategori, 'menu' => $menu, 'pictures' => $gambar, 'menus' => $menus]);
                break;
            case 15:
                $items = Booking::find($id);
                $kategori = Category::all()->where('id_menu', $id_menu);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object', $id);
                return view('booking/edit', ['item' => $items, 'datas' => $kategori, 'menu' => $menu, 'pictures' => $gambar, 'menus' => $menus]);
                break;
            case 16:
                $items = Review::find($id);
                $kategori = Category::all()->where('id_menu', $id_menu);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object', $id);
                return view('review/edit', ['item' => $items, 'datas' => $kategori, 'menu' => $menu, 'pictures' => $gambar, 'menus' => $menus]);
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
                if (Input::file('images') != null) {
                    if (!$this->multipleUpload($id, $id_menu)) {
                        Alert::error('Format gambar tidak sesuai', 'Data Gagal Diubah');
                        return redirect()->back();
                    }
                    if ($lokasi->save()) {
                        Alert::success('Data Berhasil Diubah');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                } else {
                    if ($lokasi->save()) {
                        Alert::success('Data Berhasil Diubah');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                }
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
                if (Input::file('images') != null) {
                    if (!$this->multipleUpload($id, $id_menu)) {
                        Alert::error('Format gambar tidak sesuai', 'Data Gagal Diubah');
                        return redirect()->back();
                    }
                    if ($lokasi->save()) {
                        Alert::success('Data Berhasil Diubah');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                } else {
                    if ($lokasi->save()) {
                        Alert::success('Data Berhasil Diubah');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                }
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
                if (Input::file('images') != null) {
                    if (!$this->multipleUpload($id, $id_menu)) {
                        Alert::error('Format gambar tidak sesuai', 'Data Gagal Diubah');
                        return redirect()->back();
                    }
                    if ($lokasi->save()) {
                        Alert::success('Data Berhasil Diubah');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                } else {
                    if ($lokasi->save()) {
                        Alert::success('Data Berhasil Diubah');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                }
                break;
            case 4:
                $lokasi = Shopping::find($id);
                $lokasi->name = $request->name;
                $lokasi->address = $request->address;
                $lokasi->phone = $request->phone;
                $lokasi->description = $request->description;
                $lokasi->open = $request->open;
                $lokasi->close = $request->close;
                $lokasi->lat = $request->lat;
                $lokasi->lng = $request->lng;
                $lokasi->id_category = $request->id_category;
                if (Input::file('images') != null) {
                    if (!$this->multipleUpload($id, $id_menu)) {
                        Alert::error('Format gambar tidak sesuai', 'Data Gagal Diubah');
                        return redirect()->back();
                    }
                    if ($lokasi->save()) {
                        Alert::success('Data Berhasil Diubah');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                } else {
                    if ($lokasi->save()) {
                        Alert::success('Data Berhasil Diubah');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                }
                break;
            case 5:
                $lokasi = Praying::find($id);
                $lokasi->name = $request->name;
                $lokasi->address = $request->address;
                $lokasi->description = $request->description;
                $lokasi->lat = $request->lat;
                $lokasi->lng = $request->lng;
                $lokasi->id_category = $request->id_category;
                if (Input::file('images') != null) {
                    if (!$this->multipleUpload($id, $id_menu)) {
                        Alert::error('Format gambar tidak sesuai', 'Data Gagal Diubah');
                        return redirect()->back();
                    }
                    if ($lokasi->save()) {
                        Alert::success('Data Berhasil Diubah');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                } else {
                    if ($lokasi->save()) {
                        Alert::success('Data Berhasil Diubah');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                }
                break;
            case 6:
                $lokasi = Transportation::find($id);
                $lokasi->name = $request->name;
                $lokasi->address = $request->address;
                $lokasi->phone = $request->phone;
                $lokasi->price = $request->price;
                $lokasi->description = $request->description;
                $lokasi->departure = $request->departure;
                $lokasi->arriving = $request->arriving;
                $lokasi->lat = $request->lat;
                $lokasi->lng = $request->lng;
                $lokasi->id_category = $request->id_category;
                if (Input::file('images') != null) {
                    if (!$this->multipleUpload($id, $id_menu)) {
                        Alert::error('Format gambar tidak sesuai', 'Data Gagal Diubah');
                        return redirect()->back();
                    }
                    if ($lokasi->save()) {
                        Alert::success('Data Berhasil Diubah');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                } else {
                    if ($lokasi->save()) {
                        Alert::success('Data Berhasil Diubah');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                }
                break;
            case 7:
                $lokasi = PublicService::find($id);
                $lokasi->name = $request->name;
                $lokasi->address = $request->address;
                $lokasi->phone = $request->phone;
                $lokasi->description = $request->description;
                $lokasi->open = $request->open;
                $lokasi->close = $request->close;
                $lokasi->lat = $request->lat;
                $lokasi->lng = $request->lng;
                $lokasi->id_category = $request->id_category;
                if (Input::file('images') != null) {
                    if (!$this->multipleUpload($id, $id_menu)) {
                        Alert::error('Format gambar tidak sesuai', 'Data Gagal Diubah');
                        return redirect()->back();
                    }
                    if ($lokasi->save()) {
                        Alert::success('Data Berhasil Diubah');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                } else {
                    if ($lokasi->save()) {
                        Alert::success('Data Berhasil Diubah');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                }
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
                if (Input::file('images') != null) {
                    if (!$this->multipleUpload($id, $id_menu)) {
                        Alert::error('Format gambar tidak sesuai', 'Data Gagal Diubah');
                        return redirect()->back();
                    }
                    if ($lokasi->save()) {
                        Alert::success('Data Berhasil Diubah');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                } else {
                    if ($lokasi->save()) {
                        Alert::success('Data Berhasil Diubah');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                }
                break;
            case 9:
                $lokasi = Asset::find($id);
                $lokasi->name = $request->name;
                $lokasi->address = $request->address;
                $lokasi->phone = $request->phone;
                $lokasi->manager = $request->manager;
                $lokasi->description = $request->description;
                $lokasi->capacity = $request->capacity;
                $lokasi->lat = $request->lat;
                $lokasi->lng = $request->lng;
                $lokasi->id_menu = $request->id_menu;
                if (Input::file('images') != null) {
                    if (!$this->multipleUpload($id, $id_menu)) {
                        Alert::error('Format gambar tidak sesuai', 'Data Gagal Diubah');
                        return redirect()->back();
                    }
                    if ($lokasi->save()) {
                        Alert::success('Data Berhasil Diubah');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                } else {
                    if ($lokasi->save()) {
                        Alert::success('Data Berhasil Diubah');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                }
                break;
            case 10:
                $lokasi = Culture::find($id);
                $lokasi->name = $request->name;
                $lokasi->address = $request->address;
                $lokasi->phone = $request->phone;
                $lokasi->manager = $request->manager;
                $lokasi->description = $request->description;
                $lokasi->id_menu = $request->id_menu;
                if (Input::file('images') != null) {
                    if (!$this->multipleUpload($id, $id_menu)) {
                        Alert::error('Format gambar tidak sesuai', 'Data Gagal Diubah');
                        return redirect()->back();
                    }
                    if ($lokasi->save()) {
                        Alert::success('Data Berhasil Diubah');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                } else {
                    if ($lokasi->save()) {
                        Alert::success('Data Berhasil Diubah');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                }
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
                if (Input::file('images') != null) {
                    if (!$this->multipleUpload($id, $id_menu)) {
                        Alert::error('Format gambar tidak sesuai', 'Data Gagal Diubah');
                        return redirect()->back();
                    }
                    if ($lokasi->save()) {
                        Alert::success('Data Berhasil Diubah');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                } else {
                    if ($lokasi->save()) {
                        Alert::success('Data Berhasil Diubah');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                }
                break;
            case 12:
                $lokasi = Health::find($id);
                $lokasi->name = $request->name;
                $lokasi->address = $request->address;
                $lokasi->phone = $request->phone;
                $lokasi->description = $request->description;
                $lokasi->open = $request->open;
                $lokasi->close = $request->close;
                $lokasi->lat = $request->lat;
                $lokasi->lng = $request->lng;
                $lokasi->id_category = $request->id_category;
                if (Input::file('images') != null) {
                    if (!$this->multipleUpload($id, $id_menu)) {
                        Alert::error('Format gambar tidak sesuai', 'Data Gagal Diubah');
                        return redirect()->back();
                    }
                    if ($lokasi->save()) {
                        Alert::success('Data Berhasil Diubah');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                } else {
                    if ($lokasi->save()) {
                        Alert::success('Data Berhasil Diubah');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                }
                break;
            case 13:
                $lokasi = Event::find($id);
                $lokasi->name = $request->name;
                $lokasi->description = $request->description;
                $lokasi->time = $request->time;
                if (Input::file('images') != null) {
                    if (!$this->multipleUpload($id, $id_menu)) {
                        Alert::error('Format gambar tidak sesuai', 'Data Gagal Diubah');
                        return redirect()->back();
                    }
                    if ($lokasi->save()) {
                        Alert::success('Data Berhasil Diubah');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                } else {
                    if ($lokasi->save()) {
                        Alert::success('Data Berhasil Diubah');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                }
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
            case 15:
                $lokasi = Booking::find($id);
                $lokasi->booking_status_id = $request->booking_status_id;
                $lokasi->save();
                Alert::success('Data Berhasil Diubah');
                return redirect()->back();
                break;
            case 16:
                $lokasi = Review::find($id);
                $lokasi->response = $request->response;
                $lokasi->save();
                Alert::success('Data Berhasil Diubah');
                return redirect('showMenu/' . $request->id_menu);
                break;
        }

    }

    public function updateNo(Request $request, $id, $id_menu)
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
                if (Input::file('images') != null) {
                    if (!$this->multipleUpload($id, $id_menu)) {
                        Alert::error('Format gambar tidak sesuai', 'Data Gagal Diubah');
                        return redirect()->back();
                    }
                    if ($lokasi->save()) {
                        Alert::success('Data Berhasil Diubah');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                } else {
                    if ($lokasi->save()) {
                        Alert::success('Data Berhasil Diubah');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                }
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
                if (Input::file('images') != null) {
                    if (!$this->multipleUpload($id, $id_menu)) {
                        Alert::error('Format gambar tidak sesuai', 'Data Gagal Diubah');
                        return redirect()->back();
                    }
                    if ($lokasi->save()) {
                        Alert::success('Data Berhasil Diubah');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                } else {
                    if ($lokasi->save()) {
                        Alert::success('Data Berhasil Diubah');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                }
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
                if (Input::file('images') != null) {
                    if (!$this->multipleUpload($id, $id_menu)) {
                        Alert::error('Format gambar tidak sesuai', 'Data Gagal Diubah');
                        return redirect()->back();
                    }
                    if ($lokasi->save()) {
                        Alert::success('Data Berhasil Diubah');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                } else {
                    if ($lokasi->save()) {
                        Alert::success('Data Berhasil Diubah');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                }
                break;
            case 4:
                $lokasi = Shopping::find($id);
                $lokasi->name = $request->name;
                $lokasi->address = $request->address;
                $lokasi->phone = $request->phone;
                $lokasi->description = $request->description;
                $lokasi->open = $request->open;
                $lokasi->close = $request->close;
                $lokasi->lat = $request->lat;
                $lokasi->lng = $request->lng;
                $lokasi->id_category = $request->id_category;
                if (Input::file('images') != null) {
                    if (!$this->multipleUpload($id, $id_menu)) {
                        Alert::error('Format gambar tidak sesuai', 'Data Gagal Diubah');
                        return redirect()->back();
                    }
                    if ($lokasi->save()) {
                        Alert::success('Data Berhasil Diubah');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                } else {
                    if ($lokasi->save()) {
                        Alert::success('Data Berhasil Diubah');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                }
                break;
            case 5:
                $lokasi = Praying::find($id);
                $lokasi->name = $request->name;
                $lokasi->address = $request->address;
                $lokasi->description = $request->description;
                $lokasi->lat = $request->lat;
                $lokasi->lng = $request->lng;
                $lokasi->id_category = $request->id_category;
                if (Input::file('images') != null) {
                    if (!$this->multipleUpload($id, $id_menu)) {
                        Alert::error('Format gambar tidak sesuai', 'Data Gagal Diubah');
                        return redirect()->back();
                    }
                    if ($lokasi->save()) {
                        Alert::success('Data Berhasil Diubah');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                } else {
                    if ($lokasi->save()) {
                        Alert::success('Data Berhasil Diubah');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                }
                break;
            case 6:
                $lokasi = Transportation::find($id);
                $lokasi->name = $request->name;
                $lokasi->address = $request->address;
                $lokasi->phone = $request->phone;
                $lokasi->price = $request->price;
                $lokasi->description = $request->description;
                $lokasi->departure = $request->departure;
                $lokasi->arriving = $request->arriving;
                $lokasi->lat = $request->lat;
                $lokasi->lng = $request->lng;
                $lokasi->id_category = $request->id_category;
                if (Input::file('images') != null) {
                    if (!$this->multipleUpload($id, $id_menu)) {
                        Alert::error('Format gambar tidak sesuai', 'Data Gagal Diubah');
                        return redirect()->back();
                    }
                    if ($lokasi->save()) {
                        Alert::success('Data Berhasil Diubah');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                } else {
                    if ($lokasi->save()) {
                        Alert::success('Data Berhasil Diubah');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                }
                break;
            case 7:
                $lokasi = PublicService::find($id);
                $lokasi->name = $request->name;
                $lokasi->address = $request->address;
                $lokasi->phone = $request->phone;
                $lokasi->description = $request->description;
                $lokasi->open = $request->open;
                $lokasi->close = $request->close;
                $lokasi->lat = $request->lat;
                $lokasi->lng = $request->lng;
                $lokasi->id_category = $request->id_category;
                if (Input::file('images') != null) {
                    if (!$this->multipleUpload($id, $id_menu)) {
                        Alert::error('Format gambar tidak sesuai', 'Data Gagal Diubah');
                        return redirect()->back();
                    }
                    if ($lokasi->save()) {
                        Alert::success('Data Berhasil Diubah');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                } else {
                    if ($lokasi->save()) {
                        Alert::success('Data Berhasil Diubah');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                }
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
                if (Input::file('images') != null) {
                    if (!$this->multipleUpload($id, $id_menu)) {
                        Alert::error('Format gambar tidak sesuai', 'Data Gagal Diubah');
                        return redirect()->back();
                    }
                    if ($lokasi->save()) {
                        Alert::success('Data Berhasil Diubah');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                } else {
                    if ($lokasi->save()) {
                        Alert::success('Data Berhasil Diubah');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                }
                break;
            case 9:
                $lokasi = Asset::find($id);
                $lokasi->name = $request->name;
                $lokasi->address = $request->address;
                $lokasi->phone = $request->phone;
                $lokasi->manager = $request->manager;
                $lokasi->description = $request->description;
                $lokasi->capacity = $request->capacity;
                $lokasi->lat = $request->lat;
                $lokasi->lng = $request->lng;
                $lokasi->id_menu = $request->id_menu;
                if (Input::file('images') != null) {
                    if (!$this->multipleUpload($id, $id_menu)) {
                        Alert::error('Format gambar tidak sesuai', 'Data Gagal Diubah');
                        return redirect()->back();
                    }
                    if ($lokasi->save()) {
                        Alert::success('Data Berhasil Diubah');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                } else {
                    if ($lokasi->save()) {
                        Alert::success('Data Berhasil Diubah');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                }
                break;
            case 10:
                $lokasi = Culture::find($id);
                $lokasi->name = $request->name;
                $lokasi->address = $request->address;
                $lokasi->phone = $request->phone;
                $lokasi->manager = $request->manager;
                $lokasi->description = $request->description;
                $lokasi->id_menu = $request->id_menu;
                if (Input::file('images') != null) {
                    if (!$this->multipleUpload($id, $id_menu)) {
                        Alert::error('Format gambar tidak sesuai', 'Data Gagal Diubah');
                        return redirect()->back();
                    }
                    if ($lokasi->save()) {
                        Alert::success('Data Berhasil Diubah');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                } else {
                    if ($lokasi->save()) {
                        Alert::success('Data Berhasil Diubah');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                }
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
                if (Input::file('images') != null) {
                    if (!$this->multipleUpload($id, $id_menu)) {
                        Alert::error('Format gambar tidak sesuai', 'Data Gagal Diubah');
                        return redirect()->back();
                    }
                    if ($lokasi->save()) {
                        Alert::success('Data Berhasil Diubah');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                } else {
                    if ($lokasi->save()) {
                        Alert::success('Data Berhasil Diubah');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                }
                break;
            case 12:
                $lokasi = Health::find($id);
                $lokasi->name = $request->name;
                $lokasi->address = $request->address;
                $lokasi->phone = $request->phone;
                $lokasi->description = $request->description;
                $lokasi->open = $request->open;
                $lokasi->close = $request->close;
                $lokasi->lat = $request->lat;
                $lokasi->lng = $request->lng;
                $lokasi->id_category = $request->id_category;
                if (Input::file('images') != null) {
                    if (!$this->multipleUpload($id, $id_menu)) {
                        Alert::error('Format gambar tidak sesuai', 'Data Gagal Diubah');
                        return redirect()->back();
                    }
                    if ($lokasi->save()) {
                        Alert::success('Data Berhasil Diubah');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                } else {
                    if ($lokasi->save()) {
                        Alert::success('Data Berhasil Diubah');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                }
                break;
            case 13:
                $lokasi = Event::find($id);
                $lokasi->name = $request->name;
                $lokasi->description = $request->description;
                $lokasi->time = $request->time;
                if (Input::file('images') != null) {
                    if (!$this->multipleUpload($id, $id_menu)) {
                        Alert::error('Format gambar tidak sesuai', 'Data Gagal Diubah');
                        return redirect()->back();
                    }
                    if ($lokasi->save()) {
                        Alert::success('Data Berhasil Diubah');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                } else {
                    if ($lokasi->save()) {
                        Alert::success('Data Berhasil Diubah');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                }
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
            case 15:
                $lokasi = Booking::find($id);
                $lokasi->booking_status_id = $request->booking_status_id;
                $lokasi->save();
                Alert::success('Data Berhasil Diubah');
                return redirect()->back();
                break;
            case 16:
                $lokasi = Review::find($id);
                $lokasi->response = $request->response;
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
                if (Input::file('images') != null) {
                    if (!$this->multipleUpload($id, $id_menu)) {
                        Alert::error('Format gambar tidak sesuai', 'Data Gagal Diubah');
                        return redirect()->back();
                    }
                    if ($lokasi->save()) {
                        Alert::success('Data Berhasil Diubah');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                } else {
                    if ($lokasi->save()) {
                        Alert::success('Data Berhasil Diubah');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                }
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
                if (Input::file('images') != null) {
                    if (!$this->multipleUpload($id, $id_menu)) {
                        Alert::error('Format gambar tidak sesuai', 'Data Gagal Diubah');
                        return redirect()->back();
                    }
                    if ($lokasi->save()) {
                        Alert::success('Data Berhasil Diubah');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                } else {
                    if ($lokasi->save()) {
                        Alert::success('Data Berhasil Diubah');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                }
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
                if (Input::file('images') != null) {
                    if (!$this->multipleUpload($id, $id_menu)) {
                        Alert::error('Format gambar tidak sesuai', 'Data Gagal Diubah');
                        return redirect()->back();
                    }
                    if ($lokasi->save()) {
                        Alert::success('Data Berhasil Diubah');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                } else {
                    if ($lokasi->save()) {
                        Alert::success('Data Berhasil Diubah');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                }
                break;
            case 4:
                $lokasi = Shopping::find($id);
                $lokasi->name = $request->name;
                $lokasi->address = $request->address;
                $lokasi->phone = $request->phone;
                $lokasi->description = $request->description;
                $lokasi->open = $request->open;
                $lokasi->close = $request->close;
                $lokasi->lat = $request->lat;
                $lokasi->lng = $request->lng;
                $lokasi->id_category = $request->id_category;
                if (Input::file('images') != null) {
                    if (!$this->multipleUpload($id, $id_menu)) {
                        Alert::error('Format gambar tidak sesuai', 'Data Gagal Diubah');
                        return redirect()->back();
                    }
                    if ($lokasi->save()) {
                        Alert::success('Data Berhasil Diubah');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                } else {
                    if ($lokasi->save()) {
                        Alert::success('Data Berhasil Diubah');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                }
                break;
            case 5:
                $lokasi = Praying::find($id);
                $lokasi->name = $request->name;
                $lokasi->address = $request->address;
                $lokasi->description = $request->description;
                $lokasi->lat = $request->lat;
                $lokasi->lng = $request->lng;
                $lokasi->id_category = $request->id_category;
                if (Input::file('images') != null) {
                    if (!$this->multipleUpload($id, $id_menu)) {
                        Alert::error('Format gambar tidak sesuai', 'Data Gagal Diubah');
                        return redirect()->back();
                    }
                    if ($lokasi->save()) {
                        Alert::success('Data Berhasil Diubah');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                } else {
                    if ($lokasi->save()) {
                        Alert::success('Data Berhasil Diubah');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                }
                break;
            case 6:
                $lokasi = Transportation::find($id);
                $lokasi->name = $request->name;
                $lokasi->address = $request->address;
                $lokasi->phone = $request->phone;
                $lokasi->price = $request->price;
                $lokasi->description = $request->description;
                $lokasi->departure = $request->departure;
                $lokasi->arriving = $request->arriving;
                $lokasi->lat = $request->lat;
                $lokasi->lng = $request->lng;
                $lokasi->id_category = $request->id_category;
                if (Input::file('images') != null) {
                    if (!$this->multipleUpload($id, $id_menu)) {
                        Alert::error('Format gambar tidak sesuai', 'Data Gagal Diubah');
                        return redirect()->back();
                    }
                    if ($lokasi->save()) {
                        Alert::success('Data Berhasil Diubah');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                } else {
                    if ($lokasi->save()) {
                        Alert::success('Data Berhasil Diubah');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                }
                break;
            case 7:
                $lokasi = PublicService::find($id);
                $lokasi->name = $request->name;
                $lokasi->address = $request->address;
                $lokasi->phone = $request->phone;
                $lokasi->description = $request->description;
                $lokasi->open = $request->open;
                $lokasi->close = $request->close;
                $lokasi->lat = $request->lat;
                $lokasi->lng = $request->lng;
                $lokasi->id_category = $request->id_category;
                if (Input::file('images') != null) {
                    if (!$this->multipleUpload($id, $id_menu)) {
                        Alert::error('Format gambar tidak sesuai', 'Data Gagal Diubah');
                        return redirect()->back();
                    }
                    if ($lokasi->save()) {
                        Alert::success('Data Berhasil Diubah');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                } else {
                    if ($lokasi->save()) {
                        Alert::success('Data Berhasil Diubah');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                }
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
                if (Input::file('images') != null) {
                    if (!$this->multipleUpload($id, $id_menu)) {
                        Alert::error('Format gambar tidak sesuai', 'Data Gagal Diubah');
                        return redirect()->back();
                    }
                    if ($lokasi->save()) {
                        Alert::success('Data Berhasil Diubah');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                } else {
                    if ($lokasi->save()) {
                        Alert::success('Data Berhasil Diubah');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                }
                break;
            case 9:
                $lokasi = Asset::find($id);
                $lokasi->name = $request->name;
                $lokasi->address = $request->address;
                $lokasi->phone = $request->phone;
                $lokasi->manager = $request->manager;
                $lokasi->description = $request->description;
                $lokasi->capacity = $request->capacity;
                $lokasi->lat = $request->lat;
                $lokasi->lng = $request->lng;
                $lokasi->id_menu = $request->id_menu;
                if (Input::file('images') != null) {
                    if (!$this->multipleUpload($id, $id_menu)) {
                        Alert::error('Format gambar tidak sesuai', 'Data Gagal Diubah');
                        return redirect()->back();
                    }
                    if ($lokasi->save()) {
                        Alert::success('Data Berhasil Diubah');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                } else {
                    if ($lokasi->save()) {
                        Alert::success('Data Berhasil Diubah');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                }
                break;
            case 10:
                $lokasi = Culture::find($id);
                $lokasi->name = $request->name;
                $lokasi->address = $request->address;
                $lokasi->phone = $request->phone;
                $lokasi->manager = $request->manager;
                $lokasi->description = $request->description;
                $lokasi->id_menu = $request->id_menu;
                if (Input::file('images') != null) {
                    if (!$this->multipleUpload($id, $id_menu)) {
                        Alert::error('Format gambar tidak sesuai', 'Data Gagal Diubah');
                        return redirect()->back();
                    }
                    if ($lokasi->save()) {
                        Alert::success('Data Berhasil Diubah');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                } else {
                    if ($lokasi->save()) {
                        Alert::success('Data Berhasil Diubah');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                }
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
                if (Input::file('images') != null) {
                    if (!$this->multipleUpload($id, $id_menu)) {
                        Alert::error('Format gambar tidak sesuai', 'Data Gagal Diubah');
                        return redirect()->back();
                    }
                    if ($lokasi->save()) {
                        Alert::success('Data Berhasil Diubah');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                } else {
                    if ($lokasi->save()) {
                        Alert::success('Data Berhasil Diubah');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                }
                break;
            case 12:
                $lokasi = Health::find($id);
                $lokasi->name = $request->name;
                $lokasi->address = $request->address;
                $lokasi->phone = $request->phone;
                $lokasi->description = $request->description;
                $lokasi->open = $request->open;
                $lokasi->close = $request->close;
                $lokasi->lat = $request->lat;
                $lokasi->lng = $request->lng;
                $lokasi->id_category = $request->id_category;
                if (Input::file('images') != null) {
                    if (!$this->multipleUpload($id, $id_menu)) {
                        Alert::error('Format gambar tidak sesuai', 'Data Gagal Diubah');
                        return redirect()->back();
                    }
                    if ($lokasi->save()) {
                        Alert::success('Data Berhasil Diubah');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                } else {
                    if ($lokasi->save()) {
                        Alert::success('Data Berhasil Diubah');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                }
                break;
            case 13:
                $lokasi = Event::find($id);
                $lokasi->name = $request->name;
                $lokasi->description = $request->description;
                $lokasi->time = $request->time;
                if (Input::file('images') != null) {
                    if (!$this->multipleUpload($id, $id_menu)) {
                        Alert::error('Format gambar tidak sesuai', 'Data Gagal Diubah');
                        return redirect()->back();
                    }
                    if ($lokasi->save()) {
                        Alert::success('Data Berhasil Diubah');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                } else {
                    if ($lokasi->save()) {
                        Alert::success('Data Berhasil Diubah');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                }
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
                if (Input::file('images') != null) {
                    if (!$this->multipleUpload($id, $id_menu)) {
                        Alert::error('Format gambar tidak sesuai', 'Data Gagal Diubah');
                        return redirect()->back();
                    }
                    if ($lokasi->save()) {
                        Alert::success('Data Berhasil Diubah');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                } else {
                    if ($lokasi->save()) {
                        Alert::success('Data Berhasil Diubah');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                }
                break;
            case 15:
                $lokasi = Booking::find($id);
                $lokasi->booking_status_id = $request->booking_status_id;
                $lokasi->save();
                Alert::success('Data Berhasil Diubah');
                return redirect()->back();
                break;
            case 16:
                $lokasi = Review::find($id);
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
                if (Input::file('images') != null) {
                    if (!$this->multipleUpload($id, $id_menu)) {
                        Alert::error('Format gambar tidak sesuai', 'Data Gagal Diubah');
                        return redirect()->back();
                    }
                    if ($lokasi->save()) {
                        Alert::success('Data Berhasil Diubah');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                } else {
                    if ($lokasi->save()) {
                        Alert::success('Data Berhasil Diubah');
                        return redirect('showMenu/' . $request->id_menu);
                    }
                }
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
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object', $id);
                return view('tourism/view', ['item' => $items, 'data' => $kategori, 'menu' => $menu, 'pictures' => $gambar, 'menus' => $menus]);
                break;
            case 2:
                $items = Hotel::find($id);
                $kategori = Category::find($id_category);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object', $id);
                return view('hotel/view', ['item' => $items, 'data' => $kategori, 'menu' => $menu, 'pictures' => $gambar, 'menus' => $menus]);
                break;
            case 3:
                $items = Culinary::find($id);
                $kategori = Category::find($id_category);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object', $id);
                return view('culinary/view', ['item' => $items, 'data' => $kategori, 'menu' => $menu, 'pictures' => $gambar, 'menus' => $menus]);
                break;
            case 4:
                $items = Shopping::find($id);
                $kategori = Category::find($id_category);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object', $id);
                return view('shopping/view', ['item' => $items, 'data' => $kategori, 'menu' => $menu, 'pictures' => $gambar, 'menus' => $menus]);
                break;
            case 5:
                $items = Praying::find($id);
                $kategori = Category::find($id_category);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object', $id);
                return view('praying/view', ['item' => $items, 'data' => $kategori, 'menu' => $menu, 'pictures' => $gambar, 'menus' => $menus]);
                break;
            case 6:
                $items = Transportation::find($id);
                $kategori = Category::find($id_category);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object', $id);
                return view('transportation/view', ['item' => $items, 'data' => $kategori, 'menu' => $menu, 'pictures' => $gambar, 'menus' => $menus]);
                break;
            case 7:
                $items = PublicService::find($id);
                $kategori = Category::find($id_category);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object', $id);
                return view('public_service/view', ['item' => $items, 'data' => $kategori, 'menu' => $menu, 'pictures' => $gambar, 'menus' => $menus]);
                break;
            case 8:
                $items = Finance::find($id);
                $kategori = Category::find($id_category);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object', $id);
                return view('finance/view', ['item' => $items, 'data' => $kategori, 'menu' => $menu, 'pictures' => $gambar, 'menus' => $menus]);
                break;
            case 9:
                $items = Asset::find($id);
                $kategori = Category::find($id_category);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object', $id);
                return view('asset/view', ['item' => $items, 'data' => $kategori, 'menu' => $menu, 'pictures' => $gambar, 'menus' => $menus]);
                break;
            case 10:
                $items = Culture::find($id);
                $kategori = Category::find($id_category);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object', $id);
                return view('culture/view', ['item' => $items, 'data' => $kategori, 'menu' => $menu, 'pictures' => $gambar, 'menus' => $menus]);
                break;
            case 11:
                $items = Leisure::find($id);
                $kategori = Category::find($id_category);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object', $id);
                return view('leisure/view', ['item' => $items, 'data' => $kategori, 'menu' => $menu, 'pictures' => $gambar, 'menus' => $menus]);
                break;
            case 12:
                $items = Health::find($id);
                $kategori = Category::find($id_category);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object', $id);
                return view('health/view', ['item' => $items, 'data' => $kategori, 'menu' => $menu, 'pictures' => $gambar, 'menus' => $menus]);
                break;
            case 13:
                $items = Event::find($id);
                $kategori = Category::find($id_category);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object', $id);
                return view('event/view', ['item' => $items, 'data' => $kategori, 'menu' => $menu, 'pictures' => $gambar, 'menus' => $menus]);
                break;
            case 14:
                $items = Visitor::find($id);
                $kategori = Category::find($id_category);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object', $id);
                return view('visitor/view', ['item' => $items, 'data' => $kategori, 'menu' => $menu, 'pictures' => $gambar, 'menus' => $menus]);
                break;
            case 15:
                $items = Booking::find($id);
                $kategori = Category::find($id_category);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object', $id);
                return view('booking/view', ['item' => $items, 'data' => $kategori, 'menu' => $menu, 'pictures' => $gambar, 'menus' => $menus]);
                break;
            case 16:
                $items = Review::find($id);
                $kategori = Category::find($id_category);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object', $id);
                return view('review/view', ['item' => $items, 'data' => $kategori, 'menu' => $menu, 'pictures' => $gambar, 'menus' => $menus]);
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
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object', $id);
                return view('tourism/view', ['item' => $items, 'data' => $kategori, 'menu' => $menu, 'pictures' => $gambar, 'menus' => $menus]);
                break;
            case 2:
                $items = Hotel::find($id);
                $kategori = Category::find($id_category);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object', $id);
                return view('hotel/view', ['item' => $items, 'data' => $kategori, 'menu' => $menu, 'pictures' => $gambar, 'menus' => $menus]);
                break;
            case 3:
                $items = Culinary::find($id);
                $kategori = Category::find($id_category);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object', $id);
                return view('culinary/view', ['item' => $items, 'data' => $kategori, 'menu' => $menu, 'pictures' => $gambar, 'menus' => $menus]);
                break;
            case 4:
                $items = Shopping::find($id);
                $kategori = Category::find($id_category);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object', $id);
                return view('shopping/view', ['item' => $items, 'data' => $kategori, 'menu' => $menu, 'pictures' => $gambar, 'menus' => $menus]);
                break;
            case 5:
                $items = Praying::find($id);
                $kategori = Category::find($id_category);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object', $id);
                return view('praying/view', ['item' => $items, 'data' => $kategori, 'menu' => $menu, 'pictures' => $gambar, 'menus' => $menus]);
                break;
            case 6:
                $items = Transportation::find($id);
                $kategori = Category::find($id_category);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object', $id);
                return view('transportation/view', ['item' => $items, 'data' => $kategori, 'menu' => $menu, 'pictures' => $gambar, 'menus' => $menus]);
                break;
            case 7:
                $items = PublicService::find($id);
                $kategori = Category::find($id_category);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object', $id);
                return view('public_service/view', ['item' => $items, 'data' => $kategori, 'menu' => $menu, 'pictures' => $gambar, 'menus' => $menus]);
                break;
            case 8:
                $items = Finance::find($id);
                $kategori = Category::find($id_category);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object', $id);
                return view('finance/view', ['item' => $items, 'data' => $kategori, 'menu' => $menu, 'pictures' => $gambar, 'menus' => $menus]);
                break;
            case 9:
                $items = Asset::find($id);
                $kategori = Category::find($id_category);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object', $id);
                return view('asset/view', ['item' => $items, 'data' => $kategori, 'menu' => $menu, 'pictures' => $gambar, 'menus' => $menus]);
                break;
            case 10:
                $items = Culture::find($id);
                $kategori = Category::find($id_category);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object', $id);
                return view('culture/view', ['item' => $items, 'data' => $kategori, 'menu' => $menu, 'pictures' => $gambar, 'menus' => $menus]);
                break;
            case 11:
                $items = Leisure::find($id);
                $kategori = Category::find($id_category);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object', $id);
                return view('leisure/view', ['item' => $items, 'data' => $kategori, 'menu' => $menu, 'pictures' => $gambar, 'menus' => $menus]);
                break;
            case 12:
                $items = Health::find($id);
                $kategori = Category::find($id_category);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object', $id);
                return view('health/view', ['item' => $items, 'data' => $kategori, 'menu' => $menu, 'pictures' => $gambar, 'menus' => $menus]);
                break;
            case 13:
                $items = Event::find($id);
                $kategori = Category::find($id_category);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object', $id);
                return view('event/view', ['item' => $items, 'data' => $kategori, 'menu' => $menu, 'pictures' => $gambar, 'menus' => $menus]);
                break;
            case 14:
                $items = Visitor::find($id);
                $kategori = Category::find($id_category);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object', $id);
                return view('visitor/view', ['item' => $items, 'data' => $kategori, 'menu' => $menu, 'pictures' => $gambar, 'menus' => $menus]);
                break;
            case 15:
                $items = Booking::find($id);
                $kategori = Category::find($id_category);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object', $id);
                return view('booking/view', ['item' => $items, 'data' => $kategori, 'menu' => $menu, 'pictures' => $gambar, 'menus' => $menus]);
                break;
            case 16:
                $items = Review::find($id);
                $kategori = Category::find($id_category);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object', $id);
                return view('review/view', ['item' => $items, 'data' => $kategori, 'menu' => $menu, 'pictures' => $gambar, 'menus' => $menus]);
                break;
        }

    }

    public function destroy($id_category, $id, $id_menu)
    {
        switch ($id_menu) {

            case 1:
                $items = Tourism::find($id);
                $reviews = Review::all()->where('id_object', $items->id)->where('id_menu', $id_menu);
                $pictures = Picture::all()->where('id_object', $items->id)->where('id_menu', $id_menu);
                foreach ($reviews as $review) {
                    $review->delete();
                }
                foreach ($pictures as $picture) {
                    $picture->delete();
                }
                $items->delete();
                return redirect('showMenu/data/' . $id_category . '/' . $id_menu);
                break;
            case 2:
                $items = Hotel::find($id);
                $reviews = Review::all()->where('id_object', $items->id)->where('id_menu', $id_menu);
                $pictures = Picture::all()->where('id_object', $items->id)->where('id_menu', $id_menu);
                foreach ($reviews as $review) {
                    $review->delete();
                }
                foreach ($pictures as $picture) {
                    $picture->delete();
                }
                $items->delete();
                return redirect('showMenu/data/' . $id_category . '/' . $id_menu);
                break;
            case 3:
                $items = Culinary::find($id);
                $reviews = Review::all()->where('id_object', $items->id)->where('id_menu', $id_menu);
                $pictures = Picture::all()->where('id_object', $items->id)->where('id_menu', $id_menu);
                foreach ($reviews as $review) {
                    $review->delete();
                }
                foreach ($pictures as $picture) {
                    $picture->delete();
                }
                $items->delete();
                return redirect('showMenu/data/' . $id_category . '/' . $id_menu);
                break;
            case 4:
                $items = Shopping::find($id);
                $reviews = Review::all()->where('id_object', $items->id)->where('id_menu', $id_menu);
                $pictures = Picture::all()->where('id_object', $items->id)->where('id_menu', $id_menu);
                foreach ($reviews as $review) {
                    $review->delete();
                }
                foreach ($pictures as $picture) {
                    $picture->delete();
                }
                $items->delete();
                return redirect('showMenu/data/' . $id_category . '/' . $id_menu);
                break;
            case 5:
                $items = Praying::find($id);
                $reviews = Review::all()->where('id_object', $items->id)->where('id_menu', $id_menu);
                $pictures = Picture::all()->where('id_object', $items->id)->where('id_menu', $id_menu);
                foreach ($reviews as $review) {
                    $review->delete();
                }
                foreach ($pictures as $picture) {
                    $picture->delete();
                }
                $items->delete();
                return redirect('showMenu/data/' . $id_category . '/' . $id_menu);
                break;
            case 6:
                $items = Transportation::find($id);
                $reviews = Review::all()->where('id_object', $items->id)->where('id_menu', $id_menu);
                $pictures = Picture::all()->where('id_object', $items->id)->where('id_menu', $id_menu);
                foreach ($reviews as $review) {
                    $review->delete();
                }
                foreach ($pictures as $picture) {
                    $picture->delete();
                }
                $items->delete();
                return redirect('showMenu/data/' . $id_category . '/' . $id_menu);
                break;
            case 7:
                $items = PublicService::find($id);
                $reviews = Review::all()->where('id_object', $items->id)->where('id_menu', $id_menu);
                $pictures = Picture::all()->where('id_object', $items->id)->where('id_menu', $id_menu);
                foreach ($reviews as $review) {
                    $review->delete();
                }
                foreach ($pictures as $picture) {
                    $picture->delete();
                }
                $items->delete();
                return redirect('showMenu/data/' . $id_category . '/' . $id_menu);
                break;
            case 8:
                $items = Finance::find($id);
                $reviews = Review::all()->where('id_object', $items->id)->where('id_menu', $id_menu);
                $pictures = Picture::all()->where('id_object', $items->id)->where('id_menu', $id_menu);
                foreach ($reviews as $review) {
                    $review->delete();
                }
                foreach ($pictures as $picture) {
                    $picture->delete();
                }
                $items->delete();
                return redirect('showMenu/data/' . $id_category . '/' . $id_menu);
                break;
            case 9:
                $items = Asset::find($id);
                $reviews = Review::all()->where('id_object', $items->id)->where('id_menu', $id_menu);
                $pictures = Picture::all()->where('id_object', $items->id)->where('id_menu', $id_menu);
                foreach ($reviews as $review) {
                    $review->delete();
                }
                foreach ($pictures as $picture) {
                    $picture->delete();
                }
                $items->delete();
                return redirect('showMenu/data/' . $id_category . '/' . $id_menu);
                break;
            case 10:
                $items = Culture::find($id);
                $reviews = Review::all()->where('id_object', $items->id)->where('id_menu', $id_menu);
                $pictures = Picture::all()->where('id_object', $items->id)->where('id_menu', $id_menu);
                foreach ($reviews as $review) {
                    $review->delete();
                }
                foreach ($pictures as $picture) {
                    $picture->delete();
                }
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
                $reviews = Review::all()->where('id_object', $items->id)->where('id_menu', $id_menu);
                $pictures = Picture::all()->where('id_object', $items->id)->where('id_menu', $id_menu);
                foreach ($reviews as $review) {
                    $review->delete();
                }
                foreach ($pictures as $picture) {
                    $picture->delete();
                }
                $items->delete();
                return redirect('showMenu/data/' . $id_category . '/' . $id_menu);
                break;
            case 13:
                $items = Event::find($id);
                $reviews = Review::all()->where('id_object', $items->id)->where('id_menu', $id_menu);
                $pictures = Picture::all()->where('id_object', $items->id)->where('id_menu', $id_menu);
                foreach ($reviews as $review) {
                    $review->delete();
                }
                foreach ($pictures as $picture) {
                    $picture->delete();
                }
                $items->delete();
                return redirect('showMenu/data/' . $id_category . '/' . $id_menu);
                break;
            case 14:
                $items = Visitor::find($id);
                $items->delete();
                return redirect('showMenu/data/' . $id_category . '/' . $id_menu);
                break;
            case 15:
                $items = Booking::find($id);
                $items->delete();
                return redirect('showMenu/data/' . $id_category . '/' . $id_menu);
                break;
            case 16:
                $items = Review::find($id);
                $items->delete();
                return redirect('showMenu/data/' . $id_category . '/' . $id_menu);
                break;
        }

    }

    public function destroys($id, $id_category, $id_menu)
    {
        switch ($id_menu) {

            case 1:
                $items = Tourism::find($id);
                $reviews = Review::all()->where('id_object', $items->id)->where('id_menu', $id_menu);
                $pictures = Picture::all()->where('id_object', $items->id)->where('id_menu', $id_menu);
                foreach ($reviews as $review) {
                    $review->delete();
                }
                foreach ($pictures as $picture) {
                    $picture->delete();
                }
                $items->delete();
                return redirect('showMenu/data/' . $id_category . '/' . $id_menu);
                break;
            case 2:
                $items = Hotel::find($id);
                $reviews = Review::all()->where('id_object', $items->id)->where('id_menu', $id_menu);
                $pictures = Picture::all()->where('id_object', $items->id)->where('id_menu', $id_menu);
                foreach ($reviews as $review) {
                    $review->delete();
                }
                foreach ($pictures as $picture) {
                    $picture->delete();
                }
                $items->delete();
                return redirect('showMenu/data/' . $id_category . '/' . $id_menu);
                break;
            case 3:
                $items = Culinary::find($id);
                $reviews = Review::all()->where('id_object', $items->id)->where('id_menu', $id_menu);
                $pictures = Picture::all()->where('id_object', $items->id)->where('id_menu', $id_menu);
                foreach ($reviews as $review) {
                    $review->delete();
                }
                foreach ($pictures as $picture) {
                    $picture->delete();
                }
                $items->delete();
                return redirect('showMenu/data/' . $id_category . '/' . $id_menu);
                break;
            case 4:
                $items = Shopping::find($id);
                $reviews = Review::all()->where('id_object', $items->id)->where('id_menu', $id_menu);
                $pictures = Picture::all()->where('id_object', $items->id)->where('id_menu', $id_menu);
                foreach ($reviews as $review) {
                    $review->delete();
                }
                foreach ($pictures as $picture) {
                    $picture->delete();
                }
                $items->delete();
                return redirect('showMenu/data/' . $id_category . '/' . $id_menu);
                break;
            case 5:
                $items = Praying::find($id);
                $reviews = Review::all()->where('id_object', $items->id)->where('id_menu', $id_menu);
                $pictures = Picture::all()->where('id_object', $items->id)->where('id_menu', $id_menu);
                foreach ($reviews as $review) {
                    $review->delete();
                }
                foreach ($pictures as $picture) {
                    $picture->delete();
                }
                $items->delete();
                return redirect('showMenu/data/' . $id_category . '/' . $id_menu);
                break;
            case 6:
                $items = Transportation::find($id);
                $reviews = Review::all()->where('id_object', $items->id)->where('id_menu', $id_menu);
                $pictures = Picture::all()->where('id_object', $items->id)->where('id_menu', $id_menu);
                foreach ($reviews as $review) {
                    $review->delete();
                }
                foreach ($pictures as $picture) {
                    $picture->delete();
                }
                $items->delete();
                return redirect('showMenu/data/' . $id_category . '/' . $id_menu);
                break;
            case 7:
                $items = PublicService::find($id);
                $reviews = Review::all()->where('id_object', $items->id)->where('id_menu', $id_menu);
                $pictures = Picture::all()->where('id_object', $items->id)->where('id_menu', $id_menu);
                foreach ($reviews as $review) {
                    $review->delete();
                }
                foreach ($pictures as $picture) {
                    $picture->delete();
                }
                $items->delete();
                return redirect('showMenu/data/' . $id_category . '/' . $id_menu);
                break;
            case 8:
                $items = Finance::find($id);
                $reviews = Review::all()->where('id_object', $items->id)->where('id_menu', $id_menu);
                $pictures = Picture::all()->where('id_object', $items->id)->where('id_menu', $id_menu);
                foreach ($reviews as $review) {
                    $review->delete();
                }
                foreach ($pictures as $picture) {
                    $picture->delete();
                }
                $items->delete();
                return redirect('showMenu/data/' . $id_category . '/' . $id_menu);
                break;
            case 9:
                $items = Asset::find($id);
                $reviews = Review::all()->where('id_object', $items->id)->where('id_menu', $id_menu);
                $pictures = Picture::all()->where('id_object', $items->id)->where('id_menu', $id_menu);
                foreach ($reviews as $review) {
                    $review->delete();
                }
                foreach ($pictures as $picture) {
                    $picture->delete();
                }
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
                $reviews = Review::all()->where('id_object', $items->id)->where('id_menu', $id_menu);
                $pictures = Picture::all()->where('id_object', $items->id)->where('id_menu', $id_menu);
                foreach ($reviews as $review) {
                    $review->delete();
                }
                foreach ($pictures as $picture) {
                    $picture->delete();
                }
                $items->delete();
                return redirect('showMenu/data/' . $id_category . '/' . $id_menu);
                break;
            case 12:
                $items = Health::find($id);
                $reviews = Review::all()->where('id_object', $items->id)->where('id_menu', $id_menu);
                $pictures = Picture::all()->where('id_object', $items->id)->where('id_menu', $id_menu);
                foreach ($reviews as $review) {
                    $review->delete();
                }
                foreach ($pictures as $picture) {
                    $picture->delete();
                }
                $items->delete();
                return redirect('showMenu/data/' . $id_category . '/' . $id_menu);
                break;
            case 13:
                $items = Event::find($id);
                $reviews = Review::all()->where('id_object', $items->id)->where('id_menu', $id_menu);
                $pictures = Picture::all()->where('id_object', $items->id)->where('id_menu', $id_menu);
                foreach ($reviews as $review) {
                    $review->delete();
                }
                foreach ($pictures as $picture) {
                    $picture->delete();
                }
                $items->delete();
                return redirect('showMenu/data/' . $id_category . '/' . $id_menu);
                break;
            case 14:
                $items = Visitor::find($id);
                $items->delete();
                return redirect('showMenu/data/' . $id_category . '/' . $id_menu);
                break;
            case 15:
                $items = Booking::find($id);
                $items->delete();
                return redirect('showMenu/data/' . $id_category . '/' . $id_menu);
                break;
            case 16:
                $items = Review::find($id);
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
                $reviews = Review::all()->where('id_object', $items->id)->where('id_menu', $id_menu);
                $pictures = Picture::all()->where('id_object', $items->id)->where('id_menu', $id_menu);
                foreach ($reviews as $review) {
                    $review->delete();
                }
                foreach ($pictures as $picture) {
                    $picture->delete();
                }
                $items->delete();
                return redirect('showMenu/' . $id_menu);
                break;
            case 2:
                $items = Hotel::find($id);
                $reviews = Review::all()->where('id_object', $items->id)->where('id_menu', $id_menu);
                $pictures = Picture::all()->where('id_object', $items->id)->where('id_menu', $id_menu);
                foreach ($reviews as $review) {
                    $review->delete();
                }
                foreach ($pictures as $picture) {
                    $picture->delete();
                }
                $items->delete();
                return redirect('showMenu/' . $id_menu);
                break;
            case 3:
                $items = Culinary::find($id);
                $reviews = Review::all()->where('id_object', $items->id)->where('id_menu', $id_menu);
                $pictures = Picture::all()->where('id_object', $items->id)->where('id_menu', $id_menu);
                foreach ($reviews as $review) {
                    $review->delete();
                }
                foreach ($pictures as $picture) {
                    $picture->delete();
                }
                $items->delete();
                return redirect('showMenu/' . $id_menu);
                break;
            case 4:
                $items = Shopping::find($id);
                $reviews = Review::all()->where('id_object', $items->id)->where('id_menu', $id_menu);
                $pictures = Picture::all()->where('id_object', $items->id)->where('id_menu', $id_menu);
                foreach ($reviews as $review) {
                    $review->delete();
                }
                foreach ($pictures as $picture) {
                    $picture->delete();
                }
                $items->delete();
                return redirect('showMenu/' . $id_menu);
                break;
            case 5:
                $items = Praying::find($id);
                $reviews = Review::all()->where('id_object', $items->id)->where('id_menu', $id_menu);
                $pictures = Picture::all()->where('id_object', $items->id)->where('id_menu', $id_menu);
                foreach ($reviews as $review) {
                    $review->delete();
                }
                foreach ($pictures as $picture) {
                    $picture->delete();
                }
                $items->delete();
                return redirect('showMenu/' . $id_menu);
                break;
            case 6:
                $items = Transportation::find($id);
                $reviews = Review::all()->where('id_object', $items->id)->where('id_menu', $id_menu);
                $pictures = Picture::all()->where('id_object', $items->id)->where('id_menu', $id_menu);
                foreach ($reviews as $review) {
                    $review->delete();
                }
                foreach ($pictures as $picture) {
                    $picture->delete();
                }
                $items->delete();
                return redirect('showMenu/' . $id_menu);
                break;
            case 7:
                $items = PublicService::find($id);
                $reviews = Review::all()->where('id_object', $items->id)->where('id_menu', $id_menu);
                $pictures = Picture::all()->where('id_object', $items->id)->where('id_menu', $id_menu);
                foreach ($reviews as $review) {
                    $review->delete();
                }
                foreach ($pictures as $picture) {
                    $picture->delete();
                }
                $items->delete();
                return redirect('showMenu/' . $id_menu);
                break;
            case 8:
                $items = Finance::find($id);
                $reviews = Review::all()->where('id_object', $items->id)->where('id_menu', $id_menu);
                $pictures = Picture::all()->where('id_object', $items->id)->where('id_menu', $id_menu);
                foreach ($reviews as $review) {
                    $review->delete();
                }
                foreach ($pictures as $picture) {
                    $picture->delete();
                }
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
                $reviews = Review::all()->where('id_object', $items->id)->where('id_menu', $id_menu);
                $pictures = Picture::all()->where('id_object', $items->id)->where('id_menu', $id_menu);
                foreach ($reviews as $review) {
                    $review->delete();
                }
                foreach ($pictures as $picture) {
                    $picture->delete();
                }
                $items->delete();
                return redirect('showMenu/' . $id_menu);
                break;
            case 12:
                $items = Health::find($id);
                $reviews = Review::all()->where('id_object', $items->id)->where('id_menu', $id_menu);
                $pictures = Picture::all()->where('id_object', $items->id)->where('id_menu', $id_menu);
                foreach ($reviews as $review) {
                    $review->delete();
                }
                foreach ($pictures as $picture) {
                    $picture->delete();
                }
                $items->delete();
                return redirect('showMenu/' . $id_menu);
                break;
            case 13:
                $items = Event::find($id);
                $reviews = Review::all()->where('id_object', $items->id)->where('id_menu', $id_menu);
                $pictures = Picture::all()->where('id_object', $items->id)->where('id_menu', $id_menu);
                foreach ($reviews as $review) {
                    $review->delete();
                }
                foreach ($pictures as $picture) {
                    $picture->delete();
                }
                $items->delete();
                return redirect('showMenu/' . $id_menu);
                break;
            case 14:
                $items = Visitor::find($id);
                $items->delete();
                return redirect('showMenu/' . $id_menu);
                break;
            case 15:
                $items = Booking::find($id);
                $items->delete();
                return redirect('showMenu/' . $id_menu);
                break;
            case 16:
                $items = Review::find($id);
                $items->delete();
                return redirect()->back();
                break;
        }
    }

    public function deleteRecord($id)
    {
        switch ($id) {

            case 1:

                $items = Tourism::all()->where('id_menu', $id);
                foreach ($items as $item) {
                    $reviews = Review::all()->where('id_object', $item->id)->where('id_menu', $item->id_menu);
                    $pictures = Picture::all()->where('id_object', $item->id)->where('id_menu', $item->id_menu);
                    foreach ($reviews as $review) {
                        $review->delete();
                    }
                    foreach ($pictures as $picture) {
                        $picture->delete();
                    }
                    $item->delete();
                }
                return redirect()->back();
                break;
            case 2:
                $items = Hotel::all()->where('id_menu', $id);
                foreach ($items as $item) {
                    $reviews = Review::all()->where('id_object', $item->id)->where('id_menu', $item->id_menu);
                    $pictures = Picture::all()->where('id_object', $item->id)->where('id_menu', $item->id_menu);
                    foreach ($reviews as $review) {
                        $review->delete();
                    }
                    foreach ($pictures as $picture) {
                        $picture->delete();
                    }
                    $item->delete();
                }
                return redirect()->back();
                break;
            case 3:
                $items = Culinary::all()->where('id_menu', $id);
                foreach ($items as $item) {
                    $reviews = Review::all()->where('id_object', $item->id)->where('id_menu', $item->id_menu);
                    $pictures = Picture::all()->where('id_object', $item->id)->where('id_menu', $item->id_menu);
                    foreach ($reviews as $review) {
                        $review->delete();
                    }
                    foreach ($pictures as $picture) {
                        $picture->delete();
                    }
                    $item->delete();
                }
                return redirect()->back();
                break;
            case 4:
                $items = Shopping::all()->where('id_menu', $id);
                foreach ($items as $item) {
                    $reviews = Review::all()->where('id_object', $item->id)->where('id_menu', $item->id_menu);
                    $pictures = Picture::all()->where('id_object', $item->id)->where('id_menu', $item->id_menu);
                    foreach ($reviews as $review) {
                        $review->delete();
                    }
                    foreach ($pictures as $picture) {
                        $picture->delete();
                    }
                    $item->delete();
                }
                return redirect()->back();
                break;
            case 5:
                $items = Praying::all()->where('id_menu', $id);
                foreach ($items as $item) {
                    $reviews = Review::all()->where('id_object', $item->id)->where('id_menu', $item->id_menu);
                    $pictures = Picture::all()->where('id_object', $item->id)->where('id_menu', $item->id_menu);
                    foreach ($reviews as $review) {
                        $review->delete();
                    }
                    foreach ($pictures as $picture) {
                        $picture->delete();
                    }
                    $item->delete();
                }
                return redirect()->back();
                break;
            case 6:
                $items = Transportation::all()->where('id_menu', $id);
                foreach ($items as $item) {
                    $reviews = Review::all()->where('id_object', $item->id)->where('id_menu', $item->id_menu);
                    $pictures = Picture::all()->where('id_object', $item->id)->where('id_menu', $item->id_menu);
                    foreach ($reviews as $review) {
                        $review->delete();
                    }
                    foreach ($pictures as $picture) {
                        $picture->delete();
                    }
                    $item->delete();
                }
                return redirect()->back();
                break;
            case 7:
                $items = PublicService::all()->where('id_menu', $id);
                foreach ($items as $item) {
                    $reviews = Review::all()->where('id_object', $item->id)->where('id_menu', $item->id_menu);
                    $pictures = Picture::all()->where('id_object', $item->id)->where('id_menu', $item->id_menu);
                    foreach ($reviews as $review) {
                        $review->delete();
                    }
                    foreach ($pictures as $picture) {
                        $picture->delete();
                    }
                    $item->delete();
                }
                return redirect()->back();
                break;
            case 8:
                $items = Finance::all()->where('id_menu', $id);
                foreach ($items as $item) {
                    $reviews = Review::all()->where('id_object', $item->id)->where('id_menu', $item->id_menu);
                    $pictures = Picture::all()->where('id_object', $item->id)->where('id_menu', $item->id_menu);
                    foreach ($reviews as $review) {
                        $review->delete();
                    }
                    foreach ($pictures as $picture) {
                        $picture->delete();
                    }
                    $item->delete();
                }
                return redirect()->back();
                break;
            case 9:
                $items = Asset::all()->where('id_menu', $id);
                foreach ($items as $item) {
                    $reviews = Review::all()->where('id_object', $item->id)->where('id_menu', $item->id_menu);
                    $pictures = Picture::all()->where('id_object', $item->id)->where('id_menu', $item->id_menu);
                    foreach ($reviews as $review) {
                        $review->delete();
                    }
                    foreach ($pictures as $picture) {
                        $picture->delete();
                    }
                    $item->delete();
                }
                return redirect()->back();
                break;
            case 10:
                $items = Culture::all()->where('id_menu', $id);
                foreach ($items as $item) {
                    $reviews = Review::all()->where('id_object', $item->id)->where('id_menu', $item->id_menu);
                    $pictures = Picture::all()->where('id_object', $item->id)->where('id_menu', $item->id_menu);
                    foreach ($reviews as $review) {
                        $review->delete();
                    }
                    foreach ($pictures as $picture) {
                        $picture->delete();
                    }
                    $item->delete();
                }
                return redirect('showMenu/' . $id);
                break;
            case 11:
                $items = Leisure::all()->where('id_menu', $id);
                foreach ($items as $item) {
                    $reviews = Review::all()->where('id_object', $item->id)->where('id_menu', $item->id_menu);
                    $pictures = Picture::all()->where('id_object', $item->id)->where('id_menu', $item->id_menu);
                    foreach ($reviews as $review) {
                        $review->delete();
                    }
                    foreach ($pictures as $picture) {
                        $picture->delete();
                    }
                    $item->delete();
                }
                return redirect()->back();
                break;
            case 12:
                $items = Health::all()->where('id_menu', $id);
                foreach ($items as $item) {
                    $reviews = Review::all()->where('id_object', $item->id)->where('id_menu', $item->id_menu);
                    $pictures = Picture::all()->where('id_object', $item->id)->where('id_menu', $item->id_menu);
                    foreach ($reviews as $review) {
                        $review->delete();
                    }
                    foreach ($pictures as $picture) {
                        $picture->delete();
                    }
                    $item->delete();
                }
                return redirect()->back();
                break;
            case 13:
                $items = Event::all()->where('id_menu', $id);
                foreach ($items as $item) {
                    $reviews = Review::all()->where('id_object', $item->id)->where('id_menu', $item->id_menu);
                    $pictures = Picture::all()->where('id_object', $item->id)->where('id_menu', $item->id_menu);
                    foreach ($reviews as $review) {
                        $review->delete();
                    }
                    foreach ($pictures as $picture) {
                        $picture->delete();
                    }
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
            case 15:
                $items = Booking::all()->where('id_menu', $id);
                foreach ($items as $item) {
                    $item->delete();
                }
                return redirect()->back();
                break;
            case 16:
                $items = Review::all()->where('id_menu', $id);
                foreach ($items as $item) {
                    $item->delete();
                }
                return redirect()->back();
                break;
        }
    }

    public function hapusKategori($id, $id_menu)
    {
        switch ($id) {
            case 1:
                $lokasi = Category::find($id);
                $object = Tourism::all()->where('id_category', $id);
                foreach ($object as $a) {
                    $reviews = Review::all()->where('id_object', $a->id)->where('id_menu', $id_menu);
                    $pictures = Picture::all()->where('id_object', $a->id)->where('id_menu', $id_menu);
                    foreach ($reviews as $review) {
                        $review->delete();
                    }
                    foreach ($pictures as $picture) {
                        $picture->delete();
                    }
                    $a->delete();
                }
                $lokasi->delete();
                return redirect('showMenu/' . $id_menu);
                break;
            case 2:
                $lokasi = Category::find($id);
                $object = Hotel::all()->where('id_category', $id);
                foreach ($object as $a) {
                    $reviews = Review::all()->where('id_object', $a->id)->where('id_menu', $id_menu);
                    $pictures = Picture::all()->where('id_object', $a->id)->where('id_menu', $id_menu);
                    foreach ($reviews as $review) {
                        $review->delete();
                    }
                    foreach ($pictures as $picture) {
                        $picture->delete();
                    }
                    $a->delete();
                }
                $lokasi->delete();
                return redirect('showMenu/' . $id_menu);
                break;
            case 3:
                $lokasi = Category::find($id);
                $object = Culinary::all()->where('id_category', $id);
                foreach ($object as $a) {
                    $reviews = Review::all()->where('id_object', $a->id)->where('id_menu', $id_menu);
                    $pictures = Picture::all()->where('id_object', $a->id)->where('id_menu', $id_menu);
                    foreach ($reviews as $review) {
                        $review->delete();
                    }
                    foreach ($pictures as $picture) {
                        $picture->delete();
                    }
                    $a->delete();
                }
                $lokasi->delete();
                return redirect('showMenu/' . $id_menu);
                break;
            case 4:
                $lokasi = Category::find($id);
                $object = Shopping::all()->where('id_category', $id);
                foreach ($object as $a) {
                    $reviews = Review::all()->where('id_object', $a->id)->where('id_menu', $id_menu);
                    $pictures = Picture::all()->where('id_object', $a->id)->where('id_menu', $id_menu);
                    foreach ($reviews as $review) {
                        $review->delete();
                    }
                    foreach ($pictures as $picture) {
                        $picture->delete();
                    }
                    $a->delete();
                }
                $lokasi->delete();
                return redirect('showMenu/' . $id_menu);
                break;
            case 5:
                $lokasi = Category::find($id);
                $object = Praying::all()->where('id_category', $id);
                foreach ($object as $a) {
                    $reviews = Review::all()->where('id_object', $a->id)->where('id_menu', $id_menu);
                    $pictures = Picture::all()->where('id_object', $a->id)->where('id_menu', $id_menu);
                    foreach ($reviews as $review) {
                        $review->delete();
                    }
                    foreach ($pictures as $picture) {
                        $picture->delete();
                    }
                    $a->delete();
                }
                $lokasi->delete();
                return redirect('showMenu/' . $id_menu);
                break;
            case 6:
                $lokasi = Category::find($id);
                $object = Transportation::all()->where('id_category', $id);
                foreach ($object as $a) {
                    $reviews = Review::all()->where('id_object', $a->id)->where('id_menu', $id_menu);
                    $pictures = Picture::all()->where('id_object', $a->id)->where('id_menu', $id_menu);
                    foreach ($reviews as $review) {
                        $review->delete();
                    }
                    foreach ($pictures as $picture) {
                        $picture->delete();
                    }
                    $a->delete();
                }
                $lokasi->delete();
                return redirect('showMenu/' . $id_menu);
                break;
            case 7:
                $lokasi = Category::find($id);
                $object = PublicService::all()->where('id_category', $id);
                foreach ($object as $a) {
                    $reviews = Review::all()->where('id_object', $a->id)->where('id_menu', $id_menu);
                    $pictures = Picture::all()->where('id_object', $a->id)->where('id_menu', $id_menu);
                    foreach ($reviews as $review) {
                        $review->delete();
                    }
                    foreach ($pictures as $picture) {
                        $picture->delete();
                    }
                    $a->delete();
                }
                $lokasi->delete();
                return redirect('showMenu/' . $id_menu);
                break;
            case 8:
                $lokasi = Category::find($id);
                $object = Finance::all()->where('id_category', $id);
                foreach ($object as $a) {
                    $reviews = Review::all()->where('id_object', $a->id)->where('id_menu', $id_menu);
                    $pictures = Picture::all()->where('id_object', $a->id)->where('id_menu', $id_menu);
                    foreach ($reviews as $review) {
                        $review->delete();
                    }
                    foreach ($pictures as $picture) {
                        $picture->delete();
                    }
                    $a->delete();
                }
                $lokasi->delete();
                return redirect('showMenu/' . $id_menu);
                break;
            case 9:
                $lokasi = Category::find($id);
                $object = Asset::all()->where('id_category', $id);
                foreach ($object as $a) {
                    $reviews = Review::all()->where('id_object', $a->id)->where('id_menu', $id_menu);
                    $pictures = Picture::all()->where('id_object', $a->id)->where('id_menu', $id_menu);
                    foreach ($reviews as $review) {
                        $review->delete();
                    }
                    foreach ($pictures as $picture) {
                        $picture->delete();
                    }
                    $a->delete();
                }
                $lokasi->delete();
                return redirect('showMenu/' . $id_menu);
                break;
            case 10:
                $lokasi = Category::find($id);
                $object = Culture::all()->where('id_category', $id);
                foreach ($object as $a) {
                    $reviews = Review::all()->where('id_object', $a->id)->where('id_menu', $id_menu);
                    $pictures = Picture::all()->where('id_object', $a->id)->where('id_menu', $id_menu);
                    foreach ($reviews as $review) {
                        $review->delete();
                    }
                    foreach ($pictures as $picture) {
                        $picture->delete();
                    }
                    $a->delete();
                }
                $lokasi->delete();
                return redirect('showMenu/' . $id_menu);
                break;
            case 11:
                $lokasi = Category::find($id);
                $object = Leisure::all()->where('id_category', $id);
                foreach ($object as $a) {
                    $reviews = Review::all()->where('id_object', $a->id)->where('id_menu', $id_menu);
                    $pictures = Picture::all()->where('id_object', $a->id)->where('id_menu', $id_menu);
                    foreach ($reviews as $review) {
                        $review->delete();
                    }
                    foreach ($pictures as $picture) {
                        $picture->delete();
                    }
                    $a->delete();
                }
                $lokasi->delete();
                return redirect('showMenu/' . $id_menu);
                break;
            case 12:
                $lokasi = Category::find($id);
                $object = Health::all()->where('id_category', $id);
                foreach ($object as $a) {
                    $reviews = Review::all()->where('id_object', $a->id)->where('id_menu', $id_menu);
                    $pictures = Picture::all()->where('id_object', $a->id)->where('id_menu', $id_menu);
                    foreach ($reviews as $review) {
                        $review->delete();
                    }
                    foreach ($pictures as $picture) {
                        $picture->delete();
                    }
                    $a->delete();
                }
                $lokasi->delete();
                return redirect('showMenu/' . $id_menu);
                break;
            case 13:
                $lokasi = Category::find($id);
                $object = Event::all()->where('id_category', $id);
                foreach ($object as $a) {
                    $reviews = Review::all()->where('id_object', $a->id)->where('id_menu', $id_menu);
                    $pictures = Picture::all()->where('id_object', $a->id)->where('id_menu', $id_menu);
                    foreach ($reviews as $review) {
                        $review->delete();
                    }
                    foreach ($pictures as $picture) {
                        $picture->delete();
                    }
                    $a->delete();
                }
                $lokasi->delete();
                return redirect('showMenu/' . $id_menu);
                break;
        }
    }

    public function importExcel(Request $request, $id_menu)
    {

        switch ($id_menu) {
            case 1:
                if (Input::hasFile('file')) {
                    $path = Input::file('file')->getRealPath();
                    $data = Excel::load($path, function ($reader) {
                    })->get();
                    if (!empty($data) && $data->count()) {
                        foreach ($data as $key => $value) {
                            if ($value->id_category == null) {
                                continue;
                            }
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
                                'id_menu' => $id_menu
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
                            if ($value->id_category == null) {
                                continue;
                            }
                            $insert[] = [
                                'name' => $value->name,
                                'address' => $value->address,
                                'phone' => $value->phone,
                                'description' => $value->description,
                                'price' => $value->price,
                                'open' => $value->open,
                                'close' => $value->close,
                                'id_category' => $value->id_category,
                                'id_menu' => $id_menu
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
                            if ($value->id_category == null) {
                                continue;
                            }
                            $insert[] = [
                                'name' => $value->name,
                                'address' => $value->address,
                                'phone' => $value->phone,
                                'description' => $value->description,
                                'price' => $value->price,
                                'open' => $value->open,
                                'close' => $value->close,
                                'id_category' => $value->id_category,
                                'id_menu' => $id_menu
                            ];
                        }
                        if (!empty($insert)) {
                            DB::table('culinaries')->insert($insert);
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
                            if ($value->id_category == null) {
                                continue;
                            }
                            $insert[] = [
                                'name' => $value->name,
                                'address' => $value->address,
                                'phone' => $value->phone,
                                'description' => $value->description,
                                'open' => $value->open,
                                'close' => $value->close,
                                'id_category' => $value->id_category,
                                'id_menu' => $id_menu
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
                            if ($value->id_category == null) {
                                continue;
                            }
                            $insert[] = [
                                'name' => $value->name,
                                'address' => $value->address,
                                'description' => $value->description,
                                'id_category' => $value->id_category,
                                'id_menu' => $id_menu
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
                            if ($value->id_category == null) {
                                continue;
                            }
                            $insert[] = [
                                'name' => $value->name,
                                'address' => $value->address,
                                'phone' => $value->phone,
                                'description' => $value->description,
                                'price' => $value->price,
                                'departure' => $value->departure,
                                'arriving' => $value->arriving,
                                'id_category' => $value->id_category,
                                'id_menu' => $id_menu
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
                            if ($value->id_category == null) {
                                continue;
                            }
                            $insert[] = [
                                'name' => $value->name,
                                'address' => $value->address,
                                'phone' => $value->phone,
                                'description' => $value->description,
                                'open' => $value->open,
                                'close' => $value->close,
                                'id_category' => $value->id_category,
                                'id_menu' => $id_menu
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
                            if ($value->id_category == null) {
                                continue;
                            }
                            $insert[] = [
                                'name' => $value->name,
                                'address' => $value->address,
                                'phone' => $value->phone,
                                'description' => $value->description,
                                'open' => $value->open,
                                'close' => $value->close,
                                'id_category' => $value->id_category,
                                'id_menu' => $id_menu
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
//                    dd($data);
                    if (!empty($data) && $data->count()) {
                        foreach ($data as $key => $value) {
                            if ($value->name == null) {
                                continue;
                            }
                            $insert[] = [
                                'name' => $value->name,
                                'address' => $value->address,
                                'phone' => $value->phone,
                                'manager' => $value->manager,
                                'capacity' => $value->capacity,
                                'description' => $value->description,
                                'id_menu' => $id_menu
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
                            if ($value->name == null) {
                                continue;
                            }
                            $insert[] = [
                                'name' => $value->name,
                                'address' => $value->address,
                                'phone' => $value->phone,
                                'manager' => $value->manager,
                                'description' => $value->description,
                                'id_menu' => $id_menu
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
                            if ($value->id_category == null) {
                                continue;
                            }
                            $insert[] = [
                                'name' => $value->name,
                                'address' => $value->address,
                                'phone' => $value->phone,
                                'description' => $value->description,
                                'price' => $value->price,
                                'open' => $value->open,
                                'close' => $value->close,
                                'id_category' => $value->id_category,
                                'id_menu' => $id_menu
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
                            if ($value->id_category == null) {
                                continue;
                            }
                            $insert[] = [
                                'name' => $value->name,
                                'address' => $value->address,
                                'phone' => $value->phone,
                                'description' => $value->description,
                                'open' => $value->open,
                                'close' => $value->close,
                                'id_category' => $value->id_category,
                                'id_menu' => $id_menu
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
                            if ($value->id_category == null) {
                                continue;
                            }
                            $insert[] = [
                                'name' => $value->name,
                                'description' => $value->description,
                                'time' => $value->time,
                                'id_menu' => $id_menu
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
//                        $coordinator = new Coordinator();
//                        $coordinator->user_id = $request->id_user;
//                        $coordinator->id_menu = $id_menu;
//                        $coordinator->phone = $request->phone;
//                        $coordinator->visitor_number = $request->visitor_number;
                        $result = Coordinator::create([
                            "user_id" => $request->user_id,
                            "id_menu" => $id_menu,
                            "phone" => $request->phone,
                            "visitor_number" => $request->visitor_number

                        ]);
                        if ($result != null) {
                            foreach ($data as $key => $value) {
//                                dd($data);
                                if ($value->name == null) {
                                    continue;
                                }
                                $insert[] = [
                                    'name' => $value->name,
                                    'age' => $value->age,
                                    'origin' => $value->origin,
                                    'coordinator_id' => $result->id,
                                    'id_menu' => $id_menu
                                ];
                            }
                            if (!empty($insert)) {
                                DB::table('visitors')->insert($insert);
                                alert()->success('Data Pengunjung Berhasil Di Import', 'Berhasil');
                                return redirect()->back();
                            }
                        }
                    }
                }
                break;
        }


    }

    public function multipleUpload($id, $id_menu)
    {
        //getting all of post data
        $files = Input::file('images');
        //making counting of uploaded images
        $file_count = count($files);
        //start how many uploaded
        $uploadCount = 0;
        if ($file_count != 0) {
            foreach ($files as $file) {
                $rules = array('file' => 'required|image|mimes:jpeg,png,jpg|max:2048');
//                dd($file);
                $validator = Validator::make(array('file' => $file), $rules);
                if ($validator->passes()) {
                    $destinationPath = 'image';
                    $filename = $file->getClientOriginalName();
                    $upload_success = $file->move($destinationPath, $filename);

                    //save to database
                    $extension = $file->getClientOriginalExtension();
                    $entry = new Picture();
                    $entry->mime = $file->getClientMimeType();
                    $entry->original_filename = $filename;
                    $entry->filename = $file->getFilename() . '.' . $extension;
                    $entry->id_object = $id;
                    $entry->id_menu = $id_menu;
                    if ($entry->save()) {
                        $uploadCount++;
                    }
                } else {
                    Alert::error('Format gambar salah', 'Data Gagal Diubah');
                    return false;
                }
            }

            if ($uploadCount == $file_count) {
                Session::flash('success', 'Upload success');
                return redirect('/');
            } else {
                return redirect('/')->withInput()->withErrors($validator);
            }
        }
    }

    public function deleteImage($id_image)
    {
        $items = Picture::all()->where('id', $id_image);
//        dd($items);
        foreach ($items as $item) {
            $item->delete();
        }
        return redirect()->back();
    }

    public function updateBooking(Request $request, $id_category, $id)
    {
        dd($id);
        $lokasi = Booking::find($id);
        dd($lokasi);
        $lokasi->booking_status_id = $request->booking_status_id;
        $lokasi->save();
        Alert::success('Data Berhasil Diubah');
        return redirect('showMenu/' . $request->id_menu);
    }

    public function viewNo($id, $id_menu)
    {
        $menus = Menu::all();
        switch ($id_menu) {
            case 1:
                $items = Tourism::find($id);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object', $id);
                return view('tourism/view', ['item' => $items, 'menu' => $menu, 'pictures' => $gambar, 'menus' => $menus]);
                break;
            case 2:
                $items = Hotel::find($id);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object', $id);
                return view('hotel/view', ['item' => $items, 'menu' => $menu, 'pictures' => $gambar, 'menus' => $menus]);
                break;
            case 3:
                $items = Culinary::find($id);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object', $id);
                return view('culinary/view', ['item' => $items, 'menu' => $menu, 'pictures' => $gambar, 'menus' => $menus]);
                break;
            case 4:
                $items = Shopping::find($id);

                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object', $id);
                return view('shopping/view', ['item' => $items, 'menu' => $menu, 'pictures' => $gambar, 'menus' => $menus]);
                break;
            case 5:
                $items = Praying::find($id);

                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object', $id);
                return view('praying/view', ['item' => $items, 'menu' => $menu, 'pictures' => $gambar, 'menus' => $menus]);
                break;
            case 6:
                $items = Transportation::find($id);

                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object', $id);
                return view('transportation/view', ['item' => $items, 'menu' => $menu, 'pictures' => $gambar, 'menus' => $menus]);
                break;
            case 7:
                $items = PublicService::find($id);

                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object', $id);
                return view('public_service/view', ['item' => $items, 'menu' => $menu, 'pictures' => $gambar, 'menus' => $menus]);
                break;
            case 8:
                $items = Finance::find($id);

                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object', $id);
                return view('finance/view', ['item' => $items, 'menu' => $menu, 'pictures' => $gambar, 'menus' => $menus]);
                break;
            case 9:
                $items = Asset::find($id);

                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object', $id);
                return view('asset/view', ['item' => $items, 'menu' => $menu, 'pictures' => $gambar, 'menus' => $menus]);
                break;
            case 10:
                $items = Culture::find($id);

                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object', $id);
                return view('culture/view', ['item' => $items, 'menu' => $menu, 'pictures' => $gambar, 'menus' => $menus]);
                break;
            case 11:
                $items = Leisure::find($id);

                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object', $id);
                return view('leisure/view', ['item' => $items, 'menu' => $menu, 'pictures' => $gambar, 'menus' => $menus]);
                break;
            case 12:
                $items = Health::find($id);

                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object', $id);
                return view('health/view', ['item' => $items, 'menu' => $menu, 'pictures' => $gambar, 'menus' => $menus]);
                break;
            case 13:
                $items = Event::find($id);

                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object', $id);
                return view('event/view', ['item' => $items, 'menu' => $menu, 'pictures' => $gambar, 'menus' => $menus]);
                break;
            case 14:
                $items = Visitor::find($id);

                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object', $id);
                return view('visitor/view', ['item' => $items, 'menu' => $menu, 'pictures' => $gambar, 'menus' => $menus]);
                break;
            case 15:
                $items = Booking::find($id);

                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object', $id);
                return view('booking/view', ['item' => $items, 'menu' => $menu, 'pictures' => $gambar, 'menus' => $menus]);
                break;
            case 16:
                $items = Review::find($id);
                $menu = Menu::find($id_menu);
                $gambar = Picture::all()->where('id_menu', $id_menu)->where('id_object', $id);
                return view('review/view', ['item' => $items, 'menu' => $menu, 'pictures' => $gambar, 'menus' => $menus]);
                break;
        }

    }

    public function insertNo($id_menu)
    {
        $menus = Menu::all();
        switch ($id_menu) {

            case 1:
                $menu = Menu::find($id_menu);
                return view('tourism/insert', ['menu' => $menu, 'menus' => $menus]);
                break;
            case 2:
                $menu = Menu::find($id_menu);
                return view('hotel/insert', ['menu' => $menu, 'menus' => $menus]);
                break;
            case 3:
                $menu = Menu::find($id_menu);
                return view('culinary/insert', ['menu' => $menu, 'menus' => $menus]);
                break;
            case 4:
                $menu = Menu::find($id_menu);
                return view('shopping/insert', ['menu' => $menu, 'menus' => $menus]);
                break;
            case 5:
                $menu = Menu::find($id_menu);
                return view('praying/insert', ['menu' => $menu, 'menus' => $menus]);
                break;
            case 6:

                $menu = Menu::find($id_menu);
                return view('transportation/insert', ['menu' => $menu, 'menus' => $menus]);
                break;
            case 7:

                $menu = Menu::find($id_menu);
                return view('public_service/insert', ['menu' => $menu, 'menus' => $menus]);
                break;
            case 8:
                $menu = Menu::find($id_menu);
                return view('finance/insert', ['menu' => $menu, 'menus' => $menus]);
                break;
            case 9:

                $menu = Menu::find($id_menu);
                return view('asset/insert', ['menu' => $menu, 'menus' => $menus]);
                break;
            case 10:

                $menu = Menu::find($id_menu);
                return view('culture/insert', ['menu' => $menu, 'menus' => $menus]);
                break;
            case 11:

                $menu = Menu::find($id_menu);
                return view('leisure/insert', ['menu' => $menu, 'menus' => $menus]);
                break;
            case 12:

                $menu = Menu::find($id_menu);
                return view('health/insert', ['menu' => $menu, 'menus' => $menus]);
                break;
            case 13:

                $menu = Menu::find($id_menu);
                return view('event/insert', ['menu' => $menu, 'menus' => $menus]);
                break;
            case 14:

                $menu = Menu::find($id_menu);
                return view('visitor/insert', ['menu' => $menu, 'menus' => $menus]);
                break;
            case 15:
                $menu = Menu::find($id_menu);
                $identity = IdentityType::all();
                $assets = Asset::all();
                $cultures = Culture::all();
                return view('booking/insert', [
                    'menu' => $menu,
                    'menus' => $menus,
                    'identities' => $identity,
                    'cultures' => $cultures,
                    'assets' => $assets]);
                break;
            case 16:
                $menu = Menu::find($id_menu);
                return view('review/insert', ['menu' => $menu, 'menus' => $menus]);
                break;
        }

    }

    public function invoice(Request $request)
    {
        $booking = Booking::find($request->id);
        $currentUser = Auth::user();
        return view('booking/invoice', ['data' => $booking, 'user' => $currentUser]);
    }

    public function editProfile()
    {
        $data = User::find(Auth::user()->id);
//        dd($data);
        $menus = Menu::all();
        return view('user.edit', ['data' => $data, 'menus' => $menus]);
    }

    public function updateProfile(Request $request)
    {
        $id = $request->id;
        $profile = User::find($id);

        if ($request->old_password != null) {
            if (Hash::check($request->old_password, $profile->password)) {
                $profile->name = $request->name;
                $profile->email = $request->email;
                $profile->password = bcrypt($request->new_password);
                $profile->save();
                Alert::success('Data Berhasil Diubah');
                return redirect('home');
            } else {
                Alert::error('Password tidak cocok', 'Data Gagal Diubah');
                return redirect()->back();
            }
        } else {
            $profile->name = $request->name;
            $profile->email = $request->email;
            $profile->save();
            Alert::success('Data Berhasil Diubah');
            return redirect('home');
        }

    }

    public function assetList(Request $request){
        $time = $request->waktu;
        $date = $request->date;
        $assets = Asset::all();
        $data = array();
        foreach ($assets as $asset) {
            if ($time == 3) {
                $isExist = Booking::where('id_object', $asset->id)
                    ->where('bookings.id_time', 1)
                    ->where('bookings.date', $date)
                    ->where('bookings.booking_status_id', 1)
                    ->orWhere('bookings.booking_status_id', 2)
                    ->where('bookings.id_time', 2)
                    ->first();
            } else {
                $isExist = Booking::where('id_object', $asset->id)
                    ->where('bookings.id_time', $time)
                    ->where('bookings.date', $date)
                    ->where('bookings.booking_status_id', 1)
                    ->orWhere('bookings.booking_status_id', 2)
                    ->where('bookings.id_time', 3)
                    ->first();
            }
            if (sizeof($isExist) == 0) {
                $data[] = $asset;
            }
        }
        return response()->json($data);
    }
}
