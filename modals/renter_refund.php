<!-- REFUND PROOF MODAL -->
<div class="modal fade"
    id="refundProofModal<?= $row['id'] ?>"
    tabindex="-1"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-lg">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">
                    Refund Proof
                </h5>

                <button type="button"
                    class="btn-close"
                    data-bs-dismiss="modal">
                </button>

            </div>

            <div class="modal-body text-center">

                <img
                    src="../uploads/refunds/<?= htmlspecialchars($row['proof_image']) ?>"
                    class="img-fluid rounded shadow">

            </div>

        </div>

    </div>

</div>