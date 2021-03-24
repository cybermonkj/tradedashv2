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
            <h1 class="navbar-brand text-white">Tradepander</h1>
          </nav>

          <div class="jumbotron jumbotron-fluid">
            <div class="container">
              <h1 class="display-4">Tradepander Dashboard</h1>
              <p class="lead">Still under development</p>
            </div>
          </div>

          <div class="container">
            <h1 class="display-5">List of pending Withdrawals</h1>

            <table class="table mt-4">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">S/N</th>
                    <th scope="col">User ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Time Stamp</th>
                    <th scope="col">action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">1</th>
                    <td>1</td>
                    <td>John Snow</td>
                    <td>$15</td>
                    <td>2020-03-21-15:21</td>
                    <td>
                        <form action="">
                            <button id="process" type="submit" class="btn btn-primary">Process</button>
                        </form>
                    </td>
                  </tr>
                </tbody>
              </table>
          </div>
    </header>
    
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