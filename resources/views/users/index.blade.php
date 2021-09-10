@extends('layouts.app')
@section('third_party_stylesheets')
    <link href="https://cdn.datatables.net/1.11.2/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/css/tempusdominus-bootstrap-4.css"/>
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 mt-3">
                @include('partials.flash')
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">User List</h3>
                        <div class="card-toolbar float-right">
                            <button class="btn btn-sm btn-success create-user-btn">New User</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="col-12">
                            <form  method="POST">
                                @csrf
                                <div class="row align-items-center">
                                    <div class="col-lg-9 col-xl-10">
                                        <div class="row align-items-center">

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="mr-3 mb-1 d-none font-weight-bold d-md-block">Name:</label>
                                                    <input type="text" class="form-control form-control-sm search_name" name="search_name" placeholder="Search Name ..." />
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="mr-3 mb-1 d-none font-weight-bold d-md-block">Email:</label>
                                                    <input type="text" class="form-control form-control-sm search_email" name="search_email" placeholder="Search Email ..." />
                                                </div>
                                            </div>

                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label class="mr-3 mb-1 d-none font-weight-bold d-md-block">Age:</label>
                                                    <input type="number" class="form-control form-control-sm search_age" name="search_age" placeholder="Age ..." />
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="mr-3 mb-1 d-none font-weight-bold d-md-block">Status:</label>
                                                    <select class="form-control form-control-sm search_status" name="search_status">
                                                        <option value="0" selected>Select Status</option>
                                                        <option value="active">Active</option>
                                                        <option value="blocked">Blocked</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-sm-12 mb-2">
                                                <strong>Note: </strong>On Age search, you will get all the users who are equal to or greater than the age entered.
                                            </div>


                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-xl-2 mt-5 mt-lg-0 text-right">
                                        <a href="javascript:;" class="btn btn-sm btn-danger clear-search">Reset</a>
                                        <button type="button" id="search_status" class="btn btn-sm btn-primary">Search</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <table id="user-list" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                            <tr>
                                <th>Profile Pic</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Age</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- User Create Modal -->
    <div class="modal fade" id="user-create-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form class="form-horizontal" id="user-create-form" method="post" action="{{ route('users.store') }}" enctype= multipart/form-data>
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="manage-title">Create New User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card-body">
                            <input type="hidden" name="_method" value="">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="name" placeholder="Name" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9">
                                    <input type="email" class="form-control" name="email" autocomplete="off" placeholder="Email" />
                                </div>
                            </div>
                            <div class="form-group row password_div">
                                <label for="inputPassword3" class="col-sm-3 col-form-label">Password</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control" name="password" autocomplete="off" placeholder="Password">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Address</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" rows="2" name="address" placeholder="Address"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">DOB</label>
                                <div class="col-sm-9">
                                    <div class="input-group date" id="dob_datepicker" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input" name="dob" data-toggle="datetimepicker" data-target="#dob_datepicker">
{{--                                        <div class="input-group-append" data-target="#dob_datepicker" data-toggle="datetimepicker">--}}
{{--                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>--}}
{{--                                        </div>--}}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Status</label>
                                <div class="col-sm-9">
                                    <div class="custom-control custom-radio d-inline">
                                        <input class="custom-control-input" type="radio" id="customRadio1" value="active" name="status">
                                        <label for="customRadio1" class="custom-control-label">Active</label>
                                    </div>
                                    <div class="custom-control custom-radio d-inline">
                                        <input class="custom-control-input" type="radio" id="customRadio2" value="blocked" name="status">
                                        <label for="customRadio2" class="custom-control-label">Blocked</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Education</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="education" id="education">
                                        <option value="X">X</option>
                                        <option value="XII">XII</option>
                                        <option value="graduate">Graduate</option>
                                        <option value="post-graduate">Post Graduate</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Pin Code</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="pincode" placeholder="PinCode" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Profile Pic</label>
                                <div class="col-sm-9">
                                    <input type="file" name="profile_pic" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Country</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="country" id="country-list">
                                        <option disabled selected value="">Select Countries</option>
                                        @forelse($countries as $country)
                                            <option  value="{{ $country->id }}">{{ $country->country_name }}</option>
                                        @empty
                                            <option disabled selected value="">No Countries</option>
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">City</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="city" id="city-list">
                                        <option disabled selected>Select Country first</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary user_save_btn">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('third_party_scripts')
    <script src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js" ></script>
    <script src="https://cdn.datatables.net/1.11.1/js/dataTables.bootstrap4.min.js" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/js/tempusdominus-bootstrap-4.min.js" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
    <script src="{{ asset('js/custom_style.js') }}"></script>
    <script>
        var table = $('#user-list').DataTable({
            responsive: true,
            orderCellsTop: true,
            fixedHeader: true,
            pageLength: 10,
            ordering: false,
            processing: true,
            serverSide: true,
            searching: true,
            "language": {
                processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw" style="color: #51c951;"></i><span class="sr-only">Loading...</span>'
            },
            ajax: {
                url: "{{ route('users.index') }}",
                type: 'GET',
                data: function (d) {
                    d.s_status = $('.search_status').val();
                    d.s_name = $('.search_name').val();
                    d.s_email = $('.search_email').val();
                    d.s_age = $('.search_age').val();
                },
            },
            columnDefs: [
                { className: 'text-center', targets: [4] },
            ],
            columns: [
                {
                    data: 'profile_pic',
                    name: 'profile_pic',
                    searchable : false,
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'dob',
                    name: 'dob',
                    searchable : false,
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'action',
                    name: 'action',
                    searchable : false,
                },
            ],
            order: [
                [0, 'desc']
            ]
        });
        $(document).on("click", '#search_status', function(event) {
            $('#user-list').DataTable().draw(true);
        });

        $('.create-user-btn').click(function (){

            $('#manage-title').html('Create New User')
            $('input.form-control').val('');
            $('textarea.form-control').html('');
            $('#user-create-modal input').prop('disabled',false);
            $('#user-create-modal textarea').prop('disabled',false);
            $('#user-create-modal select').prop('disabled',false);
            $('.password_div').show();
            $('#customRadio1').prop('checked',true);

            let actionUrl = BASE_URL+'users';
            $('#user-create-form').attr('action',actionUrl)
            $('input[name=_method]').val('POST')
            $('#user-create-modal').modal('show');
        })

        $(document).on("click", '.clear-search', function(event) {
            $('.search_name').val('');
            $('.search_email').val('');
            $('.search_age').val('');
            $('.search_status').val('0');
            table.search('');
            table.columns().search('').columns( '.sold_out' ).search( 'YES' ).draw();
        });

        $(document).delegate('.mange-user', 'click', function() {
            let userid = $(this).data('id');
            let type = $(this).data('type');
            let url = BASE_URL+'users/'+userid+'/edit';
            let actionUrl = BASE_URL+'users/'+userid;
            $('#user-create-form').attr('action',actionUrl)
            $('input[name=_method]').val('PUT')

            if(type == 'view-user'){
                $('#manage-title').html('View User')
                $('#user-create-modal input').prop('disabled',true);
                $('#user-create-modal textarea').prop('disabled',true);
                $('#user-create-modal select').prop('disabled',true);
                $('.user_save_btn').prop('disabled',true);
            }else{
                $('#manage-title').html('Edit User')
                $('#user-create-modal input').prop('disabled',false);
                $('#user-create-modal textarea').prop('disabled',false);
                $('#user-create-modal select').prop('disabled',false);
                $('.user_save_btn').prop('disabled',false);
            }
            $.ajax({
                type: "get",
                dataType: "json",
                url: url,
                statusCode: {500: function () {toastr.error('ERROR: Something Went Wrong !');}},
                cache: false,
                beforeSend: function () {$('#cover-spin').show(0);},
                complete: function () {$('#cover-spin').hide(0);},
                success: function (res) {
                    console.log(res)
                    if (res.status === true) {
                        toastr.success('User Data Loaded.');
                        fillUserDetails(res.data);
                    }else{
                        toastr.error(res.data);
                    }
                },
            });
        })

        function fillUserDetails(data){
            $('input[name=name]').val(data.name);
            $('input[name=email]').val(data.email);
            $('.password_div').hide();
            $('textarea[name=address]').html(data.address);
            $('input[name=dob]').val(data.dob);
            $('#education').val(data.education);
            $('input[name=pincode]').val(data.pin_code);
            $('#country-list').val(data.country_id);

            let url = BASE_URL+"getCities/"+data.country_id;
            loadCities(url);

            $('#city-list').val(data.city_id);
            if(data.status == 'active'){
                $('#customRadio1').prop('checked',true)
            }else{
                $('#customRadio2').prop('checked',true)
            }

            $('#user-create-modal').modal('show');
        }

    </script>
@endsection
