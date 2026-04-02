# Luno Website - Production-Ready Structure

## 📁 Project Organization

```
luno.nafish.lo/
├── index.php                 # Homepage
├── privacy.php               # Privacy Policy page
├── terms.php                 # Terms of Service page
│
├── includes/                 # PHP include files
│   ├── config.php            # Shared configuration (paths, URLs, constants)
│   ├── header.php            # Shared header/navigation component
│   └── footer.php            # Shared footer component
│
├── assets/                   # Static assets
│   ├── css/
│   │   └── styles.css        # Global stylesheet
│   └── images/
│       ├── mint_fresh_1.png
│       ├── mint_fresh_2.png
│       ├── mint_fresh_3.png
│       ├── mint_fresh_4.png
│       └── mint_fresh_5.png
│
└── README.md                 # This file
```

## 🎯 Architecture Benefits

### Shared Components
- **Header** (`includes/header.php`): Single header/navigation shared across all pages
- **Footer** (`includes/footer.php`): Consistent footer on all pages
- **Config** (`includes/config.php`): Centralized paths, URLs, and configuration

### Unified Styling
- **Global CSS** (`assets/css/styles.css`): All styles in one file
- Consistent design system across all pages
- Easy to maintain and update
- Responsive design built-in

### Organized Assets
- Images properly organized in `assets/images/`
- CSS isolated in `assets/css/`
- Scalable structure for future additions

## 🚀 How It Works

### Page Template Flow
Each page follows this pattern:

```php
<?php
// Set page-specific variables
$page_title = 'Page Title';
$page_meta = 'Page description';

// Include shared header (includes nav + styles)
include_once __DIR__ . '/includes/header.php';
?>

<!-- Page-specific content -->

<?php
// Include shared footer
include_once __DIR__ . '/includes/footer.php';
?>
```

### Dynamic Navigation
The header automatically:
- Creates proper navigation based on current page
- Shows "Back to Home" link on non-index pages
- Displays full navigation on homepage
- Uses PHP constants for all URLs

### Asset References
All assets use dynamic paths via PHP constants:
```php
<?php echo IMG_URL; ?>/mint_fresh_1.png  // Images
<?php echo CSS_URL; ?>/styles.css         // Stylesheets
```

## 📝 Adding New Pages

To add a new page:

1. Create `new-page.php` in root
2. Add at the top:
```php
<?php
$page_title = 'New Page Title';
$page_meta = 'Description for meta tags';
include_once __DIR__ . '/includes/header.php';
?>
```
3. Add your page content
4. Close with:
```php
<?php include_once __DIR__ . '/includes/footer.php'; ?>
```

## 🎨 Styling

All styles are in `assets/css/styles.css`:
- Color variables defined in `:root`
- Mobile-responsive design (768px breakpoint)
- Sections clearly organized with comments
- Easy to customize colors and spacing

### Customization
Edit CSS variables in `styles.css`:
```css
:root {
  --accent: #86C53C;      /* Change primary color */
  --text: #EDF3E0;        /* Change text color */
  --mono: 'JetBrains Mono', monospace;  /* Change font */
}
```

## 🔧 Configuration

Edit `includes/config.php` to:
- Change base URLs
- Update site title/description
- Add new path constants
- Modify page detection logic

## ✨ Best Practices Applied

✅ **No Duplicate Code** - Header, footer, and styles shared across all pages
✅ **Maintainable** - Single source of truth for design and navigation
✅ **Scalable** - Easy to add new pages or components
✅ **SEO-Friendly** - Dynamic meta tags per page
✅ **Production-Ready** - Organized folder structure, clean code
✅ **Responsive** - Mobile-first design, works on all devices
✅ **Performance** - Single CSS file, efficient asset loading

## 🔄 Future Improvements

- Add database for dynamic content
- Implement analytics
- Create admin panel for content management
- Add sitemap.xml generation
- Implement caching strategies
- Add minification for production

## 📞 Support

For questions or improvements, contact: hello@nafish.me
