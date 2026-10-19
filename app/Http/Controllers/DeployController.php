<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Artisan;

class DeployController extends Controller
{
    /**
     * Run git pull with verbose logging and environment diagnostics.
     */
    public function gitPull(Request $request): Response
    {
        $projectPath = base_path();

        // Ensure current directory is marked safe for git execution
        @exec('git config --global --add safe.directory '.escapeshellarg($projectPath).' 2>&1');

        // Optional stash before pull if requested
        $stashOutput = [];
        if ($request->boolean('stash')) {
            @exec('cd '.escapeshellarg($projectPath).' && git stash 2>&1', $stashOutput);
        }

        // Run git pull
        $pullOutput = [];
        $returnCode = 0;
        exec('cd '.escapeshellarg($projectPath).' && git pull 2>&1', $pullOutput, $returnCode);

        // Branch and commit diagnostics
        $branch = [];
        @exec('cd '.escapeshellarg($projectPath).' && git branch --show-current 2>&1', $branch);
        $branchName = ! empty($branch) ? implode('', $branch) : 'unknown';

        $lastCommit = [];
        @exec('cd '.escapeshellarg($projectPath)." && git log -1 --pretty=format:'%h - %s (%ci)' 2>&1", $lastCommit);
        $lastCommitStr = ! empty($lastCommit) ? implode('', $lastCommit) : 'N/A';

        $gitStatus = [];
        @exec('cd '.escapeshellarg($projectPath).' && git status -s 2>&1', $gitStatus);

        $isSuccess = ($returnCode === 0);
        $statusBadge = $isSuccess ? 'BERHASIL (SUCCESS)' : "GAGAL (EXIT CODE: {$returnCode})";
        $badgeBg = $isSuccess ? '#10b981' : '#ef4444';

        $pullLog = htmlspecialchars(implode("\n", $pullOutput));
        $stashLog = htmlspecialchars(implode("\n", $stashOutput));
        $statusLog = htmlspecialchars(implode("\n", $gitStatus));

        $html = "<!DOCTYPE html>
<html lang='id'>
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Git Pull Runner - Production Deployment</title>
    <style>
        * { box-sizing: border-box; }
        body { font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace; background: #0b1120; color: #f1f5f9; padding: 24px; margin: 0; line-height: 1.5; }
        .container { max-width: 960px; margin: 0 auto; background: #1e293b; border-radius: 12px; padding: 28px; box-shadow: 0 20px 40px rgba(0,0,0,0.5); border: 1px solid #334155; }
        .header { display: flex; align-items: center; justify-content: space-between; border-bottom: 1px solid #334155; padding-bottom: 16px; margin-bottom: 20px; flex-wrap: wrap; gap: 12px; }
        h1 { margin: 0; font-size: 20px; color: #38bdf8; display: flex; align-items: center; gap: 8px; }
        .badge { display: inline-block; padding: 6px 14px; border-radius: 9999px; font-weight: 700; background: {$badgeBg}; color: #ffffff; font-size: 13px; text-transform: uppercase; }
        .meta-box { background: #0f172a; border: 1px solid #334155; border-radius: 8px; padding: 14px 18px; margin-bottom: 20px; font-size: 13.5px; }
        .meta-row { display: flex; margin-bottom: 6px; }
        .meta-label { width: 170px; color: #94a3b8; font-weight: 600; flex-shrink: 0; }
        .meta-val { color: #f8fafc; font-weight: 500; word-break: break-all; }
        .section-title { font-size: 14px; font-weight: 700; color: #cbd5e1; margin-top: 20px; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.5px; }
        pre { background: #020617; border: 1px solid #334155; border-radius: 8px; padding: 16px; overflow-x: auto; color: #38bdf8; font-size: 13px; max-height: 400px; white-space: pre-wrap; word-break: break-all; }
        .actions { margin-top: 28px; display: flex; flex-wrap: wrap; gap: 10px; border-top: 1px solid #334155; pt: 20px; padding-top: 20px; }
        .btn { display: inline-flex; align-items: center; padding: 10px 18px; border-radius: 8px; font-size: 13px; font-weight: 700; text-decoration: none; color: #ffffff; transition: opacity 0.2s; cursor: pointer; }
        .btn:hover { opacity: 0.85; }
        .btn-blue { background: #0284c7; }
        .btn-emerald { background: #059669; }
        .btn-amber { background: #d97706; }
        .btn-indigo { background: #6366f1; }
        .btn-gray { background: #475569; }
        .btn-red { background: #dc2626; }
    </style>
</head>
<body>
    <div class='container'>
        <div class='header'>
            <h1>🚀 Git Pull Deployment Runner</h1>
            <div class='badge'>{$statusBadge}</div>
        </div>

        <div class='meta-box'>
            <div class='meta-row'>
                <div class='meta-label'>Direktori Proyek:</div>
                <div class='meta-val'>{$projectPath}</div>
            </div>
            <div class='meta-row'>
                <div class='meta-label'>Active Branch:</div>
                <div class='meta-val'><span style='color: #34d399; font-weight: bold;'>{$branchName}</span></div>
            </div>
            <div class='meta-row'>
                <div class='meta-label'>Commit Terakhir:</div>
                <div class='meta-val'>{$lastCommitStr}</div>
            </div>
            <div class='meta-row'>
                <div class='meta-label'>Waktu Eksekusi:</div>
                <div class='meta-val'>".date('Y-m-d H:i:s T').'</div>
            </div>
        </div>

        '.(! empty($stashLog) ? "<div class='section-title'>Git Stash Output:</div><pre>{$stashLog}</pre>" : '')."

        <div class='section-title'>Terminal Output: <code>git pull</code></div>
        <pre>{$pullLog}</pre>

        ".(! empty($statusLog) ? "<div class='section-title'>Status Perubahan Berkas Lokal:</div><pre>{$statusLog}</pre>" : '')."

        <div class='actions'>
            <a href='".url('/git-pull')."' class='btn btn-blue'>🔄 Jalankan Git Pull Lagi</a>
            <a href='".url('/git-pull?stash=1')."' class='btn btn-amber'>📦 Git Stash &amp; Pull</a>
            <a href='".url('/migrate')."' class='btn btn-emerald'>⚡ Jalankan Database Migrate</a>
            <a href='".url('/run-seed')."' class='btn btn-amber'>🌱 Jalankan Database Seed</a>
            <a href='".url('/storage-link')."' class='btn btn-indigo'>🔗 Storage Link</a>
            <a href='".url('/admin')."' class='btn btn-gray'>🏠 Masuk Panel Admin</a>
        </div>
    </div>
</body>
</html>";

        return response($html, $isSuccess ? 200 : 500);
    }

    /**
     * Run artisan migrate --force with verbose formatted output.
     */
    public function migrate(Request $request): Response
    {
        $exitCode = Artisan::call('migrate', ['--force' => true]);
        $output = Artisan::output();

        $isSuccess = ($exitCode === 0);
        $statusBadge = $isSuccess ? 'BERHASIL (SUCCESS)' : "GAGAL (EXIT CODE: {$exitCode})";
        $badgeBg = $isSuccess ? '#10b981' : '#ef4444';
        $outputHtml = htmlspecialchars($output);

        $html = "<!DOCTYPE html>
<html lang='id'>
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Artisan Migrate Runner</title>
    <style>
        * { box-sizing: border-box; }
        body { font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace; background: #0b1120; color: #f1f5f9; padding: 24px; margin: 0; line-height: 1.5; }
        .container { max-width: 960px; margin: 0 auto; background: #1e293b; border-radius: 12px; padding: 28px; box-shadow: 0 20px 40px rgba(0,0,0,0.5); border: 1px solid #334155; }
        .header { display: flex; align-items: center; justify-content: space-between; border-bottom: 1px solid #334155; padding-bottom: 16px; margin-bottom: 20px; flex-wrap: wrap; gap: 12px; }
        h1 { margin: 0; font-size: 20px; color: #34d399; display: flex; align-items: center; gap: 8px; }
        .badge { display: inline-block; padding: 6px 14px; border-radius: 9999px; font-weight: 700; background: {$badgeBg}; color: #ffffff; font-size: 13px; text-transform: uppercase; }
        pre { background: #020617; border: 1px solid #334155; border-radius: 8px; padding: 16px; overflow-x: auto; color: #34d399; font-size: 13px; max-height: 400px; white-space: pre-wrap; word-break: break-all; }
        .actions { margin-top: 28px; display: flex; flex-wrap: wrap; gap: 10px; border-top: 1px solid #334155; padding-top: 20px; }
        .btn { display: inline-flex; align-items: center; padding: 10px 18px; border-radius: 8px; font-size: 13px; font-weight: 700; text-decoration: none; color: #ffffff; transition: opacity 0.2s; cursor: pointer; }
        .btn:hover { opacity: 0.85; }
        .btn-emerald { background: #059669; }
        .btn-blue { background: #0284c7; }
        .btn-amber { background: #d97706; }
        .btn-indigo { background: #6366f1; }
        .btn-gray { background: #475569; }
    </style>
</head>
<body>
    <div class='container'>
        <div class='header'>
            <h1>⚡ Database Migration Runner</h1>
            <div class='badge'>{$statusBadge}</div>
        </div>

        <div style='color: #94a3b8; font-size: 13px; margin-bottom: 12px;'>
            Perintah yang dijalankan: <code>php artisan migrate --force</code> | Waktu: ".date('Y-m-d H:i:s T')."
        </div>

        <pre>{$outputHtml}</pre>

        <div class='actions'>
            <a href='".url('/migrate')."' class='btn btn-emerald'>🔄 Jalankan Migrate Lagi</a>
            <a href='".url('/git-pull')."' class='btn btn-blue'>🚀 Jalankan Git Pull</a>
            <a href='".url('/run-seed')."' class='btn btn-amber'>🌱 Jalankan Database Seed</a>
            <a href='".url('/storage-link')."' class='btn btn-indigo'>🔗 Storage Link</a>
            <a href='".url('/admin')."' class='btn btn-gray'>🏠 Masuk Panel Admin</a>
        </div>
    </div>
</body>
</html>";

        return response($html, $isSuccess ? 200 : 500);
    }

    /**
     * Run artisan db:seed --force.
     */
    public function seed(Request $request): Response
    {
        $exitCode = Artisan::call('db:seed', ['--force' => true]);
        $output = Artisan::output();

        $isSuccess = ($exitCode === 0);
        $statusBadge = $isSuccess ? 'BERHASIL (SUCCESS)' : "GAGAL (EXIT CODE: {$exitCode})";
        $badgeBg = $isSuccess ? '#10b981' : '#ef4444';
        $outputHtml = htmlspecialchars($output);

        $html = "<!DOCTYPE html>
<html lang='id'>
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Database Seeder Runner</title>
    <style>
        * { box-sizing: border-box; }
        body { font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace; background: #0b1120; color: #f1f5f9; padding: 24px; margin: 0; line-height: 1.5; }
        .container { max-width: 960px; margin: 0 auto; background: #1e293b; border-radius: 12px; padding: 28px; box-shadow: 0 20px 40px rgba(0,0,0,0.5); border: 1px solid #334155; }
        .header { display: flex; align-items: center; justify-content: space-between; border-bottom: 1px solid #334155; padding-bottom: 16px; margin-bottom: 20px; flex-wrap: wrap; gap: 12px; }
        h1 { margin: 0; font-size: 20px; color: #fbbf24; display: flex; align-items: center; gap: 8px; }
        .badge { display: inline-block; padding: 6px 14px; border-radius: 9999px; font-weight: 700; background: {$badgeBg}; color: #ffffff; font-size: 13px; text-transform: uppercase; }
        pre { background: #020617; border: 1px solid #334155; border-radius: 8px; padding: 16px; overflow-x: auto; color: #fbbf24; font-size: 13px; max-height: 400px; white-space: pre-wrap; word-break: break-all; }
        .actions { margin-top: 28px; display: flex; flex-wrap: wrap; gap: 10px; border-top: 1px solid #334155; padding-top: 20px; }
        .btn { display: inline-flex; align-items: center; padding: 10px 18px; border-radius: 8px; font-size: 13px; font-weight: 700; text-decoration: none; color: #ffffff; transition: opacity 0.2s; cursor: pointer; }
        .btn:hover { opacity: 0.85; }
        .btn-amber { background: #d97706; }
        .btn-emerald { background: #059669; }
        .btn-blue { background: #0284c7; }
        .btn-indigo { background: #6366f1; }
        .btn-gray { background: #475569; }
    </style>
</head>
<body>
    <div class='container'>
        <div class='header'>
            <h1>🌱 Database Seeder Runner</h1>
            <div class='badge'>{$statusBadge}</div>
        </div>

        <div style='color: #94a3b8; font-size: 13px; margin-bottom: 12px;'>
            Perintah yang dijalankan: <code>php artisan db:seed --force</code> | Waktu: ".date('Y-m-d H:i:s T')."
        </div>

        <pre>{$outputHtml}</pre>

        <div class='actions'>
            <a href='".url('/run-seed')."' class='btn btn-amber'>🔄 Jalankan Seed Lagi</a>
            <a href='".url('/migrate')."' class='btn btn-emerald'>⚡ Jalankan Database Migrate</a>
            <a href='".url('/storage-link')."' class='btn btn-indigo'>🔗 Storage Link</a>
            <a href='".url('/git-pull')."' class='btn btn-blue'>🚀 Jalankan Git Pull</a>
            <a href='".url('/admin')."' class='btn btn-gray'>🏠 Masuk Panel Admin</a>
        </div>
    </div>
</body>
</html>";

        return response($html, $isSuccess ? 200 : 500);
    }

    /**
     * Run artisan storage:link.
     */
    public function storageLink(Request $request): Response
    {
        $exitCode = Artisan::call('storage:link');
        $output = Artisan::output();

        $isSuccess = ($exitCode === 0);
        $statusBadge = $isSuccess ? 'BERHASIL (SUCCESS)' : "GAGAL (EXIT CODE: {$exitCode})";
        $badgeBg = $isSuccess ? '#10b981' : '#ef4444';
        $outputHtml = htmlspecialchars($output);

        $html = "<!DOCTYPE html>
<html lang='id'>
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Storage Link Runner</title>
    <style>
        * { box-sizing: border-box; }
        body { font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace; background: #0b1120; color: #f1f5f9; padding: 24px; margin: 0; line-height: 1.5; }
        .container { max-width: 960px; margin: 0 auto; background: #1e293b; border-radius: 12px; padding: 28px; box-shadow: 0 20px 40px rgba(0,0,0,0.5); border: 1px solid #334155; }
        .header { display: flex; align-items: center; justify-content: space-between; border-bottom: 1px solid #334155; padding-bottom: 16px; margin-bottom: 20px; flex-wrap: wrap; gap: 12px; }
        h1 { margin: 0; font-size: 20px; color: #818cf8; display: flex; align-items: center; gap: 8px; }
        .badge { display: inline-block; padding: 6px 14px; border-radius: 9999px; font-weight: 700; background: {$badgeBg}; color: #ffffff; font-size: 13px; text-transform: uppercase; }
        pre { background: #020617; border: 1px solid #334155; border-radius: 8px; padding: 16px; overflow-x: auto; color: #818cf8; font-size: 13px; max-height: 400px; white-space: pre-wrap; word-break: break-all; }
        .actions { margin-top: 28px; display: flex; flex-wrap: wrap; gap: 10px; border-top: 1px solid #334155; padding-top: 20px; }
        .btn { display: inline-flex; align-items: center; padding: 10px 18px; border-radius: 8px; font-size: 13px; font-weight: 700; text-decoration: none; color: #ffffff; transition: opacity 0.2s; cursor: pointer; }
        .btn:hover { opacity: 0.85; }
        .btn-indigo { background: #6366f1; }
        .btn-emerald { background: #059669; }
        .btn-amber { background: #d97706; }
        .btn-blue { background: #0284c7; }
        .btn-gray { background: #475569; }
    </style>
</head>
<body>
    <div class='container'>
        <div class='header'>
            <h1>🔗 Storage Link Runner</h1>
            <div class='badge'>{$statusBadge}</div>
        </div>

        <div style='color: #94a3b8; font-size: 13px; margin-bottom: 12px;'>
            Perintah yang dijalankan: <code>php artisan storage:link</code> | Waktu: ".date('Y-m-d H:i:s T')."
        </div>

        <pre>{$outputHtml}</pre>

        <div class='actions'>
            <a href='".url('/storage-link')."' class='btn btn-indigo'>🔄 Jalankan Storage Link Lagi</a>
            <a href='".url('/migrate')."' class='btn btn-emerald'>⚡ Jalankan Database Migrate</a>
            <a href='".url('/run-seed')."' class='btn btn-amber'>🌱 Jalankan Database Seed</a>
            <a href='".url('/git-pull')."' class='btn btn-blue'>🚀 Jalankan Git Pull</a>
            <a href='".url('/admin')."' class='btn btn-gray'>🏠 Masuk Panel Admin</a>
        </div>
    </div>
</body>
</html>";

        return response($html, $isSuccess ? 200 : 500);
    }
}
