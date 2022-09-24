    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-sm-12">
              <div class="home-tab">
                <div class="tab-content tab-content-basic">
                  <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
				  	<div class="col-12 grid-margin">
						<div class="card">
							<div class="card-body">
								<h4 class="card-title">Search</h4>
								<form class="form-sample" method="post" action="<?php echo site_url('Employee/employeeinfo');?>">
									<div class="row">
										<div class="col-md-6">
											<div class="form-group row">
												<label class="col-sm-3 col-form-label">Name</label>
												<div class="col-sm-9">
													<input type="text" class="form-control" id="empname" name="empname" placeholder="Employee Name" value="<?php echo $fname;?>">
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group row">
												<!-- <label class="col-sm-3 col-form-label">Name</label> -->
												<div class="col-sm-12">
													<button type="submit" class="btn btn-success me-2">Submit</button>
												</div>
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
                    <div class="row">
                      <div class="col-lg-12 d-flex flex-column">
                        <div class="row flex-grow">
                          <div class="col-12 grid-margin stretch-card">
                            <div class="card card-rounded">
                              <div class="card-body">
                                <div class="d-sm-flex justify-content-between align-items-start">
                                  <div>
                                    <h4 class="card-title card-title-dash">Employee Information</h4>
                                   <!-- <p class="card-subtitle card-subtitle-dash">You have 50+ new requests</p> -->
                                  </div>
                                  <div>
                                    <a href="<?php echo site_url('Employee/createemployee');?>" class="btn btn-primary btn-lg text-white mb-0 me-0">
                                        <i class="mdi mdi-plus-box"></i>Add Employee
                                    </a>
                                  </div>
                                </div>
                                <div class="table-responsive  mt-1">
                                  <table class="table select-table" id="tblemployeeinfo">
                                    <thead>
                                      <tr>
                                        <th>Sr No.</th>
                                        <th>Name</th>
                                        <th>Age</th>
										<th>Email</th>
										<th>Date Of Birth</th>
										<th>Address</th>
										<th>Photo</th>
                                        <th>Action</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            foreach($employeeinfo as $key => $value){

												$imgPath = base_url("/uploads/".$value->photo);

                                                echo    '<tr>
                                                            <td>'.++$key.'</td>
                                                            <td>'.$value->name.'</td>
                                                            <td>'.$value->age.'</td>
															<td>'.$value->email.'</td>
															<td>'.$value->birth_date.'</td>
															<td>'.$value->address.'</td>
															<td><img src="'.$imgPath.'"/></td>
                                                            <td>
																<a href="'.site_url('Employee/editemployeeinfo?for='.$value->id).'">
																	<button class="btn btn-outline-link btn-icon-text">
																		<i class="mdi mdi-pencil-box"></i>
																	</button>
																</a>
                                                                <button class="btn btn-outline-link btn-icon-text deleteEmployee" empId="'.$value->id.'">
                                                                    <i class="ti-trash"></i>
                                                                </button>
                                                            </td>
                                                        </tr>';
                                            }
                                        ?>
                                    </tbody>
                                  </table>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->

<script>
    $(document).ready(function(){

		$('#tblemployeeinfo').DataTable( {
			"pageLength": 20
		});

        $( ".deleteEmployee" ).on( "click", function() {

            var empId = $( this ).attr('empId');

            if (confirm("Do you want to delete") == true) {

              console.log("pressed ok");

              var form_data = { 
                                empId           : empId,
                              };

              $.post( "<?php echo site_url('Employee/deleteEmployee');?>" ,form_data,function(message) {

                alert(message.message);

                if(message.output == "TRUE"){

                  location.reload(true);
                }

              }, 'json');
            }
        });
    });
</script>