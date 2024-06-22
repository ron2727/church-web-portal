                         


                     <div class="modal-content">
                           <div class="modal-header">
                              <h4>Ban Account</h4>
                              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                           </div>
                              <div class="modal-body">
                                <input type="hidden" name="userid" value="<?php echo $_GET['userid']?>">
                                <div id="inputField">
                                  <label for="password">Ban Duration</label><br>
                                  <input type="date" name="date" id="date" min="<?php echo date('Y-m-d')?>" class="must_match form-control">
                                </div>
                                <div id="inputField">
                                  <label for="password">Time Duration</label><br>
                                  <input type="time" name="time" id="time" class="must_match form-control">
                                </div>
                             </div>
                           <div class="modal-footer">
                              <button class="btn btn-danger" type="button" data-bs-dismiss="modal">Cancel</button>
                              <input type="submit" name="submit" id="btnSubmit" class="btn btn-primary" value="Ban account">
                           </div>
                      </div>