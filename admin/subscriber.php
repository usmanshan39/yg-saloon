<?php require_once("./includes/head.php") ?>
<body id="page-top">
    <div id="wrapper">
        <?php require_once "./includes/sidebar.php" ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <div class="container-fluid p-5">
                    <h1 class="h3 mb-2 text-gray-800">Our Subscriber's</h1>
                    <p class="mb-4"></p>
                    <div class="card shadow mb-4">
                        <!-- <div class="card-header py-3">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#addUserModal">ADD User</button>
                        </div> -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="subscriberTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Email</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                        <th>Id</th>
                                        <th>Email</th>
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