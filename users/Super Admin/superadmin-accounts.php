<?php
    session_start();
    include "../../source/includes/config.php";

	$usertype = "Superadmin";
    $username = $_SESSION['login_user'];
    $sql = "SELECT * usertype='Superadmin' FROM tbluser";
    $result = mysqli_query($connection,$sql);

    $get_user = mysqli_query($connection,"SELECT * FROM tbluser WHERE email='$username'");
    while($getuser=mysqli_fetch_array($get_user))
    {
        $adminid = $getuser['id'];
        $firstname = $getuser['firstname'];
        $lastname = $getuser['lastname'];
        $full = ucfirst($firstname).' '.ucfirst($lastname);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Wmsu-Icon -->
    <link rel="icon" href="../../source/assets/images/wmsulogo.png">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- BOOTSTRAP -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous" />
    <!-- OFFLINE BOOTSTRAP -->
	<link rel="stylesheet" href="../../source/bootstrap/bootstrap-4.6.1-dist/css/bootstrap.min.css" />
    <!-- fontawesome -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <!-- DATATABLE -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.0/css/dataTables.bootstrap4.min.css" /> 
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!-- local css -->
    <link rel="stylesheet" href="../../source/css/style-superadmin.css" />
    <link rel="stylesheet" href="../../source/css/admin.css" />
    <title>Accounts</title>
</head>
<body>
    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top" id="navbar">
        <div class="container-fluid">
            <!-- ICS LOGO -->
            <a class="navbar-brand p-0 m-0" id="nav-logo" href="superadmin-homepage.php">
                <img class="rounded-circle p-0" src="../../source/assets/images/wmsu-seal.png" alt="WMSU SEAL" width="32" height="32" />
                <span class="text-uppercase">Online Pre-Advising</span>
            </a>

            <!-- MOBILE TOGGLE -->
            <button class="navbar-toggler m-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span><i class="fas fa-bars"></i></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <!-- Profile -->
                    <!-- <li class="nav-item">
                        <a class="nav-link active py-0" aria-current="page" href="superadmin-myprofile.html"><i id="icons" class="fas fa-user-tie"></i><span class="nav-label"> My Profile</span></a>
                    </li> -->
                    <!-- Home -->
                    <li class="nav-item">
                        <a class="nav-link active py-0" aria-current="page" href="superadmin-homepage.php"><i id="icons" class="fas fa-home"></i><span class="nav-label"> Home</span></a>
                    </li>
                    <!-- logout -->
                    <li class="nav-item">
                        <a id="icons" class="nav-link active py-0" href="../../signin/universal-signin.html" aria-disabled="true"><i class="fas fa-sign-out-alt"></i><span class="nav-label"> Logout</span></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- END OF NAVBAR -->

    <div class="container mb-1">
        <p class="text mt-3 text-danger fw-bold text-center fs-2">Colleges Accounts</p>

        <button type="button" class="btn btn-secondary fas fa-chevron-left" onclick="location.href='superadmin-homepage.php'"> Back</button>
    <?php
        $check_college = mysqli_query($connection,"SELECT * FROM tblcollege");
    ?>
        <div class="border bg-light bg-gradient mt-3">
            <div class="cards">
    <?php
        if(mysqli_num_rows($check_college) > 0)
        {
            while($fa = mysqli_fetch_array($check_college))
            {
                $col_id = $fa['college'];
    ?>
        <form action="superadmin-colleges-accounts.php" method="POST">
            <input type="hidden" name="collegeid" value="<?php echo $col_id ?>">
            <button class="cards-single text-center">
                <span class="text-white fw-bold mt-3"><?php echo $fa['college'] ?></span>
            </button>
        </form>
    <?php
            }
        }
    ?>
            </div>   
        </div>
	</div>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <!-- Datatables link -->    
    <script scr="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>    
    <script src="https://cdn.datatables.net/1.11.0/js/jquery.dataTables.min.js"></script>  
    <script src="https://cdn.datatables.net/1.11.0/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap.min.js"></script>

    <?php
		include("../../source/includes/alertmessage.php");
	?> 

    <script>
        
    </script>

</body>
</html>