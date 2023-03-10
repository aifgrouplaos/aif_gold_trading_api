
@extends('layouts.admintheme.content')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">

        <form  method="post" id="uploadForm"  enctype="multipart/form-data">
            @csrf

        <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Add New Customer Information</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
              <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6" style="display: none">

                            </div>
                            <div class="col-md-12">


                                    {{-- <input type="hidden" class="form-control" required
                                   readonly value ="C-{{ $Code }}" >

                                    <input type="hidden" class="form-control" required
                                    name="cus_code" value ="C-{{ $Code }}" > --}}

                                <div class="form-group">
                                    <label for="exampleInputEmail1"> Name</label>
                                    <input type="text" class="form-control" required
                                    id="cus_name"  name="cus_name" placeholder="Enter  Name">
                               </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"> Address</label>
                                    <input type="text" class="form-control" required
                                    id="cus_address"  name="cus_address" placeholder="Enter Address">


                               </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"> Contact</label>
                                    <input type="text" class="form-control" required
                                    id="cus_contact"  name="cus_contact" placeholder="Enter Customer">
                               </div>
                            </div>
                        </div>

                <input type="hidden" name ="token" value="{{ csrf_token() }}"/>
              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
        </form>
    </div>

    <script>
        $(document).ready(function() {
           getdata(); // load first
                  function getdata() {

                    Swal.fire({
                              title: 'Loading Data..',
                              allowEscapeKey: false,
                              allowOutsideClick: false
                            });
                            Swal.showLoading(); //loading

                            $.ajax({
                                    url: "{{route('cus.listCus')}}",
                                    type: 'GET',
                                    data: {},
                                    success: function(response){
                                   $("#response").html(response);
                                  //  alert(response);
                                    Swal.close();
                                    // location.load();
                                    }
                                });

                    };



            $("#uploadForm").submit(function(){
                $.ajaxSetup({
                            headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });


               Swal.fire({
							title: 'Loading Data..',
							allowEscapeKey: false,
							allowOutsideClick: false
						});
						Swal.showLoading();

						$.ajax({
								type: "POST",
								url: "{{route('cus.add')}}",
                                data: $('#uploadForm').serialize(),
							})
							.done(function(data) {
								if(data.trim()=='Create Successfully!'){
                                    Swal.fire({
                                        title: "Success!",
                                        text: data,
                                        icon: "success"
                                    }).then(function() {
                                        $('#uploadForm').trigger("reset");
                                        getdata();
                                   
                                        Swal.close();
                                    });
                                }else{

                                    Swal.fire({
                                        title: "Warning!",
                                        text: data,
                                        icon: "error"
                                    }).then(function() {
                                        Swal.close();
                                    });

                                }

							})
							.fail(function() {
								alert("Posting failed.");
                                Swal.close();

							});
                            return false;
                 });

            });
        </script>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h3 class="m-0">Manage Customer Details</h3>
            <hr>

            <ol class="breadcrumb float-sm-left">
                <li class="breadcrumb-item ">Dashboard </li>
                <li class="breadcrumb-item "><a style="color:#000" href="{{ route("cus.index") }}" > Customer List </a> </li>
                <li class="breadcrumb-item active">
                    <a href="#"  style="color:#6c757d"  data-toggle="modal" data-target="#myModal">
                          Add New Customer Information
                    </a>
            </li>
            </ol>
          </div><!-- /.col -->
          <div class="col-sm-6">


          </div><!-- /.col -->
        </div><!-- /.row -->

      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><b>Customer List </b></h3>
            </div>
            <!-- /.card-header -->

            <div class="card-body">
                 <div class="ribbon-wrapper">
                    <div class="ribbon bg-primary">
                      Customer
                    </div>
                  </div>

                  <div id="response"></div>
            </div>
            <!-- /.card-body -->
        </div>





      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>


@endsection







