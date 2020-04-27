<?php
define ('PAGE', 'My Profile');
include_once ('../include/includes.php');
include_once ('../include/header.php');
?>
        <div class="body-wrapper">
            <div class="section">
                <h2 class="form-heading">My Profile</h2>
                <form action="upload_photo.php" method="post" enctype="multipart/form-data">
                    <?php getProfilePic(true, false); ?>
                    <input type="file" name="fileToUpload" id="fileToUpload" onchange="readURL(this);">
                    <input type="submit" name="submit" value="Confirm" id="confirm-photo">
                </form>
            </div>
        </div>
        <script type="text/javascript">
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#pic-preview').attr('src', e.target.result);
                        $('#default-preview').css('display', 'none');
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }
        </script>
<?php
include_once ('../include/footer.php');
?>