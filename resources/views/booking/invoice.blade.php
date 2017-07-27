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
{{--<a href="{{URL::to('showMenu/data/'.$data->id_category.'/'.$data->id_menu)}}">Kembali</a>--}}
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

            <table border="0" cellpadding="3" style=" padding-left: 30px;">
                <tr>
                    <td>No</td>
                    <td>:</td>
                    <td>{{$data->id}}</td>
                </tr>
                <tr>
                    <td>Perihal</td>
                    <td>:</td>
                    <td>Bukti Booking Gedung</td>
                </tr>
                <tr><td height="5px"></td></tr>
                <tr>
                    <td colspan="3">Berikut merupakan tanda bukti pemesanan aset Dinas Kebudayaan dan Pariwisata sebagai
                        berikut:
                    </td>
                </tr>
            </table>

            <table border="0" cellpadding="3" style=" padding-left: 30px;">
                <tr>
                    <td style="padding-left: 20pt">Nama</td>
                    <td>:</td>
                    <td>{{$data->name}}</td>
                </tr>
                <tr>
                    {{--<td>&nbsp;</td>--}}
                    <td style="padding-left: 20pt">No. Identitas</td>
                    <td>:</td>
                    <td>{{$data->identity_number}}</td>
                    <td> / </td>
                    <td> {{$data->identityType->type}}</td>
                </tr>
                <tr>
                    <td style="padding-left: 20pt">No. HP</td>
                    <td>:</td>
                    <td>{{$data->phone}}</td>
                </tr>
                <tr>
                    <td style="padding-left: 20pt">Aset</td>
                    <td>:</td>
                    @if($data->id_category==29)
                        <td>{{$data->asset->name}}</td>
                    @else
                        <td>{{$data->culture->name}}</td>
                    @endif
                </tr>
                {{--<tr>--}}
                    {{--<td style="padding-left: 20pt">Status</td>--}}
                    {{--<td>:</td>--}}
                    {{--<td>{{$data->bookingStatus->status}}</td>--}}
                {{--</tr>--}}

                <tr>
                    <td style="padding-left: 20pt">Tanggal Sewa</td>
                    <td>:</td>
                    <td>@php
                            $startTime = strtotime($data->date);
                            echo date('d F Y', $startTime);
                        @endphp</td>
                </tr>
                <tr>
                    <td style="padding-left: 20pt">Waktu Sewa</td>
                    <td>:</td>
                    <td>{{$data->time->time}}</td>
                </tr>
                <tr>
                    <td style="padding-left: 20pt">Deskripsi Kegiatan</td>
                    <td>:</td>
                    <td>{{$data->description}}</td>
                </tr>

            </table>

            <table border="0" cellpadding="3" style=" padding-left: 30px;">
                <tr align="center">
                    <td style="font-size: 24px; font-weight: bold; border-bottom: 1pt solid;" colspan="3">&nbsp;</td>
                </tr>
                <tr>
                    <td style="font-size: 18px; font-weight: bold;" width="70px">Status :</td>
                    <td style="font-size: 24px; font-weight: bold; color: #2799b2; text-align: center;">{{$data->bookingStatus->status}}</td>
                </tr>
                <tr >
                    <td style="font-size: 24px; font-weight: bold; border-top: 1pt solid;" colspan="3">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="3">Demikian surat tanda bukti pemesanan ini dibuat dan dapat dijadikan sebagai surat tanda bukti <b><i>pemesanan aset yang SAH</i></b>
                </tr>
            </table>

            <br/>

            <table border="0" align="right" style="text-align: center; ">

                <tr>
                    <td>Bojonegoro, {{\Carbon\Carbon::now()->format('d F Y')}}</td>
                </tr>
                <tr>
                    <td>Kepala UPTD Gedung dan Museum</td>
                </tr>
                <tr>
                    <td>Dinas Kebudayaan dan Pariwisata</td>
                </tr>
                <tr>
                    <td>Kabupaten Bojonegoro</td>
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
                    <td><b><u>MUDIONO</u></b></td>
                </tr>
                <tr>
                    <td>NIP. 19680807 198903 1 0008</td>
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