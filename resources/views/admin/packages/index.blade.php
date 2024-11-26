@extends('admin.layouts.app')
@section('content')
    <!--Card content-->

    <div class="card">
        <div class="card-datatable table-responsive pt-0">
            <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                <div class="card-header flex-column flex-md-row">
                    <div class="head-label text-center">
                        <h5 class="card-title mb-0">DataTable with Buttons</h5>
                    </div>
                    <div class="dt-action-buttons text-end pt-3 pt-md-0">
                        <div class="dt-buttons btn-group flex-wrap">
                            <div class="btn-group">
                                <button
                                    class="btn btn-secondary buttons-collection dropdown-toggle btn-label-primary me-4 waves-effect waves-light border-none"
                                    tabindex="0" aria-controls="DataTables_Table_0" type="button" aria-haspopup="dialog"
                                    aria-expanded="false"><span><i class="ri-external-link-line me-sm-1"></i> <span
                                            class="d-none d-sm-inline-block">Export</span></span>
                                </button>
                            </div>
                            <a href="{{route('package.store')}}">Add</a>
                            {{-- <a class="btn   btn-secondary create-new btn-primary waves-light" href="{{route('package.store')}}"><span><i class="ri-add-line"></i> <span
                                class="d-none d-sm-inline-block">Add New
                                Record</span></span></a> --}}
                            
                        </div>
                    </div>
                </div>
                <hr class="my-0">
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="dataTables_length" id="DataTables_Table_0_length">
                            <label>Show
                                <select name="DataTables_Table_0_length" aria-controls="DataTables_Table_0"
                                    class="form-select form-select-sm">
                                    <option value="7">7</option>
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="75">75</option>
                                    <option value="100">100</option>
                                </select> entries</label>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end">
                        <div id="DataTables_Table_0_filter" class="dataTables_filter">
                            <label>Search:
                                <input type="search" class="form-control form-control-sm" placeholder=""
                                    aria-controls="DataTables_Table_0">
                            </label>
                        </div>
                    </div>
                </div>
                <table class="datatables-basic table table-bordered dataTable no-footer dtr-column" id="DataTables_Table_0"
                    aria-describedby="DataTables_Table_0_info" style="width: 1281px;">
                    <thead>
                        <tr>
                            <th class="control sorting_disabled dtr-hidden" rowspan="1" colspan="1"
                                style="width: 0px; display: none;" aria-label=""></th>
                            <th class="sorting_disabled dt-checkboxes-cell dt-checkboxes-select-all" rowspan="1"
                                colspan="1" style="width: 18px;" data-col="1" aria-label="">
                                <input type="checkbox" class="form-check-input">
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                colspan="1" style="width: 291px;" aria-label="Name: activate to sort column ascending">
                                Name</th>
                            {{-- <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                colspan="1" style="width: 277px;" aria-label="Email: activate to sort column ascending">
                                Email</th> --}}
                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                colspan="1" style="width: 95px;" aria-label="Date: activate to sort column ascending">
                                Date</th>
                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                colspan="1" style="width: 90px;" aria-label="Salary: activate to sort column ascending">
                                Salary</th>
                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                colspan="1" style="width: 117px;" aria-label="Status: activate to sort column ascending">
                                Status</th>
                            <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 87px;"
                                aria-label="Actions">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="odd">
                            <td class="  control" tabindex="0" style="display: none;"></td>
                            <td class="  dt-checkboxes-cell">
                                <input type="checkbox" class="dt-checkboxes form-check-input">
                            </td>
                            <td>
                                <div class="d-flex justify-content-start align-items-center user-name">
                                    <div class="avatar-wrapper">
                                        <div class="avatar me-2"><span
                                                class="avatar-initial rounded-circle bg-label-primary">GG</span>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column"><span class="emp_name text-truncate h6 mb-0">Glyn
                                            Giacoppo</span><small class="emp_post text-truncate">Software Test
                                            Engineer</small></div>
                                </div>
                            </td>
                            <td>ggiacoppo2r@apache.org</td>
                            <td>04/15/2021</td>
                            <td>$24973.48</td>
                            <td><span class="badge rounded-pill  bg-label-success">Professional</span></td>
                            <td>
                                <div class="d-inline-block"><a href="javascript:;"
                                        class="btn btn-sm btn-text-secondary rounded-pill btn-icon dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown"><i class="ri-more-2-line ri-22px"></i></a>
                                    <ul class="dropdown-menu dropdown-menu-end m-0">
                                        <li><a href="javascript:;" class="dropdown-item">Details</a></li>
                                        <li><a href="javascript:;" class="dropdown-item">Archive</a></li>
                                        <div class="dropdown-divider"></div>
                                        <li><a href="javascript:;"
                                                class="dropdown-item text-danger delete-record">Delete</a></li>
                                    </ul>
                                </div>
                                <a href="javascript:;"
                                    class="btn btn-sm btn-text-secondary rounded-pill btn-icon item-edit"><i
                                        class="ri-edit-box-line ri-22px"></i></a>
                            </td>
                        </tr>
                        <tr class="even">
                            <td class="  control" tabindex="0" style="display: none;"></td>
                            <td class="  dt-checkboxes-cell">
                                <input type="checkbox" class="dt-checkboxes form-check-input">
                            </td>
                            <td>
                                <div class="d-flex justify-content-start align-items-center user-name">
                                    <div class="avatar-wrapper">
                                        <div class="avatar me-2"><img src="../../assets/img/avatars/10.png"
                                                alt="Avatar" class="rounded-circle"></div>
                                    </div>
                                    <div class="d-flex flex-column"><span
                                            class="emp_name text-truncate h6 mb-0">Evangelina Carnock</span><small
                                            class="emp_post text-truncate">Cost Accountant</small></div>
                                </div>
                            </td>
                            <td>ecarnock2q@washington.edu</td>
                            <td>01/26/2021</td>
                            <td>$23704.82</td>
                            <td><span class="badge rounded-pill  bg-label-warning">Resigned</span></td>
                            <td>
                                <div class="d-inline-block"><a href="javascript:;"
                                        class="btn btn-sm btn-text-secondary rounded-pill btn-icon dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown"><i class="ri-more-2-line ri-22px"></i></a>
                                    <ul class="dropdown-menu dropdown-menu-end m-0">
                                        <li><a href="javascript:;" class="dropdown-item">Details</a></li>
                                        <li><a href="javascript:;" class="dropdown-item">Archive</a></li>
                                        <div class="dropdown-divider"></div>
                                        <li><a href="javascript:;"
                                                class="dropdown-item text-danger delete-record">Delete</a></li>
                                    </ul>
                                </div>
                                <a href="javascript:;"
                                    class="btn btn-sm btn-text-secondary rounded-pill btn-icon item-edit"><i
                                        class="ri-edit-box-line ri-22px"></i></a>
                            </td>
                        </tr>

                        <tr class="odd">
                            <td class="  control" tabindex="0" style="display: none;"></td>
                            <td class="  dt-checkboxes-cell">
                                <input type="checkbox" class="dt-checkboxes form-check-input">
                            </td>
                            <td>
                                <div class="d-flex justify-content-start align-items-center user-name">
                                    <div class="avatar-wrapper">
                                        <div class="avatar me-2"><img src="../../assets/img/avatars/7.png" alt="Avatar"
                                                class="rounded-circle"></div>
                                    </div>
                                    <div class="d-flex flex-column"><span class="emp_name text-truncate h6 mb-0">Olivette
                                            Gudgin</span><small class="emp_post text-truncate">Paralegal</small></div>
                                </div>
                            </td>
                            <td>ogudgin2p@gizmodo.com</td>
                            <td>04/09/2021</td>
                            <td>$15211.60</td>
                            <td><span class="badge rounded-pill  bg-label-success">Professional</span></td>
                            <td>
                                <div class="d-inline-block"><a href="javascript:;"
                                        class="btn btn-sm btn-text-secondary rounded-pill btn-icon dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown"><i class="ri-more-2-line ri-22px"></i></a>
                                    <ul class="dropdown-menu dropdown-menu-end m-0">
                                        <li><a href="javascript:;" class="dropdown-item">Details</a></li>
                                        <li><a href="javascript:;" class="dropdown-item">Archive</a></li>
                                        <div class="dropdown-divider"></div>
                                        <li><a href="javascript:;"
                                                class="dropdown-item text-danger delete-record">Delete</a></li>
                                    </ul>
                                </div><a href="javascript:;"
                                    class="btn btn-sm btn-text-secondary rounded-pill btn-icon item-edit"><i
                                        class="ri-edit-box-line ri-22px"></i></a>
                            </td>
                        </tr>
                        <tr class="even">
                            <td class="  control" tabindex="0" style="display: none;"></td>
                            <td class="  dt-checkboxes-cell">
                                <input type="checkbox" class="dt-checkboxes form-check-input">
                            </td>
                            <td>
                                <div class="d-flex justify-content-start align-items-center user-name">
                                    <div class="avatar-wrapper">
                                        <div class="avatar me-2"><span
                                                class="avatar-initial rounded-circle bg-label-dark">RP</span></div>
                                    </div>
                                    <div class="d-flex flex-column"><span class="emp_name text-truncate h6 mb-0">Reina
                                            Peckett</span><small class="emp_post text-truncate">Quality Control
                                            Specialist</small></div>
                                </div>
                            </td>
                            <td>rpeckett2o@timesonline.co.uk</td>
                            <td>05/20/2021</td>
                            <td>$16619.40</td>
                            <td><span class="badge rounded-pill  bg-label-warning">Resigned</span></td>
                            <td>
                                <div class="d-inline-block"><a href="javascript:;"
                                        class="btn btn-sm btn-text-secondary rounded-pill btn-icon dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown"><i class="ri-more-2-line ri-22px"></i></a>
                                    <ul class="dropdown-menu dropdown-menu-end m-0">
                                        <li><a href="javascript:;" class="dropdown-item">Details</a></li>
                                        <li><a href="javascript:;" class="dropdown-item">Archive</a></li>
                                        <div class="dropdown-divider"></div>
                                        <li><a href="javascript:;"
                                                class="dropdown-item text-danger delete-record">Delete</a></li>
                                    </ul>
                                </div><a href="javascript:;"
                                    class="btn btn-sm btn-text-secondary rounded-pill btn-icon item-edit"><i
                                        class="ri-edit-box-line ri-22px"></i></a>
                            </td>
                        </tr>
                        <tr class="odd">
                            <td class="  control" tabindex="0" style="display: none;"></td>
                            <td class="  dt-checkboxes-cell">
                                <input type="checkbox" class="dt-checkboxes form-check-input">
                            </td>
                            <td>
                                <div class="d-flex justify-content-start align-items-center user-name">
                                    <div class="avatar-wrapper">
                                        <div class="avatar me-2"><span
                                                class="avatar-initial rounded-circle bg-label-success">AB</span>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column"><span class="emp_name text-truncate h6 mb-0">Alaric
                                            Beslier</span><small class="emp_post text-truncate">Tax Accountant</small>
                                    </div>
                                </div>
                            </td>
                            <td>abeslier2n@zimbio.com</td>
                            <td>04/16/2021</td>
                            <td>$19366.53</td>
                            <td><span class="badge rounded-pill  bg-label-warning">Resigned</span></td>
                            <td>
                                <div class="d-inline-block"><a href="javascript:;"
                                        class="btn btn-sm btn-text-secondary rounded-pill btn-icon dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown"><i class="ri-more-2-line ri-22px"></i></a>
                                    <ul class="dropdown-menu dropdown-menu-end m-0">
                                        <li><a href="javascript:;" class="dropdown-item">Details</a></li>
                                        <li><a href="javascript:;" class="dropdown-item">Archive</a></li>
                                        <div class="dropdown-divider"></div>
                                        <li><a href="javascript:;"
                                                class="dropdown-item text-danger delete-record">Delete</a></li>
                                    </ul>
                                </div><a href="javascript:;"
                                    class="btn btn-sm btn-text-secondary rounded-pill btn-icon item-edit"><i
                                        class="ri-edit-box-line ri-22px"></i></a>
                            </td>
                        </tr>
                        <tr class="even">
                            <td class="  control" tabindex="0" style="display: none;"></td>
                            <td class="  dt-checkboxes-cell">
                                <input type="checkbox" class="dt-checkboxes form-check-input">
                            </td>
                            <td>
                                <div class="d-flex justify-content-start align-items-center user-name">
                                    <div class="avatar-wrapper">
                                        <div class="avatar me-2"><img src="../../assets/img/avatars/2.png" alt="Avatar"
                                                class="rounded-circle"></div>
                                    </div>
                                    <div class="d-flex flex-column"><span class="emp_name text-truncate h6 mb-0">Edwina
                                            Ebsworth</span><small class="emp_post text-truncate">Human Resources
                                            Assistant</small></div>
                                </div>
                            </td>
                            <td>eebsworth2m@sbwire.com</td>
                            <td>09/27/2021</td>
                            <td>$19586.23</td>
                            <td><span class="badge rounded-pill bg-label-primary">Current</span></td>
                            <td>
                                <div class="d-inline-block"><a href="javascript:;"
                                        class="btn btn-sm btn-text-secondary rounded-pill btn-icon dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown"><i class="ri-more-2-line ri-22px"></i></a>
                                    <ul class="dropdown-menu dropdown-menu-end m-0">
                                        <li><a href="javascript:;" class="dropdown-item">Details</a></li>
                                        <li><a href="javascript:;" class="dropdown-item">Archive</a></li>
                                        <div class="dropdown-divider"></div>
                                        <li><a href="javascript:;"
                                                class="dropdown-item text-danger delete-record">Delete</a></li>
                                    </ul>
                                </div><a href="javascript:;"
                                    class="btn btn-sm btn-text-secondary rounded-pill btn-icon item-edit"><i
                                        class="ri-edit-box-line ri-22px"></i></a>
                            </td>
                        </tr>
                        <tr class="odd">
                            <td class="  control" tabindex="0" style="display: none;"></td>
                            <td class="  dt-checkboxes-cell">
                                <input type="checkbox" class="dt-checkboxes form-check-input">
                            </td>
                            <td>
                                <div class="d-flex justify-content-start align-items-center user-name">
                                    <div class="avatar-wrapper">
                                        <div class="avatar me-2"><span
                                                class="avatar-initial rounded-circle bg-label-info">RH</span></div>
                                    </div>
                                    <div class="d-flex flex-column"><span class="emp_name text-truncate h6 mb-0">Ronica
                                            Hasted</span><small class="emp_post text-truncate">Software Consultant</small>
                                    </div>
                                </div>
                            </td>
                            <td>rhasted2l@hexun.com</td>
                            <td>07/04/2021</td>
                            <td>$24866.66</td>
                            <td><span class="badge rounded-pill  bg-label-warning">Resigned</span></td>
                            <td>
                                <div class="d-inline-block"><a href="javascript:;"
                                        class="btn btn-sm btn-text-secondary rounded-pill btn-icon dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown"><i class="ri-more-2-line ri-22px"></i></a>
                                    <ul class="dropdown-menu dropdown-menu-end m-0">
                                        <li><a href="javascript:;" class="dropdown-item">Details</a></li>
                                        <li><a href="javascript:;" class="dropdown-item">Archive</a></li>
                                        <div class="dropdown-divider"></div>
                                        <li><a href="javascript:;"
                                                class="dropdown-item text-danger delete-record">Delete</a></li>
                                    </ul>
                                </div><a href="javascript:;"
                                    class="btn btn-sm btn-text-secondary rounded-pill btn-icon item-edit"><i
                                        class="ri-edit-box-line ri-22px"></i></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">
                            Showing 1 to 7 of 100 entries</div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate">
                            <ul class="pagination">
                                <li class="paginate_button page-item previous disabled" id="DataTables_Table_0_previous">
                                    <a aria-controls="DataTables_Table_0" aria-disabled="true" role="link"
                                        data-dt-idx="previous" tabindex="-1" class="page-link">Previous</a>
                                </li>
                                <li class="paginate_button page-item active"><a href="#"
                                        aria-controls="DataTables_Table_0" role="link" aria-current="page"
                                        data-dt-idx="0" tabindex="0" class="page-link">1</a></li>
                                <li class="paginate_button page-item "><a href="#"
                                        aria-controls="DataTables_Table_0" role="link" data-dt-idx="1" tabindex="0"
                                        class="page-link">2</a></li>
                                <li class="paginate_button page-item "><a href="#"
                                        aria-controls="DataTables_Table_0" role="link" data-dt-idx="2" tabindex="0"
                                        class="page-link">3</a></li>
                                <li class="paginate_button page-item "><a href="#"
                                        aria-controls="DataTables_Table_0" role="link" data-dt-idx="3" tabindex="0"
                                        class="page-link">4</a></li>
                                <li class="paginate_button page-item "><a href="#"
                                        aria-controls="DataTables_Table_0" role="link" data-dt-idx="4" tabindex="0"
                                        class="page-link">5</a></li>
                                <li class="paginate_button page-item disabled" id="DataTables_Table_0_ellipsis"><a
                                        aria-controls="DataTables_Table_0" aria-disabled="true" role="link"
                                        data-dt-idx="ellipsis" tabindex="-1" class="page-link">…</a></li>
                                <li class="paginate_button page-item "><a href="#"
                                        aria-controls="DataTables_Table_0" role="link" data-dt-idx="14"
                                        tabindex="0" class="page-link">15</a></li>
                                <li class="paginate_button page-item next" id="DataTables_Table_0_next"><a href="#"
                                        aria-controls="DataTables_Table_0" role="link" data-dt-idx="next"
                                        tabindex="0" class="page-link">Next</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div style="width: 1%;"></div>
            </div>
        </div>
    </div>
    <!-- End Card content-->

    <!-- add form offcanvas -->

    <div class="offcanvas offcanvas-end" id="add-new-record" role="dialog">
        <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title" id="exampleModalLabel">Add Package</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body flex-grow-1">
            <form class="add-new-record pt-0 row g-3 fv-plugins-bootstrap5 fv-plugins-framework" id="form-add-new-record"
                onsubmit="return false" novalidate="novalidate">
                <div class="col-sm-12 fv-plugins-icon-container">
                    <div class="input-group input-group-merge">
                        <span id="basicFullname2" class="input-group-text"><i class="ri-user-line ri-18px"></i></span>
                        <div class="form-floating form-floating-outline">
                            <input type="text" id="basicFullname" class="form-control dt-full-name"
                                name="basicFullname" placeholder="John Doe" aria-label="John Doe"
                                aria-describedby="basicFullname2">
                            <label for="basicFullname">Full Name</label>
                        </div>
                    </div>
                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                    </div>
                </div>
                <div class="mb-5">
                    <input class="form-control" type="file" id="ecommerce-category-image">
                </div>

                <div class="col-sm-12 fv-plugins-icon-container">
                    <div class="input-group input-group-merge">
                        <span id="basicPost2" class="input-group-text"><i class="ri-briefcase-line ri-18px"></i></span>
                        <div class="form-floating form-floating-outline">
                            <input type="text" id="basicPost" name="basicPost" class="form-control dt-post"
                                placeholder="Web Developer" aria-label="Web Developer" aria-describedby="basicPost2">
                            <label for="basicPost">Description</label>
                        </div>
                    </div>
                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                    </div>
                </div>
                <div class="col-sm-12 fv-plugins-icon-container">
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class="ri-mail-line ri-18px"></i></span>
                        <div class="form-floating form-floating-outline">
                            <input type="text" id="basicEmail" name="basicEmail" class="form-control dt-email"
                                placeholder="john.doe@example.com" aria-label="john.doe@example.com">
                            <label for="basicEmail">Email</label>
                        </div>
                    </div>
                    <div class="form-text">
                        You can use letters, numbers &amp; periods
                    </div>
                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                    </div>
                </div>
                <div class="col-sm-12 fv-plugins-icon-container">
                    <div class="input-group input-group-merge">
                        <span id="basicDate2" class="input-group-text"><i class="ri-calendar-2-line ri-18px"></i></span>
                        <div class="form-floating form-floating-outline">
                            <input type="text" class="form-control dt-date flatpickr-input" id="basicDate"
                                name="basicDate" aria-describedby="basicDate2" placeholder="MM/DD/YYYY"
                                aria-label="MM/DD/YYYY" readonly="readonly">
                            <label for="basicDate">Joining Date</label>
                        </div>
                    </div>
                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                    </div>
                </div>
                <div class="col-sm-12 fv-plugins-icon-container">
                    <div class="input-group input-group-merge">
                        <span id="basicSalary2" class="input-group-text"><i
                                class="ri-money-dollar-circle-line ri-18px"></i></span>
                        <div class="form-floating form-floating-outline">
                            <input type="number" id="basicSalary" name="basicSalary" class="form-control dt-salary"
                                placeholder="12000" aria-label="12000" aria-describedby="basicSalary2">
                            <label for="basicSalary">Salary</label>
                        </div>
                    </div>
                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                    </div>
                </div>
                <div class="col-sm-12">
                    <button type="submit"
                        class="btn btn-primary data-submit me-sm-4 me-1 waves-effect waves-light">Submit</button>
                    <button type="reset" class="btn btn-outline-secondary waves-effect"
                        data-bs-dismiss="offcanvas">Cancel</button>
                </div>
                <input type="hidden">
            </form>

        </div>
    </div>
@endsection
