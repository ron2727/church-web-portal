<?php
require __DIR__ .'/assets/database/connection.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: signin.php");
    exit;
}

if ($_POST['service'] == 'Baptism') {
    $form_id = $_POST['form_id'] ?? '';
    $title = $_POST['appli_title'] ?? '';
    $firstname = $_POST['appli_fname'] ?? '';
    $lastname = $_POST['appli_lname'] ?? '';
    $address = $_POST['appli_add'] ?? '';
    $birthday = $_POST['appli_birthday'] ?? '';
    $email = $_POST['appli_email'] ?? '';
    $telephone = $_POST['appli_tel'] ?? '';
    $nationality = $_POST['appli_nation'] ?? '';
    $occupation = $_POST['appli_occu'] ?? '';
    $marital_status = $_POST['appli_marital'] ?? '';
    $kingdom_group = $_POST['kingdom_group'] ?? '';

    if ($_POST['type'] == 'child') {
      $f_given_name = $_POST['appli_FatherGname']; 
      $f_lastname = $_POST['appli_Fatherlname']; 
      $f_english_name = $_POST['appli_FatherEname'];
      $f_religion = $_POST['appli_fatherRel'];
      $f_attend_worship = $_POST['father_att_word'];
      $f_others = $_POST['appli_fatherother'];
      $m_given_name = $_POST['appli_MotherGname'];
      $m_lastname = $_POST['appli_Motherlname'];
      $m_english_name = $_POST['appli_MotherEname'];
      $m_religion = $_POST['appli_motherRel'];
      $m_attend_worship = $_POST['mother_att_word'];
      $m_others = $_POST['appli_motherother'];

      $query = "UPDATE baptism_consent SET f_given_name = '$f_given_name', f_lastname = '$f_lastname', f_english_name = '$f_english_name', f_religion = '$f_religion', f_attend_worship = '$f_attend_worship', f_others = '$f_others',
      m_given_name = '$m_given_name', m_lastname = '$m_lastname', m_english_name = '$m_english_name', m_religion = '$m_religion', m_attend_worship = '$m_attend_worship', m_others = '$m_others'
      WHERE form_id = '$form_id'";
      mysqli_query($conn, $query);
    }
     $query = "UPDATE baptism_form SET title = '$title', firstname = '$firstname', lastname = '$lastname', address = '$address', date_of_birth = '$birthday', email = '$email', telephone = '$telephone', nationality = '$nationality', occupation = '$occupation', marital_status = '$marital_status', kingdom_group = '$kingdom_group', image = '$image_new_name'
     WHERE form_id = '$form_id'";
     mysqli_query($conn, $query);
     header("Location: edit_baptism.php?action=edit&formid=$form_id&type=".$_POST['type']);
     exit;
}
if ($_POST['service'] == 'Wedding') {
  $form_id = $_POST['form_id'];
  $bride_fname  = $_POST['bridefname'];
  $bride_lname = $_POST['bridelname'];
  $bride_Add = $_POST['brideAdd'];
  $bride_phone = $_POST['bridephone'];
  $bride_email = $_POST['brideemail'];
  $bride_DateOfBap = $_POST['brideDateOfBap'];
  $bride_DenoOfCh = $_POST['brideDenoOfCh'];
  $bride_PreChMem = $_POST['bridePreChMem'];
  $bride_PasName = $_POST['bridePasName'];
  $bride_PasPhone = $_POST['bridePasPhone'];
  $bride_Pasemail = $_POST['bridePasemail'];
  $bride_FatherName = $_POST['brideFatherName'];
  $bride_FatherPhone = $_POST['brideFatherPhone'];
  $bride_MotherName = $_POST['brideMotherName'];
  $bride_MotherPhone = $_POST['brideMotherPhone'];
  $bride_ParentAdd = $_POST['brideParentAdd'];
  $groom_fname = $_POST['groomfname'];
  $groom_lname = $_POST['groomlname'];
  $groom_Add = $_POST['groomAdd'];
  $groom_phone = $_POST['groomphone'];
  $groom_emai = $_POST['groomemail'];
  $groom_DateOfBap = $_POST['groomDateOfBap'];
  $groom_DenoOfCh = $_POST['groomDenoOfCh'];
  $groom_PreChMem = $_POST['groomPreChMem'];
  $groom_PasName = $_POST['groomPasName'];
  $groom_PasPhone = $_POST['groomPasPhone'];
  $groom_Pasemail = $_POST['groomPasemail'];
  $groom_FatherName = $_POST['groomFatherName'];
  $groom_FatherPhone = $_POST['groomFatherPhone'];
  $groom_MotherName = $_POST['groomMotherName'];
  $groom_MotherPhone = $_POST['groomMotherPhone'];
  $groom_ParentAdd = $_POST['groomParentAdd'];
  $PastorPerSer = $_POST['PastorPerSer'];
  $NumOfG = $_POST['NumOfG'];
  $MaidOfHon = $_POST['MaidOfHon'];
  $BestMan = $_POST['BestMan'];
  $Bridemaids = $_POST['Bridemaids'];
  $Groomsmen = $_POST['Groomsmen'];
  $FlowerGirl = $_POST['FlowerGirl'];
  $RingBearer = $_POST['RingBearer'];
  $Candlelighters = $_POST['Candlelighters'];
  $Pianist = $_POST['Pianist'];
  $Soloist = $_POST['Soloist'];
  $OtherMusicians = $_POST['OtherMusicians'];
  $SoundTec = $_POST['SoundTec'];
  $Photographer = $_POST['Photographer'];
  $OtherInfo = $_POST['OtherInfo'];
  
  $query = "UPDATE wedding_form SET
   bride_fname = '$bride_fname',
   bride_lname = '$bride_lname',
   bride_address = '$bride_Add',
   bride_phone = '$bride_phone',
   bride_email = '$bride_email',
   bride_date_of_bap = '$bride_DateOfBap',
   bride_deno_of_ch = '$bride_DenoOfCh',
   bride_pres_ch_mem = '$bride_PreChMem',
   bride_pastor_name = '$bride_PasName',
   bride_pastor_phone = '$bride_PasPhone',
   bride_pastor_email = '$bride_Pasemail',
   bride_f_name = '$bride_FatherName',
   bride_f_phone = '$bride_FatherPhone',
   bride_m_name = '$bride_MotherName',
   bride_m_phone = '$bride_MotherPhone',
   bride_parent_add = '$bride_ParentAdd',
   groom_fname = '$groom_fname',
   groom_lname = '$groom_lname',
   groom_address = '$groom_Add',
   groom_phone = '$groom_phone',
   groom_email = '$groom_emai',
   groom_date_of_bap = '$groom_DateOfBap',
   groom_deno_of_ch = '$groom_DenoOfCh',
   groom_pres_ch_mem = '$groom_PreChMem',
   groom_pastor_name = '$groom_PasName',
   groom_pastor_phone = '$groom_PasPhone',
   groom_pastor_email = '$groom_Pasemail',
   groom_f_name = '$groom_FatherName',
   groom_f_phone = '$groom_FatherPhone',
   groom_m_name = '$groom_MotherName',
   groom_m_phone = '$groom_MotherPhone',
   groom_parent_add = '$groom_ParentAdd',
   pastor_perform_ser = '$PastorPerSer',
   number_guests = '$NumOfG',
   maid_of_honor = '$MaidOfHon',
   best_man = '$BestMan',
   bridemaids = '$Bridemaids',
   groomen = '$Groomsmen',
   flower_girl = '$FlowerGirl',
   ring_bearear = '$RingBearer',
   ushers = '$Candlelighters',
   pianist = '$Pianist',
   soloist = '$Soloist',
   other_musicians = '$OtherMusicians',
   sound_technician = '$SoundTec',
   photographer = '$Photographer',
   other_information = '$OtherInfo'
   WHERE id = $form_id";
  mysqli_query($conn, $query);
  header("Location: edit_wedding.php?action=edit&formid=$form_id");
  exit;
}
if ($_POST['service'] == 'Funeral') {
  $form_id = $_POST['form_id'];
  $dec_fname = $_POST['Deceasedfirstname'];
  $dec_lname = $_POST['Deceasedlastname'];
  $dec_mname = $_POST['Deceasedmiddlename'];
  $dec_birthday = $_POST['DeceasedBirthday'];
  $dec_birthcity = $_POST['DeceasedBirthcity'];
  $dec_birthprov = $_POST['DeceasedBirthprovince'];
  $dec_country = $_POST['DeceasedCountry'];
  $dec_datedeath = $_POST['Deceaseddatedeath'];
  $dec_naturedeath = $_POST['Deceasednaturedeath'];
  $dec_chDeno = $_POST['DecChDeno'];
  $dec_dateBap = $_POST['DecDateOfBap'];
  $dec_Memptd = $_POST['DecChMemptd'];
  $appli_fname = $_POST['Applicantfirstname'];
  $appli_lname = $_POST['Applicantlastname'];
  $appli_mname = $_POST['Applicantmiddlename'];
  $appli_birthday = $_POST['Applicantbirthday'];
  $appli_address  = $_POST['Applicantaddress'];
  $appli_RelDec  = $_POST['ApplicantRelDec'];
  $appli_PrefBody = $_POST['ApplicantPrefBody'];
  $appli_NecroPlace = $_POST['ApplicantNecroPlace'];
  $appli_NecroDate = $_POST['ApplicantNecroDate'];
  $appli_NecroTime = $_POST['ApplicantNecroTime'];
  $appli_FunePlace = $_POST['ApplicantFuneralPlace'];
  $appli_FuneDate = $_POST['ApplicantFuneralDate'];
  $appli_FuneTime = $_POST['ApplicantFuneralTime'];
  $appli_contactNum = $_POST['Applicantcontactnum'];
  $appli_email = $_POST['Applicantemail'];
  
  $query = "UPDATE funeral_form SET
   deceased_fname = '$dec_fname',
   deceased_lname = '$dec_lname',
   deceased_mname = '$dec_mname',
   deceased_birthday = '$dec_birthday',
   deceased_birthplace_city = '$dec_birthcity',
   deceased_birthplace_province = '$dec_birthprov',
   deceased_birthplace_country = '$dec_country',
   deceased_dateofdeath = '$dec_datedeath',
   deceased_natureofdeath = '$dec_naturedeath',
   deceased_church_deno = '$dec_chDeno',
   deceased_dateofbaptism = '$dec_dateBap',
   deceased_church_membership_ptd = '$dec_Memptd',
   applicant_fname = '$appli_fname',
   applicant_lname = '$appli_lname',
   applicant_mname = '$appli_mname',
   applicant_birthday = '$appli_birthday',
   applicant_address = '$appli_address',
   applicant_rttd = '$appli_RelDec',
   applicant_pftb = '$appli_PrefBody',
   applicant_ns_place = '$appli_NecroPlace',
   applicant_ns_date = '$appli_NecroDate',
   applicant_ns_time = '$appli_NecroTime',
   applicant_fs_place = '$appli_FunePlace',
   applicant_fs_date = '$appli_FuneDate',
   applicant_fs_time = '$appli_FuneTime',
   applicant_contactnum = '$appli_contactNum',
   applicant_email = '$appli_email' 
   WHERE form_id = $form_id";
  mysqli_query($conn, $query);
  header("Location: edit_funeral.php?action=edit&formid=$form_id");
  exit;
}
 
?>