<?php

class AjaxReviewsItemUpdateProcessor extends modObjectUpdateProcessor
{
    public $objectType = 'Review';
    public $classKey = 'Review';
    public $languageTopics = ['ajaxreviews'];
    //public $permission = 'save';


    /**
     * We doing special check of permission
     * because of our objects is not an instances of modAccessibleObject
     *
     * @return bool|string
     */
    public function beforeSave()
    {
        if (!$this->checkPermissions()) {
            return $this->modx->lexicon('access_denied');
        }

        return true;
    }


    /**
     * @return bool
     */
    public function beforeSet()
    {
        $id = (int)$this->getProperty('id');
        $author_id = trim($this->getProperty('author_id'));
        $user_id = trim($this->getProperty('user_id'));
        $rating = trim($this->getProperty('rating'));
        if (!$this->modx->getCount('modUser', $user_id)) {
            $this->failure($this->modx->lexicon('ajaxreviews_rating_err_nf_user_id'));
        }
        if (!$this->modx->getCount('modUser', $author_id)) {
            $this->failure($this->modx->lexicon('ajaxreviews_rating_err_nf_user_id'));
        }
        if ($rating <= 0 || $rating > 5 ) {
            $this->failure($this->modx->lexicon('ajaxreviews_rating_err_rating'));
        }
        if (empty($id)) {
            return $this->modx->lexicon('ajaxreviews_item_err_ns');
        }
        /*
        if (empty($name)) {
            $this->modx->error->addField('name', $this->modx->lexicon('ajaxreviews_item_err_name'));
        } elseif ($this->modx->getCount($this->classKey, ['name' => $name, 'id:!=' => $id])) {
            $this->modx->error->addField('name', $this->modx->lexicon('ajaxreviews_item_err_ae'));
        }
        */
        return parent::beforeSet();
    }
}

return 'AjaxReviewsItemUpdateProcessor';
