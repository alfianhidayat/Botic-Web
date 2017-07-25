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
                    <form action="export" method="post">
                        <input type="hidden" value="{{csrf_token()}}" name="_token"/>
                        <input type="hidden" value="{{$menu->id}}" name="id"/>
                        <button class="btn btn-success">
                            <i class="fa fa-arrow-circle-up"></i> Export {{$menu->menu}}
                        </button>
                    </form>
                    {{--<a type="button" class="btn btn-success" href="{{$menu->id}}/export">--}}
                        {{--<i class="fa fa-arrow-circle-up"></i> Export {{$menu->menu}}--}}
                    {{--</a>--}}
                </div>
            </div>
            <div class="row" style="margin-bottom:3%">
                <div class="col-md-12 text-center">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#favoritesModal">
                        <i class="fa fa-plus-square"></i> Tambah Kategori {{$menu->menu}}
                    </button>
                    <a href="{{$menu->id}}/deleteAll/" id="delAll"></a>
                    <button class="btn btn-social btn-danger" onclick="deleteAll()">
                        <i class="fa fa-trash"></i> Hapus Data {{$menu->menu}}
                    </button>
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
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>{{$menu->menu}}</th>
                                    <th>Alamat</th>
                                    <th>Telepon</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($items as $item)
                                    <tr>
                                        <td></td>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->address}}</td>
                                        <td class="center">{{$item->phone}}</td>
                                        <td style="text-align: center;">
                                            <a class="btn btn-social btn-primary" href="{{$item->id}}/{{$item->id_category}}/{{$item->id_menu}}/view">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <a class="btn btn-social btn-warning" href="{{$item->id}}/{{$item->id_menu}}/edit">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                            {{--<a href="{{$item->id}}/{{$item->id_menu}}/delete" id="del{{$item->id}}"></a>--}}
                                            <form action="{{$item->id}}/{{$item->id_menu}}/delete" method="post" id="del{{$item->id}}">
                                                <input type="hidden" value="{{csrf_token()}}" name="_token"/>
                                                <input type="hidden" value="delete" name="_method"/>
                                            </form>
                                            <button class="btn btn-social btn-danger" onclick="hapus({{$item->id}})">
                                                <i class="fa fa-trash"></i>
                                            </button>
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
            <form style="border: 4px solid #a1a1a1;margin-top: 15px;padding: 10px;" action="{{$menu->id}}/importExcel" class="form-horizontal" method="post" enctype="multipart/form-data">
                <input type="file" name="file" />
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

        function deleteAll() {
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
                document.getElementById('delAll').click();
            }, function (dismiss) {
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
                    "pagingType": "full_numbers",
                    "targets": 0
                }],
                "order": [[1, 'asc']],
                responsive: true
            });

            t.on('order.dt search.dt', function () {
                t.column(0, {search: 'applied', order: 'applied'}).nodes().each(function (cell, i) {
                    cell.innerHTML = i + 1;
                });
            }).draw();

        });
    </script>
@endsection

