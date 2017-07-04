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
                                    <form role="form" method="post" action="update">
                                        <input type="hidden" name="_method" value="PUT">
                                        <input type="hidden" name="id" value="{{$item->id}}">
                                        <input type="hidden" name="id" value="{{$item->id_menu}}">
                                        <div class="form-group">
                                            <label>Nama</label>
                                            <input type="text" name="name" class="form-control"
                                                   placeholder="Nama" required value="{{$item->name}}"/>
                                        </div>
                                        <div class="form-group">
                                            <label>Kategori</label>
                                            <select name="id_category" class="form-control">
                                                @foreach($datas as $data)
                                                    @if($item->id_category!=$data->id)
                                                        <option value="{{$data->id}}">{{$data->category}}</option>
                                                    @else
                                                        <option value="{{$data->id}}" selected>{{$data->category}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Alamat</label>
                                            <textarea name="address" class="form-control" rows="2" placeholder="Alamat"
                                                      required>{{$item->address}}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Telepon</label>
                                            <input type="tel" name="phone" class="form-control" placeholder="Telepon"
                                                   required value="{{$item->phone}}"/>
                                        </div>
                                        <div class="form-group">
                                            <label>Deskripsi</label>
                                            <textarea name="description" class="form-control" rows="5" cols="30"
                                                      placeholder="Deskripsi" required>{{$item->description}}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Harga Terendah</label>
                                            <input type="text" name="price" class="form-control"
                                                   placeholder="Harga Terendah" required value="{{$item->price}}"/>
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label>Jam Buka</label>
                                            <input type="time" name="open" class="form-control" placeholder="Jam Buka"
                                                   required value="{{$item->open}}"/>
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label>Jam Tutup</label>
                                            <input type="time" name="close" class="form-control" placeholder="Jam Tutup"
                                                   required value="{{$item->close}}"/>
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label>Latitude</label>
                                            <input type="text" name="lat" class="form-control" placeholder="Latitude"
                                                   required value=" {{$item->lat}}"/>
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label>Longitude</label>
                                            <input type="text" name="lng" class="form-control" placeholder="Longitude"
                                                   required value=" {{$item->lng}}"/>
                                        </div>
                                        <div class="form-group">
                                            <label>Gambar 1</label>
                                            <div style="margin: 10px; text-align: center">
                                                <img src="{{asset('image/aston1.jpg')}}" width="100%">
                                            </div>
                                            <input type="file" name="gambar1" class="form-control"
                                                   placeholder="Gambar 1"/>
                                        </div>
                                        <div class="form-group">
                                            <label>Gambar 2</label>
                                            <div style="margin: 10px; text-align: center">
                                                <img src="{{asset('image/aston2.jpg')}}" width="100%">
                                            </div>
                                            <input type="file" name="gambar2" class="form-control"
                                                   placeholder="Gambar 1"/>
                                        </div>
                                        <div class="form-group">
                                            <label>Gambar 3</label>
                                            <div style="margin: 10px; text-align: center">
                                                <img src="{{asset('image/aston3.jpg')}}" width="100%">
                                            </div>
                                            <input type="file" name="gambar3" class="form-control"
                                                   placeholder="Gambar 1"/>
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
    <script>
        //        function tambah() {
        //            swal({
        //                title: 'Are you sure?',
        //                text: "You won't be able to revert this!",
        //                type: 'warning',
        //                showCancelButton: true,
        //                confirmButtonColor: '#3085d6',
        //                cancelButtonColor: '#d33',
        //                confirmButtonText: 'Yes, delete it!',
        //                cancelButtonText: 'No, cancel!',
        //                confirmButtonClass: 'btn btn-success',
        //                cancelButtonClass: 'btn btn-danger',
        //                buttonsStyling: false
        //            }).then(function () {
        //                swal(
        //                    'Deleted!',
        //                    'Your file has been deleted.',
        //                    'success'
        //                )
        //            }, function (dismiss) {
        //                // dismiss can be 'cancel', 'overlay',
        //                // 'close', and 'timer'
        //                if (dismiss === 'cancel') {
        //                    swal(
        //                        'Cancelled',
        //                        'Your imaginary file is safe :)',
        //                        'error'
        //                    )
        //                }
        //            });
        //        }
    </script>
@endsection
