function rgbToHsv(r, g, b) {
    r /= 255;
    g /= 255;
    b /= 255;

    const cMax = Math.max(r, g, b);
    const cMin = Math.min(r, g, b);
    const delta = cMax - cMin;

    let h, s, v;

    if (delta === 0) {
        h = 0;
    } else if (cMax === r) {
        h = 60 * (((g - b) / delta) % 6);
    } else if (cMax === g) {
        h = 60 * (((b - r) / delta) + 2);
    } else {
        h = 60 * (((r - g) / delta) + 4);
    }

    if (cMax === 0) {
        s = 0;
    } else {
        s = delta / cMax;
    }

    v = cMax;

    return [Math.round(h), Math.round(s * 100), Math.round(v * 100)];
}

function hsvToRgb(h, s, v) {
    s /= 100;
    v /= 100;

    let r, g, b;

    const c = v * s;
    const x = c * (1 - Math.abs(((h / 60) % 2) - 1));
    const m = v - c;

    if (h >= 0 && h < 60) {
        [r, g, b] = [c, x, 0];
    } else if (h >= 60 && h < 120) {
        [r, g, b] = [x, c, 0];
    } else if (h >= 120 && h < 180) {
        [r, g, b] = [0, c, x];
    } else if (h >= 180 && h < 240) {
        [r, g, b] = [0, x, c];
    } else if (h >= 240 && h < 300) {
        [r, g, b] = [x, 0, c];
    } else {
        [r, g, b] = [c, 0, x];
    }

    r = Math.round((r + m) * 255);
    g = Math.round((g + m) * 255);
    b = Math.round((b + m) * 255);

    return [r, g, b];
}

function rgbToCmyk(r, g, b) {
    const rNorm = r / 255;
    const gNorm = g / 255;
    const bNorm = b / 255;

    const k = 1 - Math.max(rNorm, gNorm, bNorm);
    let c, m, y;

    if (k === 1) {
        [c, m, y] = [0, 0, 0];
    } else {
        c = (1 - rNorm - k) / (1 - k);
        m = (1 - gNorm - k) / (1 - k);
        y = (1 - bNorm - k) / (1 - k);
    }

    return [Math.round(c * 100), Math.round(m * 100), Math.round(y * 100), Math.round(k * 100)];
}

function cmykToRgb(c, m, y, k) {
    let r, g, b;

    if (c <= 0 && m <= 0 && y <= 0 && k <= 0) {
        [r, g, b] = [0, 0, 0];
    } else {
        c /= 100;
        m /= 100;
        y /= 100;
        k /= 100;

        r = 255 * (1 - c) * (1 - k);
        g = 255 * (1 - m) * (1 - k);
        b = 255 * (1 - y) * (1 - k);
    }

    return [Math.round(r), Math.round(g), Math.round(b)];
}

function grayScale(r, g, b) {
    const gray = Math.round((r + g + b) / 3);
    return [gray];
}

function normalize(r, g, b) {
    r = r/255;
    g = g/255;
    b = b/255;
    return [r, g, b, `${r}, ${g}, ${b}`];
}
