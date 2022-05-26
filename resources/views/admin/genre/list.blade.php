{{-- list --}}
<table class="table table-hover">
    <thead class="">
        <tr class="bg-primary">
            <th scope="col" class="">#</th>
            <th scope="col" class="col-2">Tên thể loại</th>
            <th scope="col" class="col-2">Slug</th>
            <th scope="col" class="col-4">Mô tả</th>
            <th scope="col" class="col-2">Trạng thái</th>
            <th scope="col" class="col-2">Hành động</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($list as $key => $gen)
            <tr>
                <th scope="row">{{ $key }}</th>
                <td>{{ $gen->title }}</td>
                <td>{{ $gen->slug }}</td>
                <td>{{ $gen->description }}</td>
                <td>
                    @if ($gen->status)
                        Hiển thị
                    @else
                        Không hiển thị
                    @endif
                </td>
                <td>
                    {!! Form::open(['method' => 'DELETE', 'route' => ['genre.destroy', $gen->id], 'onsubmit' => 'return confirm("Bạn có chắc chắn muốn xóa phim?")']) !!}
                    {!! Form::submit('Xóa', ['class' => 'btn btn-danger']) !!}
                    <a href="{{ route('genre.edit', $gen->id) }}" class="btn btn-warning">Sửa</a>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
