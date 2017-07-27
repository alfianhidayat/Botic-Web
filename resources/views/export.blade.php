<html>
<style>
    @media screen {
        div.divFooter {
            display: none;
        }

        div.divHeader {
            /*position: fixed;*/
            /*bottom: 0;*/
            display: block;
        }
    }

    @media print {
        div.divFooter {
            /*position: fixed;*/
            /*bottom: 0;*/
            display: block;
        }

        div.divHeader {
            /*position: fixed;*/
            /*bottom: 0;*/
            display: none;
        }
    }
</style>
<body>
<div class="divHeader">
    <button onclick="history.back()">Kembali</button>
</div>
<table align="center">
    <thead>
    <tr>
        <td>
            <table border="0" align="center" style="border-bottom:1.5pt solid black;">
                <tr align="center">
                    <td rowspan="5" style="padding-right: 20px;"><img src="{{asset('image/logo_disbudpar.png')}}"
                                                                      height="17%"></td>
                    <td style="font-size: 20px;">PEMERINTAH KABUPATEN BOJONEGORO</td>
                    <td rowspan="5" style="padding-left: 10px;"><img src="{{asset('image/bjnapp-logo.png')}}"
                                                                     height="4%"></td>
                </tr>
                <tr align="center">
                    <td style="font-size: 24px; font-weight: bold;">DINAS KEBUDAYAAN DAN PARIWISATA</td>
                </tr>
                <tr align="center">
                    <td style="font-size: 20px;"><i>TOURISM INFORMATION CENTER</i></td>
                </tr>
                <tr align="center">
                    <td style="font-size: 20px;">Jl. Teuku Umar No. 80 Telp. (0353) 881571</td>
                </tr>
                <tr align="center">
                    <td style="font-size: 24px; font-weight: bold;">BOJONEGORO</td>
                </tr>
            </table>
        </td>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>
            <br/>
            <br/>
            <table border="0" align="center">
                <tr>
                    <td style="font-size: 24px; font-weight: bold;">Data {{$judul->menu}}</td>
                </tr>
            </table>
            <br/>
            <br/>
            {{--            {{dd($datas)}}--}}
            @if($id == 14)
                <table border="1" align="center" cellpadding="3">
                    <th style="text-align: center;">No</th>
                    <th style="text-align: center;">Nama</th>
                    <th style="text-align: center;">Umur</th>
                    <th style="text-align: center;">Asal</th>
                    {{--{{dd($export)}}--}}
                    @php
                        $no = 1;
                    @endphp

                    @foreach($export as $data)
                        <tbody>
                        <td align="right">{{$no++}}.</td>
                        <td>{{$data->name}}</td>
                        <td>{{$data->age}}</td>
                        <td align="center">{{$data->origin}}</td>
                        </tbody>
                    @endforeach
                </table>
            @elseif($id==6)
                <table border="1" align="center" cellpadding="3">
                    <th style="text-align: center;">No</th>
                    <th style="text-align: center;">Nama</th>
                    <th style="text-align: center;">Jurusan</th>
                    <th style="text-align: center;">Jam Berangkat</th>
                    <th style="text-align: center;">Jenis</th>
                    {{--{{dd($export)}}--}}
                    @php
                        $no = 1;
                    @endphp

                    @foreach($export as $data)
                        <tbody>
                        <td align="right">{{$no++}}.</td>
                        <td>{{$data->name}}</td>
                        <td>{{$data->description}}</td>
                        <td align="center">{{date('H:i',strtotime($data->departure))}}</td>
                        <td>{{$data->category->category}}</td>
                        </tbody>
                    @endforeach
                </table>
            @elseif($id==15)
                <table border="1" align="center" cellpadding="3">
                    <th style="text-align: center;">No</th>
                    <th style="text-align: center;">Tanggal Booking</th>
                    <th style="text-align: center;">Nama Penyewa</th>
                    <th style="text-align: center;">Aset</th>
                    <th style="text-align: center;">Untuk Tanggal</th>
                    @php
                        $no = 1;
                    @endphp
                    @foreach($export as $data)
                        <tbody>
                        <td align="right">{{$no++}}.</td>
                        <td align="center">{{date('d F Y',strtotime($data->created_at))}}</td>
                        <td>{{$data->name}}</td>
                        @if($data->id_category==29)
                            <td>{{$data->asset->name}}</td>
                        @elseif($data->id_category==30)
                            <td>{{$data->culture->name}}</td>
                        @endif

                        <td align="center">{{date('d F Y',strtotime($data->date))}}</td>
                        </tbody>
                    @endforeach
                </table>
            @else
                <table border="1" align="center" cellpadding="3">
                    <th style="text-align: center;">No</th>
                    <th style="text-align: center;">Nama</th>
                    <th style="text-align: center;">Alamat</th>
                    <th style="text-align: center;">Telepon</th>
                    {{--{{dd($export)}}--}}
                    @php
                        $no = 1;
                    @endphp

                    @foreach($export as $data)
                        <tbody>
                        <td align="right">{{$no++}}.</td>
                        <td>{{$data->name}}</td>
                        <td>{{$data->address}}</td>
                        <td align="center">{{$data->phone}}</td>
                        </tbody>
                    @endforeach
                </table>
            @endif


            <br/>

            <table border="0" align="right" style="text-align: center; ">

                <tr>
                    <td>PENGELOLA</td>
                </tr>
                <tr>
                    <td><i>TOURISM INFORMATION CENTER</i></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>

                <tr>
                    <td><b><u>BUDIANTO S.Pd</u></b></td>
                </tr>
                <tr>
                    <td>Kepala Bidang Promosi DISBUDPAR</td>
                </tr>
                <tr>
                    <td>NIP. 1234</td>
                </tr>
            </table>
        </td>
    </tr>
    </tbody>
    <tfoot>
    <tr>
        <td>
            <div class="divFooter">
                <b><i>Dicetak oleh : {{$user->name}}</i></b>
                <b><i> pada {{\Carbon\Carbon::now()}}</i></b>
            </div>
        </td>
    </tr>
    </tfoot>
</table>
</body>
</html>
<script>
    window.print();
</script>