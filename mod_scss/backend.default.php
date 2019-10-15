<?php
// (c) 2018 Arthur Möller
//

// ----------------------------------------------------------------
// obligate check for phpwcms constants
if (!defined('PHPWCMS_ROOT')) {
    die("You Cannot Access This Script Directly, Have a Nice Day.");
}
// ----------------------------------------------------------------

// put translation back to have easier access to it - use it as relation
$BLM = & $BL['modules']['scss'];

// filepath
$modpath = $phpwcms['modules']['scss']['path'];

// include functions
include_once($modpath.'inc/functions.php');

// devmode: compile backend css
// compileFile($modpath.'inc/style.scss', $modpath.'inc/css/style.min.css', 'Crunched');

// counter for SCSS groups
$groupCounter = 0;

// checkboxState
$checkboxState = '';

// custom CSS and JS
$BE['HEADER']['be_default_style.css'] = '<link href="'.$phpwcms['modules'][$module]['dir'].'inc/css/style.min.css" rel="stylesheet" type="text/css" />';
echo '<script src="'.$phpwcms['modules'][$module]['dir'].'inc/js/jquery.min.js"></script>';
echo '<script src="'.$phpwcms['modules'][$module]['dir'].'inc/js/script.js"></script>';

if(isset($_POST['mod-scss__form'])) {

    // write groups from post data to json file
    if(isset($_POST['mod-scss__groups'])) {
        file_put_contents($modpath.'inc/groups.json',json_encode($_POST['mod-scss__groups']));
    }
    else {
        file_put_contents($modpath.'inc/groups.json','');
    }

    // write settings from post data to json file
    if(isset($_POST['mod-scss__settings'])) {
        $sArray = $_POST['mod-scss__settings'];
        $sArray['timestamp'] = time() + ($_POST['mod-scss__settings']['days'] * 86400);
        file_put_contents($modpath.'inc/settings.json',json_encode($sArray));
    }
}
?>

<div class="scss_body">
    <div class="title scss_title"><?php echo $BLM['backend_menu']; ?></div>
    <div class="error-log">
        <?php echo file_get_contents($modpath.'inc/error.log'); ?>
    </div>
    <form action="" method="post">

        <input type="hidden" name="mod-scss__form">
        <input type="hidden" name="mod-scss__settings">

        <div class="toolbar">
            <?php
            $settings = json_decode(file_get_contents($modpath.'inc/settings.json'), true);
            global $checkboxState;
            if (isset($settings['activate'])) {
                $checkboxState = 'checked';
                rename ($modpath."_frontend.init.php_", $modpath."frontend.init.php");
            }
            else {
                rename ($modpath."frontend.init.php", $modpath."_frontend.init.php_");
            }
            ?>
            <label for="activate-checkbox" class="button toolbar__button">
                <input <?php echo $checkboxState; ?> id="activate-checkbox" class="toolbar__activate-checkbox" type="checkbox" name="mod-scss__settings[activate]" value="true">
                <?php echo $BLM['scss_activateCheckbox']; ?>
            </label><button class="button js-add-group-button toolbar__button"><?php echo $BLM['scss_addGroupButton']; ?></button><button type="submit" class="button toolbar__button button--save"><?php echo $BLM['scss_submitButton']; ?></button>
        </div>

        <div class="groups">
            <?php
            // get groups from json file and create html for each
            $groups = json_decode(file_get_contents($modpath.'inc/groups.json'), true);
            if(isset($groups)) {
                foreach ($groups as $group) {
                    if (!empty($group['input']) && !empty($group['output'])) {
                        $groupCounter++;
                        if (isset($group['minify'])) {
                            createGroup($groupCounter, $group['input'], $group['output'], $group['minify']);
                        }
                        else {
                            createGroup($groupCounter, $group['input'], $group['output']);
                        }
                    }
                }
            }
            else {
                echo $BLM['scss_noGroupsText']; 
            }
            ?>
        </div>
        <div class="toolbar2">
            <?php
            global $checkboxState;
            if (isset($settings['disable'])) {
                $checkboxState = 'checked';
            }
            else {
                $checkboxState = '';
            }
            if (isset($settings['days'])) {
                $a = $settings['days'];
            }
            ?>
            <label for="disable-checkbox" class="">
                <input <?php echo $checkboxState; ?> id="disable-checkbox" class="toolbar2__disable-checkbox" type="checkbox" name="mod-scss__settings[disable]" value="true">
                <?php echo $BLM['scss_disableCheckbox']; ?>
            </label>
            <select class="toolbar2__days" name="mod-scss__settings[days]">
                <option <?php echo($a == 3) ? 'selected ' : '' ; ?>value="3">3</option>
                <option <?php echo($a == 7) ? 'selected ' : '' ; ?>value="7">7</option>
                <option <?php echo($a == 14) ? 'selected ' : '' ; ?>value="14">14</option>
            </select>
            <span><?php echo $BLM['scss_disableDays']; ?></span>

        </div>
    </form>

    <?php
    function createInputFileSelect($groupCounter = 0, $selectedFile = '') {
        $inputFileSelect = '<select class="group__input-select" name="mod-scss__groups['.$groupCounter.'][input]">';
        $inputFileSelect .= '<option value="">--</option>';

        // get scss files and create option for each
        $files = glob(PHPWCMS_TEMPLATE.'inc_scss/*.{scss}', GLOB_BRACE);
        foreach($files as $file) {
            $filename = trim(substr($file, strrpos($file, '/') + 1)); // trim directory
            $filename = preg_replace('/\\.[^.\\s]{3,4}$/', '', $filename); // remove extension
            if ($selectedFile == $filename) {
                $inputFileSelect .= '<option selected value="'.$filename.'">'.$filename.'.scss</option>';
            }
            else {
                $inputFileSelect .= '<option value="'.$filename.'">'.$filename.'.scss</option>';
            }
        }
        $inputFileSelect .= '</select>';
        echo $inputFileSelect;
    }
    ?>
    <?php function createGroup($groupCounter = 0, $inputFile = '', $outputFile = '', $minifyToggle = '') { ?>
    <?php global $BLM; ?>
    <div class="group">
        <?php createInputFileSelect($groupCounter, $inputFile); ?>
        <div class="group__angle"></div>
        <label for="minify-checkbox-<?php echo $groupCounter; ?>" class="group__minify-label"><?php echo $BLM['scss_minifyCheckbox']; ?></label>
        <?php 
                                                                                                          global $checkboxState;
                                                                                                          if ($minifyToggle == 'on') {
                                                                                                              $checkboxState = 'checked';
                                                                                                          }
                                                                                                          else {
                                                                                                              $checkboxState = '';
                                                                                                          }
        ?>
        <input <?php echo $checkboxState; ?> id="minify-checkbox-<?php echo $groupCounter; ?>" type="checkbox" name="mod-scss__groups[<?php echo $groupCounter; ?>][minify]" class="group__minify-checkbox">
        <label for="" class="group__output-label">
            <input type="text" class="group__output" name="mod-scss__groups[<?php echo $groupCounter; ?>][output]" value="<?php echo $outputFile; ?>">
        </label>
        <button class="group__delete-button" title="<?php echo $BLM['scss_deleteGroupButton']; ?>">x</button>
    </div>
    <?php } ?>

    <?php // new group template for js ?>
    <div class="new-group-tmpl">
        <?php createGroup('','','','on'); ?>
    </div>
</div>