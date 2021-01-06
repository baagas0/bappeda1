@extends('layouts.backend.app')
@section('content')
<div class="card">
    <div class="card-body">
        <div class="form-group">
            <div class="row pb-3">
                <input type="hidden" name="_token" id="tokentemp" value="{{ Session::token() }}" />
                <div class="col-md-3">
                    <label><strong>Kegiatan :</strong></label>
                    <input type="hidden" name="_token" id="tokentemp" value="{{ Session::token() }}" />
                    <select id="kegiatanbidang" name="kegiatanbidang" onchange="kegiatanbidang()" class="form-control" style="width: 200px">
                        <?php use App\Models\Suggestion;use App\Models\Kegiatan_bidang;
                            
                            
                        ?>
                        <option value="0">===PILIH===</option>
                        @foreach($suggestion as $d)
                        <?php
                            $kegiatan = Kegiatan_bidang::findOrFail($d->kegiatan_bidang_id);
                            
                        ?>
                        <option value="{{ $d->id }}">{{ $kegiatan->name }}</option>
                        @endforeach
                    </select>
                    <small>Pilih kegiatan bidang terlebih dahulu</small>

                </div>
            </div>
        </div>
    </div>
</div>
<div id="dataSuggestion">
</div>
@endsection
@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script>
    function kegiatanbidang() { 
        var kegiatanbidang = $('#kegiatanbidang').val();
        var token = $('#tokentemp').val();
        $.ajax({
            url: '{{route('suggestion.ajax.suggestion')}}',
            type: 'POST',
            data: {
                    kegiatanbidang : kegiatanbidang,
                    _token : token,
                 },
            success: function(html){
                $("#dataSuggestion").html(html);
            }
        });
    }
</script>

@endpush