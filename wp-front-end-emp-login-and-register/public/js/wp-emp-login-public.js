(function($) {
    'use strict';

    $(document).ready(initScript);

    function initScript() {

        //defing global ajax post url
        window.ajaxPostUrl = ajax_object.ajax_url;
        // validating login form request
        wpempValidateAndProcessLoginForm();
        // validating registration form request
        wpempValidateAndProcessRegisterForm();
        // validating reset password form request
        wpempValidateAndProcessResetPasswordForm();
        //Show Reset password
        wpempShowResetPasswordForm();
        // validating Profile form request
        wpempValidateAndProcessProfileForm();
        //Return to login
        wpempReturnToLoginForm();
        generateCaptcha();

    }

    // Validate login form
    function wpempValidateAndProcessLoginForm() {
        $('#wpempLoginForm').formValidation({
            message: 'This value is not valid',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                wpemp_username: {
                    message: 'The username is not valid',
                    validators: {
                        notEmpty: {
                            message: 'The username is required.'
                        }
                    }
                },
                wpemp_password: {
                    validators: {
                        notEmpty: {
                            message: 'The password is required.'
                        }
                    }
                }
            }
        }).on('success.form.fv', function(e) {
            $('#wpemp-login-alert').hide();
            // You can get the form instance
            var $loginForm = $(e.target);
            // and the FormValidation instance
            var fv = $loginForm.data('formValidation');
            var content = $loginForm.serialize();

            // start processing
            $('#wpemp-login-loader-info').show();
            wpempStartLoginProcess(content);
            // Prevent form submission
            e.preventDefault();
        });
    }

    // Make ajax request with user credentials
    function wpempStartLoginProcess(content) {

        var loginRequest = jQuery.ajax({
            type: 'POST',
            url: ajaxPostUrl,
            data: content + '&action=wpemp_user_login',
            dataType: 'json',
            success: function(data) {
                $('#wpemp-login-loader-info').hide();
                // check login status
                if (true == data.logged_in) {
                    $('#wpemp-login-alert').removeClass('alert-danger');
                    $('#wpemp-login-alert').addClass('alert-success');
                    $('#wpemp-login-alert').show();
                    $('#wpemp-login-alert').html(data.success);

                    // redirect to redirection url provided
                    window.location = data.redirection_url;

                } else {

                    $('#wpemp-login-alert').show();
                    $('#wpemp-login-alert').html(data.error);

                }
            },
            error: function(data) {
                console.log(data);
            }
        });
    }

    //Validate profile update
    function wpempValidateAndProcessProfileForm() {
        $('#wpempProfileForm').formValidation({
            message: 'This value is not valid',
            icon: {
                required: 'glyphicon glyphicon-asterisk',
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                wpemp_fname: {
                    validators: {
                        notEmpty: {
                            message: 'The first name is required'
                        },
                        stringLength: {
                            max: 30,
                            message: 'The firstname must be less than 30 characters long'
                        }
                    }
                },                
                wpemp_email: {
                    validators: {
                        notEmpty: {
                            message: 'The email is required'
                        },
                        regexp: {
                            regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
                            message: 'The value is not a valid email address'
                        }
                    }
                },
            }
        }).on('success.form.fv', function(e) {
            e.preventDefault();
            $('#wpemp-profile-alert').hide();           
            $('body, html').animate({
                scrollTop: 0
            }, 'slow');
            // You can get the form instance
            $('#wpemp-profile-loader-info').show();
            var formdata = new FormData($("#wpempProfileForm")[0]);
            formdata.append('action', 'updateProfile');
            jQuery.ajax({
              url:ajax_object.ajax_url, 
              data:formdata,
              method:"POST",
              processData: false,
              contentType: false,
              success:function(data){  
                $('#wpemp-profile-loader-info').hide();
                 if (true == data.reg_status) {
                    $('#wpemp-profile-alert').removeClass('alert-danger');
                    $('#wpemp-profile-alert').addClass('alert-success');
                    $('#wpemp-profile-alert').show();
                    $('#wpemp-profile-alert').html(data.success);

                } else {
                    $('#wpemp-profile-alert').addClass('alert-danger');
                    $('#wpemp-profile-alert').show();
                    $('#wpemp-profile-alert').html(data.error);

                }
              }
          });
        }).on('err.form.fv', function(e) {
            console.log("ddd");
        });
    }


    // Validate registration form


    function randomNumber(min, max) {
        return Math.floor(Math.random() * (max - min + 1) + min);
    }

    function generateCaptcha() {
        $('#captchaOperation').html([randomNumber(1, 100), '+', randomNumber(1, 200), '='].join(' '));
    }

    // Validate registration form
    function wpempValidateAndProcessRegisterForm() {
        $('#wpempRegisterForm').formValidation({
            message: 'This value is not valid',
            icon: {
                required: 'glyphicon glyphicon-asterisk',
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                wpemp_fname: {
                    validators: {
                        notEmpty: {
                            message: 'The first name is required'
                        },
                        stringLength: {
                            max: 30,
                            message: 'The firstname must be less than 30 characters long'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z]*$/,
                            message: 'Only characters are allowed.'
                        }
                    }
                },
                wpemp_username: {
                    message: 'The username is not valid',
                    validators: {
                        notEmpty: {
                            message: 'The username is required'
                        },
                        stringLength: {
                            min: 6,
                            max: 30,
                            message: 'The username must be more than 6 and less than 30 characters long'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z0-9_\.]+$/,
                            message: 'The username can only consist of alphabetical, number, dot and underscore'
                        }
                    }
                },
                wpemp_email: {
                    validators: {
                        notEmpty: {
                            message: 'The email is required'
                        },
                        regexp: {
                            regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
                            message: 'The value is not a valid email address'
                        }
                    }
                },
                wpemp_password: {
                    validators: {
                        notEmpty: {
                            message: 'The password is required'
                        },
                        stringLength: {
                            min: 6,
                            message: 'The password must be more than 6 characters long'
                        }
                    }
                },
                wpemp_password2: {
                    validators: {
                        notEmpty: {
                            message: 'The password is required'
                        },
                        identical: {
                            field: 'wpemp_password',
                            message: 'The password and its confirm are not the same'
                        },
                        stringLength: {
                            min: 6,
                            message: 'The password must be more than 6 characters long'
                        }
                    }
                },
                wpemp_captcha: {
                    validators: {
                        callback: {
                            message: 'Wrong answer',
                            callback: function(value, validator, $field) {
                                var items = $('#captchaOperation').html().split(' '),
                                        sum = parseInt(items[0]) + parseInt(items[2]);
                                return value == sum;
                            }
                        }
                    }
                }
            }
        }).on('success.form.fv', function(e) {
            $('#wpemp-register-alert').hide();
            $('#wpemp-mail-alert').hide();
            $('body, html').animate({
                scrollTop: 0
            }, 'slow');
            // You can get the form instance
            var $registerForm = $(e.target);
            // and the FormValidation instance
            var fv = $registerForm.data('formValidation');
            var content = $registerForm.serialize();

            // start processing
            $('#wpemp-reg-loader-info').show();
            wpempStartRegistrationProcess(content);
            // Prevent form submission
            e.preventDefault();
        }).on('err.form.fv', function(e) {
            // Regenerate the captcha
            generateCaptcha();
        });
    }


    // Make ajax request with user credentials
    function wpempStartRegistrationProcess(content) {

        var registerRequest = $.ajax({
            type: 'POST',
            url: ajaxPostUrl,
            data: content + '&action=wpemp_user_registration',
            dataType: 'json',
            success: function(data) {

                $('#wpemp-reg-loader-info').hide();
                //check mail sent status
                if (data.mail_status == false) {

                    $('#wpemp-mail-alert').show();
                    $('#wpemp-mail-alert').html('Could not able to send the email notification.');
                }
                // check login status
                if (true == data.reg_status) {
                    $('#wpemp-register-alert').removeClass('alert-danger');
                    $('#wpemp-register-alert').addClass('alert-success');
                    $('#wpemp-register-alert').show();
                    $('#wpemp-register-alert').html(data.success);

                } else {
                    $('#wpemp-register-alert').addClass('alert-danger');
                    $('#wpemp-register-alert').show();
                    $('#wpemp-register-alert').html(data.error);

                }
            },
            error: function(data) {
                console.log(data);
            }
        });
    }

    function wpempShowResetPasswordForm() {
        $('#btnForgotPassword').click(function() {
              $('#wpempResetPasswordSection').removeClass('hidden');
              $('#wpempLoginForm').slideUp(500);  
               $('#wpempResetPasswordSection').slideDown(500);
        });
    }
    
    function wpempReturnToLoginForm() {
        $('#btnReturnToLogin').click(function() {
              $('#wpempResetPasswordSection').slideUp(500);              
              $('#wpempResetPasswordSection').addClass('hidden');
              $('#wpempLoginForm').removeClass('hidden');
              $('#wpempLoginForm').slideDown(500);               
        });
    }

    // Validate reset password form
    //Neelkanth
    function wpempValidateAndProcessResetPasswordForm() {

        $('#wpempResetPasswordForm').formValidation({
            message: 'This value is not valid',
            icon: {
                required: 'glyphicon glyphicon-asterisk',
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                wpemp_rp_email: {
                    validators: {
                        notEmpty: {
                            message: 'Please enter your email address which you used during registration.'
                        },
                        regexp: {
                            regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
                            message: 'The value is not a valid email address'
                        }
                    }
                },
                wpemp_newpassword: {
                    validators: {
                        notEmpty: {
                            message: 'The password is required'
                        },
                        stringLength: {
                            min: 6,
                            message: 'The password must be more than 6 characters long'
                        }
                    }
                }
            }
        }).on('success.form.fv', function(e) {
            $('#wpemp-resetpassword-alert').hide();

            $('body, html').animate({
                scrollTop: 0
            }, 'slow');
            // You can get the form instance
            var $resetPasswordForm = $(e.target);
            // and the FormValidation instance
            var fv = $resetPasswordForm.data('formValidation');
            var content = $resetPasswordForm.serialize();
            
            // start processing
            $('#wpemp-resetpassword-loader-info').show();
            wpempStartResetPasswordProcess(content);
            // Prevent form submission
            e.preventDefault();
        });
    }

    // Make ajax request with email
    //Neelkanth
    function wpempStartResetPasswordProcess(content) {
        
        var resetPasswordRequest = jQuery.ajax({
            type: 'POST',
            url: ajaxPostUrl,
            data: content + '&action=wpemp_resetpassword',
            dataType: 'json',
            success: function(data) {
                
                $('#wpemp-resetpassword-loader-info').hide();
                // check login status
                if (data.success) {
                    
                    $('#wpemp-resetpassword-alert').removeClass('alert-danger');
                    $('#wpemp-resetpassword-alert').addClass('alert-success');
                    $('#wpemp-resetpassword-alert').show();
                    $('#wpemp-resetpassword-alert').html(data.success);

                } else {

                    $('#wpemp-resetpassword-alert').show();
                    $('#wpemp-resetpassword-alert').html(data.error);

                }
            },
            error: function(data) {
                console.log(data);
            }
        });
    }



})(jQuery);
