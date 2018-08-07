<?php
include_once ("mail/functions.php");
define ("MAIL_FORM", 1);
define ("MAIL_THANKS", 2);

$page = MAIL_FORM;
$action = "";
// When the form is posted, substitute $is_send for the value of is_send.
if(!empty($_POST)):
    $action = $_POST["action"];
    $page = MAIL_THANKS;
endif;
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">

    <title>Single Page Contact Form with PHP</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
    
            
            var $input_fullname = $("input[name='fullname']");
            var $input_email = $("input[name='email']");
            var $input_tel = $("input[name='tel']");
            var $select_province = $("select[name='province']");
            var $input_radio = $("input[type='radio']");
            

            $("form").submit(function(){
                var error_flags = new Array();
                error_flags = [];

                if($input_fullname.val() == "") {
                     error_flags.push('true');
                     $input_fullname.next(".error").remove();
                     if ($input_fullname.next().length != 1){
                        
                        $input_fullname.after("<p class='error alert alert-danger' role='alert'>Your full name is empty.</p>");
                    }
                } else {
                    $input_fullname.next(".error").remove();
                }
                if($input_email.val() == "") {
                    error_flags.push('true');
                    $input_email.next(".error").remove();
                    if ($input_email.next().length != 1){
                        $input_email.after("<p class='error alert alert-danger' role='alert'>Your email is empty.</p>");
                    }
                } else if(!$input_email.val().match(/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/)){
                    error_flags.push('true');
                    $input_email.next(".error").remove();
                    $input_email.after("<p class='error alert alert-danger' role='alert'>Wrong Email address format</p>");
                } else {
                    $input_email.next(".error").remove();
                }
                if($input_tel.val() == "") {
                    error_flags.push('true');
                    if ($input_tel.next().length != 1) {
                        $input_tel.after("<p class='error alert alert-danger' role='alert'>Your Tel is empty.</p>");
                    }
                }
                if($select_province.val() == "") {
                    error_flags.push('true');
                    if ($select_province.next().length != 1) {
                        $select_province.after("<p class='error alert alert-danger' role='alert'>Your Province is not choosen.</p>");
                    }
                }
                if(!$input_radio.is(':checked')) {
                    error_flags.push('true');
                    if ($("#radio-fieldset").next().length != 1) {
                        $("#radio-fieldset").after("<p class='error alert alert-danger' role='alert'>Radio is not choosen.</p>");
                    }
                }
                if(!$("input[type='checkbox']").is(':checked')) {
                    error_flags.push('true');
                    
                    if ($("#checkbox-field").next().length != 1) {
                        $("#checkbox-field").after("<p class='error alert alert-danger' role='alert'>Checkbox is not choosen.</p>");
                    }
                }
                if($("textarea[name='message']").val() == "") {
                    error_flags.push('true');
                    if ($("textarea[name='message']").next().length != 1) {
                        $("textarea[name='message']").after("<p class='error alert alert-danger' role='alert'>Textarea is empty.</p>");
                    }
                } else {
                    error_flags.push('true');
                    $("textarea[name='message']").next("");
                }
                console.log(error_flags);

                if (error_flags) {
                    return false;
                }
                
            });
        });
    </script>
  </head>
  <body>
    <div class="container" id="contact">
    <h1>Simple Contact Form with PHP</h1>

    <?php 
        switch ($page) {
            case MAIL_FORM: 
    ?>

    
    <form method="post" action="#contact">
        <input type="hidden" name="action" value="true">
        <div class="form-group">
            <label for="fullname">Full Name</label>
			<input id="fullname" class="form-control" type="text" name="fullname" value="">
		</div>
        <div class="form-group">
            <label for="email">Email</label>
            <input id="email" class="form-control" type="text" name="email" value="">
        </div>
        <div class="form-group">
            <label for="tel">Tel</label>
            <input id="tel" class="form-control" type="text" name="tel" value="">
		</div>
        <div class="form-group">
            <label for="province">Province</label>
            <select class="form-control" id="province" name="province">
                <option value="">--- Select Your Province ---</option>
                <option value="Ontario">Ontario</option>
                <option value="Quebec">Quebec</option>
                <option value="Nova Scotia">Nova Scotia3</option>
            </select>
        </div>
        <fieldset class="form-group">
        <div id="radio-fieldset">
            <legend>Radio buttons</legend>
            <div class="form-check">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios1" value="option1">
                    Option one is this and that—be sure to include why it's great
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios2" value="option2">
                    Option two can be something else and selecting it will deselect option one
                </label>
            </div>
            <div class="form-check disabled">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios3" value="option3" disabled="">
                    Option three is disabled
                </label>
            </div>
            </div>
        </fieldset>
        <fieldset class="form-group">
        <div id="checkbox-field">
            <legend>Checkbox</legend>
            <div class="form-check">
            <label class="form-check-label">
                <input type="checkbox" class="form-check-input" id="checkboxSuccess" name="checkbox[]" value="Checkbox with success">
                Checkbox with success
            </label>
            </div>
            <div class="form-check">
            <label class="form-check-label">
                <input type="checkbox" class="form-check-input" id="checkboxWarning" name="checkbox[]" value="Checkbox with warning">
                Checkbox with warning
            </label>
            </div>
            <div class="form-check">
            <label class="form-check-label">
                <input type="checkbox" class="form-check-input" id="checkboxDanger" name="checkbox[]" value="Checkbox with danger">
                Checkbox with danger
            </label>
            </div>
        </div>
        </fieldset>
        <div class="form-group">	
            <label for="message">Message</label>
            <textarea id="message" class="form-control" name="message" rows="3" cols="3"></textarea>
        </div>

        
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
        <?php 
        break;
        
        case MAIL_THANKS: ?>
            <p>Thank you for your inquiry.</p>
            <a href="./">Back to Top</a>
        <?php break;
        }?>
    </div>
  </body>
</html>