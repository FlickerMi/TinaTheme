<?php 
/**
 * For Love
 *
 * @package custom
 * @author  Flicker
 * @link    http://notemi.cn
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php');
?>

<main>
    <header>
        <div class="container">
            <h1><?php $this->title() ?></h1>
            <p class="subtitle">For Love</p>
        </div>
    </header>
    <div class="container">
        <style>
            .bookmark a li{
                list-style:none;  
                height:40px;
                min-width:70px;
                text-align:center;
                line-height:40px;
                display:inline-block;
                margin-bottom: 5px;
                font-size:13px;
                padding: 0 5px;
                border-radius: 4px;
            }
            .bookmark div {
                margin: 30px 0;
            }
            .bookmark a:hover {
                text-decoration: none;
                color: #FFF;
            }
            .bookmark a {
                color: #FFF;
                text-decoration: none;
            }
            .bookmark .life a li {
                background-color: #E6C0BF;
            }
            .bookmark .student a li {
                background-color: #E3D9C1;
            }
            .bookmark .design a li {
                background-color: #CDDDC8;
            }
            .bookmark .tool a li {
                background-color: #C4CDE1;
            }
            .bookmark .photography a li {
                background-color: #C7C2E2;
            }
            .bookmark .other a li {
                background-color: #E3C1DE;
            }

            .db-items {
                list-style: none;
                padding: 0;
            }
            .db-items li {
                float: left;
                padding-right:5px;
            }
            .img-list {
                display: inline-block;
            }

            a.share-img {
                position: relative;
                font-size: 13px;
                color: #f04;
            }

            .share-img img {
                position: absolute !important;
                z-index: 99;
                top: -210px;
                max-width: none;
                height: 200px;
                transform: scale(0);
                transform-origin: bottom left;
                opacity: 0;
                -webkit-transition: all .4s ease-in-out;
                -o-transition: all .4s ease-in-out;
                transition: all .4s ease-in-out;
            }

            .share-img:hover img {
                transform: scale(1);
                opacity: 1;
            }
        </style>
        
        <div class="article-post">
            <?php $this->content(); ?>
        </div>
        
        <?php if ($this->options->TheComments): ?>
        <div class="container" style="padding:0">
            <?php $this->need('comments.php'); ?>
        </div>
        <?php endif; ?>

    </div>
</main>

<?php $this->need('footer.php'); ?>