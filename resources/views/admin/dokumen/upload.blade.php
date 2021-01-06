@extends('layouts.backend.app')
@section('content')
<form action="{{ route('dokumen.store') }}" method="POST" enctype="multipart/form-data" id="form">
@csrf
<div class="card">
    <div class="card-body">
        <div class="form-group">
            <div class="row pb-3">
                    <input type="hidden" name="_token" id="tokentemp" value="{{ Session::token() }}" />
                <div class="col-md-3">
                    <label><strong>Kategori :</strong></label>
                    <select id="kategori_dokumen_id" name="kategori_dokumen_id" class="form-control" style="width: 200px">
                        <?php use App\Models\Kategori_dokumen;
                            $kategori = Kategori_dokumen::get();
                        ?>
                        <option value="0">===PILIH===</option>
                        @foreach($kategori as $d)
                        <option value="{{ $d->id }}">{{ $d->name }}</option>
                        @endforeach
                    </select>
                    <small>Pilih kategori dokumen terlebih dahulu</small>

                </div>
                <div class="col-md-2 hd">
                    <label><strong>Thumbnail :</strong></label>
                    <input type="file" class="form-control" name="thumbnail">
                    <small>Pilih browse untuk memilih file</small>
                </div>
                <div class="col-md-2 hd">
                    <label><strong>File :</strong></label>
                    <input type="file" class="form-control" name="file" id="file">
                    <small>Pilih browse untuk memilih file</small>
                </div>
                <div class="col-md-2 hd">
                    <label><strong>Perubahan</strong></label>
                    <input type="number" class="form-control" name="perubahan" id="perubahan">
                    <small>Isi nol (0) untuk dokumen murni</small>
                </div>
                <div class="col-md-3 hd">
                    <label><strong>Judul :</strong></label>
                    <input type="text" class="form-control" name="judul" id="judul">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6 hd">
                    <label><strong>Periode :</strong></label>
                    <label for="range_06" class="control-label text-muted text-center"></label>
                    <input type="text" id="range_06" name="periode" id="periode">
                </div>
                <div class="col-md-6 hd1">
                    <label><strong>Keterangan :</strong></label>
                    <textarea name="keterangan" id="keterangan" class="form-control" style="width: 100%"></textarea>
                </div>
            </div>
            <button type="submit" class="float-right hd mb-2 btn btn-sm btn-primary"><i class="mdi mdi-buffer"></i> <span>Simpan</span> </button>
        </div>
    </div>
</div>
</form>
<ul class="side-navigation" style="list-style-type: none;">
<li class="menu-list"><a href="#"></a>
    <ul class="child-list" >
        <li>
        <form method="POST" action="{{ route('dokumen.input.kategori.dokumen') }}">
            @csrf
            <br>
            <div class="row" style="padding-bottom: 10px ">
                <div class="col-lg-4">
                    <p>Nama</p>
                    <input style="width: 100%" class="form-control" type="text" name="name">
                    <p>Judul</p>
                    <input style="width: 100%" class="form-control" type="text" name="judul">
                </div>
                <div class="col-lg-8"><p>Uraian</p><textarea class="form-control" style="width: 100%" name="uraian"></textarea>
                    <button type="submit" style="margin-top: 15px;height: 40px" class="btn btn-primary float-right"><i class="mdi mdi-buffer"></i> <span>Simpan</span> </button>
                </div>


            </div>
        </form>

        </li>
    </ul>
</li>
</ul>

@include('admin.dokumen.table_kategori')
@endsection
@push('css')
<link href="{{ asset('backend/assets/plugins/ion-rangeslider/ion.rangeSlider.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('backend/assets/plugins/ion-rangeslider/ion.rangeSlider.skinFlat.css') }}" rel="stylesheet" type="text/css"/>

<link href="{{ asset('backend/assets/plugins/DataTables/dataTables.bootstrap4.css') }}" rel="stylesheet">
@endpush
@push('js')
<!-- rangeSlider -->
<script src="{{ asset('backend/assets/plugins/ion-rangeslider/ion.rangeSlider.min.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/ion-rangeslider/ui-sliders.js') }}"></script>

<script src="{{ asset('backend/assets/plugins/DataTables/datatables.min.js') }}"></script>
<script src="{{ asset('backend/dist/js/pages/datatable/datatable-advanced.init.js') }}"></script>
<script>
    $(document).ready(function() {
        var table = $('#BasicTable').DataTable();
        $('.hd').hide();
        $('.hd1').hide();

        $('#file').on('change', function() {
            $('.hd1').show();
        });

        $('#kategori_dokumen_id').on('change',function(){
            //table.draw();
            var kategori_id = $('#kategori_dokumen_id').val();
            var token = $('#tokentemp').val();
            $.ajax({
                url: '{{route('dokumen.filter.table')}}',
                type: 'POST',
                data: {
                    kategori_id : kategori_id,
                    _token : token,
                    },
                success: function(html){
                    $("#konten").html(html);
                }
            });

            $('.hd').show();
        });

        table.on('click','.edit', function() {
            $tr = $(this).closest('tr');
            if ($($tr).hasClass('child')) {
                $tr = $tr.prev('.parent');
            }

            var data = table.row($tr).data();
            console.log(data);

            $('#perubahan').val(data[3]);
            $('#judul').val(data[4]);
            $('#keterangan').val(data[5]);
            // $('#document').val(data[4]);

            $('#form').attr('action','{{ route('dokumen.update.kategori.dokumen') }}'+ '/' + data[0]);

        })
    });

</script>

@endpush