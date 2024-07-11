<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data</title>
</head>
<body>
    <table border = 1 cellspacing = 0 cellpading = 10>
        <tr>
            <td>#</td>
            <td>Name</td>
            <td>Image</td>
        </tr>
        <?php 
        include 'connection.php';
        $sql = "SELECT * FROM tb_upload ORDER BY id DESC";
        $result = mysqli_query($conn, $sql);
        $i = 1;
        while($row = mysqli_fetch_assoc($result)){
            echo "
            <tr> 
                <td>".$i++."</td>
                <td>".$row['name']."</td>
                <td><img src='uploads/".$row['image']."' width='200' title='".$row['image']."'></td>
            <tr/>";
        }
        ?>

        
        <?php 
            /*
            $i=1;
            $sql = "SELECT * FROM tb_upload ORDER BY id DESC";
            $result = mysqli_query($conn, $sql);
            $rows = mysqli_fetch_assoc($result);

            >? //end php

            <?php foreach($rows as $row): ?>
            <tr>
                <td><?php echo $i++; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><img src="uploads/<?php echo $row['image']; ?>" width="200" title="<?php echo $row['image']; ?>">
                </td>
            </tr>
            <?php endforeach; ?>
            */
        ?>

    </table>
    <br>
    <!-- <a href="index.php">Upload Image</a> -->
    <a href="../photo_upload">Upload Image</a>
</body>
</html>