<?php
// Popular Recipes Post Meta
function ngo_fundraiser_bn_custom_meta_feature() {
    add_meta_box('bn_meta', __('Custom fields for Popular Causes', 'ngo-fundraiser'), 'ngo_fundraiser_meta_callback_feature', 'post', 'normal', 'high');
}

if (is_admin()) {
    add_action('admin_menu', 'ngo_fundraiser_bn_custom_meta_feature');
}

function ngo_fundraiser_meta_callback_feature($post) {
    wp_nonce_field(basename(__FILE__), 'ngo_fundraiser_feature_meta_nonce');
    $bn_stored_meta = get_post_meta($post->ID);
    $ngo_fundraiser_popular_raised_amount = get_post_meta($post->ID, 'ngo_fundraiser_popular_raised_amount', true);
    $ngo_fundraiser_popular_goal_amount = get_post_meta($post->ID, 'ngo_fundraiser_popular_goal_amount', true);
    ?>
    <div id="feature">
        <table id="list">
            <tbody id="the-list" data-wp-lists="list:meta">
                <tr id="meta-1">
                    <td class="left">
                        <?php esc_html_e('Raised Amount ', 'ngo-fundraiser') ?>
                    </td>
                    <td class="left">
                        <input type="text" name="ngo_fundraiser_popular_raised_amount" id="ngo_fundraiser_popular_raised_amount" value="<?php echo esc_attr($ngo_fundraiser_popular_raised_amount); ?>" />
                    </td>
                </tr>
                <tr id="meta-2">
                    <td class="left">
                        <?php esc_html_e('Goal Amount', 'ngo-fundraiser') ?>
                    </td>
                    <td class="left">
                        <input type="text" name="ngo_fundraiser_popular_goal_amount" id="ngo_fundraiser_popular_goal_amount" value="<?php echo esc_attr($ngo_fundraiser_popular_goal_amount); ?>" />
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <?php
}

/* Saves the custom meta input */
function ngo_fundraiser_bn_metadesig_save($post_id)
{
    if (!isset($_POST['ngo_fundraiser_feature_meta_nonce']) || !wp_verify_nonce(strip_tags(wp_unslash($_POST['ngo_fundraiser_feature_meta_nonce'])), basename(__FILE__))) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Save
    if (isset($_POST['ngo_fundraiser_popular_raised_amount'])) {
        update_post_meta($post_id, 'ngo_fundraiser_popular_raised_amount', strip_tags(wp_unslash($_POST['ngo_fundraiser_popular_raised_amount'])));
    }

    // Save
    if (isset($_POST['ngo_fundraiser_popular_goal_amount'])) {
        update_post_meta($post_id, 'ngo_fundraiser_popular_goal_amount', strip_tags(wp_unslash($_POST['ngo_fundraiser_popular_goal_amount'])));
    }
}
add_action('save_post', 'ngo_fundraiser_bn_metadesig_save');
