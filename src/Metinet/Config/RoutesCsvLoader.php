<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Config;

class RoutesCsvLoader implements Loader
{
    private $path;

    public function __construct($path)
    {
        $this->path = $path;
    }

    public function load()
    {
        $routes = [];
        if (($handle = fopen($this->path, 'r')) !== false) {
            while (($data = fgetcsv($handle, 1000, ';')) !== false) {
                $routes[] = [
                    'method' => $data[0],
                    'path'   => $data[1],
                    'action' => $data[2],
                ];
            }
            fclose($handle);
        }

        return ['routes' => $routes];
    }
}
