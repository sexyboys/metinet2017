<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Repositories;

use Metinet\Domain\Blog\Article;

class InMemoryArticleRepository implements ArticleRepository
{
    private $articles = [];

    /**
     * @param $id
     * @return Article
     * @throws ArticleNotFound
     */
    public function get($id)
    {
        if (!isset($this->articles[$id])) {

            throw new ArticleNotFound($id);
        }

        return $this->articles[$id];
    }

    public function delete(Article $article)
    {
        if (!isset($this->articles[$article->getId()])) {

            throw new ArticleNotFound($article->getId());
        }

        unset($this->articles[$article->getId()]);
    }

    public function update(Article $article)
    {
        if (!isset($this->articles[$article->getId()])) {

            throw new ArticleNotFound($article->getId());
        }

        $this->articles[$article->getId()] = $article;
    }

    public function add(Article $article)
    {
        if (isset($this->articles[$article->getId()])) {

            throw new ArticleAlreadyExists($article);
        }

        $this->articles[$article->getId()] = $article;
    }

    public function all()
    {
        return $this->articles;
    }
}
