<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

 Route::get('/', \App\Http\Controllers\Calendar\IndexController::class)->named('calendar.index');

//Route::get('/', function () {
//    return \Illuminate\Support\Facades\Http::get('localhost:3000');
//});

//Route::get('/', function () {
////    $connector = new \React\Socket\UnixConnector();
////    $connector->connect(realpath(__DIR__ . '/../storage/framework/socks/bun.sock'))->then(function (\React\Socket\ConnectionInterface $connection) {
////        $connection->on('data', function ($chunk) {
////            var_dump($chunk);
////        });
////        $connection->end();
////    });
////    return '';
//
//    return response()->stream(function () {
//        var_dump('Hello World');
//        flush();
//        sleep(2);
//        var_dump('Hello World');
//        flush();
//
////        $connector = new \React\Socket\Connector();
////        $connector->connect('localhost:3000')->then(function (\React\Socket\ConnectionInterface $connection) {
////            $connection->on('data', function ($chunk) {
////                var_dump($chunk);
////            });
////            $connection->end();
////            $connection->on('end', function () use (&$running) {
////                $running = false;
////            });
////            $connection->on('error', function (\Exception $e) use (&$running) {
////                $running = false;
////            });
////            $connection->on('close', function () use (&$running) {
////                $running = false;
////            });
////        });
////        $connector = new \React\Socket\UnixConnector();
////        $connector->connect(realpath(__DIR__ . '/../storage/framework/socks/bun.sock'))->then(function (\React\Socket\ConnectionInterface $connection) {
////            $connection->write('foo');
////            $connection->end();
////            $connection->close();
//////            $running = true;
//////            while ($running) {
//////                $connection->on('data', function ($chunk) {
//////                    var_dump($chunk);
//////                });
//////                $connection->on('end', function () use (&$running) {
//////                    $running = false;
//////                });
//////                $connection->on('error', function (\Exception $e) use (&$running) {
//////                    $running = false;
//////                });
//////                $connection->on('close', function () use (&$running) {
//////                    $running = false;
//////                });
//////            }
////        });
//    }, 200, [
//        'Content-Type' => 'text/html',
//        'X-Accel-Buffering' => 'no',
//    ]);
//});
