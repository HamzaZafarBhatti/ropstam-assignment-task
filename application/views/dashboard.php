<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    <title>Dashboard</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?php echo site_url('/dashboard') ?>">Ropstam</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="<?php echo site_url('/logout') ?>">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <section>
        <div class="card">
            <div class="card-body">
                <?php $this->load->view('alert'); ?>
                <div class="row">
                    <div class="col-md-6">
                        <div class="d-flex justify-content-between">
                            <h4>Categories</h4>
                            <?php
                            if (!$categories) :
                            ?>
                                <a href="<?php echo site_url('add/categories') ?>">Add Categories</a>
                            <?php
                            endif;
                            ?>
                        </div>
                        <table class="table table-striped table-dark">
                            <thead>
                                <tr>
                                    <th>Category</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($categories) :
                                    foreach ($categories as $item) :
                                ?>
                                        <tr>
                                            <td><?php echo $item->name ?></td>
                                            <td><?php echo $item->status ? 'Active' : 'Inactive'; ?></td>
                                        </tr>
                                    <?php
                                    endforeach;
                                else :
                                    ?>
                                    <tr>
                                        <td colspan="2" class="text-center">No data found</td>
                                    </tr>
                                <?php
                                endif;
                                ?>
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-between">
                            <h4>Users</h4>
                            <?php
                            if (!$users) :
                            ?>
                                <a href="<?php echo site_url('add/users') ?>">Add users</a>
                            <?php
                            endif;
                            ?>
                        </div>
                        <table class="table table-striped table-dark">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($users) :
                                    foreach ($users as $item) :
                                ?>
                                        <tr>
                                            <td><?php echo $item->name ?></td>
                                            <td><?php echo $item->email ?></td>
                                            <td><?php echo $item->phone ?></td>
                                        </tr>
                                    <?php
                                    endforeach;
                                else :
                                    ?>
                                    <tr>
                                        <td colspan="3" class="text-center">No data found</td>
                                    </tr>
                                <?php
                                endif;
                                ?>
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-start" style="gap: 10px">
                            <?php
                            if (!$product_variations) :
                            ?>
                                <a href="<?php echo site_url('add/product_variations') ?>" type="button" class="btn btn-primary">Add Product Variations</a>
                            <?php
                            endif;
                            if (!$product_reviews) :
                            ?>
                                <a href="<?php echo site_url('add/product_reviews') ?>" type="button" class="btn btn-primary">Add Product Reviews</a>
                            <?php
                            endif;
                            ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex justify-content-between">
                            <h4>Products</h4>
                            <?php
                            if (!$products) :
                            ?>
                                <a href="<?php echo site_url('add/products') ?>">Add Products</a>
                            <?php
                            endif;
                            ?>
                        </div>
                        <table class="table table-striped table-dark">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Category</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Rating</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($products) :
                                    foreach ($products as $item) :
                                ?>
                                        <tr>
                                            <td><?php echo $item->name ?></td>
                                            <td><?php echo $item->category_name ?></td>
                                            <td><?php echo $item->price ?></td>
                                            <td><?php echo $item->quantity ?></td>
                                            <td><?php echo $item->rating ?></td>
                                            <td><?php echo $item->status ? 'Active' : 'Inactive'; ?></td>
                                        </tr>
                                    <?php
                                    endforeach;
                                else :
                                    ?>
                                    <tr>
                                        <td colspan="6" class="text-center">No data found</td>
                                    </tr>
                                <?php
                                endif;
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>