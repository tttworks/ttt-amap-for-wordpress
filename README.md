<p align="center">
  <img src="assets/logo.png" alt="TTTWorks" width="260">
</p>

# TTT AMap for WordPress

**An AMap (高德地图) widget for Elementor** — for sites whose audience can't use Google Maps.

---

## Why it exists

Google Maps is not available to users in mainland China, yet most WordPress map widgets
are built around it. This widget targets **AMap (高德)** — the mapping service that actually
works for a Chinese audience — and gives editors a native Elementor settings panel instead
of a shortcode to memorise.

---

## What it does

- Elementor widget registration with a full controls panel (not a shortcode)
- API key field, map controls, info-window behaviour, navigation-link toggle
- Icon height / style controls
- Ships as a **snippet** — no plugin packaging, no wp.org release

---

## Iteration record

Version **1.0.9** — nine revisions over a single working session, tracked in the source header:

```
v1.0.9  info window default-open toggle (default: closed)
v1.0.8  navigation link visibility toggle
v1.0.7  map controls added
v1.0.6  icon height supports auto
v1.0.5  API key setting added
v1.0.4  style refinements
v1.0.3  fixes
v1.0.2  feature additions
v1.0.1  fix — widget was not searchable in the Elementor panel
v1.0.0  initial version
```

---

## What this repository is

**Production code, published to show how we build.**

- This is a **snippet**, not an installable plugin. No activation flow, no wp.org release.
- **No installation guide. No support. No portability guarantee.**
- Code assumes an Elementor-based WordPress stack and our own conventions.

---

## License

Apache License 2.0 — permissive, **commercial use permitted**, trademark rights not granted. See [LICENSE](LICENSE).

---

**[TTTWorks](https://tttworks.com)** — Production WordPress engineering.
