<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="/RAZIN/web2//admin/index.php">Click_Editz (Admin)</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="/RAZIN/web2/admin/index.php">Home</a>
            </li>
        </ul>
        <?php 
        if(isset($_SESSION['auth_a'])){ ?>
        <a href="/RAZIN/web2/admin/profile.php" class="btn btn-secondary text-light btn-sm mr-2 float-right">
            Profile
        </a>
        <a onclick="return confirm('Are you sure?');" href="/RAZIN/web2/admin/logout.php" class="btn btn-secondary text-light btn-sm mr-2 float-right">
            Logout
        </a>
        <?php
        } ?>

        </ul>
    </div>
   

</nav>