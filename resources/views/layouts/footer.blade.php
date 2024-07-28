@section('footer')
<footer class="footer">
    <div class="footer__top">
        <div class="footer__line">
            <hr>
        </div>

        <div class="footer__socials">
            <a href="#" class="footer__icon">
                <i class="bi bi-facebook"></i>
            </a>
            <a href="#" class="footer__icon">
                <i class="bi bi-instagram"></i>
            </a>
            <a class="footer__icon" onclick="location.href='mailto:myshop@shopxeng.com'">
                <i class="bi bi-envelope"></i>
            </a>
            <a href="https://wa.me/573502708546" target="_blank" class="footer__icon">
                <i class="bi bi-whatsapp"></i>
            </a>
        </div>

        <div class="footer__line">
            <hr>
        </div>
    </div>

    <div class="footer__bot">
        <h2 class="footer__ttl">ShopXeng</h2>

        <div class="footer__politice">
            <a class="footer__polit" href="{{ route('pageLegal') }}">Información legal</a>
            <div>|</div>
            <a class="footer__polit" href="{{ route('pagePolicies') }}">Política de privacidad</a>
        </div>

        <div class="footer__contact">
            <span class=""><b>WhatsApp:</b> +57 350 270 8546</span>
            <span class=""><b>Correo:</b> myshop@shopxeng.com</span>
        </div>

        <span class="footer__copy">Copyright © 2024 ShopXeng.</span>
    </div>
</footer>
@endSection