<div class="card">
    <div class="card-header"><strong>ស្វែងរក-អតិថិជនចាស់</strong></div>
    <div class="card-body">
        <form action="<?php echo e($url); ?>" class="mt-2" id="frmSearch" method="GET">
            <div class="form-row">
                <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-1">
                    <input
                            class="form-control"
                            name="code"
                            type="text"
                            placeholder="កូដអតិថិជន"
                            value="<?php echo e(request('code')); ?>"
                            maxlength="50">
                </div>
                <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-1">
                    <input
                            class="form-control"
                            name="name_kh"
                            type="text"
                            placeholder="ឈ្មោះជាភាសាខ្មែរ"
                            value="<?php echo e(request('name_kh')); ?>"
                            maxlength="50">
                </div>
                <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-1">
                    <input
                            class="form-control"
                            name="name_en"
                            type="text"
                            placeholder="ឈ្មោះជាឡាតាំង"
                            value="<?php echo e(request('name_en')); ?>"
                            maxlength="50">
                </div>
                <div class="col-sm-12 col-md-2 col-lg-2 col-xl-2 mb-1">
                    <button type="submit" class="btn btn-primary mb-2">ស្វែងរក</button>
                    <a href="<?php echo e($url); ?>" class="btn btn-warning mb-2">សំអាត</a>
                </div>
            </div>
        </form>
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover table-sm">
                <thead>
                <tr>
                    <th class="text-center text-nowrap">កូដ</th>
                    <th class="text-center text-nowrap">ឈ្មោះជាភាសាខ្មែរ</th>
                    <th class="text-center text-nowrap">ឈ្មោះជាឡាតាំង</th>
                    <th class="text-center text-nowrap">ភេទ</th>
                    <th class="text-center text-nowrap">ចំនួនកម្ចី</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="text-center text-nowrap"><?php echo e($client->code??''); ?></td>
                        <td class="text-left text-nowrap"><?php echo e($client->name_kh??''); ?></td>
                        <td class="text-left text-nowrap"><?php echo e($client->name_en??''); ?></td>
                        <td class="text-center text-nowrap"><?php echo e($client->_sex->name??''); ?></td>
                        <td class="text-center text-nowrap"><span class="badge badge-info"><?php echo e($client->loans->count()); ?></span></td>
                        <td class="text-center text-nowrap">
                            <?php if($client->isHasActiveLoan() > 0): ?>
                                <b class="text-danger">មិនទាន់បង់ផ្ដាច់</b>
                            <?php else: ?>
                                <a class="btn btn-sm btn-primary"

                                   href=<?php echo e(url()->current().'?'.http_build_query(array_merge(request()->all(),['selected' => $client->id]))); ?>>
                                    <span class="material-icons-outlined">check_circle</span>
                                </a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php /**PATH /home2/kunpheap/public_html/resources/views/includes/search-client.blade.php ENDPATH**/ ?>