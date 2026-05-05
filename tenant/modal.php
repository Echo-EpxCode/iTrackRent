<div class="modal fade" id="editModal<?= $row['id'] ?>" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <form action="update_listing.php" method="POST" enctype="multipart/form-data">

                <div class="modal-header">
                    <h5 class="modal-title">Edit Listing</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <input type="hidden" name="id" value="<?= $row['id'] ?>">

                    <!-- House Name -->
                    <div class="mb-3">
                        <label>House Name</label>
                        <input type="text" name="house_name" class="form-control"
                            value="<?= htmlspecialchars($row['house_name']) ?>" required>
                    </div>

                    <!-- Property Type -->
                    <div class="mb-3">
                        <label>Property Type</label>
                        <select name="property_type" class="form-control" required>
                            <option value="boarding_house" <?= $row['property_type'] == 'boarding_house' ? 'selected' : '' ?>>Boarding House</option>
                            <option value="lodging_house" <?= $row['property_type'] == 'lodging_house' ? 'selected' : '' ?>>Lodging House</option>
                            <option value="pension_house" <?= $row['property_type'] == 'pension_house' ? 'selected' : '' ?>>Pension House</option>
                        </select>
                    </div>

                    <!-- Payment Type -->
                    <div class="mb-3">
                        <label>Payment Type</label>
                        <select name="payment_type" class="form-control" required>
                            <option value="monthly" <?= $row['payment_type'] == 'monthly' ? 'selected' : '' ?>>Monthly</option>
                            <option value="night" <?= $row['payment_type'] == 'night' ? 'selected' : '' ?>>Night</option>
                        </select>
                    </div>

                    <!-- Price -->
                    <div class="mb-3">
                        <label>Price</label>
                        <input type="number" name="price" class="form-control"
                            value="<?= $row['price'] ?>" required>
                    </div>

                    <!-- Description -->
                    <div class="mb-3">
                        <label>Description</label>
                        <textarea name="description" class="form-control" required><?= htmlspecialchars($row['description']) ?></textarea>
                    </div>

                    <!-- Map Link -->
                    <div class="mb-3">
                        <label>Google Map Link</label>
                        <input type="text" name="map_link" class="form-control"
                            value="<?= htmlspecialchars($row['map_link']) ?>" required>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Update</button>
                </div>

            </form>

        </div>
    </div>
</div>