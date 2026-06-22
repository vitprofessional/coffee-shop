<?php
$src = dirname(__DIR__) . '/merge_staging/old_database';
$dstRoot = dirname(__DIR__) . '/database';
$conflicts = dirname(__DIR__, 2) . '/backup_old_generated_files/conflicts_database';
if (!is_dir($conflicts)) {
    @mkdir($conflicts, 0777, true);
}
if (!is_dir($src)) {
    echo "Source staging folder not found: $src\n";
    exit(1);
}
$it = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($src, RecursiveDirectoryIterator::SKIP_DOTS));
foreach ($it as $file) {
    if (!$file->isFile()) continue;
    $rel = substr($file->getPathname(), strlen($src) + 1);
    $dest = $dstRoot . DIRECTORY_SEPARATOR . $rel;
    $destDir = dirname($dest);
    if (!is_dir($destDir)) {
        @mkdir($destDir, 0777, true);
    }
    if (!file_exists($dest)) {
        if (@copy($file->getPathname(), $dest)) {
            echo "Copied new: $rel\n";
        } else {
            echo "Failed to copy: $rel\n";
        }
    } else {
        $conflictPath = $conflicts . DIRECTORY_SEPARATOR . str_replace(["\\", "/"], "_", $rel) . '.mause_src';
        if (@copy($file->getPathname(), $conflictPath)) {
            echo "Conflict kept: $rel -> saved as $conflictPath\n";
        } else {
            echo "Failed to save conflict for: $rel\n";
        }
    }
}
echo "Database merge script completed.\n";
