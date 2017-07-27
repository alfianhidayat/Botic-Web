@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row col-md-offset-2">
            <div class="row ">
                <div class="col-md-2" style="text-align:left;">
                    <a class="btn btn-default page-header" href="{{ redirect()->back()->getTargetUrl() }}">
                        <i class="fa fa-arrow-left"></i> Kembali
                    </a>
                </div>
                <div class="col-md-8" style="text-align:center;">
                    <h1 class="page-header">Tambah {{$menu->menu}}</h1>
                </div>
                <div class="col-md-2">
                    <a class="btn btn-primary page-header" href="{{ URL::to('showMenu/'.$data->id_menu)}}">
                        <i class="fa fa-eye"></i> Semua {{$menu->menu}}
                    </a>
                </div>
            </div>
            <div class="row center-block ">
                <div class="col-lg-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Form Tambah {{$menu->menu}}
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form role="form" method="post" action="post" enctype="multipart/form-data">
                                        <input type="hidden" value="{{$data->id}}" name="id_category">
                                        <input type="hidden" value="{{$data->id_menu}}" name="id_menu">
                                        <div class="form-group">
                                            <label>Nama</label>
                                            <input type="text" name="name" class="form-control" placeholder="Nama" required/>
                                        </div>
                                        <div class="form-group">
                                            <label>Alamat</label>
                                            <textarea name="address" class="form-control" rows="2" placeholder="Alamat" required></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Telepon</label>
                                            <input type="tel" name="phone" class="form-control" placeholder="Telepon"
                                                   required/>
                                        </div>
                                        <div class="form-group">
                                            <label>Deskripsi</label>
                                            <textarea name="description" class="form-control" rows="5" cols="30"
                                                      placeholder="Deskripsi" required></textarea>
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label>Latitude</label>
                                            <input type="text" name="lat" class="form-control" placeholder="Latitude"/>
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label>Longitude</label>
                                            <input type="text" name="lng" class="form-control" placeholder="Longitude"/>
                                        </div>
                                        <div class="form-group">
                                            <label>Gambar</label>
                                            <input type="file" name="images[]" class="form-control"
                                                   placeholder="files" multiple="true"/>
                                        </div>
                                        <input type="submit" class="btn btn-success" value="Tambah"/>
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            $(".gllpLatlonPicker").each(function () {
                $obj = $(document).gMapsLatLonPicker();

                $obj.params.strings.markerText = "Drag this Marker (example edit)";

                $obj.params.displayError = function (message) {
                    console.log("MAPS ERROR: " + message); // instead of alert()
                };

                $obj.init($(this));
            });
        });
    </script>
    <script src="{{asset('js/jquery-gmaps-latlon-picker.js')}}"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAkDSAlkb23u606YO23TezU84YDzYXEat8"></script>
    <script>
        $.gMapsLatLonPickerNoAutoInit = 1;
    </script>
    <script src="{{asset('js/jquery-gmaps-latlon-picker.js')}}"></script>

@endsection
