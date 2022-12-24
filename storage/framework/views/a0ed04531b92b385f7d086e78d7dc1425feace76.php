<?php $__env->startSection('title','គណនី'); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.css" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <strong>គណនី</strong>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12 col-md-3">
                    <img src="<?php echo e(asset('storage/'.$user->avatar)); ?>" class="img-thumbnail" alt="avatar" draggable="false" width="100%">
                    <h4 class="text-center mt-2 text-success"><b><?php echo e($user->name); ?></b></h4>
                    <h6 class="text-center mt-2 text-primary"><b><?php echo e($user->type->name??''); ?></b></h6>
                    
                   <div class="text-center mt-2 mb-2">
                       <button type="button" class="btn btn-primary my-2" onclick="$('#file').click()">
                           <span class="material-icons-outlined">add_a_photo</span>
                           ប្តូររូបតំណាង
                       </button>
                       <input type="file" name="file" id="file" class="d-none" accept="image/*" />
                   </div>
                </div>
                <div class="col-sm-12 col-md-9">
                    <table class="table table-bordered table-striped table-hover" id ="table">
                        <tbody>
                        <tr>
                            <td><b>គណនី</b></td>
                            <td><b class="float-right"><?php echo e($user->email ?? ''); ?></b></td>
                        </tr>

                        <tr>
                            <td><b>ឈ្មោះ</b></td>
                            <td><b class="float-right"><?php echo e($user->name ?? ''); ?></b></td>
                        </tr>
                        <tr>
                            <td><b>តួនាទីអ្នកប្រើប្រាស់</b></td>
                            <td><b class="float-right"><?php echo e($user->type->name??''); ?></b></td>
                        </tr>                       
                        </tbody>
                    </table>
                    
                    <a href="<?php echo e(route('profile.edit',['id' =>  auth()->user()->id])); ?>" class="btn btn-outline-primary float-right" id="btn-crop-avatar">
                        <span class="material-icons-outlined">edit</span>
                        កែប្រែ
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Vertically centered modal -->
    <div class="modal" tabindex="-1" id="modal-crop" style="width:100vw">
        <div class="modal-dialog  modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">តម្រឹមរូបភាព</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <div id="image_demo"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">បោះបង់</button>
                    <button type="button" class="btn btn-primary" onclick="handleCrop()" id="btn-crop-avatar">រួចរាល់</button>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.js"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var image_crop = $('#image_demo').croppie({
            viewport: {
                width: 300,
                height: 300,
                type:'square'
            },
            boundary:{
                width: 320,
                height: 320
            }
        });
        /// catching up the cover_image change event aand binding the image into my croppie. Then show the modal.
        $('#file').on('change', function(){
            var reader = new FileReader();
            reader.onload = function (event) {
                image_crop.croppie('bind', {
                    url: event.target.result,
                });
            }
            reader.readAsDataURL(this.files[0]);
            $('#modal-crop').modal('show');
        });
       function handleCrop(){
           // CLOSE MODAL IF NOT CHANGE IMAGE
           if ($('body #file').get(0).files.length === 0) {
               $('body #modal-crop').modal('close');
               return;
           }
           image_crop.croppie('result', {
               type: 'canvas',
               size: 'viewport'
           }).then(function(response){
               $('body .img-thumbnail').attr('src',response);
               $('body #modal-crop').modal('hide');
               $.ajax({
                   url : "<?php echo e(route('profile.store')); ?>",
                   type: "POST",
                   data : { file : response },
                   success : function () {
                       $('body').find("#userAvatar").attr('src',response);
                   }
               });
           })
       }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/kunpheap/public_html/resources/views/auth/profiles/index.blade.php ENDPATH**/ ?>