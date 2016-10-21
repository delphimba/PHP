<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--MATTHEW B ANDERSON IT207 LAB9-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <link rel="stylesheet" type="text/css" href="style.css" /> 
    <title>VISITOR DELETED</title>
</head>
<body>
    <p class="title">Visitor Deleted</p>
    <hr />
    <?php
        $deleteNumber = (isset($_POST['deleteNumber'])) ? $_POST['deleteNumber'] : 0;
        #echo '<pre>'; echo print_r($_POST); echo '</pre>';
        $indexNumber = $deleteNumber - 1;
        #echo $indexNumber;
        $data = file('records.txt');
        #echo '<pre>'; echo print_r($data); echo '</pre>';
        
        unset($data[$indexNumber]);
        #echo '<pre>'; echo print_r($data); echo '</pre>';
        $data = array_values($data);
        #echo '<pre>'; echo print_r($data); echo '</pre>';
        
        ########################################################################
        #
        # OPEN FILE: records.txt / WRITE NEW ARRAY VALUES TO FILE.
        #
        ########################################################################
        $handle = fopen('records.txt','w');
        flock($handle,LOCK_EX);
        
        for($i=0;$i<count($data);$i++) {
            $line = $data[$i];
            fwrite($handle,$line);    
        }
        
        flock($handle,LOCK_UN);
        fclose($handle);
        
        /**********************************************************************\
         * 
         * LINK TO GO BACK TO GUESTBOOK VIEW
         * 
        \**********************************************************************/          
        echo '<a href="viewGuestBook.php">Go Back</a>';
        echo '<hr />';
        
    ?>
</body>	
</html>