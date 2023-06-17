<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <script src="js/update.js"></script>

</head>

<body>
    <div id='divaddacc'>

        <div id='addaccstatus'>

        </div>

        <form>
            <div class="m-3">
                <label for="name" class="form-label">User's Name</label>
                <input type="text" class="form-control" id="txtname" placeholder="Enter Name Here">
            </div>
            <div class="m-3">
                <label for="email" class="form-label">User's Email</label>
                <input type="text" class="form-control" id="txtemail" placeholder="Enter Email Here">
            </div>
            <div class="m-3">
                <label for="password" class="form-label">User's Password</label>
                <input type="password" class="form-control" id="txtpass" placeholder="Enter Password Here">
            </div>
            <div class="row g-3 m-2">
                <label for="Interest" class="form-label">User's Interest</label>
                <div class="col-sm-4">
                    <select class="form-select" id='act1' aria-label="Default select example">
                        <!-- <option selected>Open this select menu</option> -->
                    </select>
                </div>
                <div class="col-sm-4">
                    <select class="form-select" id='act2' aria-label="Default select example">
                    </select>
                </div>
                <div class="col-sm-4">
                    <select class="form-select" id='act3' aria-label="Default select example">
                    </select>
                </div>
            </div>
            <button type="button" class="btn btn-primary m-3" id='addaccbtn' style="width:97.2%">Submit</button>
        </form>
        <div class="card m-3" id='confirmaddacc'>
            <div class="card-body">
                <h5 class="card-title">Confrim Details</h5>
                <p class="card-text">Please enter the admin password to confirm adding the details of the user</p>
                <!-- <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p> -->
                <div>
                    <label for="password" class="form-label">Admin's Password</label>
                    <input type="password" class="form-control" id="txtadminpass" placeholder="Enter Password Here">
                    <button type="button" class="btn btn-primary mt-2" id='verifyadddbtn' style="width:97.2%">Verify</button>
                </div>
            </div>
        </div>

    </div>

</body>

</html>