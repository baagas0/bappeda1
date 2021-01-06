<div class="table-responsive" id="konten">
    <table id="BasicTable" class="table display">
        <thead class="bg-primary text-white">
            <tr>
                <th>ID</th>
                <th>Thumbnail</th>
                <th>File</th>
                <th>Periode</th>
                <th>Perubahan</th>
                <th>Judul</th>
                <th>Keterangan</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if(empty($data))
            {{-- @foreach($full as $full)
            <tr>
                <td>{{ $full->id }}</td>
                <td><img src="{{ asset($full->thumbnail) }}" style="width: 35px;height: auto;"></td>
                <td><a href="{{ $full->file }}">Click For Download</a></td>
                <td>{{ $full->perubahan }}</td>
                <td>{{ $full->judul }}</td>
                <td>{{ $full->keterangan }}</td>
                <td>
                    <a class="btn btn-prmary edit">Edit</a>
                    <a href="{{ route('dokumen.delete', $full->id) }}" class="btn btn-prmary">Hapus</a>
                </td>
            </tr>
            @endforeach --}}
            @else
        	@foreach($data as $row)
        	<tr>
        		<td>{{ $row->id }}</td>
                <td>{{ $row->thumbnail }}</td>
                <td>{{ $row->file }}</td>
                <td>{{ $row->periode }}</td>
                <td>{{ $row->perubahan }}</td>
                <td>{{ $row->judul }}</td>
                <td>{{ $row->keterangan }}</td>
                <td>
                    <a class="btn btn-prmary edit">Edit</a>
                    <a href="{{ route('dokumen.delete', $row->id) }}" class="btn btn-prmary">Hapus</a>
                </td>
        	</tr>
        	@endforeach
            @endif
        </tbody>
    </table>
</div>

<script>
    $(document).ready(function() {
        var table = $('#BasicTable').DataTable();

        table.on('click','.edit', function() {
            $tr = $(this).closest('tr');
            if ($($tr).hasClass('child')) {
                $tr = $tr.prev('.parent');
            }

            var data = table.row($tr).data();
            console.log(data);
            $('.hd1').show();
            $('#perubahan').val(data[3]);
            $('#judul').val(data[4]);
            $('#keterangan').val(data[5]);
            // $('#document').val(data[4]);

            $('#form').attr('action','{{ route('dokumen.update') }}'+ '/' + data[0]);

        })

    });
</script>