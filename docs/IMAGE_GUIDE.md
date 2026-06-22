# Image Guide — Mausé Reserve

This document describes recommended image sizes, naming conventions, compression tips, and style guidance for the Mausé Reserve website.

## Recommended sizes (pixel width x height)
- Hero (full-bleed): 1600 x 600 (desktop). Provide 1200x450 and 800x300 for smaller breakpoints.
- Menu item: 800 x 600 (square-ish). Provide 400x300 thumbnails.
- Gallery thumb: 600 x 400
- Gallery full: 1600 x 1000 (or larger depending on crop)
- Blog feature: 900 x 500
- Event image: 800 x 450
- Testimonial avatar: 120 x 120

## Which image goes where
- `public/images/hero/hero.*` — site hero imagery
- `public/images/menu/*.jpg|webp|png` — menu item images
- `public/images/gallery/*` — gallery thumbnails and originals
- `public/images/blog/*` — blog feature images
- `public/images/events/*` — event images
- `public/images/placeholders/*` — generic placeholders and avatars

## Naming convention
- Use lowercase, hyphen-separated names: `origin-ethiopia-ethiopia-wash-2026.jpg`
- Include short descriptors and year when appropriate: `latte-art-2024.jpg`
- For variants, append the size: `latte-art-800x600.jpg` or use directory structure

## Compression and formats
- Prefer WebP for best quality/size tradeoff. Provide JPG fallback if needed.
- Target visual quality of 75-85 for JPEG; use lossless-ish WebP for hero or large images if needed.
- Tools: `squoosh`, `imagemin`, `cjpeg`, or web-based compressors.

## Delivery and performance
- Provide responsive `srcset` where possible (e.g., `image-800.jpg 800w, image-1600.jpg 1600w`).
- Lazy-load offscreen images with `loading="lazy"`.
- Consider using a CDN for production hosting.

## Visual style suggestions
- Premium coffee photography: warm tones, soft highlights, shallow depth of field.
- Interiors: wide shots that capture cozy seating and hospitality.
- Barista/latte art: close-ups, detailed textures, and movement.
- Bakery/pastries: natural light, appetizing compositions.

## Accessibility
- Always provide meaningful `alt` text.
- Decorative images may use empty `alt=""` to hide from screen readers.

## Notes
- Store originals and generate optimized derivatives for web use.
- Keep file size under 200 KB when possible for thumbnails and under 500 KB for hero images unless high-res photography is required.

