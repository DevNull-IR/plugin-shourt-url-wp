<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://www.wplauncher.com
 * @since      1.0.0
 *
 * @package    Settings_Page
 * @subpackage Settings_Page/admin/partials
 */
include 'headers.php';
?>
<div class="wrap" style="margin-top:65px;">
    <table id="myTable" class="display">
        <thead>
        <tr>
            <th><?php echo __('Long URL', 'wp-f1r') ?></th>
            <th style="width: 200px"><?php echo __('Short URL', 'wp-f1r') ?></th><br>
            <!-- <th style="width: 200px"><?php echo __('Actions', 'wp-f1r') ?></th> -->
        </tr>
        </thead>
        
            <?php
            global $wpdb;
            // $post = get_post();
            $check = $wpdb->get_results("select * from {$wpdb->base_prefix}f1r_shourter");
            // var_dump($check[0]->postURL);
            // echo count($check);
            foreach($check as $key => $value){
                // var_dump($value);
            ?>
            <tbody>
            <th><?= substr($value->postURL,0,80) ?></th>
            <th><?= $value->shourter ?></th>
            </tbody>
            <?php } ?>
            <!-- <th></th> -->
        <!-- </tbody> -->
    </table>
</div>
<!-- This file should primarily consist of HTML with a little bit of PHP. -->
