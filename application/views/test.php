<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <form action="<?php echo base_url(); ?>Admin/upload" method="post" enctype="multipart/form-data">
        <input type="file" name="files" multiple>
        <button>submit</button>
    </form>
</body>
</html>