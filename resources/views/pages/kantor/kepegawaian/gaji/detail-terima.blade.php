@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
{{-- <link rel="stylesheet" href="{{ asset('css/dataTables.min.css') }}"> --}}
<script src="{{ asset('js/jquery-3.3.1.js') }}"></script>
<script src="{{ asset('js/jquery.dataTablesku.min.js') }}"></script>

<script src="{{ asset('js/fstdropdown.js') }}"></script>
<link rel="stylesheet" href="{{ asset('css/fstdropdown.css') }}">

<div class="row">

    @can('gaji')

    <div class="col-md-4">
        <div class="card" style="width: 100%">
            <div class="card-header bg-secondary">
                <button type="button" class="btn btn-sm btn-dark pull-left" onclick="window.location.href='{{ url('kepegawaian/gaji/terima') }}'"><i class="fa-fw fas fa-hand-o-left nav-icon"></i> Kembali</button> 
                <button type="button" class="btn btn-sm btn-danger pull-right" onclick="window.location.href='{{ url('kepegawaian/gaji/final') }}'"><i class="fa-fw fas fa-legal nav-icon"></i> Validasi</button> 
            </div>
        </div>
        
        <div class="card" style="width: 100%">
            <div class="card-header bg-dark text-white">

                <i class="fa-fw fas fa-user nav-icon text-info">
            
                </i>
                Detail Karyawan

                <kbd class="pull-right text-dark" style="background-color: whitesmoke">ID : {{ $list['show'][0]->id_user }}</kbd>
                
            </div>
            <div class="card-body">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="data-table-list">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover">
                                            <tbody>
                                                    <tr>
                                                        <th>NIP</th>
                                                        <td>{{ $list['show'][0]->nip }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Nama Lengkap</th>
                                                        <td>{{ $list['show'][0]->nama }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Jabatan</th>
                                                        <td>{{ $list['show'][0]->jabatan }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Unit</th>
                                                        <td>
                                                            @foreach ($list['show'] as $item)
                                                                <kbd>{{ $item->nama_role }}</kbd>
                                                            @endforeach
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Masuk Kerja</th>
                                                        <td>{{ Carbon\Carbon::parse($list['show'][0]->masuk_kerja)->isoFormat('dddd, D MMMM Y') }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Rekening</th>
                                                        @if (!empty($list['show'][0]->nama_rek))
                                                            <td>({{ $list['show'][0]->nama_rek }}) {{ $list['show'][0]->nomor_rek }}</td>
                                                        @else
                                                            <td>-</td>
                                                        @endif
                                                    </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card" style="width: 100%">
            <div class="card-header bg-dark text-white">

                <i class="fa-fw fas fa-money nav-icon text-primary">
            
                </i>
                Total Gaji
                
            </div>
            <div class="card-body">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="data-table-list">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover">
                                            <thead>
                                                <tr class="thead-dark">
                                                    <th>#</th>
                                                    <th>Nominal</th>    
                                                </tr>
                                            </thead>
                                            <tbody>
                                                    <tr style="background-color: maroon" class="text-white">
                                                        <th>Kotor</th>
                                                        <th>Rp {{ number_format( ($list['show'][0]->struktural+$list['show'][0]->fungsional+$list['show'][0]->gapok+$list['show'][0]->insentif),2,",",".") }}</th>
                                                    </tr>
                                                    <tr style="background-color: mediumspringgreen">
                                                        <th>Bersih</th>
                                                        <th>Rp {{ number_format( ($list['show'][0]->struktural+$list['show'][0]->fungsional+$list['show'][0]->gapok+$list['show'][0]->insentif)-$list['show'][0]->potong,2,",",".") }}</th>
                                                    </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="row">
            <div class="col-md-12">
                <div class="card" style="width: 100%">
                    <div class="card-header bg-dark text-white">
        
                        <i class="fa-fw fas fa-tag nav-icon text-warning">
                    
                        </i>Tunjangan
        
                    </div>
                    <div class="card-body">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="data-table-list">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover">
                                            <thead>
                                                <tr class="thead-dark text-center">
                                                    <th colspan="2">STRUKTURAL</th>
                                                </tr>
                                                <tr class="thead-light">
                                                    <th>Kriteria</th>
                                                    <th>Nominal</th>    
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($list['struktural'] as $item)
                                                <tr>
                                                    @foreach($list['strukturalHas'] as $value) 
                                                        @if ($value->id_struktural == $item->id)
                                                        <td>{{ $item->ket }}</td>
                                                        <td>Rp {{ number_format( $item->nominal,2,",",".") }}</td>
                                                        @endif 
                                                    @endforeach
                                                </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr class="thead-light">
                                                    <th>Total</th>
                                                    <th>Rp {{ number_format( $list['show'][0]->struktural,2,",",".") }}</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                                <hr style="margin-top: -3px">
                                <div class="data-table-list">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover">
                                            <thead>
                                                <tr class="thead-dark text-center">
                                                    <th colspan="2">FUNGSIONAL</th>
                                                </tr>
                                                <tr class="thead-light">
                                                    <th>Kriteria</th>
                                                    <th>Nominal</th>    
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($list['fungsional'] as $item)
                                                <tr>
                                                    @foreach($list['fungsionalHas'] as $value) 
                                                        @if ($value->id_fungsional == $item->id)
                                                        <td>{{ $item->ket }}</td>
                                                        <td>Rp {{ number_format( $item->nominal,2,",",".") }}</td>
                                                        @endif 
                                                    @endforeach
                                                </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr class="thead-light">
                                                    <th>Total</th>
                                                    <th>Rp {{ number_format( $list['show'][0]->fungsional,2,",",".") }}</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card" style="width: 100%">
                    <div class="card-header bg-dark text-white">
        
                        <i class="fa-fw fas fa-handshake nav-icon text-success">
                    
                        </i>
                        Detail Penerimaan Gaji
                        
                    </div>
                    <div class="card-body">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="data-table-list">
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-hover">
                                                    <thead>
                                                        <tr class="thead-light">
                                                            <th>#</th>
                                                            <th>Nominal</th>    
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                            <tr>
                                                                <th>Gaji Pokok</th>
                                                                <td>Rp {{ number_format( $list['show'][0]->gapok,2,",",".") }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Tunjangan Struktural</th>
                                                                <td>Rp {{ number_format( $list['show'][0]->struktural,2,",",".") }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Tunjangan Fungsional</th>
                                                                <td>Rp {{ number_format( $list['show'][0]->fungsional,2,",",".") }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Insentif Kehadiran</th>
                                                                <td>Rp {{ number_format( $list['show'][0]->insentif,2,",",".") }}</td>
                                                            </tr>
                                                    </tbody>
                                                    <tfoot>
                                                        <tr class="thead-light">
                                                            <th>Total</th>
                                                            <th>Rp {{ number_format( ($list['show'][0]->struktural+$list['show'][0]->fungsional+$list['show'][0]->gapok+$list['show'][0]->insentif),2,",",".") }}</th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card" style="width: 100%">
                    <div class="card-header bg-dark text-white">
        
                        <i class="fa-fw fas fa-signing nav-icon text-danger">
                    
                        </i>
                        Detail Potongan Gaji
                        
                    </div>
                    <div class="card-body">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="data-table-list">
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-hover">
                                                    <thead>
                                                        <tr class="thead-light">
                                                            <th>Kriteria</th>
                                                            <th>Nominal</th>    
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            @if ($list['show'][0]->iuran_pokok == true)
                                                                <th>Koperasi / Iuran Pokok</th>
                                                                <td>Rp 100.000,00</td>    
                                                            @else
                                                                <th>Koperasi / Iuran Wajib</th>
                                                                <td>Rp 5.000,00</td>    
                                                            @endif
                                                        </tr>
                                                        @foreach($list['ref_potong'] as $item)
                                                        <tr>
                                                            @foreach($list['potongHas'] as $value) 
                                                                @if ($value->id_potong == $item->id)
                                                                    <th>{{ $item->kriteria }}</th>
                                                                    <td>Rp {{ number_format( $value->nominal,2,",",".") }}</td>
                                                                @endif 
                                                            @endforeach
                                                        </tr>
                                                        @endforeach
                                                        <tr>
                                                            <th>Infaq 
                                                                @if ($list['show'][0]->id_infaq == 1)
                                                                    <i class="fa fa-question-circle" title="1 % Gaji Pokok"></i>
                                                                @elseif ($list['show'][0]->id_infaq == 2)
                                                                    <i class="fa fa-question-circle" title="2,5 % Dari Total Penerimaan Kotor"></i>
                                                                @elseif ($list['show'][0]->id_infaq == 3)
                                                                    <i class="fa fa-question-circle" title="2,5 % Gaji Pokok"></i>
                                                                @endif
                                                            </th>
                                                            <td>Rp {{ number_format( $list['show'][0]->infaq,2,",",".") }}</td>
                                                        </tr>
                                                    </tbody>
                                                    <tfoot>
                                                        <tr class="thead-light">
                                                            <th>Total</th>
                                                            <th>Rp {{ number_format( $list['show'][0]->potong,2,",",".") }}</th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @else
        <p class="text-center">Maaf, anda tidak punya HAK untuk mengakses halaman ini.</p>
    @endcan

</div>

<script>
    $(document).ready( function () {
        $('#kepegawaian').DataTable(
            {
                // paging: true,
                // searching: true,
                // dom: 'Bfrtip',
                // buttons: [
                //     'copy', 'csv', 'excel', 'pdf', 'print'
                // ],
                order: [[ 6, "desc" ]],
            }
        );

        $('#unregistered').DataTable(
            {
                order: [[ 4, "asc" ]],
                pageLength: 50
            }
        );

        $("body").addClass('brand-minimized sidebar-minimized');

        // VALIDASI INPUT NUMBER
        $('input[type=number][max]:not([max=""])').on('input', function(ev) {
            var $this = $(this);
            var maxlength = $this.attr('max').length;
            var value = $this.val();
            if (value && value.length >= maxlength) {
            $this.val(value.substr(0, maxlength));
            }
        });
    } );
</script>

@endsection