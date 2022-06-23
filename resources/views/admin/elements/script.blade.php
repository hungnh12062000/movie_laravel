<!-- jQuery -->
<script src="{{ asset('admin/js/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ asset('admin/asset/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('admin/js/fastclick/lib/fastclick.js') }}"></script>
<!-- NProgress -->
<script src="{{ asset('admin/asset/nprogress/nprogress.js') }}"></script>
<!-- bootstrap-progressbar -->
<script src="{{ asset('admin/asset/bootstrap-progressbar/bootstrap-progressbar.min.js') }}"></script>
<!-- iCheck -->
<script src="{{ asset('admin/asset/iCheck/icheck.min.js') }}"></script>
<!-- Custom Theme Scripts -->
<script src="{{ asset('admin/js/custom.min.js') }}"></script>

<!-- Scripts -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js"
integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>

{{-- datatable --}}
<script type="text/javascript" src="//cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>

{{-- episode --}}
<script type="text/javascript">
    //datatable
    $(document).ready(function() {
        $('#tableMovie').DataTable();
    });


    $('.select_movie').change(function() {
        var id = $(this).val();

        $.ajax({
            // URL muốn sử dụng AJAX để thực hiện request
            url: "{{ route('select-movie') }}",

            //Kiểu request muốn thực hiện
            type: "GET",

            //Dữ liệu được gửi lên server khi thực thi một request Ajax.
            data: {
                id: id
            },

            //Một hàm được gọi khi request thành công.
            success: function(data) {
                $('#show_movie').html(data);
            }
        });
    });
</script>

<script type="text/javascript">
    $('.select-year').change(function() {
        let year = $(this).find(':selected').val();
        let id_movie = $(this).attr('id');

        $.ajax({
            // URL muốn sử dụng AJAX để thực hiện request
            url: "{{ url('/update-year-movie') }}",

            //Kiểu request muốn thực hiện
            type: "GET",

            //Dữ liệu được gửi lên server khi thực thi một request Ajax.
            data: {
                year: year,
                id_movie: id_movie
            },

            //Một hàm được gọi khi request thành công.
            success: function() {
                alert('Thay đổi năm phim theo năm ' + year + ' thành công!');
            }
        });
    })
</script>
<script type="text/javascript">
    $('.select-topview').change(function() {
        let topview = $(this).find(':selected').val();
        let id_movie = $(this).attr('id');

        let text;
        if (topview == '0') {
            text = 'Ngày';
        } else if (topview == '1') {
            text = 'Tuần';
        } else {
            text = 'Tháng';
        }

        $.ajax({
            // URL muốn sử dụng AJAX để thực hiện request
            url: "{{ url('/update-topview-movie') }}",

            //Kiểu request muốn thực hiện
            type: "GET",

            //Dữ liệu được gửi lên server khi thực thi một request Ajax.
            data: {
                topview: topview,
                id_movie: id_movie
            },

            //Một hàm được gọi khi request thành công.
            success: function() {
                alert('Thay đổi phim theo topview ' + text + ' thành công!');
            }
        });
    })
</script>

<script type="text/javascript">
    //datatable
    $(document).ready(function() {
        $('#tableMovie').DataTable();
    });

    function ChangeToSlug() {
        let slug;
        //Lấy text từ thẻ input title
        slug = document.getElementById("slug").value;
        slug = slug.toLowerCase();

        //Đổi ký tự có dấu thành không dấu
        slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
        slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
        slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
        slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
        slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
        slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
        slug = slug.replace(/đ/gi, 'd');

        //Xóa các ký tự đặt biệt
        slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');

        //Đổi khoảng trắng thành ký tự gạch ngang
        slug = slug.replace(/ /gi, "-");

        //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
        slug = slug.replace(/\-\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-/gi, '-');
        slug = slug.replace(/\-\-/gi, '-');

        //Xóa các ký tự gạch ngang ở đầu và cuối
        slug = '@' + slug + '@';
        slug = slug.replace(/\@\-|\-\@|\@/gi, '');

        //In slug ra textbox có id “slug”
        document.getElementById('convert_slug').value = slug;

    }
</script>
