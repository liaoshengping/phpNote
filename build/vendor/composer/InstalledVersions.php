<?php











namespace Composer;

use Composer\Semver\VersionParser;






class InstalledVersions
{
private static $installed = array (
  'root' => 
  array (
    'pretty_version' => 'dev-master',
    'version' => 'dev-master',
    'aliases' => 
    array (
    ),
    'reference' => '0d3f5289ad1484a915511eb921cee5db465ff2be',
    'name' => 'qiu41/build',
  ),
  'versions' => 
  array (
    'inhere/console' => 
    array (
      'pretty_version' => 'v3.1.21',
      'version' => '3.1.21.0',
      'aliases' => 
      array (
      ),
      'reference' => '8e39a95cb8a7875de271395bc8735cc358c67a26',
    ),
    'millionmile/get_env' => 
    array (
      'pretty_version' => 'v1.0.0',
      'version' => '1.0.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '5a1c3e1a8fd98d741668f0ce8fec310952de9c7c',
    ),
    'qiu41/build' => 
    array (
      'pretty_version' => 'dev-master',
      'version' => 'dev-master',
      'aliases' => 
      array (
      ),
      'reference' => '0d3f5289ad1484a915511eb921cee5db465ff2be',
    ),
    'toolkit/cli-utils' => 
    array (
      'pretty_version' => 'v1.2.10',
      'version' => '1.2.10.0',
      'aliases' => 
      array (
      ),
      'reference' => '909008ec32b33c6b248adb700f060ac27b588794',
    ),
    'toolkit/stdlib' => 
    array (
      'pretty_version' => 'v1.0.17',
      'version' => '1.0.17.0',
      'aliases' => 
      array (
      ),
      'reference' => '234bbaff905ccc804680c6486d84d283db27405b',
    ),
    'toolkit/sys-utils' => 
    array (
      'pretty_version' => 'v1.2.7',
      'version' => '1.2.7.0',
      'aliases' => 
      array (
      ),
      'reference' => 'c294cca060b7ba8b4b161bf33df76a344e0b8796',
    ),
  ),
);







public static function getInstalledPackages()
{
return array_keys(self::$installed['versions']);
}









public static function isInstalled($packageName)
{
return isset(self::$installed['versions'][$packageName]);
}














public static function satisfies(VersionParser $parser, $packageName, $constraint)
{
$constraint = $parser->parseConstraints($constraint);
$provided = $parser->parseConstraints(self::getVersionRanges($packageName));

return $provided->matches($constraint);
}










public static function getVersionRanges($packageName)
{
if (!isset(self::$installed['versions'][$packageName])) {
throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
}

$ranges = array();
if (isset(self::$installed['versions'][$packageName]['pretty_version'])) {
$ranges[] = self::$installed['versions'][$packageName]['pretty_version'];
}
if (array_key_exists('aliases', self::$installed['versions'][$packageName])) {
$ranges = array_merge($ranges, self::$installed['versions'][$packageName]['aliases']);
}
if (array_key_exists('replaced', self::$installed['versions'][$packageName])) {
$ranges = array_merge($ranges, self::$installed['versions'][$packageName]['replaced']);
}
if (array_key_exists('provided', self::$installed['versions'][$packageName])) {
$ranges = array_merge($ranges, self::$installed['versions'][$packageName]['provided']);
}

return implode(' || ', $ranges);
}





public static function getVersion($packageName)
{
if (!isset(self::$installed['versions'][$packageName])) {
throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
}

if (!isset(self::$installed['versions'][$packageName]['version'])) {
return null;
}

return self::$installed['versions'][$packageName]['version'];
}





public static function getPrettyVersion($packageName)
{
if (!isset(self::$installed['versions'][$packageName])) {
throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
}

if (!isset(self::$installed['versions'][$packageName]['pretty_version'])) {
return null;
}

return self::$installed['versions'][$packageName]['pretty_version'];
}





public static function getReference($packageName)
{
if (!isset(self::$installed['versions'][$packageName])) {
throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
}

if (!isset(self::$installed['versions'][$packageName]['reference'])) {
return null;
}

return self::$installed['versions'][$packageName]['reference'];
}





public static function getRootPackage()
{
return self::$installed['root'];
}







public static function getRawData()
{
return self::$installed;
}



















public static function reload($data)
{
self::$installed = $data;
}
}
