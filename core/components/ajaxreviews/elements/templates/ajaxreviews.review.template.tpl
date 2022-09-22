<!doctype html>
<html lang="en">

<head>
    <title>{$_modx->resource.pagetitle~' / '~$_modx->config.site_name}</title>
    <base href="{$_modx->config.site_url}" />
    <meta charset="{$_modx->config.modx_charset}" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
</head>

<body>
    <section class="my-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col">
                    {set $usr_rating = '!AjaxReviews'|snippet:[
                    'action' => 'rating/get',
                    'user_id' => 2,
                    'tpl' => '@INLINE{$rating}'
                    ]}
                    <div class="d-flex">
                        <p class="mr-3">User: {$_modx->user.fullname}</p>
                        <div class="review-rating">
                            <div style="width: {($usr_rating*100)/5}%"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col">
                    <h2 class="text-center mb-4">Reviews</h2>
                </div>
            </div>
            <div class="row justify-content-center mb-5">
                <div class="col-12">
                    {'!pdoPage'|snippet : [
                    'element' => 'AjaxReviews',
                    'action' => 'reviews/get',
                    'where' => '{"active":1}',
                    'tplOut' => '@INLINE <div class="row flex-row">{$wrapper}</div>',
                    'tpl' => '@INLINE <div class="col-12 border-bottom py-3">
                        <h3>{$title} <div class="review-rating">
                                <div style="width: {($rating*100)/5}%"></div>
                            </div>
                        </h3>
                        <b>{$author_fullname}</b>
                        <img src="{$author_avatar}" alt="">
                        <p>{$content}</p>
                    </div>',
                    ]}
                    {'page.nav' | placeholder}
                </div>
            </div>
        </div>
    </section>
    <section class="mb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col">
                    <h2 class="text-center mb-4">Review create</h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-6">
                    {if $_modx->isAuthenticated() && $_modx->hasSessionContext('web')}
                    {'!AjaxForm'|snippet : [
                    'snippet' => 'AjaxReviews',
                    'form' => 'ajaxreviews.review.create.form',
                    'action' => 'review/create',
                    'autopublish' => 1,
                    'successMsg' => 'Отзыв успешно сохранен!',
                    'successModalID' => 'successModalReview',
                    'errorMsg' => 'Что то пошло не так, попробуйте еще раз!',
                    'errorModalID' => 'errorModalReview',
                    ]}
                    {/if}
                </div>
            </div>
        </div>
        </div>
    </section>

    <link rel="stylesheet" href="{$_modx->config.assets_url}apps/bootstrap-4.5.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{$_modx->config.assets_url}components/ajaxreviews/css/web/css/style.min.css">

    <script src="{$_modx->config.assets_url}js/jquery-3.6.0.min.js"></script>
    <script src="{$_modx->config.assets_url}apps/bootstrap-4.5.3-dist/js/popper.min.js"></script>
    <script src="{$_modx->config.assets_url}apps/bootstrap-4.5.3-dist/js/bootstrap.min.js"></script>
    <script src="{$_modx->config.assets_url}components/ajaxreviews/js/web/ajaxreviews.min.js"></script>

</body>

</html>