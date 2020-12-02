<main class="main container">
    <div class="ui middle aligned center aligned grid">
        <div class="five wide column">
            <?php if (isset($message)) : ?>
                <div class="ui success message">
                    <i class="close icon"></i>
                    <div class="header">
                        <?php echo $message; ?>
                    </div>
                </div>
            <?php endif; ?>
            <img class="ui small centered image" src="/img/Batman_Logo.png">
            <h3 class="ui image header">Log-in to your account</h3>
            <form class="ui form" method="POST" action="<?php echo base_url(); ?>Login/login_validation">
                <div class="ui stacked segment">
                    <div class="field">
                        <div class="ui left icon input">
                            <i class="user icon"></i>
                            <input type="email" name="email" placeholder="E-mail address" value="<?php if (isset($_COOKIE["email"])) echo $_COOKIE["email"]; ?>" required>
                        </div>
                    </div>
                    <div class="field">
                        <div class="ui left icon input">
                            <i class="lock icon"></i>
                            <input type="password" name="password" placeholder="Password" required>
                        </div>
                    </div>
                    <div class="field">
                        <div class="ui checkbox">
                            <input type="checkbox" name="remember" id="remember" <?php if (isset($_COOKIE["email"])) echo "checked"; ?>>
                            <label for="remember">Remember Me</label>
                        </div>
                    </div>
                    <button class="ui primary button" type="submit">Login</button>
                </div>
                <div class="ui error message"></div>
                <?php if ($this->session->flashdata('error')) : ?>
                    <div class="ui red message">
                        <?php echo $this->session->flashdata('error'); ?>
                    </div>
                <?php endif; ?>
            </form>
            <div class="ui message">
                <div>New to us? <a href="<?php echo base_url(); ?>SignUp">Sign Up</a></div>
                <div><a href="<?php echo base_url(); ?>Login/forgot_password">Forgot Password?</a></div>
            </div>
        </div>
    </div>
</main>


<script>
    $(document).ready(function() {
        $('.ui.form').form({
            on: "blur",
            inline: true,
            fields: {
                email: ['email', 'empty'],
                password: ['empty', 'minLength[6]']
            }
        });
        $('.message .close').on('click', function() {
            $(this)
                .closest('.message')
                .transition('fade');
        });
    });
</script>