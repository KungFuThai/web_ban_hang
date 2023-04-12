<footer class="footer footer-black footer-big">
    <div class="container">
        <div class="container">
            <a class="footer-brand" href="{{ route('customer.index') }}">{{ config('app.name') }}</a>

            <div class="copyright pull-center">
                2022
                @if (date('Y') != 2022)
                    - {{ date('Y') }}
                @endif
                © {{ config('app.name') }}
            </div>

            <ul class="social-buttons pull-right">
                <li>
                    <a href="https://www.facebook.com/mot.caiten.52831" target="_blank" class="btn btn-just-icon btn-simple">
                        <i class="fa fa-facebook-square"></i>
                    </a>
                </li>
                <li>
                    <a href="https://www.instagram.com/kungfuthai10/" target="_blank" class="btn btn-just-icon btn-simple">
                        <i class="fa fa-instagram"></i>
                    </a>
                </li>
            </ul>

        </div>
</footer>