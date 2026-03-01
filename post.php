<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

<?php
// 灰色滤镜：检测文章标签中是否含有 gray
$tags = $this->tags;
if ($tags != null && strpos(json_encode($tags), 'gray')) {
?>
<style>
    html {
        -webkit-filter: grayscale(100%);
        filter: progid:DXImageTransform.Microsoft.BasicImage(grayscale=1);
    }
</style>
<?php } ?>

<?php
// JSON-LD 结构化数据（Article schema）
$jsonld = array(
    '@context'      => 'https://schema.org',
    '@type'         => 'Article',
    'headline'      => $this->title,
    'url'           => $this->permalink,
    'datePublished' => date('c', $this->created),
    'dateModified'  => date('c', $this->modified),
    'author'        => array(
        '@type' => 'Person',
        'name'  => $this->author->name,
    ),
    'publisher'     => array(
        '@type' => 'Organization',
        'name'  => $this->options->title,
    ),
);
?>
<script type="application/ld+json"><?php echo json_encode($jsonld, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?></script>

<main>
    <div class="container">
        <article>
            <header class="article-header">
                <div class="thumb">
                    <div>
                        <h1><?php $this->title() ?></h1>
                        <div class="post-meta">
                            <div>
                            <span>
                                By <a href="<?php $this->author->permalink(); ?>"><?php $this->author(); ?></a>
                            </span> |
                            <time datetime="<?php echo date('c', $this->created); ?>"><?php $this->date('M j, Y'); ?></time> |
                            <span>
                                <?php _e('Category: '); ?><?php $this->category(','); ?>
                            </span>
                            <?php if ($this->options->WordCount): ?>
                            <time> | 共 <?php echo word_count($this->cid); ?> 个字符</time>
                            <?php endif; ?>
                            <?php if (class_exists('Views_Plugin')): ?>
                            <time> | <?php Views_Plugin::theViews('', ' 次阅读'); ?></time>
                            <?php endif; ?>
                            </div>
                            <div class="tags">
                                <?php $this->tags(', ', true); ?>
                        </div>
                    </div>
                </div>
            </header>
        </article>
        <div id="post" class="article-post">
            <?php
            // 处理文章内容：[hide] 标签 + 图片 Fancybox 放大
            $rawContent = $this->content;

            // 先处理 [hide] 短代码（含数据库查询）
            $processedContent = getContentWithHide($rawContent, $this->cid, $this);

            // 图片点击放大（Fancybox）
            if ($this->options->fancybox) {
                $pattern = '/\<img((?:[^>](?!data-fancybox))*?)src\=\"(.*?)\"([^>]*)\>/i';
                $replacement = '<a href="$2" data-fancybox="gallery" data-caption=""><img$1src="$2"$3></a>';
                $processedContent = preg_replace($pattern, $replacement, $processedContent);
            }

            echo $processedContent;
            ?>
        </div>
    </div>


    <?php
    // 版权声明区块
    $permalink = $this->permalink;
    ?>
    <div class="container">
        <div class="copy-text">
            <div>
                <p>非特殊说明，本博所有文章均为博主原创。</p>
                <p>如若转载，请注明出处：<a href="<?php $this->permalink() ?>"><?php $this->permalink() ?></a></p>
            </div>
        </div>
    </div>
    <?php if ($this->options->TheComments): ?>
    <div class="container">
        <?php $this->need('comments.php'); ?>
    </div>
    <?php endif; ?>

    <br><br>
    <div class="container">
        <nav class="flex container suggested">
            <?php prev_post($this);?>
            <?php next_post($this);?>
        </nav>
    </div>
</main>
<?php $this->need('footer.php'); ?>