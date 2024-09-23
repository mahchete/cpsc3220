<!DOCTYPE php>
<html>
    <head><title>Project 1</title></head>
    <body>
        <!--- Create Variables from HTML --->
        <?php
            session_start();
            $firstName = $_POST['first'];   # Max of 20
            $lastName = $_POST['last'];     # Max of 20
            $number = $_POST['number'];     # 12 Characters, exactly
            $email = $_POST['email'];       # Max of 30 
        ?>

        <!--- Check Info ---->
        <?php
            if(empty($firstName) || (strlen($firstName)) > 20) {
                echo "Invalid Input. <br>";
                print('<a href="userInfo.html">Back to Login</a>');
            }   
            if(empty($lastName) || (strlen($lastName)) > 20) {
                echo "Invalid Input. <br>";
                print('<a href="userInfo.html">Back to Login</a>');
            } 
            if(empty($number) || (strlen($number)) != 12) {
                echo "Invalid Input. <br>";
                print('<a href="userInfo.html">Back to Login</a>');
            } 
            if(empty($email) || (strlen($email)) > 30) {
                echo "Invalid Input. <br>";
                print('<a href="userInfo.html">Back to Login</a>');
            } else {
                $userInfoFile = 'userInfo.txt';

                if (!file_exists($userInfoFile)) {
                    file_put_contents($userInfoFile, ''); // Create an empty file
                }

                $lines = file($userInfoFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

                // New Line
                $newLine = $lastName.":".$firstName.":".$number.":".$email;

                // Add the new line to the array
                $lines[] = $newLine;

                // Sort the array alphabetically
                sort($lines);

                // Write the sorted array back to the file
                file_put_contents($userInfoFile, implode(PHP_EOL, $lines) . PHP_EOL);
            }
        ?>
        <table border="1">

        <!--- Print List to a Table --->
        <?php
            $file = 'userInfo.txt';
            $tableLines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

            foreach ($tableLines as $lineContent) {
                echo "<tr>";
                echo "<td>"."$lineContent"."</td>";
                echo "</tr>";
            }
        ?>
        </table><br>

        <a href='userInfo.html'>Back to Information Page</a>
    </body>
</html>