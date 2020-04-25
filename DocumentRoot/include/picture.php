<?php
include_once ('session.php');
include_once ('../sql/sql.php');

/*
 * Check if user has a profile picture saved in DB
 * $preview: Boolean for uploading a pic
 */
function getProfilePic($preview)
{
    global $db;
    $query = "SELECT profile_pic FROM users WHERE uid={$_SESSION['uid']}";
    $result = mysqli_query($db, $query);
    $arr = mysqli_fetch_assoc($result);
    if ($arr['profile_pic'] != NULL)
    {
        if ($preview)
            print '<img id="pic-preview" src="' . $arr['profile_pic'] . '" alt="">';
        else
            print '<img id="profile-pic" src="' . $arr['profile_pic'] . '" alt="">';
    }
    else
    {
        print '<span class="profile-pic center"><i class="fa fa-user-circle"></i></span>';
        if ($preview) 
            print '<img id="pic-preview" src="#" alt="">';
    }
}
?>