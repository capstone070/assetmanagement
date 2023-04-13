</main>
<?php $config = require __DIR__ . '/../lib/config.php' ?>
<?php if (isset($_SESSION['user'])) : ?>
    <div class="mt-5"></div>
    <footer class="footer mt-auto bg-body-secondary ">
        <div class="container">
            <div class="py-3 my-4">
                <ul class="nav justify-content-center border-bottom pb-3 mb-3">
                    <li class="nav-item"><a href="/" class="nav-link px-2 <?= $_SERVER['SCRIPT_NAME'] === '/index.php' ? 'text-body-tertiary' : 'text-body-secondary' ?>"">Home</a></li>
                    <li class=" nav-item"><a href="/assets/" class="nav-link px-2 <?= strpos($_SERVER['SCRIPT_NAME'], '/assets/') !== false ? 'text-body-tertiary' : 'text-body-secondary' ?>">Assets</a></li>
                    <li class=" nav-item"><a href="/employees/" class="nav-link px-2 <?= strpos($_SERVER['SCRIPT_NAME'], '/employees/') !== false ? 'text-body-tertiary' : 'text-body-secondary' ?>">Employees</a></li>
                    <li class=" nav-item"><a href="/users/" class="nav-link px-2 <?= strpos($_SERVER['SCRIPT_NAME'], '/users/') !== false ? 'text-body-tertiary' : 'text-body-secondary' ?>">Users</a></li>
                    <li class=" nav-item"><a href="/about/" class="nav-link px-2 <?= strpos($_SERVER['SCRIPT_NAME'], '/about/') !== false ? 'text-body-tertiary' : 'text-body-secondary' ?>">About</a></li>
                </ul>
                <p class="text-center text-body-tertiary">&copy; <?= date('Y') ?> <?= $config['company'] ?></p>
            </div>
        </div>
    </footer>
<?php endif; ?>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
</body>

</html>