<?php include __DIR__ . '/../partials/header.php' ?>

<body>
    <!-- Top Navbar -->
    <?php include __DIR__ . '/../partials/nav.php' ?>

    <!-- Sidebar Navigation -->
    <?php include __DIR__ . '/admin-sidebar.php' ?>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Dashboard Header -->
        <?php include __DIR__ . '/admin-dashboard-header.php' ?>
        <!-- here -->
        <div class="row justify-content-center">
            <div class="col-12">
                <!-- Header -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="text-danger mb-0">
                        <i class="bi bi-calendar3-event-fill me-2"></i>
                        Reservations (10 Pending)
                    </h2>
                    <button class="btn btn-outline-danger">
                        <i class="bi bi-plus-circle me-2"></i> New Reservation
                    </button>
                </div>

                <!-- Table Container -->
                <div class="card shadow-lg border-0 overflow-hidden">
                    <div class="card-header bg-danger text-white py-3">
                        <h5 class="mb-0 fw-bold">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i>
                            Urgent Action Required
                        </h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-danger table-hover mb-0 align-middle">
                                <thead class="table-dark sticky-top">
                                    <tr>
                                        <th scope="col" class="border-0 py-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="selectAll">
                                            </div>
                                        </th>
                                        <th scope="col" class="border-0 fw-bold text-white py-3">#</th>
                                        <th scope="col" class="border-0 fw-bold text-white py-3">Customer</th>
                                        <th scope="col" class="border-0 fw-bold text-white py-3">Property</th>
                                        <th scope="col" class="border-0 fw-bold text-white py-3">Check-in</th>
                                        <th scope="col" class="border-0 fw-bold text-white py-3">Check-out</th>
                                        <th scope="col" class="border-0 fw-bold text-white py-3">Total</th>
                                        <th scope="col" class="border-0 fw-bold text-white py-3">Status</th>
                                        <th scope="col" class="border-0 fw-bold text-white py-3">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Row 1 -->
                                    <tr class="border-danger border-bottom">
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox">
                                            </div>
                                        </td>
                                        <th scope="row" class="fw-bold text-danger">1</th>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar bg-danger-subtle rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 40px; height: 40px;">
                                                    <i class="bi bi-person-fill text-danger fs-6"></i>
                                                </div>
                                                <div>
                                                    <div class="fw-bold text-danger">John Smith</div>
                                                    <small class="text-muted">john@email.com</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="fw-semibold text-danger">Ocean View Villa</div>
                                            <small class="text-muted">Miami Beach, FL</small>
                                        </td>
                                        <td><span class="badge bg-danger-subtle text-danger px-3 py-2 fw-semibold">2024-01-15</span></td>
                                        <td><span class="badge bg-warning-subtle text-warning px-3 py-2 fw-semibold">2024-01-20</span></td>
                                        <td><span class="fw-bold text-danger fs-6">$1,250</span></td>
                                        <td><span class="badge bg-danger px-3 py-2 fw-semibold">Pending Payment</span></td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <button class="btn btn-sm btn-outline-danger border-0" title="View">
                                                    <i class="bi bi-eye"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-danger border-0" title="Edit">
                                                    <i class="bi bi-pencil"></i>
                                                </button>
                                                <button class="btn btn-sm btn-danger" title="Cancel">
                                                    <i class="bi bi-x-circle"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Row 2 -->
                                    <tr class="border-danger border-bottom">
                                        <td>
                                            <div class="form-check"><input class="form-check-input" type="checkbox"></div>
                                        </td>
                                        <th scope="row" class="fw-bold text-danger">2</th>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar bg-danger-subtle rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 40px; height: 40px;">
                                                    <i class="bi bi-person-badge-fill text-danger fs-6"></i>
                                                </div>
                                                <div>
                                                    <div class="fw-bold text-danger">Sarah Johnson</div>
                                                    <small class="text-muted">sarah.j@email.com</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="fw-semibold text-danger">Mountain Lodge</div>
                                            <small class="text-muted">Aspen, CO</small>
                                        </td>
                                        <td><span class="badge bg-danger-subtle text-danger px-3 py-2 fw-semibold">2024-01-18</span></td>
                                        <td><span class="badge bg-warning-subtle text-warning px-3 py-2 fw-semibold">2024-01-25</span></td>
                                        <td><span class="fw-bold text-danger fs-6">$2,800</span></td>
                                        <td><span class="badge bg-danger px-3 py-2 fw-semibold">Payment Overdue</span></td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <button class="btn btn-sm btn-outline-danger border-0" title="View"><i class="bi bi-eye"></i></button>
                                                <button class="btn btn-sm btn-outline-danger border-0" title="Edit"><i class="bi bi-pencil"></i></button>
                                                <button class="btn btn-sm btn-danger" title="Cancel"><i class="bi bi-x-circle"></i></button>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Rows 3-10 (Shortened for brevity - same structure) -->
                                    <tr class="border-danger border-bottom">
                                        <td>
                                            <div class="form-check"><input class="form-check-input" type="checkbox"></div>
                                        </td>
                                        <th scope="row" class="fw-bold text-danger">3</th>
                                        <td>
                                            <div class="fw-bold text-danger">Mike Davis</div><small class="text-muted">mike@email.com</small>
                                        </td>
                                        <td>
                                            <div class="fw-semibold text-danger">City Penthouse</div><small class="text-muted">NYC</small>
                                        </td>
                                        <td><span class="badge bg-danger-subtle text-danger px-3 py-2 fw-semibold">2024-01-20</span></td>
                                        <td><span class="badge bg-warning-subtle text-warning px-3 py-2 fw-semibold">2024-01-22</span></td>
                                        <td><span class="fw-bold text-danger fs-6">$950</span></td>
                                        <td><span class="badge bg-danger px-3 py-2 fw-semibold">Pending</span></td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <button class="btn btn-sm btn-outline-danger border-0"><i class="bi bi-eye"></i></button>
                                                <button class="btn btn-sm btn-outline-danger border-0"><i class="bi bi-pencil"></i></button>
                                                <button class="btn btn-sm btn-danger"><i class="bi bi-x-circle"></i></button>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr class="border-danger border-bottom">
                                        <td>
                                            <div class="form-check"><input class="form-check-input" type="checkbox"></div>
                                        </td>
                                        <th scope="row" class="fw-bold text-danger">4</th>
                                        <td>
                                            <div class="fw-bold text-danger">Emily Chen</div><small class="text-muted">emily@email.com</small>
                                        </td>
                                        <td>
                                            <div class="fw-semibold text-danger">Beach House</div><small class="text-muted">Malibu</small>
                                        </td>
                                        <td><span class="badge bg-danger-subtle text-danger px-3 py-2 fw-semibold">2024-01-22</span></td>
                                        <td><span class="badge bg-warning-subtle text-warning px-3 py-2 fw-semibold">2024-01-28</span></td>
                                        <td><span class="fw-bold text-danger fs-6">$3,200</span></td>
                                        <td><span class="badge bg-danger px-3 py-2 fw-semibold">Overdue</span></td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <button class="btn btn-sm btn-outline-danger border-0"><i class="bi bi-eye"></i></button>
                                                <button class="btn btn-sm btn-outline-danger border-0"><i class="bi bi-pencil"></i></button>
                                                <button class="btn btn-sm btn-danger"><i class="bi bi-x-circle"></i></button>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr class="border-danger border-bottom">
                                        <td>
                                            <div class="form-check"><input class="form-check-input" type="checkbox"></div>
                                        </td>
                                        <th scope="row" class="fw-bold text-danger">5</th>
                                        <td>
                                            <div class="fw-bold text-danger">David Wilson</div><small class="text-muted">david@email.com</small>
                                        </td>
                                        <td>
                                            <div class="fw-semibold text-danger">Lake Cabin</div><small class="text-muted">Tahoe</small>
                                        </td>
                                        <td><span class="badge bg-danger-subtle text-danger px-3 py-2 fw-semibold">2024-01-25</span></td>
                                        <td><span class="badge bg-warning-subtle text-warning px-3 py-2 fw-semibold">2024-02-01</span></td>
                                        <td><span class="fw-bold text-danger fs-6">$1,800</span></td>
                                        <td><span class="badge bg-danger px-3 py-2 fw-semibold">Pending</span></td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <button class="btn btn-sm btn-outline-danger border-0"><i class="bi bi-eye"></i></button>
                                                <button class="btn btn-sm btn-outline-danger border-0"><i class="bi bi-pencil"></i></button>
                                                <button class="btn btn-sm btn-danger"><i class="bi bi-x-circle"></i></button>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr class="border-danger border-bottom">
                                        <td>
                                            <div class="form-check"><input class="form-check-input" type="checkbox"></div>
                                        </td>
                                        <th scope="row" class="fw-bold text-danger">6</th>
                                        <td>
                                            <div class="fw-bold text-danger">Lisa Brown</div><small class="text-muted">lisa@email.com</small>
                                        </td>
                                        <td>
                                            <div class="fw-semibold text-danger">Downtown Loft</div><small class="text-muted">Chicago</small>
                                        </td>
                                        <td><span class="badge bg-danger-subtle text-danger px-3 py-2 fw-semibold">2024-01-28</span></td>
                                        <td><span class="badge bg-warning-subtle text-warning px-3 py-2 fw-semibold">2024-01-30</span></td>
                                        <td><span class="fw-bold text-danger fs-6">$750</span></td>
                                        <td><span class="badge bg-danger px-3 py-2 fw-semibold">Payment Due</span></td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <button class="btn btn-sm btn-outline-danger border-0"><i class="bi bi-eye"></i></button>
                                                <button class="btn btn-sm btn-outline-danger border-0"><i class="bi bi-pencil"></i></button>
                                                <button class="btn btn-sm btn-danger"><i class="bi bi-x-circle"></i></button>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr class="border-danger border-bottom">
                                        <td>
                                            <div class="form-check"><input class="form-check-input" type="checkbox"></div>
                                        </td>
                                        <th scope="row" class="fw-bold text-danger">7</th>
                                        <td>
                                            <div class="fw-bold text-danger">Robert Taylor</div><small class="text-muted">rob@email.com</small>
                                        </td>
                                        <td>
                                            <div class="fw-semibold text-danger">Luxury Suite</div><small class="text-muted">Vegas</small>
                                        </td>
                                        <td><span class="badge bg-danger-subtle text-danger px-3 py-2 fw-semibold">2024-02-01</span></td>
                                        <td><span class="badge bg-warning-subtle text-warning px-3 py-2 fw-semibold">2024-02-05</span></td>
                                        <td><span class="fw-bold text-danger fs-6">$2,500</span></td>
                                        <td><span class="badge bg-danger px-3 py-2 fw-semibold">Pending</span></td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <button class="btn btn-sm btn-outline-danger border-0"><i class="bi bi-eye"></i></button>
                                                <button class="btn btn-sm btn-outline-danger border-0"><i class="bi bi-pencil"></i></button>
                                                <button class="btn btn-sm btn-danger"><i class="bi bi-x-circle"></i></button>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr class="border-danger border-bottom">
                                        <td>
                                            <div class="form-check"><input class="form-check-input" type="checkbox"></div>
                                        </td>
                                        <th scope="row" class="fw-bold text-danger">8</th>
                                        <td>
                                            <div class="fw-bold text-danger">Maria Garcia</div><small class="text-muted">maria@email.com</small>
                                        </td>
                                        <td>
                                            <div class="fw-semibold text-danger">Country Cottage</div><small class="text-muted">Napa Valley</small>
                                        </td>
                                        <td><span class="badge bg-danger-subtle text-danger px-3 py-2 fw-semibold">2024-02-03</span></td>
                                        <td><span class="badge bg-warning-subtle text-warning px-3 py-2 fw-semibold">2024-02-08</span></td>
                                        <td><span class="fw-bold text-danger fs-6">$1,650</span></td>
                                        <td><span class="badge bg-danger px-3 py-2 fw-semibold">Overdue</span></td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <button class="btn btn-sm btn-outline-danger border-0"><i class="bi bi-eye"></i></button>
                                                <button class="btn btn-sm btn-outline-danger border-0"><i class="bi bi-pencil"></i></button>
                                                <button class="btn btn-sm btn-danger"><i class="bi bi-x-circle"></i></button>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr class="border-danger border-bottom">
                                        <td>
                                            <div class="form-check"><input class="form-check-input" type="checkbox"></div>
                                        </td>
                                        <th scope="row" class="fw-bold text-danger">9</th>
                                        <td>
                                            <div class="fw-bold text-danger">James Lee</div><small class="text-muted">james@email.com</small>
                                        </td>
                                        <td>
                                            <div class="fw-semibold text-danger">Riverfront Home</div><small class="text-muted">Austin</small>
                                        </td>
                                        <td><span class="badge bg-danger-subtle text-danger px-3 py-2 fw-semibold">2024-02-05</span></td>
                                        <td><span class="badge bg-warning-subtle text-warning px-3 py-2 fw-semibold">2024-02-10</span></td>
                                        <td><span class="fw-bold text-danger fs-6">$2,100</span></td>
                                        <td><span class="badge bg-danger px-3 py-2 fw-semibold">Pending Payment</span></td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <button class="btn btn-sm btn-outline-danger border-0"><i class="bi bi-eye"></i></button>
                                                <button class="btn btn-sm btn-outline-danger border-0"><i class="bi bi-pencil"></i></button>
                                                <button class="btn btn-sm btn-danger"><i class="bi bi-x-circle"></i></button>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr class="border-danger">
                                        <td>
                                            <div class="form-check"><input class="form-check-input" type="checkbox"></div>
                                        </td>
                                        <th scope="row" class="fw-bold text-danger">10</th>
                                        <td>
                                            <div class="fw-bold text-danger">Anna Martinez</div><small class="text-muted">anna@email.com</small>
                                        </td>
                                        <td>
                                            <div class="fw-semibold text-danger">Skyline Apartment</div><small class="text-muted">Seattle</small>
                                        </td>
                                        <td><span class="badge bg-danger-subtle text-danger px-3 py-2 fw-semibold">2024-02-07</span></td>
                                        <td><span class="badge bg-warning-subtle text-warning px-3 py-2 fw-semibold">2024-02-12</span></td>




                                        <td><span class="fw-bold text-danger fs-6">$1,400</span></td>
                                        <td><span class="badge bg-danger px-3 py-2 fw-semibold">Payment Overdue</span></td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <button class="btn btn-sm btn-outline-danger border-0" title="View">
                                                    <i class="bi bi-eye"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-danger border-0" title="Edit">
                                                    <i class="bi bi-pencil"></i>
                                                </button>
                                                <button class="btn btn-sm btn-danger" title="Cancel">
                                                    <i class="bi bi-x-circle"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- Table Footer -->
                    <div class="card-footer bg-light border-0 py-3">
                        <div class="row align-items-center">
                            <div class="col-sm-6">
                                <small class="text-muted">
                                    Showing <strong>10</strong> of <strong>10</strong> reservations
                                </small>
                            </div>
                            <div class="col-sm-6">
                                <nav aria-label="Reservation pagination">
                                    <ul class="pagination justify-content-end mb-0">
                                        <li class="page-item disabled">
                                            <a class="page-link" href="#" tabindex="-1">Previous</a>
                                        </li>
                                        <li class="page-item active">
                                            <a class="page-link" href="#">1</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="#">2</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="#">Next</a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end here -->
    </div>

    <?php include __DIR__ . '/../partials/footer.php' ?>