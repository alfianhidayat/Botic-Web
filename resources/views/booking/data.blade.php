@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row col-md-offset-2">
            <div class="row ">
                <div class="col-md-2" style="text-align:left;">
                    <a class="btn btn-default" href="{{ URL::to('showMenu/'.$categories->id_menu)}}">
                        {{--<i class="fa fa-arrow-left"></i> Halaman Booking--}}
                        <i class="fa fa-arrow-left"></i> Halaman Booking
                    </a>
                </div>
                <div class="col-md-8" style="text-align:center;">
                    <h1 class="page-header">Data Booking {{$categories->category}}</h1>
                </div>
                <div class="col-md-2">
                    {{--href="{{$categories->id_menu}}/delete"--}}
                    {{--<a href="{{$categories->id_menu}}/delete" id="delKat"></a>--}}
                    {{--<button type="button" class="btn btn-danger" onclick="hapusKategori()">--}}
                    {{--<i class="fa fa-trash"></i> Hapus--}}
                    {{--</button>--}}
                </div>
            </div>

            <div class="row page-header">
                <div class="col-md-12" style="text-align:center;">
                    <a class="btn btn-success page-header" href="{{$categories->id_menu}}/insert/">
                    <i class="fa fa-plus-circle"></i> Tambah Booking {{$categories->category}}
                    </a>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Data Tables
                        </div>
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover"
                                   id="dataTables-example">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Tanggal</th>
                                    <th>Nama</th>
                                    <th>Fasilitas</th>
                                    <th>Waktu</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($datas as $data)
                                    @if($data->id_category==29)
                                    <tr>
                                        <td></td>
                                        <td>{{$data->date}}</td>
                                        <td>{{$data->user->name}}</td>
                                        <td class="center">{{$data->asset->name}}</td>
                                        <td class="center">{{$data->time}}</td>
                                        <td style="text-align: center;">

                                            @if($data->bookingStatus->id==1)
                                                <button class="btn btn-social btn-warning" href="home"
                                                        onclick="hapus()">
                                                    @elseif($data->bookingStatus->id==2)
                                                        <button class="btn btn-social btn-success" href="home"
                                                                onclick="hapus()">
                                                            @else
                                                                <button class="btn btn-social btn-danger" href="home"
                                                                        onclick="hapus()">
                                                                    @endif
                                                                    {{$data->bookingStatus->status}}
                                                                </button>
                                        </td>
                                    </tr>
                                    @elseif($data->id_category==30)
                                        <tr>
                                            <td></td>
                                            <td>{{$data->date}}</td>
                                            <td>{{$data->user->name}}</td>
                                            <td class="center">{{$data->culture->name}}</td>
                                            <td class="center">{{$data->time}}</td>
                                            <td style="text-align: center;">

                                                @if($data->bookingStatus->id==1)
                                                    <button class="btn btn-social btn-warning" href="home"
                                                            onclick="hapus()">
                                                        @elseif($data->bookingStatus->id==2)
                                                            <button class="btn btn-social btn-success" href="home"
                                                                    onclick="hapus()">
                                                                @else
                                                                    <button class="btn btn-social btn-danger" href="home"
                                                                            onclick="hapus()">
                                                                        @endif
                                                                        {{$data->bookingStatus->status}}
                                                                    </button>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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

        function hapusKategori() {
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
                document.getElementById('delKat').click();
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
