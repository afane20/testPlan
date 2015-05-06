<ul>
    <li><a href="http://157.201.194.254/~ercanbracks/cs313/heidi/index.php">Home</a></li>
    <li><a href="http://157.201.194.254/~ercanbracks/cs313/heidi/general/" id="nav-general">General</a></li>
    <?php 
    if ($_SESSION['loginflag'] == TRUE && $_SESSION['clientrights'] > 8) {
    ?>
    <li><a href="#" id="nav-teacher">Teacher</a>
        <ul class="nav-hidden nav-teacher">
            <li><a href="http://157.201.194.254/~ercanbracks/cs313/heidi/teacher/">My Students</a></li>
            <li><a href="http://157.201.194.254/~ercanbracks/cs313/heidi/teacher/?action=profile&teacherid=<?php echo $_SESSION['clientid'];?>&type=view">My Profile</a></li>
        </ul>
    </li>
    <?php
    }
    if ($_SESSION['loginflag'] == TRUE && $_SESSION['clientrights'] > 18) {
    ?>
    <li><a href="#" id="nav-admin">Administration</a>
        <ul class="nav-hidden nav-admin">
            <li><a href="http://157.201.194.254/~ercanbracks/cs313/heidi/administration/?action=studentpage">Festival Students</a></li>
            <li><a href="http://157.201.194.254/~ercanbracks/cs313/heidi/administration/?action=teacherpage">Festival Teachers</a></li>
<!--            <li><a href="http://157.201.194.254/~ercanbracks/cs313/heidi/administration/?action=judgespage">Festival Judges</a></li>-->
            <li><a href="http://157.201.194.254/~ercanbracks/cs313/heidi/administration/?action=resourcespage">Festival Resources</a></li>
            <li><a href="http://157.201.194.254/~ercanbracks/cs313/heidi/administration/?action=registrationspage">Festival Registration</a></li>
            <li><a href="http://157.201.194.254/~ercanbracks/cs313/heidi/administration/?action=timeslots">Festival Time Slots</a></li>
            <li><a href="http://157.201.194.254/~ercanbracks/cs313/heidi/administration/?action=festivalspage">Festivals</a></li>
        </ul>

    </li>
    <?php 
    }
    
    if ($_SESSION['loginflag'] == FALSE || $_SESSION['clientrights'] < 5) {
    ?>
    <li><a href="http://157.201.194.254/~ercanbracks/cs313/heidi/clients/login.php">Login</a></li>
    <li><a href="http://157.201.194.254/~ercanbracks/cs313/heidi/clients/register.php">Register</a></li>
    <?php 
    }
    
    if ($_SESSION['loginflag'] == TRUE && $_SESSION['clientrights'] > 8) {
    ?>
    <li><a href="http://157.201.194.254/~ercanbracks/cs313/heidi/index.php?action=logout">Logout</a></li>
    <li class="welcome-name">Welcome <?php echo $_SESSION['clientfirst'] . " " . $_SESSION['clientlast']; ?>! </li>
    <?php 
    }
    ?>
</ul>