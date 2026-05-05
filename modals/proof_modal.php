<!-- PAYMENT PROOF MODAL -->
<div class="modal fade" id="proofModal<?= $row['id'] ?>" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Payment Proof</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body text-center">

                <?php if (!empty($row['payment_proof'])): ?>

                    <img src="../uploads/payments/<?= $row['payment_proof'] ?>"
                        class="img-fluid rounded shadow"
                        style="max-height: 500px; object-fit: contain;">

                <?php else: ?>

                    <div class="alert alert-warning">
                        No payment proof uploaded.
                    </div>

                <?php endif; ?>

            </div>

        </div>
    </div>
</div>