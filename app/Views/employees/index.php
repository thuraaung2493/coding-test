<?= $this->extend('layouts/app') ?>

<?= $this->section('header') ?>
<?= $this->include('templates/header') ?>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php if (session('error')) : ?>
                <div class="alert alert-error alert-dismissible fade show text-center" role="alert">
                    <?= session('error') ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-md-12">
            <div class="card">
                <p class="card-header">Upload Excel File</p>
                <div class="card-body">
                    <form action="/upload" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>

                        <div class="input-group mb-3">
                            <div class="custom-file">
                                <input type="file" name="file" class="custom-file-input" id="inputGroupFile02">
                                <label class="custom-file-label" for="inputGroupFile02">Choose Excel File</label>
                            </div>
                            <div class="input-group-append">
                                <button type="submit" class="input-group-text">Upload</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <a href="/export" class="btn btn-info">Export to Excel</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>DOB</th>
                                <th>Gender</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Hire Date</th>
                                <th>Department</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($employees) : ?>
                                <?php foreach ($employees as $employee) : ?>
                                    <tr>
                                        <td><?php echo $employee->id; ?></td>
                                        <td><?php echo $employee->name; ?></td>
                                        <td><?php echo $employee->dob; ?></td>
                                        <td><?php echo $employee->gender; ?></td>
                                        <td><?php echo $employee->email; ?></td>
                                        <td><?php echo $employee->phone_number; ?></td>
                                        <td><?php echo $employee->hire_date; ?></td>
                                        <td><?php echo $employee->department->name; ?></td>
                                        <td>
                                            <button class="btn btn-primary btn-sm">Edit</button>
                                            <button data-id="<?= $employee->id ?>" class="delete-btn btn btn-danger btn-sm">Delete</button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>

                    <?php if ($pager) : ?>
                        <?= $pager->links('group1', 'bs_full') ?>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('footer') ?>
<?= $this->include('templates/footer') ?>
<?= $this->endSection() ?>