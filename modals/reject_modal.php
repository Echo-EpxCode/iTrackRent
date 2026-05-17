                                    <div class="modal fade" id="rejectModal<?= $row['id'] ?>" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">

                                                <form action="update_reservation.php" method="POST">

                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Reject Booking</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>

                                                    <div class="modal-body">

                                                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                                        <input type="hidden" name="status" value="rejected">

                                                        <textarea name="rejected_reason"
                                                            class="form-control"
                                                            placeholder="Enter reason..."
                                                            required></textarea>

                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-danger w-100">
                                                            Confirm Reject
                                                        </button>
                                                    </div>

                                                </form>

                                            </div>
                                        </div>
                                    </div>