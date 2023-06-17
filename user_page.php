<?php
    include("connection.php");
    session_start();
    if(!isset($_SESSION['user']))
    {
        header('location:login.php');
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Books</title>
    </head>
    <body>
        <h1>WELCOME TO LIBRARY<span><?php echo$_SESSION['user'] ?></span></h1>
        <h2>List Of Books</h2>
        <?php
            $sql="SELECT * FROM books";
            $result=mysqli_query($conn,$sql);
            if(mysqli_num_rows($result>0))
            {
                echo "<table border='2'>
                <tr style='background-color:white;'>
                    <th>ID</th>
                    <th>Book title</th>
                    <th>author</th>
                    <th>genre</th>
                    <th>year</th>
                    <th>quantity</th>
                </tr>";
                while($row=mysqli_fetch_assoc($result))
                {
                    echo "<tr>
                    <td>".$row['Id']."</td>
                    <td>".$row['booktitle']."</td>
                    <td>".$row['author']."</td>
                    <td>".$row['genre']."</td>
                    <td>".$row['year']."</td>
                    <td>".$row['quantity']."</td>
                    </tr>";
                }
                echo "</table>";
            }
            else
            {
                echo "result 0";

            }
        ?>
        <a href="login.php" class="btn">login</a>
        <a href="signup.php" class="btn">register</a>
        <a href="logout.php" class="btn">logout</a>
    </body>
</html>