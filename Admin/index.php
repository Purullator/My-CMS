<?php include "includes/admin_header.php"; ?>

<div id="wrapper">

    <?php



    ?>
    <?php include "includes/admin_navigation.php"; ?>


    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome to Admin,

                        <small><?= $_SESSION['username'] ?></small>
                    </h1>


                </div>
            </div>
            <!-- /.row -->


            <!-- /.row -->

            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-file-text fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">

                                    <?php

                                    $query = "SELECT * FROM posts";
                                    $selectAllPosts = $connection->query($query);
                                    $post_contents = mysqli_num_rows($selectAllPosts);

                                    echo  "<div class='huge'>$post_contents</div>";

                                    ?>
                                    <div>Posts</div>
                                </div>
                            </div>
                        </div>
                        <a href="posts.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-comments fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">

                                    <?php

                                    $query = "SELECT * FROM comments";
                                    $selectAllComm = $connection->query($query);
                                    $comm_contents = mysqli_num_rows($selectAllComm);

                                    echo  "<div class='huge'>$comm_contents</div>";

                                    ?>
                                    <div>Comments</div>
                                </div>
                            </div>
                        </div>
                        <a href="comments.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-user fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">

                                    <?php

                                    $query = "SELECT * FROM users";
                                    $selectAllUser = $connection->query($query);
                                    $user_contents = mysqli_num_rows($selectAllUser);

                                    echo  "<div class='huge'>$user_contents</div>";

                                    ?>

                                    <div> Users</div>
                                </div>
                            </div>
                        </div>
                        <a href="users.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-list fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">

                                    <?php

                                    $query = "SELECT * FROM categories";
                                    $selectAllCat = $connection->query($query);
                                    $cat_contents = mysqli_num_rows($selectAllCat);

                                    echo  "<div class='huge'>$cat_contents</div>";

                                    ?>
                                    <div>Categories</div>
                                </div>
                            </div>
                        </div>
                        <a href="categories.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.row -->


            <?php

            $query = "SELECT * FROM posts WHERE post_status = 'published'";
            $selectAllPublishedPosts = $connection->query($query);
            $post_published_contents = mysqli_num_rows($selectAllPublishedPosts);


            $query = "SELECT * FROM posts WHERE post_status = 'draft'";
            $selectAllDraftPosts = $connection->query($query);
            $post_draft_contents = mysqli_num_rows($selectAllDraftPosts);


            $query = "SELECT * FROM comments WHERE comment_status = 'unapproved'";
            $selectAllUnComm = $connection->query($query);
            $comm_all_contents = mysqli_num_rows($selectAllUnComm);


            $query = "SELECT * FROM users WHERE user_role = 'subscriber'";
            $selectAllSubUser = $connection->query($query);
            $User_role_contents = mysqli_num_rows($selectAllSubUser);


            ?>


            <div class="row well">



                <script type="text/javascript">
                    google.charts.load('current', {
                        'packages': ['bar']
                    });
                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                            ['Data', 'Count'],


                            <?php

                            $element_text = ['Published Posts', 'Active Posts', 'Draft Posts', 'Subscriber Users', 'Unnapproved Comments', 'Categories', 'Users', 'Comments'];
                            $element_count = [$post_published_contents, $post_contents, $post_draft_contents, $User_role_contents, $comm_all_contents, $cat_contents, $user_contents, $comm_contents];

                            for ($i = 0; $i < 7; $i++) {

                                echo "['{$element_text[$i]}'" . "," . "{$element_count[$i]}],";
                            }
                            ?>


                        ]);

                        var options = {
                            chart: {
                                title: 'Different Flux of Data',
                                subtitle: 'Graphic showing the flow of the CMS data'
                            }
                        };

                        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                        chart.draw(data, google.charts.Bar.convertOptions(options));
                    }
                </script>

                <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>


            </div>





        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->



    <?php include "includes/admin_footer.php"; ?>