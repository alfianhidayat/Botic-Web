@extends('layouts.app')

@section('content')
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <div class="container">
        <div class="row col-md-offset-2">
            <div class="row">
                <div class="col-md-2" style="text-align:right;">
                    <a class="btn btn-default page-header" href="{{ redirect()->getUrlGenerator()->previous() }}">
                        <i class="fa fa-arrow-left"></i> Kembali
                    </a>
                </div>
                <div class="col-md-8" style="text-align:center;">
                    <h1 class="page-header">{{$item->name}}</h1>
                </div>
                <div class="col-md-2">
                    <a class="btn btn-primary page-header" href="{{ URL::to('showMenu/'.$item->id_menu)}}">
                        <i class="fa fa-eye"></i> Semua {{$menu->menu}}
                    </a>
                </div>
            </div>
            <div class="row text-center" style="margin-bottom: 20px">
                <a class="btn btn-warning"
                   href="{{URL::to('showMenu/'.$item->id.'/'.$item->id_menu.'/edit')}}">
                    <i class="fa fa-pencil"></i> Edit
                </a>
                <a href="delete" id="del"></a>
                <button type="button" class="btn btn-danger" onclick="hapus()">
                    <i class="fa fa-trash"></i> Hapus
                </button>
            </div>

            <div class="row center-block ">
                <div class="col-lg-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Data {{$item->name}}
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    {{--<div class="form-group">--}}
                                    <div class="col-md-3">
                                        <label>Nama : </label>
                                    </div>
                                    <div class="col-md-9">
                                        {{$item->name}}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    {{--<div class="form-group">--}}
                                    <div class="col-md-3">
                                        <label>Alamat : </label>
                                    </div>
                                    <div class="col-md-9">
                                        {{$item->address}}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    {{--<div class="form-group">--}}
                                    <div class="col-md-3">
                                        <label>Pengelola : </label>
                                    </div>
                                    <div class="col-md-9">
                                        {{$item->manager}}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    {{--<div class="form-group">--}}
                                    <div class="col-md-3">
                                        <label>Telepon : </label>
                                    </div>
                                    <div class="col-md-9">
                                        {{$item->phone}}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    {{--<div class="form-group">--}}
                                    <div class="col-md-3">
                                        <label>Kapasitas: </label>
                                    </div>
                                    <div class="col-md-9">
                                        {{$item->capacity}}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    {{--<div class="form-group">--}}
                                    <div class="col-md-3">
                                        <label>Deskripsi: </label>
                                    </div>
                                    <div class="col-md-9">
                                        {{$item->description}}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    {{--<div class="form-group">--}}
                                    <div class="col-md-3">
                                        <label>Gambar: </label>
                                    </div>
                                    <div class="col-md-9"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                        <!-- Indicators -->
                                        <ol class="carousel-indicators">
                                            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                            <li data-target="#myCarousel" data-slide-to="1"></li>
                                            <li data-target="#myCarousel" data-slide-to="2"></li>
                                        </ol>

                                        <!-- Wrapper for slides -->
                                        <div class="carousel-inner">
                                            @php
                                                $i = 0;
                                            @endphp
                                            @foreach($pictures as $pic)
                                                @if($i++ == 0)
                                                    <div class="item active">
                                                        <img src="{{asset('image/'.$pic->original_filename)}}"
                                                             style="height:400px;">
                                                    </div>
                                                @else
                                                    <div class="item">
                                                        <img src="{{asset('image/'.$pic->original_filename)}}"
                                                             style="height:400px;">
                                                    </div>
                                                @endif
                                            @endforeach
                                            {{--@endif--}}
                                        </div>
                                        <!-- Left and right controls -->
                                        <a class="left carousel-control" href="#myCarousel"
                                           data-slide="prev">
                                            <span class="glyphicon glyphicon-chevron-left"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="right carousel-control" href="#myCarousel"
                                           data-slide="next">
                                            <span class="glyphicon glyphicon-chevron-right"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.row (nested) -->
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
    </div>
    <!-- /#page-wrapper -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script>
        function hapus() {
            swal({
                title: 'Apakah anda yakin?',
                text: "Data ini akan dihapus secara permanen",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false
            }).then(function () {
                document.getElementById('del').click();
                swal(
                    'Berhasil!',
                    'Data telah dihapus',
                    'success'
                )
            }, function (dismiss) {
                // dismiss can be 'cancel', 'overlay',
                // 'close', and 'timer'
                if (dismiss === 'cancel') {
                    swal(
                        'Batal',
                        'Data batal dihapus',
                        'error'
                    )
                }
            });
        }

    </script>
@endsection
