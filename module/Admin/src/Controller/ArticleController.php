<?php

namespace Admin\Controller;

use Application\Entity\Article;
use Application\Entity\Category;
use Application\Entity\Comment;
use Application\Entity\ArticleLike;
use Application\Entity\ArticleDislike;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Doctrine\ORM\EntityManagerInterface;
use Admin\Form\ArticleForm;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Zend\Paginator\Paginator;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator;
use Application\Service\FormServiceInterface;
use Zend\Form\FormInterface;

class ArticleController extends AbstractActionController
{
    private $entityManager;
    private $articleForm;
    private $formService;

    public function __construct(
        EntityManagerInterface $entityManager,
        ArticleForm $articleForm,
        FormServiceInterface $formService
    ) {
        $this->entityManager = $entityManager;
        $this->articleForm   = $articleForm;
        $this->formService   = $formService;
    }

    public function indexAction()
    {
        $category = $this->entityManager->getRepository(Category::class)->findAll();

        $articlesQueryBuilder = $this->entityManager
                                     ->getRepository(Article::class)
                                     ->getArticlesQueryBuilder($this->entityManager);

        $adapter = new DoctrinePaginator(new ORMPaginator($articlesQueryBuilder));
        $paginator = new Paginator($adapter);

        $currentPageNumber = (int)$this->params()->fromRoute('page', 1);
        $paginator->setCurrentPageNumber($currentPageNumber);

        $itemCountPerPage = 10;
        $paginator->setItemCountPerPage($itemCountPerPage);

        $pageNumber = (int)$paginator->getCurrentPageNumber();

        return new ViewModel([
            'category'    => $category,
            'articles'    => $paginator,
            'pageNumber'  => $pageNumber,
            'cnt'         => 0,
            'articlesCnt' => ($currentPageNumber - 1) * $itemCountPerPage,
        ]);
    }

    public function addAction()
    {
        $article = new Article();

        /* For annotation form */
        $form = $this->formService->getAnnotationForm($this->entityManager, $article);
        $form->setValidationGroup(FormInterface::VALIDATE_ALL);

        /* For ordinary form */
        /*$form = $this->articleForm;
        $form->setHydrator(new DoctrineObject($this->entityManager));
        $form->bind($article);*/

        $request = $this->getRequest();
        if ($request->isPost()) {

            /* In order it was impossible to add an article to a category which has a child category */
            $categoryId = (int)$request->getPost('category');
            $childCategories = $this->entityManager->getRepository(Category::class)->findBy(['parentId' => $categoryId]);

            if ($childCategories) {
                $this->flashMessenger()->addErrorMessage('Cannot add article to category which has child category');

                // in order to get flashMessenger on add page
                $this->redirect()->refresh();
                
                return ['form' => $form]; die;
            }
            /* End block */

            $data = array_merge_recursive(
                $request->getPost()->toArray(),
                $request->getFiles()->toArray()
            );

            $files = $request->getFiles()->toArray();
            if ($files) { $fileName = $files['file']['name']; }

            $form->setData($data);

            if ($form->isValid()) {
                $article = $form->getData();
                if ($fileName) {
                    $article->setImage('/img/article/' . $fileName);
                }

                $this->entityManager->persist($article);
                $this->entityManager->flush();

                $this->flashMessenger()->setNamespace('success')->addMessage('Article added');

                return $this->redirect()->toRoute('admin/articles');
            }
        }

        return new ViewModel([
            'form' => $form,
        ]);
    }

    public function editAction()
    {
        $pageNumber = (int)$this->params()->fromRoute('page', 0);
        $id         = (int)$this->params()->fromRoute('id', 0);
        $article    = $this->entityManager->getRepository(Article::class)->find($id);

        if (! $pageNumber || ! $id || ! $article) {
            return $this->notFoundAction();
        }

        /* For annotation form */
        $form = $this->formService->getAnnotationForm($this->entityManager, $article);
        $form->setValidationGroup(FormInterface::VALIDATE_ALL);

        /* For ordinary form */
        /*$form = $this->articleForm;
        $form->setHydrator(new DoctrineObject($this->entityManager));
        $form->bind($article);*/

        $request = $this->getRequest();
        if ($request->isPost()) {
            $data = array_merge_recursive(
                $request->getPost()->toArray(),
                $request->getFiles()->toArray()
            );

            $files = $request->getFiles()->toArray();
            if ($files) { $fileName = $files['file']['name']; }

            $form->setData($data);

            if ($form->isValid()) {
                $article = $form->getData();
                if ($fileName) {
                    $article->setImage('/img/article/' . $fileName);
                }

                $this->entityManager->persist($article);
                $this->entityManager->flush();

                $this->flashMessenger()->setNamespace('success')->addMessage('Article edited');

                return $this->redirect()->toRoute('admin/articles', ['page' => $pageNumber]);
            }
        }

        return new ViewModel([
            'form'       => $form,
            'pageNumber' => $pageNumber,
            'id'         => $id,
            'article'    => $article,
        ]);
    }

    public function deleteAction()
    {
        $pageNumber = (int)$this->params()->fromRoute('page', 0);
        $id         = (int)$this->params()->fromRoute('id', 0);
        $article    = $this->entityManager->getRepository(Article::class)->find($id);
        $request    = $this->getRequest();

        if (! $request->isPost() || ! $pageNumber || ! $id || ! $article) {
            return $this->notFoundAction();
        }

        $this->deleteComments($id);
        $this->deleteLikes($id);
        $this->deleteDisLikes($id);

        $this->entityManager->remove($article);
        $this->entityManager->flush();

        $this->flashMessenger()->setNamespace('success')->addMessage('Article deleted');

        return $this->redirect()->toRoute('admin/articles', ['page' => $pageNumber]);
    }

    private function deleteComments($articleId)
    {
        $comments = $this->entityManager->getRepository(Comment::class)->findBy(['article' => $articleId]);
        if ($comments) {
            foreach ($comments as $comment) {
                $this->entityManager->remove($comment);
            }
        }
    }

    private function deleteLikes($articleId)
    {
        $articleLikes = $this->entityManager->getRepository(ArticleLike::class)->findBy(['article' => $articleId]);
        if ($articleLikes) {
            foreach ($articleLikes as $articleLike) {
                $this->entityManager->remove($articleLike);
            }
        }
    }

    private function deleteDisLikes($articleId)
    {
        $articleDislikes = $this->entityManager->getRepository(ArticleDislike::class)->findBy(['article' => $articleId]);
        if ($articleDislikes) {
            foreach ($articleDislikes as $articleDislike) {
                $this->entityManager->remove($articleDislike);
            }
        }
    }
}
