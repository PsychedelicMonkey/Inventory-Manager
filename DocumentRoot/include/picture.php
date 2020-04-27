<?php
include_once ('includes.php');

define ('DIR', DOMAIN . '/assets/profilepics/' . $_SESSION['uid'] . '/');

/*
 * Check if user has a profile picture saved in DB
 * $preview: Boolean for uploading a pic
 *      - Set 'true' if the function is used in the 'upload photo' page
 *      - Set 'false' if the function is used anywhere else 
 */
function getProfilePic($preview)
{
    global $db;
    $query = "SELECT profile_pic FROM users WHERE uid={$_SESSION['uid']}";
    $result = mysqli_query($db, $query);
    $arr = mysqli_fetch_assoc($result);
    if ($arr['profile_pic'] != NULL)
    {
        $photo = DIR . $arr['profile_pic'];
        if ($preview)
            print '<img id="pic-preview" src="' . $photo . '" alt="">';
        else
            print '<img id="profile-pic" src="' . $photo . '" alt="">';
    }
    else
    {
        if ($preview)
        {
            print '<span class="profile-pic center"><i class="fa fa-user-circle"></i></span>';
            print '<img id="pic-preview" src="#" alt="">';
        }
        else
            print '<span id="user-icon"><i class="fa fa-fw fa-user-circle"></i></span>';
    }
}
?>