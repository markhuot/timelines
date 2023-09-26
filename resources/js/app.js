import './bootstrap';

function timeago(date)
{
    const from = date.getTime();
    const to = new Date().getTime();
    const durationMs = Math.abs(to - from);
    const durationSec = (durationMs / 1000) % 60;
    const durationMin = (durationMs / 1000 / 60) % 60;
    const durationHour = (durationMs / 1000 / 60 / 60) % 24;
    const durationDay = (durationMs / 1000 / 60 / 60 / 24) % 365;
    const durationYear = (durationMs / 1000 / 60 / 60 / 24 / 365);

    return [
        durationYear > 1 ? Math.floor(durationYear) + 'y' : null,
        durationYear > 1 || durationDay > 1 ? Math.floor(durationDay) + 'd' : null,
        durationDay > 1 || durationHour > 1 ? Math.floor(durationHour) + 'h' : null,
        durationHour > 1 || durationMin > 1 ? Math.floor(durationMin) + 'm' : null,
        durationMin > 1 || durationSec > 1 ? new String(Math.floor(durationSec)).padStart(2, 0) + 's' : null,
    ].filter(Boolean).join(' ')
}

window.timeago = timeago
