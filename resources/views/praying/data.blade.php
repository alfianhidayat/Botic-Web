@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row col-md-offset-2">
            <div class="row ">
                <div class="col-md-2" style="text-align:left;">
                    <a class="btn btn-default" href="{{ URL::to('showMenu/'.$categories->id_menu)}}">
                        <i class="fa fa-arrow-left"></i> Kategori {{$back->menu}}
                    </a>
                </div>
                <div class="col-md-8" style="text-align:center;">
                    <h1 class="page-header">Data {{$categories->category}}</h1>
                </div>
                <div class="col-md-2">
                    {{--href="{{$categories->id_menu}}/delete"--}}
                    <a href="{{$categories->id_menu}}/delete" id="delKat"></a>
                    <button type="button" class="btn btn-danger" onclick="hapusKategori()">
                        <i class="fa fa-trash"></i> Hapus Kategori Ini
                    </button>
                </div>
            </div>

            <div class="row page-header">
                <div class="col-md-12" style="text-align:center;">
                    <a class="btn btn-success page-header" href="{{$categories->id_menu}}/insert/">
                        <i class="fa fa-plus-circle"></i> Tambah {{$categories->category}}
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
                            <table width="100%" class="table table-striped table-bordered table-hover display"
                                   id="dataTables-example">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>{{$categories->category}}</th>
                                    <th>Alamat</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($datas as $data)
                                <tr>
                                    <td></td>
                                    <td>{{$data->name}}</td>
                                    <td>{{$data->address}}</td>
                                    <td style="text-align: center;">
                                        <a class="btn btn-social btn-primary" href="{{$data->id}}/{{$data->id_menu}}/view">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a class="btn btn-social btn-warning" href="{{$data->id}}/{{$data->id_menu}}/edit">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        {{--<form action="{{$data->id_menu}}/delete" method="get" id="del"></form>--}}
                                        {{--<a href="{{$data->id}}/{{$data->id_menu}}/delete" id="del{{$data->id}}"></a>--}}
                                        <form action="{{$data->id}}/{{$data->id_menu}}/delete" method="post" id="del{{$data->id}}">
                                        <input type="hidden" value="{{csrf_token()}}" name="_token"/>
                                        <input type="hidden" value="delete" name="_method"/>
                                        </form>
                                        <button class="btn btn-social btn-danger" onclick="hapus({{$data->id}})">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
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
