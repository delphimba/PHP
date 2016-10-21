<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--MATTHEW B ANDERSON IT207 LAB9-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <link rel="stylesheet" type="text/css" href="style.css" /> 
    <title>SIGN GUESTBOOK</title>
</head>
<body>
    <?php
    /**************************************************************************\
     * 
     * FUNCTION USED TO DISPLAY IF SIGNED SUCCESSFULLY.
     * 
    \**************************************************************************/
        function nameAddSuccess($firstName,$lastName,$email,$comment) {
    ?> 
            <p class="title">Name Added</p>
            <hr />
    <?php
            echo '<p class="fieldTitle">';
            echo "First Name: " . $firstName . '<br />';
            echo "Last Name: " . $lastName . '<br />';
            echo "Email Address: " . $email . '<br />';
            echo "Comments: " . $comment . '<br />';
            echo '</p>';
    ?> 
            <hr />
            <a href="index.html">Add Another Visitor</a> or <a href="viewGuestBook.php">View GuestBook</a>            
    <?php
        }
    /**************************************************************************\
     * 
     * FUNCTION USED TO DISPLAY IF SIGNING FAILED.
     * 
    \**************************************************************************/
        function nameAddFailure() {
    ?>
            <p class="title">Error Signing Guest Book.</p>
            <hr />
            <a href="index.html">Try Again.</a>
    <?php
        }
        
        function errorList() {
    ?>
            <p class="title">THERE WERE ERRORS IN PROCESSING...</p>
            <hr />
    <?php
        }
        if(count($_POST) > 0) {
        ########################################################################
        #
        # VALIDATE FORM DATA - CHECK FOR EMPTY OR NULL VALUES
        # 
        ########################################################################
        $error = false;
        $errorList = array();
        #echo '<pre>'; echo print_r($_POST); echo '</pre>';
    
        if(!isset($_POST['firstName']) || empty($_POST['firstName']) || $_POST['firstName'] == "") {
            $error = true;
            $errorList[] = "THE FIRST NAME FIELD IS NOT VALID.";
        }
        if(!isset($_POST['lastName']) || empty($_POST['lastName']) || $_POST['lastName'] == "") {
            $error = true;
            $errorList[] = "THE LAST NAME FIELD IS NOT VALID.";
        }
        if(!isset($_POST['email']) || empty($_POST['email']) || $_POST['email'] == "") {
            $error = true;
            $errorList[] = "THE EMAIL ADDRESS FIELD IS NOT VALID.";
        }
        if($_POST['comment'] == "Make a Comment...") {
            $error = true;
            $errorList[] = "COMMENT CAN NOT BE DEFAULT: 'MAKE A COMMENT...'";
        }
        /**********************************************************************\
         *
         *  NOW SEARCHING FOR DUPLICATE RECORDS                                
         * 
        \**********************************************************************/
        $data = file('records.txt');
        $found = false;            
        foreach($data as $d) {
            $line = explode("|",$d);
            if($line[0] == $_POST['firstName'] && $line[1] == $_POST['lastName']) {
                $found = true;
                $errorList[] = "YOU HAVE ALREADY SIGNED THE GUEST BOOK!";
            }
        }
        ########################################################################
        # 
        # SHOW ERROR LIST FOR INVALID ENTRIES
        # 
        ########################################################################
        if($error || $found) {
            errorList();
            echo '<ul>';
            foreach($errorList as $e) {
                echo '<li>' . $e . '</li>';
            }
            echo '</ul>';
            echo '<hr />';
            echo '<a href="index.html">Try Again.</a>';
        }
        else {
            ####################################################################
            # 
            # START PROCESSING THE FORM AND INSERT INTO RECORDS.TXT
            # 
            ####################################################################
            $handle = fopen('records.txt','a');
            flock($handle,LOCK_EX);
            $firstName = $_POST['firstName'];
            $lastName = $_POST['lastName'];
            $email = $_POST['email'];
            $comment = $_POST['comment'];
            $line = $_POST['firstName'] . "|" . $_POST['lastName'] . "|" . $_POST['email'] . "|" . $_POST['comment'] . PHP_EOL;
            if(fwrite($handle,$line) > 0) {
                nameAddSuccess($firstName,$lastName,$email,$comment);
            }
            else {
                nameAddFailure();
            }
            flock($handle,LOCK_UN);
            fclose($handle);
        }
        }
    ?>
</body>	
</html>