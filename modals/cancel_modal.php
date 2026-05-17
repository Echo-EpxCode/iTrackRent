<!-- Cancel Modal -->
<div class="modal fade"
     id="cancelModal<?= $row['id'] ?>"
     tabindex="-1">

    <div class="modal-dialog">
        <div class="modal-content">

            <form action="cancel_reservation.php?id=<?= $row['id'] ?>"
                  method="POST">

                <div class="modal-header">
                    <h5 class="modal-title">
                        Cancel Reservation
                    </h5>

                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <div class="mb-3">
                        <label class="form-label">
                            Cancellation Note
                        </label>

                        <textarea name="cancel_reason"
                                  class="form-control"
                                  rows="4"
                                  required></textarea>
                    </div>

                </div>

                <div class="modal-footer">

                    <button type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal">
                        Close
                    </button>

                    <button type="submit"
                            class="btn btn-danger">
                        Confirm Cancel
                    </button>

                </div>

            </form>

        </div>
    </div>

</div>