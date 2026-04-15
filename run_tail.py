import re
with open('privacy.php', 'r') as f:
    text = f.read()

replacements = {
    'class="page-wrap"': 'class="max-w-[740px] mx-auto px-[20px] sm:px-[32px] py-[60px] sm:py-[80px]"',
    'class="page-header"': 'class="mb-[60px] pb-[40px] border-b border-surface"',
    'class="page-tag"': 'class="font-mono text-[11px] text-primary tracking-[0.1em] uppercase mb-[16px]"',
    '<h1>': '<h1 class="text-[clamp(36px,5vw,52px)] font-extrabold tracking-[-0.03em] leading-[1.1] mb-[16px]">',
    '<div class="page-header">\n    <div class="page-tag">Legal</div>\n    <h1 class="text-[clamp(36px,5vw,52px)] font-extrabold tracking-[-0.03em] leading-[1.1] mb-[16px]">Privacy Policy</h1>\n    <p>': '<div class="mb-[60px] pb-[40px] border-b border-surface">\n    <div class="font-mono text-[11px] text-primary tracking-[0.1em] uppercase mb-[16px]">Legal</div>\n    <h1 class="text-[clamp(36px,5vw,52px)] font-extrabold tracking-[-0.03em] leading-[1.1] mb-[16px]">Privacy Policy</h1>\n    <p class="text-[15px] text-muted">',
    'class="effective"': 'class="inline-block font-mono text-[11px] text-dim bg-card border border-surface rounded-[6px] py-[5px] px-[12px] mt-[16px] tracking-[0.05em]"',
    'class="highlight"': 'class="bg-[color-mix(in_srgb,var(--primary)_6%,transparent)] border border-[color-mix(in_srgb,var(--primary)_20%,transparent)] rounded-[12px] py-[24px] px-[28px] my-[36px] [&>p]:text-[15px] [&>p]:text-fg [&>p]:leading-[1.7] [&>p>strong]:text-primary"',
    'class="doc-section"': 'class="mb-[48px] [&>h2]:text-[22px] [&>h2]:font-bold [&>h2]:tracking-[-0.02em] [&>h2]:mb-[16px] [&>h2]:pt-[8px] [&>h2]:text-fg [&>h3]:text-[17px] [&>h3]:font-semibold [&>h3]:tracking-[-0.01em] [&>h3]:mt-[24px] [&>h3]:mb-[10px] [&>h3]:text-fg [&>p]:text-[15px] [&>p]:text-muted [&>p]:leading-[1.75] [&>p]:mb-[14px] [&>ul]:pl-[20px] [&>ul]:mb-[14px] [&>ol]:pl-[20px] [&>ol]:mb-[14px] [&_li]:text-[15px] [&_li]:text-muted [&_li]:leading-[1.7] [&_li]:mb-[6px] [&_li::marker]:text-primary"',
    'class="divider"': 'class="border-0 border-t border-surface my-[48px]"',
    'class="contact-card"': 'class="bg-card border border-surface rounded-[12px] py-[28px] px-[32px] mt-[40px] [&>h3]:text-[18px] [&>h3]:font-bold [&>h3]:mb-[8px] [&>p]:text-[14px] [&>p]:text-muted [&>p]:mb-[4px]"',
}

for k, v in replacements.items():
    text = text.replace(k, v)

with open('privacy.php', 'w') as f:
    f.write(text)

with open('terms.php', 'r') as f:
    text = f.read()

replacements['<div class="page-header">\n    <div class="page-tag">Legal</div>\n    <h1 class="text-[clamp(36px,5vw,52px)] font-extrabold tracking-[-0.03em] leading-[1.1] mb-[16px]">Terms of Service</h1>\n    <p>'] = '<div class="mb-[60px] pb-[40px] border-b border-surface">\n    <div class="font-mono text-[11px] text-primary tracking-[0.1em] uppercase mb-[16px]">Legal</div>\n    <h1 class="text-[clamp(36px,5vw,52px)] font-extrabold tracking-[-0.03em] leading-[1.1] mb-[16px]">Terms of Service</h1>\n    <p class="text-[15px] text-muted">'

for k, v in replacements.items():
    text = text.replace(k, v)

with open('terms.php', 'w') as f:
    f.write(text)

print("Done!")
