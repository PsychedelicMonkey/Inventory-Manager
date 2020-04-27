<?php
include_once ('includes.php');

define ('DIR', '/assets/profilepics/');

/*
 * Check if user has a profile picture saved in DB
 * $preview: Boolean for use when uploading a pic
 *      - Set 'true' if the function is used in the 'upload photo' page
 *      - Set 'false' if the function is used anywhere else
 * $navbar: Boolean to determine if the photo is used on the navigation menu
 * $user: Specifies a UID to use for the picture. If the $user variable is not set, it will use the 'uid' session variable
 */
function getProfilePic(bool $preview, bool $navbar, $user = NULL)
{
    if (!isset($user))
        $user = $_SESSION['uid'];

    global $db;
    $query = "SELECT profile_pic FROM users WHERE uid=$user";
    $result = mysqli_query($db, $query);
    $arr = mysqli_fetch_assoc($result);
    if ($arr['profile_pic'] != NULL)
    {
        $photo = DIR . $user . '/' . $arr['profile_pic'];
        if ($preview)
            print '<img id="pic-preview" src="' . $photo . '" alt="">';
        else
            print '<img id="profile-pic" src="' . $photo . '" alt="">';
    }
    else
    {
        if ($navbar)
        {
            print '<span id="user-icon"><i class="fa fa-fw fa-user-circle"></i></span>';
        }
        else if ($preview)
        {
            print '<span id="default-preview" class="profile-pic center"><i class="fa fa-user-circle"></i></span>';
            print '<img id="pic-preview" src="#" alt="">';
        }
        else
        {
            print '<span class="profile-pic"><i class="fa fa-fw fa-user-circle"></i></span>';
        }
    }
}
?>