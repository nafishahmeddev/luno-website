<?php
/**
 * Index Page - Home
 * =================
 */

$request_path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
$request_path = rtrim($request_path, '/');
$route = $request_path === '' ? '/' : basename($request_path);

if ($route === 'privacy') {
  include __DIR__ . '/privacy.php';
  exit;
}

if ($route === 'terms') {
  include __DIR__ . '/terms.php';
  exit;
}

if ($route !== '/' && $route !== 'index.php') {
  http_response_code(404);
}

include_once __DIR__ . '/includes/header.php';
?>

<!-- ── HERO ── -->
<section class="relative overflow-hidden py-[6rem] pb-[5rem]">
    <div class="pointer-events-none rounded-full bg-[radial-gradient(circle,color-mix(in_srgb,var(--primary)_13%,transparent)_0%,transparent_70%)] absolute -top-40 left-1/2 -translate-x-1/2 w-[900px] h-[600px]"></div>
    <div class="absolute inset-0 pointer-events-none"
        style="background-image:linear-gradient(color-mix(in srgb,var(--primary) 3%,transparent) 1px,transparent 1px),linear-gradient(90deg,color-mix(in srgb,var(--primary) 3%,transparent) 1px,transparent 1px);background-size:60px 60px;">
    </div>

    <div class="max-w-[1100px] mx-auto px-6 grid grid-cols-1 md:grid-cols-2 gap-14 items-center relative z-10">
        <div>
            <div class="anim [animation-delay:0.00s] mb-7 inline-flex items-center gap-[7px] font-mono text-[11px] tracking-[0.1em] uppercase text-primary bg-[color-mix(in_srgb,var(--primary)_9%,transparent)] border border-[color-mix(in_srgb,var(--primary)_22%,transparent)] py-[5px] px-[13px] rounded-full">
                <span class="w-[6px] h-[6px] bg-primary rounded-full animate-blink shrink-0"></span>Phase 2 — Premium Available
            </div>
            <h1 class="anim [animation-delay:0.08s] mb-6 font-extrabold text-[clamp(50px,8vw,96px)] leading-[0.96] tracking-[-0.04em] text-fg [&>em]:not-italic [&>em]:text-primary">Your money.<br><em>Your rules.</em></h1>
            <p class="anim [animation-delay:0.16s] mb-9 leading-[1.8] text-[16px] text-muted max-w-[420px]">
                Luno is a privacy-first personal finance manager. Track every transaction, get weekly spending insights,
                and keep 100% of your data on-device. Core features are free — advanced analytics unlocked with
                premium.
            </p>
            <div class="flex gap-3 flex-wrap anim [animation-delay:0.24s]">
                <a href="https://play.google.com/store/apps/details?id=me.nafish.luno" class="inline-flex items-center gap-[8px] font-sans font-bold tracking-[-0.01em] no-underline border-none cursor-pointer transition-all duration-180 whitespace-nowrap text-[15px] py-[13px] px-[26px] rounded-[12px] bg-primary text-bg hover:brightness-[1.08]">
                    <i class="ph ph-download-simple"></i>Download Free
                </a>
                <a href="#features" class="inline-flex items-center gap-[8px] font-sans font-bold tracking-[-0.01em] no-underline border-none cursor-pointer transition-all duration-180 whitespace-nowrap text-[15px] py-[13px] px-[26px] rounded-[12px] text-muted bg-surface hover:bg-surf2 hover:text-fg">See Features</a>
            </div>
        </div>

        <div class="relative anim [animation-delay:0.06s] h-[300px] md:h-[480px]">
            <div class="pointer-events-none rounded-full bg-[radial-gradient(circle,color-mix(in_srgb,var(--primary)_13%,transparent)_0%,transparent_70%)] absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[340px] h-[340px]"></div>
            
            <div class="hidden md:block absolute rounded-[26px] overflow-hidden border border-surface shadow-[0_28px_70px_rgba(0,0,0,0.55),0_0_0_0.5px_var(--surface)] w-[158px] h-[316px] top-[58px] left-[0px] -rotate-[7deg] z-1 opacity-50"><img src="<?php echo IMG_URL; ?>/mint_fresh_1.png" alt="Onboarding" class="block w-full h-full object-cover"/></div>
            
            <div class="absolute rounded-[26px] overflow-hidden border border-surface shadow-[0_28px_70px_rgba(0,0,0,0.55),0_0_0_0.5px_var(--surface)] w-[162px] h-[324px] top-[24px] left-[8px] md:left-[76px] -rotate-[2.5deg] z-2 opacity-78"><img src="<?php echo IMG_URL; ?>/mint_fresh_2.png" alt="Profile" class="block w-full h-full object-cover"/></div>
            
            <div class="absolute rounded-[26px] overflow-hidden border border-surface shadow-[0_28px_70px_rgba(0,0,0,0.55),0_0_0_0.5px_var(--surface)] w-[172px] h-[344px] top-[0] left-[90px] md:left-[160px] rotate-[0deg] z-3"><img src="<?php echo IMG_URL; ?>/mint_fresh_3.png" alt="Dashboard" class="block w-full h-full object-cover"/></div>
            
            <div class="absolute rounded-[26px] overflow-hidden border border-surface shadow-[0_28px_70px_rgba(0,0,0,0.55),0_0_0_0.5px_var(--surface)] w-[162px] h-[324px] top-[24px] left-[172px] md:left-[245px] rotate-[2.5deg] z-2 opacity-78"><img src="<?php echo IMG_URL; ?>/mint_fresh_4.png" alt="Analytics" class="block w-full h-full object-cover"/></div>
            
            <div class="hidden md:block absolute rounded-[26px] overflow-hidden border border-surface shadow-[0_28px_70px_rgba(0,0,0,0.55),0_0_0_0.5px_var(--surface)] w-[158px] h-[316px] top-[58px] left-[322px] rotate-[7deg] z-1 opacity-50"><img src="<?php echo IMG_URL; ?>/mint_fresh_5.png" alt="Transactions" class="block w-full h-full object-cover"/></div>
        </div>
    </div>
</section>

<!-- ── STATS ── -->
<div class="border-t border-surface"></div>
<div class="bg-card">
    <div class="max-w-[1100px] mx-auto px-6 py-8 grid grid-cols-2 md:grid-cols-4 gap-4">
        <div class="anim bg-surface rounded-[18px] p-6 text-center border border-[color-mix(in_srgb,var(--primary)_8%,transparent)] transition-colors duration-200 hover:bg-surf2 text-primary">
            <div class="font-extrabold text-[38px] leading-none tracking-[-0.04em] mb-[6px] text-primary">50+</div>
            <div class="font-mono text-[10px] tracking-[0.16em] uppercase text-muted">Categories</div>
        </div>
        <div class="anim [animation-delay:0.08s] bg-surface rounded-[18px] p-6 text-center border border-[color-mix(in_srgb,var(--primary)_8%,transparent)] transition-colors duration-200 hover:bg-surf2 text-primary">
            <div class="font-extrabold text-[38px] leading-none tracking-[-0.04em] mb-[6px] text-primary">100%</div>
            <div class="font-mono text-[10px] tracking-[0.16em] uppercase text-muted">Local Storage</div>
        </div>
        <div class="anim [animation-delay:0.16s] bg-surface rounded-[18px] p-6 text-center border border-[color-mix(in_srgb,var(--primary)_8%,transparent)] transition-colors duration-200 hover:bg-surf2 text-primary">
            <div class="font-extrabold text-[38px] leading-none tracking-[-0.04em] mb-[6px] text-primary">0</div>
            <div class="font-mono text-[10px] tracking-[0.16em] uppercase text-muted">Cloud Servers</div>
        </div>
        <div class="anim [animation-delay:0.24s] bg-surface rounded-[18px] p-6 text-center border border-[color-mix(in_srgb,var(--primary)_8%,transparent)] transition-colors duration-200 hover:bg-surf2 text-primary">
            <div class="font-extrabold text-[38px] leading-none tracking-[-0.04em] mb-[6px] text-primary">Free</div>
            <div class="font-mono text-[10px] tracking-[0.16em] uppercase text-muted">+ Premium</div>
        </div>
    </div>
</div>
<div class="border-t border-surface"></div>

<!-- ── FEATURES ── -->
<section id="features" class="py-[6rem]">
    <div class="max-w-[1100px] mx-auto px-6">
        <div class="anim mb-4">
            <div class="inline-flex items-center gap-[10px] font-mono text-[11px] tracking-[0.2em] uppercase text-primary before:content-[''] before:block before:w-[18px] before:h-[1px] before:bg-primary before:opacity-60">Features</div>
        </div>
        <h2 class="anim [animation-delay:0.08s] font-extrabold text-fg mb-3 text-[clamp(28px,4vw,46px)] leading-[1.1] tracking-[-0.03em]">Everything you need.<br>Nothing you don't.</h2>
        <p class="anim [animation-delay:0.16s] text-muted mb-12 max-w-[500px] leading-relaxed text-[15px]">Free tier covers daily tracking. Premium unlocks analytics with a one-time lifetime purchase.</p>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3">
            <div class="group bg-card rounded-[20px] p-[1.75rem] border border-surface transition-all duration-200 relative overflow-hidden flex flex-col gap-0 hover:bg-surface hover:border-[color-mix(in_srgb,var(--primary)_25%,transparent)] anim">
                <div class="absolute inset-0 rounded-[20px] bg-[linear-gradient(135deg,color-mix(in_srgb,var(--primary)_6%,transparent)_0%,transparent_60%)] opacity-0 transition-opacity duration-250 group-hover:opacity-100 pointer-events-none"></div>
                <span class="font-mono text-[10px] tracking-[0.18em] text-dim mb-[1rem] block relative z-10">01</span>
                <div class="w-[42px] h-[42px] rounded-[12px] bg-[color-mix(in_srgb,var(--primary)_10%,transparent)] text-primary flex items-center justify-center text-[19px] mb-[1rem] border border-[color-mix(in_srgb,var(--primary)_18%,transparent)] relative z-10"><i class="ph ph-wallet"></i></div>
                <div class="font-bold text-[15px] tracking-[-0.02em] text-fg leading-[1.3] mb-[0.5rem] relative z-10">Multi-Account Tracking</div>
                <p class="text-[13px] text-muted leading-[1.7] flex-1 relative z-10">Track balances across wallets, banks, and cash. See your total net position at a glance.</p>
            </div>
            
            <div class="group bg-card rounded-[20px] p-[1.75rem] border border-surface transition-all duration-200 relative overflow-hidden flex flex-col gap-0 hover:bg-surface hover:border-[color-mix(in_srgb,var(--primary)_25%,transparent)] anim [animation-delay:0.08s]">
                <div class="absolute inset-0 rounded-[20px] bg-[linear-gradient(135deg,color-mix(in_srgb,var(--primary)_6%,transparent)_0%,transparent_60%)] opacity-0 transition-opacity duration-250 group-hover:opacity-100 pointer-events-none"></div>
                <span class="font-mono text-[10px] tracking-[0.18em] text-dim mb-[1rem] block relative z-10">02</span>
                <div class="w-[42px] h-[42px] rounded-[12px] bg-[color-mix(in_srgb,var(--primary)_10%,transparent)] text-primary flex items-center justify-center text-[19px] mb-[1rem] border border-[color-mix(in_srgb,var(--primary)_18%,transparent)] relative z-10"><i class="ph ph-chart-line-up"></i></div>
                <div class="font-bold text-[15px] tracking-[-0.02em] text-fg leading-[1.3] mb-[0.5rem] relative z-10">Advanced Analytics<span class="font-mono text-[9px] tracking-[0.14em] uppercase text-primary bg-[color-mix(in_srgb,var(--primary)_12%,transparent)] border border-[color-mix(in_srgb,var(--primary)_22%,transparent)] py-[2px] px-[7px] rounded-[6px] ml-[6px] align-middle">Premium</span></div>
                <p class="text-[13px] text-muted leading-[1.7] flex-1 relative z-10">Daily burn rate, savings rate, runway, and in/out ratio. Filter 7D · 30D · 90D · all time.</p>
            </div>
            
            <div class="group bg-card rounded-[20px] p-[1.75rem] border border-surface transition-all duration-200 relative overflow-hidden flex flex-col gap-0 hover:bg-surface hover:border-[color-mix(in_srgb,var(--primary)_25%,transparent)] anim [animation-delay:0.16s]">
                <div class="absolute inset-0 rounded-[20px] bg-[linear-gradient(135deg,color-mix(in_srgb,var(--primary)_6%,transparent)_0%,transparent_60%)] opacity-0 transition-opacity duration-250 group-hover:opacity-100 pointer-events-none"></div>
                <span class="font-mono text-[10px] tracking-[0.18em] text-dim mb-[1rem] block relative z-10">03</span>
                <div class="w-[42px] h-[42px] rounded-[12px] bg-[color-mix(in_srgb,var(--primary)_10%,transparent)] text-primary flex items-center justify-center text-[19px] mb-[1rem] border border-[color-mix(in_srgb,var(--primary)_18%,transparent)] relative z-10"><i class="ph ph-stack"></i></div>
                <div class="font-bold text-[15px] tracking-[-0.02em] text-fg leading-[1.3] mb-[0.5rem] relative z-10">50+ Categories</div>
                <p class="text-[13px] text-muted leading-[1.7] flex-1 relative z-10">Pre-seeded across Essentials, Transport, Health, Lifestyle, and more. Fully customizable.</p>
            </div>
            
            <div class="group bg-card rounded-[20px] p-[1.75rem] border border-surface transition-all duration-200 relative overflow-hidden flex flex-col gap-0 hover:bg-surface hover:border-[color-mix(in_srgb,var(--primary)_25%,transparent)] anim">
                <div class="absolute inset-0 rounded-[20px] bg-[linear-gradient(135deg,color-mix(in_srgb,var(--primary)_6%,transparent)_0%,transparent_60%)] opacity-0 transition-opacity duration-250 group-hover:opacity-100 pointer-events-none"></div>
                <span class="font-mono text-[10px] tracking-[0.18em] text-dim mb-[1rem] block relative z-10">04</span>
                <div class="w-[42px] h-[42px] rounded-[12px] bg-[color-mix(in_srgb,var(--primary)_10%,transparent)] text-primary flex items-center justify-center text-[19px] mb-[1rem] border border-[color-mix(in_srgb,var(--primary)_18%,transparent)] relative z-10"><i class="ph ph-note-pencil"></i></div>
                <div class="font-bold text-[15px] tracking-[-0.02em] text-fg leading-[1.3] mb-[0.5rem] relative z-10">Precision Logging</div>
                <p class="text-[13px] text-muted leading-[1.7] flex-1 relative z-10">Notes, timestamps, multi-account links per transaction. Swipe to edit with auto balance reversal.</p>
            </div>
            
            <div class="group bg-card rounded-[20px] p-[1.75rem] border border-surface transition-all duration-200 relative overflow-hidden flex flex-col gap-0 hover:bg-surface hover:border-[color-mix(in_srgb,var(--primary)_25%,transparent)] anim [animation-delay:0.08s]">
                <div class="absolute inset-0 rounded-[20px] bg-[linear-gradient(135deg,color-mix(in_srgb,var(--primary)_6%,transparent)_0%,transparent_60%)] opacity-0 transition-opacity duration-250 group-hover:opacity-100 pointer-events-none"></div>
                <span class="font-mono text-[10px] tracking-[0.18em] text-dim mb-[1rem] block relative z-10">05</span>
                <div class="w-[42px] h-[42px] rounded-[12px] bg-[color-mix(in_srgb,var(--primary)_10%,transparent)] text-primary flex items-center justify-center text-[19px] mb-[1rem] border border-[color-mix(in_srgb,var(--primary)_18%,transparent)] relative z-10"><i class="ph ph-shield-check"></i></div>
                <div class="font-bold text-[15px] tracking-[-0.02em] text-fg leading-[1.3] mb-[0.5rem] relative z-10">100% Local &amp; Private</div>
                <p class="text-[13px] text-muted leading-[1.7] flex-1 relative z-10">All data on-device via SQLite. No account. No cloud. No tracking. Your money, your device.</p>
            </div>
            
            <div class="group bg-card rounded-[20px] p-[1.75rem] border border-surface transition-all duration-200 relative overflow-hidden flex flex-col gap-0 hover:bg-surface hover:border-[color-mix(in_srgb,var(--primary)_25%,transparent)] anim [animation-delay:0.16s]">
                <div class="absolute inset-0 rounded-[20px] bg-[linear-gradient(135deg,color-mix(in_srgb,var(--primary)_6%,transparent)_0%,transparent_60%)] opacity-0 transition-opacity duration-250 group-hover:opacity-100 pointer-events-none"></div>
                <span class="font-mono text-[10px] tracking-[0.18em] text-dim mb-[1rem] block relative z-10">06</span>
                <div class="w-[42px] h-[42px] rounded-[12px] bg-[color-mix(in_srgb,var(--primary)_10%,transparent)] text-primary flex items-center justify-center text-[19px] mb-[1rem] border border-[color-mix(in_srgb,var(--primary)_18%,transparent)] relative z-10"><i class="ph ph-palette"></i></div>
                <div class="font-bold text-[15px] tracking-[-0.02em] text-fg leading-[1.3] mb-[0.5rem] relative z-10">Adaptive Themes</div>
                <p class="text-[13px] text-muted leading-[1.7] flex-1 relative z-10">Light, dark, and system modes. Custom icons and color palettes per account and category.</p>
            </div>
            
            <div class="group bg-card rounded-[20px] p-[1.75rem] border border-surface transition-all duration-200 relative overflow-hidden flex flex-col gap-0 hover:bg-surface hover:border-[color-mix(in_srgb,var(--primary)_25%,transparent)] anim">
                <div class="absolute inset-0 rounded-[20px] bg-[linear-gradient(135deg,color-mix(in_srgb,var(--primary)_6%,transparent)_0%,transparent_60%)] opacity-0 transition-opacity duration-250 group-hover:opacity-100 pointer-events-none"></div>
                <span class="font-mono text-[10px] tracking-[0.18em] text-dim mb-[1rem] block relative z-10">07</span>
                <div class="w-[42px] h-[42px] rounded-[12px] bg-[color-mix(in_srgb,var(--primary)_10%,transparent)] text-primary flex items-center justify-center text-[19px] mb-[1rem] border border-[color-mix(in_srgb,var(--primary)_18%,transparent)] relative z-10"><i class="ph ph-lightbulb"></i></div>
                <div class="font-bold text-[15px] tracking-[-0.02em] text-fg leading-[1.3] mb-[0.5rem] relative z-10">Smart Insights</div>
                <p class="text-[13px] text-muted leading-[1.7] flex-1 relative z-10">Spending alerts, runway tracking, savings feedback — contextual cards right inside your dashboard.</p>
            </div>
            
            <div class="group bg-card rounded-[20px] p-[1.75rem] border border-surface transition-all duration-200 relative overflow-hidden flex flex-col gap-0 hover:bg-surface hover:border-[color-mix(in_srgb,var(--primary)_25%,transparent)] anim [animation-delay:0.08s]">
                <div class="absolute inset-0 rounded-[20px] bg-[linear-gradient(135deg,color-mix(in_srgb,var(--primary)_6%,transparent)_0%,transparent_60%)] opacity-0 transition-opacity duration-250 group-hover:opacity-100 pointer-events-none"></div>
                <span class="font-mono text-[10px] tracking-[0.18em] text-dim mb-[1rem] block relative z-10">08</span>
                <div class="w-[42px] h-[42px] rounded-[12px] bg-[color-mix(in_srgb,var(--primary)_10%,transparent)] text-primary flex items-center justify-center text-[19px] mb-[1rem] border border-[color-mix(in_srgb,var(--primary)_18%,transparent)] relative z-10"><i class="ph ph-calendar-check"></i></div>
                <div class="font-bold text-[15px] tracking-[-0.02em] text-fg leading-[1.3] mb-[0.5rem] relative z-10">Weekly &amp; Monthly Reports</div>
                <p class="text-[13px] text-muted leading-[1.7] flex-1 relative z-10">Full summary and review views so you always know exactly where your money went.</p>
            </div>
            
            <div class="group bg-card rounded-[20px] p-[1.75rem] border border-surface transition-all duration-200 relative overflow-hidden flex flex-col gap-0 hover:bg-surface hover:border-[color-mix(in_srgb,var(--primary)_25%,transparent)] anim [animation-delay:0.16s]">
                <div class="absolute inset-0 rounded-[20px] bg-[linear-gradient(135deg,color-mix(in_srgb,var(--primary)_6%,transparent)_0%,transparent_60%)] opacity-0 transition-opacity duration-250 group-hover:opacity-100 pointer-events-none"></div>
                <span class="font-mono text-[10px] tracking-[0.18em] text-dim mb-[1rem] block relative z-10">09</span>
                <div class="w-[42px] h-[42px] rounded-[12px] bg-[color-mix(in_srgb,var(--primary)_10%,transparent)] text-primary flex items-center justify-center text-[19px] mb-[1rem] border border-[color-mix(in_srgb,var(--primary)_18%,transparent)] relative z-10"><i class="ph ph-fire"></i></div>
                <div class="font-bold text-[15px] tracking-[-0.02em] text-fg leading-[1.3] mb-[0.5rem] relative z-10">Streaks &amp; Reminders</div>
                <p class="text-[13px] text-muted leading-[1.7] flex-1 relative z-10">Consistency tracking and lightweight reminders keep you logging and on top of your finances.</p>
            </div>
        </div>
    </div>
</section>

<div class="border-t border-surface"></div>

<!-- ── ANALYTICS SPLIT ── -->
<section id="analytics" class="py-[6rem]">
    <div class="max-w-[1100px] mx-auto px-6 grid grid-cols-1 md:grid-cols-2 gap-16 items-center">
        <div>
            <div class="anim mb-4">
                <div class="inline-flex items-center gap-[10px] font-mono text-[11px] tracking-[0.2em] uppercase text-primary before:content-[''] before:block before:w-[18px] before:h-[1px] before:bg-primary before:opacity-60">Premium Analytics</div>
            </div>
            <h2 class="anim [animation-delay:0.08s] font-extrabold text-fg mb-3 text-[clamp(26px,3.5vw,42px)] leading-[1.1] tracking-[-0.03em]">See what your<br>money tells you.</h2>
            <p class="anim [animation-delay:0.16s] text-muted leading-relaxed mb-8 text-[15px]">Advanced metrics that
                reveal your true financial health — one-time lifetime unlock.</p>
            <div class="anim [animation-delay:0.24s] rounded-2xl overflow-hidden border border-surface bg-card">
                <div class="flex justify-between items-center py-[14px] px-[18px] border-b border-surface transition-colors duration-150 hover:bg-surface"><span class="font-mono text-[11px] tracking-[0.1em] uppercase text-muted">Avg Daily Burn</span><span class="font-mono text-[14px] font-bold text-danger">-&#8377;1,579 / day</span></div>
                <div class="flex justify-between items-center py-[14px] px-[18px] border-b border-surface transition-colors duration-150 hover:bg-surface"><span class="font-mono text-[11px] tracking-[0.1em] uppercase text-muted">Savings Rate</span><span class="font-mono text-[14px] font-bold text-success">86.5%</span></div>
                <div class="flex justify-between items-center py-[14px] px-[18px] border-b border-surface transition-colors duration-150 hover:bg-surface"><span class="font-mono text-[11px] tracking-[0.1em] uppercase text-muted">Financial Runway</span><span class="font-mono text-[14px] font-bold text-success">2,357 days</span></div>
                <div class="flex justify-between items-center py-[14px] px-[18px] transition-colors duration-150 hover:bg-surface"><span class="font-mono text-[11px] tracking-[0.1em] uppercase text-muted">In / Out Ratio</span><span class="font-mono text-[14px] font-bold text-success">7.41&times;</span></div>
            </div>
        </div>

        <div class="flex items-center justify-center relative anim [animation-delay:0.08s]">
            <div class="pointer-events-none rounded-full bg-[radial-gradient(circle,color-mix(in_srgb,var(--primary)_13%,transparent)_0%,transparent_70%)] absolute w-[300px] h-[300px]"></div>
            <div class="relative z-10 w-[224px] rounded-[32px] overflow-hidden border border-surface shadow-[0_40px_100px_rgba(0,0,0,0.65)]">
                <img src="<?php echo IMG_URL; ?>/mint_fresh_4.png" alt="Analytics screen" class="block w-full"/>
            </div>
        </div>
    </div>
</section>

<div class="border-t border-surface"></div>

<!-- ── INSIGHTS SPLIT ── -->
<section id="insights" class="py-[6rem]">
    <div class="max-w-[1100px] mx-auto px-6 grid grid-cols-1 md:grid-cols-2 gap-16 items-center">

        <!-- insight cards mockup -->
        <div class="anim flex flex-col gap-3 relative">
            <div class="pointer-events-none bg-[radial-gradient(circle,color-mix(in_srgb,var(--primary)_13%,transparent)_0%,transparent_70%)] absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 rounded-full w-[280px] h-[280px] opacity-70"></div>
            
            <div class="rounded-[16px] py-[1rem] px-[1.25rem] bg-surface border border-surface flex items-start gap-[12px] relative z-10">
                <div class="w-[34px] h-[34px] rounded-[10px] shrink-0 flex items-center justify-center text-[16px] bg-[color-mix(in_srgb,var(--warning)_12%,transparent)] text-warning"><i class="ph ph-trend-up"></i></div>
                <div>
                    <div class="text-[13px] font-bold text-fg mb-[2px]">Spending up 20% this week</div>
                    <div class="text-[12px] text-muted leading-[1.5]">You spent &#8377;3,240 more than your 4-week average. Food &amp; Dining drove the spike.</div>
                </div>
            </div>
            
            <div class="rounded-[16px] py-[1rem] px-[1.25rem] bg-surface border border-surface flex items-start gap-[12px] relative z-10">
                <div class="w-[34px] h-[34px] rounded-[10px] shrink-0 flex items-center justify-center text-[16px] bg-[color-mix(in_srgb,var(--success)_12%,transparent)] text-success"><i class="ph ph-piggy-bank"></i></div>
                <div>
                    <div class="text-[13px] font-bold text-fg mb-[2px]">You saved &#8377;12,800 this month</div>
                    <div class="text-[12px] text-muted leading-[1.5]">Your savings rate hit 86.5% — the highest in the last 90 days.</div>
                </div>
            </div>
            
            <div class="rounded-[16px] py-[1rem] px-[1.25rem] bg-surface border border-surface flex items-start gap-[12px] relative z-10">
                <div class="w-[34px] h-[34px] rounded-[10px] shrink-0 flex items-center justify-center text-[16px] bg-[color-mix(in_srgb,var(--primary)_12%,transparent)] text-primary"><i class="ph ph-clock-countdown"></i></div>
                <div>
                    <div class="text-[13px] font-bold text-fg mb-[2px]">Runway extended by 34 days</div>
                    <div class="text-[12px] text-muted leading-[1.5]">Based on current burn rate, you can sustain for 2,357 more days.</div>
                </div>
            </div>
        </div>

        <div>
            <div class="anim mb-4">
                <div class="inline-flex items-center gap-[10px] font-mono text-[11px] tracking-[0.2em] uppercase text-primary before:content-[''] before:block before:w-[18px] before:h-[1px] before:bg-primary before:opacity-60">Insights Layer</div>
            </div>
            <h2 class="anim [animation-delay:0.08s] font-extrabold text-fg mb-3 text-[clamp(26px,3.5vw,42px)] leading-[1.1] tracking-[-0.03em]">Your money<br>speaks clearly.</h2>
            <p class="anim [animation-delay:0.16s] text-muted leading-relaxed mb-6 text-[15px]">Luno surfaces contextual
                intelligence right inside your dashboard — no digging required. Spending alerts, runway changes, and
                savings wins, all in plain language.</p>
            <ul class="anim [animation-delay:0.24s] flex flex-col gap-3 list-none">
                <li class="flex items-center gap-3 text-[14px] text-muted"><i class="ph ph-check-circle text-primary text-[17px] shrink-0"></i>Weekly financial summaries</li>
                <li class="flex items-center gap-3 text-[14px] text-muted"><i class="ph ph-check-circle text-primary text-[17px] shrink-0"></i>Spending spike alerts</li>
                <li class="flex items-center gap-3 text-[14px] text-muted"><i class="ph ph-check-circle text-primary text-[17px] shrink-0"></i>Runway increase / decrease tracking</li>
                <li class="flex items-center gap-3 text-[14px] text-muted"><i class="ph ph-check-circle text-primary text-[17px] shrink-0"></i>Savings feedback in plain language</li>
                <li class="flex items-center gap-3 text-[14px] text-muted"><i class="ph ph-check-circle text-primary text-[17px] shrink-0"></i>Monthly &amp; weekly report views</li>
                <li class="flex items-center gap-3 text-[14px] text-muted"><i class="ph ph-check-circle text-primary text-[17px] shrink-0"></i>Usage streaks + consistency reminders</li>
            </ul>
        </div>
    </div>
</section>

<div class="border-t border-surface"></div>

<!-- ── PRIVACY ── -->
<section id="privacy" class="relative overflow-hidden text-center py-[7rem]">
    <!-- large bg wordmark -->
    <div class="absolute inset-0 flex items-center justify-center pointer-events-none select-none overflow-hidden">
        <span class="font-mono font-bold text-[clamp(120px,22vw,260px)] tracking-[0.15em] text-surface leading-none select-none">LUNO</span>
    </div>
    <div class="pointer-events-none bg-[radial-gradient(circle,color-mix(in_srgb,var(--primary)_13%,transparent)_0%,transparent_70%)] absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 rounded-[50%] w-[700px] h-[400px]"></div>

    <div class="max-w-[1100px] mx-auto px-6 relative z-10">
        <div class="anim flex justify-center mb-5">
            <div class="inline-flex items-center justify-center gap-[10px] font-mono text-[11px] tracking-[0.2em] uppercase text-primary before:content-[''] before:block before:w-[18px] before:h-[1px] before:bg-primary before:opacity-60">Privacy First</div>
        </div>
        <h2 class="anim [animation-delay:0.08s] font-extrabold text-fg mb-5 text-[clamp(28px,4.5vw,54px)] leading-[1.1] tracking-[-0.03em]">Your data never<br>leaves your device.</h2>
        <p class="anim [animation-delay:0.16s] text-muted leading-relaxed max-w-[480px] mx-auto mb-10 text-[15px]">Built local-first from day one. Your financial data lives exclusively in SQLite on your device — free or premium. No servers. No accounts. No trackers. Full stop.</p>
        <div class="anim [animation-delay:0.24s] flex flex-wrap gap-3 justify-center">
            <div class="inline-flex items-center gap-[7px] font-mono text-[11px] tracking-[0.06em] text-muted bg-surface border border-surface py-[9px] px-[15px] rounded-[10px] transition-colors duration-150 hover:bg-surf2"><span class="w-[5px] h-[5px] bg-success rounded-full shrink-0"></span>No Cloud Storage</div>
            <div class="inline-flex items-center gap-[7px] font-mono text-[11px] tracking-[0.06em] text-muted bg-surface border border-surface py-[9px] px-[15px] rounded-[10px] transition-colors duration-150 hover:bg-surf2"><span class="w-[5px] h-[5px] bg-success rounded-full shrink-0"></span>No Account Required</div>
            <div class="inline-flex items-center gap-[7px] font-mono text-[11px] tracking-[0.06em] text-muted bg-surface border border-surface py-[9px] px-[15px] rounded-[10px] transition-colors duration-150 hover:bg-surf2"><span class="w-[5px] h-[5px] bg-success rounded-full shrink-0"></span>No Analytics SDK</div>
            <div class="inline-flex items-center gap-[7px] font-mono text-[11px] tracking-[0.06em] text-muted bg-surface border border-surface py-[9px] px-[15px] rounded-[10px] transition-colors duration-150 hover:bg-surf2"><span class="w-[5px] h-[5px] bg-success rounded-full shrink-0"></span>No Ads Ever</div>
            <div class="inline-flex items-center gap-[7px] font-mono text-[11px] tracking-[0.06em] text-muted bg-surface border border-surface py-[9px] px-[15px] rounded-[10px] transition-colors duration-150 hover:bg-surf2"><span class="w-[5px] h-[5px] bg-success rounded-full shrink-0"></span>SQLite On-Device</div>
        </div>
    </div>
</section>

<div class="border-t border-surface"></div>

<!-- ── CTA ── -->
<section id="download" class="relative overflow-hidden text-center py-[7rem]">
    <div class="pointer-events-none bg-[radial-gradient(circle,color-mix(in_srgb,var(--primary)_13%,transparent)_0%,transparent_70%)] absolute bottom-0 left-1/2 -translate-x-1/2 rounded-[50%] w-[700px] h-[500px]"></div>
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[120px] h-[2px] bg-primary opacity-60 rounded-full"></div>

    <div class="max-w-[1100px] mx-auto px-6 relative z-10">
        <div class="anim flex justify-center mb-5">
            <div class="inline-flex items-center justify-center gap-[10px] font-mono text-[11px] tracking-[0.2em] uppercase text-primary before:content-[''] before:block before:w-[18px] before:h-[1px] before:bg-primary before:opacity-60">Get Started</div>
        </div>
        <h2 class="anim [animation-delay:0.08s] font-extrabold text-fg mb-4 text-[clamp(32px,5vw,62px)] leading-[1.05] tracking-[-0.04em]">Download today.<br>No account needed.</h2>
        <p class="anim [animation-delay:0.16s] text-muted leading-relaxed mb-10 text-[15px]">Start tracking for free. Upgrade to premium anytime with a one-time lifetime purchase.</p>
        <div class="anim [animation-delay:0.24s]">
            <a href="https://play.google.com/store/apps/details?id=me.nafish.luno" class="inline-flex items-center gap-[8px] font-sans font-bold tracking-[-0.01em] no-underline border-none cursor-pointer transition-all duration-180 whitespace-nowrap text-[17px] py-[16px] px-[34px] rounded-[14px] bg-primary text-bg hover:brightness-[1.08]">
                <i class="ph ph-google-play-logo text-[21px]"></i>
                Get it on Google Play
            </a>
        </div>
        <p class="anim [animation-delay:0.24s] font-mono mt-5 text-[10px] text-dim tracking-[0.14em] uppercase">Android 8.0+ Required &middot; Free Core Features</p>
    </div>
</section>

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-L39J4VVHHC"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'G-L39J4VVHHC');
</script>

<?php include_once __DIR__ . '/includes/footer.php'; ?>
