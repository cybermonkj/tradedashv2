@extends('admin.atlantis.layout')
@section('content')
    <div class="main-panel">
        <div class="content">
            <div class="container">
                <div class="row align-items-start">
                    <div class="p-4">
                        <h1 class="text-uppercase display-5 fw-bold">Import coupon codes</h1>
                    </div>

                    <div class="p-4 shadow card" style="width: 100% !important">
                        <form class="dropzone" action="{{ route('upload.codes') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="fallback">
                                <input type="file" name="couponFile" id="couponFile" />
                                <input class="btn btn-info" type="submit" value="Send File" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection