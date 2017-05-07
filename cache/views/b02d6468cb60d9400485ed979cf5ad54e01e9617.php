<h2>Cache Management</h2>

<table class="widefat">
    <thead>
    <tr>
        <th class="row-title">
            Storage Type
        </th>
        <th>
            Disk Usage
        </th>
        <th>
            Management
        </th>
    </tr>
    </thead>
    <tbody>
    <?php if($config->get('session.enabled')): ?>
        <tr>
            <td class="row-title">
                <label for="tablecell">
                    Session Storage
                </label>
            </td>
            <td>
                <?php echo $sizes['sessions']; ?>

            </td>
            <td>
                <a href="?page=<?php echo e(str_slug($config->get('namespace'))); ?>&tab=cache&_flush=sessions"
                   class="button-primary">Flush</a>
            </td>
        </tr>
    <?php endif; ?>
    <?php if($config->get('cache.enabled')): ?>
        <tr class="alternate">
            <td class="row-title">
                <label for="tablecell">
                    Object Cache
                </label>
            </td>
            <td>
                <?php echo $sizes['objects']; ?>

            </td>
            <td>
                <a href="?page=<?php echo e(str_slug($config->get('namespace'))); ?>&tab=cache&_flush=objects"
                   class="button-primary">Flush</a>
            </td>
        </tr>
    <?php endif; ?>
    <?php if($config->get('routes.enabled') && $config->get('routes.cache')): ?>
        <tr>
            <td class="row-title">
                <label for="tablecell">
                    Route Collection Cache
                </label>
            </td>
            <td>
                <?php echo $sizes['routes']; ?>

            </td>
            <td>
                <a href="?page=<?php echo e(str_slug($config->get('namespace'))); ?>&tab=cache&_flush=routes"
                   class="button-primary">Flush</a>
            </td>
        </tr>
    <?php endif; ?>
    <tr class="alternate">
        <td class="row-title">
            <label for="tablecell">
                Blade View Cache
            </label>
        </td>
        <td>
            <?php echo $sizes['views']; ?>

        </td>
        <td>
            <a href="?page=<?php echo e(str_slug($config->get('namespace'))); ?>&tab=cache&_flush=views" class="button-primary">Flush</a>
        </td>
    </tr>
    </tbody>
</table>

<p>
    <small>**Caches will regenerate themselves according to your configuration file.</small>
</p>



