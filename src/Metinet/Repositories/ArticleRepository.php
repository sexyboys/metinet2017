<?php

namespace Metinet\Repositories;

use Metinet\Domain\Blog\Article;

/**
 * @author Boris Guéry <guery.b@gmail.com>
 */
interface ArticleRepository
{
    /**
     * @param $id
     * @return Article
     */
    public function get($id);
    public function delete(Article $article);
    public function update(Article $article);
    public function add(Article $article);
    public function all();
}
