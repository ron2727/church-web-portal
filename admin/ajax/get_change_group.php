<?php
require __DIR__ .'/../../assets/database/connection.php';

$user_id = $_GET['userid'];

$query = "SELECT * FROM user_account WHERE user_id = '$user_id'";
$name = mysqli_fetch_assoc(mysqli_query($conn, $query));
?>                
                


                             <input id="userId" type="hidden" name="userid" value="<?php echo $user_id?>">
                               <div class="row">
                                 <div class="col-6">
                                    <div id="inputField">
                                       <label for="password">Name</label><br>
                                       <input class="border-0" type="text" value="<?php echo $name['firstname']. ' ' .$name['lastname']?>" readonly>
                                    </div>
                                 </div>
                                 <div class="col-6">
                                     <div id="inputField">
                                       <label for="password">Current Group</label><br>
                                       <input class="border-0" type="text" value="<?php echo $name['ministry']?>" readonly>
                                     </div>
                                 </div>
                               </div>
                              <br>
                               
                              <div id="select_ministry">
                              <label>Church Ministry / Group</label>
                               <select name="ministry" type="text" id="minList" class="form-select" aria-label="Default select example">
                                   <option value="<?php echo $name['ministry']?>" selected><?php echo $name['ministry']?></option>
                                   <option value="Youth">Youth</option>
                                   <option value="Adult">Adult</option>
                                   <option value="Music Team">Music Team</option>
                                </select>
                             </div>
                              <br>
                           </div>


 