---
name: frontend-design
description: "Use when designing or implementing the responsive CIC college promotional website with Blade, Tailwind CSS 4, Vite, accessible navigation, public pages, article layouts, announcements, galleries, or mobile styling. Inspect installed versions and official documentation before using version-specific APIs."
---

# Frontend Design

## Before editing

1. Inspect `package.json`, `resources/css/app.css`, `resources/js/app.js`, Vite configuration, existing Blade layouts, and available assets.
2. Confirm installed Tailwind, Vite, and Laravel Vite plugin versions with the lockfile/package manager.
3. Consult the matching [Tailwind CSS documentation](https://tailwindcss.com/docs), [Vite guide](https://vite.dev/guide/), and [Laravel Vite documentation](https://laravel.com/docs/13.x/vite) before using version-specific syntax. Do not assume Tailwind v3 conventions work in this Tailwind v4 project.
4. Do not invent official CIC facts, programs, dates, fees, or contact details. Use clearly labeled placeholders until content is verified.

## Design procedure

1. Establish a shared Blade shell with semantic landmarks, a consistent container, typography scale, focus states, and responsive navigation.
2. Design mobile-first, then add breakpoints for tablet and desktop. Test narrow screens, long titles, missing images, and keyboard navigation.
3. Use Tailwind utilities and existing build conventions. Keep repeated patterns in Blade components or partials rather than copying long class strings.
4. Prioritize a credible college visual hierarchy: strong hero/action area, admissions and contact paths, readable article cards, clear announcement status, and restrained image treatment.
5. Use responsive images with meaningful `alt` text. Decorative images use empty alt text; editorial images use stored captions and approved alt text.
6. Keep public content escaped by default. Do not place untrusted HTML in classes, attributes, URLs, or `@style`.
7. Prevent duplicate content where featured announcements and latest articles overlap. Represent expired announcements according to server-side query results, not client-only hiding.
8. Apply the shared CIC motion language across interactive surfaces: use the reusable `cic-action`, `cic-interactive`, `cic-image-frame`, and `cic-reveal` classes from `resources/css/app.css` for buttons, cards, image panels, and entrance moments. Keep effects purposeful and add `prefers-reduced-motion` support.
9. Run `npm run build`, then inspect the rendered pages in a browser when available. Check console errors, broken assets, overflow, contrast, focus order, touch targets, and reduced-motion behavior.

## Example patterns

```blade
<a href="{{ route('articles.show', $article) }}"
   class="focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-700">
    {{ $article->title }}
</a>
```

```blade
@if ($article->cover_image_path)
    <img src="{{ Storage::url($article->cover_image_path) }}"
         alt="{{ $article->cover_image_alt }}"
         loading="lazy">
@endif
```

## Verification checklist

- [ ] Tailwind/Vite versions and official docs were checked.
- [ ] Layout works at mobile, tablet, and desktop widths without horizontal scrolling.
- [ ] Keyboard focus, labels, contrast, alt text, and semantic headings are correct.
- [ ] Public text and URLs are escaped and validated.
- [ ] Empty, expired, and image-missing states are intentional.
- [ ] Interactive surfaces have consistent motion without distracting or inaccessible effects.
- [ ] Reduced-motion preferences disable nonessential animations.
- [ ] `npm run build` passes and browser checks find no console or asset errors.
