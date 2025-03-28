<?php
/*
Plugin Name: Quick Chat Button
Description: Hiển thị nút chat cố định với Messenger và Zalo trên trang web.
Version: 1.1
Author: Phạm Đăng Khuê
*/

if (!defined('ABSPATH')) {
    exit; // Ngăn truy cập trực tiếp
}

// Đăng ký shortcode
add_shortcode('quick_chat', 'qcb_display_chat_button');

// Hàm hiển thị nút chat nhanh
function qcb_display_chat_button($atts) {
    $atts = shortcode_atts([
        'zalo_link' => get_option('qcb_zalo_link', 'https://zalo.me/0867758620'),
        'messenger_link' => get_option('qcb_messenger_link', 'https://www.messenger.com/t/100050586190786'),
        'zalo_text' => get_option('qcb_zalo_text', 'Zalo'),
        'messenger_text' => get_option('qcb_messenger_text', 'Messenger'),
        'zalo_color' => get_option('qcb_zalo_color', '#ffffff'),
        'messenger_color' => get_option('qcb_messenger_color', '#ffffff'),
        'text_color' => get_option('qcb_text_color', '#ffffff'),
        'show_zalo' => get_option('qcb_show_zalo', 'yes'),
        'show_messenger' => get_option('qcb_show_messenger', 'yes'),
    ], $atts);

    $plugin_url = plugin_dir_url(__FILE__) . 'assets/';

    $html = '<div class="quick-chat-buttons">';

    if ($atts['show_zalo'] === 'yes') {
        $html .= '<a href="' . esc_url($atts['zalo_link']) . '" target="_blank" class="quick-chat-link zalo" 
                    style="background-color: ' . esc_attr($atts['zalo_color']) . '; color: ' . esc_attr($atts['text_color']) . ';">
            <img src="' . esc_url($plugin_url . 'zalo_icon.png') . '" alt="Zalo" class="quick-chat-icon"> 
            ' . esc_html($atts['zalo_text']) . '
        </a>';
    }

    if ($atts['show_messenger'] === 'yes') {
        $html .= '<a href="' . esc_url($atts['messenger_link']) . '" target="_blank" class="quick-chat-link messenger" 
                    style="background-color: ' . esc_attr($atts['messenger_color']) . '; color: ' . esc_attr($atts['text_color']) . ';">
            <img src="' . esc_url($plugin_url . 'messenger_icon.png') . '" alt="Messenger" class="quick-chat-icon"> 
            ' . esc_html($atts['messenger_text']) . '
        </a>';
    }

    $html .= '</div>';
    return $html;
}



// Đăng ký Font Awesome
add_action('wp_enqueue_scripts', 'qcb_enqueue_font_awesome');
function qcb_enqueue_font_awesome() {
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css');
}

// Đăng ký CSS cho nút chat
add_action('wp_enqueue_scripts', 'qcb_enqueue_styles');
function qcb_enqueue_styles() {
    $custom_css = "
        .quick-chat-buttons {
            position: fixed;
            bottom: 20px;
            right: 20px;
            display: flex;
            flex-direction: column;
            gap: 10px;
            z-index: 1000;
        }
        .quick-chat-link {
            display: flex;
            align-items: center;
            
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 50px;
            font-size: 16px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease;
        }
        .quick-chat-link:hover {
            opacity: 0.8;
        }
        .quick-chat-icon {
            width: 30px;
            height: 30px;
            margin-right: 10px;
            object-fit: contain; /* Đảm bảo không bị méo ảnh */
        }
    ";

    wp_register_style('qcb-inline-styles', false);
    wp_enqueue_style('qcb-inline-styles');
    wp_add_inline_style('qcb-inline-styles', $custom_css);
}

// Thêm menu cài đặt vào WordPress Admin
add_action('admin_menu', 'qcb_add_settings_menu');
function qcb_add_settings_menu() {
    add_menu_page(
        'Quick Chat Settings',
        'Quick Chat',
        'manage_options',
        'quick-chat-settings',
        'qcb_settings_page',
        'dashicons-format-chat',
        100
    );
}

// Hàm hiển thị nội dung trang cài đặt
function qcb_settings_page() {
    ?>
    <div class="wrap">
        <h1>Cài đặt Nút Chat</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('qcb_settings_group');
            do_settings_sections('quick-chat-settings');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

// Đăng ký cài đặt
add_action('admin_init', 'qcb_register_settings');
function qcb_register_settings() {
    register_setting('qcb_settings_group', 'qcb_zalo_link');
    register_setting('qcb_settings_group', 'qcb_messenger_link');
    register_setting('qcb_settings_group', 'qcb_bg_color');
    register_setting('qcb_settings_group', 'qcb_text_color');
    register_setting('qcb_settings_group', 'qcb_show_zalo');
    register_setting('qcb_settings_group', 'qcb_show_messenger');

    add_settings_section(
        'qcb_settings_section',
        'Cấu hình Nút Chat',
        function() { echo '<p>Cấu hình hiển thị nút chat Messenger và Zalo.</p>'; },
        'quick-chat-settings'
    );

    add_settings_field('qcb_zalo_link', 'Link Zalo', function() {
        echo '<input type="text" name="qcb_zalo_link" value="' . esc_attr(get_option('qcb_zalo_link', 'https://zalo.me/0867758620')) . '" class="regular-text">';
    }, 'quick-chat-settings', 'qcb_settings_section');

    add_settings_field('qcb_messenger_link', 'Link Messenger', function() {
        echo '<input type="text" name="qcb_messenger_link" value="' . esc_attr(get_option('qcb_messenger_link', 'https://www.messenger.com/t/100050586190786')) . '" class="regular-text">';
    }, 'quick-chat-settings', 'qcb_settings_section');

    add_settings_field('qcb_text_color', 'Màu chữ', function() {
        echo '<input type="color" name="qcb_text_color" value="' . esc_attr(get_option('qcb_text_color', '#ffffff')) . '">';
    }, 'quick-chat-settings', 'qcb_settings_section');

    add_settings_field('qcb_show_zalo', 'Hiển thị Zalo', function() {
        $checked = get_option('qcb_show_zalo', 'yes') === 'yes' ? 'checked' : '';
        echo '<input type="checkbox" name="qcb_show_zalo" value="yes" ' . $checked . '> Bật';
    }, 'quick-chat-settings', 'qcb_settings_section');
    
    add_settings_field('qcb_show_messenger', 'Hiển thị Messenger', function() {
        $checked = get_option('qcb_show_messenger', 'yes') === 'yes' ? 'checked' : '';
        echo '<input type="checkbox" name="qcb_show_messenger" value="yes" ' . $checked . '> Bật';
    }, 'quick-chat-settings', 'qcb_settings_section');

    add_settings_field('qcb_zalo_text', 'Nội dung nút Zalo', function() {
        echo '<input type="text" name="qcb_zalo_text" value="' . esc_attr(get_option('qcb_zalo_text', 'Zalo')) . '" class="regular-text">';
    }, 'quick-chat-settings', 'qcb_settings_section');
    
    add_settings_field('qcb_messenger_text', 'Nội dung nút Messenger', function() {
        echo '<input type="text" name="qcb_messenger_text" value="' . esc_attr(get_option('qcb_messenger_text', 'Messenger')) . '" class="regular-text">';
    }, 'quick-chat-settings', 'qcb_settings_section');
    
    add_settings_field('qcb_zalo_color', 'Màu nền nút Zalo', function() {
        echo '<input type="color" name="qcb_zalo_color" value="' . esc_attr(get_option('qcb_zalo_color', '#007AFF')) . '">';
    }, 'quick-chat-settings', 'qcb_settings_section');
    
    add_settings_field('qcb_messenger_color', 'Màu nền nút Messenger', function() {
        echo '<input type="color" name="qcb_messenger_color" value="' . esc_attr(get_option('qcb_messenger_color', '#0084FF')) . '">';
    }, 'quick-chat-settings', 'qcb_settings_section');
    
    register_setting('qcb_settings_group', 'qcb_zalo_text');
    register_setting('qcb_settings_group', 'qcb_messenger_text');
    register_setting('qcb_settings_group', 'qcb_zalo_color');
    register_setting('qcb_settings_group', 'qcb_messenger_color');
    
    
}
// Tự động chèn shortcode [quick_chat] vào cuối mỗi bài viết
add_filter('the_content', 'qcb_append_chat_button');

function qcb_append_chat_button($content) {
    if (is_single() && in_the_loop() && is_main_query()) {
        $content .= do_shortcode('[quick_chat]');
    }
    return $content;
}
