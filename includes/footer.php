<?php
/**
 * Footer Component
 * ================
 * Shared footer for all pages
 */
?>

<div class="border-t border-surface"></div>
<footer>
    <div class="max-w-[1100px] mx-auto px-6 py-6 flex items-center justify-between flex-wrap gap-4">
        <div class="font-mono font-bold text-[14px] tracking-[0.22em] uppercase text-dim leading-none">LUNO<span class="text-primary opacity-45 tracking-normal">.</span></div>
        <div class="flex gap-6">
            <a href="<?php echo BASE_URL; ?>/privacy" class="font-mono text-[11px] tracking-[0.12em] uppercase text-muted hover:text-fg transition-colors duration-150">Privacy Policy</a>
            <a href="<?php echo BASE_URL; ?>/terms"   class="font-mono text-[11px] tracking-[0.12em] uppercase text-muted hover:text-fg transition-colors duration-150">Terms</a>
        </div>
        <p class="font-mono text-[11px] text-dim tracking-[0.06em]">&copy; 2026 Luno. All rights reserved.</p>
    </div>
</footer>

<script>
    // Theme toggle — cycles: system → dark → light → system
    (function() {
        var btn = document.getElementById('themeToggle');
        if (!btn) return;
        var root = document.documentElement;
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
            var next = themes[(themes.indexOf(current) + 1) % themes.length];
            localStorage.setItem('luno-theme', next);
            applyTheme(next);
        });

        // Re-apply when OS preference changes while in system mode
        window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', function(e) {
            if ((localStorage.getItem('luno-theme') || 'system') === 'system') {
                root.classList.remove('dark', 'light');
                root.classList.add(e.matches ? 'dark' : 'light');
            }
        });
    })();

    // Intersection observer — fade-up on scroll
    (function() {
        var observer = new IntersectionObserver(function(entries) {
            entries.forEach(function(e) {
                if (e.isIntersecting) {
                    e.target.classList.add('visible');
                    observer.unobserve(e.target);
                }
            });
        }, { threshold: 0.12 });
        document.querySelectorAll('.anim').forEach(function(el) {
            observer.observe(el);
        });
    })();
</script>

</body>
</html>
