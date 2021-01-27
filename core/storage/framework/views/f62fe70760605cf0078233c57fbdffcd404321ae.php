<?php $__env->startSection('content'); ?>
    <style>
        .drop-zone {
            width: 40%;
            height: 300px;
            border: 2px dashed #2196f3;
            position: relative;
            overflow: hidden;
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
            left: 30%;
            
            content: attr(data-text);
            display: grid;
            place-content: center;

            font-weight: 600;
            color: #78909C !important;
        }

        @media  screen and (max-width: 420px) {
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

                    <div class="p-4 m-4 shadow card" style="width: 100% !important">
                        <form class="form" action="<?php echo e(route('upload.codes')); ?>" method="POST" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="drop-zone">
                                <input type="file" name="myFile" id="myFile" class="drop-zone__input">
                                <div data-text="Drop file or click to upload" class="drop-zone__copy"></div>
                            </div>
                            <input type="submit" value="Import Coupons" class="my-4 btn btn-info">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.atlantis.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/v2.tradepander.com/public_html/core/resources/views/admin/upload.blade.php ENDPATH**/ ?>