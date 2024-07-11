<?php
    require 'connection.php';
    // print_r($_FILES['image']);

    /* Output:
    Array ( 
    [name] => Screenshot 2023-06-04 231647.png 
    [full_path] => Screenshot 2023-06-04 231647.png 
    [type] => image/png 
    [tmp_name] => C:\xampp\tmp\phpDEF1.tmp 
    [error] => 0 
    [size] => 111650 
    )
    */

    if(isset($_POST['submit'])) {
        $name = $_POST['name'];
        if($_FILES['image']['error'] === 4){
            echo "<script>alert('Please select an image');</script>";
        }
        else{
            $fileName = $_FILES['image']['name'];
            $fileTmpName = $_FILES['image']['tmp_name'];
            $fileSize = $_FILES['image']['size'];

            $validExt = ['jpg', 'jpeg', 'png'];
            $fileExt = explode('.', $fileName);
            // The explode() function breaks a string into an array.

            $fileExtStore = $fileExt; // Store the file extension in a variable.

            $fileExt = strtolower(end($fileExt));
            // end() outputs, the last element in the array.

            if(!in_array($fileExt, $validExt)){
                echo "<script>alert('Invalid Image Extention');</script>";
            }
            elseif($fileSize>1000000){
                echo "<script>alert('File Size is too Large');</script>";
            }
            else{
                // $newFileName = uniqid(); //generate random unique id
                // $newFileName = $name; //new file name will be form name
                $newFileName = reset($fileExtStore); //preserve the original file name
                $newFileName = $newFileName.'.'.$fileExt;
                
                file_exists('uploads') or mkdir('uploads'); 
                //check if the directory exists, if not create it
                $destination = 'uploads/'.$newFileName;

                move_uploaded_file($fileTmpName, $destination);
                // The move_uploaded_file() function moves an uploaded file to a new destination.
                $sql = "INSERT INTO tb_upload (name, image) VALUES ('$name', '$newFileName')";
                $result = mysqli_query($conn, $sql);
                if($result){
                    echo "<script>alert('Image Uploaded Successfully');</script>";
                }
                else{
                    echo 
                    "<script>
                        alert('Failed to Upload Image');
                        document.location.href = 'data.php';
                    </script>";
                }
            }
        }
        
    }

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Image File</title>
</head>
<body>
    <form action="" method="POST" autocomplete="off" enctype="multipart/form-data">
        <label for="name">Name : </label>
        <input type="text" name="name" id="name" required>
        <br><br>
        <label for="image">Image : </label>
        <input type="file" name="image" id="image" accept=".jpg, .jpeg, .png">
        <br><br>
        <button type="submit" name="submit">Submit</button>
    </form>
    <br>
    <a href="data.php">Data</a>
</body>
</html>