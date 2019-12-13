<?php
include_once("../../globals.php");
include_once("$srcdir/api.inc");

/** CHANGE THIS name to the name of your form **/
$form_name = "ADOS-2";

/** CHANGE THIS to match the folder you created for this form **/
$form_folder = "ados2";

formHeader("Form: ".$forn_name);

$returnurl = 'encounter_top.php';
?>

<html><head>
<?php html_header_show();?>

<!-- other supporting javascript code -->
<script type="text/javascript" src="<?php echo $GLOBALS['assets_static_relative']; ?>/jquery-min-3-1-1/index.js"></script>
<script type="text/javascript" src="<?php echo $GLOBALS['webroot'] ?>/library/textformat.js?v=<?php echo $v_js_includes; ?>"></script>
<script type="text/javascript" src="<?php echo $GLOBALS['assets_static_relative']; ?>/jquery-datetimepicker-2-5-4/build/jquery.datetimepicker.full.min.js"></script>

<!-- page styles -->
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
<br><br>

  <!-- container for the main body of the form -->
  <div id="form_container">
    <h4>Algorithm, Module: <input type="number" name="ados2_algorithm" min="0" max="6" ></h4>

    <h4>Scoring</h4>
    <table id="scores">
      <head>
        <tr>
          <th>Category</th>
          <th>Score</th>
        </tr>
      </head>
      <body>
        <tr>
          <td>Social Affect (SA) Total</td>
          <td><input type="number" name="sa_total" min="0" max="10"></td>
        </tr>
        <tr>
          <td>Restricted and Repetitive Behavior (RRB) Total</td>
          <td><input type="number" name="rrb_total" min="0"  max="10"></td>
        </tr>
      </body>
    </table>
    <h4>Classification/Diagnosis</h4>
    ADOS-2 Classification:
      <select name="ados2_classification" required>
        <option value="">Select....</option>
        <option value="autism">Autism</option>
        <option value="autism_spectrum">Autism Spectrum</option>
        <option value="non_spectrum">Non-spectrum</option>
      </select><br>
    Overall Diagnosis:
    <br><textarea name="diagnosis" cols="40" rows="3"></textarea><br>
    <h4>ADOS-2 Comparison Score:<input type="number" name="ados2_comp_score" min="0" max="10"></h4>
  </div> <!-- end form_container -->

  <div id="extra">
    <h4>Notes</h4>
    <textarea name="notes" id="notes" cols="80" rows="4"></textarea>
    <br><br>
  </div>

<br><br>
<!-- Save/Cancel buttons -->
<input type="button" class="save" value="<?php xl('Save', 'e'); ?>"> &nbsp;
<input type="button" class="dontsave" value="<?php xl('Don\'t Save', 'e'); ?>"> &nbsp;
</form>

</body>

<script language="javascript">

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
</script>

</html>
