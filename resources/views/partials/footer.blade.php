<footer class="footer">
    <div class="footer-overlay"></div>
    <div class="footer-content">
        <div class="footer-section details">
            <h2 class="footer-heading">Company Details</h2>
            <div class="footer-info">
                <p><i class="fas fa-hotel"></i> Star Hotel</p>
                <p><i class="fas fa-map-marker-alt"></i> Dallu 15, Kathmandu</p>
                <p><i class="fas fa-mail-bulk"></i> 12345</p>
                <div class="contact-info">
                    <p><i class="fas fa-phone"></i> Tel: 01 1234567</p>
                    <p><i class="fas fa-fax"></i> Fax: 1223 41232</p>
                    <p><i class="fas fa-envelope"></i> Email: <a href="mailto:bisheshs255@gmail.com" class="footer-link">bisheshs255@gmail.com</a></p>
                </div>
                <div class="opening-hours">
                    <p><i class="fas fa-clock"></i> Opening Hours</p>
                    <p>Sunday - Saturday: 24hr available</p>
                </div>
            </div>
        </div>
        
        <div class="footer-section social">
            <h2 class="footer-heading">Stay Connected</h2>
            <div class="social-links">
                <a href="#" class="social-link">
                    <div class="social-icon-wrapper">
                        <img src="{{asset('images/facebook.png')}}" alt="Facebook" class="social-icon">
                    </div>
                    <span>Connect with us on Facebook</span>
                </a>
                <a href="#" class="social-link">
                    <div class="social-icon-wrapper">
                        <img src="{{asset('images/x.png')}}" alt="Twitter" class="social-icon">
                    </div>
                    <span>Keep up with our Tweets</span>
                </a>
                <a href="https://www.instagram.com/limbu_bishesh/" class="social-link">
                    <div class="social-icon-wrapper">
                        <img src="{{asset('images/insta.png')}}" alt="Instagram" class="social-icon">
                    </div>
                    <span>Follow us on Instagram</span>
                </a>
            </div>
        </div>
    </div>
    
    <div class="footer-bottom">
        <p>&copy; 2023 Star Hotel. All Rights Reserved.</p>
    </div>
</footer>

<style>
:root {
    --maroon-hue: rgba(102, 0, 34, 0.7);
    --gold-accent: #d4af37;        
    --light-gold: #f0e6cc;       
    --white: #ffffff;
}

.footer {
    background: linear-gradient(var(--maroon-hue), var(--maroon-hue)), 
                url('/footer.jpg') center/cover no-repeat;
    color: var(--white);
    padding: 60px 0 30px 0;
    font-family: 'Poppins', sans-serif;
    position: relative;
    border-top: 4px solid var(--gold-accent);
}

.footer-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(102, 0, 34, 0.5); 
    z-index: 0;
}

.footer-content {
    display: flex;
    justify-content: space-between;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 40px;
    position: relative;
    z-index: 1;
}

.footer-section {
    flex: 1;
    padding: 0 30px;
}

.footer-heading {
    font-size: 26px;
    color: var(--gold-accent);
    margin-bottom: 30px;
    position: relative;
    font-family: 'Playfair Display', serif;
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
}

.footer-heading:after {
    content: '';
    position: absolute;
    left: 0;
    bottom: -12px;
    width: 60px;
    height: 3px;
    background-color: var(--gold-accent);
    box-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
}

.footer-info p {
    margin-bottom: 15px;
    line-height: 1.7;
    color: var(--light-gold);
    display: flex;
    align-items: center;
    gap: 10px;
}

.footer-info i {
    width: 20px;
    text-align: center;
    color: var(--gold-accent);
}

.contact-info {
    margin: 25px 0;
}

.opening-hours {
    margin-top: 25px;
}

.footer-link {
    color: var(--light-gold);
    text-decoration: none;
    transition: all 0.3s ease;
    border-bottom: 1px dotted var(--gold-accent);
}

.footer-link:hover {
    color: var(--gold-accent);
    border-bottom-color: transparent;
}

.social-links {
    display: flex;
    flex-direction: column;
    gap: 25px;
}

.social-link {
    display: flex;
    align-items: center;
    gap: 20px;
    color: var(--light-gold);
    text-decoration: none;
    transition: all 0.3s ease;
}

.social-link:hover {
    color: var(--gold-accent);
    transform: translateX(8px);
}

.social-icon-wrapper {
    width: 45px;
    height: 45px;
    background-color: rgba(212, 175, 55, 0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

.social-link:hover .social-icon-wrapper {
    background-color: rgba(212, 175, 55, 0.4);
    transform: scale(1.1);
}

.social-icon {
    width: 25px;
    height: 25px;
    object-fit: contain;
    filter: brightness(0) invert(1);
    transition: all 0.3s ease;
}

.social-link:hover .social-icon {
    filter: none;
}

.footer-bottom {
    text-align: center;
    padding: 30px 0 0 0;
    margin-top: 50px;
    border-top: 1px solid rgba(212, 175, 55, 0.3);
    color: var(--light-gold);
    font-size: 14px;
    position: relative;
    z-index: 1;
}

@media (max-width: 992px) {
    .footer-content {
        flex-direction: column;
    }
    
    .footer-section {
        padding: 30px 0;
    }
    
    .footer-section:not(:last-child) {
        border-bottom: 1px solid rgba(212, 175, 55, 0.2);
    }
    
    .footer-heading {
        font-size: 24px;
    }
}

@media (max-width: 576px) {
    .footer {
        padding: 40px 0 20px 0;
    }
    
    .footer-content {
        padding: 0 20px;
    }
    
    .social-link {
        gap: 15px;
    }
    
    .social-icon-wrapper {
        width: 40px;
        height: 40px;
    }
}
</style>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>