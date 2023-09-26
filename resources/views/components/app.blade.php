<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite('resources/js/app.js')
    <!--<script src="https://cdn.jsdelivr.net/npm/dayjs@1/dayjs.min.js"></script>-->
    <!--<script src="https://cdn.jsdelivr.net/npm/dayjs@1/plugin/relativeTime.js"></script>-->
    <!--<script>window.dayjs.extend(window.dayjs_plugin_relativeTime)</script>-->
    <!--<script src="https://cdn.jsdelivr.net/npm/timeago.js@4.0.2/dist/timeago.min.js"></script>-->
</head>
<body x-data class="min-h-screen dark:bg-[--bg] dark:text-slate-100">
{{$slot}}
</body>
</html>
