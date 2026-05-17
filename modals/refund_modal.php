    <!-- REFUND MODAL -->
    <div class="modal fade"
        id="refundModal<?= $row['id'] ?>"
        tabindex="-1">

        <div class="modal-dialog">
            <div class="modal-content">

<form action="refund_reservation.php?id=<?= $row['id'] ?>"
    method="POST"
    enctype="multipart/form-data">

                    <div class="modal-header">
                        <h5 class="modal-title">
                            Confirm Refund
                        </h5>

                        <button type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"></button>
                    </div>

<div class="modal-body">

    <!-- REFUND REFERENCE -->
    <div class="mb-3">
        <label class="form-label">
            Refund Reference Number
        </label>

        <input type="text"
            name="refund_reference"
            class="form-control"
            required>
    </div>

    <!-- REFUND PROOF -->
    <div class="mb-3">
        <label class="form-label">
            Refund Proof Screenshot
        </label>

        <input type="file"
            name="refund_proof"
            class="form-control"
            accept="image/*"
            required>
    </div>

    <!-- REFUND NOTE -->
    <div class="mb-3">
        <label class="form-label">
            Refund Note
        </label>

        <textarea name="refund_note"
            class="form-control"
            rows="4"
            placeholder="Refund note..."
            required></textarea>
    </div>

</div>

                    <div class="modal-footer">

                        <button type="submit"
                            class="btn btn-primary w-100">

                            Confirm Refund

                        </button>

                    </div>

                </form>

            </div>
        </div>

    </div>