<?php
namespace API;

use Facebook as Facebook;

class FBController
{    
    public static function getFacebookAPI()
    {
        $fb = new Facebook\Facebook([
            'app_id' => FACEBOOK_API, // Replace {app-id} with your app id
            'app_secret' => FACEBOOK_SECRET,
            'default_graph_version' => 'v3.2',
            ]);
        return $fb;
    }
}
?>