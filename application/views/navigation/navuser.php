<ul class="list">
    <li class="header">MAIN NAVIGATION</li>
        <li <?php echo isset($menu_1) ? 'class="active"' : ''; ?>>
            <a href="<?php echo site_url('media/home'); ?>">
                <i class="material-icons">Home</i>
                <span>Home</span>
            </a>
        </li>
        <li <?php echo isset($menu_2) ? 'class="active"' : ''; ?>>
            <a href="<?php echo site_url('media'); ?>">
                <i class="material-icons">Group</i>
                <span>Group</span>
            </a>
        </li>
        <li <?php echo isset($menu_3) ? 'class="active"' : ''; ?>>
            <a href="pages/helper-classes.html">
                <i class="material-icons">Event</i>
                <span>Event</span>
            </a>
        </li>
</ul>