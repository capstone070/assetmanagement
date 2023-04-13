<form method="POST">
    <input type="hidden" name="id" value="<?= $row['id'] ?>">
    <input type="hidden" name="employeeId" value="<?= $row['employeeId'] ?>">
    <div class="mb-3">
        <label class="form-label">Username</label>
        <input type="text" class="form-control" name="UserName" value="<?= $row['UserName'] ?>">
    </div>
    <div class="mb-3">
        <label class="form-label">New password</label>
        <input type="password" class="form-control" name="NewPassword" value="<?= $row['NewPassword'] ?>" autocomplete="off" readonly onfocus="this.removeAttribute('readonly');">
    </div>
    <div class="mb-3">
        <label class="form-label">Level</label>
        <select name="UserLevel" class="form-select">
            <option value=""></option>
            <?php foreach (['Asset Admin', 'Asset Manager', 'Admin', 'User'] as $level) : ?>
                <option value="<?= $level ?>" <?= $row['UserLevel'] === $level ? 'selected' : '' ?>><?= $level ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <button type="submit" class="btn btn-success"><?= $row['id'] ? 'Save' : 'Submit' ?></button>
</form>