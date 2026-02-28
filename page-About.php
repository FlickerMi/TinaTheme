<?php 
/**
 * 关于
 * 
 * @package custom 
 * 
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php');
?>

<main>
    <header>
        <div class="container">
            <h1><?php $this->title() ?></h1>
            <p class="subtitle">关于</p>
        </div>
    </header>
    <div class="container">
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