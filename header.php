<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="/RAZIN/web2/index.php">Click_Editz</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="/RAZIN/web2/index.php">Home</a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link" href="#">About</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Contact Us</a>
            </li>
        </ul>
        <?php 
        if(isset($_SESSION['auth'])){ ?>
        <a href="/RAZIN/web2/profile.php" class="btn btn-secondary text-light btn-sm mr-2 float-right">
            Profile
        </a>
        <a onclick="return confirm('Are you sure?');" href="/RAZIN/web2/logout.php" class="btn btn-secondary text-light btn-sm mr-2 float-right">
            Logout
        </a>
        <?php
        } else{ ?>
        <a type="button" class="btn btn-secondary text-light btn-sm mr-2 float-right" data-toggle="modal"
            data-target="#login">
            Login
        </a>
        <a type="button" class="btn btn-secondary text-light btn-sm mr-2 float-right" data-toggle="modal"
            data-target="#signup">
            Signup
        </a>
        <?php }
        ?>

        </ul>
    </div>
    <form method="post" action="/RAZIN/web2/login.php">
        <div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Login</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="lemail">Email address</label>
                            <input type="email" class="form-control" id="lemail" name="lemail"
                                aria-describedby="emailHelp">
                            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                                else.</small>
                        </div>
                        <div class="form-group">
                            <label for="lpassword">Password</label>
                            <input type="password" class="form-control" id="lpassword" name="lpass"
                                aria-describedby="emailHelp">
                            <small id="passwordHelp" class="form-text text-muted">Password should be min 4 charcter
                                longer</small>
                        </div>
                        <a href="/RAZIN/web2/instructor/index.php" class="btn btn-secondary btn-sm" >Instructor login here</a>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary" value="Login">
                    </div>
                </div>
            </div>
        </div>
    </form>

    <form method="post" action="/RAZIN/web2/signup.php">
        <div class="modal fade" id="signup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Signup</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="sname">Name</label>
                            <input type="text" class="form-control" id="sname" name="sname" aria-describedby="name">
                        </div>
                        <div class="form-group">
                            <label for="semail">Email address</label>
                            <input type="email" class="form-control" id="semail" name="semail"
                                aria-describedby="emailHelp">
                            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                                else.</small>
                        </div>
                        <div class="form-group">
                            <label for="spassword">Password</label>
                            <input type="password" class="form-control" id="spassword" name="spassword"
                                aria-describedby="emailHelp">
                            <small id="passwordHelp" class="form-text text-muted">Password should be min 4 charcter
                                longer</small>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Signup</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

</nav>