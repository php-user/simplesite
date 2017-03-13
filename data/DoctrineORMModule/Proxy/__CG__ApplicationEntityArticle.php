<?php

namespace DoctrineORMModule\Proxy\__CG__\Application\Entity;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class Article extends \Application\Entity\Article implements \Doctrine\ORM\Proxy\Proxy
{
    /**
     * @var \Closure the callback responsible for loading properties in the proxy object. This callback is called with
     *      three parameters, being respectively the proxy object to be initialized, the method that triggered the
     *      initialization process and an array of ordered parameters that were passed to that method.
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setInitializer
     */
    public $__initializer__;

    /**
     * @var \Closure the callback responsible of loading properties that need to be copied in the cloned object
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setCloner
     */
    public $__cloner__;

    /**
     * @var boolean flag indicating if this object was already initialized
     *
     * @see \Doctrine\Common\Persistence\Proxy::__isInitialized
     */
    public $__isInitialized__ = false;

    /**
     * @var array properties to be lazy loaded, with keys being the property
     *            names and values being their default values
     *
     * @see \Doctrine\Common\Persistence\Proxy::__getLazyProperties
     */
    public static $lazyPropertiesDefaults = [];



    /**
     * @param \Closure $initializer
     * @param \Closure $cloner
     */
    public function __construct($initializer = null, $cloner = null)
    {

        $this->__initializer__ = $initializer;
        $this->__cloner__      = $cloner;
    }







    /**
     * 
     * @return array
     */
    public function __sleep()
    {
        if ($this->__isInitialized__) {
            return ['__isInitialized__', '' . "\0" . 'Application\\Entity\\Article' . "\0" . 'id', '' . "\0" . 'Application\\Entity\\Article' . "\0" . 'title', '' . "\0" . 'Application\\Entity\\Article' . "\0" . 'description', '' . "\0" . 'Application\\Entity\\Article' . "\0" . 'ingredient', '' . "\0" . 'Application\\Entity\\Article' . "\0" . 'instruction', '' . "\0" . 'Application\\Entity\\Article' . "\0" . 'category', '' . "\0" . 'Application\\Entity\\Article' . "\0" . 'isPublic', '' . "\0" . 'Application\\Entity\\Article' . "\0" . 'articleLike', '' . "\0" . 'Application\\Entity\\Article' . "\0" . 'articleDislike', '' . "\0" . 'Application\\Entity\\Article' . "\0" . 'image', '' . "\0" . 'Application\\Entity\\Article' . "\0" . 'submit'];
        }

        return ['__isInitialized__', '' . "\0" . 'Application\\Entity\\Article' . "\0" . 'id', '' . "\0" . 'Application\\Entity\\Article' . "\0" . 'title', '' . "\0" . 'Application\\Entity\\Article' . "\0" . 'description', '' . "\0" . 'Application\\Entity\\Article' . "\0" . 'ingredient', '' . "\0" . 'Application\\Entity\\Article' . "\0" . 'instruction', '' . "\0" . 'Application\\Entity\\Article' . "\0" . 'category', '' . "\0" . 'Application\\Entity\\Article' . "\0" . 'isPublic', '' . "\0" . 'Application\\Entity\\Article' . "\0" . 'articleLike', '' . "\0" . 'Application\\Entity\\Article' . "\0" . 'articleDislike', '' . "\0" . 'Application\\Entity\\Article' . "\0" . 'image', '' . "\0" . 'Application\\Entity\\Article' . "\0" . 'submit'];
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (Article $proxy) {
                $proxy->__setInitializer(null);
                $proxy->__setCloner(null);

                $existingProperties = get_object_vars($proxy);

                foreach ($proxy->__getLazyProperties() as $property => $defaultValue) {
                    if ( ! array_key_exists($property, $existingProperties)) {
                        $proxy->$property = $defaultValue;
                    }
                }
            };

        }
    }

    /**
     * 
     */
    public function __clone()
    {
        $this->__cloner__ && $this->__cloner__->__invoke($this, '__clone', []);
    }

    /**
     * Forces initialization of the proxy
     */
    public function __load()
    {
        $this->__initializer__ && $this->__initializer__->__invoke($this, '__load', []);
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __isInitialized()
    {
        return $this->__isInitialized__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitialized($initialized)
    {
        $this->__isInitialized__ = $initialized;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitializer(\Closure $initializer = null)
    {
        $this->__initializer__ = $initializer;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __getInitializer()
    {
        return $this->__initializer__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setCloner(\Closure $cloner = null)
    {
        $this->__cloner__ = $cloner;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific cloning logic
     */
    public function __getCloner()
    {
        return $this->__cloner__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     * @static
     */
    public function __getLazyProperties()
    {
        return self::$lazyPropertiesDefaults;
    }

    
    /**
     * {@inheritDoc}
     */
    public function getId()
    {
        if ($this->__isInitialized__ === false) {
            return (int)  parent::getId();
        }


        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getId', []);

        return parent::getId();
    }

    /**
     * {@inheritDoc}
     */
    public function setTitle($title)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setTitle', [$title]);

        return parent::setTitle($title);
    }

    /**
     * {@inheritDoc}
     */
    public function getTitle()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getTitle', []);

        return parent::getTitle();
    }

    /**
     * {@inheritDoc}
     */
    public function setDescription($description)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDescription', [$description]);

        return parent::setDescription($description);
    }

    /**
     * {@inheritDoc}
     */
    public function getDescription()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDescription', []);

        return parent::getDescription();
    }

    /**
     * {@inheritDoc}
     */
    public function setIngredient($ingredient)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIngredient', [$ingredient]);

        return parent::setIngredient($ingredient);
    }

    /**
     * {@inheritDoc}
     */
    public function getIngredient()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIngredient', []);

        return parent::getIngredient();
    }

    /**
     * {@inheritDoc}
     */
    public function setInstruction($instruction)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setInstruction', [$instruction]);

        return parent::setInstruction($instruction);
    }

    /**
     * {@inheritDoc}
     */
    public function getInstruction()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getInstruction', []);

        return parent::getInstruction();
    }

    /**
     * {@inheritDoc}
     */
    public function setIsPublic($isPublic)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIsPublic', [$isPublic]);

        return parent::setIsPublic($isPublic);
    }

    /**
     * {@inheritDoc}
     */
    public function getIsPublic()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIsPublic', []);

        return parent::getIsPublic();
    }

    /**
     * {@inheritDoc}
     */
    public function setArticleLike($articleLike)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setArticleLike', [$articleLike]);

        return parent::setArticleLike($articleLike);
    }

    /**
     * {@inheritDoc}
     */
    public function getArticleLike()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getArticleLike', []);

        return parent::getArticleLike();
    }

    /**
     * {@inheritDoc}
     */
    public function setArticleDislike($articleDislike)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setArticleDislike', [$articleDislike]);

        return parent::setArticleDislike($articleDislike);
    }

    /**
     * {@inheritDoc}
     */
    public function getArticleDislike()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getArticleDislike', []);

        return parent::getArticleDislike();
    }

    /**
     * {@inheritDoc}
     */
    public function setImage($image)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setImage', [$image]);

        return parent::setImage($image);
    }

    /**
     * {@inheritDoc}
     */
    public function getImage()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getImage', []);

        return parent::getImage();
    }

    /**
     * {@inheritDoc}
     */
    public function setCategory(\Application\Entity\Category $category = NULL)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCategory', [$category]);

        return parent::setCategory($category);
    }

    /**
     * {@inheritDoc}
     */
    public function getCategory()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCategory', []);

        return parent::getCategory();
    }

}
