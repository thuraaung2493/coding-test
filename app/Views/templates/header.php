<header class="text-center p-3 mb-3 bg-info text-white d-flex justify-content-between">
    <h1 class="h3">Employee Management</h1>
    <form action="/logout" method="post">
        <?= csrf_field() ?>
        <button type="submit" class="btn btn-info">Logout</button>
    </form>
</header>