<?php

require_once "config.php";

if(!isset($_SESSION["admin_id"]))
{
    header("location: index.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
</head>
<body>
    <?php
        if(isset($_SESSION["success_message"])):
    ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?php
            echo $_SESSION["success_message"];
            unset($_SESSION["success_message"]); 
        ?>
        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php endif ?>

    <div class="container">

            <div class="row">
                <div class="col-md-12">
                    <h2>Members List</h2>

                    <!-- Kad se radi GET request moze da se koristi link, ne mora forma -->
                    <a href="export.php?what=members" class="btn btn-success btn-sm">Export </a>

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th>Trainer</th>
                                <th>Photo</th>
                                <th>Training plan</th>
                                <th>Access Card</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $upit="SELECT members.*, training_plans.name AS training_plan_name, trainers.first_name 
                                        AS trainer_first_name, trainers.last_name AS trainer_last_name FROM members 
                                        LEFT JOIN training_plans ON members.training_plan_id=training_plans.plan_id 
                                        LEFT JOIN trainers ON members.trainer_id=trainers.trainer_id";
                                $run=$konekcija->query($upit);
                                $results=$run->fetch_all(MYSQLI_ASSOC);
                                $select_members=$results;//Koristi se dole

                                foreach($results as $result) : ?>
                                {
                                    <tr>
                                        <td><?php echo $result["first_name"]; ?></td>
                                        <td><?php echo $result["last_name"]; ?></td>
                                        <td><?php echo $result["email"]; ?></td>
                                        <td><?php echo $result["phone_number"]; ?></td>
                                        <td><?php 
                                                if($result["trainer_first_name"])
                                                {
                                                    echo $result["trainer_first_name"] . " " . $result["trainer_last_name"];
                                                }
                                                else
                                                {
                                                    echo "Nije dodeljen trener";
                                                }
                                            ?></td>
                                        <td><img sryle="width: 60px, height: 60px" src="<?php echo $result["photo_path"]; ?>"></td>
                                        <td><?php 
                                                if($result["training_plan_name"])
                                                {
                                                    echo $result["training_plan_name"];
                                                }
                                                else
                                                {
                                                    echo "Nema plana treninga";
                                                }
                                            ?></td>
                                        <td><a target="_blank" href="<?php echo $result["access_card_pdf_path"]; ?>">Access Card</a></td>
                                        <td><?php
                                                $create_at=strtotime($result["created_at"]); 
                                                $new_date=date("F, jS Y", $create_at);
                                                echo $new_date;
                                            ?></td>
                                        <td>
                                            <form action="delete_member.php" method="POST">
                                                <input type="hidden" name="member_id" value="<?php echo $result["member_id"] ?>">
                                                <button type="submit">DELETE</button>
                                            </form>
                                            
                                        </td>
                                    </tr>
                                }
                            <?php endforeach; ?>
                        </tbody>
                    </table>   
                </div>

                <div class="col-md-12">
                    <h2>Trainers List</h2>

                    <!-- Kad se radi GET request moze da se koristi link, ne mora forma -->
                    <a href="export.php?what=trainers" class="btn btn-success btn-sm">Export </a>

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>First name</th>
                                <th>Last name</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $upit="SELECT * FROM trainers";
                                
                                $run=$konekcija->query($upit);
                                $results=$run->fetch_all(MYSQLI_ASSOC);
                                $select_trainers=$results;//Koristi se dole

                                foreach($results as $result) : ?>
                                    <tr>
                                        <td><?php echo $result["first_name"]; ?></td>
                                        <td><?php echo $result["last_name"]; ?></td>
                                        <td><?php echo $result["email"]; ?></td>
                                        <td><?php echo $result["phone_number"]; ?></td>
                                        <td><?php echo date("F jS, Y", strtotime($result["created_at"])); ?></td>
                                    </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>

        <div class="row mb-5">
            <div class="col-md-6">
                <h2>Register member</h2>
                <form action="register_member.php" method="post" enctype="multipart/form-data">
                    First name: <input type="text" class="form-control" name="first_name"><br>
                    Last name: <input type="text" class="form-control" name="last_name"><br>
                    Email: <input type="email" class="form-control" name="email"><br>
                    Phone number: <input type="text" class="form-control" name="phone_number"><br>
                    Training Plan:
                    <select name="training_plan_id" class="form-control">
                        <option value="" disabled selected>Training Plan</option>
                        <?php
                            $upit="SELECT * FROM training_plans";
                            $run=$konekcija->query($upit);
                            $results=$run->fetch_all(MYSQLI_ASSOC);

                            foreach($results as $result)
                            {
                                echo "<option value='" . $result['plan_id'] . "'>" . $result["name"] . "</option>";
                            }   
                        ?>
                    </select><br>
                    <input type="hidden" name="photo_path" id="photoPathInput">
                    <div id="dropzone-upload" class="dropzone"></div>

                    <input type="submit" class="btn btn-primary mt-3" value="Register Memeber">
                </form>
            </div>
            
            <div class="col-md-6">
                <h2>Register trainer</h2>
                <form action="register_trainer.php" method="POST">
                    First name: <input type="text" class="form-control" name="first_name"><br>
                    Last name: <input type="text" class="form-control" name="last_name"><br>
                    Email: <input type="email" class="form-control" name="email"><br>
                    Phone number: <input type="text" class="form-control" name="phone_number"><br>
                    <input type="submit" class="btn btn-primary" value="Register Trainer">
                </form>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <h2>Assing Trainer to Member</h2>
                <form action="assign_trainer.php" method="POST">
                    <label for="">Select Member</label>
                    <select name="member" class="form-select">
                        <?php
                            foreach($select_members as $member): ?>
                                <option value="<?php echo $member["member_id"]; ?>">
                                    <?php echo $member["first_name"] . " " . $member["last_name"]; ?>
                                </option>
                        <?php endforeach ?>
                    </select>

                    <label for="">Select Trainer</label>
                    <select name="trainer" class="form-select">
                        <?php    
                            foreach($select_trainers as $trainer): ?>
                                <option value="<?php echo $trainer["trainer_id"]; ?>">
                                    <?php echo $trainer["first_name"] . " " . $trainer["last_name"]; ?>
                                </option>
                        <?php endforeach ?>
                    </select>

                    <button type="submit" class="btn btn-primary">Assign Trainer</button>
                </form>
            </div>
        </div>
    </div>

    <?php $konekcija->close(); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>

    <script>
        Dropzone.options.dropzoneUpload={
            url: "upload_photo.php",
            paramName: "photo",
            maxFilesize: 20,
            acceptedFiles: "image/*",
            init: function () {
                this.on("success", function(file, response)
                {
                    const jsonResponse=JSON.parse(response);
                    if(jsonResponsne.success)
                    {
                        document.getElementById("photoPathInput").value=jsonResponse.photo_path;
                    } else
                    {
                        console.error(jsonResponse.error);
                    }
                });
            }
        };
    </script>
</body>
</html>

