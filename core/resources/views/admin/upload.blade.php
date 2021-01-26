@extends('admin.atlantis.layout')
@section('content')
    <style>
        .drop-zone {
            width: 40%;
            height: 300px;
            border: 2px dashed #2196f3;
            position: relative;
        }

        .drop-zone__input {
            width: 100%;
            height: 100%;
            border: 1px solid red;
            opacity: 0;
        }


        .drop-zone__copy::before {
            position: absolute;
            top: 50%;
            left: 50%;
            
            content: attr(data-text);
            display: grid;
            place-content: center;

            font-weight: 600;
            color: #78909C !important;
        }

        @media screen and (max-width: 420px) {
            .drop-zone {
                width: 100%;
                height: 200px;
            }
        }
    </style>
    <div class="main-panel">
        <div class="content">
            <div class="container">
                <div class="row align-items-start">
                    <div class="p-4">
                        <h1 class="text-uppercase display-5 fw-bold">Import coupon codes</h1>
                    </div>

                    <div class="p-4 m-4 shadow card" style="width: 80% !important">
                        <form class="form" action="{{ route('upload.codes') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="drop-zone">
                                <input type="file" name="myFile" id="myFile" class="drop-zone__input">
                                <div data-text="Drop file or click to upload" class="drop-zone__copy"></div>
                            </div>
                            <input type="submit" value="Send File" class="btn btn-info">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection