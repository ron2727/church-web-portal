<div class="modal" id="ChangeProfModal">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Change</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        Modal body..
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

<div class="modal" id="ChangePassModal">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Change Password</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <form id="changePassForm" action="<?php $_SERVER['PHP_SELF']?>" method="POST">
        <div id="changePassCon">
         <div class="text-center py-5">
            <span class="spinner spinner-border text-primary"></span>
          </div>
        </div>
           <!-- Modal footer -->
           <div class="modal-footer">
               <div class="text-end">  
                <button id="btnChangePass" type="submit" class="btn btn-primary py-2">
                  <div id="btnSubSpin"></div> Change Password
                </button>
               </div>
             </div>
      </form> 
    </div>
  </div>
</div>


<!-- Bio -->
<div class="modal" id="EditBioModal">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" class="p-0">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Edit Bio</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <!-- Modal body -->
      <form id="editBioForm" action="<?php $_SERVER['PHP_SELF']?>" method="POST">
        <div id="editBioCon">
          <div class="text-center py-5">
            <span class="spinner spinner-border text-primary"></span>
          </div>
        </div>
           <!-- Modal footer -->
           <div class="modal-footer">
               <div class="text-end">  
                <button id="btnEditBio" type="submit" class="btn btn-primary py-2">
                  <div id="btnSubSpin"></div> Save
                </button>
               </div>
             </div>
      </form>

    </div>
  </div>
</div>


<div id="modalUpload" class="modal">
          <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                     <h4>Upload Image</h4>
                     <button type="button" class="btn-close" data-bs-dismiss="modal">

                     </button>
                </div>
                <div class="modal-body">
                <div class="imageBox w-100">
                  <div class="thumbBox"></div>
                  <div class="spinner" style="display: none">Loading...</div> 
                </div>
                </div>
                <div class="modal-footer border-top-0">
                    <div class="container-fluid d-flex justify-content-between py-3">
                       
                         <button class="btn btn-warning" type="button" id="btnZoomIn"> Zoom in</button>
                      
                       
                         <button class="btn btn-warning" type="button" id="btnZoomOut"> Zoom out</button>
                      
                      
                   </div>
                   <div class="container-fluid d-flex justify-content-end py-3 border-top">
                        <div>
                          <button class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                          <button class="btn btn-primary ms-3" type="button" id="btnCrop">Save</button> 
                        </div> 
                   </div>
                </div>
            </div>
          </div>
       </div>