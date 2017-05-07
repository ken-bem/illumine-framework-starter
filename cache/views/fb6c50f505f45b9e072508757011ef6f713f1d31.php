<?php if(isset($alertMessage) || isset($messages)): ?>
    <div class="notice notice-<?php echo e((isset($alertClass) ? $alertClass : 'info')); ?> is-dismissible">
        <?php if(count($messages) > 0): ?>
            <ul style="text-align: left;">
                <?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($message); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        <?php endif; ?>
        <button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span>
        </button>
    </div>
<?php endif; ?>