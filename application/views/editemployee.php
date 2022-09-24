<!-- partial -->
<div class="main-panel">
        <div class="content-wrapper">
          	<div class="row">
            	<div class="col-sm-12">
            		<div class="home-tab">
						<?php if(validation_errors()){ ?>
							<div class="alert alert-danger" id="notMsg" role="alert">
								<?php echo validation_errors(); ?>
							</div>
						<?php }?>
						<?php if(isset($error)){ ?>
							<div class="alert alert-danger" id="notMsg" role="alert">
								<?php echo $error; ?>
							</div>
						<?php }?>
                		<div class="tab-content tab-content-basic">
                  			<div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
                    			<div class="row">
                      				<div class="col-lg-12 d-flex flex-column">
                        				<div class="row flex-grow">
                          					<div class="col-12 grid-margin stretch-card">
                            					<div class="card card-rounded">
													<div class="card-body">
														<h4 class="card-title">Employee Information Form</h4>
														<p class="card-description">
															Edit Employee
														</p>
														<form class="forms-sample" method="post" action="<?php echo site_url('Employee/editemployeeinfo?for='.$employeeinfo->id);?>" enctype="multipart/form-data">
															<div class="form-group">
																<label>Name</label>
																<input type="text" class="form-control" id="empName" name="empName" placeholder="Employee Name" value="<?php echo $employeeinfo->name;?>">
															</div>
															<div class="form-group">
																<label for="empAge">Age</label>
																<input type="number" class="form-control" id="empAge" name="empAge" min="18" max="60" placeholder="Employee Age" value="<?php echo $employeeinfo->age;?>">
															</div>
															<div class="form-group">
																<label>Email</label>
																<input type="email" class="form-control" id="empEmail" name="empEmail" placeholder="Employee Email" value="<?php echo $employeeinfo->email;?>">
															</div>
															<div class="form-group">
																<label>Date Of Birth</label>
																<input type="date" class="form-control" id="empDob" name="empDob" placeholder="Employee Birth Date" value="<?php echo $employeeinfo->birth_date;?>">
															</div>
															<div class="form-group">
																<label>Address</label>
																<textarea class="form-control" id="empAddress" rows="4" name="empAddress" value=""><?php echo $employeeinfo->address;?></textarea>
															</div>
															<div class="form-group">
																<label>Image</label>
																<!-- <input type="file" name="empimg" class="file-upload-default"> -->
																<div class="input-group col-xs-12">
																	<img src="<?php echo base_url('/uploads/'.$employeeinfo->photo);?>">
																	<!-- <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
																	<span class="input-group-append">
																	<button class="file-upload-browse btn btn-primary" type="button">Upload</button>
																	</span> -->
																</div>
															</div>
															<button type="submit" class="btn btn-primary me-2">Submit</button>
															<a href="<?php echo site_url('Employee/employeeinfo');?>" class="btn btn-light">Cancel</a>
														</form>
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

 <script src="<?php echo base_url('assets/js/file-upload.js');?>"></script>