<?php

namespace Ldoc;

use Parsedown;
use Symfony\Component\Yaml\Yaml;

/**
 * Main Handler.
 */
class Handler
{
    protected $defaultVersionName = 'default';

    protected $docsDir;

    protected $prefixUri;

    /**
     * constructor.
     *
     * @param string $docsDir
     * @param string $prefixUri
     */
    public function __construct($docsDir = '', $prefixUri = 'docs')
    {
        $this->docsDir = $docsDir;
        $this->prefixUri = $prefixUri;
    }

    /**
     * handle.
     *
     * @param string $path
     *
     * @return void
     */
    public function handle($path = '')
    {
        $version = $this->defaultVersionName;
        $baseName = 'index.html';
        $dirName = '';
        if ($path) {
            $pathif = pathinfo($path);
            $fname = $pathif['filename'];
            $bname = $pathif['basename'];
            $dname = '.' == $pathif['dirname'] ? '/' : $pathif['dirname'];
            $fragment = explode('/', $dname, 2);
            $v = $fragment[0] ? $fragment[0] : $path;
            $versions = $this->getVersion($v);
            if ($versions) {
                $version = $v;
            }
            $dirName = str_replace($version, '', $dname);

            if ($version != $fname) {
                $baseName = $bname;
            }
        }
        $versions = $this->getVersion($version);
        $sidebar = $this->getSidebar($version);

        $contentFileName = $this->pathJoin($dirName, $baseName);
        $content = $this->getContent($version, $contentFileName);

        return [
            'css' => \file_get_contents(__DIR__.'/../resources/assets/index.css'),
            'sidebar' => $sidebar,
            'content' => $content,
            'versions' => $versions,
            'current_version' => $version,
            'prefix_uri' => $this->pathJoin('/', $this->prefixUri, '/'),
            'base_path' => $this->pathJoin('/', $this->prefixUri, $version, '/'),
            'content_file_name' => ltrim($contentFileName, '/'),
            'default_version_name' => $this->defaultVersionName,
        ];
    }

    /**
     * gets content.
     *
     * @param string $version
     * @param string $path
     *
     * @return void
     */
    protected function getContent($version, $path)
    {
        if ($version == $this->defaultVersionName) {
            $version = '';
        }
        $path = $this->getStorageFilePath(
            $this->pathJoin($version, '_source', str_replace(strrchr($path, '.'), '', $path))
            );

        $exist = file_exists($path.'.md');

        if (!$exist) {
            $path = __DIR__.'/../resources/source/default';
        }

        $content = file_get_contents($path.'.md');
        $content = (new Parsedown())->text($content);

        return $content;
    }

    /**
     * gets sidebar content.
     *
     * @param string $version
     *
     * @return void
     */
    protected function getSidebar($version = '')
    {
        $path = 'sidebar.yml';
        if ($version != $this->defaultVersionName) {
            $path = $version.'/'.$path;
        }

        $path = $this->getStorageFilePath($path);

        if (!is_file($path)) {
            return [];
        }

        $sidebar = Yaml::parseFile($path);

        return $sidebar;
    }

    /**
     * gets version.
     *
     * @param string $version
     *
     * @return void
     */
    protected function getVersion($version)
    {
        $path = $this->getStorageFilePath('versions.yml');

        if (!is_file($path)) {
            return [];
        }

        $versions = Yaml::parseFile($path);

        if (!isset($versions[$version])) {
            return [];
        }

        if (!isset($versions['default'])) {
            $versions = array_merge([
                'default' => '默认版本',
            ], $versions);
        }

        return $versions;
    }

    /**
     * whether exist storage dir.
     *
     * @param string $dir
     *
     * @return void
     */
    protected function existStorageDir($dir)
    {
        return is_dir($this->getStorageFile($dir));
    }

    /**
     * gets storage file path.
     *
     * @param string $path
     *
     * @return void
     */
    protected function getStorageFilePath($path)
    {
        return $this->pathJoin($this->docsDir, $path);
    }

    /**
     * stitching path.
     *
     * @param ...string ...$paths
     *
     * @return void
     */
    protected function pathJoin(...$paths)
    {
        $path = '';
        foreach ($paths as $p) {
            $path = rtrim($path, '/').'/'.ltrim($p, '/');
        }

        return $path;
    }
}
