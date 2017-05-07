<?php $__env->startSection('content'); ?>

    <h2 class="nav-tab-wrapper">
        <a href="?page=<?php echo e($request->get('page')); ?>&tab=docs"
           class="nav-tab <?php if(!$request->has('tab') || $request->get('tab') == 'docs'): ?> nav-tab-active <?php endif; ?>">Documentation</a>
        <a href="?page=<?php echo e($request->get('page')); ?>&tab=config"
           class="nav-tab <?php if($request->get('tab') == 'config'): ?> nav-tab-active <?php endif; ?>">Config</a>
        <?php if($config->get('routes.enabled')): ?><a href="?page=<?php echo e($request->get('page')); ?>&tab=routes"
                                              class="nav-tab <?php if($request->get('tab') == 'routes'): ?> nav-tab-active <?php endif; ?>">Routes</a><?php endif; ?>
        <a href="?page=<?php echo e($request->get('page')); ?>&tab=cache"
           class="nav-tab <?php if($request->get('tab') == 'cache'): ?> nav-tab-active <?php endif; ?>">Cache</a>
    </h2>
    <div id="poststuff">
        <?php echo $__env->make('admin.framework.parts.alert', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->make('admin.framework.tabs.'.($request->get('tab') ? $request->get('tab') : 'docs'), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <br class="clear">
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.framework.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>