<?php require_once("./includes/head.php") ?>
<body id="page-top">
    <div id="wrapper">
        <?php require_once "./includes/sidebar.php" ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <div class="container-fluid p-5">
                    <h1 class="h3 mb-2 text-gray-800">Blogs</h1>
                    <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
                        For more information about DataTables, please visit the.</p>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#blogModal">ADD Blog</button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="blogsTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Title</th>
                                            <th>Image</th>
                                            <th>description</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                        <th>Id</th>
                                        <th>Title</th>
                                        <th>Image</th>
                                        <th>description</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                        </tr>
                                    </tfoot>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php require_once ("./includes/footer.php") ?>
        </div>
    </div>
<?php require_once("./includes/modals.php") ?>
<?php require_once("./includes/footer2.php") ?>