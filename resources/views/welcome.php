<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InitPHP Framework 3</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <style>
        html, body {
            height: 100%;
        }
        #content {
            min-height: calc(100vh - 56px);
        }
        footer {
            height: 56px;
        }
    </style>
</head>
<body>
    <div id="content">
        <div class="container text-center">
            <div class="row mb-4 pt-2">
                <div class="col">
                    <div class="p-2">
                        <h1>InitPHP Framework</h1>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="h-100 card p-4">
                        <div class="card-body">
                            <img src="https://initphp.org/logos/initphp-icon-700.png" alt="initphp" class="rounded image-fluid" height="220" width="220" />
                            <h5 class="card-title">InitPHP</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Open Source Software Group</h6>
                            <p class="card-text">InitPHP is a software group that develops open-source PHP libraries and publishes them under the MIT license.</p>
                            <a href="https://github.com/InitPHP" target="_blank" class="card-link">GitHub</a>
                            <a href="https://initphp.org" target="_blank" class="card-link">Web Site</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="h-100 card p-4">
                        <div class="card-body">
                            <img src="https://initphp.org/logos/initorm-icon-profile.png" alt="initphp" class="rounded image-fluid" height="220" width="220" />
                            <h5 class="card-title">InitORM</h5>
                            <h6 class="card-subtitle mb-2 text-muted">QueryBuilder + DBAL + ORM</h6>
                            <p class="card-text">InitORM is a free and powerful ORM library, developed as open source and distributed under the MIT license.</p>
                            <a href="https://github.com/InitORM" target="_blank" class="card-link">GitHub</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4">
                    <figure class="text-end">
                        <blockquote class="blockquote">
                            <p>Knowledge is Power, It Grows as You Share!</p>
                        </blockquote>
                        <figcaption class="blockquote-footer">
                            Software Developer <cite title="Muhammet ŞAFAK">Muhammet ŞAFAK</cite>
                        </figcaption>
                    </figure>
                </div>
            </div>
        </div>
    </div>
    <footer class="container-fluid border-top pt-3">
        <div class="container">
            <div class="col-sm-6 text-start float-start">
                <p>Copyright &copy; 2022 - <?= date("Y"); ?></p>
            </div>
            <div class="col-sm-6 text-end float-end">
                <p>This page was created in <?= elapsed_time(); ?> seconds using <?= memory_usage(); ?> of memory</p>
            </div>
        </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>