<?php

namespace SRC\Common;

class Doc
{
    protected $levels;
    protected $include;
    protected $exclude;

    public function __construct($levels, $include, $exclude)
    {
        $this->levels = $levels;
        $this->include = $include;
        $this->exclude = $exclude;
    }

    public function generate($srcPath, $argc, $argv)
    {
        $permissionLevels = $this->getPermissionLevels($argc, $argv);

        foreach ($permissionLevels as $permissionLevel) {
            $outputDir = $this->levels[$permissionLevel];
            $this->buildFileList(".", $permissionLevel);

            $exclude = join(" ", array_map(function ($value) {
                return '-e ' . escapeshellarg($value);
            }, $this->exclude));

            $apiCommonPath = __DIR__ . '/../';
            $include = "-i '{$apiCommonPath}' -i '{$srcPath}'";

            $this->runApiDoc($outputDir, $exclude, $include);
        }

    }

    protected function getPermissionLevels($argc, $argv)
    {
        $permissionLevel = '';
        if ($argc >= 2) {
            $permissionLevel = $argv[1];
            if (!isset($this->levels[$permissionLevel])) {
                print "Invalid level '$permissionLevel'\n";
                print "Allowed levels are " . join(', ', array_keys($this->levels)) . "\n";
                exit;
            }
        }

        if ($permissionLevel) {
            return [$permissionLevel];
        }
        return array_keys($this->levels);
    }

    protected function buildFileList($dir, $permissionLevel)
    {
        $dh = opendir($dir);
        while ($fn = readdir($dh)) {
            if ($fn == '.' || $fn == '..') {
                continue;
            }
            $fullFn = $dir . DIRECTORY_SEPARATOR . $fn;
            if ($dir == '.') {
                $fullFn = $fn;
            }

            $match = false;
            foreach ($this->include as $inc) {
                if (preg_match($inc, $fullFn)) {
                    $match = true;
                    break;
                }
            }
            if (!$match) {
                continue;
            }

            $forbidden = false;
            if (preg_match("/\\.(php|js|py)$/", $fn)) {
                print "F $fullFn\n";

                $src = file_get_contents($fullFn);
                if (preg_match('/@apiPermission\s+([^\s]+)/', $src, $m)) {
                    $level = $m[1];
                    if ($permissionLevel != 'internal' && $level != 'apikey' && $level != 'key') {
                        $forbidden = true;
                    }
                }

                if ($forbidden) {
                    $this->exclude[] = $fullFn;
                }
            } else {
                if (is_dir($fullFn)) {
                    //print "D $fullFn\n";
                    $this->buildFileList($fullFn, $permissionLevel);
                }
            }
        }
        closedir($dh);
    }

    protected function runApiDoc($outputDir, $exclude, $include)
    {
        if (PHP_OS == 'WINNT') {
            $tpl = <<<END
@echo off
path %path%;c:\\users\\Nico\\AppData\\Roaming\\npm
apidoc -o $outputDir $exclude $include 
END;

            print "Generating docs in $outputDir/\n";
            file_put_contents("gentmp.bat", $tpl);
            system("cmd /c gentmp.bat");
            unlink("gentmp.bat");
        } else {
            $tpl = "apidoc -o $outputDir $exclude $include";

            print "Generating docs in $outputDir/\n";
            file_put_contents("gentmp.sh", str_replace("\r\n", "\n", $tpl));
            system("bash gentmp.sh");
            unlink("gentmp.sh");
        }
    }
}
