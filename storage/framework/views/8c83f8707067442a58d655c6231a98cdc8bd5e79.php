<ul class="c-sidebar-nav">
    <?php $__currentLoopData = $groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if( !$group->name == '' && count($group->menus) > 0 ): ?>
            <li class="c-sidebar-nav-title"><?php echo e($group->name ?? ''); ?></li>
        <?php endif; ?>
        <?php $__currentLoopData = $group->menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menus): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if( count($menus->childs) > 0 ): ?>
                <li class="c-sidebar-nav-item c-sidebar-nav-dropdown <?php echo e((request()->is( $menus->active_url )) ? 'c-show' : ''); ?>">
                    <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
                        <span class="material-icons mr-3"><?php echo e($menus->icon); ?></span>
                        <?php echo e($menus->label); ?>

                    </a>
                    <ul class="c-sidebar-nav-dropdown-items">
                        <?php $__currentLoopData = $menus->childs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="c-sidebar-nav-item">
                                <a class="c-sidebar-nav-link <?php echo e((request()->is($child->active_url)) ? 'c-active' : ''); ?>" href="<?php echo e($child->url ? route($child->url) : '#'); ?>">
                                    <span class="c-sidebar-nav-icon"></span><?php echo e($child->label); ?>

                                </a>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </li>
            <?php else: ?>
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link" href="<?php echo e($menus->url ? route( $menus->url ) : '#'); ?>">
                        <span class="material-icons mr-3"><?php echo e($menus->icon); ?></span>
                        <?php echo e($menus ->label); ?>

                    </a>
                </li>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</ul><?php /**PATH /home2/kunpheap/public_html/resources/views/layouts/sidebar.blade.php ENDPATH**/ ?>