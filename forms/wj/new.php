<?php
include_once("../../globals.php");
include_once("$srcdir/api.inc");

/** CHANGE THIS name to the name of your form **/
$form_name = "Woodcock-Johnson";

/** CHANGE THIS to match the folder you created for this form **/
$form_folder = "wj";

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
<link rel="stylesheet" href="<?php echo $css_header;?>" type="text/css">
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
<br><br>
  <div id="general">
    <table id="score_summary">
      <tr>
        <td>Reading:</td>
        <td><input type="number" name="reading" min="0" ></td>
      </tr>
      <tr>
        <td>Basic Reading Skills:</td>
        <td><input type="number" name="reading_basic" min="0" ></td>
      </tr>
      <tr>
        <td>Reading Comprehension:</td>
        <td><input type="number" name="reading_comprehension" min="0" ></td>
      </tr>
      <tr>
        <td>Reading Fluency:</td>
        <td><input type="number" name="reading_fluency" min="0" ></td>
      </tr>
      <tr>
        <td>Reading Rate:</td>
        <td><input type="number" name="reading_rate" min="0" ></td>
      </tr>
      <tr>
        <td>Mathematics:</td>
        <td><input type="number" name="math" min="0" ></td>
      </tr>
      <tr>
        <td>Math Calculation Skills:</td>
        <td><input type="number" name="math_calc" min="0" ></td>
      </tr>
      <tr>
        <td>Math Problem Solving:</td>
        <td><input type="number" name="math_probSolve" min="0" ></td>
      </tr>
      <tr>
        <td>Written Language:</td>
        <td><input type="number" name="writing" min="0" ></td>
      </tr>
      <tr>
        <td>Basic Writing Skills:</td>
        <td><input type="number" name="writing_basic" min="0" ></td>
      </tr>
      <tr>
        <td>Written Expression:</td>
        <td><input type="number" name="writing_expression" min="0" ></td>
      </tr>
      <tr>
        <td>Academic Skills:</td>
        <td><input type="number" name="academic" min="0" ></td>
      </tr>
      <tr>
        <td>Academic Fluency:</td>
        <td><input type="number" name="academic_fluency" min="0" ></td>
      </tr>
      <tr>
        <td>Academic Applications:</td>
        <td><input type="number" name="academic_application" min="0" ></td>
      </tr>
      <tr>
        <td>Academic Knowledge:</td>
        <td><input type="number" name="academic_knowledge" min="0" ></td>
      </tr>
      <tr>
        <td>Phoneme-Grapheme Knowledge:</td>
        <td><input type="number" name="phoneme_grapheme_knowledge" min="0" ></td>
      </tr>
      <tr>
        <td>Brief (or Broad) Achievement:</td>
        <td><input type="number" name="brief_broad_achievement" min="0" ></td>
      </tr>
    </table>
    <br><br>
    <table>
      <tr>
        <td>ACH 1 - Letter Word Identification</td>
        <td><input type="number" name="ach1" min="0" ></td>
      </tr>
      <tr>
        <td>ACH 2 - Applied Problems</td>
        <td><input type="number" name="ach2" min="0" ></td>
      </tr>
      <tr>
        <td>ACH 3 - Spelling</td>
        <td><input type="number" name="ach3" min="0" ></td>
      </tr>
      <tr>
        <td>ACH 4 - Passage Comprehension </td>
        <td><input type="number" name="ach4" min="0" ></td>
      </tr>
      <tr>
        <td>ACH 5 - Calculation </td>
        <td><input type="number" name="ach5" min="0" ></td>
      </tr>
      <tr>
        <td>ACH 6 - Writing Samples </td>
        <td><input type="number" name="ach6" min="0" ></td>
      </tr>
      <tr>
        <td>ACH 9 - Sentence Reading Fluency </td>
        <td><input type="number" name="ach9" min="0" ></td>
      </tr>
      <tr>
        <td>ACH 10 - Math Facts Fluency</td>
        <td><input type="number" name="ach10" min="0" ></td>
      </tr>
      <tr>
        <td>ACH 11 - Sentence Writing Fluency </td>
        <td><input type="number" name="ach11" min="0" ></td>
      </tr>
      <tr>
        <td>ACH 12 – Reading Recall</td>
        <td><input type="number" name="ach12" min="0" ></td>
      </tr>
      <tr>
        <td>ACH 13- Number Matrices</td>
        <td><input type="number" name="ach13" min="0" ></td>
      </tr>
      <tr>
        <td>ACH 14- Editing</td>
        <td><input type="number" name="ach14" min="0" ></td>
      </tr>
      <tr>
        <td>ACH 15 – Word Reading Fluency</td>
        <td><input type="number" name="ach15" min="0" ></td>
      </tr>
      <tr>
        <td>ACH 16- - Spelling of Sounds</td>
        <td><input type="number" name="ach16" min="0" ></td>
      </tr>
      <tr>
        <td>ACH 17 – Reading Vocabulary</td>
        <td><input type="number" name="ach17" min="0" ></td>
      </tr>
      <tr>
        <td>ACH 18 – Science</td>
        <td><input type="number" name="ach18" min="0" ></td>
      </tr>
      <tr>
        <td>ACH 19 – Social Studies</td>
        <td><input type="number" name="ach19" min="0" ></td>
      </tr>
      <tr>
        <td>ACH 20 – Humanities</td>
        <td><input type="number" name="ach20" min="0" ></td>
      </tr>
    </table>
    <br><br>
    <table>
      <tr>
        <td>BROAD READING</td>
        <td><input type="number" name="name" min="0" ></td>
      </tr>
      <tr>
        <td>BROAD MATH</td>
        <td><input type="number" name="name" min="0" ></td>
      </tr>
      <tr>
        <td>BROAD WRITING LANGUAGE</td>
        <td><input type="number" name="name" min="0" ></td>
      </tr>
      <tr>
        <td>BROAD ACHIEVEMENT</td>
        <td><input type="number" name="name" min="0" ></td>
      </tr>
    </table>
  </div>

<br><br>
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
