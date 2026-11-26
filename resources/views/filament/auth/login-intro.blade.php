<div class="cic-login-intro">
    <div class="cic-login-orb cic-login-orb-blue"></div>
    <div class="cic-login-orb cic-login-orb-cyan"></div>
    <div class="cic-login-brand">
        <div class="cic-login-logo">
            <img src="{{ asset('images/cic-logo.png') }}" alt="City of Ilagan College seal">
        </div>
        <div>
            <p class="cic-login-kicker">CIC Content Management</p>
            <h1>Welcome back.</h1>
            <p class="cic-login-copy">Sign in to manage stories, announcements, and the CIC digital experience.</p>
        </div>
    </div>
</div>

<style>
    .cic-login-intro {
        position: relative;
        overflow: hidden;
        margin: -1.5rem -1.5rem 1.5rem;
        padding: 1.5rem;
        color: #fff;
        background: linear-gradient(135deg, #082f6b 0%, #1456a0 62%, #16bfe8 160%);
        border-radius: 1rem 1rem 0 0;
    }

    .cic-login-brand {
        position: relative;
        z-index: 1;
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .cic-login-logo {
        display: grid;
        flex: 0 0 auto;
        width: 4rem;
        height: 4rem;
        place-items: center;
        background: #fff;
        border-radius: 999px;
        box-shadow: 0 10px 24px rgb(8 47 107 / 0.25);
        transition: transform 220ms ease, box-shadow 220ms ease;
    }

    .cic-login-logo:hover {
        transform: rotate(-5deg) scale(1.06);
        box-shadow: 0 14px 28px rgb(8 47 107 / 0.35);
    }

    .cic-login-logo img {
        width: 3.25rem;
        height: 3.25rem;
        object-fit: contain;
    }

    .cic-login-kicker {
        margin: 0;
        color: #9deeff;
        font-size: 0.68rem;
        font-weight: 700;
        letter-spacing: 0.16em;
        text-transform: uppercase;
    }

    .cic-login-intro h1 {
        margin: 0.2rem 0 0;
        font-size: 1.7rem;
        font-weight: 700;
        letter-spacing: -0.03em;
    }

    .cic-login-copy {
        max-width: 28rem;
        margin: 0.35rem 0 0;
        color: #dbeafe;
        font-size: 0.82rem;
        line-height: 1.5;
    }

    .cic-login-orb {
        position: absolute;
        border-radius: 999px;
        opacity: 0.22;
        filter: blur(2px);
    }

    .cic-login-orb-blue {
        top: -5rem;
        right: -3rem;
        width: 12rem;
        height: 12rem;
        background: #f4d20b;
    }

    .cic-login-orb-cyan {
        right: 30%;
        bottom: -6rem;
        width: 10rem;
        height: 10rem;
        background: #16bfe8;
    }

    @media (prefers-reduced-motion: reduce) {
        .cic-login-logo {
            transition-duration: 0.01ms;
        }
    }
</style>
