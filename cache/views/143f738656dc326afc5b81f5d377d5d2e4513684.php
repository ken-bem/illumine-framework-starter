<h2>Configuration Details</h2>
<table class="widefat">
    <thead>
    <tr>
        <th class="row-title">
            Key
        </th>
        <th>
            Value(s)
        </th>
    </tr>
    </thead>
    <tbody>
    <?php  $count = count($config->all());  ?>

    <?php $__currentLoopData = $config->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $items): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if(count($items)): ?>
            <tr <?php if($count % 2 == 0): ?> class="alternate" <?php endif; ?>>

                <td class="row-title">
                    <label for="tablecell">
                        <?php echo e($key); ?>

                    </label>
                </td>
                <td>
                    <?php if(is_array($items)  || $key == 'view'): ?>
                        <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key2 => $items2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if(is_array($items2)): ?>

                                <?php if($key2 != 'lottery'): ?>

                                    <strong><?php echo e($key2); ?>: </strong><br/>
                                    <?php $__currentLoopData = $items2; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key3 => $items3): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                        <?php if(is_array($items3)): ?>

                                            &nbsp;&nbsp;&nbsp;<strong><?php echo e($key3); ?>: </strong><br/>

                                            <?php 
                                                $index = 0; //Set Index
                                             ?>

                                            <?php $__currentLoopData = $items3; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key4 => $items4): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                <?php if(!is_null($items4)): ?>
                                                    &nbsp;&nbsp;&nbsp; <?php if($index < (count($items4))): ?> &#9507; <?php else: ?>
                                                        &#9495; <?php endif; ?> <strong><?php echo e($key4); ?>: </strong> <?php echo e($items4); ?><br/>
                                                <?php endif; ?>

                                                <?php 
                                                    $index++; //Increment
                                                 ?>

                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php elseif(is_bool($items3)): ?>
                                            <strong><?php echo e($key3); ?>: </strong>
                                            <?php echo e(var_export($items3, true)); ?>

                                        <?php elseif(!is_null($items3)): ?>
                                            <strong><?php echo e($key3); ?>: </strong>
                                            <?php echo e($items3); ?><br/>
                                        <?php endif; ?>

                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                    <strong><?php echo e($key2); ?>: </strong>
                                    <?php echo e($items2[0]); ?> ~ <?php echo e($items2[1]); ?> <br/>
                                <?php endif; ?>


                            <?php elseif(is_bool($items2)): ?>
                                <strong><?php echo e($key2); ?>: </strong>
                                <?php echo e(var_export($items2, true)); ?> <br/>
                            <?php elseif(!is_null($items2)): ?>
                                <strong><?php echo e($key2); ?>: </strong>
                                <?php echo e($items2); ?><br/>
                            <?php endif; ?>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <?php elseif(is_bool($items)): ?>
                        <?php echo e(var_export($items, true)); ?>

                    <?php else: ?>
                        <?php echo e($items); ?>

                    <?php endif; ?>
                </td>
            </tr>
        <?php endif; ?>
        <?php 
            $count--;
         ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>


