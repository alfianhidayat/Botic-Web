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
                    <h1 class="page-header">{{$menu->menu}}</h1>
                </div>
                <div class="col-md-2">
                    {{--<button type="button" class="btn btn-danger" onclick="hapus()">--}}
                    {{--<i class="fa fa-trash"></i> Hapus Menu Ini--}}
                    {{--</button>--}}
                </div>
            </div>
            <div class="row" style="margin-bottom:3%">
                <div class="col-md-12 text-center">
                    {{--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#favoritesModal">--}}
                    {{--<i class="fa fa-plus-square"></i> Tambah Kategori {{$menu->menu}}--}}
                    {{--</button>--}}
                    {{--<a href="{{$menu->id}}/deleteAll/" id="del"></a>--}}
                    {{--<button class="btn btn-social btn-danger" onclick="hapus()">--}}
                    {{--<i class="fa fa-trash"></i> Hapus Data {{$menu->menu}}--}}
                    {{--</button>--}}
                </div>
            </div>
        </div>
        <div class="row col-md-offset-2">

            @foreach($datas as $data)
                <div class="col-lg-3">
                    <div class="panel panel-primary">
                        <a href="data/{{$data->id}}/{{$data->id_menu}}" class="panel-primary">
                            <div class="panel-heading text-center">

                                <div class="huge"><i class="fa fa-star"></i> {{$data->category}}</div>
                            </div>
                            <div class="panel-body text-center">
                                Selengkapnya >
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="row col-md-offset-2">
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Data Semua {{$menu->menu}}
                        </div>
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover"
                                   id="dataTables-example">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>{{$menu->menu}}</th>
                                    <th>Umur</th>
                                    <th>Asal</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($items as $item)
                                    <tr>
                                        <td></td>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->age}}</td>
                                        <td class="center">{{$item->origin}}</td>
                                        <td style="text-align: center;">
                                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                                        data-target="#favoritesModal{{$item->id}}">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                            {{--MODAL--}}
                                            <div class="modal fade" id="favoritesModal{{$item->id}}" tabindex="-1"
                                                 role="dialog" aria-labelledby="favoritesModalLabel">
                                                <div class="modal-dialog text-left" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                <span aria-hidden="true">&times;</span></button>
                                                            <h4 class="modal-title" id="favoritesModalLabel">
                                                                Detail {{$menu->menu}}</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label>{{$menu->menu}} : </label>
                                                                {{$item->name}}
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Umur : </label>
                                                                {{$item->age}}
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Asal : </label>
                                                                {{$item->origin}}
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Penanggung Jawab: </label>
                                                                {{$item->coordinator->user->name}}
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default"
                                                                    data-dismiss="modal"
                                                                    style="margin-right: 10px;">
                                                                Close
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{--END MODAL--}}
                                        </td>
                                    </tr>
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
            <form style="border: 4px solid #a1a1a1;margin-top: 15px;padding: 10px;" action="{{$menu->id}}/importExcel"
                  class="form-horizontal" method="post" enctype="multipart/form-data">
                <input type="file" name="file"/>
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <button class="btn btn-primary">Import File</button>
            </form>
        </div>

    </div>

    <!-- /#page-wrapper -->
    {{--MODAL--}}
    <div class="modal fade" id="favoritesModal" tabindex="-1" role="dialog" aria-labelledby="favoritesModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form role="form" method="post" action="/inputCategory">
                    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                    <input type="hidden" name="id_menu" value="{{$menu->id}}"/>
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="favoritesModalLabel">Tambah {{$menu->menu}}</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nama Kategori</label>
                            <input type="text" name="category" class="form-control" placeholder="Nama Kategori"
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
