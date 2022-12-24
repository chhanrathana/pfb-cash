<div class="dropdown-menu dropdown-menu-right pt-0">
    <div class="dropdown-header bg-light py-2"><strong>កំណត់</strong></div>

    <a class="dropdown-item" href="<?php echo e(route('profile.index')); ?>">
        <span class="material-icons-outlined">account_circle</span>គណនី

    </a>

    <div class="dropdown-divider"></div>


    <a class="dropdown-item" href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <span class="material-icons-outlined">logout</span>
        ចាកចេញ
    </a>
    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
        <?php echo csrf_field(); ?>
    </form>
</div>
<?php /**PATH C:\Users\Developer\Documents\PFB CASH\Source Code\resources\views/layouts/profilebar.blade.php ENDPATH**/ ?>