<?php
/**
 * The code defines two functions, side_bar() and user_side_bar(), which generate HTML code for a
 * sidebar menu for an admin and a user respectively.
 */

function side_bar(){
?>
    <header class="header shadow" id="header">
        <div class="header_toggle" style="display:flex; align-items:center;"> 
        <i class='bx bx-menu' id="header-toggle"></i>
        <h2 style = "padding-left:1.5rem; color:black;">Society Management</h2>
    </div>
        <div>
        <a href="admin_logout.php"> 
                <i class='bx bx-log-out nav_icon'></i> 
                <span class="sign-out">SignOut</span> 
        </a>
</div>
    </header>
    <div class="l-navbar" id="nav-bar">
        <nav class="nav">
            <div>
                 <a href="#" class="nav_logo nav_mobile_link"> 
                    <i class='bx bx-layer nav_logo-icon'></i> 
                    <span class="nav_logo-name">Menu</span> 
                </a>
                <div class="nav_list"> 
                    <a href="admin_home.php" class="nav_link active"> 
                        <i class='bx bx-grid-alt nav_icon'></i> 
                        <span class="nav_name">Dashboard</span> 
                    </a> 
                    <a href="wing.php" class="nav_link"> 
                        <i class='fa fa-list-ul'></i> 
                        <span class="nav_name">Wings</span> 
                    </a> 
                    <a href="flats.php" class="nav_link"> 
                        <i class='fa fa-list-ul'></i> 
                        <span class="nav_name">Flats</span> 
                    </a> 
                    <a href="members.php" class="nav_link"> 
                        <i class='fa fa-users'></i> 
                        <span class="nav_name">Members</span> 
                    </a> 
                    <a href="bills.php" class="nav_link"> 
                        <i class='fa fa-file'></i> 
                        <span class="nav_name">Bills</span> 
                    </a> 
                    <a href="complaints.php" class="nav_link"> 
                        <i class='fa fa-exclamation-circle'></i> 
                        <span class="nav_name">View Complaints</span> 
                    </a> 
                    <a href="visitors.php" class="nav_link"> 
                        <i class='fa fa-users'></i> 
                        <span class="nav_name">Visitors</span> 
                    </a> 
                    <a href="notice.php" class="nav_link"> 
                        <i class='fa fa-bell'></i> 
                        <span class="nav_name">Add Notice</span> 
                    </a> 
                    <a href="reports.php" class="nav_link"> 
                        <i class='fa fa-bar-chart'></i> 
                        <span class="nav_name">Reports</span> 
                    </a> 
                    <a href="contact.php" class="nav_link"> 
                        <i class='fa fa-bar-chart'></i> 
                        <span class="nav_name">Contact List</span> 
                    </a> 
            </div>
            </div> 
        </nav>
    </div>
<?php
}
function user_side_bar(){
?>

<header class="header shadow" id="header">
        <div class="header_toggle" style="display:flex; align-items:center;"> <i class='bx bx-menu' id="header-toggle"></i>
        <h2 style = "padding-left:1.5rem; color:black;">Society Management</h2>
        </div>
        <div>
        <a href="user_logout.php"> 
                <i class='bx bx-log-out nav_icon'></i> 
                <span class="sign-out">SignOut</span> 
        </a>
</div>
    </header>
    <div class="l-navbar" id="nav-bar">
        <nav class="nav">
            <div>
                 <a href="#" class="nav_logo nav_mobile_link"> 
                    <i class='bx bx-layer nav_logo-icon'></i> 
                    <span class="nav_logo-name">Menu</span> 
                </a>
                <div class="nav_list"> 
                    <a href="user_home.php" class="nav_link active"> 
                        <i class='bx bx-grid-alt nav_icon'></i> 
                        <span class="nav_name">Dashboard</span> 
                    </a> 
                    <a href="user_bills.php" class="nav_link"> 
                        <i class='fa fa-file'></i> 
                        <span class="nav_name">View Bills</span> 
                    </a> 
                    <a href="complain_register.php" class="nav_link"> 
                        <i class='fa fa-exclamation-circle'></i> 
                        <span class="nav_name">Complain Register</span> 
                    </a> 
                    <a href="flat_visitor.php" class="nav_link"> 
                        <i class='fa fa-users'></i> 
                        <span class="nav_name">Visitors</span> 
                    </a> 
                    <a href="user_notice.php" class="nav_link"> 
                        <i class='fa fa-bell'></i> 
                        <span class="nav_name">Notice</span> 
                    </a> 
                    <a href="user_complain.php" class="nav_link"> 
                        <i class='fa fa-bar-chart'></i> 
                        <span class="nav_name">My Complaints</span> 
                    </a> 
                    <a href="user_account.php" class="nav_link"> 
                        <i class='fa fa-user'></i> 
                        <span class="nav_name">Account</span> 
                    </a> 
            </div>
            </div> 
        </nav>
    </div>
<?php
}
?>