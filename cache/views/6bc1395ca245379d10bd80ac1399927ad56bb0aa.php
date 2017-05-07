<script type="text/javascript">
    jQuery(document).ready(function ($) {
        $('.<?php echo e($namespace.'_dev_flush_sessions'); ?>').click(function (e) {
            e.preventDefault();
            $.post('<?php echo e(admin_url('admin-ajax.php')); ?>', {
                'action': '<?php echo e($namespace.'_dev'); ?>',
                '_flush': 'sessions'
            }, function (response) {
                alert(response);
            });
        });
        $('.<?php echo e($namespace.'_dev_flush_objects'); ?>').click(function (e) {
            e.preventDefault();
            $.post('<?php echo e(admin_url('admin-ajax.php')); ?>', {
                'action': '<?php echo e($namespace.'_dev'); ?>',
                '_flush': 'objects'
            }, function (response) {
                alert(response);
            });
        });
        $('.<?php echo e($namespace.'_dev_flush_routes'); ?>').click(function (e) {
            e.preventDefault();
            $.post('<?php echo e(admin_url('admin-ajax.php')); ?>', {
                'action': '<?php echo e($namespace.'_dev'); ?>',
                '_flush': 'routes'
            }, function (response) {
                alert(response);
            });
        });
        $('.<?php echo e($namespace.'_dev_flush_views'); ?>').click(function (e) {
            e.preventDefault();
            $.post('<?php echo e(admin_url('admin-ajax.php')); ?>', {
                'action': '<?php echo e($namespace.'_dev'); ?>',
                '_flush': 'views'
            }, function (response) {
                alert(response);
            });
        });

    });
</script>