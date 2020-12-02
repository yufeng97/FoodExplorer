<main class="main container">
    <div class="ui centered grid">
        <div class="two wide column">
            <div class="ui secondary vertical menu">
                <a class="active item" data-tab="first">
                    <div><i class="user icon"></i> Profile</div>
                </a>
                <a class="item" data-tab="second">
                    <div><i class="edit icon"></i> Edit Profile</div>
                </a>
                <a class="item" data-tab="third">
                    <div><i class="envelope icon"></i> Customer Feedback</div>
                </a>
                <a class="item" data-tab="fourth">
                    <div><i class="list icon"></i> Order Details</div>
                </a>
            </div>
        </div>

        <div class="nine wide column">
            <div class="ui active tab segment" data-tab="first">
                <div class="ui grid">
                    <div class="six wide center aligned column">
                        <h3 class="ui header">
                            Welcome <?php if ($fullname) {
                                        echo $fullname;
                                    } else {
                                        echo $username;
                                    } ?>
                        </h3>
                        <div class="dimmable image">
                            <div class="ui dimmer">
                                <div class="content">
                                    <div class="center">
                                        <button id="upload" class="ui button"><i class="upload icon"></i>Upload Picture</button>
                                    </div>
                                </div>
                            </div>
                            <div class="ui medium image">
                                <svg width="287" height="200">
                                    <image id="user_img" xlink:href="<?php echo $imgPath; ?>" x="0" y="0" width="100%" height="100%"></image>
                                </svg>
                            </div>
                        </div>

                    </div>
                    <div class="ten wide column">
                        <div class="content">
                            <?php if (!$is_email_verified) : ?>
                                <h2 class="ui red header">Please check your Email to verify your account</h2>
                            <?php endif ?>
                            <h3 class="ui dividing header">User Profile</h3>
                            <div class="description">
                                <div class="ui big animated list">
                                    <div class="item">
                                        <div class="ui horizontal label">Username</div>
                                        <?php echo $username; ?>
                                    </div>
                                    <div class="item">
                                        <div class="ui horizontal label">Full name</div>
                                        <?php echo $fullname; ?>
                                    </div>
                                    <div class="item">
                                        <div class="ui horizontal label">Email</div>
                                        <?php echo $email; ?>
                                    </div>
                                    <div class="item">
                                        <div class="ui horizontal label">Mobile phone</div>
                                        <?php echo $mobile_phone; ?>
                                    </div>
                                    <div class="item">
                                        <div class="ui horizontal label">Address</div>
                                        <?php echo $address; ?>
                                    </div>
                                </div>
                            </div>
                            <br>
                        </div>
                        <div class="extra content">
                            <h4 class="ui header">Position on map</h4>
                            <?php if (empty($position)) : ?>
                                <div class="ui compact message warning">
                                    You haven't set your Position
                                </div>
                            <?php else : ?>
                                <div id="mapholder" class="ui container"></div>
                                <script>
                                    var latitude = "<?php echo explode(',', $position)[0]; ?>";
                                    var longitude = "<?php echo explode(',', $position)[1]; ?>";
                                    function initMap() {
                                        var myLatLng = {
                                            lat: parseFloat(latitude),
                                            lng: parseFloat(longitude)
                                        };
                                        var map = new google.maps.Map(document.getElementById("mapholder"), {
                                            center: myLatLng,
                                            zoom: 18
                                        });
                                        var marker = new google.maps.Marker({
                                            position: myLatLng,
                                            map: map
                                        });
                                    }
                                </script>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="ui tab segment" data-tab="second">
                <form class="ui profile form" action="<?php echo base_url() ?>User/update_profile" method="POST">
                    <h4 class="ui dividing header">Edit personal information</h4>
                    <div class="inline field">
                        <label for="username">Username</label>
                        <input id="username" type="text" name="username" placeholder="User Name" value="<?php echo $username; ?>" disabled>
                        <a id="update_username" href="javascript:void(0);">Change Username</a>
                    </div>
                    <div class="inline field">
                        <label>Email</label>
                        <input type="email" name="email" placeholder="E-mail" value="<?php echo $email; ?>" disabled>
                    </div>
                    <div class="inline field">
                        <label for="fullname">Full name</label>
                        <input id="fullname" type="text" name="fullname" placeholder="Full Name" maxlength="20" value="<?php echo $fullname; ?>">
                    </div>
                    <div class="inline field">
                        <label for="mobile_phone">Mobile phone</label>
                        <input id="mobile_phone" type="number" name="mobile_phone" placeholder="Mobile Phone" maxlength="10" value="<?php echo $mobile_phone; ?>">
                    </div>
                    <div class="inline field">
                        <label for="position">Position</label>
                        <input id="position" type="text" name="position" placeholder="Position" value="<?php echo $position; ?>" size="35">
                        <button class="ui button" type="button" onclick="getLocation()"><i class="location arrow icon"></i></button>
                    </div>
                    <div class="inline field">
                        <label for="address">Address</label>
                        <input id="address" type="text" name="address" placeholder="Address" value="<?php echo $address; ?>" size="50">
                    </div>
                    <button class="ui secondary button" type="reset">Reset</button>
                    <button class="ui primary button" type="submit">Save change</button>
                </form>
            </div>

            <div class="ui tab segment" data-tab="third">
                <form class="ui reply form" action="" method="POST">
                    <div class="inline field">
                        <label for="name">Full name</label>
                        <input type="text" id="name" name="name" placeholder="Your full name" value="<?php echo $fullname; ?>">
                    </div>
                    <div class="inline field">
                        <label for="replay_email">Email</label>
                        <input type="email" id="replay_email" name="replay_email" placeholder="Your Email address" value="<?php echo $email; ?>" required>
                    </div>
                    <div class="inline field">
                        <label for="subject">Subject</label>
                        <input type="text" id="subject" name="subject" placeholder="Your Email subject">
                    </div>
                    <div class="field">
                        <label for="message">Message</label>
                        <textarea id="message" name="message" placeholder="Write us something"></textarea>
                    </div>
                    <button class="ui blue labeled submit icon button">
                        <i class="icon edit"></i>Sent Email
                    </button>
                </form>
            </div>

            <div class="ui tab segment" data-tab="fourth">
                <?php if ($order_history) : ?>
                    <div class="ui styled fluid accordion">
                        <?php foreach ($order_history as $order_number => $orders) : ?>
                            <div class="title">

                                <div>
                                    <i class="dropdown icon"></i>Order Number: <?php echo $order_number; ?>
                                </div>
                                <div>
                                    Create Time: <?php echo $orders[0]['create_time']; ?>
                                </div>
                            </div>
                            <div class="content">
                                <table class="ui table">
                                    <thead>
                                        <tr>
                                            <th>Dish</th>
                                            <th>Restaurant</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $total = 0 ?>
                                        <?php foreach ($orders as $row) : ?>
                                            <tr>
                                                <td><?php echo $row['dish_name']; ?></td>
                                                <td><?php echo $row['restaurant_name']; ?></td>
                                                <td><?php echo $row['price']; ?></td>
                                                <td><?php echo $row['quantity']; ?></td>
                                                <td>
                                                    <?php
                                                    $subtotal = $row['price'] * $row['quantity'];
                                                    $total += $subtotal;
                                                    echo $subtotal;
                                                    ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="3" class="right aligned"><a class="ui primary button" href="<?php echo base_url(); ?>User/view_order/?number=<?php echo $order_number; ?>">View</a></th>
                                            <th class="right collapsing aligned">Total</th>
                                            <th><?php echo $total; ?></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else : ?>
                    <h3 class="ui center aligned header">No Order History</h3>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="ui tiny upload modal">
        <i class="close icon"></i>
        <div class="header">
            Upload Picture
        </div>
        <div class="content">
            <div id="droparea" class="droparea">
                Drop file here to upload
            </div>
        </div>
        <div class="actions">
            <div class="ui black deny button">Cancel</div>
        </div>
    </div>

    <div class="ui tiny update modal">
        <i class="close icon"></i>
        <div class="header">
            Update Username
        </div>
        <div class="content">
            <form id="updateUsername" class="ui username form" action="<?php echo base_url() ?>User/change_username" method="POST">
                <label>username:</label>
                <div class="field">
                    <input type="text" name="username" maxlength="20">
                </div>
                <div class="ui error message"></div>
            </form>
        </div>
        <div class="actions">
            <div class="ui black deny button">Cancel</div>
            <button class="ui green ok button">Save Update</button>
        </div>
    </div>
</main>


<script>
    // Tab
    $('.menu .item').tab();

    $(document).ready(function() {
        // bind event to button
        $(".ui.tiny.upload.modal").modal('attach events', '#upload')

        // Drag and drop to upload
        var droparea = document.getElementById("droparea");

        droparea.ondrop = function(e) {
            e.preventDefault();
            this.className = "droparea";
            upload(e.dataTransfer.files);
        };

        var upload = function(files) {
            if (files.length > 1) {
                alert("Please upload only one file!");
                return false;
            }
            var formData = new FormData();
            formData.append("file", files[0]);
            $.ajax({
                url: "<?php echo base_url(); ?>User/ajax_upload",
                data: formData,
                type: "POST",
                processData: false,
                contentType: false,
                cache: false,
                success: function(data) {
                    if (data) {
                        alert("Upload successfully");
                        $("#user_img").attr("xlink:href", data);
                        // finish uploading then close the modal
                        $(".ui.tiny.upload.modal").modal('hide');
                    } else {
                        alert(data);
                        alert("Upload failed");
                    }
                }
            });
        };

        droparea.ondragover = function() {
            this.className = "droparea dragover";
            return false;
        };
        droparea.ondragleave = function() {
            this.className = "droparea";
            return false;
        };

        // Accordion
        $('.ui.accordion').accordion();

        // Username validate rule
        $.fn.form.settings.rules.uniqueUsername = function(value) {
            var valid;
            $.ajax({
                url: "<?php echo base_url() . 'SignUp/check_ID_availability'; ?>",
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
        $(".ui.username.form").form({
            on: "blur",
            inline: true,
            fields: {
                username: {
                    identifier: "username",
                    rules: [{
                        type: "empty",
                        prompt: "Username can not be empty"
                    }, {
                        type: "uniqueUsername",
                        prompt: "This name has been used"
                    }]
                }
            }
        });
        // Username changing modal
        $(".ui.tiny.update.modal")
            .modal({
                onApprove: function() {
                    var validated = $(".ui.username.form").form("is valid");
                    if (!validated) {
                        return false;
                    }
                    $(".ui.username.form").submit();
                }
            })
            .modal('setting', 'closable', false);
        $("#update_username").click(function() {
            $(".ui.tiny.update.modal").modal('show')
        });
        // Image dimmer
        $('.dimmable.image').dimmer({
            on: 'hover'
        });

    }());

    // Get Location
    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            alert("Geolocation is not supported");
        }
    };

    function showPosition(position) {
        var lat = position.coords.latitude;
        var lng = position.coords.longitude;
        var latlng = lat + "," + lng;
        $("#position").val(latlng);
        getAddress(lat, lng);
    };

    // Get address by lat and long
    function getAddress(lat, lng) {
        var geocoder = new google.maps.Geocoder;
        var latlng = {
            lat: parseFloat(lat),
            lng: parseFloat(lng)
        };
        geocoder.geocode({
            'location': latlng
        }, function(results, status) {
            if (status === 'OK') {
                if (results[0]) {
                    $("#address").val(results[0].formatted_address);
                } else {
                    window.alert('No results found');
                }
            } else {
                window.alert('Geocoder failed due to: ' + status);
            }
        })
    }

</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDEjGjWfh_ueHvjenLHRt_Pg8KpN_eGPk4&callback=initMap" async defer></script>