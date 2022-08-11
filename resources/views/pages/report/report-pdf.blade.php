<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="{{ public_path('css/util.css') }}">
    <link rel="stylesheet" href="{{ public_path('css/pdf-bootstrap.css') }}">

    <style>
        body {
            padding: 0px
        }

        .b-none {
            border: none !important
        }

        .bt-none {
            border-bottom: none !important
        }

        .h-10 {
            height: 40px !important;
        }
    </style>

</head>

<body>
    <p class="text-center font-weight-bold fs-14 text-black">DATA LAPORAN VISIT {{ $tgl_awal ? 'TANGGAL ' . $tgl_awal : '' }} {{ $tgl_akhir ? ' - ' . $tgl_akhir : '' }}</p>
    <table class="table table-bordered fs-10">
        <thead>
            <tr>
                <th class="text-center p-1 bg-gray-300 bt-none text-black" width="5%">No</th>
                <th class="text-center p-1 bg-gray-300 bt-none text-black" width="20%">Nama</th>
                <th class="text-center p-1 bg-gray-300 bt-none text-black" width="20%">Email</th>
                <th class="text-center p-1 bg-gray-300 bt-none text-black" width="15%">Tanggal Request</th>
                <th class="text-center p-1 bg-gray-300 bt-none text-black" width="15%">Tanggal Visit</th>
                <th class="text-center p-1 bg-gray-300 bt-none text-black" width="10%">Jumlah</th>
                <th class="text-center p-1 bg-gray-300 bt-none text-black" width="10%">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($datas as $key => $i)
                <tr>
                    <td class="p-2 text-center">{{ $key+1 }}</td>
                    <td class="p-2">{{ $i->nama_pengunjung }}</td>
                    <td class="p-2">{{ $i->email }}</td>
                    <td class="p-2">{{ $i->created_at }}</td>
                    <td class="p-2">{{ $i->tanggal }} {{ $i->waktu }}</td>
                    <td class="p-2">{{ $i->people->count()+1 }} Orang</td>
                    <td class="p-2 text-center">
                        @if ($i->status == 0)
                            Pending
                        @elseif($i->status == 1)
                            Disetujui
                        @elseif($i->status == 2)
                            Ditolak
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center p-2">Tidak ada data.</td>         
                </tr>
            @endforelse
        </tbody>
    </table>
</body>

</html>
