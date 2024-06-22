<?php
require __DIR__ .'/assets/database/connection.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: forum_guest.php");
    exit;
}
 
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <title>Navigation</title>
    <style>

       img{
        width: 50px;
        height: 50px;
        border-radius: 50%;
       }
       #date{
        color: #6c6c6c;
       }
       #userName{
        font-weight: bold;
       }
       .username-text{
         font-size: 1.3rem;
       }
       .label-head{
        font-size: 1rem;
       }
       .notif-date{
    font-size: 0.7rem;
   }
 
   .notif-profile-img{
      width: 80px;
      height: 80px;
      border-radius: 50%;
   }
   .source-name{
    font-weight: bold;
    font-size: 1rem;
   }
   .notif-type{
    font-size: 1rem;
   }
   .content-con{
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
   }
       .dropdown-item:hover{
         cursor: pointer;
       }
    /* responsive */
    .main-con{
      width: 60%;
    }
    .header{
         padding: 15px 20px 15px 20px;
         margin-top: 10px;
      }
    .notif-con{
      padding: 10px 0px 10px 0px;
    }
    .bi-dot{
      font-size: 3rem;
    }
    .title{
        font-size: 1.1rem;
    }
    #postList{
      padding: 40px
    }
    @media only screen and (max-width: 765px) {
      #postList{
      padding: 20px
    }
      .main-con{
      width: 100%;
      }
      .header{
         padding: 5px 10px 5px 10px;
         margin-top: 10px;
      }
      .header h3{
         font-size: 1rem;
      }
      .notif-profile-img{
        width: 50px;
        height: 50px;
        border-radius: 50%;
      }
      .source-name,.notif-type,.content-con{
       font-size: 0.7rem;
      }
      .bi-dot{
       font-size: 2rem;
      }
      #loaderCon{
            font-size: 0.5;
          }
          #btnLoadmore{
            height: 25px;
            font-size: 0.5rem;
          }
          #spin{
            height: 15px;
            width: 15px;
          }
          .no-more{
            font-size: 0.5rem;
          }
    }
    </style>
</head>
<body class="bg-white">
        <!-- Navigation -->
        <?php include('forum_nav.php')?>
     

      <main>
               
          <div class="container-fluid bg-white d-flex justify-content-center">
                
          
            <!-- post list -->
               <div class="main-con">
                 <div class="header container-fluid border mb-2">
                       <h3>Forum Rules</h3>
                  </div>    
          
           
              <div id="postList" class="container border py-3" style="font-family: Poppins;">
                 
               <p class="title">
               Our forum is a place where people can interact and have discussions about different topics. We ask that you follow these guidelines to ensure that our forums have some productive conversation. These rules and guidelines are enforced by administrators, and at discretion he may ban posts but also comment if its reported multiple times without warning. Also, failure to comply with these rules or our code of conduct may result in a ban from the forum.
               </p>
               <p class="title">
               We rely on all forum members to help keep these discussion forums a safe place for people to share and view information. To do this, we request that all members comply with the following rules when contributing to the discussion forums:
               </p>
                
               <!-- ruless -->
               <p>
                 <i class="bi bi-pin-angle-fill text-danger"></i> <span style="font-weight:bold;">Keep it friendly.</span> Refrain from demeaning, discriminatory, or harassing behaviour and speech.
               </p>
               <p>
                 <i class="bi bi-pin-angle-fill text-danger"></i> <span style="font-weight:bold;">Be courteous and respectful.</span>  Appreciate that others may have an opinion different from yours
               </p>
               <p>
                 <i class="bi bi-pin-angle-fill text-danger"></i> <span style="font-weight:bold;">Stay on topic.</span> When creating a new discussion thread, give a clear topic title and put your post in the appropriate category. When contributing to an existing discussion, try to stay 'on topic'. If something new comes up within a topic that you would like to discuss, start a new thread.
               </p>
               <p>
                 <i class="bi bi-pin-angle-fill text-danger"></i><span style="font-weight:bold;">Share your knowledge.</span> Don't hold back in sharing your knowledge – it's likely someone will find it useful or interesting. When you give information, provide your sources.
               </p>
                <p class="title">
                  We maintain the rights to remove posts if its reported multiple times and its really not followed our forum rules you can report the post and also comment, that:
                </p>

                <p>
                  <i class="bi bi-pin-angle-fill text-danger"></i> contains disrespectful or derogatory remarks about any person
                </p>
                <p>
                  <i class="bi bi-pin-angle-fill text-danger"></i> contains advice or content that we believe is damaging, unhelpful or distressing to others
                </p>
                <p>
                  <i class="bi bi-pin-angle-fill text-danger"></i> contains swearing or offensive language, is nonsensical and/or irrelevant
                </p>
                <p>
                  <i class="bi bi-pin-angle-fill text-danger"></i> promotes personal beliefs in a way that is disrespectful of the choices of others
                </p>
                <p>
                  <i class="bi bi-pin-angle-fill text-danger"></i> is racist, sexist, homophobic, sexually explicit or suggestive, abusive or otherwise discriminatory or objectionable
                </p>
            </div>
          </div>
           


          
      </main>



          <!-- Footer -->
          <footer class="bg-light text-center text-lg-start">
             <hr>
             <div id="footerText" class="text-center p-3">
                 © <?php echo date('Y')?> Copyright: Taytay Immanuel Church
              </div>
     </footer>

      <script>
          $(document).ready(function(){
            let pageNum = 8;
                
                $('#spin').hide();
               $('#btnLoadMore').click(function(){
                   $('#spin').show();
                   $('#btnLoadMore').hide();
                 setTimeout(() => {
                     $.ajax({
                     url: 'ajax/load_more.php',
                     method: 'GET',
                     data: {
                        start: pageNum,
                        page: 'all_notification',
                     },
                     success: function(data){
                          if (!$.trim(data)) {
                           $('#spin').hide();
                           $('#btnLoadMore').hide();
                           $('#postList').append('<p class="text-center no-more">No More Notification</p>');
                          
                          }else{
                           $('.notif-list').append(data);
                           $('#spin').hide();
                           $('#btnLoadMore').show();
                          }
                     }
                   })
                   pageNum = pageNum + 5;
                 }, 1000);
                   
               })
  
          })
     </script>
 </body>
</html>