<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--MATTHEW B ANDERSON IT207 LAB9-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <link rel="stylesheet" type="text/css" href="style.css" /> 
    <title>VIEW GUESTBOOK</title>
</head>
<body>
    <p class="title">Visitors</p>
    <hr />
    <?php
        $data = file('records.txt');
        #echo '<pre>'; echo print_r($data); echo '</pre>';
        
        echo '<table border="1" class="center">';
        echo '<tr>';
        echo '<td class="title">Visitor #</td>';
        echo '<td class="title">Visitor</td>';
        echo '</tr>';
        foreach($data as $k => $d) {
            $line = explode("|",$d);
            echo '<tr>';
            echo '<td>' . ($k+1) . '</td>';
            echo '<td class="left">';
            echo "First Name: " . $line[0] . '<br />';
            echo "Last Name: " . $line[1] . '<br />';
            echo "Email Address: " . $line[2] . '<br />';
            echo "Comments: " . $line[3] . '<br />';
            echo '</td>';
            echo '</tr>';
        }
        echo '</table>';
        echo '<hr />';
        echo '<a href="index.html">Add New Visitor</a><br />';
        echo '<a href="viewGuestBookAZ.php">Sort Visitors A-Z</a><br />';
        echo '<a href="viewGuestBookZA.php">Sort Visitors Z-A</a><br />';
        echo '<form action="delete.php" method="post">';
        echo '<p class="body">Delete visitor number: <input type="text" size="2" name="deleteNumber" />&nbsp;&nbsp;&nbsp;<input type="submit" value="DELETE" /></p>';
        echo '</form>';
        
    ?>
</body>	
</html>