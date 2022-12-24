<?php $__env->startSection('content'); ?>  

    <div class="card">
        <div class="card-header">            
            <form action="<?php echo e(route('dashboard')); ?>" class="mt-2" id="frmSearch" method="GET">
                <div class="form-row">
                    <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-1">
                        <select class="form-control select2" name="branch_id" >
                            <option value="" disabled selected>[-- សាខា --]</option>
                            <option value="all" <?php echo e(request('branch_id') == 'all'?'selected':''); ?>>ទាំងអស់</option>
                            <?php $__currentLoopData = $branches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($branch->id); ?>" <?php echo e(request('branch_id') == $branch->id?'selected':''); ?>><?php echo e($branch->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                                                
                    <div class="col-sm-12 col-md-2 col-lg-2 col-xl-2 mb-1">
                        <button type="submit" class="btn btn-primary mb-2">ស្វែងរក</button>
                        <a href="<?php echo e(route('dashboard')); ?>" class="btn btn-warning mb-2">សំអាត</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
        <div class="row justify-content-center">
          <div class="col-12">
            <div class="card">
              <div class="card-body p-0">
                <div class="table-responsive table-scroll" data-mdb-perfect-scrollbar="true" style="position: relative; height: 50px">
                  <table class="table table-striped mb-0">
                    <thead style="background-color: #002d72; color:white">
                      <tr>
                        <th scope="col">ប្រភេទកម្ចី</th>
                        <th scope="col">ចំនួនទឹកប្រាក់</th>
                        <th scope="col">អតិថិជន</th>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
    
    <?php
        $totalClients = 0;
        $totalPrincipal = 0;
    ?>

    <?php $__currentLoopData = $interests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $interest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $totalClients = $totalClients + $interest->count;
                $totalPrincipal = $totalPrincipal + $interest->principal_amount;
            ?>
            <div class="table-sresponsive table-scroll" >
                  <table class="table table-striped " >
                    <thead style="color: #002d72;">
                      <tr>
                        <th scope="col" style="width:360px"><?php echo e($interest->name); ?></th>
                        <th scope="col" ><?php echo e(number_format($interest->principal_amount)); ?> រៀល</th>
                        <th scope="col" style="" ><?php echo e(number_format($interest->count)); ?> នាក់</th>
                      </tr>
                    </tbody>
                  </table>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <div class="table-responsive table-scroll"   >
                  <table class="table table-striped ">
                    <thead style="color: #002d72;">
                      <tr>
                        <th scope="col"style="width:360px" >សរុបកម្ចីទាំងអស់</th>
                        <th scope="col" ><?php echo e(number_format($totalPrincipal)); ?>រៀល</th>
                        <th scope="col" ><?php echo e(number_format($totalClients)); ?> នាក់</th>
                      </tr>
                    </tbody>
                  </table>
                </div>
        </div>
      </div>
    </div>
    <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\OneDrive - Cyber Grow Solution Co., Ltd\Desktop\Loan\Source Code\resources\views/dashboards/index.blade.php ENDPATH**/ ?>