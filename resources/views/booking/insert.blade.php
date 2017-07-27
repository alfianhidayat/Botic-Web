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
                    <h1 class="page-header">Tambah {{$menu->menu}} </h1>
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
                                    <form role="form" method="post" action="post">
                                        <div class="form-group">
                                            <label>Nama Pemesan</label>
                                            <input type="text" name="name" class="form-control"
                                                   placeholder="Nama" required/>
                                            <input type="hidden" value="{{$data->id}}" name="id_category">
                                            <input type="hidden" value="{{$data->id_menu}}" name="id_menu">
                                        </div>
                                        <div class="form-group">
                                            <label>Tipe Identitas</label>
                                            <select name="identity_type_id">
                                                @foreach($identities as $identity)
                                                    <option value="{{$identity->id}}">{{$identity->type}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Nomor Identitas</label>
                                            <input type="text" name="identity_number" class="form-control"
                                                   placeholder="Nomor Identitas" required max="20"/>
                                        </div>
                                        <div class="form-group">
                                            <label>Telepon</label>
                                            <input type="tel" name="phone" class="form-control" placeholder="Telepon"
                                                   required maxlength="12"/>
                                        </div>


                                        <div class="form-group">
                                            <label>Tanggal</label>
                                            <input id="dateField" type="date" min="2014-01-01" disabled name="date"
                                                   class="form-control" placeholder="Tanggal"
                                                   required/>
                                        </div>
                                        @if($data->id == 29)
                                            <div class="form-group">
                                                <label>Waktu</label>
                                                <div class="form-control-static">
                                                    <div class="col-md-2">
                                                        <input type="radio" name="id_time" value="1" id="waktu"/> Siang
                                                    </div>
                                                    <div class="col-md-2">
                                                        <input type="radio" name="id_time" value="2" id="waktu"/> Malam
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input type="radio" name="id_time" value="3" id="waktu"/> Siang
                                                        -
                                                        Malam
                                                    </div>
                                                </div>
                                            </div>
                                        @elseif($data->id == 30)
                                            <div class="form-group">
                                                <label>Waktu</label>
                                                <input type="radio" name="id_time" value="3" id="waktu"/> Siang - Malam
                                            </div>
                                        @endif

                                        <div class="form-group">
                                            <label>Pilih {{$data->category}}</label>
                                            @if($data->id == 29)
                                                <select name="id_object" id="asset">
                                                    <option value="0" disabled="true" selected="true">--Pilih Gedung--</option>
                                                    {{--@foreach($assets as $asset)--}}
                                                        {{--<option value="{{$asset->id}}">{{$asset->name}}</option>--}}
                                                    {{--@endforeach--}}
                                                </select>
                                            @elseif($data->id == 30)
                                                <select name="id_object" id="asset">
                                                    @foreach($cultures as $culture)
                                                        <option value="{{$culture->id}}">{{$culture->name}}</option>
                                                    @endforeach
                                                </select>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label>Keterangan</label>
                                            <textarea name="description" class="form-control" rows="2"
                                                      placeholder="Keterangan"
                                                      required></textarea>
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

            var input = document.getElementById("dateField");
            var today = new Date();
            var day = today.getDate();

            // Set month to string to add leading 0
            var mon = new String(today.getMonth() + 1); //January is 0!
            var yr = today.getFullYear();

            if (mon.length < 2) {
                mon = "0" + mon;
            }

            var date = new String(yr + '-' + mon + '-' + day);

            input.disabled = false;
            input.setAttribute('min', date);

            //PILIH GEDUNG
            var date = "";
            var waktu = "";
            //onchange tanggal
            $(document).on('change', '#dateField', function () {
                date = $(this).val();
                //onchange waktu
                $(document).on('change', '#waktu', function () {
                    waktu = $(this).val();
                    var op = "";
                    $.ajax({
                        type: 'get',
                        url: '{{URL::to('assetList')}}',
                        data: {'date': date, 'waktu': waktu},
                        success: function (data) {
                            for (var i = 0; i < data.length; i++) {
                                op +='<option value="'+data[i].id+'">'+data[i].name+'</php option>';
                                console.log(date);
                                console.log(waktu);
                            }
                        $('#asset').html(op);
                        },
                        error: function () {

                        }
                    });
                });

            });

        });
    </script>

@endsection
