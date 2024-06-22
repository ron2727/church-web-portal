<?php
session_start();
require __DIR__ .'/../assets/database/connection.php';
require __DIR__ .'/is_user_logged.php';

if (isset($_GET['service'])) {
        $form_id = $_GET['form_id'];
    if ($_GET['service'] === 'baptism') {
        $query = "SELECT * FROM baptism_form WHERE form_id = '$form_id'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);

        $query = "SELECT * FROM baptism_consent WHERE form_id = '$form_id'";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
            $row1 = mysqli_fetch_assoc($result);
            $sql = 'INSERT INTO archived_consent(
                id,
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
                 '.$row1['id'].',
                 "'.$form_id.'",
                 "'.$row1['f_given_name'].'",
                 "'.$row1['f_lastname'].'",
                 "'.$row1['f_english_name'].'",
                 "'.$row1['f_religion'].'",
                 "'.$row1['f_attend_worship'].'",
                 "'.$row1['f_others'].'",
                 "'.$row1['m_given_name'].'",
                 "'.$row1['m_lastname'].'",
                 "'.$row1['m_english_name'].'",
                 "'.$row1['m_religion'].'",
                 "'.$row1['m_attend_worship'].'",
                 "'.$row1['m_others'].'",
                 "'.$row1['date'].'",
                 "'.$row1['contact_num'].'")';
                  mysqli_query($conn, $sql);  
        }
        $sql = 'INSERT INTO archived_baptism(
            form_id,
            tracking_number, 
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
            status) VALUES(
             "'.$form_id.'",
             "'.$row['tracking_number'].'",
             "'.$row['service'].'",
             "'.$row['baptism_type'].'",
             "'.$row['sched_date'].'",
             "'.$row['time_from'].'",
             "'.$row['time_to'].'",
             "'.$row['date_of_application'].'",
             "'.$row['title'].'",
             "'.$row['firstname'].'",
             "'.$row['lastname'].'",
             "'.$row['address'].'",
             "'.$row['email'].'",
             "'.$row['telephone'].'",
             "'.$row['date_of_birth'].'",
             "'.$row['nationality'].'",
             "'.$row['occupation'].'",
             "'.$row['marital_status'].'",
             "'.$row['kingdom_group'].'",
             "'.$row['date_of_salvation'].'",
             "'.$row['attend_worship'].'",
             "'.$row['starting_from'].'",
             "'.$row['testimony'].'",
             "'.$row['pre_req1'].'",
             "'.$row['pre_req2'].'",
             "'.$row['prev_religion'].'",
             "'.$row['age'].'",
             "'.$row['image'].'",
             "'.$row['status'].'")';
           mysqli_query($conn, $sql);
            
        //    $query = "DELETE baptism_form, baptism_consent
        //              FROM baptism_form
        //              INNER JOIN baptism_consent ON baptism_form.form_id = baptism_consent.form_id
        //              WHERE baptism_form.form_id = '$form_id'";
           $query = "DELETE FROM baptism_consent WHERE form_id = '$form_id'";
           mysqli_query($conn, $query);       
           $query = "DELETE FROM baptism_form WHERE form_id = '$form_id'";
           mysqli_query($conn, $query);   
           header("Location: baptism.php?type=".$_GET['type']."&action=archived");
           exit;
        
    }
    if ($_GET['service'] === 'wedding') {
        $query = "SELECT * FROM wedding_form WHERE id = '$form_id'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);

        $sql = 'INSERT INTO archived_wedding(
            id,
            tracking_number, 
            service,
            sched_date, 
            time_from,
            time_to,
            sched_redate, 
            time_refrom,
            time_reto,
            applicant, 
            bride_fname,
            bride_lname,
            bride_address,
            bride_phone,
            bride_email,
            bride_date_of_bap,
            bride_deno_of_ch,
            bride_pres_ch_mem,
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
            groom_deno_of_ch,
            groom_pres_ch_mem,
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
            status
            ) VALUES(
             "'.$row['id'].'",
             "'.$row['tracking_number'].'",
             "'.$row['service'].'",
             "'.$row['sched_date'].'",
             "'.$row['time_from'].'",
             "'.$row['time_to'].'",
             "'.$row['sched_redate'].'",
             "'.$row['time_refrom'].'",
             "'.$row['time_reto'].'",
             "'.$row['applicant'].'",
             "'.$row['bride_fname'].'",
             "'.$row['bride_lname'].'",
             "'.$row['bride_address'].'",
             "'.$row['bride_phone'].'",
             "'.$row['bride_email'].'",
             "'.$row['bride_date_of_bap'].'",
             "'.$row['bride_deno_of_ch'].'",
             "'.$row['bride_pres_ch_mem'].'",
             "'.$row['bride_pastor_name'].'",
             "'.$row['bride_pastor_phone'].'",
             "'.$row['bride_pastor_email'].'",
             "'.$row['bride_f_name'].'",
             "'.$row['bride_f_phone'].'",
             "'.$row['bride_m_name'].'",
             "'.$row['bride_m_phone'].'",
             "'.$row['bride_parent_add'].'",
             "'.$row['groom_fname'].'",
             "'.$row['groom_lname'].'",
             "'.$row['groom_address'].'",
             "'.$row['groom_phone'].'",
             "'.$row['groom_email'].'",
             "'.$row['groom_date_of_bap'].'",
             "'.$row['groom_deno_of_ch'].'",
             "'.$row['groom_pres_ch_mem'].'",
             "'.$row['groom_pastor_name'].'",
             "'.$row['groom_pastor_phone'].'",
             "'.$row['groom_pastor_email'].'",
             "'.$row['groom_f_name'].'",
             "'.$row['groom_f_phone'].'",
             "'.$row['groom_m_name'].'",
             "'.$row['groom_m_phone'].'",
             "'.$row['groom_parent_add'].'",
             "'.$row['pastor_perform_ser'].'",
             "'.$row['number_guests'].'",
             "'.$row['maid_of_honor'].'",
             "'.$row['best_man'].'",
             "'.$row['bridemaids'].'",
             "'.$row['groomen'].'",
             "'.$row['flower_girl'].'",
             "'.$row['ring_bearear'].'",
             "'.$row['ushers'].'",
             "'.$row['pianist'].'",
             "'.$row['soloist'].'",
             "'.$row['other_musicians'].'",
             "'.$row['sound_technician'].'",
             "'.$row['photographer'].'",
             "'.$row['other_information'].'",
             "'.$row['status'].'"
             )';
             mysqli_query($conn, $sql);

             $query = "DELETE FROM wedding_form WHERE id = $form_id";
             mysqli_query($conn, $query);
             header("Location: wedding.php?action=archived");
             exit;
    }
    if ($_GET['service'] === 'funeral') {
        $query = "SELECT * FROM funeral_form WHERE form_id = $form_id";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);

        $sql = 'INSERT INTO archived_funeral(
            form_id,
            tracking_number, 
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
            deceased_church_deno,
            deceased_dateofbaptism,
            deceased_church_membership_ptd,
            applicant_fname,
            applicant_lname,
            applicant_mname,
            applicant_birthday,
            applicant_address,
            applicant_rttd,
            applicant_pftb,
            applicant_ns_place,
            applicant_ns_date,
            applicant_ns_time,
            applicant_fs_place,
            applicant_fs_date,
            applicant_fs_time,
            applicant_contactnum,
            applicant_email,
            status) VALUES(
             '.$row['form_id'].',
             "'.$row['tracking_number'].'",
             "'.$row['service'].'",
             "'.$row['sched_date'].'",
             "'.$row['time_from'].'",
             "'.$row['time_to'].'",
             "'.$row['deceased_fname'].'",
             "'.$row['deceased_lname'].'",
             "'.$row['deceased_mname'].'",
             "'.$row['deceased_birthday'].'",
             "'.$row['deceased_birthplace_city'].'",
             "'.$row['deceased_birthplace_province'].'",
             "'.$row['deceased_birthplace_country'].'",
             "'.$row['deceased_dateofdeath'].'",
             "'.$row['deceased_natureofdeath'].'",
             "'.$row['deceased_church_deno'].'",
             "'.$row['deceased_dateofbaptism'].'",
             "'.$row['deceased_church_membership_ptd'].'",
             "'.$row['applicant_fname'].'",
             "'.$row['applicant_lname'].'",
             "'.$row['applicant_mname'].'",
             "'.$row['applicant_birthday'].'",
             "'.$row['applicant_address'].'",
             "'.$row['applicant_rttd'].'",
             "'.$row['applicant_pftb'].'",
             "'.$row['applicant_ns_place'].'",
             "'.$row['applicant_ns_date'].'",
             "'.$row['applicant_ns_time'].'",
             "'.$row['applicant_fs_place'].'",
             "'.$row['applicant_fs_date'].'",
             "'.$row['applicant_fs_time'].'",
             "'.$row['applicant_contactnum'].'",
             "'.$row['applicant_email'].'",
             "'.$row['status'].'")';
             mysqli_query($conn, $sql);

             $query = "DELETE FROM funeral_form WHERE form_id = $form_id";
             mysqli_query($conn, $query);
             header("Location: funeral.php?action=archived");
             exit;
    }
}

?>