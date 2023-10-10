<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <title>Employee Managements</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>

<body>
    <?= $this->renderSection('header') ?>

    <?= $this->renderSection('content') ?>

    <?= $this->renderSection('footer') ?>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $('#btn-export').click(function() {
            console.log('<?= base_url(); ?>export')
            $.ajax({
                url: '<?= base_url(); ?>export',
                destroy: true,
                type: 'GET',
                data: '',
                beforeSend: function() {
                    // $("#btn-export").removeClass("buttonExcel");
                    // $("#btn-export").addClass("buttonExcel-getExcel");
                    $("#btn-export").blur();
                },
                success: function(response) {
                    window.open('<?= base_url(); ?>export', '_blank');
                },
                error: function() {
                    alert("error when get data");
                }
            });
        });

        $('.delete-btn').click(function() {
            var id = $(this).data('id');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then(result => {
                if (result.isConfirmed) {
                    deleteEmployee(id);
                }
            })

        });

        function deleteEmployee(id) {
            var csrfName = '<?= csrf_token() ?>';
            var csrfHash = '<?= csrf_hash() ?>';

            $.ajax({
                url: "<?= base_url() . 'employees/' ?>" + id + "/delete",
                type: "POST",
                data: {
                    [csrfName]: csrfHash,
                },
                cache: false,
                success: function(dataResult) {
                    var dataResult = JSON.parse(dataResult);
                    if (dataResult.success) {
                        Swal.fire({
                            title: 'Success.',
                            text: 'Successfully deleted',
                            icon: 'success',
                            confirmButtonText: 'Close'
                        }).then(result => {
                            if (result.isConfirmed) {
                                window.location.reload();
                            }
                        })
                    }
                }
            });
        }
    </script>
</body>

</html>