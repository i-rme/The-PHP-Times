<?php
require_once("News.php");
require_once("NewsRepository.php");

class NewsService
{
  public function getAll() {
    $newsRepository = new NewsRepository();
    return $newsRepository->getAll();
  }

  public function getCategory($category) {
    $newsRepository = new NewsRepository();
    return $newsRepository->getCategory($category);
  }

  public function getCategories() {
    $newsRepository = new NewsRepository();
    return $newsRepository->getCategories();
  }

  public function getNewId() {
    $newsRepository = new NewsRepository();
    return $newsRepository->getNewId();
  }

  public function getNewsInfo($id) {
    $newsRepository = new NewsRepository();
    $news = $newsRepository->get($id);


    return [
      "news" => $news
    ];
  }

  public function updateNews($updatedNews) {
    $newsRepository = new NewsRepository();
    $updatedNews['summary'] = substr($updatedNews['text'], 0, 128);
    return $newsRepository->update($updatedNews);
  }

  public function deleteNews($newsId) {
    $newsRepository = new NewsRepository();
    return $newsRepository->delete($newsId);
  }

}

?>
