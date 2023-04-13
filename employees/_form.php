<form method="POST">
    <input type="hidden" name="id" value="<?= $row['id'] ?>">
    <div class="mb-3">
        <label class="form-label">First name</label>
        <input type="text" class="form-control" name="FirstName" value="<?= $row['FirstName']?>">
    </div>
    <div class="mb-3">
        <label class="form-label">Last name</label>
        <input type="text" class="form-control" name="LastName"  value="<?= $row['LastName']?>">
    </div>
    <div class="mb-3">
        <label class="form-label">Mobile</label>
        <input type="text" class="form-control" name="MobileNumber"  value="<?= $row['MobileNumber']?>">
    </div>
    <button type="submit" class="btn btn-success"><?= $row['id'] ? 'Save' : 'Submit' ?></button>
</form>