<?php
$fqn = $modx->getOption('pdoFetch.class', null, 'pdotools.pdofetch', true);
$path = $modx->getOption('pdofetch_class_path', null, MODX_CORE_PATH . 'components/pdotools/model/', true);
if ($pdoClass = $modx->loadClass($fqn, $path, false, true)) {
    $pdoFetch = new $pdoClass($modx, $scriptProperties);
} else {
    return false;
}
$pdoFetch->addTime('pdoTools loaded');

$AjaxReviews = $modx->getService('AjaxReviews', 'AjaxReviews', MODX_CORE_PATH . 'components/ajaxreviews/model/', $scriptProperties);
if (!$AjaxReviews) {
    return 'Could not load AjaxReviews class!';
}

$modx->lexicon->load('formit:default');

$errors = [];
$data = ['service' => 'ajaxreviews'];

switch ($action) {
    case 'rating/get':
        $tpl = $modx->getOption('tpl', $scriptProperties, '');
        if (empty($user_id)) {
            $errors['user'] =  'Укажите user_id!';
        } elseif ($user = $modx->getObject('modUser', (int) $user_id)) {
            $user_id = $user->id;
        } else {
            $errors['user'] = 'Пользователь с таким id не найден.';
        }
        if (empty($errors)) {
            $q = $modx->newQuery('Rating');
            $q->select(array(
                '`Rating`.rating AS rating',
            ));
            $q->where(array('user_id' => $user_id));
            $q->prepare();
            //return $q->toSQL();
            if ($rt = $modx->getObject('Rating', $q)) {
                $rating = $rt->get('rating');
            } else {
                $rating = 0;
            }
            $output = empty($tpl)
                ? '<pre>' . $pdoFetch->getChunk('', array('rating' => $rating)) . '</pre>'
                : $pdoFetch->getChunk($tpl, array('rating' => $rating));
            return $output;
        } else {
            return $errors;
        }
        break;

    case 'reviews/get':
        $tplOut = $modx->getOption('tplOut', $scriptProperties, '');
        $tpl = $modx->getOption('tpl', $scriptProperties, '');
        $where = json_decode($modx->getOption('where', $scriptProperties, '{}'), true);
        $totalVar = $modx->getOption('totalVar', $scriptProperties, 'total');
        $limit = $modx->getOption('limit', $scriptProperties, 5);
        $autopublish = $modx->getOption('autopublish', $scriptProperties, 0);
        $q = $modx->newQuery('Review');
        $q->leftJoin('modUserProfile', 'Profile', array('`Profile`.`internalKey` = `Review`.`author_id`'));
        $q->select(array(
            '`Review`.*',
            '`Profile`.`fullname` AS `author_fullname`',
            '`Profile`.`email` AS `author_email`',
            '`Profile`.`photo` AS `author_avatar`',
        ));
        $q->where($where);
        $total = $modx->getCount('Review', $q);
        $modx->setPlaceholder($totalVar, $total);
        $q->limit($limit, $offset);
        $q->prepare();
        //$modx->log(1, $q->toSQL());
        $reviews = $modx->getIterator('Review', $q);
        $items = [];
        $idx = 0;
        foreach ($reviews as $review) {
            $idx += 1;
            $item = array_merge($review->toArray(), $scriptProperties);
            $items[] = empty($tpl)
                ? '<pre>' . $pdoFetch->getChunk('', $item) . '</pre>'
                : $pdoFetch->getChunk($tpl, $item);
        }

        $output = array_merge(array('wrapper' => implode($outputSeparator, $items)), $scriptProperties);
        $output = empty($tplOut)
            ? '<pre>' . $pdoFetch->getChunk('', $items) . '</pre>'
            : $pdoFetch->getChunk($tplOut, $output);
        return $output;
        break;
    case 'review/create':
        // Откликаться будет ТОЛЬКО на ajax запросы
        if (empty($_SERVER['HTTP_X_REQUESTED_WITH']) || $_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest') {
            return;
        }
        $errors = [];
        $params = [];
        foreach (['user_id', 'rating'] as $field) { // валидация обязательных полей
            if (!empty($_POST[$field])) {
                $params[$field] = (int) $_POST[$field];
            } else {
                $errors[$field] = $modx->lexicon('formit.field_required');;
            }
        }
        foreach (['title', 'content'] as $field) { // не обязательные поля
            $params[$field] = strip_tags($_POST[$field]);
        }
        if ($author = $modx->getUser()) {
            $author_id = $author->id;
        } else {
            $errors['author'] = 'Author not found.';
        }
        if ($user = $modx->getObject('modUser', $params['user_id'])) {
            $user_id = $user->get('id');
        } else {
            $errors['user'] = 'User not found.';
        }
        if (empty($errors)) {
            $review = $modx->newObject('Review');
            if (!$rating = $modx->getObject('Rating', array('user_id' => $params['user_id']))) {
                $rating = $modx->newObject('Rating');
            }
            $review->set('created', time());
            $review->set('author_id', $author_id);
            $review->set('user_id', $user_id);
            $review->set('rating', $params['rating']);
            $review->set('title', $params['title']);
            $review->set('content', $params['content']);
            if ($autopublish == 1) {
                $review->set('active', 1);
            }
            $review->set('content', $params['content']);
            if ($review->save()) {
                $r = $rating->get('rating') == 0? $params['rating']:round((($rating->get('rating') + $params['rating']) / 2), 2);
                $rating->set('rating', $r);
                $rating->set('user_id', $user_id);
                if (!$rating->save()) {
                    $errors['rating'] = 'Can not save a rating!';
                }
            } else {
                $errors['review'] = 'Can not save a review!';
            }
        }
        break;
    default:
        $errors['default'] = 'Action undefined';
}

if (empty($errors)) {
    return $AjaxForm->success('', array_merge($data, array('result' => true, 'message' => $scriptProperties['successMsg'], 'modalID' => $scriptProperties['successModalID'])));
} else {
    return $AjaxForm->error('', array_merge($data, array('result' => false, 'message' => $scriptProperties['errorMsg'], 'modalID' => $scriptProperties['errorModalID'], 'errors' => $errors)));
}
