
<style>
  .row-reachus div:nth-child(1) i{
   font-size: 1.8rem;
  }

@media only screen and (max-width: 765px) {
  /* .row-phone div:nth-child(1) i{
     font-size: 2rem;
  } */
  .row-reachus div:nth-child(2) h5{
   font-size: 1rem;
  }
  .row-reachus div:nth-child(2) p{
   font-size: 0.8rem;
  }
 
}


</style>




<footer class="text-center pb-5 pt-2 bg-white" style="border-top: 2px solid #F85C70;">     
              <div id="footerCon" class="container-fluid">
                 <div class="row">
                    <div class="col-md-6">
                          <div class="contact-info">
                             <h4 class="text-start py-3">Contact Us</h4>
                             <div class="row row-reachus">
                              <div class="col-1 pt-1 ps-1">
                               <i class="bi bi-phone"></i>
                              </div>
                              <div class="col-10">
                                  <h5 class="text-start">Phone</h5>
                                  <p class="text-start">099564196789</p>
                              </div>
                             </div>
                             <div class="row row-reachus">
                              <div class="col-1 pt-1 ps-1">
                               <i class="bi bi-envelope" style="font-size: 1.8rem;"></i>
                              </div>
                              <div class="col-10">
                                  <h5 class="text-start">Email</h5>
                                  <p class="text-start">taytayimmanuelchurchportal@gmail.com</p>
                              </div>
                             </div>
                             <div class="row row-reachus">
                              <div class="col-1 pt-1 ps-1">
                               <i class="bi bi-map" style="font-size: 1.8rem;"></i>
                              </div>
                              <div class="col-10">
                                  <h5 class="text-start">Location</h5>
                                  <p class="text-start">Road 20, Siwang Nagtinig, San Juan Taytay Rizal</p>
                              </div>
                             </div>
                             <div class="row row-reachus">
                              <div class="col-1 pt-1 ps-3">
                               <a href="https://web.facebook.com/taytayimmanuel/?_rdc=1&_rdr" target="_blank" class="nav-link">
                                <i class="bi bi-facebook" style="font-size: 1.5rem;"></i>
                               </a>
                              </div>
                              <!-- <div class="col-1 pt-1 ps-3">
                              <i class="bi bi-instagram" style="font-size: 1.5rem;"></i>
                              </div>
                              <div class="col-1 pt-1 ps-3">
                              <i class="bi bi-twitter" style="font-size: 1.5rem;"></i>
                              </div>  -->
                             </div>
                             </div>
                          </div>

                          <div class="col-md-6">
                             <h4 class="text-start py-3">Send Message</h4>
                           <div id="contactForm" style="width: 100%;">
                              <form id="sendMessForm">
                                <div>
                                   <div class="text-start">Name</div>
                                  <input type="text" name="name" class="form-control form-control-sm rounded-0 " placeholder="Enter your Name">
                                  </div>
                                <div>
                                  <div class="text-start">Email</div>
                                   <input type="text" name="email" class="form-control form-control-sm rounded-0" placeholder="Enter your Email">
                                  </div>
                                <div>
                                 <div class="text-start">Message</div>
                                  <textarea name="message" id="message" rows="4" style="resize:none; font-family:Poppins" class="form-control form-control-sm rounded-0" placeholder="Write your Message"></textarea>
                                   <div class="d-flex justify-content-between py-2">
                                      <div>
                                       <button type="submit" class="btn btn-secondary btn-sm">
                                       <span id="spin" class="spinner-border text-white spinner-border-sm me-1"></span>Submit
                                       </button>
                                      </div>
                                   </div>
                                </div>
                              </form>
                              
                         </div>
                             </div>
                    </div>
                   
                 </div>
              </div>
     </footer>



     <script>
       $('#spin').hide();
        $(document).ready(function(){
              $('#sendMessForm').submit(function(e){
                  e.preventDefault();
                  $('#spin').show();
                  let formData = $(this).serialize();
                  $.ajax({
                     url: 'ajax/send_message.php',
                     method: 'POST',
                     data: formData,
                     success: function(data){
                        $('#contactForm').html(data)
                     }
                  })
              })
        })
     </script>