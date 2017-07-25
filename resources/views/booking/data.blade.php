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
                                        {{--{{ dd($data->asset) }}--}}
                                        <tr>
                                            <td></td>
                                            <td>
                                                @php
                                                    $tanggal = strtotime($data->date);
                                                    echo date('d F Y', $tanggal);
                                                @endphp
                                            </td>
                                            <td>{{$data->name}}</td>
                                            <td class="center">{{$data->asset->name}}</td>
                                            <td class="center">{{$data->time->time}}</td>
                                            <td style="text-align: center;">

                                                @if($data->booking_status_id==1)
                                                    <button class="btn btn-warning" class="btn btn-primary"
                                                            data-toggle="modal"
                                                            data-target="#favoritesModal{{$data->id}}">
                                                        {{$data->bookingStatus->status}}
                                                    </button>
                                                    {{--<a  href="{{$data->id}}/{{$data->id_menu}}/invoice"></a>--}}
                                                    <form action="{{URL::to($data->id.'/invoice')}}/" method="post">
                                                        <input type="hidden" value="{{csrf_token()}}" name="_token"/>
                                                        <button class="btn btn-default">
                                                            <i class="fa fa-print"></i>
                                                        </button>
                                                    </form>

                                                @elseif($data->bookingStatus->id==2)
                                                    <button class="btn btn-success" class="btn btn-primary"
                                                            data-toggle="modal"
                                                            data-target="#favoritesModal{{$data->id}}">
                                                        {{$data->bookingStatus->status}}
                                                    </button>
                                                    <form action="{{URL::to($data->id.'/invoice')}}/" method="post">
                                                        <input type="hidden" value="{{csrf_token()}}" name="_token"/>
                                                        <button class="btn btn-default">
                                                            <i class="fa fa-print"></i>
                                                        </button>
                                                    </form>
                                                @else
                                                    <button class="btn btn-danger"
                                                            class="btn btn-primary" data-toggle="modal"
                                                            data-target="#favoritesModal{{$data->id}}">
                                                        {{$data->bookingStatus->status}}
                                                    </button>
                                                    <form action="{{URL::to($data->id.'/invoice')}}/" method="post">
                                                        <input type="hidden" value="{{csrf_token()}}" name="_token"/>
                                                        <button class="btn btn-default">
                                                            <i class="fa fa-print"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                                {{--MODAL--}}
                                                <div class="modal fade" id="favoritesModal{{$data->id}}" tabindex="-1"
                                                     role="dialog" aria-labelledby="favoritesModalLabel">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <form role="form" method="post"
                                                                  action="{{$data->id}}/{{$data->id_menu}}/update">
                                                                <input type="hidden" name="_method" value="PUT">
                                                                <input type="hidden" name="id" value="{{$data->id}}">
                                                                {{csrf_field()}}
                                                                <div class="modal-header">
                                                                    <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span></button>
                                                                    <h4 class="modal-title" id="favoritesModalLabel">
                                                                        Ubah Status</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="form-group">
                                                                        <label>Nama Pemesan </label>
                                                                        {{$data->name}}
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Fasilitas </label>
                                                                        {{$data->asset->name}}
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Untuk Tanggal </label>
                                                                        {{$data->date}}
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Pilih Status</label>
                                                                        <select name="booking_status_id">
                                                                            @foreach($statuses as $status)
                                                                                <option value="{{$status->id}}">{{$status->status}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-default"
                                                                            data-dismiss="modal"
                                                                            style="margin-right: 10px;">
                                                                        Batal
                                                                    </button>
                                                                    <input type="submit" class="btn btn-primary"
                                                                           value="Simpan">
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
                                    @elseif($data->id_category==30)
                                        <tr>
                                            <td></td>
                                            <td>@php
                                                    $tanggalbooking = strtotime($data->date);
                                                    echo date('d F Y', $tanggalbooking);
                                                @endphp</td>
                                            <td>{{$data->name}}</td>
                                            <td class="center">{{$data->culture->name}}</td>
                                            <td class="center">@php
                                                    $untuk = strtotime($data->time->time);
                                                    echo date('d F Y', $untuk);
                                                @endphp</td>
                                            <td style="text-align: center;">

                                                @if($data->bookingStatus->id==1)
                                                    <button class="btn btn-warning" class="btn btn-primary"
                                                            data-toggle="modal"
                                                            data-target="#favoritesModal{{$data->id}}">
                                                        {{$data->bookingStatus->status}}
                                                    </button>
                                                    <form action="{{URL::to($data->id.'/invoice')}}/" method="post">
                                                        <input type="hidden" value="{{csrf_token()}}" name="_token"/>
                                                        <button class="btn btn-default">
                                                            <i class="fa fa-print"></i>
                                                        </button>
                                                    </form>
                                                @elseif($data->bookingStatus->id==2)
                                                    <button class="btn btn-success" class="btn btn-primary"
                                                            data-toggle="modal"
                                                            data-target="#favoritesModal{{$data->id}}">
                                                        {{$data->bookingStatus->status}}
                                                    </button>
                                                    <form action="{{URL::to($data->id.'/invoice')}}/" method="post">
                                                        <input type="hidden" value="{{csrf_token()}}" name="_token"/>
                                                        <button class="btn btn-default">
                                                            <i class="fa fa-print"></i>
                                                        </button>
                                                    </form>
                                                @else
                                                    <button class="btn btn-danger"
                                                            class="btn btn-primary" data-toggle="modal"
                                                            data-target="#favoritesModal{{$data->id}}">
                                                        {{$data->bookingStatus->status}}
                                                    </button>
                                                    <form action="{{URL::to($data->id.'/invoice')}}/" method="post">
                                                        <input type="hidden" value="{{csrf_token()}}" name="_token"/>
                                                        <button class="btn btn-default">
                                                            <i class="fa fa-print"></i>
                                                        </button>
                                                    </form>
                                                @endif

                                                {{--MODAL--}}
                                                <div class="modal fade"
                                                     id="favoritesModal{{$data->id}}" tabindex="-1"
                                                     role="dialog"
                                                     aria-labelledby="favoritesModalLabel">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <form role="form" method="post"
                                                                  action="{{$data->id}}/{{$data->id_menu}}/update">
                                                                <input type="hidden" name="_method"
                                                                       value="PUT">
                                                                <input type="hidden" name="id"
                                                                       value="{{$data->id}}">
                                                                {{csrf_field()}}
                                                                <div class="modal-header">
                                                                    <button type="button"
                                                                            class="close"
                                                                            data-dismiss="modal"
                                                                            aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                    <h4 class="modal-title"
                                                                        id="favoritesModalLabel">
                                                                        Ubah Status</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="form-group">
                                                                        <label>Nama Pemesan </label>
                                                                        {{$data->name}}
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Fasilitas </label>
                                                                        {{$data->culture->name}}
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Untuk
                                                                            Tanggal </label>
                                                                        @php
                                                                            $startTime = strtotime($data->date);
                                                                            echo date('d F Y', $startTime);
                                                                        @endphp
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Pilih Status</label>
                                                                        <select name="booking_status_id">
                                                                            @foreach($statuses as $status)
                                                                                {{--<option value="{{$status->id}}">{{$status->status}}</option>--}}
                                                                                @if($status->id!=$data->booking_status_id)
                                                                                    <option value="{{$status->id}}">{{$status->status}}</option>
                                                                                @else
                                                                                    <option value="{{$status->id}}"
                                                                                            selected>{{$status->status}}</option>
                                                                                @endif
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button"
                                                                            class="btn btn-default"
                                                                            data-dismiss="modal"
                                                                            style="margin-right: 10px;">
                                                                        Batal
                                                                    </button>
                                                                    <input type="submit"
                                                                           class="btn btn-primary"
                                                                           value="Simpan">
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