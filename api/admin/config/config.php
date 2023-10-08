<?php
    #create connection
    $dbhost = 'localhost:3306';
    $dbuser = 'root';
    $dbpwd = '';
    $db = 'ss25';
   
    $conn = mysqli_connect("localhost","root","","ss25");

    if(mysqli_connect_errno()) {
        die('Could not connect: ' . mysqli_connect_error());
        exit();
    }

    function  msg_style($msg,$type){
        switch($type){
            case 'success':
                echo '
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!    </strong> '.$msg.'
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    ';
                    break;
            case 'warning':
                echo '
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Warning!    </strong> '.$msg.'
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    ';
                break;
            case 'info':
                echo '
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        <strong>Info!   </strong> '.$msg.'
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
                break;
            default:
                echo '
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Danger!     </strong>'.$msg.'
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
                break;
        }
    }

    // echo "Connected successfully";
?>