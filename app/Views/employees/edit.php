<?= $this->extend('layouts/app') ?>

<?= $this->section('header') ?>
<?= $this->include('templates/header') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<?php
$validation = session('validation');
?>

<div class="d-flex flex-column justify-content-center align-items-center bg-light p-4" style="min-height: 100vh">
    <div class="text-center mb-3">
        <img class="mb-3" src="img/logo.png" alt="" width="100">
        <h1 class="text-capitalize">Edit Employee</h1>
    </div>

    <?php if (session('success')) : ?>
        <div class="alert alert-success" role="alert">
            <?= session('success') ?>
        </div>
    <?php endif; ?>

    <form action="/employees/<?= $employee->id ?>" method="post" class="w-100 p-4 bg-white rounded mb-3" style="max-width: 600px;">
        <?= csrf_field() ?>
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control <?= isset($validation) && $validation->hasError('name') ? 'is-invalid' : '' ?>" id="name" value="<?= old('name', $employee->name) ?>" required>
            <?php if (isset($validation) && $validation->hasError('name')) : ?>
                <div class="invalid-feedback">
                    <?= $validation->getError('name') ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="dob">Date of birth</label>
            <input type="date" name="dob" class="form-control <?= isset($validation) && $validation->hasError('dob') ? 'is-invalid' : '' ?>" id="dob" value="<?= old('dob', $employee->dob) ?>" required>
            <?php if (isset($validation) && $validation->hasError('dob')) : ?>
                <div class="invalid-feedback">
                    <?= $validation->getError('dob') ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="gender">Select Gender</label>
            <select name="gender" class="form-control" id="gender">
                <option value="Male" <?= $employee->gender === 'Male' ? 'selected' : '' ?>>Male</option>
                <option value="Female" <?= $employee->gender === 'Female' ? 'selected' : '' ?>>Female</option>
                <option value="Other" <?= $employee->gender === 'Other' ? 'selected' : '' ?>>Other</option>
            </select>
        </div>

        <div class="form-group">
            <label for="department">Select Department</label>
            <select name="department_id" class="form-control" id="department">
                <?php foreach ($departments as $department) : ?>
                    <option value="<?= $department->id ?>" <?= $department->id === $employee->department->id ? 'selected' : '' ?>><?= $department->name; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="text" name="email" class="form-control <?= isset($validation) && $validation->hasError('email') ? 'is-invalid' : '' ?>" id="email" value="<?= old('email', $employee->email) ?>" required>
            <?php if (isset($validation) && $validation->hasError('email')) : ?>
                <div class="invalid-feedback">
                    <?= $validation->getError('email') ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="phone_number">Phone Number</label>
            <input type="text" name="phone_number" class="form-control <?= isset($validation) && $validation->hasError('phone_number') ? 'is-invalid' : '' ?>" id="phone_number" value="<?= old('phone_number', $employee->phone_number) ?>" required>
            <?php if (isset($validation) && $validation->hasError('phone_number')) : ?>
                <div class="invalid-feedback">
                    <?= $validation->getError('phone_number') ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="hire_date">Hire Date</label>
            <input type="date" name="hire_date" class="form-control <?= isset($validation) && $validation->hasError('hire_date') ? 'is-invalid' : '' ?>" id="hire_date" value="<?= old('hire_date', $employee->hire_date) ?>" required>
            <?php if (isset($validation) && $validation->hasError('hire_date')) : ?>
                <div class="invalid-feedback">
                    <?= $validation->getError('hire_date') ?>
                </div>
            <?php endif; ?>
        </div>

        <button type="submit" class="btn btn-secondary w-100">Update</button>
    </form>

    <small>CodeIgniter 4 - Authentication &copy; <?= date('Y') ?></small>
</div>

<?= $this->endSection() ?>

<?= $this->section('footer') ?>
<?= $this->include('templates/footer') ?>
<?= $this->endSection() ?>