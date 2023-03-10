

@include('layouts.admintheme.datatable')

<meta name="csrf-token" content="{{ csrf_token() }}" />

<table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th width="25px">No</th>
            <th width="55px">Cus_Code</th>
            <th> Name</th>
            <th>cus_address</th>
            <th>Contact</th>
            <th>Create_Date</th>
            <th>Update_Date</th>
            <th>Update_By</th>
            <th width="100px">Option</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1;
         ?>

        @foreach ($customerList as $key => $val)
        <tr>
            <td align ='center' style="vertical-align: middle"> {{$no++}}</td>
            <td style="vertical-align: middle">{{$val->cus_code}}</td>
            <td style="vertical-align: middle">{{$val->cus_name}}</td>
            <td style="vertical-align: middle">{{$val->cus_address}}</td>
            <td style="vertical-align: middle">{{$val->cus_contact}}</td>
            <td style="vertical-align: middle">{{date('F jS, Y H:i:s', strtotime($val->create_date));}}</td>
            <td style="vertical-align: middle">{{date('F jS, Y H:i:s', strtotime($val->updated_at));}}</td>
            <td style="vertical-align: middle">{{$val->userFullname}}</td>
            <td ALIGN="center">

                <a href="#" data-toggle="modal" data-target="#myModal{{ $val->cid }}"
                     class="btn btn-sm" title="Edit User"><i class="fas fa-edit"></i></a>


                    <button type="submit" id="{{ $val->cid }}_{{ $val->cus_name }}"
                    class="btn  btn-sm delete" title="Delete User"><i class="fas fa-trash-alt"></i></button>

            </td>

        </tr >


        <!-- Modal -->
    <div id="myModal{{ $val->cid }}" class="modal fade" role="dialog">



        <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Update Customer Information</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
              <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6" style="display: none">

                            </div>
                            <div class="col-md-12">



                                <div class="form-group">
                                    <label for="exampleInputEmail1"> Name</label>
                                    <input type="text" class="form-control" required
                                    id="cus_name{{ $val->cid }}"  value="{{$val->cus_name}}"
                                     name="cus_name" placeholder="Enter  Name">
                               </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"> cus_address</label>
                                    <input type="text" class="form-control" required value="{{$val->cus_address}}"
                                    id="cus_address{{ $val->cid }}"  name="cus_address" placeholder="Enter cus_address">


                               </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"> Contact</label>
                                    <input type="text" class="form-control" required
                                    value="{{$val->cus_contact}}"
                                    id="cus_contact{{ $val->cid }}"  name="cus_contact" placeholder="Enter Customer">
                               </div>
                            </div>
                        </div>

                <input type="hidden" name ="token" value="{{ csrf_token() }}"/>
              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary editdata" id="{{ $val->cid }}_{{ $val->userFullname }}">Save changes</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>

    </div>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th width="25px">No</th>
            <th width="55px">Cus_Code</th>
            <th> Name</th>
            <th>cus_address</th>
            <th>Contact</th>
            <th>Create_Date</th>
            <th>Update_Date</th>
            <th>Update_By</th>
            <th width="100px">Option</th>
        </tr>
    </tfoot>
</table>


<script>
	$(document).ready(function() {
        function getdata() {
                    Swal.fire({
							title: 'Loading Data..',
							allowEscapeKey: false,
							allowOutsideClick: false
						});
						Swal.showLoading();
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
                                //  /  alert(response);
                                    Swal.close();
                                    }
                                });

                    };

     $(".editdata").on('click', function(event) {
                 $.ajaxSetup({
                            headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
              var el = this;
              var id = this.id;
              var splitid = id.split("_");
              var id = splitid[0];
              //alert(id);
              cus_name =$('#cus_name'+id).val();
              //ccode= $('#ccode'+id).val();
              cus_contact= $('#cus_contact'+id).val();
              cus_address= $('#cus_address'+id).val();

            // alert(cus_name + " " + ccode + " " + contact + " " + cus_address );

              var  data = {
                id: id,
                cus_name: cus_name,
                cus_contact: cus_contact,
                cus_address:cus_address
            }
                  $.ajax({
                                type: "POST",
                                url: "{{ route('cus.update') }}",
                                data: data
                            })
                            .done(function(res) {

                                if(res.trim()=='Update Successfully!'){
                                   Swal.fire({
                                        title: "Success!",
                                        text: res,
                                        icon: "success"
                                    }).then(function() {
                                        $('.modal').modal('hide') ;// closes all active pop ups.
                                        $('.modal-backdrop').remove() ;
                                        getdata();
                                        Swal.close();
                                    });
                                }

                            })
                            .fail(function() {
                                alert("Posting failed.");
                            });
              return false;


          });

        $("#example1").on("click", ".delete", function(){
              var el = this;
              var id = this.id;
              var splitid = id.split("_");
              var name = splitid[1];
              var deleteid = splitid[0];

                                        Swal.fire({
                                          icon: "warning",
                                          title: "Are you sure you want to delete " + name + " ?",

                                          showDenyButton: true,
                                          showCancelButton: false,
                                          confirmButtonText: 'Yes',
                                          denyButtonText: 'No',
                                          customClass: {
                                            actions: 'my-actions',
                                            cancelButton: 'order-1 right-gap',
                                            confirmButton: 'order-2',
                                            denyButton: 'order-3',
                                          }
                                        }).then((result) => {
                                          if (result.isConfirmed) {
                                            $.ajax({

                                                url:"{{ url('/Dashboard/Remove/Customer') }}" + '/' + deleteid,
                                                type: 'GET',
                                               // data: {},
                                                success: function(response){

                                                    $(el).closest('tr').css('background','tomato');
                                                        $(el).closest('tr').fadeOut(700, function(){
                                                            $(this).remove();
                                                        });
                                                Swal.close();

                                                }
                                            });


                                          }


                          });
                          return false;
          });
    });
</script>
