@extends('admin.layouts.app')
@section('content')
 <div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row g-6 justify-content-center">
            <!-- Form controls -->
            <div class="col-md-12">
              <div class="card">
                <h5 class="card-header">Edit Record</h5>
                <div class="card-body demo-vertical-spacing demo-only-element">
    
                    <form class="add-new-record pt-0 row g-3 fv-plugins-bootstrap5 fv-plugins-framework" id="form-add-new-record" onsubmit="return false" novalidate="novalidate">
                        <div class="col-sm-12 fv-plugins-icon-container">
                            <div class="input-group input-group-merge">
                                <span id="basicFullname2" class="input-group-text"><i class="ri-user-line ri-18px"></i></span>
                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="basicFullname" class="form-control dt-full-name" name="basicFullname" placeholder="John Doe" aria-label="John Doe" aria-describedby="basicFullname2">
                                    <label for="basicFullname">Full Name</label>
                                </div>
                            </div>
                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                        </div>
                        <div class="col-sm-12 fv-plugins-icon-container">
                            <div class="input-group input-group-merge">
                                <span id="basicPost2" class="input-group-text"><i class="ri-briefcase-line ri-18px"></i></span>
                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="basicPost" name="basicPost" class="form-control dt-post" placeholder="Web Developer" aria-label="Web Developer" aria-describedby="basicPost2">
                                    <label for="basicPost">Post</label>
                                </div>
                            </div>
                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                        </div>
                        <div class="col-sm-12 fv-plugins-icon-container">
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="ri-mail-line ri-18px"></i></span>
                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="basicEmail" name="basicEmail" class="form-control dt-email" placeholder="john.doe@example.com" aria-label="john.doe@example.com">
                                    <label for="basicEmail">Email</label>
                                </div>
                            </div>
                            <div class="form-text">
                                You can use letters, numbers &amp; periods
                            </div>
                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                        </div>
                        <div class="col-sm-12 fv-plugins-icon-container">
                            <div class="input-group input-group-merge">
                                <span id="basicDate2" class="input-group-text"><i class="ri-calendar-2-line ri-18px"></i></span>
                                <div class="form-floating form-floating-outline">
                                    <input type="text" class="form-control dt-date flatpickr-input" id="basicDate" name="basicDate" aria-describedby="basicDate2" placeholder="MM/DD/YYYY" aria-label="MM/DD/YYYY" readonly="readonly">
                                    <label for="basicDate">Joining Date</label>
                                </div>
                            </div>
                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                        </div>
                        <div class="col-sm-12 fv-plugins-icon-container">
                            <div class="input-group input-group-merge">
                                <span id="basicSalary2" class="input-group-text"><i class="ri-money-dollar-circle-line ri-18px"></i></span>
                                <div class="form-floating form-floating-outline">
                                    <input type="number" id="basicSalary" name="basicSalary" class="form-control dt-salary" placeholder="12000" aria-label="12000" aria-describedby="basicSalary2">
                                    <label for="basicSalary">Salary</label>
                                </div>
                            </div>
                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                        </div>
                        <div class="col-sm-12 text-center">
                            <button type="submit" class="btn btn-primary data-submit me-sm-4 me-1 waves-effect waves-light">Submit</button>
                            <button type="reset" class="btn btn-outline-secondary waves-effect" data-bs-dismiss="offcanvas">Cancel</button>
                        </div>
                        <input type="hidden">
                    </form>
    
    
    
                </div>
              </div>
            </div>
    
    
    
    
    
          </div>
    </div>
    </div>
@endsection