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
                    <h1 class="page-header">Edit User</h1>
                </div>
                <div class="col-md-2">
                    {{--<a class="btn btn-primary page-header" href="{{ URL::to('showMenu/'.$item->id_menu)}}">--}}
                    {{--<i class="fa fa-eye"></i> Semua {{$menu->menu}}--}}
                    {{--</a>--}}
                </div>
            </div>
            <div class="row center-block ">
                <div class="col-lg-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Form Edit User
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form role="form" method="post" action="{{URL::to('updateProfile')}}">
                                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                            {{--<label for="name" class="col-md-4 control-label">Name</label>--}}
                                            <label for="name" class="control-label">Nama</label>

                                            <input id="name" type="text" class="form-control" name="name"
                                                   placeholder="Nama" value="{{$data->name}}" required/>

                                            @if ($errors->has('name'))
                                                <span class="help-block">
                                             <strong>{{ $errors->first('name') }}</strong>
                                         </span>
                                            @endif
                                            {{--</div>--}}
                                        </div>

                                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                                            <label for="email" class=" control-label">Email</label>


                                            <input id="email" type="email" class="form-control" name="email"
                                                   placeholder="Email"
                                                   value="{{$data->email}}" required/>

                                            @if ($errors->has('email'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                            @endif

                                        </div>
                                        <hr/>
                                        <div class="form-group text-center" style="color: red">Kosongkan formulir
                                            dibawah apabila <b>tidak ingin </b>mengubah password anda
                                        </div>
                                        <div class="form-group">
                                            <label for="password" class="control-label">Password Lama</label>
                                            <input id="password" type="password" class="form-control"
                                                   name="old_password"
                                                   placeholder="Password Lama"/>
                                        </div>

                                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                            <label>Password Baru </label>
                                            <input id="password" type="password" class="form-control"
                                                   name="new_password"
                                                   placeholder="Password Baru"/>
                                            @if ($errors->has('password'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label>Konfirmasi Password Baru</label>
                                            <input id="password" type="password" class="form-control"
                                                   name="confirm_new_password"
                                                   placeholder="Konfirmasi Password Baru"/>

                                        </div>

                                        <input type="hidden" name="id" value="{{$data->id}}"/>
                                        {{csrf_field()}}
                                        <input type="submit" class="btn btn-primary col-lg-offset-8"
                                               value="Simpan Perubahan"/>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
                @if(empty($picture))
                @else
                 document.getElementById('del' + id).click();
                @endif
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
