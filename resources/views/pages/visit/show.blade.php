@extends('layouts.app')
@section('title', $title)
@section('content')
<div class="container-fluid" style="margin-bottom: 100px !important">
    <div class="font-weight-bold text-black">
        <p class="fs-30 mb-0">{{ $title }}</p>
        <span>{{ $desc }}</span>
    </div>
    <div class="mt-4">
        @include('layouts.alert')
        <div class="card">
            <h5 class="card-header fs-16 font-weight-bold bg-primary text-white">Menampilkan Data Kunjungan</h5>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="row">
                            <label class="col-md-4 text-right font-weight-bold fs-14">Nama Pengunjung </label>
                            <label class="col-md-8 fs-14">{{ $data->nama_pengunjung }}</label>
                        </div>
                        <div class="row">
                            <label class="col-md-4 text-right font-weight-bold fs-14">Email </label>
                            <label class="col-md-8 fs-14">{{ $data->email }}</label>
                        </div>
                        <div class="row">
                            <label class="col-md-4 text-right font-weight-bold fs-14">Perusahaan </label>
                            <label class="col-md-8 fs-14">{{ $data->perusahaan }}</label>
                        </div>
                        <div class="row">
                            <label class="col-md-4 text-right font-weight-bold fs-14">Jabatan </label>
                            <label class="col-md-8 fs-14">{{ $data->jabatan }}</label>
                        </div>
                        <div class="row">
                            <label class="col-md-4 text-right font-weight-bold fs-14">KTP </label>
                            <label class="col-md-8 fs-14">
                                <a href="{{ asset('file/ktp/' . $data->ktp) }}" class="text-info" target="blank">{{ $data->ktp }}</a>
                            </label>
                        </div>
                        <div class="row">
                            <label class="col-md-4 text-right font-weight-bold fs-14">Surat Izin </label>
                            <label class="col-md-8 fs-14">
                                <a href="{{ asset('file/surat_izin/' . $data->surat_izin) }}" class="text-info" target="blank">{{ $data->surat_izin ? $data->surat_izin : '-' }}</a>
                            </label>
                        </div>
                        <div class="row">
                            <label class="col-md-4 text-right font-weight-bold fs-14">Surat Tugas </label>
                            <label class="col-md-8 fs-14">
                                <a href="{{ asset('file/surat_tugas/' . $data->surat_tugas) }}" class="text-info" target="blank">{{ $data->surat_tugas ? $data->surat_tugas : '-' }}</a>
                            </label>
                        </div>
                        <div class="row">
                            <label class="col-md-4"></label>
                            <label class="col-md-8 fs-14">
                                <a href="{{ route('visit.cetakPDF', $data->id) }}" target="blank" class="btn btn-sm btn-primary"><i class="fa fa-file-pdf mr-2"></i>Cetak File</a>
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="row">
                            <label class="col-md-4 text-right font-weight-bold fs-14">Tujuan </label>
                            <label class="col-md-8 fs-14">{{ $data->purpose->tujuan }}</label>
                        </div>
                        <div class="row">
                            <label class="col-md-4 text-right font-weight-bold fs-14">Ruangan </label>
                            <label class="col-md-8 fs-14">
                                @foreach ($rooms as $i)
                                    <li>{{ $i->room->nama }}</li>
                                @endforeach
                            </label>
                        </div>
                        <div class="row">
                            <label class="col-md-4 text-right font-weight-bold fs-14">Waktu </label>
                            <label class="col-md-8 fs-14">{{ Carbon\Carbon::createFromFormat('Y-m-d', $data->tanggal)->format('d F Y') }} / {{ $data->waktu }}</label>
                        </div>
                        <div class="row">
                            <label class="col-md-4 text-right font-weight-bold fs-14">Status </label>
                            <label class="col-md-8 fs-14">
                                @if ($data->status == 0)
                                    <span class="badge badge-warning py-1 px-3 fs-12">Pending</span>
                                @elseif($data->status == 1)
                                    <span class="badge badge-success py-1 px-3 fs-12">Disetujui</span>
                                @elseif($data->status == 2)
                                    <span class="badge badge-danger py-1 px-3 fs-12">Ditolak</span>
                                @endif
                            </label>
                        </div>
                        <div class="row">
                            <label class="col-md-4 text-right font-weight-bold fs-14">Status Keterangan</label>
                            <label class="col-md-8 fs-14">{{ $data->ket_status }}</label>
                        </div>
                        <div class="row">
                            <label class="col-md-4 text-right font-weight-bold fs-14">Tanggal Approve</label>
                            <label class="col-md-8 fs-14">{{ $data->tgl_approve ? Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $data->tgl_approve)->format('d F Y | H:i:s') : '' }}</label>
                        </div>
                        <div class="row">
                            <label class="col-md-4 text-right font-weight-bold fs-14">Selesai Visit</label>
                            <label class="col-md-8 fs-14">{{ $data->waktu_selesai ? Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $data->waktu_selesai)->format('d F Y | H:i:s') : '' }}</label>
                        </div>
                        @if (!$data->waktu_selesai)
                        <div class="row">
                            <label class="col-md-4"></label>
                            <label class="col-md-8 fs-14">
                                <a href="{{ route('visit.selesaiVisit', $data->id) }}" class="btn btn-danger btn-sm"><i class="fa fa-times mr-2"></i>End Visit</a>
                            </label>
                        </div>
                        @endif
                    </div>
                </div>
                <hr>
                <p class="bg-info m-0 text-white font-weight-bold fs-16 py-2 px-4 rounded">List Pengunjung </p>
                <div class="table-responsive">
                    <table class="table data-table table-hover table-bordered" style="width:100%;">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th>Nama Pengunjung</th>
                                <th>Jabatan</th>
                                <th>Perusahaan</th>
                                <th width="10%">KTP</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center">1</td>
                                <td>{{ $data->nama_pengunjung }}</td>
                                <td>{{ $data->jabatan }}</td>
                                <td>{{ $data->perusahaan }}</td>
                                <td class="text-center">
                                    <a href="{{ asset('file/ktp/' . $data->ktp) }}" class="text-info" target="blank">Lihat File<i class="fa fa-eye ml-2"></i></a>
                                </td>
                            </tr>
                            @foreach ($peoples as $key => $p)
                                <tr>
                                    <td class="text-center">{{ $key+2 }}</td>
                                    <td>{{ $p->nama }}</td>
                                    <td>{{ $p->jabatan }}</td>
                                    <td>{{ $p->perusahaan }}</td>
                                    <td class="text-center">
                                        @if ($p->ktp)
                                        <a href="{{ asset('file/ktp/' . $p->ktp) }}" class="text-info" target="blank">Lihat File<i class="fa fa-eye ml-2"></i></a>
                                        @else
                                        <span>-</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @if ($role_id == 2 && $data->status == 0)
                <hr>
                <p class="bg-info text-white font-weight-bold fs-16 py-2 px-4 rounded">Form Persetujuan</p>
                <div class="col-md-6" style="margin-bottom: 100px !important">
                    <form action="{{ route('visit.updateStatus', $data->id) }}" class="fs-14 needs-validation" novalidate method="POST">
                        @csrf
                        <div class="row mb-2">
                            <label for="status" class="col-form-label col-md-3 text-right font-weight-bolder">Status </label>
                            <div class="col-sm-9">
                                <select class="fs-14 form-control fs-14 r-0 light select2" id="status" name="status" required>
                                    <option value=""></option>
                                    <option value="1">Setujui</option>
                                    <option value="2">Tolak</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label for="ket_status" class="col-sm-3 text-right col-form-label font-weight-bold">Keterangan</label>
                            <div class="col-sm-9">
                              <textarea type="text" name="ket_status" id="ket_status" class="form-control fs-14" rows="3" placeholder="Berikan Keterangan" autocomplete="off" required></textarea>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label class="col-sm-3"></label>
                            <div class="col-sm-9">
                                <button type="submit" class="btn btn-block btn-success fs-14"><i class="fa fa-save mr-2"></i>Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<script type="text/javascript">
    // 
</script>
@endpush