<?php
require "db.php";
$obj=new db();
$id=$_GET['id'];
$data=$obj->viewbyid($id);

if(isset($_POST['submit']))
{
    $name=$_POST['name'];
    $email=$_POST['email'];
    $mobile=$_POST['mobile'];
    $gender=$_POST['gender'];
    $dob=$_POST['dob'];
    $address=$_POST['address'];
    $status=$_POST['status'];

    $img="";
    if($_FILES['img']['name']!=""){
        $img=$_FILES['img']['name'];
        move_uploaded_file($_FILES['img']['tmp_name'],"uploads/".$img);
    }

    $obj->update($id,$img,$name,$email,$mobile,$gender,$dob,$address,$status);
    header("Location:index.php");
}
?>

<html>
<head>
    <link href="output.css" rel="stylesheet">
</head>

<body class="bg-slate-100">

<div class="min-h-screen flex items-center justify-center p-6">

    <div class="bg-white shadow-2xl rounded-2xl p-10 w-full max-w-3xl">

        <h2 class="text-3xl font-bold text-center text-blue-600 mb-8">
            Update User
        </h2>

        <form method="post" enctype="multipart/form-data" class="grid md:grid-cols-2 gap-6">

            <!-- Name -->
            <div>
                <label class="font-semibold">Name</label>
                <input type="text" name="name" value="<?= $data['name']?>" required
                    class="w-full mt-2 p-3 border rounded-lg focus:ring-2 focus:ring-blue-400">
            </div>

            <!-- Email -->
            <div>
                <label class="font-semibold">Email</label>
                <input type="email" name="email" value="<?= $data['email']?>" required
                    class="w-full mt-2 p-3 border rounded-lg focus:ring-2 focus:ring-blue-400">
            </div>

            <!-- Mobile -->
            <div>
                <label class="font-semibold">Mobile</label>
                <input type="text" name="mobile" value="<?= $data['mobile']?>" required
                    class="w-full mt-2 p-3 border rounded-lg focus:ring-2 focus:ring-blue-400">
            </div>

            <!-- DOB -->
            <div>
                <label class="font-semibold">DOB</label>
                <input type="date" name="dob" value="<?= $data['date_of_birth']?>"
                    class="w-full mt-2 p-3 border rounded-lg focus:ring-2 focus:ring-blue-400">
            </div>

            <!-- Gender -->
            <div>
                <label class="font-semibold block mb-2">Gender</label>
                <div class="flex gap-6">
                    <label>
                        <input type="radio" name="gender" value="Male" <?=$data['gender']=='Male' ?'checked':''?>> Male
                    </label>
                    <label>
                        <input type="radio" name="gender" value="Female" <?=$data['gender']=='Female' ?'checked':''?>> Female
                    </label>
                </div>
            </div>

            <!-- Status -->
            <div>
                <label class="font-semibold">Status</label>
                <select name="status"
                    class="w-full mt-2 p-3 border rounded-lg focus:ring-2 focus:ring-blue-400">
                    <option value="1" <?=$data['status']==1?'selected':''?>>Active</option>
                    <option value="0" <?=$data['status']==0?'selected':''?>>Inactive</option>
                </select>
            </div>

            <!-- Address -->
            <div class="md:col-span-2">
                <label class="font-semibold">Address</label>
                <textarea name="address"
                    class="w-full mt-2 p-3 border rounded-lg focus:ring-2 focus:ring-blue-400"><?= $data['address']?></textarea>
            </div>

            <!-- Image -->
            <div class="md:col-span-2">
                <label class="font-semibold">Change Image</label>
                <input type="file" name="img"
                    class="w-full mt-2 p-3 border rounded-lg bg-white">
                
                <img src="uploads/<?= $data['profile_img']?>" 
                     class="mt-4 w-24 h-24 rounded-full border">
            </div>

            <!-- Submit -->
            <div class="md:col-span-2 text-center mt-4">
                <input type="submit" name="submit" value="Update User"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-10 py-3 rounded-lg text-lg font-semibold cursor-pointer">
            </div>

        </form>

    </div>

</div>

</body>
</html>
