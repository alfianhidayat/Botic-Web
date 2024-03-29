@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row col-md-offset-2">
            <div class="row ">
                <div class="col-md-2" style="text-align:left;">
                    <a class="btn btn-default page-header" href="{{ URL::to('showMenu/'.$item->id_menu)}}">
                        <i class="fa fa-arrow-left"></i> Kembali
                    </a>
                </div>
                <div class="col-md-8" style="text-align:center;">
                    <h1 class="page-header">Edit {{$menu->menu}}</h1>
                </div>
                <div class="col-md-2">
                    <a class="btn btn-primary page-header" href="{{ URL::to('showMenu/'.$item->id_menu)}}">
                        <i class="fa fa-eye"></i> Semua {{$menu->menu}}
                    </a>
                </div>
            </div>
            <div class="row center-block ">
                <div class="col-lg-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Form Edit {{$menu->menu}}
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form role="form" method="post" action="update" enctype="multipart/form-data">
                                        <input type="hidden" name="_method" value="PUT">
                                        <input type="hidden" name="id" value="{{$item->id}}">
                                        <input type="hidden" name="id" value="{{$item->id_menu}}">
                                        <div class="form-group">
                                            <label>Nama</label>
                                            <input type="text" name="name" class="form-control"
                                                   placeholder="Nama" required value="{{$item->name}}"/>
                                        </div>
                                        <div class="form-group">
                                            <label>Deskripsi</label>
                                            <textarea name="description" class="form-control" rows="5" cols="30"
                                                      placeholder="Deskripsi" required>{{$item->description}}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Waktu Penyelenggaraan</label>
                                            <input type="text" name="time" class="form-control"
                                                   placeholder="Waktu Penyelenggaraan" required value="{{$item->time}}"/>
                                        </div>
                                        <div class="form-group">
                                            <label>Gambar</label>
                                            <div style="margin: 10px; text-align: center">

                                                @foreach($pictures as $picture)
                                                    <img src="{{asset('image/'.$picture->original_filename)}}"
                                                         width="50%">
                                                    <a href="{{URL::to('deleteImage/'.$picture->id)}}"
                                                       id="del{{$picture->id}}">
                                                    </a>
                                                    <a class="btn btn-social btn-danger"
                                                       onclick="hapus({{$picture->id}})"><i class="fa fa-trash"></i>
                                                    </a>
                                                @endforeach

                                            </div>
                                            <input type="file" name="images[]" class="form-control"
                                                   placeholder="files" multiple="true"/>
                                        </div>
                                        <input type="submit" class="btn btn-success" value="Simpan Perubahan"/>
                                        {{csrf_field()}}
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
