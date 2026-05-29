<?php
/**
 * Footer Component
 * ================
 * Shared footer for all pages
 */
?>

<footer class="footer">
    <div class="wrap footer-inner">
        <div class="footer-logo">LUNO<span class="dot">.</span></div>
        <ul class="footer-links">
            <li><a href="<?php echo BASE_URL; ?>/privacy">Privacy Policy</a></li>
            <li><a href="<?php echo BASE_URL; ?>/terms">Terms</a></li>
        </ul>
        <p class="footer-copy">&copy; 2026 Luno. All rights reserved.</p>
    </div>
</footer>

<script>
    (function() {
        var btn    = document.getElementById('themeToggle');
        if (!btn) return;
        var root   = document.documentElement;
        var themes = ['system', 'dark', 'light'];
        var icons  = {
            system: '<i class="ph ph-monitor" style="pointer-events:none;"></i>',
            dark:   '<i class="ph ph-moon"    style="pointer-events:none;"></i>',
            light:  '<i class="ph ph-sun"     style="pointer-events:none;"></i>'
        };
        var labels = { system: 'Theme: System', dark: 'Theme: Dark', light: 'Theme: Light' };

        function applyTheme(theme) {
            root.classList.remove('dark', 'light');
            if (theme === 'dark') {
                root.classList.add('dark');
            } else if (theme === 'light') {
                root.classList.add('light');
            } else {
                root.classList.add(window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
            }
            btn.innerHTML = icons[theme];
            btn.setAttribute('aria-label', labels[theme]);
        }

        var saved = localStorage.getItem('luno-theme') || 'system';
        applyTheme(saved);

        btn.addEventListener('click', function() {
            var current = localStorage.getItem('luno-theme') || 'system';
            var next    = themes[(themes.indexOf(current) + 1) % themes.length];
            localStorage.setItem('luno-theme', next);
            applyTheme(next);
        });

        window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', function(e) {
            if ((localStorage.getItem('luno-theme') || 'system') === 'system') {
                root.classList.remove('dark', 'light');
                root.classList.add(e.matches ? 'dark' : 'light');
            }
        });
    })();

    (function() {
        var observer = new IntersectionObserver(function(entries) {
            entries.forEach(function(e) {
                if (e.isIntersecting) {
                    e.target.classList.add('visible');
                    observer.unobserve(e.target);
                }
            });
        }, { threshold: 0.12 });
        document.querySelectorAll('.anim').forEach(function(el) { observer.observe(el); });
    })();
</script>

</body>
</html>
