<table class="table table-hover">
    <thead class="">
        <tr class="bg-primary">
            <th scope="col" class="">#</th>
            <th scope="col" class="col-2">Tên danh mục phim</th>
            <th scope="col" class="col-2">Slug</th>
            <th scope="col" class="col-4">Mô tả</th>
            <th scope="col" class="col-2">Trạng thái</th>
            <th scope="col" class="col-2">Hành động</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($list as $key => $cate)
            <tr>
                <th scope="row">{{ $key }}</th>
                <td>{{ $cate->title }}</td>
                <td>{{ $cate->slug }}</td>
                <td>{{ $cate->description }}</td>
                <td>
                    @if ($cate->status)
                        Hiển thị
                    @else
                        Không hiển thị
                    @endif
                </td>
                <td>
                    {!! Form::open(['method' => 'DELETE', 'route' => ['category.destroy', $cate->id], 'onsubmit' => 'return confirm("Bạn có chắc chắn muốn xóa phim?")']) !!}
                    {!! Form::submit('Xóa', ['class' => 'btn btn-danger']) !!} &nbsp
                    <a href="{{ route('category.edit', $cate->id) }}" class="btn btn-warning">Sửa</a>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
