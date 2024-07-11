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
            <a href="https://wa.me/573005369591" target="_blank" class="footer__icon">
                <i class="bi bi-whatsapp"></i>
            </a>
        </div>

        <div class="footer__line">
            <hr>
        </div>
    </div>

    <div class="footer__bot">
        <h2 class="footer__ttl">ShopXeng</h2>

        <span class="footer__copy">Copyright © 2024 ShopXeng.</span>

        <div class="footer__politice">
            <a class="footer__polit" href="{{ route('pageLegal') }}">Información legal</a>
            <div>|</div>
            <a class="footer__polit" href="{{ route('pagePolicies') }}">Política de privacidad</a>
        </div>
    </div>
</footer>
@endSection