<?php

class custom_ads extends khafagy_widget {
        //frontend Args
      function frontend($args, $instance) {
          extract($args, EXTR_SKIP);
          echo $before_widget;

          if ( !empty( $instance['thecode'] ) ) {
            echo $instance['thecode'];
          } elseif( !empty( $instance['ads_image'] )  ) {
            $image_src = wp_get_attachment_image_src( $instance['ads_image'], 'full' );
            $link_start = $instance['link'] ? '<a href="'.check_link( $instance['link'] ).'" target="_blank">' : '';
            $link_end = $instance['link'] ? '</a>' : '';
            echo $link_start.'<img src="'. $image_src[0] .'" />'.$link_end;
          }
          echo $after_widget;
        }
        //WIDGET Admin Form
        function backend() {
          // widget settings
          $args['widget_name'] = 'بلوك اعلاني';
          $args['description'] = '';
          $args['extra_class'] = 'banner';

          //widget options
          $args['options'][] = array(
            'label' => 'الصورة',
            'name' => 'ads_image',
            'type' => 'upload'
          );
          $args['options'][] = array(
            'label' => 'رابط الأعلان',
            'name' => 'link',
            'type' => 'input'
          );
          $args['options'][] = array(
            'label' => 'كود الأعلان - مثل اعلانات جوجل',
            'name' => 'thecode',
            'type' => 'textarea'
          );

          return $args;
       }
}
add_action( 'widgets_init', create_function('', 'return register_widget("custom_ads");') );
