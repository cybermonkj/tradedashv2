<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trapander Emergency Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/main.min.css">
    <style>
        .navbar{background:#00047a !important;display:flex !important;justify-content:space-between !important}.navbar-brand{color:#FFF}
    </style>
</head>
<body>
    <header class="header">
        <nav class="navbar navbar-light bg-light">
            <!-- <form class="form-inline">
              <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn bg-white text-blue my-2 my-sm-0" type="submit">Search</button>
            </form> -->
            <h1 class="navbar-brand text-white">Tradepander</h1>
          </nav>
        </header>

        <main>

        <div class="container mt-4 mb-4">
              <div class="row">
                  <div class="col">
                    <div class="card">
                        <div class="card-body">
                          <h5 class="card-title">John Snow</h5>
                          <h6 class="card-subtitle mb-2 text-muted">Plan Type</h6>
                          <p class="card-text">Wallet Balance: </p>
                          <button href="#" class="card-link btn btn-success">Suspend Account</button>
                          <button href="#" class="card-link btn btn-danger">Activate Account</button>
                        </div>
                      </div>
                  </div>
                  <div class="col">
                    <div class="card">
                        <div class="card-body">
                          <h5 class="card-title">More Details</h5>
                          <h6 class="card-subtitle mb-2 text-muted">Initial Balance: </h6>
                          <p class="card-text">Current Balance After Withdrawal Attempt: </p>
                          <button href="#" class="card-link btn btn-success">Approve Withdrawal</button>
                          <button href="#" class="card-link btn btn-danger">Disapprove Withdrawal</button>
                        </div>
                      </div>
                  </div>
                  </div>
              </div>
          </div>

          <div class="row">
              
          </div>

          <div class="container">
            <h1 class="display-5">Plan History</h1>

            <table class="table mt-4">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">S/N</th>
                    <th scope="col">User ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Time Stamp</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">1</th>
                    <td>1</td>
                    <td>John Snow</td>
                    <td>$15</td>
                    <td>2020-03-21-15:21</td>
                  </tr>
                </tbody>
              </table>
          </div>
        </main>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
<script>
    const btn = document.querySelector(".process");
    btn.addEventListener('click', (e) => {
        e.preventDefault();
    })
</script>
</body>
</html>