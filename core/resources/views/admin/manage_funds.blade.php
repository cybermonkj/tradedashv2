<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<style>
    .container__table {
        margin-right: 20%;
    }
</style>

@extends('admin.atlantis.layout')
@Section('content')
    <div class="content container">
        <div class="container__table">
            <div class="card m-12 p-4">
                <table class="table table-hover table-bordered">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col">S/N</th>
                        <th scope="col">User ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Username</th>
                        <th scope="col">Wallet</th>
                        <th scope="col">Packages</th>
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
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
@endSection