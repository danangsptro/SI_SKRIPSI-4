<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="{{ public_path('css/util.css') }}">
    <link rel="stylesheet" href="{{ public_path('css/pdf-bootstrap.css') }}">

    <style>
        body {
            padding: 30px
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
    <p class="text-center font-weight-bold fs-14 text-black">DATA CENTER VISIT REQUEST</p>
    <table class="table table-bordered fs-10">
        <thead>
            <tr>
                <th colspan="4" class="text-center p-1 bg-gray-300 b-none text-black">Requestor Information</th>
            </tr>
        </thead>
        <tbody>
            <tr class="text-black">
                <td width="25%" class="p-2 bg-gray-200">Requester's Name</td>
                <td width="25%" class="p-2">{{ $data->nama_pengunjung }}</td>
                <td width="25%" class="p-2 bg-gray-200">Title</td>
                <td width="25%" class="p-2">{{ $data->jabatan }}</td>
            </tr>
            <tr class="text-black">
                <td width="25%" class="p-2 bg-gray-200">Company</td>
                <td width="25%" class="p-2">{{ $data->perusahaan }}</td>
                <td width="25%" class="p-2 bg-gray-200">Phone/Mobile</td>
                <td width="25%" class="p-2">{{ $data->no_telp }}</td>
            </tr>
            <tr class="text-black">
                <td width="25%" class="p-2 bg-gray-200">Date of Visit <p class="fs-9 mb-0">(Mon-Fri only for normal / Schedule maintenance)</p></td>
                <td width="25%" class="p-2">{{ Carbon\Carbon::createFromFormat('Y-m-d', $data->tanggal)->format('d F Y') }}</td>
                <td width="25%" class="p-2 bg-gray-200">Time of Visit <p class="fs-9 mb-0">(9:30am – 6:30pm only for normal/schedule maintenance)</p></td>
                <td width="25%" class="p-2">{{ $data->waktu }}</td>
            </tr>
            <tr class="text-black">
                <td width="25%" class="p-2 bg-gray-200">Area to be visited :</td>
                <td width="25%" class="p-2" colspan="3">
                    <ul class="ml-n4">
                        @foreach ($rooms as $i)
                            <li>{{ $i->room->nama }}</li>
                        @endforeach
                    </ul>
                </td>
            </tr>
            <tr class="text-black">
                <td width="25%" class="p-2 bg-gray-200">Purpose of visit :</td>
                <td width="25%" class="p-2" colspan="3">{{ $data->purpose->tujuan }}</td>
            </tr>
        </tbody>
    </table>
    <table class="table table-bordered fs-10">
        <thead>
            <tr>
                <th colspan="4" class="text-center p-1 bg-gray-300 bt-none text-black">Visitor Lists (Maximum 5 Visitors)</th>
            </tr>
            <tr>
                <th width="5%" class="text-center p-1 bg-gray-200 bt-none text-black">No.</th>
                <th width="40%" class="text-center p-1 bg-gray-200 bt-none text-black">Visitor Name</th>
                <th width="25%" class="text-center p-1 bg-gray-200 bt-none text-black">Title</th>
                <th width="30%" class="text-center p-1 bg-gray-200 bt-none text-black">Company</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($peoples as $key => $p)
                <tr>
                    <td class="p-1 text-black text-center">{{ $key + 1 }}.</td>
                    <td class="p-1 text-black">{{ $p->nama }}</td>
                    <td class="p-1 text-black">{{ $p->jabatan }}</td>
                    <td class="p-1 text-black">{{ $p->perusahaan }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="4">
                    <div>
                        <i class="text-black">Notes : </i><span class="text-black">{{ $data->ket }}</span>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <div class="text-black">
                        <p class="m-0"><i class="font-weight-bolder">{{ $data->nama_pengunjung }} </i> here by confirm all the above given information are correct</p>
                        <ol>
                            <li>Using these permissions properly and maintain the confidentiality of data</li>
                            <li>It will not disseminate and inform the employee or any other person that is confidential</li>
                        </ol>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="4" class="text-center text-black p-1 bg-gray-300 font-weight-bold">Approval Signatures</td>
            </tr>
            <tr>
                <td colspan="2" class="p-1 text-black text-center bg-gray-200">Requestor</td>
                <td colspan="2" class="p-1 text-black text-center bg-gray-200">Data Center Manager</td>
            </tr>
            <tr>
                <td colspan="2" class="h-10"></td>
                <td colspan="2" class="h-10"></td>
            </tr>
            <tr>
                <td colspan="2" class="p-1 text-black">Date: </td>
                <td colspan="2" class="p-1 text-black">Date: </td>
            </tr>
        </tbody>
    </table>
</body>

</html>
