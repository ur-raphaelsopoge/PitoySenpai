<?php
include 'db.php';

if(!isset($_GET['id'])){
    header("Location: admin.php");
    exit();
}

$id = $_GET['id'];
$sql = "SELECT * FROM login_tb WHERE id='$id'";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);

if(!$user){
    header("Location: admin.php");
    exit();
}

if(isset($_POST['submit'])){
    $firstname = $_POST['fname'];
    $lastname = $_POST['lname'];
    $password = $_POST['password'];

    $update_sql = "UPDATE login_tb SET firstname='$firstname', lastname='$lastname', password='$password' WHERE id='$id'";
    
    if(mysqli_query($conn, $update_sql)){
        header("Location: admin.php");
        exit();
    } else {
        $error = "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="signup.css">
    <title>PitoySenpai</title>
</head>
<body>
    <div class="main">
        <div class="form-container">
            <h2>Edit User</h2><br>
            <?php if(isset($error)): ?>
                <p style="color: red; text-align: center; margin-bottom: 10px;"><?php echo $error; ?></p>
            <?php endif; ?>
            <form method="POST" action="edit.php?id=<?php echo $id; ?>">
                <div class="grid-form">
                    <div class="form-group">
                        <label>Firstname</label>
                        <input type="text" name="fname" value="<?php echo htmlspecialchars($user['firstname']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Lastname</label>
                        <input type="text" name="lname" value="<?php echo htmlspecialchars($user['lastname']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" value="<?php echo htmlspecialchars($user['password']); ?>" required>
                    </div>
                    <button type="submit" name="submit">Update</button>
                </div>
            </form>
            <div style="text-align: center; margin-top: 15px;">
                <a href="admin.php" style="color: blue;">Back to Admin</a>
            </div>
        </div>
    </div>
</body>
</html>
