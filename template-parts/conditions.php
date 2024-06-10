<?php if ( have_rows( 'conditions', 'option' ) ) : ?>
    <div class="conditions">
        <?php
        while ( have_rows( 'conditions', 'option' ) ) :
            the_row();
                $title = get_sub_field( 'title' );
            ?>

            <div class="conditions__block">
                
                <?php if ( $title ) : ?>
                    <span class="conditions__title">
                        <?php echo wp_kses_post( $title ); ?>
                    </span>
                <?php endif; ?>

                <?php if ( have_rows( 'list' ) ) : ?>
                    <div class="conditions__list">

                        <?php
                        while ( have_rows( 'list' ) ) :
                            the_row();
                            $image = get_sub_field( 'image' );
                            ?>
                            <?php if ( $image ) : ?>
                                <div class="conditions__img">
                                    <?php echo wp_get_attachment_image( $image, 'medium' ); ?>
                                </div>
                            <?php endif; ?>
                            
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>
            </div>

        <?php endwhile; ?>
    </div>
<?php endif; ?>