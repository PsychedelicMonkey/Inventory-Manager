<?php
define ('PAGE', 'My Profile');
include_once ('../include/header.php');
include_once ('../include/tables.php');
include_once ('../sql/sql.php');
include_once ('../include/picture.php');
?>
        <div class="body-wrapper">
            <div class="section">
                <h2 class="form-heading">My Profile</h2>
                <form action="upload-photo.php" method="post" enctype="multipart/form-data">
                    <?php
                        /*if (!picExists(true))
                        {
                            print '<span class="profile-pic center"><i class="fa fa-user-circle"></i></span>';
                            print '<img id="pic-preview" src="#" alt="">';
                        }*/
                        getProfilePic(true);
                    ?>
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
                        $('.profile-pic:eq(0)').css('display', 'none');
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }
        </script>
<?php
include_once ('../include/footer.php');
?>