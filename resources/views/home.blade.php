@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row col-md-offset-2">
            <div class="col-md-12">
                <div style="margin: 10px; text-align: center">
                    <img src="{{asset('image/bjnapp-logo.png')}}" width="10%">
                    <label class="huge">Bojonegoro Tourism Information Center</label>
                </div>
            </div>
            <!--Button Tambah Menu-->

            {{--<div class="col-md-4"></div>--}}
            {{--<div class="col-md-4">--}}
                {{--<button type="button" class="btn btn-success center-block" data-toggle="modal"--}}
                        {{--data-target="#favoritesModal">--}}
                    {{--<i class="fa fa-plus-circle"></i> Tambah Menu--}}
                {{--</button>--}}
            {{--</div>--}}
            {{--<div class="col-md-4"></div>--}}

        <!--End Button Tambah Menu-->
        </div>
        <br/>
        <div class="row col-md-offset-2">
            @foreach($menus as $menu)
                <div class="col-md-6 col-lg-3">
                    <div class="panel panel-primary">
                        <a href="showMenu/{{$menu->id}}" class="panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-{{$menu->icon}} fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">{{$menu->menu}}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                Selengkapnya >
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    {{--MODAL--}}
    <div class="modal fade" id="favoritesModal" tabindex="-1" role="dialog" aria-labelledby="favoritesModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form role="form" method="post" action="/inputMenu">
                    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="favoritesModalLabel">Tambah Menu</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nama Menu</label>
                            <input type="text" name="menu" class="form-control" placeholder="Nama Menu"
                                   required/>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal" style="margin-right: 10px;">
                            Batal
                        </button>
                        <input type="submit" class="btn btn-primary" value="Simpan">
                        </span>
                    </div>
                    {{csrf_field()}}
                </form>
            </div>
        </div>
    </div>
    {{--END MODAL--}}
@endsection
