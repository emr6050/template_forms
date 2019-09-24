<?php
/*
 //This is an attempt at creating the ASQ-3
 */

include_once("../../globals.php");
include_once("$srcdir/api.inc");

$form_name = "ASQ:SE-2";
$form_folder = "asqse2";

formHeader("Form: ".$form_name);
$returnurl = 'encounter_top.php';
$formid = 0 + (isset($_GET['id']) ? $_GET['id'] : 0);

?>

<html>
<head>
  <?php html_header_show();?>

  <!-- other supporting javascript code -->
  <script type="text/javascript" src="<?php echo $GLOBALS['assets_static_relative']; ?>/jquery-min-3-1-1/index.js"></script>
  <script type="text/javascript" src="<?php echo $GLOBALS['webroot'] ?>/library/textformat.js?v=<?php echo $v_js_includes; ?>"></script>
  <script type="text/javascript" src="<?php echo $GLOBALS['assets_static_relative']; ?>/jquery-datetimepicker-2-5-4/build/jquery.datetimepicker.full.min.js"></script>

  <!-- page styles -->
  <link rel="stylesheet" href="<?php echo $css_header;?>" type="text/css">
  <link rel="stylesheet" href="../../forms/<?php echo $form_folder; ?>/style.css?v=<?php echo $v_js_includes; ?>" type="text/css">
  <link rel="stylesheet" href="<?php echo $GLOBALS['assets_static_relative']; ?>/jquery-datetimepicker-2-5-4/build/jquery.datetimepicker.min.css">

  <script language="JavaScript">
    // this line is to assist the calendar text boxes
    var mypcc = '<?php echo $GLOBALS['phone_country_code'] ?>';
  </script>
</head>

<body class="body_top">

  <?php echo date("F d, Y", time()); ?>

  <form method=post action="<?php echo $rootdir;?>/forms/<?php echo $form_folder; ?>/save.php?mode=new" name="my_form">
  <span class="title"><?php xl($form_name, 'e'); ?></span><br>

  <!-- Save/Cancel buttons -->
  <input type="button" class="save" value="<?php xl('Save', 'e'); ?>"> &nbsp;
  <input type="button" class="dontsave" value="<?php xl('Don\'t Save', 'e'); ?>"> &nbsp;

  <!-- container for the main body of the form -->
  <div id="form_container">
    <div id="preliminaryInfo">
      Questionnaire interval:
        <select name="quesInterval" required >
          <option value="">Select....</option>
          <option value="02">2 Month</option>
          <option value="06">6 Month</option>
          <option value="12">12 Month</option>
          <option value="18">18 Month</option>
          <option value="24">24 Month</option>
          <option value="30">30 Month</option>
          <option value="36">36 Month</option>
          <option value="48">48 Month</option>
          <option value="60">60 Month</option>
        </select>
      <br><br>
      Was age adjusted for prematurity when selecting questionnaire?
      <input type="radio" name="ageAdjustment" value="y" /> Yes. &nbsp;
      <input type="radio" name="ageAdjustment" value="n" /> No.
    </div>

    <div id="scores">
      <h4>Score Totals</h4>
      <table id="total_scores" class="display" style="width:100%">
          <thead>
              <tr>
                  <th>Area</th>
                  <th align="left">Score</th>
              </tr>
          </thead>
          <tbody>
            <tr>
              <td>Page 1</td>
              <td align="center"><input onblur="calcTotal()" type="number" name="score_page" id="score_page1" min="0" max="75" step="5" value="0"></td>
            </tr>
            <tr>
              <td>Page 2</td>
              <td align="center"><input onblur="calcTotal()" type="number" name="score_page" id="score_page2" min="0" max="75" step="5" value="0"></td>
            </tr>
            <tr>
              <td>Page 3</td>
              <td align="center"><input onblur="calcTotal()" type="number" name="score_page" id="score_page3" min="0" max="75" step="5" value="0"></td>
            </tr>
            <tr>
              <td>Page 4</td>
              <td align="center"><input onblur="calcTotal()" type="number" name="score_page" id="score_page4" min="0" max="75" step="5" value="0"></td>
            </tr>
            <tr>
              <td>Total</td>
              <td align="center"><input type="number" name="score_total" id="score_total" min="0" max="300" step="5" value=""></td>
            </tr>
          </tbody>
        </table>
    </div>

    <div id="text_responses">
      <h4>Overall Responses</h4>
      1. Requires followup? <input type="checkbox" name="response1"> &nbsp;
      Comments: <textarea name="comments1" cols="30" rows="1"></textarea>
      <br><br>
      2. Requires followup? <input type="checkbox" name="response2"> &nbsp;
      Comments: <textarea name="comments2" cols="30" rows="1"></textarea>
      <br><br>
      3. Requires followup? <input type="checkbox" name="response3"> &nbsp;
      Comments: <textarea name="comments3" cols="30" rows="1"></textarea>
    </div>

    <div id="followup_considerations">
      <h4>Follow-up Referral Considerations</h4>
      <input type="checkbox" name="f_consider_settingTime"> Setting/time factors
      <br>
      <input type="checkbox" name="f_consider_devlopmental"> Developmental factors
      <br>
      <input type="checkbox" name="f_consider_health"> Health factors
      <br>
      <input type="checkbox" name="f_consider_familyCultural"> Family/cultural factors
      <br>
      <input type="checkbox" name="f_consider_parentConcerns"> Parent concerns
    </div>

    <div id="followup_action_taken">
      <h4>Follow-up Action Taken</h4>
      <input type="checkbox" name="shouldFollowup"> Provide activities and rescreen in <input type="number" name="followupDelay" min="0" max="4" value="1"> months.
      <br>
      <input type="checkbox" name="shareResults"> Share results with primary health care provider
      <br>
      <input type="checkbox" name="provideEduMat"> Provide parent education materials
      <br>
      <input type="checkbox" name="provideInfo"> Provide information about available parenting classes or support groups
      <br>
      <input type="checkbox" name="repeatDiffCaregiver"> Have another caregiver complete ASQ:SE-2. List caregiver here (e.g., grandparent, teacher):
      &nbsp;<textarea name="diffCaregiver" cols="30" rows="1"></textarea>.
      <br>
      <input type="checkbox" name="doDevelopScreen"> Administer developmental screening (e.g., ASQ-3)
      <br>
      <input type="checkbox" name="referToSpecialEd"> Refer to early intervention/early childhood special education
      <br>
      <input type="checkbox" name="referForEvaluation"> Refer for social-emotional, behavioral, or mental health evaluation
      <br>
      <input type="checkbox" name="other"> Other (specify): <textarea name="otherReasonForReferral" cols="30" rows="1"></textarea>.
    </div>

    <div id="extra">
      <h4>Notes</h4>
      <textarea name="notes" id="notes" cols="80" rows="4"></textarea>
      <br><br>
    </div>

  </div> <!-- end form_container -->

  <!-- Save/Cancel buttons -->
  <input type="button" class="save" value="<?php xl('Save', 'e'); ?>"> &nbsp;
  <input type="button" class="dontsave" value="<?php xl('Don\'t Save', 'e'); ?>"> &nbsp;
  </form>

</body>

<script language="javascript">

  // for calculating the total score based on the input scores from each page
  function calcTotal(){
    var arr = document.getElementsByName('score_page');
    var tot=0;
    for(var i=0;i<arr.length;i++){
        if(parseInt(arr[i].value))
            tot += parseInt(arr[i].value);
    }
    document.getElementById('total').value = tot;
  }


  // jQuery stuff to make the page a little easier to use
  $(document).ready(function(){
      $(".save").click(function() { top.restoreSession(); document.my_form.submit(); });
      $(".dontsave").click(function() { parent.closeTab(window.name, false); });

      $('.datepicker').datetimepicker({
          <?php $datetimepicker_timepicker = false; ?>
          <?php $datetimepicker_showseconds = false; ?>
          <?php $datetimepicker_formatInput = false; ?>
          <?php require($GLOBALS['srcdir'] . '/js/xl/jquery-datetimepicker-2-5-4.js.php'); ?>
          <?php // can add any additional javascript settings to datetimepicker here; need to prepend first setting with a comma ?>
      });
  });

  //var comm_score = document.getElementById("comm_score")

</script>

</html>
