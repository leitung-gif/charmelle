<?php
/**
 * TWINT als eigene WooCommerce-Zahlungsart.
 *
 * Die Zahlung läuft manuell: die Kundschaft sendet den Betrag per TWINT an die
 * Studio-Nummer, die Bestellung bleibt auf «In Wartestellung», bis der
 * Zahlungseingang geprüft und die Bestellung von Hand freigegeben wird.
 *
 * Diese Datei wird bewusst erst innerhalb des Filters
 * «woocommerce_payment_gateways» geladen — dort ist WC_Payment_Gateway sicher
 * vorhanden. Ein Hook auf plugins_loaded funktioniert im Theme nicht, weil
 * dieser bereits durch ist, wenn WordPress die functions.php einliest.
 *
 * @package Charmelle
 */

defined( 'ABSPATH' ) || exit;

class Charmelle_Gateway_TWINT extends WC_Payment_Gateway {

    /** @var string Anweisung für Danke-Seite und E-Mail. */
    public $instructions;

    /** @var string Handynummer, an die per TWINT gezahlt wird. */
    public $twint_number;

    public function __construct() {
        $this->id                 = 'charmelle_twint';
        $this->has_fields         = false;
        $this->method_title       = 'TWINT';
        $this->method_description = 'Die Kundschaft sendet den Betrag per TWINT an die hinterlegte Handynummer. Die Bestellung bleibt auf «In Wartestellung», bis Sie den Zahlungseingang geprüft und die Bestellung auf «In Bearbeitung» gesetzt haben.';

        $this->init_form_fields();
        $this->init_settings();

        $this->title        = $this->get_option( 'title' );
        $this->description  = $this->get_option( 'description' );
        $this->instructions = $this->get_option( 'instructions' );
        $this->twint_number = $this->get_option( 'twint_number' );

        add_action( 'woocommerce_update_options_payment_gateways_' . $this->id, array( $this, 'process_admin_options' ) );
        add_action( 'woocommerce_thankyou_' . $this->id, array( $this, 'thankyou_page' ) );
        add_action( 'woocommerce_email_before_order_table', array( $this, 'email_instructions' ), 10, 3 );
    }

    public function init_form_fields() {
        $this->form_fields = array(
            'enabled' => array(
                'title'   => 'Aktivieren',
                'type'    => 'checkbox',
                'label'   => 'TWINT im Checkout anbieten',
                'default' => 'yes',
            ),
            'title' => array(
                'title'       => 'Bezeichnung im Checkout',
                'type'        => 'text',
                'description' => 'Der Name, den die Kundschaft beim Bezahlen sieht.',
                'default'     => 'TWINT',
                'desc_tip'    => true,
            ),
            'twint_number' => array(
                'title'       => 'TWINT-Handynummer',
                'type'        => 'text',
                'description' => 'An diese Nummer wird der Betrag per TWINT gesendet.',
                'default'     => function_exists( 'charmelle_twint_number' ) ? charmelle_twint_number() : '+41 79 828 66 47',
                'desc_tip'    => true,
            ),
            'description' => array(
                'title'       => 'Beschreibung im Checkout',
                'type'        => 'textarea',
                'description' => 'Text unter der Auswahl «TWINT». {nummer} wird durch die Handynummer ersetzt.',
                'default'     => 'Senden Sie den Betrag per TWINT an {nummer} und geben Sie im Mitteilungsfeld Ihre Bestellnummer an. Wir bearbeiten Ihre Bestellung, sobald die Zahlung eingegangen ist.',
                'desc_tip'    => true,
            ),
            'instructions' => array(
                'title'       => 'Zahlungsanweisung',
                'type'        => 'textarea',
                'description' => 'Erscheint nach der Bestellung und in der Bestellbestätigung. {nummer}, {betrag} und {bestellnummer} werden automatisch ersetzt.',
                'default'     => 'Bitte senden Sie {betrag} per TWINT an {nummer} und geben Sie im Mitteilungsfeld die Bestellnummer {bestellnummer} an. Sobald die Zahlung eingegangen ist, bereiten wir Ihre Bestellung vor.',
                'desc_tip'    => true,
            ),
        );
    }

    /** Platzhalter in den Texten ersetzen. */
    private function fill_placeholders( $text, $order = null ) {
        $replacements = array( '{nummer}' => $this->twint_number );

        if ( $order ) {
            $replacements['{betrag}']        = html_entity_decode( wp_strip_all_tags( $order->get_formatted_order_total() ), ENT_QUOTES, 'UTF-8' );
            $replacements['{bestellnummer}'] = $order->get_order_number();
        }

        return strtr( (string) $text, $replacements );
    }

    public function get_description() {
        return apply_filters( 'woocommerce_gateway_description', $this->fill_placeholders( $this->description ), $this->id );
    }

    public function process_payment( $order_id ) {
        $order = wc_get_order( $order_id );

        $order->update_status(
            apply_filters( 'charmelle_twint_process_payment_order_status', 'on-hold', $order ),
            'Warten auf TWINT-Zahlung an ' . $this->twint_number . '.'
        );

        wc_reduce_stock_levels( $order_id );

        if ( WC()->cart ) {
            WC()->cart->empty_cart();
        }

        return array(
            'result'   => 'success',
            'redirect' => $this->get_return_url( $order ),
        );
    }

    public function thankyou_page( $order_id ) {
        $order = wc_get_order( $order_id );

        if ( ! $order || ! $this->instructions ) {
            return;
        }

        echo '<section class="charmelle-twint-instructions" style="margin:0 0 32px;padding:24px 28px;background:var(--accent-gold-light,#F6EFE6);border-radius:12px;">';
        echo '<h2 style="margin-bottom:8px;">So bezahlen Sie mit TWINT</h2>';
        echo wpautop( wptexturize( esc_html( $this->fill_placeholders( $this->instructions, $order ) ) ) );
        echo '</section>';
    }

    public function email_instructions( $order, $sent_to_admin, $plain_text = false ) {
        if ( $sent_to_admin || ! $this->instructions ) {
            return;
        }

        if ( $order->get_payment_method() !== $this->id || ! $order->has_status( 'on-hold' ) ) {
            return;
        }

        $text = $this->fill_placeholders( $this->instructions, $order );

        if ( $plain_text ) {
            echo esc_html( $text ) . PHP_EOL . PHP_EOL;
        } else {
            echo wpautop( wptexturize( esc_html( $text ) ) ) . PHP_EOL;
        }
    }
}
