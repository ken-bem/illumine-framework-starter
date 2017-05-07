<h2>Routing Details</h2>
<table class="widefat illumine-table-scrollable">
    <thead>
    <tr>
        <th class="row-title">
            Uri / Name
        </th>
        <th class="row-title">
            Protocol / Methods
        </th>
        <th class="row-title">
            Action / Middleware
        </th>
    </tr>
    </thead>
    <tbody>

    <?php $count = count($routes->getRoutes()); ?>
    <?php $__currentLoopData = $routes->getRoutes(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $route): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

        <?php if(!empty($route)): ?>
            <tr <?php if($count % 2 == 0): ?> class="alternate" <?php endif; ?>>

                <td>
                    <code><?php echo $route->uri(); ?></code><br>
                    <?php if(!empty($route->getName())): ?>
                        Name:<strong> <?php echo e($route->getName()); ?></strong>
                    <?php else: ?>
                        -
                    <?php endif; ?>
                </td>
                <td>
                    <strong><?php if($route->secure()): ?> HTTPS <?php else: ?> HTTP <?php endif; ?></strong><br>
                    <?php $__currentLoopData = $route->methods(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index =>  $method): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($index > 0): ?> | <?php endif; ?> <?php echo e($method); ?>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </td>
                <td>
                    <strong><?php echo e($route->getActionName()); ?></strong><br>
                    <?php $__currentLoopData = $route->middleware(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $middleware): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <?php if($index < (count($route->middleware()) - 1)): ?> &#9507; <?php else: ?> &#9495; <?php endif; ?> <?php echo e($middleware); ?>

                        <br/>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </td>
            </tr>
        <?php endif; ?>
        <?php  $count--; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>

