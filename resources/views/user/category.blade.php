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
                    <h1 class="page-header">Data Admin</h1>
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
                        <i class="fa fa-plus-circle"></i> Tambah Admin
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
                            Data Semua Admin
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
                                    @if ($item->userrole->id != 3)
                                        <tr>
                                            <td></td>
                                            <td>{{$item->name}}</td>
                                            <td>{{$item->email}}</td>
                                            <td class="center">{{$item->userrole->role}}</td>
                                            <td style="text-align: center;">
                                                <form action="{{URL::to('deleteAdmin')}}" method="post" id="del{{$item->id}}">
                                                    <input type="hidden" value="{{csrf_token()}}" name="_token"/>
                                                    <input type="hidden" value="delete" name="_method"/>
                                                    <input type="hidden" value="{{$item->id}}" name="id"/>
                                                </form>
                                                <button class="btn btn-social btn-danger" onclick="hapus({{$item->id}})">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @else
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
            {{--<form style="border: 4px solid #a1a1a1;margin-top: 15px;padding: 10px;" action="{{$menu->id}}/importExcel"--}}
            {{--class="form-horizontal" method="post" enctype="multipart/form-data">--}}
            {{--<input type="file" name="file"/>--}}
            {{--<input type="hidden" name="_token" value="{{csrf_token()}}">--}}
            {{--<button class="btn btn-primary">Import File</button>--}}
            {{--</form>--}}
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
                            {{--<label for="name" class="col-md-4 control-label">Name</label>--}}
                            <label for="name" class="control-label">Nama</label>

                            {{--<div class="col-md-6">--}}
                            {{--<input id="name" type="text" class="form-control" name="name"--}}
                            {{--value="{{ old('name') }}" required autofocus>--}}
                            <input id="name" type="text" class="form-control" name="name" placeholder="Nama" required/>
                            {{--value="{{ old('name') }}" required autofocus>
                     @if ($errors->has('name'))
                         <span class="help-block">
                             <strong>{{ $errors->first('name') }}</strong>
                         </span>
                     @endif
                 {{--</div>--}}
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            {{--<label for="email" class="col-md-4 control-label">Username</label>--}}
                            <label for="email" class=" control-label">Email</label>

                            {{--<div class="col-md-6">--}}
                            {{--<input id="email" type="text" class="form-control" name="email"--}}
                            {{--value="{{ old('email') }}" required>--}}
                            <input id="email" type="email" class="form-control" name="email" placeholder="Email"
                                   required/>

                            @if ($errors->has('email'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                            {{--</div>--}}
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            {{--<label for="password" class="col-md-4 control-label">Password</label>--}}
                            <label for="password" class="control-label">Password</label>

                            {{--<div class="col-md-6">--}}
                            {{--<input id="password" type="password" class="form-control" name="password" required>--}}
                            <input id="password" type="password" class="form-control" name="password"
                                   placeholder="Password" required/>
                            @if ($errors->has('password'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                            {{--</div>--}}
                        </div>

                        <div class="form-group">
                            {{--<label for="password-confirm" class="col-md-4 control-label">Konfirmasi Password</label>--}}
                            <label for="password-confirm" class="control-label">Konfirmasi Password</label>

                            {{--<div class="col-md-6">--}}
                            {{--<input id="password-confirm" type="password" class="form-control"--}}
                            {{--name="password_confirmation" required>--}}
                            <input id="password-confirm" type="password" class="form-control" name="password"
                                   placeholder="Konfirmasi Password" required/>
                            <input type="hidden" class="form-control" name="id_role" value="2">
                            {{--</div>--}}
                        </div>

                        {{--<div class="form-group">--}}
                        {{--<div class="col-md-6 col-md-offset-4">--}}
                        {{--<button type="submit" class="btn btn-primary">--}}
                        {{--Register--}}
                        {{--</button>--}}
                        {{--</div>--}}
                        {{--</div>--}}
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
                document.getElementById('del'+id).submit();
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
