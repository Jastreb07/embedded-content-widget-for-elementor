<?php
class Elementor_Embedded_Content_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'embedded_content_widget';
    }

    public function get_title() {
        return esc_html__( 'Embedded Content', 'embedded-content-widget-for-elementor' );
    }

    public function get_icon() {
        return 'eicon-form-horizontal';
    }

    public function get_categories() {
        return [ 'basic' ];
    }

    public function get_keywords() {
        return [ 'embedded', 'content' ];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_title',
            [
                'label' => esc_html__( 'General', 'embedded-content-widget-for-elementor' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'url',
            [
                'label' => esc_html__( 'Fetch-Url', 'embedded-content-widget-for-elementor' ),
                'description' => esc_html__( 'Your fetch-url must enable CORS allow. You can install WordPress plugin like "Enable CORS" on the fetch-url side.', 'embedded-content-widget-for-elementor' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'https://my-wordpress.com/post-name-or-id', 'embedded-content-widget-for-elementor' ),
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <iframe
                id="embedded-content-iframe"
                sandbox="allow-scripts allow-popups allow-same-origin"
                class="iframe"
                frameborder="0"
                height="auto"
                width="100%"
                src="<?php echo esc_url( $settings['url'] ); ?>"
                title="Embedded content"
                style="border: none; overflow: hidden; display: block;"
        ></iframe>
        <script>
            const embeddedIframe = document.getElementById('embedded-content-iframe');

            window.addEventListener('message', event => {
                const expectedOrigin = '<?php echo esc_url( $settings['url'] ); ?>';

                if (event.origin === new URL(expectedOrigin).origin) {
                    if (event.data?.fullUrl === expectedOrigin) {
                        const scrollHeight = event.data?.scrollHeight;
                        //const newLink = event.data?.newLink;

                        if (scrollHeight) {
                            embeddedIframe.style.height = (scrollHeight + 40) + 'px';
                            //console.log('My iframe height', embeddedIframe.style.height)
                        } else {
                            console.error('scrollHeight not found in message data.');
                        }

                        i/*f (newLink) {
                            //window.location.href = newLink;
                            console.log('My new nav link', newLink)
                        } else {
                            console.error('newLink not found in message data.');
                        }*/
                    }
                } else {
                    //console.warn('Received message from unexpected origin:', event.origin);
                }
            });
        </script>
        <?php
    }
}
