---
name: TinaTheme
description: A modern, minimal, content-first Typecho theme with native dark mode.
colors:
  primary: "#5183f5"
  primary-darker: "#364fc7"
  background: "#ffffff"
  surface: "#f1f4f8"
  surface-hover: "#e1e6ed"
  text-primary: "#343a40"
  text-body: "#495057"
  text-secondary: "#60656c"
  text-muted: "#858b93"
  border: "#d6d9de"
  navbar-bg: "#ffffff"
  blockquote-bg: "#f9f9f9"
  blockquote-border: "#e3e6eb"
  selection-bg: "#3b5bdb"
  selection-text: "#ffffff"
  dark-background: "#1f2022"
  dark-surface: "#2d2d31"
  dark-surface-hover: "#3b3b3e"
  dark-text-primary: "#ffd479"
  dark-text-body: "#dfdfdf"
  dark-text-secondary: "#dee2e6"
  dark-text-muted: "#868e96"
  dark-border: "#404040"
  dark-navbar-bg: "#1d1d1d"
  dark-blockquote-bg: "#2b2b2b"
  dark-blockquote-border: "#191919"
  dark-primary: "#6ab0f3"
  dark-primary-darker: "#4a72a5"
typography:
  display:
    fontFamily: '-apple-system, BlinkMacSystemFont, "helvetica neue", roboto, Roboto, Arial, "noto sans", sans-serif, "apple color emoji", "segoe ui", "segoe ui emoji", "segoe ui symbol", "noto color emoji"'
    fontSize: "clamp(2rem, 5vw, 3rem)"
    fontWeight: 700
    lineHeight: 1.1
    letterSpacing: normal
  headline:
    fontFamily: '-apple-system, BlinkMacSystemFont, "helvetica neue", roboto, Roboto, Arial, "noto sans", sans-serif, "apple color emoji", "segoe ui", "segoe ui emoji", "segoe ui symbol", "noto color emoji"'
    fontSize: "clamp(1.75rem, 4vw, 1.9rem)"
    fontWeight: 700
    lineHeight: 1.2
    letterSpacing: normal
  title:
    fontFamily: '-apple-system, BlinkMacSystemFont, "helvetica neue", roboto, Roboto, Arial, "noto sans", sans-serif, "apple color emoji", "segoe ui", "segoe ui emoji", "segoe ui symbol", "noto color emoji"'
    fontSize: "clamp(1.5rem, 3vw, 1.7rem)"
    fontWeight: 600
    lineHeight: 1.2
    letterSpacing: normal
  body:
    fontFamily: '-apple-system, BlinkMacSystemFont, "helvetica neue", roboto, Roboto, Arial, "noto sans", sans-serif, "apple color emoji", "segoe ui", "segoe ui emoji", "segoe ui symbol", "noto color emoji"'
    fontSize: "1rem"
    fontWeight: 400
    lineHeight: 1.75
    letterSpacing: normal
  label:
    fontFamily: '-apple-system, BlinkMacSystemFont, "helvetica neue", roboto, Roboto, Arial, "noto sans", sans-serif, "apple color emoji", "segoe ui", "segoe ui emoji", "segoe ui symbol", "noto color emoji"'
    fontSize: "0.85rem"
    fontWeight: 400
    lineHeight: 1
    letterSpacing: normal
  mono:
    fontFamily: 'Consolas, Monaco, Menlo, "dejavu sans mono", "bitstream vera sans mono", "courier new", monospace'
    fontSize: "0.9rem"
    fontWeight: 400
    lineHeight: 1.4
    letterSpacing: normal
rounded:
  sm: "4px"
  md: "0.35rem"
  lg: "8px"
  xl: "12px"
  full: "9999px"
spacing:
  xs: "0.25rem"
  sm: "0.5rem"
  md: "1rem"
  lg: "1.5rem"
  xl: "2rem"
  section: "3.5rem"
components:
  button-primary:
    backgroundColor: "{colors.primary}"
    textColor: "#ffffff"
    rounded: "{rounded.md}"
    padding: "0.3rem 0.6rem"
  button-primary-hover:
    backgroundColor: "{colors.primary-darker}"
    textColor: "#ffffff"
    rounded: "{rounded.md}"
    padding: "0.3rem 0.6rem"
  button-secondary:
    backgroundColor: "#edf2ff"
    textColor: "#3b5bdb"
    rounded: "{rounded.md}"
    padding: "0.3rem 0.6rem"
  button-secondary-hover:
    backgroundColor: "{colors.primary-darker}"
    textColor: "#ffffff"
    rounded: "{rounded.md}"
    padding: "0.3rem 0.6rem"
  tag:
    backgroundColor: "{colors.surface}"
    textColor: "{colors.text-body}"
    rounded: "{rounded.sm}"
    padding: "0.5rem 0.6rem"
  tag-hover:
    backgroundColor: "{colors.surface-hover}"
    textColor: "{colors.text-primary}"
    rounded: "{rounded.sm}"
    padding: "0.5rem 0.6rem"
  navbar-link:
    backgroundColor: "transparent"
    textColor: "{colors.text-body}"
    rounded: "{rounded.md}"
    padding: "0.75rem 1.25rem"
  navbar-link-hover:
    backgroundColor: "{colors.surface}"
    textColor: "{colors.text-primary}"
    rounded: "{rounded.md}"
    padding: "0.75rem 1.25rem"
  toc-container:
    backgroundColor: "{colors.background}"
    textColor: "{colors.text-body}"
    rounded: "{rounded.xl}"
    padding: "16px"
  back-to-top:
    backgroundColor: "{colors.primary}"
    textColor: "#ffffff"
    rounded: "{rounded.full}"
    size: "3rem"
---

# Design System: TinaTheme

## 1. Overview

**Creative North Star: "The Midnight IDE"**

TinaTheme 的视觉系统像一盏深夜写代码时的 IDE：深色背景让内容浮出，语法高亮点到为止，整个界面只为聚焦而存在。它把技术博客的阅读体验当成核心产品来设计——没有营销页面的喧哗，也没有极简主义的冷漠，而是一种利落、可信、略带温度的工程师审美。

系统从 hugo-tania 继承了大量留白与清晰的排版骨架，但 TinaTheme 通过原生深色模式、琥珀色标题高亮、以及可配置的个人模块（社交图标、项目推荐、首页公告）把它变成了一套有品牌个性的主题。它拒绝 SaaS 奶油/米白营销风、花哨的暗黑霓虹、以及极简到性冷淡的灰白界面。

**Key Characteristics:**
- 内容优先：排版、间距、色彩服务于阅读，不抢夺注意力。
- 明暗双主题：浅色模式干净清晰，深色模式像 IDE 般聚焦。
- 克制但可触：组件在静止时平整，在 hover/focus 时给出明确反馈。
- 高度可配置：后台开关控制导航、社交图标、项目推荐、PJAX、深色模式等功能。
- 轻量快速：系统字体栈、精简依赖、原生响应式布局。

## 2. Colors

The palette is engineered for readability across both light and dark modes, with a single cool-blue accent and an amber signal color reserved for dark-mode headings.

### Primary
- **Engine Blue** (`#5183f5`): The main action color. Used for primary buttons, active TOC links, back-to-top button, link underlines, and interactive accents in light mode.
- **Deep Engine Blue** (`#364fc7`): The hover/pressed state for primary actions and links in light mode.

### Secondary
- **Ice Blue** (`#6ab0f3`): The dark-mode primary accent. Replaces Engine Blue when the user prefers or toggles dark mode.
- **Muted Ice Blue** (`#4a72a5`): Dark-mode hover/pressed state for primary actions.

### Tertiary
- **Amber Signal** (`#ffd479`): Dark-mode heading color. Reserved for `h2` and `h5` headings in dark mode to create a warm, readable focal point without overwhelming the rest of the UI.
- **Soft Lavender** (`#e1a6f2`): Dark-mode link hover color. A subtle shift that keeps the cursor trail readable against dark backgrounds.

### Neutral
- **Paper White** (`#ffffff`): Light-mode page background (`{colors.background}`).
- **Cool Gray 50** (`#f1f4f8`): Light-mode surface color for tags, hover states, navbar hover, blockquote backgrounds, and section separators.
- **Cool Gray 100** (`#e1e6ed`): Hover state for surfaces in light mode.
- **Slate Body** (`#495057`): Light-mode body text (`{colors.text-body}`).
- **Charcoal Heading** (`#343a40`): Light-mode primary heading color (`{colors.text-primary}`).
- **Muted Slate** (`#60656c`): Light-mode secondary text and `h3`/`h4` color.
- **Soft Gray** (`#858b93`): Light-mode meta text, timestamps, and captions.
- **Divider Gray** (`#d6d9de`): Light-mode borders and dividers.
- **Ink Black** (`#1f2022`): Dark-mode page background.
- **Graphite Surface** (`#2d2d31`): Dark-mode surface color.
- **Graphite Hover** (`#3b3b3e`): Dark-mode surface hover state.
- **Off-White Body** (`#dfdfdf`): Dark-mode body text.
- **Pale Silver** (`#ced4da`): Dark-mode primary text and `h1` color.
- **Dark Border** (`#404040`): Dark-mode borders and dividers.

### Named Rules
**The Dark-First Accent Rule.** The amber signal color (`#ffd479`) is only used for dark-mode headings. Never introduce it in light mode; the light theme relies on cool blues and grays to maintain its clean, technical character.

**The One Accent Rule.** Engine Blue / Ice Blue is the only interactive accent. Do not add a second accent color for buttons, links, or focus rings without a strong reason.

## 3. Typography

**Display/Body Font:** `-apple-system, BlinkMacSystemFont, "helvetica neue", roboto, Roboto, Arial, "noto sans", sans-serif, ...`
**Mono Font:** `Consolas, Monaco, Menlo, "dejavu sans mono", ...`

**Character:** A single system sans-serif family carries the entire interface. This keeps the theme lightweight and lets the content—not the typeface—be the personality. The mono stack is reserved for inline code and code blocks, reinforcing the technical blog context without turning the whole site into a "developer costume."

### Hierarchy
- **Display** (700, `clamp(2rem, 5vw, 3rem)`, line-height 1.1): Page-level `h1`, used on article headers and standalone page titles. Max width is constrained by the container (`825px`).
- **Headline** (700, `clamp(1.75rem, 4vw, 1.9rem)`, line-height 1.2): Section `h2` headings with a 4px bottom border in `surface` color.
- **Title** (600, `clamp(1.5rem, 3vw, 1.7rem)`, line-height 1.2): `h3` headings, article titles in post lists, and project names.
- **Body** (400, `1rem`, line-height 1.75): Paragraphs, lists, tables. Comfortable line length is enforced by the `825px` container and `600px` max-width for `.container.page p`.
- **Label** (400, `0.85rem`, line-height 1): Timestamps, meta text, captions, tags.
- **Mono** (400, `0.9rem`, line-height 1.4): Inline code and preformatted blocks.

### Named Rules
**The System-Font Rule.** Never load a custom web font for body or headings. The theme's speed and neutrality depend on the system font stack.

**The Heading-Border Rule.** `h2` headings carry a 4px bottom border in the surface color (`{colors.surface}`). This is the only place a thick decorative border is permitted.

## 4. Elevation

TinaTheme uses a "flat at rest, lift on state" philosophy. Most surfaces sit flat on the page; depth is created through tonal layering (surface colors against background) rather than shadows. Shadows appear sparingly, as a response to state or functional elevation: code blocks and article images sit slightly above the page, the back-to-top button hovers over content, and TOC containers lift on desktop.

### Shadow Vocabulary
- **Diffuse Float** (`box-shadow: rgb(0 0 0 / 30%) 0px 5px 20px`): Used on code blocks, article images, and suggested-post cards. A soft, medium-depth lift that separates media from the page.
- **Button Hover** (`box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2)`): Back-to-top button and floating TOC toggle. Small, purposeful, never decorative.
- **Menu Lift** (`box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08)`): TOC container on desktop. A gentle, high-elevation shadow appropriate for a persistent utility panel.
- **Card Hover** (`box-shadow: 0 5px 15px var(--transparent-bg)`): Link page cards on hover. Lifts only on interaction.

### Named Rules
**The Flat-By-Default Rule.** Surfaces are flat at rest. If you are adding a shadow to a static element, question whether tonal layering or spacing would solve the hierarchy instead.

## 5. Components

Components are tactile and responsive: clear hit areas, visible hover feedback, and rounded corners that feel modern without becoming bubbly.

### Buttons
- **Shape:** Medium rounded corners (`{rounded.md}`, ~5.6px).
- **Primary:** Background Engine Blue (`{colors.primary}`), white text, 2px solid border in the same blue, padding `0.3rem 0.6rem`.
- **Secondary:** Background `#edf2ff`, text `#3b5bdb`, 2px solid border in `#edf2ff`.
- **Hover / Focus:** Both variants shift to Deep Engine Blue (`{colors.primary-darker}`) background with white text and a matching border. Transition is `all 0.3s ease`.

### Tags / Chips
- **Shape:** Small rounded corners (`{rounded.sm}`, 4px).
- **Style:** Background `surface` (`{colors.surface}`), body text color, padding `0.5rem 0.6rem`, no border.
- **State:** Hover background shifts to `surface-hover` (`{colors.surface-hover}`) and text darkens to `text-primary`.

### Navigation
- **Desktop:** Transparent background, links with `{rounded.md}` corners and `0.75rem 1.25rem` padding. Hover/active state uses `surface` background and `text-primary` color.
- **Mobile:** Fixed top navbar with a subtle shadow (`0 3px 13px rgba(100, 110, 140, 0.1), 0 2px 4px rgba(100, 110, 140, 0.15)`), white background, compact padding.
- **Dark Mode:** Navbar background becomes Ink Black (`{colors.dark-navbar-bg}`), links use dark-mode text colors.

### Post List Items
- **Shape:** Full-width rows with a 2px bottom border in `surface` color on mobile.
- **Desktop:** Border becomes transparent; hover adds a `surface` background and `{rounded.md}` corners.
- **Typography:** Title uses `title` scale; date uses `label` scale in muted color.

### Project Cards
- **Shape:** Horizontal row, 2px bottom border in `surface` color on mobile.
- **Layout:** Icon + name on the left, description below, source button on the right.
- **Desktop:** Border removed; hover underlines the project title.

### Table of Contents (TOC)
- **Desktop:** Fixed panel at top-right, width `250px`/`280px`, background Paper White (`{colors.background}`), 1px `border` color border, `{rounded.xl}` (12px) corners, padding `16px`.
- **Mobile:** Floating panel triggered by a toggle button near the back-to-top control, with an overlay backdrop.
- **Active Link:** Left border in primary color, `surface` background, primary text color.

### Back to Top
- **Shape:** Circular (`{rounded.full}`), 3rem × 3rem, fixed bottom-right.
- **Style:** Background primary color, white icon, subtle shadow.
- **State:** Fades in/out and slides up/down with a 0.3s transition.

### Callouts
- **Reply Tip:** `surface` background, 4px left border in primary color, `{rounded.xl}` corners, flex row with icon + text.
- **Copyright Box:** `surface` background, 1px `border` color border, `{rounded.xl}` corners.

## 6. Do's and Don'ts

### Do:
- **Do** keep the system font stack for all body and heading text.
- **Do** use Engine Blue (`{colors.primary}`) as the only interactive accent in light mode.
- **Do** reserve Amber Signal (`{colors.dark-text-primary}`) for dark-mode headings only.
- **Do** rely on tonal layering (`surface` vs. `background`) before reaching for shadows.
- **Do** use `{rounded.md}` for buttons, nav links, and post rows; `{rounded.sm}` for tags; `{rounded.xl}` for TOC and callouts.
- **Do** respect `prefers-color-scheme` and the user's manual dark-mode toggle.
- **Do** keep container max-width at `825px` for comfortable reading line length.

### Don't:
- **Don't** use warm beige/cream body backgrounds or SaaS landing-page card grids. The system is intentionally cool and technical.
- **Don't** introduce neon purple/cyan accents, glassmorphism, or high-contrast gamer aesthetics.
- **Don't** reduce the interface to flat gray-on-white minimalism. Surface colors, heading borders, and accent feedback provide necessary character.
- **Don't** add tiny uppercase tracked eyebrows above every section heading.
- **Don't** use numbered section markers (`01 / 02 / 03`) unless the section is genuinely a sequential flow.
- **Don't** use border-left or border-right greater than 1px as a decorative accent on cards, lists, or callouts. The 4px left border on `.reply-tip` is the sole exception and is functional, not decorative.
- **Don't** load custom web fonts without a strong brand reason; the theme's speed depends on system fonts.
- **Don't** animate layout properties. Use transform and opacity for motion.
- **Don't** gate content visibility on scroll-triggered animations; content must be visible by default.
