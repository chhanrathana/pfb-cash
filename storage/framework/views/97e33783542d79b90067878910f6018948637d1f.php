
<div class="c-subheader px-3">

    <ol class="breadcrumb border-0 m-0">
        <?php $__currentLoopData = $groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <?php $__currentLoopData = $group->menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menus): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <?php if( count($menus->childs) > 0 ): ?>

                    <?php
                        $menuUrl = str_replace("/*", "", $menus->active_url);
                    ?>

                    <?php if(request()->is($menus->active_url) || request()->is($menuUrl)): ?>
                        <li class="breadcrumb-item"><?php echo e($menus->label); ?></li>
                    <?php endif; ?>

                    <?php $__currentLoopData = $menus->childs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $childUrl = str_replace("/*", "", $child->active_url);
                        ?>

                        <?php if(request()->routeIs($child->url) || request()->is($childUrl)): ?>
                            <li class="breadcrumb-item"><?php echo e($child->label); ?></li>
                        <?php endif; ?>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <?php else: ?>
                    <?php if(request()->routeIs($menus->url)): ?>
                        <li class="breadcrumb-item"><?php echo e($menus->label); ?></li>
                    <?php endif; ?>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ol>

</div>
<?php /**PATH D:\OneDrive - Cyber Grow Solution Co., Ltd\Desktop\Loan\Source Code\resources\views/layouts/breadcrumb.blade.php ENDPATH**/ ?>