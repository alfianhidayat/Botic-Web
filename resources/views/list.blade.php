@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row col-md-offset-2">
            <div class="row ">
                <div class="col-md-2" style="text-align:left;">
                    <a class="btn btn-default" href="{{ redirect()->back()->getTargetUrl() }}">
                        <i class="fa fa-arrow-left"></i> Kembali
                    </a>
                </div>
                <div class="col-md-8" style="text-align:center;">
                    <h1 class="page-header">Daftar {{$tipe}}</h1>
                </div>
                <div class="col-md-2">
                    {{--<a href="{{$categories->id_menu}}/delete" id="delKat"></a>--}}
                    {{--<button type="button" class="btn btn-danger" onclick="hapusKategori()">--}}
                    {{--<i class="fa fa-trash"></i> Hapus Kategori Ini--}}
                    {{--</button>--}}
                </div>
            </div>

            <div class="row page-header">
                <div class="col-md-12" style="text-align:center;">
                    {{--<a class="btn btn-success page-header" href="{{$categories->id_menu}}/insert/">--}}
                    {{--<i class="fa fa-plus-circle"></i> Tambah {{$categories->category}}--}}
                    {{--</a>--}}
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Data {{$tipe}}
                        </div>
                        <div class="panel-body">
                            @if($tipe=="Kategori")

                                <table width="100%" class="table table-striped table-bordered table-hover display"
                                       id="dataTables-example">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kategori</th>
                                        <th>Id Kategori</th>
                                        <th>Menu</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($category as $data)
                                        <tr>
                                            <td></td>
                                            <td>{{$data->category}}</td>
                                            <td>{{$data->id}}</td>
                                            <td>{{$data->menu->menu}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @elseif($tipe=="Menu")
                                <table width="100%" class="table table-striped table-bordered table-hover display"
                                       id="dataTables-example">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Menu</th>
                                        <th>Id Menu</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($menus as $data)
                                        <tr>
                                            <td></td>
                                            <td>{{$data->menu}}</td>
                                            <td>{{$data->id}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
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
