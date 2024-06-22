<?php
require __DIR__ .'/../assets/database/connection.php';

$selected_date = $_GET['date'];
?>
    <div class="row">
       <div class="col-md-6">
          <label for="DateOfReher" style="font-family: Poppins; font-size:1.1rem; font-weight:bold;">Date of Rehearsal<span class="text-danger">*</span></label><br>
          <input class="form-control" validate="required" type="text" name="DateOfReher" id="dateReSchedule" autocomplete="off" placeholder="MM/DD/YY"><br>
       </div>
       <div class="col-md-6"> 
          <p class="text-center" style="font-family: Poppins; font-size:1.1rem; font-weight:bold;">Rehersal Time<span class="text-danger">*</span></p>
          <div class="rehertime">          
          </div>
       </div>
    </div>

<script>
         $('#dateReSchedule').change(function(){
            $('.rehertime').html("<div class='spinner spinner-border spinner-border-sm'></div>");
              // setTimeout(function() {
                $.ajax({
                 url: 'ajax/get_rehertime.php',
                 method: 'GET',
                 data: {date: $('#dateReSchedule').val()},
                 success: function(data){
                   $('.rehertime').html(data);
                   
                 }
              });
         })
 </script>

<?php
$query = "SELECT * FROM wedding_form";
$result = mysqli_query($conn, $query);
$booked_dates = [];
while ($row = mysqli_fetch_assoc($result)) {
  $date = $row['sched_redate'];
  $query = "SELECT * FROM wedding_form WHERE sched_redate = '$date' AND  
           (time_refrom = '10:00' AND time_reto = '12:00' OR  time_refrom = '13:00' AND time_reto = '15:00')";
  if (strtotime(date('m/d/Y')) <= strtotime($date)) {
    $total_rows = mysqli_num_rows(mysqli_query($conn, $query)); 
    if ($total_rows == 2) {
        array_push($booked_dates, $date);
    }
  }
}
?>
<script>
 
      $(document).ready(function(){
        let dates = <?php echo json_encode(array_unique($booked_dates));?>;
        duDatepicker('#dateReSchedule', {
           range: false,
           clearBtn:true,
           minDate:'<?php echo date('m/d/Y', strtotime('-12 day', strtotime(date('m/d/Y', strtotime($selected_date)))))?>',
           maxDate: '<?php echo date('m/d/Y', strtotime('-5 day', strtotime(date('m/d/Y', strtotime($selected_date)))))?>',
           disabledDates: dates,
          disabledDays: ['Sun'],
           events: {
      	      shown: function () {
                let occupiedDates = []
                for (let date of dates) {
                    date = date.split('/')
                    occupiedDates.push([parseInt(date[0] - 1), parseInt(date[1])])
                }
                $('.dudp__date').each((key, elem) => {
                 for (const dateTaken of occupiedDates) {
                   let month = elem.getAttribute('data-month')
                   let day = elem.getAttribute('data-date')
                   if (month == dateTaken[0] && day == dateTaken[1]) {
                     elem.classList.add('booked')
                   }
                 }
                })

              },
           }

        });

      })
</script>


 