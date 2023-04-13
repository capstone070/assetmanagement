<?php

require 'lib/header.php';

$countAssets = DB::queryFirstField("SELECT COUNT(*) FROM asset");
$countEmployees = DB::queryFirstField("SELECT COUNT(*) FROM employee");
$countUsers = DB::queryFirstField("SELECT COUNT(*) FROM user");

$logs = DB::query('SELECT * FROM log ORDER BY id DESC LIMIT 10');

$topAssignments = DB::query('SELECT B.FirstName,B.LastName, COUNT(*) as assigned FROM assetassignment A LEFT JOIN employee B ON A.employeeId = B.id GROUP BY A.employeeId ORDER BY assigned DESC LIMIT 10');
?>
<div class="container">
    <h1 class="display-1">Dashboard</h1>
    <div class="row mb-4">
        <div class="col">
            <a class="animate__animated animate__fadeInDown card text-bg-secondary text-decoration-none" href="assets/">
                <div class="card-body">
                    <div class="display-5"><i class="bi bi-database"></i> <?= $countAssets ?></div>
                </div>
                <div class="card-footer">Assets</div>
            </a>
        </div>
        <div class="col">
            <a class="animate__animated animate__fadeInDown card text-bg-secondary text-decoration-none" href="employees/">
                <div class="card-body">
                    <div class="display-5"><i class="bi bi-people   "></i> <?= $countEmployees ?></div>
                </div>
                <div class="card-footer">Employees</div>
            </a>
        </div>
        <div class="col">
            <a class="animate__animated animate__fadeInDown card text-bg-secondary text-decoration-none" href="users/">
                <div class="card-body">
                    <div class="display-5"><i class="bi bi-person-lock"></i> <?= $countUsers ?></div>
                </div>
                <div class="card-footer">Users</div>
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4 animate__animated animate__fadeIn">
                <h5 class="card-header"><i class="bi bi-bar-chart"></i> Top 10 asset assignment</h5>
                <div class="card-body">
                    <?php if ($topAssignments) : ?>
                        <div><canvas id="topAssignments" class="w-100"></canvas></div>
                        <script>
                            const myChart = new Chart(document.getElementById('topAssignments'), {
                                type: 'bar',
                                data: {
                                    labels: [<?= join(',', array_map(function ($item) {
                                                    return '"' . $item['FirstName'] . ' ' . $item['LastName'] . '"';
                                                }, $topAssignments)) ?>],
                                    datasets: [{
                                        label: 'Assignment up to date',
                                        data: [<?= join(',', array_map(function ($item) {
                                                    return $item['assigned'];
                                                }, $topAssignments)) ?>],
                                        backgroundColor: [
                                            'rgba(75, 192, 192, 1)',
                                            'rgba(255, 99, 132, 1)',
                                            'rgba(255, 159, 64, 1)',
                                            'rgba(255, 205, 86, 1)',
                                            'rgba(54, 162, 235, 1)',
                                            'rgba(153, 102, 255, 1)',
                                            'rgba(201, 203, 207, 1)',
                                            'rgba(75, 192, 192, 1)',
                                            'rgba(255, 99, 132, 1)',
                                            'rgba(255, 159, 64, 1)',
                                        ],
                                    }],
                                },
                                options: {
                                    plugins: {
                                        legend: {
                                            display: false
                                        }
                                    },
                                    responsive: true,
                                    maintainAspectRatio: true,
                                    aspectRatio: 2,
                                    scale: {
                                        ticks: {
                                            precision: 0
                                        }
                                    }
                                },
                            });
                        </script>
                    <?php else : ?>
                        <p class="text-muted m-0">No records found.</p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="card mb-4">
                <h5 class="card-header"><i class="bi bi-clipboard-data"></i> Reports</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3"><a href="report.php?report=assets" class="btn btn-secondary mb-1 w-100"><i class="bi bi-filetype-csv"></i> Asset list</a></div>
                        <div class="col-md-3"><a href="report.php?report=replaced" class="btn btn-secondary mb-1 w-100"><i class="bi bi-filetype-csv"></i> Replaced</a></div>
                        <div class="col-md-3"><a href="report.php?report=disposed" class="btn btn-secondary mb-1 w-100"><i class="bi bi-filetype-csv"></i> Disposed</a></div>
                        <div class="col-md-3"><a href="report.php?report=warranty" class="btn btn-secondary mb-1 w-100"><i class="bi bi-filetype-csv"></i> Warranty</a></div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card animate__animated animate__fadeIn">
                <h5 class="card-header"><i class="bi bi-activity"></i> Latest activities</h5>
                <table class="table table-hover m-0">
                    <?php if ($logs) : ?>
                        <?php foreach ($logs as $row) : ?>
                            <tr>
                                <td class="px-3"><?= $row['message'] ?><br />
                                    <small class="text-muted"><?= $row['dateCreated'] ?></small>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <p class="text-muted">No records found.
                        <?php endif; ?>
                </table>
                <div class="card-footer">
                    <a href="/activities.php">Show all</a>
                </div>
            </div>

        </div>
    </div>
</div>
<?php require 'lib/footer.php'; ?>