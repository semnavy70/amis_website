<?php 
// if( ( $_SERVER['SERVER_NAME'] == 'agriculturalmarketinformation.org.kh' ) || ( $_SERVER['SERVER_NAME'] == 'www.agriculturalmarketinformation.org.kh' )  ):
    
    // define('WP_ENV', 'prod');
    
// elseif( ( $_SERVER['SERVER_NAME'] == 'staging.amis.systemexperts.asia' ) || ( ( $_SERVER['SERVER_NAME'] == 'www.staging.amis.systemexperts.asia' ) ) ):

//     define('WP_ENV', 'staging');
    
// else:
    
//     define('WP_ENV', 'localdev');
    
// endif;

// if( WP_ENV == 'prod' ):

    define('DB_NAME', 'tmp_db');
    define('DB_USER', 'tmp_db');
    define('DB_PASSWORD', 'tAesKzyTiRjDMGKL');
    define('DB_HOST', '127.0.0.1');

    define('MARKETPLACE_ADMIN_LOGIN_URL', 'http://api.agriculturalmarketinformation.org.kh/api/login_check');
    define('MARKETPLACE_ADMIN_USER', '92665590');
    define('MARKETPLACE_ADMIN_PASSWORD', 'TC7vlUAP');

    // Options

    define('WP_DEBUG', true);
  
// elseif( WP_ENV == 'staging' ):

//     define('DB_NAME', 'amis');
//     define('DB_USER', 'amis');
//     define('DB_PASSWORD', '$#@jdbHYTI');
//     define('DB_HOST', 'localhost');

//     // Options

//     define('WP_DEBUG', false);

//     define('MARKETPLACE_ADMIN_LOGIN_URL', 'http://amis-api.proactit.io/api/login_check');
//     define('MARKETPLACE_ADMIN_USER', '77892624');
//     define('MARKETPLACE_ADMIN_PASSWORD', 'Lh32f2kS');

// elseif( WP_ENV == 'localdev' ):
  
//     define('DB_NAME', 'amis');
//     define('DB_USER', 'amis');
//     define('DB_PASSWORD', 'amis');
//     define('DB_HOST', 'localhost');
//     // Options

//     define('WP_DEBUG', false);

//     define('MARKETPLACE_ADMIN_LOGIN_URL', 'http://amis-api.proactit.io/api/login_check');
//     define('MARKETPLACE_ADMIN_USER', '77892624');
//     define('MARKETPLACE_ADMIN_PASSWORD', 'Lh32f2kS');
  
// else:

//   exit('No environment.');
  
// endif;

$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD,DB_NAME) or die("Could not connect: " . mysqli_error());
//mysqli_connect("localhost","my_user","my_password","my_db");
mysqli_select_db(DB_NAME);

mysqli_query($con,'SET NAMES utf8');
mysqli_query($con,'SET CHARACTER_SET utf8');



?>
