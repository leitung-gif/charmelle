    </main>

    <!-- ===== FOOTER ===== -->
    <footer class="site-footer" id="footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-brand">
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/images/logo.png' ); ?>" alt="Charmelle Beauty Center Logo" style="height:48px;margin-bottom:16px;filter:brightness(1.3);">
                    <p>Ihr Premium-Kosmetikstudio in Aarau. Seit über 30 Jahren vereinen wir medizinische Expertise mit Wohlfühl-Atmosphäre. Hydra Facial, Microneedling, LPG, Wimpernlifting und mehr im Kanton Aargau.</p>
                    <div class="footer-social">
                        <a href="https://www.instagram.com/beauty_charmelle/" target="_blank" rel="noopener" aria-label="Charmelle Beauty Center auf Instagram">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="m16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>
                        </a>
                        <a href="https://wa.me/+41798286647" target="_blank" rel="noopener" aria-label="WhatsApp Charmelle">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                        </a>
                        <a href="tel:+41628226647" aria-label="Telefon Charmelle Aarau">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                        </a>
                    </div>
                </div>
                <div class="footer-col">
                    <h5>Navigation</h5>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a>
                    <a href="<?php echo esc_url( home_url( '/behandlungen/' ) ); ?>">Behandlungen</a>
                    <a href="<?php echo esc_url( home_url( '/team/' ) ); ?>">Team</a>
                    <a href="<?php echo function_exists('wc_get_page_id') ? esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ) : esc_url( home_url( '/shop/' ) ); ?>">Shop</a>
                    <a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>">Blog</a>
                    <a href="<?php echo esc_url( home_url( '/gutscheine/' ) ); ?>">Gutscheine</a>
                    <a href="<?php echo esc_url( home_url( '/kontakt/' ) ); ?>">Kontakt</a>
                </div>
                <div class="footer-col">
                    <h5>Beliebte Behandlungen</h5>
                    <a href="<?php echo esc_url( home_url( '/behandlungen/#hightech' ) ); ?>">Hydra Facial Syndeo</a>
                    <a href="<?php echo esc_url( home_url( '/behandlungen/#hightech' ) ); ?>">Microneedling</a>
                    <a href="<?php echo esc_url( home_url( '/behandlungen/#hightech' ) ); ?>">LPG Endermologie</a>
                    <a href="<?php echo esc_url( home_url( '/behandlungen/#klassisch' ) ); ?>">Gesichtspflege</a>
                    <a href="<?php echo esc_url( home_url( '/behandlungen/#ausdrucksstark' ) ); ?>">Wimpernlifting</a>
                    <a href="<?php echo esc_url( home_url( '/behandlungen/#ausdrucksstark' ) ); ?>">Permanent Make-Up</a>
                </div>
                <div class="footer-col">
                    <h5>Kontakt</h5>
                    <a href="tel:+41628226647">062 822 66 47</a>
                    <a href="https://wa.me/+41798286647" target="_blank" rel="noopener">WhatsApp: 079 828 66 47</a>
                    <a href="mailto:info@charmelle.ch">info@charmelle.ch</a>
                    <a href="<?php echo esc_url( home_url( '/kontakt/' ) ); ?>">Girixweg 7, 5000 Aarau</a>
                    <span style="font-size:0.82rem;color:rgba(253,251,247,0.4);display:block;margin-top:8px;">Mo &amp; Do: 09:00-19:00 · Di, Mi &amp; Fr: 09:00-18:30 · Sa: 08:30-14:00</span>
                </div>
            </div>
            <div class="footer-credit">Made by <a href="https://www.lorien.group/" target="_blank" rel="noopener">Lorien Group</a></div>
            <div class="footer-bottom">
                <span>&copy; <?php echo date('Y'); ?> Charmelle Beauty Center GmbH. Alle Rechte vorbehalten.</span>
                <div class="footer-legal">
                    <a href="<?php echo esc_url( home_url( '/agb/' ) ); ?>">AGB</a>
                    <a href="<?php echo esc_url( home_url( '/datenschutz/' ) ); ?>">Datenschutz</a>
                    <a href="<?php echo esc_url( home_url( '/impressum/' ) ); ?>">Impressum</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Cookie Consent Banner -->
    <div class="cookie-consent" role="dialog" aria-label="Cookie-Hinweis">
        <p>Wir verwenden Cookies, um Ihnen die bestmögliche Erfahrung zu bieten. <a href="<?php echo esc_url( home_url( '/datenschutz/' ) ); ?>">Datenschutz</a></p>
        <div class="cookie-consent-actions">
            <button class="btn-accept">Akzeptieren</button>
            <button class="btn-decline">Ablehnen</button>
        </div>
    </div>

    <?php wp_footer(); ?>
</body>
</html>
