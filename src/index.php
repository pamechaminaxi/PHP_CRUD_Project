<?php
require "db.php";
$obj = new db();

if(isset($_POST['submit']))
{
    $name=$_POST['name'];
    $email=$_POST['email'];
    $mobile=$_POST['mobile'];
    $gender=$_POST['gender'];
    $dob=$_POST['dob'];
    $address=$_POST['address'];
    $status=$_POST['status'];

    if($name=="" || $email=="" || $mobile==""){
        echo "<script>alert('Required fields missing');</script>";
    }
    elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        echo "<script>alert('Invalid Email');</script>";
    }
    elseif(strlen($mobile)!=10){
        echo "<script>alert('Mobile must be 10 digit');</script>";
    }
    else{
        $target_dir = "uploads/";

        // create folder if not exists
        if(!is_dir($target_dir)){
            mkdir($target_dir,0777,true);
        }

        $fileName = basename($_FILES["img"]["name"]);
        $target_file = $target_dir . time()."_".$fileName;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $uploadOk = 1;

        // check image 
        $check = getimagesize($_FILES["img"]["tmp_name"]);
        if($check === false){
            echo "<script>alert('File is not an image');</script>";
            $uploadOk = 0;
        }

        // file size check (500kb)
        if ($_FILES["img"]["size"] > 500000){
            echo "<script>alert('File too large (max 500kb)');</script>";
            $uploadOk = 0;
        }

        // allow only image formats
        if($imageFileType!="jpg" && $imageFileType!="png" && 
           $imageFileType!="jpeg" && $imageFileType!="gif"){
            echo "<script>alert('Only JPG, PNG, JPEG, GIF allowed');</script>";
            $uploadOk = 0;
        }

        // final upload
        if($uploadOk==1){
            if(move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)){
                $imgName = basename($target_file);

                // INSERT AFTER SUCCESSFUL UPLOAD
                $obj->insert($imgName,$name,$email,$mobile,$gender,$dob,$address,$status);
                header("Location:index.php");
            }else{
                echo "<script>alert('Error uploading image');</script>";
            }
        }
    }
}


if(isset($_GET['delete'])){
    $obj->delete($_GET['delete']);
    header("Location:index.php");
}

$data=$obj->view();
?>
<html>

<head>
    <link href="output.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <script>
        // $(document).ready(() => $('#myTable').DataTable());

        $(document).ready(function () {
    $('#myTable').DataTable({
        "lengthMenu": [[5, 10, 25, 50, 100], [5, 10, 25, 50, 100]]
    });
});


        function del(id) {
            if (confirm("Delete this record?"))
                window.location = "index.php?delete=" + id;
        }
    </script>
</head>

<body class="bg-slate-100">

<div class="max-w-7xl mx-auto px-4 py-10">

    <h2 class="text-4xl font-bold text-center text-blue-600 mb-10">
        User CRUD Management
    </h2>

    <!-- FORM CARD -->
    <div class="bg-white shadow-2xl rounded-2xl p-8 max-w-4xl mx-auto">

        <form method="post" enctype="multipart/form-data" class="grid md:grid-cols-2 gap-6">

            <!-- Name -->
            <div>
                <label class="font-semibold">Name</label>
                <input type="text" name="name" required
                    class="w-full mt-2 p-3 border rounded-lg focus:ring-2 focus:ring-blue-400">
            </div>

            <!-- Email -->
            <div>
                <label class="font-semibold">Email</label>
                <input type="email" name="email" required
                    class="w-full mt-2 p-3 border rounded-lg focus:ring-2 focus:ring-blue-400">
            </div>

            <!-- Mobile -->
            <div>
                <label class="font-semibold">Mobile</label>
                <input type="text" name="mobile" required
                    class="w-full mt-2 p-3 border rounded-lg focus:ring-2 focus:ring-blue-400">
            </div>

            <!-- DOB -->
            <div>
                <label class="font-semibold">DOB</label>
                <input type="date" name="dob"
                    class="w-full mt-2 p-3 border rounded-lg focus:ring-2 focus:ring-blue-400">
            </div>

            <!-- Gender -->
            <div>
                <label class="font-semibold block mb-2">Gender</label>
                <div class="flex gap-6">
                    <label><input type="radio" name="gender" value="Male"> Male</label>
                    <label><input type="radio" name="gender" value="Female"> Female</label>
                </div>
            </div>

            <!-- Status -->
            <div>
                <label class="font-semibold">Status</label>
                <select name="status"
                    class="w-full mt-2 p-3 border rounded-lg focus:ring-2 focus:ring-blue-400">
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
            </div>

            <!-- Address -->
            <div class="md:col-span-2">
                <label class="font-semibold">Address</label>
                <textarea name="address"
                    class="w-full mt-2 p-3 border rounded-lg focus:ring-2 focus:ring-blue-400"></textarea>
            </div>

            <!-- Image -->
            <div class="md:col-span-2">
                <label class="font-semibold">Profile Image</label>
                <input type="file" name="img" required
                    class="w-full mt-2 p-3 border rounded-lg bg-white">
            </div>

            <!-- Submit -->
            <div class="md:col-span-2 text-center">
                <input type="submit" name="submit" value="Insert User"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-10 py-3 rounded-lg text-lg font-semibold cursor-pointer">
            </div>

        </form>
    </div>

    <!-- TABLE CARD -->
    <div class="bg-white shadow-2xl rounded-2xl p-8 mt-14">

        <h3 class="text-2xl font-bold mb-6 text-center">User Records</h3>

        <div class="overflow-x-auto">
            <table id="myTable" class="display w-full text-sm">
                <thead class="bg-blue-600 text-white">
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Gender</th>
                        <th>DOB</th>
                        <th>Address</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach($data as $row){ ?>
                    <tr>
                        <td><?= $row['id']?></td>
                        <td><img src="uploads/<?= $row['profile_img']?>" class="w-12 h-12 rounded-full"></td>
                        <td><?= $row['name']?></td>
                        <td><?= $row['email']?></td>
                        <td><?= $row['mobile']?></td>
                        <td><?= $row['gender']?></td>
                        <td><?= $row['date_of_birth']?></td>
                        <td><?= $row['address']?></td>
                        <td>
                            <?php if($row['status']){ ?>
                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs">Active</span>
                            <?php } else { ?>
                                <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs">Inactive</span>
                            <?php } ?>
                        </td>
                        <td>
                            <a href="update.php?id=<?= $row['id']?>" class="text-blue-600 font-semibold">Edit</a> |
                            <a href="#" onclick="del(<?= $row['id']?>)" class="text-red-600 font-semibold">Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>

            </table>
        </div>
    </div>

</div>
</body>
</html>
