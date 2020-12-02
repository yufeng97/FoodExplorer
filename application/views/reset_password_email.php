<main class="main container">
    <div class="ui container">
        <?php if (isset($success)) : ?>
            <div class="ui success message">
                <i class="close icon"></i>
                <div class="header">
                    A link to reset your password has been sent to your email. Please check your email to reset your password.
                </div>
            </div>
        <?php endif; ?>

        <?php if (isset($error)) : ?>
            <div class="ui error message">
                <i class="close icon"></i>
                <div class="header">
                    <?php echo $error; ?>
                </div>
            </div>
        <?php endif; ?>

        <div class="ui segment">
            <form class="ui form" action="<?php echo base_url(); ?>Login/forgot_password" method="post">
                <div class="field">
                    <div class="ui left icon input">
                        <i class="user icon"></i>
                        <input type="email" name="email" placeholder="E-mail address" required>
                    </div>
                </div>
                <button class="ui button">Reset My Password</button>
                <div class="ui error message"></div>
            </form>
        </div>
    </div>
</main>

<script>
    $(document).ready(function() {
        $('.message .close').on('click', function() {
            $(this)
                .closest('.message')
                .transition('fade');
        });
    });
</script>