<style>
    .fi-body {
        background: #f7f8fa;
    }

    .fi-main-ctn {
        max-width: 100%;
    }

    .fi-header,
    .fi-ta-ctn,
    .fi-section {
        box-shadow: 0 12px 32px rgb(8 47 107 / 0.05);
    }

    .fi-sidebar-header {
        min-height: 5.75rem;
        padding: 0.8rem 1rem;
        background:
            radial-gradient(circle at 85% 0%, rgb(22 191 232 / 0.35), transparent 9rem),
            linear-gradient(135deg, #061f49, #0b428d 68%, #1456a0);
        box-shadow: inset 0 -1px rgb(255 255 255 / 0.12);
    }

    .fi-sidebar-header .fi-logo {
        color: #fff;
        width: 100%;
    }

    .cic-admin-brand {
        width: 100%;
        min-height: 4.25rem;
        display: inline-flex;
        align-items: center;
        gap: 0.85rem;
        color: #fff;
        line-height: 1.1;
        text-decoration: none;
    }

    .cic-admin-brand > img {
        width: 3.7rem;
        height: 3.7rem;
        flex: 0 0 auto;
        padding: 0.3rem;
        background: #fff;
        border-radius: 999px;
        object-fit: contain;
        box-shadow: 0 6px 16px rgb(0 0 0 / 0.28);
        outline: 1px solid rgb(255 255 255 / 0.4);
    }

    .cic-admin-brand-copy {
        display: grid;
        min-width: 0;
        gap: 0.2rem;
    }

    .cic-admin-brand-copy strong {
        color: #fff;
        font-size: 1.02rem;
        font-weight: 800;
        letter-spacing: -0.02em;
        line-height: 1.1;
    }

    .cic-admin-brand-copy small {
        color: #c9f5ff;
        font-size: 0.62rem;
        font-weight: 600;
        letter-spacing: 0.03em;
        line-height: 1.2;
    }

    .cic-admin-brand-copy small:last-child {
        color: #e0efff;
        font-size: 0.57rem;
    }

    .fi-topbar {
        min-height: 4.25rem;
        border-bottom: 1px solid rgb(20 86 160 / 0.12);
        background: rgb(255 255 255 / 0.94);
        box-shadow: 0 6px 20px rgb(8 47 107 / 0.05);
        backdrop-filter: blur(12px);
    }

    .fi-topbar .fi-icon-btn,
    .fi-topbar button {
        transition: background-color 180ms ease, color 180ms ease, box-shadow 180ms ease;
    }

    .fi-topbar .fi-icon-btn:hover,
    .fi-topbar .fi-icon-btn:focus-visible,
    .fi-topbar button:hover,
    .fi-topbar button:focus-visible {
        background: #eaf6ff;
        color: #1456a0;
        box-shadow: 0 4px 12px rgb(8 47 107 / 0.1);
    }

    .fi-wi-stats {
        gap: 1rem;
    }

    .fi-wi-stats > .fi-wi-stats-stat {
        border: 1px solid rgb(20 86 160 / 0.1);
        border-radius: 1.25rem;
        box-shadow: 0 10px 28px rgb(8 47 107 / 0.08);
        transition: transform 180ms ease, box-shadow 180ms ease;
    }

    .fi-wi-stats > .fi-wi-stats-stat:hover {
        box-shadow: 0 14px 30px rgb(8 47 107 / 0.14);
        transform: translateY(-3px);
    }

    .fi-ta-ctn,
    .fi-section {
        border-radius: 1.25rem;
    }

    .cic-admin-hero {
        position: relative;
        overflow: hidden;
        padding: 1.65rem;
        color: #fff;
        background: linear-gradient(135deg, #082f6b 0%, #1456a0 65%, #16bfe8 150%);
        border-radius: 1.25rem;
        box-shadow: 0 16px 34px rgb(8 47 107 / 0.18);
    }

    .cic-admin-hero > *:not(.cic-admin-hero-orb) {
        position: relative;
        z-index: 1;
    }

    .cic-admin-hero-content {
        display: grid;
        gap: 1.25rem;
    }

    .cic-admin-hero-orb {
        position: absolute;
        border-radius: 999px;
        opacity: 0.18;
        filter: blur(2px);
    }

    .cic-admin-hero-orb-yellow {
        top: -5rem;
        right: 8%;
        width: 13rem;
        height: 13rem;
        background: #f4d20b;
    }

    .cic-admin-hero-orb-cyan {
        right: -4rem;
        bottom: -7rem;
        width: 16rem;
        height: 16rem;
        background: #16bfe8;
    }

    .cic-admin-action-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 0.75rem;
    }

    .cic-admin-action-card {
        display: flex;
        min-width: 0;
        align-items: center;
        gap: 0.75rem;
        padding: 0.85rem;
        border-color: rgb(255 255 255 / 0.25);
        border-radius: 0.9rem;
        background: rgb(255 255 255 / 0.1);
        transition: transform 180ms ease, background-color 180ms ease, box-shadow 180ms ease;
    }

    .cic-admin-action-card > span:last-child {
        display: grid;
        min-width: 0;
        gap: 0.2rem;
    }

    .cic-admin-action-card strong,
    .cic-admin-action-card small {
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .cic-admin-action-card strong {
        font-size: 0.8rem;
    }

    .cic-admin-action-card small {
        color: #dbeafe;
        font-size: 0.65rem;
    }

    .cic-admin-action-number {
        display: grid;
        width: 2rem;
        height: 2rem;
        flex: 0 0 auto;
        place-items: center;
        border-radius: 999px;
        background: rgb(255 255 255 / 0.18);
        color: #fff;
        font-size: 0.85rem;
        font-weight: 800;
    }

    .cic-admin-action-card:hover,
    .cic-admin-action-card:focus-visible {
        background: rgb(255 255 255 / 0.2);
        box-shadow: 0 10px 20px rgb(8 47 107 / 0.18);
        transform: translateY(-3px);
    }

    .cic-review-column {
        padding: 1rem;
        border: 1px solid rgb(148 163 184 / 0.2);
        border-top: 3px solid #16bfe8;
        border-radius: 1rem;
        background: #f8fbff;
    }

    .cic-review-heading {
        display: grid;
        grid-template-columns: auto minmax(0, 1fr) auto;
        align-items: center;
        gap: 0.65rem;
    }

    .cic-review-heading h3 {
        margin: 0;
        color: #0f172a;
        font-size: 0.85rem;
        font-weight: 750;
    }

    .cic-review-heading p {
        margin: 0.2rem 0 0;
        color: #64748b;
        font-size: 0.68rem;
    }

    .cic-review-icon,
    .cic-review-count {
        display: grid;
        place-items: center;
        border-radius: 999px;
        font-weight: 800;
    }

    .cic-review-icon {
        width: 2rem;
        height: 2rem;
        color: #0369a1;
        background: #e0f2fe;
        font-size: 0.9rem;
    }

    .cic-review-count {
        min-width: 1.8rem;
        height: 1.8rem;
        padding: 0 0.45rem;
        color: #0369a1;
        background: #e0f2fe;
        font-size: 0.75rem;
    }

    .cic-review-column-warning .cic-review-icon,
    .cic-review-column-warning .cic-review-count {
        color: #a16207;
        background: #fef3c7;
    }

    .cic-review-column-danger .cic-review-icon,
    .cic-review-column-danger .cic-review-count {
        color: #b91c1c;
        background: #fee2e2;
    }

    .cic-review-items {
        display: grid;
        gap: 0.5rem;
        margin-top: 0.85rem;
    }

    .cic-review-item {
        display: grid;
        gap: 0.35rem;
        min-width: 0;
        padding: 0.7rem 0.75rem;
        border: 1px solid #e2e8f0;
        border-radius: 0.75rem;
        background: #fff;
        transition: transform 180ms ease, border-color 180ms ease, box-shadow 180ms ease;
    }

    .cic-review-item:hover,
    .cic-review-item:focus-visible {
        border-color: #38bdf8;
        box-shadow: 0 6px 14px rgb(8 47 107 / 0.1);
        transform: translateY(-2px);
    }

    .cic-review-item-title {
        overflow: hidden;
        color: #0f172a;
        font-size: 0.76rem;
        font-weight: 700;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .cic-review-item-meta {
        display: flex;
        justify-content: space-between;
        gap: 0.5rem;
        color: #64748b;
        font-size: 0.64rem;
    }

    .cic-review-item-meta b {
        overflow: hidden;
        font-weight: 600;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .cic-review-empty {
        display: grid;
        justify-items: center;
        gap: 0.45rem;
        min-height: 7rem;
        padding: 1rem;
        place-content: center;
        border: 1px dashed #cbd5e1;
        border-radius: 0.75rem;
        color: #64748b;
        text-align: center;
    }

    .cic-review-empty > span {
        display: grid;
        width: 1.8rem;
        height: 1.8rem;
        place-items: center;
        border-radius: 999px;
        background: #dcfce7;
        color: #15803d;
        font-weight: 800;
    }

    .cic-review-empty p {
        margin: 0;
        font-size: 0.7rem;
    }

    .cic-review-column-warning {
        border-top-color: #f4b400;
    }

    .cic-review-column-danger {
        border-top-color: #e51c2a;
    }

    .cic-review-column a {
        background: #fff;
    }

    .cic-review-column a:hover,
    .cic-review-column a:focus-visible {
        transform: translateY(-2px);
    }

    .cic-review-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 1rem;
    }

    @media (max-width: 640px) {
        .cic-admin-brand > img {
            width: 3rem;
            height: 3rem;
        }

        .cic-admin-brand-copy strong {
            font-size: 0.86rem;
        }

        .cic-admin-brand-copy small {
            font-size: 0.56rem;
        }

        .cic-admin-hero {
            padding: 1.25rem;
        }

        .cic-admin-action-grid,
        .cic-review-grid {
            grid-template-columns: 1fr;
        }

        .cic-review-heading p {
            font-size: 0.63rem;
        }
    }

    @media (min-width: 641px) and (max-width: 1100px) {
        .cic-admin-action-grid,
        .cic-review-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (prefers-reduced-motion: reduce) {
        .fi-wi-stats > .fi-wi-stats-stat,
        .cic-admin-action-card,
        .cic-review-item {
            transition: none;
        }
    }
</style>
