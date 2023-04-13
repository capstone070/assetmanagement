<form method="POST">
    <input type="hidden" name="id" value="<?= $row['id'] ?>">
    <div class="mb-3">
        <label class="form-label">Serial number</label>
        <input type="text" class="form-control" name="serialNum" value="<?= $row['serialNum'] ?>">
    </div>
    <div class="mb-3">
        <label class="form-label">Name</label>
        <input type="text" class="form-control" name="name" value="<?= $row['name'] ?>">
    </div>
    <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea class="form-control" name="description"><?= htmlentities($row['description']) ?></textarea>
    </div>
    <div class="mb-3">
        <label class="form-label">Cost</label>
        <input type="number" class="form-control" name="cost" value="<?= $row['cost'] ?>">
    </div>
    <div class="mb-3">
        <label class="form-label">Purchased date</label>
        <input type="date" class="form-control" name="purchasedDate" value="<?= $row['purchasedDate'] ?>">
    </div>
    <div class="mb-3">
        <label class="form-label">Asset age</label>
        <input type="text" class="form-control" name="assetAge" value="<?= $row['assetAge'] ?>">

    </div>
    <div class="mb-3">
        <label class="form-label">Status</label>
        <select name="status" class="form-select">
            <option value=""></option>
            <?php foreach (['Active', 'Disposed', 'Expired', 'Transferred'] as $level) : ?>
                <option value="<?= $level ?>" <?= $row['status'] === $level ? 'selected' : '' ?>><?= $level ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <button type="submit" class="btn btn-success"><?= $row['id'] ? 'Save' : 'Submit' ?></button>
</form>