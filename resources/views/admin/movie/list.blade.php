{{-- list --}}
<table class="table table-hover table-bordered" id="tableMovie">
    <thead class="">
        <tr class="bg-primary">
            <th scope="col">#</th>
            <th scope="col">Tên phim</th>
            <th scope="col">Hình ảnh</th>
            <th scope="col">Trailer</th>
            <th scope="col">Định dạng</th>
            {{-- <th scope="col">Phụ đề</th> --}}
            <th scope="col">Thời lượng</th>
            {{-- <th scope="col">Slug</th> --}}
            {{-- <th scope="col">Mô tả phim</th> --}}
            {{-- <th scope="col">Từ khóa</th> --}}
            <th scope="col">Trạng thái</th>
            <th scope="col">Danh mục</th>
            <th scope="col">Quốc gia</th>
            {{-- <th scope="col">Thể loại</th> --}}
            {{-- <th scope="col">Ngày tạo</th> --}}
            <th scope="col">Ngày cập nhật</th>
            <th scope="col" class="col-1">Năm phim</th>
            {{-- <th scope="col" class="col-1">Top views</th> --}}
            <th scope="col">Hành động</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($list as $key => $movie)
            <tr>
                <th scope="row">{{ $key }}</th>
                <td>{{ $movie->title }}</td>
                <td><img width="40%" src="{{ asset('/uploads/movie/' . $movie->image) }}" alt=""></td>
                <td>{{ $movie->trailer }}</td>
                <td>
                    @if ($movie->resolution == 0)
                        HD
                    @elseif ($movie->resolution == 1)
                        SD
                    @elseif ($movie->resolution == 2)
                        HDCam
                    @elseif ($movie->resolution == 3)
                        Cam
                    @elseif ($movie->resolution == 4)
                        FULLHD
                    @else
                        Trailer
                    @endif
                </td>
                {{-- <td>
                    @if ($movie->cc == 0)
                        Phụ đề
                    @elseif ($movie->cc == 1)
                        Thuyết minh
                    @endif
                </td> --}}
                <td>{{ $movie->time }}</td>
                {{-- <td>{{ $movie->slug }}</td> --}}
                {{-- <td>{{ $movie->description }}</td> --}}
                {{-- <td>{{ $movie->tags }}</td> --}}

                <td>
                    @if ($movie->status)
                        Hiển thị
                    @else
                        Không hiển thị
                    @endif
                </td>

                <td>{{ $movie->category->title }}</td>
                <td>{{ $movie->country->title }}</td>
                {{-- <td>{{ $movie->genre->title }}</td> --}}
                {{-- <td>{{ $movie->create_day }}</td> --}}
                <td>{{ $movie->update_day }}</td>
                <td>
                    {!! Form::selectYear('year', 2017, 2022, isset($movie->year) ? $movie->year : '', ['class' => 'select-year custom-select', 'id' => $movie->id]) !!}
                </td>
                {{-- <td>
                    {!! Form::select('topview', ['0' => 'Ngày', '1' => 'Tuần', '2' => 'Tháng'], isset($movie) ? $movie->topview : '', ['class' => 'select-topview custom-select', 'id' => $movie->id]) !!}
                </td> --}}

                <td>
                    {!! Form::open(['method' => 'DELETE', 'route' => ['movie.destroy', $movie->id], 'onsubmit' => 'return confirm("Bạn có chắc chắn muốn xóa phim?")']) !!}
                    {!! Form::submit('Xóa', ['class' => 'btn btn-danger']) !!}
                    <a href="{{ route('movie.edit', $movie->id) }}" class="btn btn-warning">Sửa</a>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach

    </tbody>
</table>
