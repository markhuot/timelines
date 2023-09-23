import React from 'react';
import { renderToPipeableStream, renderToReadableStream } from 'react-dom/server';
import { Calendar } from './components/Calendar';
import { serve, file } from 'bun';
import path from 'path';

// async function handle()
// {
//     const { pipe, abort } = renderToPipeableStream(<Calendar centerOnString={'2023-09-22T00:00:00'} />, {
//         onShellReady() {
//             pipe(process.stdout);
//         }
//     });
// }

serve({
    // unix: path.resolve(__dirname, '../../storage/framework/socks/bun.sock'),
    async fetch(request, server) {
        // From, https://github.com/oven-sh/bun/issues/4814 & https://github.com/jacob-ebey/bun-remix/blob/main/server.js
        const stream = await renderToReadableStream(<Calendar centerOnString={'2023-09-22T00:00:00'} />);
        console.log('yes?!');

        return new Response(stream, {headers: {'Content-Type': 'text/html'}});
    }
})
