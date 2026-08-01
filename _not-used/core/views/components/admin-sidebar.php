<nav id="admin-sidebar">

    <div class="sidebar-logo">
        <img src="<?= BASE_URL . '/' . $user['avatar'] ?>" alt="">
        <div>
            <h3><?= $user['name'] ?></h3>
            <span><?= $user['email'] ?></span>
        </div>
    </div>

    <ul>
        <li>
            <span class="sidebar-name">Admin Dashboard</span>
            <button onclick="toggleSidebar()" id="toggle-btn">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed"><path d="M440-240 200-480l240-240 56 56-183 184 183 184-56 56Zm264 0L464-480l240-240 56 56-183 184 183 184-56 56Z"/></svg>
            </button>
        </li>

        <hr>

        <li class="admin_li">
            <a href="<?= BASE_URL ?>admin/admin.php">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed"><path d="M240-200h120v-240h240v240h120v-360L480-740 240-560v360Zm-80 80v-480l320-240 320 240v480H520v-240h-80v240H160Zm320-350Z"/></svg>
                <span>Home</span>
            </a>
        </li>

        <li class="orders_li">
            <a href="<?= BASE_URL ?>admin/orders/orders.php">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368"><path d="M440-183v-274L200-596v274l240 139Zm80 0 240-139v-274L520-457v274Zm-80 92L160-252q-19-11-29.5-29T120-321v-318q0-22 10.5-40t29.5-29l280-161q19-11 40-11t40 11l280 161q19 11 29.5 29t10.5 40v318q0 22-10.5 40T800-252L520-91q-19 11-40 11t-40-11Zm200-528 77-44-237-137-78 45 238 136Zm-160 93 78-45-237-137-78 45 237 137Z"/></svg>
                <span>Orders</span>
            </a>
        </li>

        <!--==== USERS DROPDOWN MENU 1 ====-->
        <li>
            <button onclick=toggleSubMenu(this) class="dropdown-btn users_dropdown"> <!-- .rotate class added -->
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed"><path d="M480-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM160-160v-112q0-34 17.5-62.5T224-378q62-31 126-46.5T480-440q66 0 130 15.5T736-378q29 15 46.5 43.5T800-272v112H160Zm80-80h480v-32q0-11-5.5-20T700-306q-54-27-109-40.5T480-360q-56 0-111 13.5T260-306q-9 5-14.5 14t-5.5 20v32Zm240-320q33 0 56.5-23.5T560-640q0-33-23.5-56.5T480-720q-33 0-56.5 23.5T400-640q0 33 23.5 56.5T480-560Zm0-80Zm0 400Z"/></svg>
                <span>Users</span>
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed"><path d="M480-344 240-584l56-56 184 184 184-184 56 56-240 240Z"/></svg>
            </button>
            <ul class="sub-menu users_submenu"> <!-- .show class added -->
                <div>
                    <li class="users_list_li"><a href="<?= BASE_URL ?>admin/users/index.php">List</a></li>
                    <li class="users_create_li"><a href="<?= BASE_URL ?>admin/users/create.php">Create</a></li>
                </div>
            </ul>
        </li>

        <!--==== POSTS DROPDOWN MENU 2 ====-->
        <li>
            <button onclick=toggleSubMenu(this) class="dropdown-btn posts_dropdown"> <!-- .rotate class added -->
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368"><path d="M760-120H200q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h560q33 0 56.5 23.5T840-760v560q0 33-23.5 56.5T760-120Zm-40-160H240v60h480v-60Zm-480-60h480v-60H240v60Zm0-140h480v-240H240v240Zm0 200v60-60Zm0-60v-60 60Zm0-140v-240 240Zm0 80v-80 80Zm0 120v-60 60Z"/></svg>
                <span>Posts</span>
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed"><path d="M480-344 240-584l56-56 184 184 184-184 56 56-240 240Z"/></svg>
            </button>
            <ul class="sub-menu posts_submenu"> <!-- .show class added -->
                <div>
                    <li class="posts_list_li"><a href="<?= BASE_URL ?>admin/posts/index.php">List</a></li>
                    <li class="posts_create_li"><a href="<?= BASE_URL ?>admin/posts/create.php">Create</a></li>
                </div>
            </ul>
        </li>

        <!--==== PAGES DROPDOWN MENU 3 ====-->
        <li>
            <button onclick=toggleSubMenu(this) class="dropdown-btn pages_dropdown"> <!-- .rotate class added -->
            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368"><path d="M160-80q-33 0-56.5-23.5T80-160v-360q0-33 23.5-56.5T160-600h80v-200q0-33 23.5-56.5T320-880h480q33 0 56.5 23.5T880-800v360q0 33-23.5 56.5T800-360h-80v200q0 33-23.5 56.5T640-80H160Zm0-80h480v-280H160v280Zm560-280h80v-280H320v120h320q33 0 56.5 23.5T720-520v80Z"/></svg>
                <span>Pages</span>
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed"><path d="M480-344 240-584l56-56 184 184 184-184 56 56-240 240Z"/></svg>
            </button>
            <ul class="sub-menu pages_submenu"> <!-- .show class added -->
                <div>
                    <li class="home_li"><a href="<?= BASE_URL ?>admin/pages/home.php">Home</a></li>
                    <li class="fl_install_li"><a href="<?= BASE_URL ?>admin/pages/flooring-installation.php">Flooring Installation</a></li>
                    <li class="aboutus_li"><a href="<?= BASE_URL ?>admin/pages/aboutus.php">About Us</a></li>
                </div>
            </ul>
        </li>

        <hr>

        <li>
            <a href="<?= BASE_URL ?>">
            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368"><path d="M160-160q-33 0-56.5-23.5T80-240v-480q0-33 23.5-56.5T160-800h640q33 0 56.5 23.5T880-720v480q0 33-23.5 56.5T800-160H160Zm0-80h420v-140H160v140Zm500 0h140v-360H660v360ZM160-460h420v-140H160v140Z"/></svg>
                <span>View website</span>
            </a>
        </li>

        <li>
            <a style="cursor: pointer;" href="javascript:{}" onclick="document.getElementById('logout-form').submit();">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368"><path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h280v80H200v560h280v80H200Zm440-160-55-58 102-102H360v-80h327L585-622l55-58 200 200-200 200Z"/></svg>
                <span>Logout</span>
                <form id="logout-form" action="<?= BASE_URL ?>src/actions/logout.php" method="post" style="display: none;"></form>
            </a>
        </li>
    </ul>
</nav>