<?php

namespace App\Http\Controllers;

use App\Booking;
use App\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiUserController extends ApiBaseController
{
    /**
     * ApiUserController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['store', 'login']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        return $this->baseResponse(false, 'berhasil', $user);
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
        try {
            $data = $request->all();
            $user = new User();
            $user->name = $data["name"];
            $user->email = $data["email"];
            $user->password = bcrypt($data["password"]);
            $user->id_role = 1;
            if ($user->save()) {
                return $this->baseResponse(false, "berhasil create user", null);
            } else {
                return $this->baseResponse(true, "gagal create user", null);
            }
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                return $this->baseResponse(true, "email sudah terdaftar", null);
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

    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            $data = $request->all();
            if (User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => '',
                'id_role' => 1,
            ])
            ) {
                $user = User::where('email', $request->email)->first();
                $token = $user->createToken($request->provider)->accessToken;
                return [
                    "token_type" => 'Bearer',
                    "expires_in" => 1296000,
                    "access_token" => $token,
                    "refresh_token" => $token
                ];
            }
        }
        $token = $user->createToken($request->provider)->accessToken;
        return [
            "token_type" => 'Bearer',
            "expires_in" => 1296000,
            "access_token" => $token,
            "refresh_token" => $token
        ];
    }
}
