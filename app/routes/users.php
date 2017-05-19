<?php

//Facebook login
//$config = array(
//      "base_url" => "http://localhost:8008/vendor/hybridauth/hybridauth/hybridauth/",
//      "providers" => array (
//        "Facebook" => array (
//          "enabled" => true,
//          "keys"    => array("id" => "294651954316911", "secret" => "ec92b4a05fc2edd8153309f9b166ee60"),
//          "scope"   => ['email', 'user_about_me', 'user_birthday', 'user_hometown'], // optional
//          "display" => "popup" // optional
//    )));
// 
//    require_once( "vendor/hybridauth/hybridauth/hybridauth/hybrid/Auth.php" ); 
//    $hybridauth = new Hybrid_Auth( $config ); 
//    $adapter = $hybridauth->authenticate( "Facebook" ); 
//    $user_profile = $adapter->getUserProfile();


$app->get('/register', function() use ($app, $log) {
    $app->render('register.html.twig',array(
        "eshopuser" => $_SESSION['eshopuser']
    ));          
});

// State 2: submission
$app->post('/register', function() use ($app, $log) {
    $name = $app->request->post('name');
    $email = $app->request->post('email');
    $pass1 = $app->request->post('pass1');
    $pass2 = $app->request->post('pass2');
    $valueList = array('name' => $name, 'email' => $email);
    // submission received - verify
    $errorList = array();
    if (strlen($name) < 4) {
        array_push($errorList, "Name must be at least 4 characters long");
        unset($valueList['name']);
    } else {
        $user = DB::queryFirstRow("SELECT ID FROM users WHERE name=%s", $name);
        if ($user) {
            array_push($errorList, "username already registered");
            unset($valueList['name']);
        }
    }
        
    if (filter_var($email, FILTER_VALIDATE_EMAIL) === FALSE) {
        array_push($errorList, "Email does not look like a valid email");
        unset($valueList['email']);
    } else {
        $user = DB::queryFirstRow("SELECT ID FROM users WHERE email=%s", $email);
        if ($user) {
            array_push($errorList, "Email already registered");
            unset($valueList['email']);
        }
    }
    // ALTERNATIVE: if (($msg = verifyPassword($pass1)) !== TRUE) {
    $msg = verifyPassword($pass1);
    if ($msg !== TRUE) {
        array_push($errorList, $msg);
    } else if ($pass1 != $pass2) {
        array_push($errorList, "Passwords don't match");
    }
    //
    if ($errorList) {
        // STATE 3: submission failed        
        $app->render('register.html.twig', array(
            'errorList' => $errorList, 'v' => $valueList
        ));
    } else {
        // STATE 2: submission successful
        DB::insert('users', array(
            'name' => $name, 
            'email' => $email,
            'password' => password_hash($pass1, CRYPT_BLOWFISH)
                // 'password' => hash('sha256', $pass1)
        ));
        $id = DB::insertId();
        $log->debug(sprintf("User %s created", $id));
        $app->render('eshop.html.twig');
    }
});

$app->get('/login', function() use ($app, $log) {
    $app->render('login.html.twig',array(
        "eshopuser" => $_SESSION['eshopuser']
    ));          
});

$app->post('/login', function() use ($app, $log) {
    $name = $app->request->post('name');
    $pass = $app->request->post('pass');
    $user = DB::queryFirstRow("SELECT * FROM users WHERE name=%s", $name);
//    print_r($user);
    if (!$user) {
        $log->debug(sprintf("User failed for username %s from IP %s", $name, $_SERVER['REMOTE_ADDR']));
        $app->render('login.html.twig', array('loginFailed' => TRUE));
    } else {
        // password MUST be compared in PHP because SQL is case-insenstive
        if(crypt($pass, $user['password']) == $user['password']) {
            // LOGIN successful
            unset($user['password']);
            $_SESSION['eshopuser'] = $user;
            $log->debug(sprintf("User %s logged in successfuly from IP %s", $user['ID'], $_SERVER['REMOTE_ADDR']));
            if($user['role'] === 'admin') {
               $userList =  DB::query("SELECT * FROM users");
               $app->render('admin_user.html.twig',array(
                            'userList' => $userList,
                            "eshopuser" => $_SESSION['eshopuser']
                )); 
            }else {
                $app->render('eshop.html.twig',array(
                            "eshopuser" => $_SESSION['eshopuser']
                ));
            }
            
        } else {
            $log->debug(sprintf("User failed for username %s from IP %s", $name, $_SERVER['REMOTE_ADDR']));
            $app->render('login.html.twig', array('loginFailed' => TRUE));
        }
    }
});

$app->get('/logout', function() use ($app, $log) {
    $_SESSION['eshopuser'] = array();
    $app->render('eshop.html.twig');
});

// PASSWOR RESET

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

$app->map('/passreset', function () use ($app, $log) {
    // Alternative to cron-scheduled cleanup
    if (rand(1,1000) == 111) {
        // TODO: do the cleanup 1 in 1000 accessed to /passreset URL
    }
    if ($app->request()->isGet()) {
        $app->render('passreset.html.twig');
    } else {
        $email = $app->request()->post('email');
        $user = DB::queryFirstRow("SELECT * FROM users WHERE email=%s", $email);
        if ($user) {
            $app->render('passreset_success.html.twig');
            $secretToken = generateRandomString(50);
            // VERSION 1: delete and insert
            /*
              DB::delete('passresets', 'userID=%d', $user['ID']);
              DB::insert('passresets', array(
              'userID' => $user['ID'],
              'secretToken' => $secretToken,
              'expiryDateTime' => date("Y-m-d H:i:s", strtotime("+5 hours"))
              )); */
            // VERSION 2: insert-update TODO
            DB::insertUpdate('passresets', array(
                'userID' => $user['ID'],
                'secretToken' => $secretToken,
                'expiryDateTime' => date("Y-m-d H:i:s", strtotime("+5 minutes"))
            ));
            // email user
            $url = 'http://' . $_SERVER['SERVER_NAME'] . '/passreset/' . $secretToken;
            $html = $app->view()->render('email_passreset.html.twig', array(
                'name' => $user['name'],
                'url' => $url
            ));
            $headers = "MIME-Version: 1.0\r\n";
            $headers.= "Content-Type: text/html; charset=UTF-8\r\n";
            $headers.= "From: Noreply <noreply@ipd9.info>\r\n";
            $headers.= "To: " . htmlentities($user['name']) . " <" . $email . ">\r\n";

            mail($email, "Password reset from eShop", $html, $headers);
        } else {
            $app->render('passreset.html.twig', array('error' => TRUE));
        }
    }
})->via('GET', 'POST');

$app->map('/passreset/:secretToken', function($secretToken) use ($app) {
    $row = DB::queryFirstRow("SELECT * FROM passresets WHERE secretToken=%s", $secretToken);
    if (!$row) {
        $app->render('passreset_notfound_expired.html.twig');
        return;
    }
    if (strtotime($row['expiryDateTime']) < time()) {
        $app->render('passreset_notfound_expired.html.twig');
        return;
    }
    //
    if ($app->request()->isGet()) {
        $app->render('passreset_form.html.twig');
    } else {
        $pass1 = $app->request()->post('pass1');
        $pass2 = $app->request()->post('pass2');
        // TODO: verify password quality and that pass1 matches pass2
        $errorList = array();
        $msg = verifyPassword($pass1);
        if ($msg !== TRUE) {
            array_push($errorList, $msg);
        } else if ($pass1 != $pass2) {
            array_push($errorList, "Passwords don't match");
        }
        //
        if ($errorList) {
            $app->render('passreset_form.html.twig', array(
                'errorList' => $errorList
            ));
        } else {
            // success - reset the password
            DB::update('users', array(
                'password' => password_hash($pass1, CRYPT_BLOWFISH)
                    ), "ID=%d", $row['userID']);
            DB::delete('passresets','secretToken=%s', $secretToken);
            $app->render('passreset_form_success.html.twig');
        }
    }
})->via('GET', 'POST');

$app->get('/emailexists/:email', function($email) use ($app, $log) {
    $user = DB::queryFirstRow("SELECT * FROM users WHERE email=%s", $email);
    if ($user) {
        echo "Email already registered";
    }
});

// returns TRUE if password is strong enough,
// otherwise returns string describing the problem
function verifyPassword($pass1) {
    if (!preg_match('/[0-9;\'".,<>`~|!@#$%^&*()_+=-]/', $pass1) || (!preg_match('/[a-z]/', $pass1)) || (!preg_match('/[A-Z]/', $pass1)) || (strlen($pass1) < 8)) {
        return "Password must be at least 8 characters " .
                "long, contain at least one upper case, one lower case, " .
                " one digit or special character";
    }
    return TRUE;
}

$app->get('/register', function() use ($app) {
    $app->render('register.html.twig',array(
        "eshopuser" => $_SESSION['eshopuser']
    ));          
});

$app->map('/facebook', function() use ($app, $log) {
    $app_id = '294651954316911';
    $app_secret = 'ec92b4a05fc2edd8153309f9b166ee60';        
    
    $fb = new \Facebook\Facebook([
        'app_id' => $app_id,
        'app_secret' => $app_secret,
        'default_graph_version' => 'v2.9',
            //'default_access_token' => '{access-token}', // optional
    ]);

    // Use one of the helper classes to get a Facebook\Authentication\AccessToken entity.
    $helper = $fb->getRedirectLoginHelper();
    //   $helper = $fb->getJavaScriptHelper();
    //   $helper = $fb->getCanvasHelper();
    //   $helper = $fb->getPageTabHelper();
    $errorList = array();
    
    try {
        $accessToken = $helper->getAccessToken();
    } catch (Facebook\Exceptions\FacebookResponseException $e) {
        // When Graph returns an error
        array_push($errorList, $e->getMessage());
        $log->error(sprintf("User failed for facebook login %s", $e->getMessage()));
        $app->render('login.html.twig', array('loginFailed' => TRUE, 'errorList' => $errorList));
    } catch (Facebook\Exceptions\FacebookSDKException $e) {
        // When validation fails or other local issues
        array_push($errorList, $e->getMessage());
        $log->error(sprintf("User failed for facebook login %s", $e->getMessage()));
        $app->render('login.html.twig', array('loginFailed' => TRUE, 'errorList' => $errorList));
    }

    if (!isset($accessToken)) {
        if ($helper->getError()) {
            header('HTTP/1.0 401 Unauthorized');
            echo "Error: " . $helper->getError() . "\n";
            echo "Error Code: " . $helper->getErrorCode() . "\n";
            echo "Error Reason: " . $helper->getErrorReason() . "\n";
            echo "Error Description: " . $helper->getErrorDescription() . "\n";
        } else {
            header('HTTP/1.0 400 Bad Request');
            echo 'Bad request';
        }
        exit;
    }

    // Logged in
    echo '<h3>Access Token</h3>';
    var_dump($accessToken->getValue());

    // The OAuth 2.0 client handler helps us manage access tokens
    $oAuth2Client = $fb->getOAuth2Client();

    // Get the access token metadata from /debug_token
    $tokenMetadata = $oAuth2Client->debugToken($accessToken);
    echo '<h3>Metadata</h3>';
    var_dump($tokenMetadata);

    // Validation (these will throw FacebookSDKException's when they fail)
    $tokenMetadata->validateAppId($app_id); // Replace {app-id} with your app id
    // If you know the user ID this access token belongs to, you can validate it here
    //$tokenMetadata->validateUserId('123');
    $tokenMetadata->validateExpiration();

    if (!$accessToken->isLongLived()) {
        // Exchanges a short-lived access token for a long-lived one
        try {
            $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
        } catch (Facebook\Exceptions\FacebookSDKException $e) {
            echo "<p>Error getting long-lived access token: " . $helper->getMessage() . "</p>\n\n";
            exit;
        }

        echo '<h3>Long-lived</h3>';
        var_dump($accessToken->getValue());
    }

    $_SESSION['fb_access_token'] = (string) $accessToken;

    // User is logged in with a long-lived access token.
    // You can redirect them to a members-only page.
    //header('Location: https://example.com/members.php');


//    try {
//        // Get the \Facebook\GraphNodes\GraphUser object for the current user.
//        // If you provided a 'default_access_token', the '{access-token}' is optional.
////        $response = $fb->get('/me', '{access-token}');
//        $accessToken = $helper->getAccessToken();
//        $response = $fb->get('/me?fields=id,name', $accessToken);
//        $user = $response->getGraphUser();
//        $_SESSION['eshopuser'] = $user;
//        $log->debug(sprintf("User %s logged in successfuly from IP %s", $user['ID'], $_SERVER['REMOTE_ADDR']));
//        $app->render('eshop.html.twig', array(
//            "eshopuser" => $_SESSION['eshopuser']
//        ));
//    } catch (\Facebook\Exceptions\FacebookResponseException $e) {
//        // When Graph returns an error
//        array_push($errorList, $e->getMessage());
//        $log->error(sprintf("User failed for facebook login %s", $e->getMessage()));
//        $app->render('login.html.twig', array('loginFailed' => TRUE, 'errorList' => $errorList));
//    } catch (\Facebook\Exceptions\FacebookSDKException $e) {
//        // When validation fails or other local issues
//        array_push($errorList, $e->getMessage());
//        $log->error(sprintf("User failed for facebook login %s", $e->getMessage()));
//        $app->render('login.html.twig', array('loginFailed' => TRUE, 'errorList' => $errorList));
//    }

})->via('GET', 'POST');