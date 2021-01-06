@extends('layouts.backend.app')
@section('content')
<ul class="side-navigation " style="list-style-type: none;">
<li class="menu-list active ">
    <ul class="child-list" >
        <li>
        <form method="POST" action="{{ (Route::currentRouteName() == 'dokumen.kategori.dokumen') ? route('dokumen.input.kategori.dokumen') : route('dokumen.update.kategori.dokumen') }}" id="form">
            @csrf
            <br>
            <div class="row" style="padding-bottom: 10px ">
                <div class="col-lg-4">
                    <p>Nama</p>
                    <input style="width: 100%" class="form-control" type="text" name="name" id="name" value="{{ (empty($update)) ? old('name') : $update->name }}"><br>
                    <div class="row">
                        <div class="col-md-9">
                            <p>Judul</p>
                            <input style="width: 100%" class="form-control" type="text" name="judul" id="judul" value="{{ (empty($update)) ? old('name') : $update->judul }}">
                        </div>
                        <div class="col-md-3">
                            <p>Is Text</p>
                            <input id="is_text" value="0" name="is_text" type="checkbox" id="is_text" {{ (empty($update)) ? old('is_text') : ($update->is_text == 1) ? 'checked' : '' }} />
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <p>Uraian</p>
                    <textarea class="form-control" style="width: 100%" name="uraian" id="uraian">{{ (empty($update)) ? old('name') : $update->uraian }}</textarea><br>

                    <div class="text" id="text" style="display: none;">
                        <p>Uraian</p>
                        <textarea class="form-control" name="document" id="document" style="width: 100%;display: block!important;" name="document">{!! (empty($update)) ? old('name') : $update->text !!}</textarea>
                    </div>
                    <button type="submit" style="margin-top: 15px;height: 40px" class="btn btn-primary float-right"><i class="mdi mdi-buffer"></i> <span>{{ (Route::currentRouteName() == 'dokumen.kategori.dokumen') ? 'Simpan' : 'update' }}</span> </button>
                </div>


            </div>
            
        </form>

        </li>
    </ul>
</li>
</ul>

<div class="table-responsive">
    <table id="BasicTable" class="table display">
        <thead class="bg-primary text-white">
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Judul</th>
                <th>Uraian</th>
                <th>Text</th>
                <th>Act.</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $data)
            <tr>
                <td>{{ $data->id }}</td>
                <td>{{$data->name}}</td>
                <td>{{ $data->judul }}</td>
                <td>{{Str::limit($data->uraian, 20)}}</td>
                <td>{{Str::limit($data->text, 20)}}</td>
                <td>
                    <div class="btn-group">
                        <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="ti-settings"></i>
                        </button>
                        <div class="dropdown-menu animated flipInY">
                            <a class="dropdown-item" href="{{ route('dokumen.edit.kategori.dokumen',$data->id) }}">Edit</a>
                            <a class="dropdown-item" href="{{ route('dokumen.delete.kategori.dokumen',$data->id) }}">Hapus</a>
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
@push('css')
<link href="{{ asset('backend/assets/plugins/ion-rangeslider/ion.rangeSlider.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('backend/assets/plugins/ion-rangeslider/ion.rangeSlider.skinFlat.css') }}" rel="stylesheet" type="text/css"/>

<!--summernote plugin-->
<link href="{{ asset('backend/assets/plugins/summernote/summernote-bs4.css') }}" rel="stylesheet">
{{-- <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script> --}}
    {{-- <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script> --}}

<link href="{{ asset('backend/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css') }}" rel="stylesheet">
@endpush
@push('js')
<!-- rangeSlider -->
<script src="{{ asset('backend/assets/plugins/ion-rangeslider/ion.rangeSlider.min.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/ion-rangeslider/ui-sliders.js') }}"></script>
<script type="text/javascript">
    $(document).ready( function () {

        // $('body').on('load', function() {
        //     var is_text = document.getElementById("is_text");
        //     var text1 = document.getElementById("text");
        //     if (is_text.checked == true) {
        //         alert('asdsad');
        //         // text1.style.display = "block";
        //     }else {
        //         text1.style.display = "none";
        //     }
        // });
        // $('#text').hide();
        // Get the checkbox
        $('#is_text').on('change', function() {
        var checkBox = document.getElementById("is_text");
          // Get the output text
        var text = document.getElementById("text");

          // If the checkbox is checked, display the output text
          if (checkBox.checked == true){
            text.style.display = "block";
            // $('#is_text').val(1);
        } else {
            text.style.display = "none";
            // $('#is_text').val(0);
        }

        });

        // $('#is_text').on('change', function() {
        //      var value = $('#is_text').val(this.checked);
        //     alert(value);
            // if ($value=='checked') {
            //     $('#text').hide();
            // }else {
            //     $('#text').show();
            // }
        // });

        


         var table = $('#BasicTable').DataTable();

        table.on('click','.edit', function() {
            $tr = $(this).closest('tr');
            if ($($tr).hasClass('child')) {
                $tr = $tr.prev('.parent');
            }

            var data = table.row($tr).data();
            console.log(data);

            $('#name').val(data[1]);
            $('#judul').val(data[2]);
            $('#uraian').val(data[3]);
            $('#document').html(data[4]);

            $('#form').attr('action','{{ route('dokumen.update.kategori.dokumen') }}'+ '/' + data[0]);

        })
    } );

</script>
<script src="{{ asset('backend/assets/plugins/summernote/summernote-bs4.min.js') }}"></script>

<script type="text/javascript">
    $(function() {

              // main summernote with custom placeholder
              var $placeholder = $('.placeholder');
              $('#document').summernote({
                height: 300,
                codemirror: {
                    mode: 'text/html',
                    htmlMode: true,
                    lineNumbers: true,
                    theme: 'monokai'
                },
                callbacks: {
                  onInit: function() {
                    $placeholder.show();
                }

            }
        });
          });
      </script>

<script src="{{ asset('backend/assets/extra-libs/DataTables/datatables.min.js') }}"></script>
<!-- start - This is for export functionality only -->
{{-- <script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script> --}}
<script src="{{ asset('backend/dist/js/pages/datatable/datatable-advanced.init.js') }}"></script>

<script>
    $(function () {
        $('body').on('click', '.editCustomer', function () {
          var Customer_id = $(this).data('id');
          $.get("" +'/' + Customer_id +'/edit', function (data) {
              $('#modelHeading').html("Edit Customer");
              $('#saveBtn').val("edit-user");
              $('#ajaxModel').modal('show');
              $('#Customer_id').val(data.id);
              $('#name').val(data.name);
              $('#detail').val(data.detail);
          })
        });
    });
</script>

@endpush