           <div id="navMenus" class="mt-5">
               <div style="cursor: pointer;" class="nav-text w-100 text-light d-flex align-items-center justify-content-between p-2">
                  <a href="index.php" class="nav-link">
                    <span class="dash-link"><i class="bi bi-speedometer"></i> Dashboard</span>
                  </a>
               </div>
                <div id="events" class="dropup">
                    <div style="cursor: pointer;" class="nav-text dropdown-toggle w-100 text-light d-flex align-items-center justify-content-between p-2">
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
                    <div style="cursor: pointer;" class="nav-text dropdown-toggle w-100 text-light d-flex align-items-center justify-content-between p-2">
                    <span><i class="bi bi-envelope-paper"></i> Service</span>
                    </div>
                     <div id="navSubMenu" class="ps-4">
                        <ul class="nav service-menus collapse flex-column border-start">
                                <li class="nav-item px-3">
                                 <div style="cursor: pointer;" class="nav-text dropdown-toggle w-100 text-light d-flex align-items-center justify-content-between p-2">
                                   <span>Baptism</span>
                                  </div>
                                   <div id="navSubMenu" class="ps-4">
                                      <ul class="bap-menus nav collapse flex-column border-start">
                                         <li class="nav-item px-2">
                                           <a href="baptism.php" class="child-link nav-link rounded-2">Child</a>
                                         </li>
                                         <li class="nav-item px-2">
                                           <a href="baptism_youth.php" class="youth-link nav-link rounded-2">Youth</a>
                                         </li>
                                      </ul>
                                  </div>
                                    <!-- <a href="baptism.php" class="nav-link rounded-2 baptism-link">Baptism</a> -->
                                </li>
                                <li class="nav-item px-2">
                                    <a href="wedding.php" class="nav-link rounded-2 wedding-link">Wedding</a>
                                </li>
                                <li class="nav-item px-2">
                                    <a href="funeral.php" class="nav-link rounded-2 funeral-link">Funeral</a>
                                </li>
                            </ul>
                     </div>
                </div>
                <!-- User Account -->
                <div id="userAcc" class="dropup">
                    <div style="cursor: pointer;" class="nav-text dropdown-toggle w-100 text-light d-flex align-items-center justify-content-between p-2">
                         <span><i class="bi bi-people"></i> User Account</span>
                    </div>
                     <div id="navSubMenu" class="ps-4">
                        <ul class="user-menus nav collapse flex-column border-start">
                                <!-- <li class="nav-item px-2">
                                    <a href="admin.php" id="admin" class="admin-link nav-link rounded-2">Admin</a>
                                </li> -->
                                <li class="nav-item px-2">
                                    <a href="member.php" class="member-link nav-link rounded-2">Member</a>
                                </li>
                                <li class="nav-item px-2">
                                    <a href="pending.php" class="pending-link nav-link rounded-2">Pending</a>
                                </li>
                            </ul>
                     </div>
                </div>
       <!-- Forum -->
            <div id="Forum" class="dropup">
                    <div style="cursor: pointer;" class="nav-text dropdown-toggle w-100 text-light d-flex align-items-center justify-content-between p-2">
                    <span><i class="bi bi-chat-square-text"></i> Forum</span>
                    </div>
                     <div id="navSubMenu" class="ps-4">
                        <ul class="forum-menus nav collapse flex-column border-start">
                                
                                
                                
                                <li class="nav-item px-3">
                                  <div style="cursor: pointer;" class="nav-text dropdown-toggle w-100 text-light d-flex align-items-center justify-content-between p-2">
                                   <span>Reported</span>
                                  </div>
                                   <div id="navSubMenu" class="ps-4">
                                      <ul class="reported-menus nav collapse flex-column border-start">
                                          <li class="nav-item px-2">
                                            <a href="reported_member.php" class="ban_member-link nav-link rounded-2">Member</a>
                                           </li>
                                           <li class="nav-item px-2">
                                               <a href="reported_post.php" class="reported_post-link nav-link rounded-2">Post</a>
                                            </li>
                                            <li class="nav-item px-2">
                                               <a href="reported_comment.php" class="reported_topic-link nav-link rounded-2">Comment</a>
                                            </li>
                                      </ul>
                                  </div>
                                </li>
                                <li class="nav-item px-3">
                                  <div style="cursor: pointer;" class="nav-text dropdown-toggle w-100 text-light d-flex align-items-center justify-content-between p-2">
                                   <span>Banned</span>
                                  </div>
                                   <div id="navSubMenu" class="ps-4">
                                      <ul class="banned-menus nav collapse flex-column border-start">
                                        <li class="nav-item px-2">
                                           <a href="banned.php?type=member" class="mem-link nav-link rounded-2">Member</a>
                                         </li>
                                        <li class="nav-item px-2">
                                           <a href="banned.php?type=post" class="post-link nav-link rounded-2">Post</a>
                                         </li>
                                         <li class="nav-item px-2">
                                           <a href="banned.php?type=comment" class="topic-link nav-link rounded-2">Comment</a>
                                         </li>
                                      </ul>
                                  </div>
                                </li>
                            </ul>
                     </div>
                </div>
      
                        <!-- Pages -->
                        <div id="pages" class="dropup">
                    <div style="cursor: pointer;" class="nav-text dropdown-toggle w-100 text-light d-flex align-items-center justify-content-between p-2">
                    <span><i class="bi bi-file-break"></i> Edit Pastor</span>
                    </div>
                     <div id="navSubMenu" class="ps-4">
                        <ul class="pages-menus nav collapse flex-column border-start">
                                <li class="nav-item px-2">
                                    <a href="pages.php" class="nav-link rounded-2 pastor-link">Pastor</a>
                                </li>
 
                            </ul>
                     </div>
                </div>
                  <!-- Report -->
                  <div id="pages" class="dropup">
                    <div style="cursor: pointer;" class="nav-text dropdown-toggle w-100 text-light d-flex align-items-center justify-content-between p-2">
                    <span><i class="bi bi-newspaper"></i> Report</span>
                    </div>
                     <div id="navSubMenu" class="ps-4">
                        <ul class="report-menus nav collapse flex-column border-start">
                                <li class="nav-item px-2">
                                    <a href="event_report.php" class="ev-report-link nav-link rounded-2">Events</a>
                                </li>
                                <li class="nav-item px-2">
                                    <a href="service_report.php" class="ser-report-link nav-link rounded-2">Service</a>
                                </li>
                            </ul>
                     </div>
                </div>
                 <!-- Archive -->
                 <div id="archive" class="dropup">
                    <div style="cursor: pointer;" class="nav-text dropdown-toggle w-100 text-light d-flex align-items-center justify-content-between p-2">
                    <span><i class="bi bi-archive-fill"></i> Archive</span>
                    </div>
                     <div id="navSubMenu" class="ps-4">
                        <ul class="archived-menus nav collapse flex-column border-start">
                                <li class="nav-item px-3">
                                  <div style="cursor: pointer;" class="nav-text dropdown-toggle w-100 text-light d-flex align-items-center justify-content-between p-2">
                                   <span>Service</span>
                                  </div>
                                   <div id="navSubMenu" class="ps-4">
                                      <ul class="service-archived-menus nav collapse flex-column border-start">
                                         <li class="nav-item px-3">
                                            <div style="cursor: pointer;" class="nav-text dropdown-toggle w-100 text-light d-flex align-items-center justify-content-between p-2">
                                              <span>Baptism</span>
                                            </div>
                                           <div id="navSubMenu" class="ps-4">
                                             <ul class="bap-menus1 nav collapse flex-column border-start">
                                               <li class="nav-item px-2">
                                                 <a href="archived_baptism.php?type=child" class="child1-link nav-link rounded-2">Child</a>
                                               </li>
                                                <li class="nav-item px-2">
                                                  <a href="archived_baptism.php?type=youth" class="youth1-link nav-link rounded-2">Youth</a>
                                                </li>
                                              </ul>
                                            </div>
                                          </li>
                                         <li class="nav-item px-2">
                                           <a href="archived_wedding.php" class="arcwedding-link nav-link rounded-2">Wedding</a>
                                         </li>
                                         <li class="nav-item px-2">
                                           <a href="archived_funeral.php" class="arcfuneral-link nav-link rounded-2">Funeral</a>
                                         </li>
                                      </ul>
                                  </div>
                                </li>
                                <!-- <li class="nav-item px-2">
                                    <a href="archive_account.php" class="pending-acc nav-link rounded-2">Account</a>
                                </li> -->
                            </ul>
                     </div>
                </div>
                <div id="logout">
                    <div style="cursor: pointer;" class="nav-text w-100 text-light p-2 border-top mt-3">
                       <a href="../index.php" class="nav-link">
                        <span><i class="bi bi-box-arrow-left"></i> Exit</span>
                       </a>
                        
                    </div>
                </div>
                     
            </div>
            