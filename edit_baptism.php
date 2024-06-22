<?php
require __DIR__ . '/assets/database/connection.php';
session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: signin.php");
  exit;
}

?>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/png" sizes="310x310" href="assets/img/tic_logo.png">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/responsive.css">
  <link rel="stylesheet" href="assets/css/animation.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
  <title>Edit form</title>
  <style>
    .main-container {
      width: 60%;
      margin-top: 8rem;
    }

    @media only screen and (max-width: 765px) {
      .main-container {
        width: 100%;
      }
    }
  </style>
</head>

<body>
  <?php include('navigation.php') ?>
  <main class=" d-flex justify-content-center">
    <?php
    $user_id =  $_SESSION['user_id'];
    $form_id =  $_GET['formid'];
    $query = "SELECT * FROM baptism_form WHERE user_id = '$user_id' AND form_id = '$form_id'";
    $result = mysqli_query($conn, $query);
    $row_appli = mysqli_fetch_assoc($result);

    $query = "SELECT * FROM baptism_consent WHERE form_id = '$form_id'";
    $result = mysqli_query($conn, $query);
    $row_consent = mysqli_fetch_assoc($result);
    ?>
    <div class="main-container mb-5" >
      <?php if (isset($_GET['action'])) : ?>
        <div class="alert alert-success my-1">
          <strong>Edit save!</strong>
        </div>
      <?php endif; ?>
      <div class="py-2 border bg-white">
        <h3 class="px-3"> Edit form</h3>
      </div>
      <?php if ($_GET['type'] == 'child') : ?>
        <div class="border bg-white px-4">
          <div class="container-fluid">
            <form class="service-form" action="edit_form.php" method="POST" enctype="multipart/form-data">
              <input type="hidden" name="userid" value="<?php echo $_SESSION['user_id'] ?>">
              <input type="hidden" name="form_id" id="form_id" value="<?php echo $row_appli['form_id'] ?>">
              <input type="hidden" name="service" id="service" value="Baptism"><br>
              <input type="hidden" name="type" id="type" value="child">
              <!-- name -->

              <label class="label-head" style="font-weight:bold;">Applicant's Name</label>
              <div class="row">
                <div class="col-md-6">
                  <div id="inputFname">
                    <label for="fname">Firstname <span class="text-danger">*</span></label><br>
                    <input class="form-control" validate="required" type="text" name="appli_fname" id="fname" value="<?php echo $row_appli['firstname'] ?>"><br>
                    <small class="error"></small>
                  </div>
                </div>
                <div class="col-md-6">
                  <div id="inputSname">
                    <label for="">Lastname <span class="text-danger">*</span></label><br>
                    <input class="form-control" validate="required" type="text" name="appli_lname" id="lname" value="<?php echo $row_appli['lastname'] ?>"><br>
                  </div>
                </div>
              </div>
              <!--Applicant Address -->
              <div id="inputappli_add">
                <label for="appli_add">Address <span class="text-danger">*</span></label><br>
                <textarea name="appli_add" id="appli_add" class="form-control" validate="required"><?php echo $row_appli['address'] ?></textarea>
              </div>
              <br>
              <div id="inputSname">
                <label for="appli_birthday">Date of Birth <span class="text-danger">*</span></label><br>
                <input type="date" class="form-control" min="2022-01-01" validate="required" name="appli_birthday" id="appli_birthday" value="<?php echo $row_appli['date_of_birth'] ?>"><br>
              </div>
              <div id="inputSname">
                <label for="appli_birthday">Image <span class="text-danger">*</span></label><br>
                <input type="file" class="form-control" name="image" id="image"><br>
              </div>
              <!-- Pare Consent Form -->
              <div class="consent-container container-fluid">
                <div class="container-fluid py-3 text-center" style="font-family: Poppins; font-size:1.3rem; font-weight:bold;">
                  PARENT'S PARTICULARS
                </div>
                <!-- Father Consent -->
                <label class="label-head">Father</label>
                <div class="row">
                  <div class="col-md-4">
                    <div id="inputSname">
                      <label for="">Surname <span class="text-danger">*</span></label><br>
                      <input validate="required" class="consent-input form-control" type="text" name="appli_Fatherlname" id="appli_Fatherlname" value="<?php echo $row_consent['f_lastname'] ?>"><br>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div id="inputFname">
                      <label for="fname">Given Name <span class="text-danger">*</span></label><br>
                      <input validate="required" class="consent-input form-control" type="text" name="appli_FatherGname" id="appli_FatherGname" value="<?php echo $row_consent['f_given_name'] ?>"><br>
                      <small class="error"></small>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div id="inputFname">
                      <label for="fname">English Name</label><br>
                      <input class="consent-input form-control" type="text" name="appli_FatherEname" id="fname" value="<?php echo $row_consent['f_english_name'] ?>"><br>
                      <small class="error"></small>
                    </div>
                  </div>
                </div>
                <!-- asdasd -->
                <div class="row">
                  <div class="col-md-6">
                    <!-- Religion  -->
                    <div id="inputappli_fatherRel">
                      <label for="appli_fatherRel">Religion</label><br>
                      <input class="consent-input form-control" type="text" name="appli_fatherRel" id="appli_fatherRel" value="<?php echo $row_consent['f_religion'] ?>"><br>
                    </div>
                  </div>
                  <div class="col-md-6">

                    <div class="container-fluid">
                      <p>Attending worship regularly?</p>
                      <div class="d-flex">
                        <!-- Yes -->
                        <div class="form-check me-2">
                          <input class="form-check-input" type="radio" name="father_att_word" id="radYes" value="Yes">
                          <label class="form-check-label" for="radYes">
                            Yes
                          </label>
                        </div>
                        <!-- No -->
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="father_att_word" id="radNo" value="No">
                          <label class="form-check-label" for="radNo">
                            No
                          </label>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Other -->
                <div id="inputappli_fatherother">
                  <label for="appli_fatheromoer">Others</label><br>
                  <input class="form-control" type="text" name="appli_fatherother" id="appli_fatherother" value="<?php echo $row_consent['f_others'] ?>"><br>
                </div>
                <!-- Father Consent End -->
                <!-- Mother Consent -->
                <label class="label-head">Mother</label>
                <div class="row">
                  <div class="col-md-4">
                    <div id="inputSname">
                      <label for="">Surname <span class="text-danger">*</span></label><br>
                      <input validate="required" class="consent-input form-control" type="text" name="appli_Motherlname" id="appli_Motherlname" value="<?php echo $row_consent['m_lastname'] ?>"><br>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div id="inputFname">
                      <label for="fname">Given Name <span class="text-danger">*</span></label><br>
                      <input validate="required" class="consent-input form-control" type="text" name="appli_MotherGname" id="appli_MotherGname" value="<?php echo $row_consent['m_given_name'] ?>"><br>
                      <small class="error"></small>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div id="inputFname">
                      <label for="fname">English Name</label><br>
                      <input class="consent-input form-control" type="text" name="appli_MotherEname" value="<?php echo $row_consent['m_english_name'] ?>"><br>
                      <small class="error"></small>
                    </div>
                  </div>
                </div>
                <!-- asdasd -->
                <div class="row">
                  <div class="col-md-6">
                    <!-- Religion  -->
                    <div id="inputappli_motherRel">
                      <label for="appli_motherRel">Religion</label><br>
                      <input class="consent-input form-control" type="text" name="appli_motherRel" id="appli_motherRel" value="<?php echo $row_consent['m_religion'] ?>"><br>
                    </div>
                  </div>
                  <div class="col-md-6">

                    <div class="container-fluid">
                      <p>Attending worship regularly?</p>
                      <div class="d-flex">
                        <!-- Yes -->
                        <div class="form-check me-2">
                          <input class="form-check-input" type="radio" name="mother_att_word" id="radYes" value="Yes">
                          <label class="form-check-label" for="radYes">
                            Yes
                          </label>
                        </div>
                        <!-- No -->
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="mother_att_word" id="radNo" value="No">
                          <label class="form-check-label" for="radNo">
                            No
                          </label>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Other -->
                <div id="inputappli_motherother">
                  <label for="appli_motheromoer">Others</label><br>
                  <input class="form-control" type="text" name="appli_motherother" id="appli_motherother" value="<?php echo $row_consent['m_others'] ?>"><br>
                </div>
                <div id="inputCnum">
                  <label for="">Contact Number <span class="text-danger">*</span></label><br>
                  <input validate="required|phone" class="consent-input form-control" type="text" name="appli_conum" id="cnum" value="<?php echo $row_consent['contact_num'] ?>"><br>
                </div>
                <div id="inputappli_email">
                  <label for="appli_email">Email</label><br>
                  <input class="form-control" validate="required" type="text" name="appli_email" id="appli_email" value="<?php echo $row_appli['email'] ?>"><br>
                </div>
                <!-- Mother Consent End -->
              </div>
              <br>
              <div id="inputImage">
                <label for="image">Birth Certificate <span class="text-danger">*</span>
                  <i class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="right" title="Certificate of Live Birth from PSA of Local Civil Registrar"></i>
                </label>
                <input type="file" name="b_certificate" id="bCertificate" class="form-control" accept="image/*">
              </div>
              <br>
              <hr>
              <div class="container-fluid d-flex justify-content-end">
                <a href="booking.php" class=" btn btn-secondary mx-1">Back</a>
                <button type="submit" class="btn btn-sub btn-primary">Save</button>
              </div>
              <!-- end end end -->
            </form>
          </div>
        </div>
      <?php else : ?>
        <div class="border bg-white px-4">
          <div class="container-fluid">
            <form class="service-form" action="edit_form.php" method="POST" enctype="multipart/form-data">
              <input type="hidden" name="userid" value="<?php echo $_SESSION['user_id'] ?>">
              <input type="hidden" name="form_id" id="form_id" value="<?php echo $row_appli['form_id'] ?>">
              <input type="hidden" name="service" id="service" value="Baptism"><br>
              <input type="hidden" name="type" id="type" value="youth">
              <!-- name -->

              <label class="label-head" style="font-weight:bold;">Applicant's Name</label>
              <div class="row">
                <div class="col-md-6">
                  <div id="inputFname">
                    <label for="fname">Firstname <span class="text-danger">*</span></label><br>
                    <input class="form-control" validate="required" type="text" name="appli_fname" id="fname" value="<?php echo $row_appli['firstname'] ?>"><br>
                    <small class="error"></small>
                  </div>
                </div>
                <div class="col-md-6">
                  <div id="inputSname">
                    <label for="">Lastname <span class="text-danger">*</span></label><br>
                    <input class="form-control" validate="required" type="text" name="appli_lname" id="lname" value="<?php echo $row_appli['lastname'] ?>"><br>
                  </div>
                </div>
              </div>
              <!--Applicant Address -->
              <div id="inputappli_add">
                <label for="appli_add">Address <span class="text-danger">*</span></label><br>
                <textarea name="appli_add" id="appli_add" class="form-control" validate="required"><?php echo $row_appli['address'] ?></textarea>
              </div>
              <br>
              <div id="inputSname">
                <label for="appli_birthday">Date of Birth <span class="text-danger">*</span></label><br>
                <input type="date" class="form-control" validate="required" name="appli_birthday" id="appli_birthday" value="<?php echo $row_appli['date_of_birth'] ?>"><br>
              </div>
              <div id="inputSname">
                <label for="appli_birthday">Image <span class="text-danger">*</span></label><br>
                <input type="file" class="form-control" name="image" id="image"><br>
              </div>
              <?php if ($_GET['type'] === 'youth') : ?>
                <!-- Telephone and  Date of Birth-->
                <div class="row">
                  <div class="col-md-6">
                    <div id="inputFname">
                      <label for="appli_tel">Telephone</label><br>
                      <input class="form-control" type="text" name="appli_tel" id="appli_tel" value="<?php echo $row_appli['telephone'] ?>"><br>
                      <small class="error"></small>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div id="inputFname">
                      <label for="appli_nation">Nationality</label><br>
                      <input class="form-control" type="text" name="appli_nation" id="appli_nation" value="<?php echo $row_appli['nationality'] ?>"><br>
                      <small class="error"></small>
                    </div>
                  </div>
                </div>
                <div id="inputSname">
                  <label for="appli_occu">Occupation</label><br>
                  <input class="form-control" type="text" name="appli_occu" id="appli_occu" value="<?php echo $row_appli['occupation'] ?>"><br>
                </div>

                <!-- marital -->
                <div id="selectMarital">
                  <label>Marital Status</label>
                  <select name="appli_marital" id="rdList" class="form-select" aria-label="Default select example">
                    <option value="<?php echo $row_appli['marital_status'] ?>" selected><?php echo $row_appli['marital_status'] ?></option>
                    <option value="Single">Single</option>
                    <option value="Married">Married</option>
                    <option value="Seperated">Seperated</option>
                    <option value="Single Parent">Single Parent</option>
                    <option value="Widowed">Widowed</option>
                  </select>
                </div>
                <br>
                <!-- Name of the Kingdom group  -->
                <div id="inputkingdom_group">
                  <label for="kingdom_group">Name of the Kingdom group (If applicable): </label><br>
                  <input class="form-control" type="text" name="kingdom_group" id="kingdom_group" value="<?php echo $row_appli['kingdom_group'] ?>"><br>
                </div>
              <?php endif; ?>
              <br>
              <div id="inputImage">
                <label for="image">Birth Certificate <span class="text-danger">*</span>
                  <i class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="right" title="Certificate of Live Birth from PSA of Local Civil Registrar"></i>
                </label>
                <input type="file" name="b_certificate" id="bCertificate" class="form-control" accept="image/*">
              </div>
              <br>
              <hr>
              <div class="container-fluid d-flex justify-content-end">
                <a href="booking.php" class=" btn btn-secondary mx-1">Back</a>
                <button type="submit" class="btn btn-sub btn-primary">Save</button>
              </div>
              <!-- end end end -->
            </form>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </main>
  <?php include('footer.php') ?>
</body>

</html>