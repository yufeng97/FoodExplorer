<main class="main container">
    <div class="ui middle aligned center aligned grid">
        <div class="five wide column">
            <img src="/img/Batman_Logo.png" alt="" class="ui small centered image">
            <h3 class="ui center aligned header">Create a new account</h3>
            <form class="ui form" method="POST" action="<?php echo base_url() ?>SignUp/register">
                <div class="ui segment">
                    <div class="field">
                        <div class="ui left icon input">
                            <i class="envelope icon"></i>
                            <input type="email" name="email" placeholder="E-mail address">
                        </div>
                    </div>
                    <div class="field">
                        <div class="ui left icon input">
                            <i class="user icon"></i>
                            <input type="username" name="username" placeholder="Username">
                        </div>
                    </div>
                    <div class="field">
                        <div class="ui left icon input">
                            <i class="lock icon"></i>
                            <input type="password" name="password" placeholder="New Password">
                        </div>
                    </div>
                    <div class="field">
                        <div class="ui left icon input">
                            <i class="lock icon"></i>
                            <input type="password" name="confirmPassword" placeholder="Confirm Password">
                        </div>
                    </div>
                    <div class="ui centered grid" style="margin-top: auto; margin-bottom: auto">
                        <button class="ui positive button" type="submit">Create Account</button>
                    </div>
                    <div class="ui error message"></div>
                </div>
            </form>
            <div class="ui message">
                Already have an account? <a href="<?php echo base_url(); ?>Login">Login here</a>
            </div>
        </div>
    </div>
</main>


<script>
    $.fn.form.settings.rules.uniqueUsername = function(value) {
        var valid;
        $.ajax({
            url: "<?php echo base_url(); ?>SignUp/check_ID_availability",
            data: {
                username: value
            },
            type: "POST",
            async: false,
            success: function(data) {
                valid = data;
            }
        });
        return valid;
    };
    $.fn.form.settings.rules.uniqueEmail = function(value) {
        var valid;
        $.ajax({
            url: "<?php echo base_url(); ?>SignUp/check_ID_availability",
            data: {
                email: value
            },
            type: "POST",
            async: false,
            success: function(data) {
                valid = data;
            }
        });
        return valid;
    };
    $('.ui.form').form({
        on: "blur",
        inline: true,
        fields: {
            email: {
                identifier: "email",
                rules: [{
                    type: "empty",
                    prompt: "Email can not be empty"
                }, {
                    type: "email",
                    prompt: "This is not email"
                }, {
                    type: "uniqueEmail",
                    prompt: "This email has been used"
                }]
            },
            username: {
                identifier: "username",
                rules: [{
                    type: "empty",
                    prompt: "Username can not be empty"
                }, {
                    type: "uniqueUsername",
                    prompt: "This name has been used"
                }]
            },
            password: {
                identifier: "password",
                rules: [{
                    type: "empty",
                    prompt: "password cannot be empty"
                }, {
                    type: "regExp[/^(?=.*[0-9])(?=.*[a-zA-Z]).{6,}$/]",
                    prompt: "Your password must be at least one number and one letter, and least 6 characters"
                }]
            },
            confirmPassword: {
                identifier: "confirmPassword",
                rules: [{
                    type: "match[password]",
                    prompt: "Confirm password must match password"
                }]
            }
        }
    });
</script>