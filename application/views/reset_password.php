<main class="main container">
    <div class="ui container">
        <div class="ui segment">
            <?php if (isset($message)) : ?>
                <div class="ui success message">
                    <i class="close icon"></i>
                    <div class="header">
                        <?php echo $message; ?>
                    </div>
                </div>
            <?php endif; ?>
            <form class="ui form" action="<?php echo base_url(); ?>Login/change_password" method="post">
                <input type="hidden" name="reset_key" value="<?php echo $this->uri->segment(3); ?>">
                <div class="filed">
                    <input type="password" name="password" placeholder="New password" pattern="(?=.*[0-9])(?=.*[a-zA-Z]).{6,}" title="Password must be at least one number and one letter, and least 6 characters" required>
                </div>
                <button class="ui button">Reset Password</button>
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