<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>Laravel</title>

    <!-- Fonts -->
    <!-- <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet"> -->
    <link href="https://cdn.lazywasabi.net/fonts/Sarabun/Sarabun.css" rel="stylesheet">
    

    <!-- Styles -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <style>
        body {
            /* font-family: 'Nunito', sans-serif; */
            font-family: 'Sarabun', sans-serif;
        }
    </style>
</head>

<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-6">
                <h1>จังหวัดในประเทศไทย</h1>
            </div>
            
            <div class="col-md-6 d-flex justify-content-end">
                <div class="d-flex text-left justify-content-end align-items-center">
                    <button class="btn btn-primary" id="create_province_btn">สร้าง</button>
                </div>
            </div>
        </div>
        <table class="table">
            <thead>
                <tr>
                <th scope="col">ชื่อจังหวัดภาษาไทย</th>
                <th scope="col">ชื่อจังหวัดภาษาอังกฤษ</th>
                <th scope="col">ภูมิภาค</th>
                <th scope="col">เครื่องมือ</th>
                </tr>
            </thead>
            <tbody>
                @foreach($provinces as $province)
                <tr>
                    <td>{{ $province->name_th }}</td>
                    <td>{{ $province->name_en }}</td>
                    <td>{{ $province->geography_name }}</td>
                    <td>
                        <!-- <a href="{{ route('province.edit', $province->id) }}">แกไข</a> |  -->
                        <a  href="#" 
                            class="edit_province" 
                            data-province-th="{{ $province->name_th }}" 
                            data-province-en="{{ $province->name_en }}" 
                            data-province-en="{{ $province->name_en }}" 
                            data-province-id="{{ $province->id }}"
                            data-province-geography-id="{{ $province->geography_id }}"
                        >แกไข</a>
                         | 
                        <a href="#" data-province-id="{{ $province->id }}" class="delete_province text-danger">ลบ</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-center">
            {!! $provinces->links() !!}
        </div>    
    </div>

    <!-- Create Province Modal -->
    <div class="modal fade" tabindex="-1" id="create_province_modal" role="dialog" aria-labelledby="create_province_modal_label1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">เพิ่มจังหวัดใหม่</h5>
                </div>
                
                <div class="modal-body">
                    <div class="form-group">
                        <label for="province_th_input_for_create">จังหวัดภาษาไทย</label>
                        <input type="email" class="form-control" id="province_th_input_for_create">
                    </div>
                    <div class="form-group">
                        <label for="province_en_input_for_create">จังหวัดภาษาอังกฤษ</label>
                        <input type="email" class="form-control" id="province_en_input_for_create">
                    </div>
                    <div class="form-group">
                        <label for="province_geography_for_create">ภูมิภาค</label>
                        <select name="" id="province_geography_for_create" class="form-control">
                            @foreach($geographies as $geography)
                                <option value="{{ $geography->id }}">{{ $geography->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="create_province">สร้าง</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Province Modal -->
    <div class="modal fade" tabindex="-1" id="edit_province_modal" role="dialog" aria-labelledby="edit_province_modal_label1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">แก้ไขจังหวัด</h5>
                </div>
                
                <div class="modal-body">
                    <input type="hidden" value="" id="province_id_input">
                    <div class="form-group">
                        <label for="province_th_input">จังหวัดภาษาไทย</label>
                        <input type="email" class="form-control" id="province_th_input">
                    </div>
                    <div class="form-group">
                        <label for="province_en_input">จังหวัดภาษาอังกฤษ</label>
                        <input type="email" class="form-control" id="province_en_input">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">ภูมิภาค</label>
                        <select name="" id="province_geography" class="form-control">
                            @foreach($geographies as $geography)
                                <option value="{{ $geography->id }}">{{ $geography->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="update_province">บันทึก</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                </div>
            </div>
        </div>
    </div>

    <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var geographies = [];

        $(document).ready(function() {
            // getGeographies();

            $('#create_province_btn').click(function(e) {
                e.preventDefault();
                $('#create_province_modal').modal('show');
            });

            $('#create_province').click(function() {
                var data = {
                    'province_th': $('#province_th_input_for_create').val(),
                    'province_en': $('#province_en_input_for_create').val(),
                    'province_geography_id': $('#province_geography_for_create').val()
                };

                if (data.province_th == false || data.province_en == false || data.province_geography_id == false) {
                    $('#create_province_modal').modal('hide');
                    Swal.fire({
                        title: 'เกิดข้อผิดพลาด',
                        text: 'ข้อมูลไม่ครบหรืออาจจะไม่ถูกต้อง',
                        icon: 'error',
                        cancelButtonText: 'ปิด',
                        showCancelButton: true,
                        showConfirmButton: false
                    });
                    return false;
                }

                $.ajax({
                    type: 'POST',
                    url: "{{ route('province.create') }}",
                    data: data,
                    success: function(data) {
                        $('#create_province_modal').modal('hide');
                        // console.log(data);
                        if (data.status == 'success') {
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'สร้างข้อมูลจังใหม่สำเร็จเเล้ว',
                                showConfirmButton: false,
                                timer: 2000
                            }).then((result) => {
                                // console.log('reloaddddddd')
                                location.reload();
                            })
                        } else {
                            Swal.fire({
                                position: 'center',
                                icon: 'error',
                                title: 'เกิดข้อผิดพลาดบางอย่าง',
                                showConfirmButton: false,
                                timer: 2000
                            })
                        }
                    }
                });
            });

            $('.edit_province').click(function(e) {
                e.preventDefault();
                $('#province_th_input').val($(this).attr('data-province-th'))
                $('#province_en_input').val($(this).attr('data-province-en'))
                $('#province_id_input').val($(this).attr('data-province-id'))
                $('#province_geography').val($(this).attr('data-province-geography-id'))
                $('#edit_province_modal').modal('show');
            });

            $('#update_province').click(function() {
                // $('#edit_province_modal').modal('show');
                var data = {
                    'province_id': $('#province_id_input').val(),
                    'province_th': $('#province_th_input').val(),
                    'province_en': $('#province_en_input').val(),
                    'province_geography_id': $('#province_geography').val()
                };

                if (data.province_id == false) {
                    $('#edit_province_modal').modal('hide');
                    Swal.fire({
                        title: 'เกิดข้อผิดพลาด',
                        text: 'หา ID ของจังหวัดไม่เจอ',
                        icon: 'error',
                        cancelButtonText: 'ปิด',
                        showCancelButton: true,
                        showConfirmButton: false
                    });
                    return false;
                }

                // data.province_id = '1000';

                $.ajax({
                    type: 'PATCH',
                    url: "{{ route('province.edit') }}",
                    data: data,
                    success: function(data) {
                        $('#edit_province_modal').modal('hide');
                        // console.log(data);
                        if (data.status == 'success') {
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'บันทึกข้อมูลสำเร็จ',
                                showConfirmButton: false,
                                timer: 2000
                            }).then((result) => {
                                // console.log('reloaddddddd')
                                location.reload();
                            })
                        } else {
                            Swal.fire({
                                position: 'center',
                                icon: 'error',
                                title: 'เกิดช้อผิดพลาดบางอย่าง',
                                showConfirmButton: false,
                                timer: 2000
                            })
                        }
                    }
                });
            });

            $('.delete_province').click(function(e) {
                e.preventDefault();

                var province_id = $(this).attr('data-province-id');

                Swal.fire({
                    // title: 'คุณต้องการลบข้อมูลของจังหวัดใช่หรือไม่?',
                    text: "คุณต้องการลบข้อมูลของจังหวัดใช่หรือไม่?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'ไม่',
                    confirmButtonText: 'ใช่'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        deleteProvice(province_id);
                    }
                })
            });
        });

        function deleteProvice(province_id) {
            $.ajax({
                type: 'DELETE',
                url: "{{ route('province.delete') }}",
                data: { province_id: province_id },
                success: function(data) {
                    if (data.status == 'success') {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'ลบข้อมูลสำเร็จ',
                            showConfirmButton: false,
                            timer: 2000
                        }).then((result) => {
                            location.reload();
                        })
                    } else {
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: 'เกิดข้อผิดพลาดบางอย่าง',
                            showConfirmButton: false,
                            timer: 2000
                        })
                    }
                }
            });
        }

        // function getGeographies() {
        //     $.ajax({
        //         type: 'GET',
        //         url: "{{ route('geographies') }}",
        //         success: function(res) {
        //             if (res.status == 'success') {
        //                 geographies = res.data.geographies;
        //             }
        //         }
        //     });
        // }

    </script>
</body>

</html>