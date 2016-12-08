<?php

namespace Metinet\Domain\Blog;

/**
 * @author Boris Guéry <guery.b@gmail.com>
 */
class Article
{
    private $id;
    private $author;
    private $title;
    private $slug;
    private $summary;
    private $content;
    private $publicationDate;

    public function __construct($id, Author $author, $title, $slug, $summary, FormattedContent $content, PublicationDate $publicationDate = null)
    {
        $this->id              = $id;
        $this->author          = $author;
        $this->title           = $title;
        $this->slug            = $slug;
        $this->summary         = $summary;
        $this->content         = $content;
        $this->publicationDate = $publicationDate;
    }

    public function updateTitle(string $title, string $slug)
    {
        $this->ensureModificationAreAllowed();
        $this->title = $title;
        $this->slug  = $slug;
    }

    public function updateSummary(string $summary)
    {
        $this->ensureModificationAreAllowed();
        $this->summary = $summary;
    }

    public function updateContent(FormattedContent $content)
    {
        $this->ensureModificationAreAllowed();
        $this->content = $content;
    }

    public function publish()
    {
        $this->publicationDate = PublicationDate::fromDateTime(new \DateTime('now', new \DateTimeZone('UTC')));
    }

    public function unpublish()
    {
        $this->publicationDate = null;
    }

    public function isPublished()
    {
        return ($this->publicationDate instanceof PublicationDate
                && $this->publicationDate->toDateTimeImmutable() >= new \DateTime('now', new \DateTimeZone('UTC')));
    }

    public function schedule(PublicationDate $publicationDate)
    {
        $this->publicationDate = $publicationDate;
    }

    private function ensureModificationAreAllowed()
    {
        if ($this->isPublished()) {

            throw UnableToUpdateArticle::updateAreNotAllowedForPublishedArticle();
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getSlug()
    {
        return $this->slug;
    }

    public function getSummary()
    {
        return $this->summary;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function getPublicationDate()
    {
        return $this->publicationDate;
    }
}
