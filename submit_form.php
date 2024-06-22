<?php
require __DIR__ .'/assets/database/connection.php';
use PHPMailer\PHPMailer\PHPMailer;
require 'assets/libs/phpmailer/src/Exception.php';
require 'assets/libs/phpmailer/src/PHPMailer.php';
require 'assets/libs/phpmailer/src/SMTP.php';

    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'taytayimmanuelchurchportal@gmail.com';
    $mail->Password = 'xjthcdxrvlmxchki';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    $mail->setFrom('taytayimmanuelchurchportal@gmail.com');
    if ($_POST['service'] === 'Funeral') {
        $mail->addAddress($_POST['Applicantemail']);
    }
    if ($_POST['service'] === 'Baptism') {
        $mail->addAddress($_POST['appli_email']);
    }
    if ($_POST['service'] === 'Wedding') {
        $mail->addAddress($_POST['brideemail']);
    }
    $mail->isHTML(true);
    $mail->Subject = 'Form Tracking Number';

if (isset($_POST['service'])) {
  
     $service = $_POST['service'];
    if ($service === 'Funeral') {
        if (!isset($_POST['schedTime'])) {
            header("Location: funeral_form.php?service=Funeral&error=true");
            exit;
         }
        if ($_POST['schedTime'] === "0910") {
            $time_from = "09:00";
            $time_to = "10:00";
        }
        if ($_POST['schedTime'] === "1011") {
            $time_from = "10:00";
            $time_to = "11:00";
        }
        if ($_POST['schedTime'] === "1112") {
            $time_from = "11:00";
            $time_to = "12:00";
        }
  
$sql = 'INSERT INTO funeral_form(
    user_id, 
    service,
    sched_date,
    time_from,
    time_to, 
    deceased_fname,
    deceased_lname,
    deceased_mname,
    deceased_birthday,
    deceased_birthplace_city,
    deceased_birthplace_province,
    deceased_birthplace_country,
    deceased_dateofdeath,
    deceased_natureofdeath,
    applicant_fname,
    applicant_lname,
    applicant_mname,
    applicant_birthday,
    applicant_address,
    applicant_rttd,
    applicant_pftb,
    applicant_contactnum,
    applicant_email,
    status) VALUES(
     "'.$_POST['userid'].'",
     "'.$_POST['service'].'",
     "'.$_POST['funeralDate'].'",
     "'.$time_from.'",
     "'.$time_to.'",
     "'.$_POST['Deceasedfirstname'].'",
     "'.$_POST['Deceasedlastname'].'",
     "'.$_POST['Deceasedmiddlename'].'",
     "'.$_POST['DeceasedBirthday'].'",
     "'.$_POST['DeceasedBirthcity'].'",
     "'.$_POST['DeceasedBirthprovince'].'",
     "'.$_POST['DeceasedCountry'].'",
     "'.$_POST['Deceaseddatedeath'].'",
     "'.$_POST['Deceasednaturedeath'].'",
     "'.$_POST['Applicantfirstname'].'",
     "'.$_POST['Applicantlastname'].'",
     "'.$_POST['Applicantmiddlename'].'",
     "'.$_POST['Applicantbirthday'].'",
     "'.$_POST['Applicantaddress'].'",
     "'.$_POST['ApplicantRelDec'].'",
     "'.$_POST['ApplicantPrefBody'].'",
     "'.$_POST['Applicantcontactnum'].'",
     "'.$_POST['Applicantemail'].'",
     "Pending")';
    }
    
    if ($service === 'Wedding') {
        if (!isset($_POST['schedTime'])) {
            header("Location: service_form.php?service=Wedding&error=wedtime");
            exit;
        }
        if (!isset($_POST['schedTime1'])) {
            header("Location: service_form.php?service=Wedding&error=retime");
            exit;
        }
        if ($_POST['schedTime'] === '1012') {
            $time_from = '09:00';
            $time_to = '12:00';
        }
        if ($_POST['schedTime'] === '0103') {
            $time_from = '13:00';
            $time_to = '16:00';
        }
        if ($_POST['schedTime1'] === '1012') {
            $time_refrom = '10:00';
            $time_reto = '12:00';
        }
        if ($_POST['schedTime1'] === '0103') {
            $time_refrom = '13:00';
            $time_reto = '15:00';
        }
        $image_tmpname = $_FILES['m_license']['tmp_name'];
        $img_name = $_FILES['m_license']['name'];
        $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
        $m_license = uniqid("MLICENSE-IMG", false). '.' .$img_ex;
        $image_upload_path = 'assets/uploaded_images/wedding_requirements/' .$m_license;
        move_uploaded_file($image_tmpname, $image_upload_path);

        $image_tmpname = $_FILES['m_counseling']['tmp_name'];
        $img_name = $_FILES['m_counseling']['name'];
        $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
        $m_counseling = uniqid("MCOUNSELING-IMG", false). '.' .$img_ex;
        $image_upload_path = 'assets/uploaded_images/wedding_requirements/' .$m_counseling;
        move_uploaded_file($image_tmpname, $image_upload_path);

        $sql = 'INSERT INTO wedding_form( 
            service,
            applicant, 
            sched_date,
            time_from,
            time_to,
            sched_redate,
            time_refrom,
            time_reto,
            bride_fname,
            bride_lname,
            bride_address,
            bride_phone,
            bride_email,
            bride_date_of_bap,
            bride_pastor_name,
            bride_pastor_phone,
            bride_pastor_email,
            bride_f_name,
            bride_f_phone,
            bride_m_name,
            bride_m_phone,
            bride_parent_add,
            groom_fname,
            groom_lname,
            groom_address,
            groom_phone,
            groom_email,
            groom_date_of_bap,
            groom_pastor_name,
            groom_pastor_phone,
            groom_pastor_email,
            groom_f_name,
            groom_f_phone,
            groom_m_name,
            groom_m_phone,
            groom_parent_add,
            pastor_perform_ser,
            number_guests,
            maid_of_honor,
            best_man,
            bridemaids,
            groomen,
            flower_girl,
            ring_bearear,
            ushers,
            pianist,
            soloist,
            other_musicians,
            sound_technician,
            photographer,
            other_information,
            status,
            m_license,
            m_counseling
            ) VALUES(
             "'.$_POST['service'].'",
             "'.$_POST['wedding_appli'].'",
             "'.$_POST['DesWedDate'].'",
             "'.$time_from.'",
             "'.$time_to.'",
             "'.$_POST['DateOfReher'].'",
             "'.$time_refrom.'",
             "'.$time_reto.'",
             "'.$_POST['bridefname'].'",
             "'.$_POST['bridelname'].'",
             "'.$_POST['brideAdd'].'",
             "'.$_POST['bridephone'].'",
             "'.$_POST['brideemail'].'",
             "'.$_POST['brideDateOfBap'].'",
             "'.$_POST['bridePasName'].'",
             "'.$_POST['bridePasPhone'].'",
             "'.$_POST['bridePasemail'].'",
             "'.$_POST['brideFatherName'].'",
             "'.$_POST['brideFatherPhone'].'",
             "'.$_POST['brideMotherName'].'",
             "'.$_POST['brideMotherPhone'].'",
             "'.$_POST['brideParentAdd'].'",
             "'.$_POST['groomfname'].'",
             "'.$_POST['groomlname'].'",
             "'.$_POST['groomAdd'].'",
             "'.$_POST['groomphone'].'",
             "'.$_POST['groomemail'].'",
             "'.$_POST['groomDateOfBap'].'",
             "'.$_POST['groomPasName'].'",
             "'.$_POST['groomPasPhone'].'",
             "'.$_POST['groomPasemail'].'",
             "'.$_POST['groomFatherName'].'",
             "'.$_POST['groomFatherPhone'].'",
             "'.$_POST['groomMotherName'].'",
             "'.$_POST['groomMotherPhone'].'",
             "'.$_POST['groomParentAdd'].'",
             "'.$_POST['PastorPerSer'].'",
             "'.$_POST['NumOfG'].'",
             "'.$_POST['MaidOfHon'].'",
             "'.$_POST['BestMan'].'",
             "'.$_POST['Bridemaids'].'",
             "'.$_POST['Groomsmen'].'",
             "'.$_POST['FlowerGirl'].'",
             "'.$_POST['RingBearer'].'",
             "'.$_POST['Candlelighters'].'",
             "'.$_POST['Pianist'].'",
             "'.$_POST['Soloist'].'",
             "'.$_POST['OtherMusicians'].'",
             "'.$_POST['SoundTec'].'",
             "'.$_POST['Photographer'].'",
             "'.$_POST['OtherInfo'].'",
             "Pending",
             "'.$m_license.'",
             "'.$m_counseling.'"
             )';
       }
       if ($service === 'Baptism') {
        if ($_POST['type'] === 'child') {
             if (!isset($_POST['schedTime'])) {
                header("Location: baptism_form.php?service=bchild&error=true");
                exit;
            }
        }
        $id = uniqid();
        $current_date = date("Y-m-d");
        $age = date("Y") - date("Y", strtotime($_POST['appli_birthday'] ?? date('y-m-d')));
        // Insert applicant consent to the DB
             if ($age < 18) {
                $sql = 'INSERT INTO baptism_consent(
                    form_id,
                    f_given_name, 
                    f_lastname, 
                    f_english_name,
                    f_religion,
                    f_attend_worship,
                    f_others,
                    m_given_name,
                    m_lastname,
                    m_english_name,
                    m_religion,
                    m_attend_worship,
                    m_others,
                    date,
                    contact_num) VALUES(
                     "'.$id.'",
                     "'.$_POST['appli_FatherGname'].'",
                     "'.$_POST['appli_Fatherlname'].'",
                     "'.$_POST['appli_FatherEname'].'",
                     "'.$_POST['appli_fatherRel'].'",
                     "'.$_POST['father_att_word'].'",
                     "'.$_POST['appli_fatherother'].'",
                     "'.$_POST['appli_MotherGname'].'",
                     "'.$_POST['appli_Motherlname'].'",
                     "'.$_POST['appli_MotherEname'].'",
                     "'.$_POST['appli_motherRel'].'",
                     "'.$_POST['mother_att_word'].'",
                     "'.$_POST['appli_motherother'].'",
                     "'.$current_date.'",
                     "'.$_POST['appli_conum'].'")';
                      mysqli_query($conn, $sql);
             }
             if (!empty($_FILES['image']['tmp_name'])) {
                $image_tmpname = $_FILES['image']['tmp_name'];
                $img_name = $_FILES['image']['name'];
                $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                $image_new_name = uniqid("BAP-IMG", false). '.' .$img_ex;
                $image_upload_path = 'assets/uploaded_images/baptism/' .$image_new_name;
                move_uploaded_file($image_tmpname, $image_upload_path);
             }
                $image_tmpname = $_FILES['b_certificate']['tmp_name'];
                $img_name = $_FILES['b_certificate']['name'];
                $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                $psa = uniqid("PSA-IMG", false). '.' .$img_ex;
                $image_upload_path = 'assets/uploaded_images/birth_certificate/' .$psa;
                move_uploaded_file($image_tmpname, $image_upload_path);

             if ($_POST['type'] === 'child') {
                $type = $_POST['type'];
                if ($_POST['schedTime'] === '0910') {
                    $time_from = '09:00';
                    $time_to = '10:00';
                   
                }
                if ($_POST['schedTime'] === '1011') {
                    $time_from = '10:00';
                    $time_to = '11:00';
                }
            }
            if ($_POST['type'] === 'youth') {
                 $type = $_POST['type'];
                 $time_from = "15:00";
                 $time_to = "17:00";
            }
        // Insert applicant info to the DB
        $sql = 'INSERT INTO baptism_form(
            form_id,
            user_id,
            service,
            baptism_type,
            sched_date,
            time_from,
            time_to, 
            date_of_application,
            title,
            firstname,
            lastname,
            address,
            email,
            telephone,
            date_of_birth,
            nationality,
            occupation,
            marital_status,
            kingdom_group,
            date_of_salvation,
            attend_worship,
            starting_from,
            testimony,
            pre_req1,
            pre_req2,
            prev_religion,
            age,
            image,
            status,
            birth_certificate) VALUES(
             "'.$id.'",
             "'.$_POST['userid'].'",
             "'.$_POST['service'].'",
             "'.$type.'",
             "'.$_POST['baptismDate'].'",
             "'.$time_from.'",
             "'.$time_to.'",
             "'.$current_date.'",
             "'.$_POST['appli_title'].'",
             "'.$_POST['appli_fname'].'",
             "'.$_POST['appli_lname'].'",
             "'.$_POST['appli_add'].'",
             "'.$_POST['appli_email'].'",
             "'.$_POST['appli_tel'].'",
             "'.$_POST['appli_birthday'].'",
             "'.$_POST['appli_nation'].'",
             "'.$_POST['appli_occu'].'",
             "'.$_POST['appli_marital'].'",
             "'.$_POST['kingdom_group'].'",
             "'.$_POST['appli_date_salv'].'",
             "'.$_POST['appli_att_worsh'].'",
             "'.$_POST['appli_start_from'].'",
             "'.$_POST['appli_testimony'].'",
             "'.$_POST['preReq1'].'",
             "'.$_POST['preReq2'].'",
             "'.$_POST['appli_prevRel'].'",
             "'.$age.'",
             "'.$image_new_name.'",
             "Pending",
             "'.$psa.'")';
 
       }
       mysqli_query($conn, $sql);
      $mail->Body = '
      <div style="background:#ffffff;padding:20px 50px 20px 50px">
      <div style="padding:0px; text-align: center;">
         <img class="logo" style="height:60px;width:60px;border-radius:50%" src="https://scontent.fmnl9-2.fna.fbcdn.net/v/t39.30808-6/342063399_1681508062302123_9034264346227437366_n.jpg?_nc_cat=103&ccb=1-7&_nc_sid=730e14&_nc_eui2=AeHq_6PkMkKtpAeCL_KlQBzEoL-hKfhD6b-gv6Ep-EPpv-2YIA33WMV57GjlQ7WkiiRkgxILCoLyFDhqXmyJwE20&_nc_ohc=mSktmgjYj8kAX8RKaa1&_nc_zt=23&_nc_ht=scontent.fmnl9-2.fna&oh=00_AfAoV1QSbwTPQHE42c2FBsS7PmlP1q3B0FM-Y4Rn4o2nEw&oe=64490C95" alt="tic">
      </div>
      <h3 style="padding:0px; text-align: center;color:#355C7D;">Taytay Immanuel Church</h3>
        <br>
        <p style="color:#355C7D;">Hello!</p>
        <p style="color:#355C7D;">We Received your request and your</span></p>
        <p style="color:#355C7D;">Thank You!</p>
         <br>
        <p style="font-weight:bold;color:#355C7D;">Your can track your request by going to My Booking page</p>
 
    </div>
      ';
      $mail->send();
       header("Location: confirmation.php?confirmation=service");
       exit;
    
    }

 
?>