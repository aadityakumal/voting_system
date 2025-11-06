<?php include('head.php'); ?>

<body>
    <style>
        header {
            background-color: #20c66b;
            color: white;
            padding: 1px 20px;
            text-align: center;
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .nav-links {
            list-style: none;
            margin-left: 15px;
            margin-right: 20px;
        }

        .nav-links li {
            display: inline;
            margin-left: 15px;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            font-size: 16px;
        }
    </style>
    <header>
        <nav>
            <div class="logo">
                <h1>ClickVote</h1>
            </div>
            <ul class="nav-links">
                <li><a href="http://localhost/voting_system/home.html">Home</a></li>
                <li><a href="http://localhost/voting_system/">User Login</a></li>
                <li><a href="http://localhost/voting_system/admin/">Admin Login</a></li>
            </ul>
        </nav>
    </header>
    <div class="container">
        <div class="row">

            <center>
                <h3>ClickVote - An Online Voting Sytem</h3>
            </center>
            <div class="col-md-4 col-md-offset-4">

                <div class="login-panel panel panel-default">

                    <div class="panel-heading">
                        <center>
                            <h3 class="panel-title"> Log In</h3>
                        </center>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="post" enctype="multipart/form-data">
                            <fieldset>

                                <div class="form-group">
                                    <label for="username">ID No.</label>
                                    <input class="form-control" placeholder="Please Enter Voter's ID Number" name="idno" type="text" required="required" autofocus>
                                </div>

                                <div class="form-group">
                                    <label for="username">Password</label>
                                    <input class="form-control" placeholder="Password" name="password" type="password" required="required">
                                </div>


                                <button class="btn btn-lg btn-success btn-block " name="login">Login</a>


                            </fieldset>

                            <?php include('login_query.php'); ?>
                        </form>
                        <!-- <h4><b>Note:</b> <i>One voter can only vote/login one time!!</i> </h4> -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include('script.php'); ?>

</body>

</html>