<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Controllers;

use Metinet\Domain\Blog\Article;
use Metinet\Domain\Blog\Author;
use Metinet\Domain\Blog\BasicSlugGenerator;
use Metinet\Domain\Blog\FormattedContent;
use Metinet\Domain\Blog\MultiFormatContentFormatter;
use Metinet\Domain\Blog\PlainTextFormatter;
use Metinet\Domain\Blog\PublicationDate;
use Metinet\Http\Request;
use Metinet\Http\Response;
use Metinet\Repositories\ArticleRepository;
use Metinet\Repositories\InMemoryArticleRepository;

class BlogController
{
    /**
     * @var ArticleRepository
     */
    private $articleRepository;
    private $articleContentFormatter;
    private $slugGenerator;

    public function __construct()
    {
        $this->articleRepository = new InMemoryArticleRepository();
        $this->articleContentFormatter = new MultiFormatContentFormatter(
            [new PlainTextFormatter(),]
        );
        $this->slugGenerator = new BasicSlugGenerator();

        $title = "Qu'est-ce que la programmation objet ?";
        $slug = $this->slugGenerator->generate($title);

        $article = new Article(
            'foobar',
            new Author(),
            $title,
            $slug,
            "La POO c'est bien",
            new FormattedContent(
                "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus molestie metus accumsan, tristique erat vel, tincidunt lectus. Cras tempor cursus mauris, vestibulum finibus eros blandit ut. Aenean ullamcorper, libero eget faucibus dictum, enim lacus sollicitudin justo, ultricies interdum tellus nulla sit amet lectus. Aenean a mauris nec ex eleifend viverra.",
                FormattedContent::PLAIN_TEXT
            )
        );
        $article->publish();

        $this->articleRepository->add($article);
    }

    public function listArticles(Request $request)
    {
        $articles = $this->articleRepository->all();
    }

    public function view(Request $request)
    {
        $articleId = $request->getQueryParameters()['id'];
        $article = $this->articleRepository->get($articleId);

        $content = $this->articleContentFormatter->format($article->getContent());

        $body =<<<HTML
<article style="width: 500px; border: 1px solid">
<header>
    <h1>{$article->getTitle()} (<time>{$article->getPublicationDate()->format(DATE_ISO8601)}</time>)</h1>
    <p>{$article->getSummary()}</p>
</header>
<pre style="white-space: pre-wrap;">{$content}</pre>
<a href="/articles/view?id={$article->getId()}">/articles/view/{$article->getSlug()}</a>
</article>
HTML;

        return Response::success($body, []);
    }

    public function publish(Request $request)
    {
        $articleId = $request->getQueryParameters()['id'];
        $article = $this->articleRepository->get($articleId);
        $article->publish();
    }

    public function schedule(Request $request)
    {
        $articleId = $request->getQueryParameters()['id'];
        $publicationDate = $request->getQueryParameters()['publicationDate'];

        $article = $this->articleRepository->get($articleId);
        $article->schedule(
            PublicationDate::fromDateTime(\DateTime::createFromFormat(DATE_ISO8601, $publicationDate))
        );
    }
}
