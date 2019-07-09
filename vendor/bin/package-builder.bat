@ECHO OFF
setlocal DISABLEDELAYEDEXPANSION
SET BIN_TARGET=%~dp0/../overtrue/package-builder/bin/package-builder
php "%BIN_TARGET%" %*
