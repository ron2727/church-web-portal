<nav
       id="sidebarMenu"
       class="collapse d-lg-block sidebar collapse bg-dark"
       >
    <div class="position-sticky">
      <div class="list-group list-group-flush mx-3 mt-4">
      <div id="navTitle" class="border-bottom text-white p-4">
                 <h3 class="text-center">Admin</h3>
            </div>
          <div id="navMenus" class="mt-5">
                <div id="events" class="dropup">
                    <div class="nav-text dropdown-toggle w-100 text-light d-flex align-items-center justify-content-between p-2">
                    <span><i class="bi bi-calendar-check"></i> Events</span>
                    </div>
                     <div id="navSubMenu" class="ps-4">
                        <ul class="nav events-menus collapse flex-column border-start">
                                <li class="nav-item px-2">
                                    <a href="events.php?status=upcoming" class="nav-link rounded-2 upcoming-link">Upcoming</a>
                                </li>
                                <li class="nav-item px-2">
                                    <a href="events.php?status=past" class="nav-link rounded-2 past-link">Past</a>
                                </li>
                            </ul>
                     </div>
                </div>
                 <!-- Services -->
                <div id="services" class="dropup">
                    <div class="nav-text dropdown-toggle w-100 text-light d-flex align-items-center justify-content-between p-2">
                    <span><i class="bi bi-envelope-paper"></i> Service</span>
                    </div>
                     <div id="navSubMenu" class="ps-4">
                        <ul class="nav service-menus collapse flex-column border-start">
                                <li class="nav-item px-2">
                                    <a class="nav-link rounded-2 baptism-link">Baptism</a>
                                </li>
                                <li class="nav-item px-2">
                                    <a class="nav-link rounded-2 wedding-link">Wedding</a>
                                </li>
                                <li class="nav-item px-2">
                                    <a href="funeral.php" class="nav-link rounded-2 funeral-link">Funeral</a>
                                </li>
                            </ul>
                     </div>
                </div>
                <!-- User Account -->
                <div id="userAcc" class="dropup">
                    <div class="nav-text dropdown-toggle w-100 text-light d-flex align-items-center justify-content-between p-2">
                         <span><i class="bi bi-people"></i> User Account</span>
                    </div>
                     <div id="navSubMenu" class="ps-4">
                        <ul class="nav collapse flex-column border-start">
                                <li class="nav-item px-2">
                                    <a id="admin" class="nav-link rounded-2">Admin</a>
                                </li>
                                <li class="nav-item px-2">
                                    <a class="nav-link rounded-2">Activated</a>
                                </li>
                                <li class="nav-item px-2">
                                    <a class="nav-link rounded-2">Decline</a>
                                </li>
                            </ul>
                     </div>
                </div>
       <!-- Forum -->
       <div id="Forum" class="dropup">
                    <div class="nav-text dropdown-toggle w-100 text-light d-flex align-items-center justify-content-between p-2">
                    <span><i class="bi bi-chat-square-text"></i> Forum</span>
                    </div>
                     <div id="navSubMenu" class="ps-4">
                        <ul class="nav collapse flex-column border-start">
                                <li class="nav-item px-2">
                                    <a class="nav-link rounded-2">Topics</a>
                                </li>
                                <li class="nav-item px-2">
                                    <a class="nav-link rounded-2">Post</a>
                                </li>
                                <li class="nav-item px-2">
                                    <a class="nav-link rounded-2">Report</a>
                                </li>
                            </ul>
                     </div>
                </div>
      
                        <!-- Pages -->
                        <div id="pages" class="dropup">
                    <div class="nav-text dropdown-toggle w-100 text-light d-flex align-items-center justify-content-between p-2">
                    <span><i class="bi bi-file-break"></i> Pages</span>
                    </div>
                     <div id="navSubMenu" class="ps-4">
                        <ul class="nav collapse flex-column border-start">
                                <li class="nav-item px-2">
                                    <a class="nav-link rounded-2">Edit Pastor</a>
                                </li>
                                <li class="nav-item px-2">
                                    <a class="nav-link rounded-2">Edit About Us</a>
                                </li>
                                <li class="nav-item px-2">
                                    <a class="nav-link rounded-2">Edit Visit Us</a>
                                </li>
                            </ul>
                     </div>
                </div>
                  <!-- Report -->
                  <div id="pages" class="dropup">
                    <div class="nav-text dropdown-toggle w-100 text-light d-flex align-items-center justify-content-between p-2">
                    <span><i class="bi bi-newspaper"></i> Report</span>
                    </div>
                     <div id="navSubMenu" class="ps-4">
                        <ul class="nav collapse flex-column border-start">
                                <li class="nav-item px-2">
                                    <a class="nav-link rounded-2">Events</a>
                                </li>
                                <li class="nav-item px-2">
                                    <a class="nav-link rounded-2">User</a>
                                </li>
                                <li class="nav-item px-2">
                                    <a class="nav-link rounded-2">Service</a>
                                </li>
                            </ul>
                     </div>
                </div>
                 <!-- Archive -->
                 <div id="archive" class="dropup">
                    <div class="nav-text dropdown-toggle w-100 text-light d-flex align-items-center justify-content-between p-2">
                    <span><i class="bi bi-archive-fill"></i> Archive</span>
                    </div>
                     <div id="navSubMenu" class="ps-4">
                        <ul class="nav collapse flex-column border-start">
                                <li class="nav-item px-2">
                                    <a class="nav-link rounded-2">Service</a>
                                </li>
                                <li class="nav-item px-2">
                                    <a class="nav-link rounded-2">User Account</a>
                                </li>
                                <li class="nav-item px-2">
                                    <a class="nav-link rounded-2">Forum</a>
                                </li>
                                <li class="nav-item px-2">
                                    <a class="nav-link rounded-2">Events</a>
                                </li>
                            </ul>
                     </div>
                </div>
                <div id="logout">
                    <div class="nav-text w-100 text-light p-2 border-top mt-3">
                       <a href="../logout.php" class="nav-link">
                        <span><i class="bi bi-box-arrow-right"></i> Logout</span>
                       </a>
                        
                    </div>
                </div>
                     
            </div>
            
      </div>
    </div>
  </nav>
  <!-- Sidebar -->

  <!-- Navbar -->
  <nav
       id="main-navbar"
       class="navbar navbar-expand-lg navbar-light bg-white fixed-top"
       >
    <!-- Container wrapper -->
    <div class="container-fluid">

      <!-- Brand -->
      <a class="navbar-brand" href="#">
        <img
             src="https://mdbootstrap.com/img/logo/mdb-transaprent-noshadows.png"
             height="25"
             alt=""
             loading="lazy"
             />
      </a>
      <div class="dropdown text-light">
                       <div class="d-flex align-items-center" data-bs-toggle="dropdown">
                          <span style="font-weight: bold;"><?php echo $row['firstname'].' '.$row['lastname']?></span>
                          <span style="margin-left:5px; font-size:25px">
                            <i class="bi bi-person-circle"></i>
                           </span>
                       </div>
                        <ul class="dropdown-menu">
                         <li><a href="" class="dropdown-item">Profile</a></li>
                         <li><a href="../logout.php" class="dropdown-item">Logout</a></li>
                        </ul>
         </div> 
    </div>
    <!-- Container wrapper -->
  </nav>