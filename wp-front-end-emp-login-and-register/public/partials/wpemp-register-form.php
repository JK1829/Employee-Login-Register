<?php
/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @package    Wp_Emp_Login
 * @subpackage Wp_Emp_Login/public/partials
 */
?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<link
     rel="stylesheet"
     href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"
   />
   <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
 <style>
    .iti--allow-dropdown{
        width:100%;
        
    }
    .form-control-feedback{
        top:28px !important;
        right:12px!important;
    }
 </style>
<div id="wpempRegisterSection" class="container-fluid">
    <div class="row">
        <div class="col-xs-8 col-md-10"> 
            <?php
            $wpemp_form_settings = get_option('wpemp_form_settings');
            $form_heading = empty($wpemp_form_settings['wpemp_signup_heading']) ? 'Register' : $wpemp_form_settings['wpemp_signup_heading'];

            // check if the user already login
            if (!is_user_logged_in()) :

                ?>
<div class="row">
    <div class="col-md-10 col-md-offset-2">
                <form name="wpempRegisterForm" id="wpempRegisterForm" method="post">
                    <h3><?php _e($form_heading, $this->plugin_name); ?></h3>

                    <div id="wpemp-reg-loader-info" class="wpemp-loader" style="display:none;">
                        <img src="<?php echo plugins_url('images/ajax-loader.gif', dirname(__FILE__)); ?>"/>
                        <span><?php _e('Please wait ...', $this->plugin_name); ?></span>
                    </div>
                    <div id="wpemp-register-alert" class="alert alert-danger" role="alert" style="display:none;"></div>
                    <div id="wpemp-mail-alert" class="alert alert-danger" role="alert" style="display:none;"></div>
                    <?php if ($token_verification): ?>
                        <div class="alert alert-info" role="alert"><?php _e('Your account has been activated, you can login now.', $this->plugin_name); ?></div>
                    <?php endif; ?>
                    <div class="form-group col-md-6">
                        <label for="firstname"><?php _e('First name', $this->plugin_name); ?></label>
                        <sup class="wpemp-required-asterisk">*</sup>
                        <input type="text" class="form-control" name="wpemp_fname" id="wpemp_fname" placeholder="First name">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="lastname"><?php _e('Last name', $this->plugin_name); ?></label>
                        <input type="text" class="form-control" name="wpemp_lname" id="wpemp_lname" placeholder="Last name">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="username"><?php _e('Username', $this->plugin_name); ?></label>
                        <sup class="wpemp-required-asterisk">*</sup>
                        <input type="text" class="form-control" name="wpemp_username" id="wpemp_username" placeholder="Username">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="email"><?php _e('Email', $this->plugin_name); ?></label>
                        <sup class="wpemp-required-asterisk">*</sup>
                        <input type="text" class="form-control" name="wpemp_email" id="wpemp_email" placeholder="Email">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="password"><?php _e('Password', $this->plugin_name); ?></label>
                        <sup class="wpemp-required-asterisk">*</sup>
                        <input type="password" class="form-control" name="wpemp_password" id="wpemp_password" placeholder="Password" >
                    </div>
                    <div class="form-group col-md-6">
                        <label for="confrim password"><?php _e('Confirm Password', $this->plugin_name); ?></label>
                        <sup class="wpemp-required-asterisk">*</sup>
                        <input type="password" class="form-control" name="wpemp_password2" id="wpemp_password2" placeholder="Confirm Password" >
                    </div>
                    
                    <div class="form-group col-md-6" >
                        <label for="phone">Phone</label>
                        <sup class="wpemp-required-asterisk">*</sup><br>
                        <input id="phone" onkeypress='return event.charCode >= 48 && event.charCode <= 57' class="form-control phone" title="Please Enter 10 Digit Phone Number"  maxlength="10" pattern="\d{10}" title="Please enter exactly 10 digits" type="tel" name="phone"  placeholder="1234 123 123" />      
                    </div>
                    
                    
                    <div class="form-group col-md-6">
                        <label for="username"><?php _e('BirthDate', $this->plugin_name); ?></label>
                        <sup class="wpemp-required-asterisk">*</sup>
                        <input type="text" class="form-control" name="wpemp_birthdate" id="wpemp_birthdate" placeholder="dd/mm/yyyy">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="country">Country</label>
                            <select name="country" class="form-control"  id="country"></select> 
                    </div>
                    <div class="form-group col-md-6">
                        <label for="state">State</label>
                        <select name="state" class="form-control" id="state"></select> 
                    </div>
                    <div class="form-group col-md-6">
                        <label for="city">City</label>
                        <select name="city" class="form-control"  id="city"></select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="zipcode"><?php _e('Zipcode', $this->plugin_name); ?></label>
                        <sup class="wpemp-required-asterisk">*</sup>
                        <input type="text" class="form-control" pattern="\d{6}" maxlength="6" name="wpemp_zipcode" id="wpemp_zipcode" placeholder="123456">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="address"><?php _e('Address', $this->plugin_name); ?></label>
                        <sup class="wpemp-required-asterisk">*</sup>
                        <input type="text" class="form-control" name="wpemp_address" id="wpemp_address" placeholder="Address">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="businessname"><?php _e('Business Name', $this->plugin_name); ?></label>
                        <sup class="wpemp-required-asterisk">*</sup>
                        <input type="text" class="form-control" name="wpemp_businessname" id="wpemp_businessname" placeholder="Business Name">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="businesemail"><?php _e('Business Email', $this->plugin_name); ?></label>
                        <sup class="wpemp-required-asterisk">*</sup>
                        <input type="email" class="form-control" name="wpemp_businessemail" id="wpemp_businessemail" placeholder="Business Email">
                    </div>
                    <div class="form-group col-md-6" >
                        <label for="businessphone">Business Phone</label>
                        <sup class="wpemp-required-asterisk">*</sup><br>
                        <input id="businessphone" onkeypress='return event.charCode >= 48 && event.charCode <= 57' class="form-control phone" title="Please Enter 10 Digit Phone Number"  maxlength="10" pattern="\d{10}" title="Please enter exactly 10 digits" type="text" name="businessphone"  placeholder="1234 123 123" />      
                    </div>
                    <div class="form-group col-md-6">
                        <label for="businessaddress"><?php _e('Business Address', $this->plugin_name); ?></label>
                        <sup class="wpemp-required-asterisk">*</sup>
                        <input type="text" class="form-control" name="wpemp_businessaddress" id="wpemp_businessaddress" placeholder="Business Address">
                    </div>
                    <?php if ($wpemp_form_settings['wpemp_enable_captcha'] == '1') { ?>
                        <div class="form-group col-md-6">
                            <label class="control-label" id="captchaOperation"></label>

                            <input type="text" placeholder="Captcha answer" class="form-control" name="wpemp_captcha" />

                        </div>
                    <?php } ?>

                    <input type="hidden" name="wpemp_current_url" id="wpemp_current_url" value="<?php echo get_permalink(); ?>" />
                    <input type="hidden" name="redirection_url" id="redirection_url" value="<?php echo get_permalink(); ?>" />

                    <?php
                    // this prevent automated script for unwanted spam
                    if (function_exists('wp_nonce_field'))
                        wp_nonce_field('wpemp_register_action', 'wpemp_register_nonce');

                    ?>
                    <br>
                     <div class="form-group col-md-12 aligncenter">
                        <label></label>
                    <button type="submit" class="btn btn-primary btn-lg">
                        <?php
                        $submit_button_text = empty($wpemp_form_settings['wpemp_signup_button_text']) ? 'Register' : $wpemp_form_settings['wpemp_signup_button_text'];
                        _e($submit_button_text, $this->plugin_name);

                        ?></button>
                        </div>
                </form>
                    </div>
                    </div>
                <?php
            else:
                $current_user = wp_get_current_user();
                $logout_redirect = (empty($wpemp_form_settings['wpemp_logout_redirect']) || $wpemp_form_settings['wpemp_logout_redirect'] == '-1') ? '' : $wpemp_form_settings['wpemp_logout_redirect'];

                echo 'Logged in as <strong>' . ucfirst($current_user->user_login) . '</strong>. <a href="' . wp_logout_url(get_permalink($logout_redirect)) . '">Log out ? </a>';
            endif;

            ?>
        </div>
    </div>
</div>

<script>
   const phoneInputField = document.querySelector('.phone');
   const phoneInput = window.intlTelInput(phoneInputField, {
     utilsScript:
       "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
   });
   
 </script>

 
 <script type="text/javascript">
    $(document).ready(function(){
        // Countries
        var country_arr = new Array("Select Country","AUSTRALIA","INDIA","NEW ZEALAND","USA","UAE","MAURITIUS");

        $.each(country_arr, function (i, item) {
            $('#country').append($('<option>', {
                value: i,
                text : item,
            }, '</option>' ));
        });

        // States
        var s_a = new Array();
        s_a[0]="Select State";
        s_a[1]="Select State|QUEENSLAND|VICTORIA";
        s_a[2]="Select State|ANDHRAPRADESH|KARNATAKA|TAMILNADU|DELHI|GOA|W-BENGAL|GUJARAT|MADHYAPRADESH|MAHARASHTRA|RAJASTHAN";
        s_a[3]="Select State|AUCKLAND";
        s_a[4]="Select State|NEWJERSEY|ILLINOIS";
        s_a[5]="Select State|DUBAI";
        s_a[6]="Select State|MAURITIUS";

        // Cities
        var c_a = new Array();
        c_a['QUEENSLAND']="BRISBANE | BRISBANE 2 | BRISBANE 3";
        c_a['VICTORIA']="MELBOURNE | Bendigo | Wodongo";
        c_a['ANDHRAPRADESH']="HYDERABAD";
        c_a['KARNATAKA']="BANGLORE";
        c_a['TAMILNADU']="CHENNAI";
        c_a['DELHI']="DELHI | Noida | NewDelhi";
        c_a['GOA']="GOA | Panjim";
        c_a['W-BENGAL']="KOLKATA";
        c_a['GUJARAT']="AHMEDABAD1|AHMEDABAD2|AHMEDABAD3|BARODA|BHAVNAGAR|MEHSANA|RAJKOT|SURAT|UNA";
        c_a['MADHYAPRADESH']="INDORE | Ratlam | Bhopal";
        c_a['MAHARASHTRA']="MUMBAI|PUNE";
        c_a['RAJASTHAN']="ABU | Jaipur";
        c_a['AUCKLAND']="AUCKLAND | Auckland 2";
        c_a['NEWJERSEY']="EDISON";
        c_a['ILLINOIS']="CHICAGO";
        c_a['MAURITIUS']="MAURITIUS";
        c_a['DUBAI']="DUBAI";


        $('#country').change(function(){
            var c = $(this).val();
            var state_arr = s_a[c].split("|");
            $('#state').empty();
            $('#city').empty();
            if(c==0){
                $('#state').append($('<option>', {
                    value: '0',
                    text: 'Select State',
                }, '</option>'));
            }else {
                $.each(state_arr, function (i, item_state) {
                    $('#state').append($('<option>', {
                        value: item_state,
                        text: item_state,
                    }, '</option>'));
                });
            }
            $('#city').append($('<option>', {
                value: '0',
                text: 'Select City',
            }, '</option>'));
        });

        $('#state').change(function(){
            var s = $(this).val();
            if(s=='Select State'){
                $('#city').empty();
                $('#city').append($('<option>', {
                    value: '0',
                    text: 'Select City',
                }, '</option>'));
            }
            var city_arr = c_a[s].split("|");
            $('#city').empty();

            $.each(city_arr, function (j, item_city) {
                $('#city').append($('<option>', {
                    value: item_city,
                    text: item_city,
                }, '</option>'));
            });


        });
    });
</script>