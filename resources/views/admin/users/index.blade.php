@extends('admin.layouts.master')

@section('title', 'Users')
@section('content')
<section class="content-wrapper container-xxl p-0">
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-start mb-0">Users</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active">Users
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content-header row"></div>
    <div class="content-body">
        <section id="basic-datatable">
            <div class="row">
                <div class="col-12">
                    <div class="card pb-1">
                        <table class="table px-1" id="dataTable">
                            <thead>
                                <tr>
                                    <th>Sr.No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
        <div class="modal-size-lg d-inline-block">
            <!--Add Modal -->
            <div class="modal fade text-start" id="add_modal" tabindex="-1" aria-labelledby="myModalLabel17" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel17">Add User</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form class="form" id="add_form">
                            @csrf
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="name">Name</label>
                                            <input type="text" id="name" class="form-control" placeholder="User Name" name="name" required/>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="email">Email</label>
                                            <input type="text" id="email" class="form-control" placeholder="Type Email" name="email" required/>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="phone_number">Phone Number</label>
                                            <input type="number" id="phone_number" class="form-control" placeholder="Phone Number" name="phone_number" required/>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="dob">Date Of Birth</label>
                                            <input type="text" id="dob" class="form-control flatpickr-basic" placeholder="YYYY-MM-DD" name= "dob"/>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="password">Password</label>
                                            <input type="password" id="password" class="form-control" placeholder="Password" name="password" required/>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="password_confirmation">Confirm Password</label>
                                            <input type="password" id="password_confirmation" class="form-control" placeholder="Confirm Password" name="password_confirmation" required/>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="role">Roles</label>
                                            <select name="role" id="role" class="select2 form-select" data-placeholder="Select Role">
                                                <option value=""></option>
                                                @foreach ($roles as $role)
                                                    <option value="{{$role->id}}">{{$role->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="reset" class="btn btn-outline-success">Reset</button>
                                <button type="submit" class="btn btn-primary" id="save">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!--End Add Modal -->

            <!--start edit Modal -->
            <div class="modal fade text-start" id="edit_modal" tabindex="-1" aria-labelledby="myModalLabel17" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel17">Edit User</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form class="form" id="edit_form">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="edit_name">Name</label>
                                            <input type="text" id="edit_name" class="form-control" placeholder="User Name" name="name" required/>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="edit_email">Email</label>
                                            <input type="text" id="edit_email" class="form-control" placeholder="Type Email" name="email" readonly/>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="edit_phone_number">Phone Number</label>
                                            <input type="number" id="edit_phone_number" class="form-control" placeholder="Phone Number" name="phone_number" required/>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="edit_dob">Date Of Birth</label>
                                            <input type="text" id="edit_dob" class="form-control flatpickr-basic" placeholder="YYYY-MM-DD" name= "dob"/>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="edit_role">Roles</label>
                                            <select name="role" id="edit_role" class="select2 form-select" data-placeholder="Select Role">
                                                <option value=""></option>
                                                @foreach ($roles as $role)
                                                    <option value="{{$role->id}}">{{$role->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="reset" class="btn btn-outline-success">Reset</button>
                                <button type="submit" class="btn btn-primary" id="update">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!--End edit Modal -->
        </div>
    </div>
</section>

@endsection
@section('scripts')
    <script>
        var datatable;
        var rowid;
        $(document).ready(function() {
            datatable = $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ordering : false,
                ajax: "{{ route('users.index') }}",
                columns: [
                    {
                        data : 'id'
                    },
                    {
                        data: 'name'
                    },
                    {
                        data: 'email'
                    },
                    {
                        data: '',
                        searchable: false
                    },
                ],
                "columnDefs": [
                    {
                        // Actions
                        targets: -1,
                        title: 'Actions',
                        render: function (data, type, full, meta) {
                            return (
                                '<a href="javascript:;" class="item-edit" onclick=edit('+full.id+')>' +
                                feather.icons['edit'].toSvg({ class: 'font-medium-4' }) +
                                '</a>'
                            );
                        }
                    },
                    {
                        "defaultContent": "-",
                        "targets": "_all"
                    }
                ],
                "order": [[0, 'asc']],
                dom: '<"card-header border-bottom p-1"<"head-label"><"dt-action-buttons text-end"B>><"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
                displayLength: 10,
                lengthMenu: [10, 25, 50, 75, 100],
                buttons: [
                    {
                        extend: 'collection',
                        className: 'btn btn-outline-secondary dropdown-toggle me-1',
                        text: feather.icons['share'].toSvg({ class: 'font-small-4 me-50' }) + 'Export',
                        buttons: [
                            {
                            extend: 'print',
                            text: feather.icons['printer'].toSvg({ class: 'font-small-4 me-50' }) + 'Print',
                            className: 'dropdown-item',
                            exportOptions: { columns: [0,1,2] }
                            },
                            {
                            extend: 'csv',
                            text: feather.icons['file-text'].toSvg({ class: 'font-small-4 me-50' }) + 'Csv',
                            className: 'dropdown-item',
                            exportOptions: { columns: [0,1,2] }
                            },
                            {
                            extend: 'excel',
                            text: feather.icons['file'].toSvg({ class: 'font-small-4 me-50' }) + 'Excel',
                            className: 'dropdown-item',
                            exportOptions: { columns: [0,1,2] }
                            },
                            {
                            extend: 'pdf',
                            text: feather.icons['clipboard'].toSvg({ class: 'font-small-4 me-50' }) + 'Pdf',
                            className: 'dropdown-item',
                            exportOptions: { columns: [0,1,2] }
                            },
                            {
                            extend: 'copy',
                            text: feather.icons['copy'].toSvg({ class: 'font-small-4 me-50' }) + 'Copy',
                            className: 'dropdown-item',
                            exportOptions: { columns: [0,1,2] }
                            }
                        ],
                        init: function (api, node, config) {
                            $(node).removeClass('btn-secondary');
                            $(node).parent().removeClass('btn-group');
                            setTimeout(function () {
                            $(node).closest('.dt-buttons').removeClass('btn-group').addClass('d-inline-flex');
                            }, 50);
                        }
                    },
                    {
                        text: feather.icons['plus'].toSvg({ class: 'me-50 font-small-4' }) + 'Add New',
                        className: 'create-new btn btn-primary me-1',
                        attr: {
                            'data-bs-toggle': 'modal',
                            'data-bs-target': '#add_modal'
                        },
                        init: function (api, node, config) {
                            $(node).removeClass('btn-secondary');
                        }
                    },
                ],
                language: {
                    paginate: {
                    // remove previous & next text from pagination
                    previous: '&nbsp;',
                    next: '&nbsp;'
                    }
                }
            });
            // Filter form control to default size for all tables
            $('.dataTables_filter .form-control').removeClass('form-control-sm');
            $('.dataTables_length .form-select').removeClass('form-select-sm').removeClass('form-control-sm');

            $('div.head-label').html('<h6 class="mb-0">List of Users</h6>');
            $("#add_form").submit(function (e) {
                e.preventDefault();
                $.ajax({
                    url: "{{route('users.store')}}",
                    type: "post",
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    responsive: true,
                    success: function (response) {
                        if(response.errors){
                            $.each( response.errors, function( index, value ){
                                Toast.fire({
                                    icon: 'error',
                                    title: value
                                })
                            });
                        }
                        else if(response.error_message){
                            Toast.fire({
                                icon: 'error',
                                title: 'An error has been occured! Please Contact Administrator.'
                            })
                        }
                        else{
                            $('#add_form')[0].reset();
                            $("#add_modal").modal("hide");
                            datatable.ajax.reload();
                            Toast.fire({
                                icon: 'success',
                                title: 'User has been Added Successfully!'
                            })
                        }
                        
                    }
                });
            });

            // Update record
            $("#edit_form").on("submit", function (e) {
                e.preventDefault();
                $.ajax({
                    url: "{{url('users')}}" + "/" + rowid,
                    type: "post",
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        if(response.errors){
                            $.each( response.errors, function( index, value ){
                                Toast.fire({
                                    icon: 'error',
                                    title: value
                                })
                            });
                        }
                        else if(response.error_message){
                            Toast.fire({
                                icon: 'error',
                                title: 'An error has been occured! Please Contact Administrator.'
                            })
                        }
                        else{
                            $("#edit_modal").modal("hide");
                            datatable.ajax.reload();
                            Toast.fire({
                                icon: 'success',
                                title: 'User has been Updated Successfully!'
                            })
                        }
                        
                    }
                });
            });
        });
        function edit(id) {
            rowid = id;
            $.ajax({
                url: "{{url('users')}}" + "/" + id + "/edit",
                type: "get",
                success: function (response) {
                    $("#edit_name").val(response.name);
                    $("#edit_email").val(response.email);
                    $("#edit_phone_number").val(response.phone_number);
                    $("#edit_dob").val(response.dob);
                    $("#edit_role").val(response.roles[0]['id']).select2();
                    $("#edit_modal").modal("show");
                },
            });
        }
    </script>
@endsection