<div class="row">
    <div style="width:70%;float:left">
        <table class="form-table">
            <tr valign="top">
                <th scope="row">
                    <label><?php _e("Global Login Redirect", $this->plugin_name); ?></label>
                </th>
                <td>

                    <?php
                    $selected = (empty($wpemp_settings['wpemp_login_redirect']) || $wpemp_settings['wpemp_login_redirect'] == '-1') ? '' : $wpemp_settings['wpemp_login_redirect'];
                    wp_dropdown_pages($args = array('name' => 'wpemp_login_redirect', 'selected' => $selected, 'show_option_none' => 'Same page', 'option_none_value' => '-1'));
                    ?>
                    <br>
                    <em><?php _e("Redirect the user to a specific page after login (Default: Same page keeps the user on the same page after login).", $this->plugin_name); ?></em>


                </td>
            </tr>
            <tr valign="top">
                <th scope="row">
                    <label><?php _e("Global Logout Redirect", $this->plugin_name); ?></label>
                </th>
                <td>
                    <?php
                    $selected = (empty($wpemp_settings['wpemp_logout_redirect']) || $wpemp_settings['wpemp_logout_redirect'] == '-1') ? '' : $wpemp_settings['wpemp_logout_redirect'];
                    wp_dropdown_pages($args = array('name' => 'wpemp_logout_redirect', 'selected' => $selected, 'show_option_none' => 'Same page', 'option_none_value' => '-1'));
                    ?>
                    <br>
                    <em><?php _e("Redirect the user to a specific page after logout (Default: Same page keeps the user on the same page on logout).", $this->plugin_name); ?></em>


                </td>
            </tr>
        </table>
    </div>

</div>