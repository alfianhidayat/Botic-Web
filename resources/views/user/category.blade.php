@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="col-md-offset-2">
            <div class="row">
                <div class="col-md-2 text-left">
                    <a class="btn btn-default" href="{{ URL::to('menu')}}">
                        <i class="fa fa-home"></i> Menu Awal
                    </a>
                </div>
                <div class="col-md-8 text-center">
                    @if(Auth::user()->id_role ==3)
                        <h1 class="page-header">Data Admin</h1>
                    @elseif(Auth::user()->id_role ==2)
                        <h1 class="page-header">Data User</h1>
                    @endif
                </div>
                <div class="col-md-2">
                    {{--<button type="button" class="btn btn-success" data-toggle="modal" data-target="#favoritesModal">--}}
                    {{--<i class="fa fa-arrow-circle-up"></i> Export Data User--}}
                    {{--</button>--}}
                    {{--<form action="export" method="post">--}}
                    {{--<input type="hidden" value="{{csrf_token()}}" name="_token"/>--}}
                    {{--<input type="hidden" value="{{$menu->id}}" name="id"/>--}}
                    {{--<button class="btn btn-success">--}}
                    {{--<i class="fa fa-arrow-circle-up"></i> Export {{$menu->menu}}--}}
                    {{--</button>--}}
                    {{--</form>--}}
                </div>
            </div>
            <div class="row" style="margin-bottom:3%">
                <div class="col-md-12 text-center">

                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#favoritesModal">
                        @if(Auth::user()->id_role ==3)
                            <i class="fa fa-plus-circle"></i> Tambah Admin
                        @elseif(Auth::user()->id_role ==2)
                            <i class="fa fa-plus-circle"></i> Tambah User
                        @endif
                        {{--<i class="fa fa-plus-circle"></i> Tambah Admin--}}
                    </button>
                    {{--<a href="{{$menu->id}}/deleteAll/" id="del"></a>--}}
                    {{--<button class="btn btn-social btn-danger" onclick="hapus()">--}}
                    {{--<i class="fa fa-trash"></i> Hapus Data {{$menu->menu}}--}}
                    {{--</button>--}}
                </div>
            </div>
        </div>
        {{--<div class="row col-md-offset-2">--}}

        {{--@foreach($datas as $data)--}}
        {{--<div class="col-lg-3">--}}
        {{--<div class="panel panel-primary">--}}
        {{--<a href="data/{{$data->id}}/{{$data->id_menu}}" class="panel-primary">--}}
        {{--<div class="panel-heading text-center">--}}

        {{--<div class="huge"><i class="fa fa-star"></i> {{$data->category}}</div>--}}
        {{--</div>--}}
        {{--<div class="panel-body text-center">--}}
        {{--Selengkapnya >--}}
        {{--</div>--}}
        {{--</a>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--@endforeach--}}
        {{--</div>--}}

        <div class="row col-md-offset-2">
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            @if(Auth::user()->id_role ==3)
                                Data Semua Admin
                            @elseif(Auth::user()->id_role ==2)
                                Data Semua User
                            @endif
                        </div>
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover"
                                   id="dataTables-example">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $item)
                                    {{--                                    {{dd($item->userrole)}}--}}
                                    @if(Auth::user()->id_role ==3)

                                        @if ($item->userrole->id != 3)
                                            <tr>
                                                <td></td>
                                                <td>{{$item->name}}</td>
                                                <td>{{$item->email}}</td>
                                                <td class="center">{{$item->userrole->role}}</td>
                                                <td style="text-align: center;">
                                                    <form action="{{URL::to('deleteAdmin')}}" method="post"
                                                          id="del{{$item->id}}">
                                                        <input type="hidden" value="{{csrf_token()}}" name="_token"/>
                                                        <input type="hidden" value="delete" name="_method"/>
                                                        <input type="hidden" value="{{$item->id}}" name="id"/>
                                                    </form>
                                                    <button class="btn btn-social btn-danger"
                                                            onclick="hapus({{$item->id}})">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endif

                                    @elseif(Auth::user()->id_role ==2)
                                        @if ($item->userrole->id ==1)
                                            <tr>
                                                <td></td>
                                                <td>{{$item->name}}</td>
                                                <td>{{$item->email}}</td>
                                                <td class="center">{{$item->userrole->role}}</td>
                                                <td style="text-align: center;">
                                                    <form action="{{URL::to('deleteAdmin')}}" method="post"
                                                          id="del{{$item->id}}">
                                                        <input type="hidden" value="{{csrf_token()}}" name="_token"/>
                                                        <input type="hidden" value="delete" name="_method"/>
                                                        <input type="hidden" value="{{$item->id}}" name="id"/>
                                                    </form>
                                                    <button class="btn btn-social btn-danger"
                                                            onclick="hapus({{$item->id}})">
                                                        <i class="fa fa-trash"></i>
                                                    </button>

                                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                                            data-target="#favoritesModal{{$item->id}}">
                                                        <i class="fa fa-user"></i>
                                                    </button>
                                                    {{--MODAL--}}
                                                    <div class="modal fade" id="favoritesModal{{$item->id}}"
                                                         tabindex="-1"
                                                         role="dialog" aria-labelledby="favoritesModalLabel">
                                                        <div class="modal-dialog text-left" role="document">
                                                            <div class="modal-content">
                                                                {{--<div class="modal-header">--}}
                                                                {{--<button type="button" class="close"--}}
                                                                {{--data-dismiss="modal"--}}
                                                                {{--aria-label="Close">--}}
                                                                {{--<span aria-hidden="true">&times;</span></button>--}}
                                                                {{--<h4 class="modal-title" id="favoritesModalLabel">--}}
                                                                {{--Import Pengunjung</h4>--}}
                                                                {{--</div>--}}
                                                                {{--<div class="modal-body">--}}
                                                                {{--<form action="showMenu/14/importExcel" class="form-horizontal" method="post" enctype="multipart/form-data" role="form">--}}
                                                                {{--style="border: 4px solid #a1a1a1;margin-top: 15px;padding: 10px;"--}}
                                                                {{--<div class="form-group">--}}
                                                                {{--<label>Nama Koordinator : </label>--}}
                                                                {{--<input type="hidden" name="id_user" class="form-control" value="{{$item->name}}"/>--}}
                                                                {{--<input type="text" name="name" class="form-control" value="{{$item->name}}" readonly/>--}}
                                                                {{--</div>--}}
                                                                {{--<div class="form-group">--}}
                                                                {{--<label>Telepon : </label>--}}
                                                                {{--<input type="tel" name="phone" class="form-control"/>--}}
                                                                {{--</div>--}}
                                                                {{--<div class="form-group">--}}
                                                                {{--<input type="file" name="file"/>--}}
                                                                {{--</div>--}}
                                                                {{--<input type="hidden" name="_token"--}}
                                                                {{--value="{{csrf_token()}}">--}}
                                                                {{--<button class="btn btn-primary">Import File--}}
                                                                {{--</button>--}}
                                                                {{--</form>--}}
                                                                {{--</div>--}}
                                                                {{--<div class="modal-footer">--}}
                                                                {{--<button type="button" class="btn btn-default"--}}
                                                                {{--data-dismiss="modal"--}}
                                                                {{--style="margin-right: 10px;">--}}
                                                                {{--Close--}}
                                                                {{--</button>--}}
                                                                {{--</div>--}}
                                                                <form role="form" method="post"
                                                                      action="showMenu/14/importExcel" enctype="multipart/form-data" >
                                                                    <input type="hidden" name="_token"
                                                                           value="{{csrf_token()}}"/>
                                                                    <input type="hidden" name="user_id"
                                                                           value="{{$item->id}}"/>
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close"
                                                                                data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                        <h4 class="modal-title"
                                                                            id="favoritesModalLabel">Import
                                                                            Pengunjung</h4>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="form-group">
                                                                            <label>Nama Koordinator : </label>
                                                                            <input type="hidden" name="id_user"
                                                                                   class="form-control"
                                                                                   value="{{$item->id}}"/>
                                                                            <input type="text" name="name"
                                                                                   class="form-control"
                                                                                   value="{{$item->name}}" readonly/>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Telepon : </label>
                                                                            <input type="tel" name="phone" placeholder="Isi Nomor Telepon"
                                                                                   class="form-control" required/>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Jumlah Wisatawan : </label>
                                                                            <input type="number" name="visitor_number" placeholder="Isi Jumlah Wisatawan"
                                                                                   class="form-control" required/>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Import Excel: </label>
                                                                            <input type="file" name="file"/>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-default"
                                                                                data-dismiss="modal"
                                                                                style="margin-right: 10px;">
                                                                            Batal
                                                                        </button>
                                                                        <input type="submit" class="btn btn-primary"
                                                                               value="Import">
                                                                        </span>
                                                                    </div>
                                                                    {{csrf_field()}}
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{--END MODAL--}}
                                                </td>
                                            </tr>
                                        @endif
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
        </div>

    </div>

    {{--<!-- /#page-wrapper -->--}}
    {{--MODAL--}}
    <div class="modal fade" id="favoritesModal" tabindex="-1" role="dialog" aria-labelledby="favoritesModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form role="form" method="post" action="{{URL::to('postAdmin')}}">
                    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="favoritesModalLabel">Tambah User</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="control-label">Nama</label>
                            <input id="name" type="text" class="form-control" name="name" placeholder="Nama" required/>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class=" control-label">Email</label>
                            <input id="email" type="email" class="form-control" name="email" placeholder="Email"
                                   required/>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="control-label">Password</label>
                            <input id="password" type="password" class="form-control" name="password"
                                   placeholder="Password" required/>
                            @if ($errors->has('password'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="password-confirm" class="control-label">Konfirmasi Password</label>
                            <input id="password-confirm" type="password" class="form-control" name="password"
                                   placeholder="Konfirmasi Password" required/>
                            <input type="hidden" class="form-control" name="id_role" value="2">
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
    <script>
        function hapus(id) {
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
                swal(
                    'Berhasil!',
                    'Data telah dihapus',
                    'success'
                )
                document.getElementById('del' + id).submit();
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

        $(document).ready(function () {
            var t = $('#dataTables-example').DataTable({
                "columnDefs": [{
                    "searchable": false,
                    "orderable": false,
                    "targets": 0
                }],
                "order": [[1, 'asc']]
            });

            t.on('order.dt search.dt', function () {
                t.column(0, {search: 'applied', order: 'applied'}).nodes().each(function (cell, i) {
                    cell.innerHTML = i + 1;
                });
            }).draw();
        });
    </script>
@endsection
