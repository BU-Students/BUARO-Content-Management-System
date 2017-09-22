<nav class="navbar navbar-inverse fixed-top" id="topbar">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-content">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <span id="organization-name" class="navbar-brand">College Administator</span>
        </div>
        <div id="navbar-content" class="navbar-collapse collapse">
            <ul class="nav navbar-nav" id="topnav-items">
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="eshop.php">E-Shop</a></li>
                <li><a href="stories.php">Stories</a></li>

                <?php
                    //if parent admin
                    if($_SESSION['admin-type'] == 1) {
                        echo('<li><a href="events.php">Events</a></li>');
                    }
                ?>
                <li class="nav-divider"></li>
            </ul>
            <ul class="nav navbar-nav navbar-right" id="topbar-right">
                <li id="editor-tab"><a href="editor-eshop.php">Post a Product</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Account&ensp;<span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li class="dropdown-header">Account</li>
                        <li><a href="profile.php">Profile</a></li>
                        <li><a href="logout.php">Logout</a></li>
                        <li class="divider"></li>
                        <li class="dropdown-header">Meta</li>
                        <li><a href="#">Feedback</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>