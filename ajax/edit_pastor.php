<?php
require __DIR__ .'/../assets/database/connection.php';

$pastor_id = $_GET['pastorid'];

$query = "SELECT * FROM pastor WHERE id = $pastor_id";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result)

?>                          
                          <div class="modal-body">
                              <input type="hidden" name="page" value="pastor">
                              <input type="hidden" name="id" value="<?php echo $row['id']?>">
                             <div class="mx-3">
                                <label for="title">Name</label>
                                <input type="text" name="name" id="title" class="form-control" validate="required" value="<?php echo $row['name']?>">
                             </div>
                             <div class="mx-3">
                                <label for="place">Position</label>
                                <input type="text" name="position" id="place" class="form-control" validate="required" value="<?php echo $row['position']?>">
                             </div>
                             <div class="mx-3">
                                <label for="description">Description</label>
                               <textarea name="description" id="description" class="form-control" rows="7"><?php echo $row['description']?></textarea>
                             </div>
                     
                             <div class="mx-3">
                                <!-- <label for="image">Image</label>
                                <input type="file" name="image" id="image" class="form-control" accept="image/*"> -->
                                <div class="imageupload panel panel-default mt-3">
                                       <div class="panel-heading clearfix">
                                       <label for="status">Image</label>
                                         </div>
                                       <div class="file-tab panel-body">
                                       
                                        <br>
                                     <label class="btn btn-primary btn-file btn-info text-white">
                                        <span>Browse</span>
                                     <!-- The file is stored here. -->
                                      <input type="file" id="image" name="image">
                                     </label>
                                     <button type="button" class="btn btn-default active">Remove</button>
                                   </div>
                                </div>
                             </div>
                           </div>