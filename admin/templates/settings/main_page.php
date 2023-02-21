<?php
if (!empty($this->notices)) {
    foreach ($this->notices as $notice) {
        echo '<div class="notice notice-' . $notice['type'] . ' is-dismissible">
        <p>' . $notice['message'] . '</p>
       </div>';
    }
}
?>
<?php /*include 'class-handle-settings.php';*/ ?>

<form method="POST" class="form-container">
    <div class="form-header">
        <h1 class="text-center">AVS Login - Settings</h1>
    </div>

    <div class="form-content">
        <!-- Login Url -->
        <div class="field">
            <label class="avs_login_url_label" for="avs_login_url_input">
                Login Url
            </label>
            <input type="text" name="avs_login_url" id="avs_login_url_input" value="<?= get_option('avs_login_url', '/wp-admin') ?>">
        </div>

        <!-- Select theme -->
        <div class="field">
            <label class="avs_select_theme_label" for="avs_select_theme_input">
                Select a theme
                <span class="tooltip">
                    <i class="gg-info"></i>
                    <div class="tooltip-text">
                        Take a look on github about the diffrent themes
                    </div>
                </span>
            </label>
            <select class="avs_select_el" name="avs_select_theme" id="avs_select_theme_input">
                <option <?= get_option('avs-theme', false) === 'avs_default' ? 'selected="selected"' : '' ?> value="Default" id="avs_default">Default</option>
                <option value="Elegant" id="avs_elegant">Elegant</option>
                <option value="Dark" id="avs_dark">Dark</option>
            </select>
        </div>

        <!-- Submit Button -->
        <input type="submit" name="avs_submit" id="avs_submit" value="Update Settings!">
    </div>
</form>

<?php

/**
 * Get the values from the form
 * Check if the fields are filled? if not set them to default
 * /
$handler = new AvsHandleSettings($loginUrl, $urlTheme);

$loginUrl = $_POST['avs_login_url_input'];
$loginTheme = $_POST['avs_select_theme'];

if (!isset($loginUrl)) {
    $loginUrl = '/wp-admin';
}

if (!isset($loginTheme)) {
    $loginTheme = 'default';
}*/
