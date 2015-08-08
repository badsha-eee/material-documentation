<div class="box">
    <h2><?php echo $category->name; ?></h2>
        <?php
        $args = array(
            'hide_empty'       => false,
            'child_of'         => $category->term_id,
            'title_li'         => '',
            'show_option_none' => ''
        );
        echo '<ul class="child-cats">';
        wp_list_categories( $args );
        echo '</ul>';
        
        ?>
</div>